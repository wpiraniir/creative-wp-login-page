<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Start a session if not already started

// Helper function to generate a unique key for CAPTCHA storage
function mnkh_generate_captcha_key() {
    return 'mnkh_captcha_' . md5( wp_get_session_token() . get_current_user_id() );
}

// Add CAPTCHA to login form
function mnkh_add_captcha_to_login_form() {
    $captcha_type = get_option('captcha_style');

    if ( $captcha_type === 'recaptcha' ) {
        // Google reCAPTCHA field
        echo '<div class="g-recaptcha" data-sitekey="' . esc_attr( get_option('recaptcha_site_key') ) . '"></div>';
    } elseif ( $captcha_type === 'simple' ) {
        // Generate a unique question
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);

        $operations = array('+', '-', '*', '÷');
        $operation = $operations[array_rand($operations)];

        if ($operation == '-') {
            $num1 = rand(15, 50);
            $num2 = rand(1, 15);
        }

        // Calculate the correct answer
        $answer = 0;
        switch ($operation) {
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
                while ($num2 == 0 || $num1 % $num2 != 0) {
                    $num1 = rand(1, 10);
                    $num2 = rand(1, 10);
                }
                $answer = $num1 / $num2;
                break;
        }

        // Store the answer in a transient
        $key = mnkh_generate_captcha_key();
        set_transient($key, $answer, 5 * MINUTE_IN_SECONDS); // Store for 5 minutes

        // Display question
        echo '<div class="solve_this"><p>🔐 ' . __( 'Solve this', 'cwlp' ) . ': <span class="cwlp-num">' . esc_html($num1 . ' ' . $operation . ' ' . $num2 . ' = ?') . '</span></p>';
        echo '<p id="simplecaptcha"><input type="number" name="mnkh_captcha_answer" oninvalid="this.setCustomValidity(\'' . esc_attr__( 'Please enter the correct answer', 'cwlp' ) . '\')" oninput="setCustomValidity(\'\')" required style="width:100%;margin-bottom:10px;" /></p>';
    }
}
add_action('login_form', 'mnkh_add_captcha_to_login_form');

// Validate CAPTCHA during authentication
function mnkh_verify_captcha( $user ) {
    $captcha_type = get_option('captcha_style');

    if ( $captcha_type === 'recaptcha' ) {
        // Verify Google reCAPTCHA
        if ( isset( $_POST['g-recaptcha-response'] ) ) {
            $response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
                'body' => array(
                    'secret' => get_option('recaptcha_secret_key'),
                    'response' => sanitize_text_field( $_POST['g-recaptcha-response'] ),
                ),
            ));

            if ( is_wp_error( $response ) ) {
                error_log('reCAPTCHA API error: ' . $response->get_error_message());
                return new WP_Error( 'captcha_error', __('Unable to verify reCAPTCHA. Please try again.', 'cwlp') );
            }

            $result = json_decode( wp_remote_retrieve_body( $response ), true );

            if ( empty($result['success']) ) {
                return new WP_Error( 'captcha_error', __('Google reCAPTCHA verification failed.', 'cwlp') );
            }
        } else {
            return new WP_Error( 'captcha_error', __('Please complete the reCAPTCHA.', 'cwlp') );
        }
    } elseif ( $captcha_type === 'simple' ) {
        // Verify Simple CAPTCHA
        $key = mnkh_generate_captcha_key();
        $stored_answer = get_transient($key);

        if ( isset( $_POST['mnkh_captcha_answer'] ) && $stored_answer ) {
            if ( intval( $_POST['mnkh_captcha_answer'] ) !== intval( $stored_answer ) ) {
                return new WP_Error( 'captcha_error', __('Captcha verification failed.', 'cwlp') );
            }
        } else {
            return new WP_Error( 'captcha_error', __('Please complete the captcha.', 'cwlp') );
        }

        // Remove transient after validation
        delete_transient($key);
    }

    return $user;
}
add_filter( 'wp_authenticate_user', 'mnkh_verify_captcha', 10, 2 );

// Prevent caching on the login page to avoid CAPTCHA issues
function mnkh_disable_login_page_cache() {
    if ( mnkh_is_login_page() ) {
        nocache_headers();
    }
}
add_action('send_headers', 'mnkh_disable_login_page_cache');

// Enqueue Google reCAPTCHA script only on login pages
function mnkh_add_recaptcha_script() {
    if ( mnkh_is_login_page() ) {
        wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
    }
}
add_action( 'login_enqueue_scripts', 'mnkh_add_recaptcha_script' );

// Helper function to detect login page
function mnkh_is_login_page() {
    return in_array( $GLOBALS['pagenow'], array( 'wp-login.php' ) );
}
