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
		if ( $cwlp_stylees === '0' && $shadows_cwlp === '1' ) {
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
		
		wp_enqueue_style( 'cwlp-font', CWLP_LOGIN_ASSETS . 'css/fonts.css', '', '1.0' );
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
	wp_enqueue_style( 'cwlp-awesome-b', CWLP_LOGIN_ASSETS .'css/awesome/brands.css', '', '6.0' );
	if ( is_rtl() ) {
		wp_register_style('cwlp-sett', CWLP_LOGIN_ASSETS .'css/cwlp-setings-rtl.css', true);
	} else {
		wp_register_style('cwlp-sett', CWLP_LOGIN_ASSETS .'css/cwlp-setings.css', '2.0', true);
	}
    wp_enqueue_style('cwlp-sett' ); 
}
add_action( 'admin_enqueue_scripts', 'creative_wordpress_login_page_set' );
