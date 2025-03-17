<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
    // Start a session if not already started
    if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
    }
// Add CAPTCHA to form
function mnkh_add_captcha_to_form() {


    // Retrieve reCAPTCHA settings from the database
    $recaptcha_version = get_option('captcha_style');
    $simple_version = get_option('simple_style');
    $option_name = $recaptcha_version . '_site_key';
    $site_key = get_option($option_name);

    // Enqueue the reCAPTCHA JavaScript based on version
    mnkh_enqueue_recaptcha_scripts( $recaptcha_version, $site_key );
    // Show reCAPTCHA based on selected version
    if ( $recaptcha_version === 'recaptcha' ) {
        if ( empty( $site_key ) || empty( $recaptcha_version ) ) {
            echo '<span class="g-re-not">' . esc_html_e('Recaptcha site key not defined', 'cwlp') . '</span>';
            return;
        }
        // Display Google reCAPTCHA v2 Checkbox
        echo '<div class="g-recaptcha" data-sitekey="' . esc_attr( $site_key ) . '"></div>';
    } elseif ( $recaptcha_version === 'recaptcha_v2_inv' ) {
        if ( empty( $site_key ) || empty( $recaptcha_version ) ) {
            echo '<span class="g-re-not">' . esc_html_e('Recaptcha site key not defined', 'cwlp') . '</span>';
            return;
        }
        // Display Invisible Google reCAPTCHA v2
        echo '<div class="g-recaptcha" data-sitekey="' . esc_attr( $site_key ) . '" data-callback="onSubmit" data-size="invisible"></div>';
    } elseif ( $recaptcha_version === 'recaptcha_v3' ) {
        // Display reCAPTCHA v3 (handled in JS)
        echo '<div class="recaptcha-token" style="display:none;"></div>';
    } elseif ( $recaptcha_version === 'simple' ) {
        // Generate a unique question
        $num1 = wp_rand( 1, 10 );
        $num2 = wp_rand( 1, 10 );
        $operations = array( '+', '-', '*', '÷' );
        $operation = $operations[ array_rand( $operations ) ];

        if ( $operation == '-' ) {
            $num1 = wp_rand( 15, 50 );
            $num2 = wp_rand( 1, 15 );
        }

        // Calculate the correct answer
        $answer = 0;
        switch ( $operation ) {
            case '+':
                $answer = $num1 + $num2;
                break;
            case '-':
                $answer = $num1 - $num2;
                break;
            case '*':
                $answer = $num1 * $num2;
                break;
            case '÷':
                while ( $num2 == 0 || $num1 % $num2 != 0 ) {
                    $num1 = wp_rand( 1, 10 );
                    $num2 = wp_rand( 1, 10 );
                }
                $answer = $num1 / $num2;
                break;
        }

        // Store the answer in session
        $_SESSION['mnkh_captcha_answer'] = $answer;

        // Add Nonce Field
        $nonce_field = wp_nonce_field( 'mnkh_captcha_nonce', 'mnkh_captcha_nonce_field', true, false );
        echo wp_kses( $nonce_field, array( 'input' => array( 'type' => array(), 'name' => array(), 'value' => array(), 'id' => array(), 'class' => array() ) ) );
		
        // Display question
		if ( $simple_version === '0' ) {
			echo '<div class="solve_this"><p class="solvo-cap">🔐 ' . esc_html__( 'Solve this', 'cwlp' ) . ': <input type="number" name="mnkh_captcha_answer" oninvalid="this.setCustomValidity(\'' . esc_attr__( 'Please enter the correct answer', 'cwlp' ) . '\')" oninput="setCustomValidity(\'\')" required style="width:100%;margin-bottom:10px;" /></p>';
			echo '<div class="cwlp-num">' . esc_html( $num1 ) . ' <span class="opera">' . esc_html( $operation ) . '</span> <span class="other">' . esc_html( $num2 ) . ' = ?</span></div></div>';
		} elseif ( $simple_version === '1' ) {
			echo '<div class="solve_this"><p class="solvo-cap">🔐 ' . esc_html__( 'Solve this', 'cwlp' ) . ': <div class="cwlp-num">' . esc_html( $num1 ) . ' <span class="opera">' . esc_html( $operation ) . '</span> <span class="other">' . esc_html( $num2 ) . ' = ?</span></div>';
			echo '<p id="simplecaptcha"><input type="number" name="mnkh_captcha_answer" oninvalid="this.setCustomValidity(\'' . esc_attr__( 'Please enter the correct answer', 'cwlp' ) . '\')" oninput="setCustomValidity(\'\')" required style="width:100%;margin-bottom:10px;" /></p></div>';
		}
    }

        // Close the session to avoid conflict, especially since form can trigger a HTTP request through post method
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

}
add_action( 'login_form', 'mnkh_add_captcha_to_form' );
add_action( 'register_form', 'mnkh_add_captcha_to_form' );




// Enqueue reCAPTCHA scripts based on the selected version
function mnkh_enqueue_recaptcha_scripts( $recaptcha_version, $site_key ) {
    // Handle "simple" captcha type
    $simple_style = sanitize_text_field( get_option( 'simple_style' ) );
    if ( 'simple' === $recaptcha_version ) {
        $style_handle = 'simple_styles';

        if ( '0' === $simple_style || '' === $simple_style ) {
            // Enqueue the default stylesheet
            wp_enqueue_style( $style_handle, CWLP_LOGIN_ASSETS . 'css/simplestyle-new.css', array(), CWLP_VER );

			if ( has_image_processing_extension() ) {
				$background_url = esc_url( plugins_url( 'gen-image.php', __FILE__ ) );
			} else {
				$background_url = esc_url( plugins_url( 'gen-image.webp', __FILE__ ) );
			}
            $inline_style = "
                div.cwlp-num {
                    float: left;
                    direction: ltr;
                    background-image: url('$background_url');
                    background-size: contain;
                    filter: grayscale(1);
                    padding: 5px 12px 0px;
                    border-radius: 10px;
                    font-size: 1.3rem;
                    height: 70px;
                    margin-bottom: 2px;
                    display: flex;
                    flex-direction: column;
                    flex-wrap: nowrap;
                    justify-content: center;
                    align-items: center;
                }
            ";

            // Add the inline style to the enqueued stylesheet
            wp_add_inline_style( $style_handle, $inline_style );
        } elseif ( '1' === $simple_style ) {
            // Enqueue an alternative stylesheet
            wp_enqueue_style( $style_handle, CWLP_LOGIN_ASSETS . 'css/simplestyle.css', array(), CWLP_VER );
        }
    }

    if( in_array( $recaptcha_version, array( 'recaptcha', 'recaptcha_v2_inv', 'recaptcha_v3' ) ) ) {
        wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
    }

    if ( $recaptcha_version === 'recaptcha_v3' ) {
        // Enqueue reCAPTCHA v3 script from Google
        wp_enqueue_script( 'recaptcha-v3', 'https://www.google.com/recaptcha/api.js?render=' . esc_attr( $site_key ), array(), null, true );

        wp_add_inline_script( 'recaptcha-v3', "
            grecaptcha.ready(function() {
                var forms = ['loginform', 'registerform'];
                forms.forEach(function(formId) {
                    var form = document.getElementById(formId);
                    if (form) {
                        form.onsubmit = function(e) {
                            e.preventDefault(); // Prevent form submission
                            
                            // Execute reCAPTCHA and get the token
                            grecaptcha.execute('" . esc_js( $site_key ) . "', { action: formId }).then(function(token) {
                                // Create a hidden input field to store the token
                                var recaptchaResponse = document.createElement('input');
                                recaptchaResponse.type = 'hidden';
                                recaptchaResponse.name = 'g-recaptcha-response';
                                recaptchaResponse.value = token;
                                
                                // Append the token to the form
                                form.appendChild(recaptchaResponse);
                                
                                // Now submit the form
                                form.submit();
                            });
                        };
                    }
                });
            });
        ");

    } elseif ( $recaptcha_version === 'recaptcha_v2_inv' ) {
         wp_add_inline_script( 'recaptcha', "
            function onSubmit(token) {
               var loginForm = document.getElementById('loginform');
               var registerForm = document.getElementById('registerform');

				if (loginForm) {
                  loginForm.submit();
               } else if (registerForm) {
                   registerForm.submit();
				}
            }
            var loginForm = document.getElementById('loginform');
            if (loginForm) {
                loginForm.onsubmit = function(e) {
                    e.preventDefault(); // Prevent form from submitting immediately
                    grecaptcha.execute(); // Execute reCAPTCHA
                };
            }

			var registerForm = document.getElementById('registerform');
            if (registerForm) {
				registerForm.onsubmit = function(e) {
					e.preventDefault(); // Prevent form from submitting immediately
					grecaptcha.execute(); // Execute reCAPTCHA
				};
			}

        " );

    }
}


function mnkh_verify_registration_captcha( $errors, $sanitized_user_login, $user_email ) {

     // Start a session if not already started, as form submissions needs sessions
    if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
    }

    $recaptcha_version = get_option( 'captcha_style' );
   if ( $recaptcha_version === 'simple' ) {
        if ( isset( $_POST['mnkh_captcha_answer'] ) ) {
             $user_answer = intval( sanitize_text_field( wp_unslash( $_POST['mnkh_captcha_answer'] ) ) );

             if ( isset( $_SESSION['mnkh_captcha_answer'] ) && $user_answer !== $_SESSION['mnkh_captcha_answer'] ) {
                    $errors->add( 'captcha_error', __( 'Incorrect CAPTCHA answer. Please try again.', 'cwlp' ) );
                }

                //clean $_SESSION once the value is no longer required by logic validation for simple math operation
             unset( $_SESSION['mnkh_captcha_answer'] );


         } else {
                 $errors->add( 'captcha_error', __( 'CAPTCHA answer is required.', 'cwlp' ) );
         }
		 
		//close as needed in any situation and be safe
         if (session_status() === PHP_SESSION_ACTIVE) {
                session_write_close();
          }

     }  elseif ( in_array( $recaptcha_version, array( 'recaptcha', 'recaptcha_v2_inv', 'recaptcha_v3' ) ) ) {
        if ( empty( $_POST['g-recaptcha-response'] ) ) {
            $errors->add( 'captcha_error', __( 'Please complete the reCAPTCHA.', 'cwlp' ) );
        } else {
            $secret_key = get_option( $recaptcha_version . '_secret_key' );
            $response = wp_remote_post(
                'https://www.google.com/recaptcha/api/siteverify',
                array(
                    'body' => array(
                        'secret'   => esc_html( $secret_key ),
                        'response' => sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ),
                    ),
                )
            );
            $result = json_decode( wp_remote_retrieve_body( $response ), true );
            if ( empty( $result['success'] ) || !$result['success'] ) {
                $errors->add( 'captcha_error', __( 'Google reCAPTCHA verification failed.', 'cwlp' ) );
            }

            }
        
		    //close when done after completing the whole thing
        if (session_status() === PHP_SESSION_ACTIVE) {
               session_write_close();
          }
    }

    return $errors;
}
add_filter( 'registration_errors', 'mnkh_verify_registration_captcha', 10, 3 );


// Validate CAPTCHA during authentication
function mnkh_verify_captcha( $user, $username, $password ) {

	//check to ensure it's POST
	if ( $_SERVER['REQUEST_METHOD'] !== 'POST' || empty( $_POST['log'] ) ) {
        return $user;
    }


     // Start a session if not already started, because we need $_SESSION variable now, in cases if $_SESSION not previously created or is none or a dead session then initiate one

    if ( session_status() == PHP_SESSION_NONE ) {
            session_start();
        }

	// Retrieve reCAPTCHA settings from the database
    $recaptcha_version = get_option( 'captcha_style' );  
    $site_key = '';

    if ( in_array( $recaptcha_version, array( 'recaptcha', 'recaptcha_v2_inv', 'recaptcha_v3' ) ) ) {
        $option_name = $recaptcha_version . '_site_key';
        $secret_name = $recaptcha_version . '_secret_key';
        $site_key = get_option( $option_name );
        $secret_key = get_option( $secret_name );
    }


	 if ( $recaptcha_version === 'simple' ) {

        if ( isset( $_POST['mnkh_captcha_answer'] ) ) {
           $user_answer = intval( sanitize_text_field( wp_unslash( $_POST['mnkh_captcha_answer'] ) ) );
           if ( isset( $_SESSION['mnkh_captcha_answer'] ) && $user_answer !== $_SESSION['mnkh_captcha_answer'] ) {
              	   return new WP_Error( 'captcha_error', __( 'Incorrect CAPTCHA answer. Please try again.', 'cwlp' ) );
            }

				  //clean $_SESSION, once you do logic operations so you do not keep too much active data
                  unset( $_SESSION['mnkh_captcha_answer'] );

         } else {

                return new WP_Error( 'captcha_error', __( 'CAPTCHA answer is required.', 'cwlp' ) );
         }

           //close session immediately because no further data required

           if (session_status() === PHP_SESSION_ACTIVE) {
               session_write_close();
            }


      }

     // Google reCAPTCHA v2 or v3 validation
    if ( in_array( $recaptcha_version, array( 'recaptcha', 'recaptcha_v2_inv' ) ) ) {
		if ( ! isset( $_POST['g-recaptcha-response'] ) || empty( $_POST['g-recaptcha-response'] ) ) {
			 return new WP_Error( 'captcha_error', __( 'Please complete the reCAPTCHA.', 'cwlp' ) );
		}

         $response = wp_remote_post(
            'https://www.google.com/recaptcha/api/siteverify',
            array(
                'body' => array(
                    'secret'   => esc_html( $secret_key ),
                    'response' => sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ),
                ),
            )
         );

        if ( is_wp_error( $response ) ) {
            return new WP_Error( 'captcha_error', __( 'Unable to verify reCAPTCHA. Please try again.', 'cwlp' ) );
         }

         $result = json_decode( wp_remote_retrieve_body( $response ), true );
       if ( empty( $result['success'] ) ) {
            return new WP_Error( 'captcha_error', __( 'Google reCAPTCHA verification failed.', 'cwlp' ) );
        }
		 // close session at last step, once verification step is done and error handled

           if (session_status() === PHP_SESSION_ACTIVE) {
               session_write_close();
          }


     } elseif ( $recaptcha_version === 'recaptcha_v3' ) {

       if ( ! isset( $_POST['g-recaptcha-response'] ) || empty( $_POST['g-recaptcha-response'] ) ) {
          return new WP_Error( 'captcha_error', __( 'Please complete the reCAPTCHA.', 'cwlp' ) );
      }


		 $response = wp_remote_post(
            'https://www.google.com/recaptcha/api/siteverify',
            array(
                'body' => array(
                     'secret'   => get_option( 'recaptcha_v3_secret_key' ),
                    'response' => sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ),
               ),
           )
      );

         if ( is_wp_error( $response ) ) {
           return new WP_Error( 'captcha_error', __( 'Unable to verify reCAPTCHA. Please try again.', 'cwlp' ) );
       }

      $result = json_decode( wp_remote_retrieve_body( $response ), true );

		   if ( empty( $result['success'] ) || !isset( $result['success'] ) || !$result['success'] || $result['score'] < 0.3 ) {
				return new WP_Error( 'captcha_error', __( 'Google reCAPTCHA validation failed or suspicious activity detected.', 'cwlp' ) );
         }

		 // close as part of the final verification for all recaptcha and for all functions including simple or the other version

            if (session_status() === PHP_SESSION_ACTIVE) {
                   session_write_close();
               }

        }
   
    return $user; // No CAPTCHA errors, continue login/registration process
}
add_filter( 'authenticate', 'mnkh_verify_captcha', 30, 3 );

if (session_status() === PHP_SESSION_ACTIVE) {
                session_write_close();
          }
// Disable page caching on login and registration pages
function mnkh_disable_page_cache() {
    if ( is_page( 'login' ) || is_page( 'register' ) ) {
        nocache_headers();  // Prevent page caching
    }
}
add_action( 'send_headers', 'mnkh_disable_page_cache' );