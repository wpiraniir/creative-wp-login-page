<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * CWLP Funtion
 *
 * CWLP Funtion is responsible for work plugin options
 *
 * @since 1.0
 */

function cwlp_styles() {
	$cwlp_stylees = get_option( 'stylecwlp' );
	$shadows_cwlp = get_option( 'cwlp-bshadow' );
	$font_cwlp = get_option( 'cwlp-fontfamily' );
	$cwlp_custom_logo = get_option( 'cwlp-custom-logo' );
	$cwlp_imbc = get_option( 'cwlp-custom-ibc' );
	$cwlp_imbcu = get_option( 'cwlp-custom-ibu' );
		if ( $cwlp_stylees === '0' ) {
			echo '<style>#simplecaptcha{width:100%}.solve_this {display: flex;flex-direction: row;flex-wrap: wrap;justify-content: space-between;align-items: center;}.cwlp-num{font-family: vazir;}</style>';
		} elseif ( $cwlp_stylees === '0' && $shadows_cwlp === '1' ) {
			echo "<style>.login form{box-shadow: 0px 0px 15px -5px #000000 !important;}</style>";
		} elseif ($cwlp_stylees === '1' ) {
			wp_enqueue_style( 'cwlp-blue', CWLP_LOGIN_ASSETS . 'css/cwlp-blue.css', '', '1.0' );
			if( $shadows_cwlp === '1' ) {
			echo "<style>.login form{box-shadow: 0px 0px 13px 5px #2b3da1 !important;}</style>";
			}
		} elseif ( $cwlp_stylees === '2' ) {
			wp_enqueue_style( 'cwlp-red', CWLP_LOGIN_ASSETS . 'css/cwlp-red.css', '', '1.0' );
			if( $shadows_cwlp === '1' ) {
			echo "<style>.login form{box-shadow: 0px 0px 15px 5px #7e0404 !important;}</style>";
			}
		} elseif ( $cwlp_stylees === '3' ) {
			wp_enqueue_style( 'cwlp-green', CWLP_LOGIN_ASSETS . 'css/cwlp-green.css', '', '1.0' );
			// wp_enqueue_script( '-maingg-', CWLP_LOGIN_ASSETS . 'js/green.js', array( 'jquery') , '1' );
			if( $shadows_cwlp === '1' ) {
			echo "<style>.login form{box-shadow: 0px 0px 20px 2px #0d7611 !important;}</style>";
			}
		} elseif ( $cwlp_stylees === '4' ) {
			wp_enqueue_style( 'cwlp-purple', CWLP_LOGIN_ASSETS . 'css/cwlp-purple.css', '', '1.0' );
			// wp_enqueue_script( '-mainpp-', CWLP_LOGIN_ASSETS . 'js/purple.js', array( 'jquery') , '1' );
			if( $shadows_cwlp === '1' ) {
			echo "<style>.login form{box-shadow: 0px 0px 15px 5px #5318bd !important;}</style>";
			}
		} elseif ( $cwlp_stylees === '5' ) {
			wp_enqueue_style( 'cwlp-snow', CWLP_LOGIN_ASSETS . 'css/cwlp-snow.css', '', '1.0' );
			if( $shadows_cwlp === '1' ) {
			echo "<style>.login form{box-shadow: 0px 0px 13px 3px #c2bdbd !important;}</style>";
			}
		} elseif ( $cwlp_stylees === '6' ) {
			wp_enqueue_style( 'cwlp-technology', CWLP_LOGIN_ASSETS . 'css/cwlp-techno.css', '', '5.1' );
			if( $shadows_cwlp === '1' ) {
				echo "<style>.login form{box-shadow: 0px 0px 13px 3px #c2bdbd !important;}</style>";
			}
		} elseif ( $cwlp_stylees === '7' ) {
			wp_enqueue_style( 'cwlp-learning', CWLP_LOGIN_ASSETS . 'css/cwlp-learning.css', '', '5.1' );
			if( $shadows_cwlp === '1' ) {
				echo "<style>.login form{box-shadow: 0px 0px 13px 3px #c2bdbd !important;}</style>";
			}
		}
		
		wp_enqueue_style( 'cwlp-main', CWLP_LOGIN_ASSETS . 'css/fonts.css', '', '1.0' );
		if ($font_cwlp === '1' ) {
			echo "<style>body{font-family:vazir !important;}</style>";
		} elseif( $font_cwlp === '2' ) {
			echo "<style>body{font-family:yekan !important;}</style>";
		} elseif( $font_cwlp === '3' ) {
			echo "<style>body{font-family:samim !important;}</style>";
		} elseif( $font_cwlp === '4' ) {
			echo "<style>body{font-family:shabnam !important;}</style>";
		} elseif( $font_cwlp === '5' ) {
			echo "<style>body{font-family:estedad !important;}</style>";
		} elseif( $font_cwlp === '6' ) {
			echo "<style>body{font-family:lalezar !important;}.login label{font-size: 15px !important;}</style>";
		} elseif( $font_cwlp === '7' ) {
			echo "<style>body{font-family:sorkhpust !important;}.login *{font-size: 20px !important;}</style>";
		} elseif( $font_cwlp === '8' ) {
			echo "<style>body{font-family:casablanca !important;}</style>";
		} 
		if ( ! empty($cwlp_custom_logo) ) {
			echo "<style>body.login div#login h1 a {background-image: url(".$cwlp_custom_logo.");}</style>";
		}
		if ( empty($cwlp_imbcu) && ! empty($cwlp_imbc) ) {
			echo "<style>body {background-image: url(".$cwlp_imbc.") !important;height: 100% !important;background-position: center !important;background-repeat: no-repeat !important;-webkit-background-size: cover !important;-moz-background-size: cover !important; -o-background-size: cover !important;background-size: cover !important;}</style>";
		}
		if ( ! empty($cwlp_imbcu) ) {
			echo "<style>body {background-image: url(".$cwlp_imbcu.") !important;height: 100% !important;background-position: center !important;background-repeat: no-repeat !important;-webkit-background-size: cover !important;-moz-background-size: cover !important; -o-background-size: cover !important;background-size: cover !important;}</style>";
		}
		$cwlp_lswi = get_option( 'cwlp-lswitch' );
		if ( $cwlp_lswi === '1' ) {
			return add_filter( 'login_display_language_dropdown', '__return_false' );
		}
}
add_action( 'login_enqueue_scripts', 'cwlp_styles' );
function cwlp_custom_inline() {
    $style_c = '.login .message, .login .notice, .login .success { color: #000; }.solve_this {font-size: 1rem;}.login form .forgetmenot {margin-top: 7px;}.g-recaptcha iframe {width: 100%;}';
    wp_add_inline_style( 'cwlp-main', $style_c );
}
add_action( 'login_enqueue_scripts', 'cwlp_custom_inline' );

function cwlp_login_url_setup() {
	$cwlp_brandings = get_option( 'cwlp-logo-url' );
		if ( $cwlp_brandings === '0' ) {
			return get_bloginfo( 'url' );
        } elseif ($cwlp_brandings === '1' ) {
			return home_url();
		}
}
add_filter( 'login_headerurl', 'cwlp_login_url_setup' );

//choose what to do when disabling a login url endpoint
function cwlpl_disable_login_url() {
	$cwlplmes = get_option( 'cwlp-login-url-message' );
	$cwlpllsstyle = get_option( 'cwlp-login-error-style' );
	$message = !empty($cwlplmes) ? $cwlplmes : __('You do not have permission to access this page!', 'cwlp');
	if ( $cwlpllsstyle === '0' ) {
			wp_die('<pre>' . $message .'</pre><div id="cwlp-copyright"><p><a href="https://webmethod.ir/" target="_blank">' . __('Protected By Creative WP Login Page', 'cwlp') .'</p></div><style>@font-face {font-family: vazir;src:url(' . CWLP_LOGIN_ASSETS .'fonts/vazir.woff2);font-style:  normal;font-display: swap;}body, h1, h2, pre, p, div  {font-family: vazir;font-size: 1.2rem;}#cwlp-copyright p {text-align: center;}</style>');
	} elseif ( $cwlpllsstyle === '1' ) {
			wp_die( '<pre>' . $message .'</pre><div id="cwlp-copyright"><div class="cwlpcopright"><p><a href="https://webmethod.ir/" target="_blank">' . __('Protected By Creative WP Login Page', 'cwlp') .'</p></div></div><link  rel="stylesheet" href="' . CWLP_LOGIN_ASSETS .'css/cwlp-login-security-one.css" type="text/css" media="all" />' );
	} elseif ( $cwlpllsstyle === '2' ) {
			wp_die( '<pre>' . $message .'</pre><div id="cwlp-copyright"><div class="cwlpcopright"><p><a href="https://webmethod.ir/" target="_blank">' . __('Protected By Creative WP Login Page', 'cwlp') .'</p></div></div><link  rel="stylesheet" href="' . CWLP_LOGIN_ASSETS .'css/cwlp-login-security-two.css" type="text/css" media="all" />' );
	}
}

function creative_wordpress_login_page_set(){
	global $pagenow;
	if (isset($_GET['page']) && strpos($_GET['page'], 'cwlp-settings') === 0) {
		// wp_enqueue_style( 'cwlp-awesome-b', CWLP_LOGIN_ASSETS .'css/awesome/brands.css', '', '6.0' );
		if ( is_rtl() ) {
			wp_register_style('cwlp-sett', CWLP_LOGIN_ASSETS .'css/cwlp-setings-rtl.css', true);
		} else {
			wp_register_style('cwlp-sett', CWLP_LOGIN_ASSETS .'css/cwlp-setings.css', '2.0', true);
		}
		wp_enqueue_style('cwlp-sett' );
		$fa6b = '@font-face {font-family: "Font Awesome 6 Brands";src: url("data:font/woff2;charset=utf-8;base64,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") format("woff2");font-weight: normal;font-style: normal;font-display: swap;} .fab {font-family: "Font Awesome 6 Brands";font-weight: 400;font-style: normal;line-height: 0;}.fa-x-twitter:before {content: "\e61b";}.fa-instagram:before {content: "\f16d";}.fa-linkedin:before {content: "\f08c";}.fa-facebook:before {content: "\f09a";}.fa-whatsapp:before {content: "\f232";}.fa-telegram:before {content: "\f2c6";}.fa-pinterest:before {content: "\f0d2";}';
		wp_add_inline_style('cwlp-sett', $fa6b );
	}
		?>
		<style>li#toplevel_page_cwlp-settings a img {
    width: 25px !important;
    height: 25px !important;
    opacity: 1 !important;
}
li#toplevel_page_cwlp-settings .wp-menu-name {
	color: #ffffff;
	background: #2196f3;
	transition: background 0.2s linear 0.2s;
}
li#toplevel_page_cwlp-settings .wp-menu-name:hover {
    color: #ffffff;
    background: #e91e1e;
	transition: background 0.2s linear 0.2s;
}
body.toplevel_page_cwlp-settings {
    background: #fff;
}
</style>
<?php
	// }
}
add_action( 'admin_enqueue_scripts', 'creative_wordpress_login_page_set' );
