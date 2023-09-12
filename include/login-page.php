<?php

/* Change Login URL
/***********************************************************************/
$cwlpl_wp_login = false;

$cwpllu = get_option( 'cwlp-login-urls' );
if(!empty($cwpllu)) {
	add_action('plugins_loaded', 'cwlpl_login_url_plugins_loaded', 2);
	add_action('wp_loaded', 'cwlpl_wp_loaded');
	add_action('setup_theme', 'cwlpl_disable_customize_php', 1);
	add_filter('site_url', 'cwlpl_site_url', 10, 4);
	add_filter('network_site_url', 'cwlpl_network_site_url', 10, 3);
	add_filter('wp_redirect', 'cwlpl_wp_redirect', 10, 2);
	add_filter('site_option_welcome_email', 'cwlpl_welcome_email');
	add_filter('admin_url', 'cwlpl_admin_url');
	remove_action('template_redirect', 'wp_redirect_admin_locations', 1000);
}

function cwlpl_site_url($url, $path, $scheme, $blog_id) {
	return cwlpl_filter_wp_login($url, $scheme);
}

function cwlpl_network_site_url($url, $path, $scheme) {
	return cwlpl_filter_wp_login($url, $scheme);
}

function cwlpl_wp_redirect($location, $status) {
	return cwlpl_filter_wp_login($location);
}

function cwlpl_filter_wp_login($url, $scheme = null) {

	//wp-login.php Being Requested
	if(strpos($url, 'wp-login.php') !== false) {

		//Set HTTPS Scheme if SSL
		if(is_ssl()) {
			$scheme = 'https';
		}

		//Check for Query String and Craft New Login URL
		$query_string = explode('?', $url);
		if(isset($query_string[1])) {
			parse_str($query_string[1], $query_string);
			if(isset($query_string['login'])) {
				$query_string['login'] = rawurlencode($query_string['login']);
			}
			$url = add_query_arg($query_string, cwlpl_login_url($scheme));
		} 
		else {
			$url = cwlpl_login_url($scheme);
		}
	}

	//Return Finished Login URL
	return $url;
}

function cwlpl_login_url($scheme = null) {

	//Return Full New Login URL Based on Permalink Structure
	if(get_option('permalink_structure')) {
		return cwlpl_trailingslashit(home_url('/', $scheme) . cwlpl_login_slug());
	} 
	else {
		return home_url('/', $scheme) . '?' . cwlpl_login_slug();
	}
}

function cwlpl_trailingslashit($string) {

	//Check for Permalink Trailing Slash and Add to String
	if((substr(get_option('permalink_structure'), -1, 1)) === '/') {
		return trailingslashit($string);
	}
	else {
		return untrailingslashit($string);
	}
}

function cwlpl_login_slug() {

	$cwpllu = get_option( 'cwlp-login-urls' );

	//Return Login URL Slug if Available
	if(!empty($cwpllu)) {
		return $cwpllu;
	} 
}

function cwlpl_login_url_plugins_loaded() {

	//Declare Global Variables
	global $pagenow;
	global $cwlpl_wp_login;

	//Parse Requested URI
	$URI = parse_url($_SERVER['REQUEST_URI']);
	$path = !empty($URI['path']) ? untrailingslashit($URI['path']) : '';
	$slug = cwlpl_login_slug();

	//Non Admin wp-login.php URL
	if(!is_admin() && (strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-login.php') !== false || $path === site_url('wp-login', 'relative'))) {

		//Set Flag
		$cwlpl_wp_login = true;

		//Prevent Redirect to Hidden Login
		$_SERVER['REQUEST_URI'] = cwlpl_trailingslashit('/' . str_repeat('-/', 10));
		$pagenow = 'index.php';
	} 
	//wp-register.php
	elseif(!is_admin() && (strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-register.php') !== false || strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-signup.php') !== false || $path === site_url('wp-register', 'relative'))) {

		//Set Flag
		$cwlpl_wp_login = true;

		//Prevent Redirect to Hidden Login
		$_SERVER['REQUEST_URI'] = cwlpl_trailingslashit('/' . str_repeat('-/', 10));
		$pagenow = 'index.php';
	}
	//Hidden Login URL
	elseif($path === home_url($slug, 'relative') || (!get_option('permalink_structure') && isset($_GET[$slug]) && empty($_GET[$slug]))) {
		
		//Override Current Page w/ wp-login.php
		$pagenow = 'wp-login.php';
	}
}

function cwlpl_wp_loaded() {

	//Declare Global Variables
	global $pagenow;
	global $cwlpl_wp_login;

	//Parse Requested URI
	$URI = parse_url($_SERVER['REQUEST_URI']);

	//Disable Normal WP-Admin
	if(is_admin() && !is_user_logged_in() && !defined('WP_CLI') && !defined('DOING_AJAX') && $pagenow !== 'admin-post.php' && (isset($_GET) && empty($_GET['adminhash']) && empty($_GET['newuseremail']))) {
		cwlpl_disable_login_url();
	}

	//Requesting Hidden Login Form - Path Mismatch
	if($pagenow === 'wp-login.php' && $URI['path'] !== cwlpl_trailingslashit($URI['path']) && get_option('permalink_structure')) {

		//Local Redirect to Hidden Login URL
		$URL = cwlpl_trailingslashit(cwlpl_login_url()) . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
		wp_safe_redirect($URL);
		die();
	}
	//Requesting wp-login.php Directly, Disabled
	elseif($cwlpl_wp_login) {
		cwlpl_disable_login_url();
	} 
	//Requesting Hidden Login Form
	elseif($pagenow === 'wp-login.php') {

		//Declare Global Variables
		global $error, $interim_login, $action, $user_login;
		
		//User Already Logged In
		if(is_user_logged_in() && !isset($_REQUEST['action'])) {
			wp_safe_redirect(admin_url());
			die();
		}

		//Include Login Form
		@require_once ABSPATH . 'wp-login.php';
		die();
	}
}

function cwlpl_disable_customize_php() {

	//Declare Global Variable
	global $pagenow;

	//Disable customize.php from Redirecting to Login URL
	if(!is_user_logged_in() && $pagenow === 'customize.php') {
		cwlpl_disable_login_url();
	}
}

function cwlpl_welcome_email($value) {

	//Declare Global Variable
	global $cwlpllu;

	//Check for Custom Login URL and Replace
	if(!empty($cwlpllu)) {
		$value = str_replace(array('wp-login.php', 'wp-admin'), trailingslashit($cwlpllu), $value);
	}

	return $value;
}

function cwlpl_admin_url($url) {

	//Check for Multisite Admin
	if(is_multisite() && ms_is_switched() && is_admin()) {

		global $current_blog;

		//Get Current Switched Blog
		$switched_blog_id = get_current_blog_id();

		if($switched_blog_id != $current_blog->blog_id) {

			$cwlpl_blog_options = get_blog_option($switched_blog_id, 'cwlpl_options');

			//Swap Custom Login URL Only with Base /wp-admin/ Links
			if(!empty($cwlpl_blog_options['login_url'])) {
				$url = preg_replace('/\/wp-admin\/$/', '/' . $cwlpl_blog_options['login_url'] . '/', $url);
			} 
		}
	}

	return $url;
}

function gettext_filter($translation, $orig, $domain) {
    switch($orig) {
		
        case 'Username or Email Address':
		if ( ! empty( get_option( 'cwlplabeluname' ) ) ) {
            $translation = get_option( 'cwlplabeluname' );
		}
            break;
		
        case 'Password':
		if ( ! empty( get_option( 'cwlplabelpass' ) ) ) {
            $translation = get_option( 'cwlplabelpass' );
		}
            break;
		
		case 'Remember Me';
		if ( ! empty( get_option( 'cwlplabelremember' ) ) ) {
            $translation = get_option( 'cwlplabelremember' );
		}
            break;
		
		case 'Lost your password?';
		if ( ! empty( get_option( 'cwlplabelpasslost' ) ) ) {
            $translation = get_option( 'cwlplabelpasslost' );
		}
            break;
			
		case 'Log In';
		if ( ! empty( get_option( 'cwlplabelogin' ) ) ) {
            $translation = get_option( 'cwlplabelogin' );
		}
            break;
    }
    return $translation;
}

function get_current_url() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "۸۰") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

$url = get_current_url();

if ( $GLOBALS['pagenow'] === 'wp-login.php' || ! empty( get_option( 'cwlp-login-urls' ) ) && strpos($url, get_option( 'cwlp-login-urls' )) ) {
    add_filter('gettext', 'gettext_filter', 10, 3);
}

/* Login form position */
if ( empty( get_option( 'cwlploginposition' ) ) ) {
	add_option( 'cwlploginposition', '1' );
}
function cwlp_posotion_style() {
	if ( get_option( 'cwlploginposition' ) === '0' ) {
		echo '<style>#login {margin: auto auto 0 0 !important;}.language-switcher {text-align: left !important;}</style>';
	} elseif ( get_option( 'cwlploginposition' ) === '2' ) {
		echo '<style>#login {margin: auto 0 !important;}.language-switcher {text-align: right!important;}</style>';
	}
}
if ( ! wp_is_mobile() ) {
	add_action( 'login_enqueue_scripts', 'cwlp_posotion_style' );
}