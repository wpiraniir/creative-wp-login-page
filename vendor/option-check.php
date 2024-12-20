<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * CWLP Option Exist checker
 *
 * CWLP Option Exist checker is for work better plugin options
 *
 * @since 2.0
 */
 
$cwlpoptionnames=array(
	'cwlp-bshadow',
	'cwlp-fontfamily',
	'cwlp-logo-url',
	'cwlp-instagram',
	'cwlp-telegram',
	'cwlp-pinterest',
	'cwlp-whatsapp',
	'cwlp-facebook',
	'cwlp-twitter',
	'cwlp-linkedin',
	'cwlp-custom-logo',
	'cwlp-lswitch',
	'cwlp-custom-ibc',
	'cwlp-custom-ibu',
	'cwlp-login-urls',
	'cwlp-dmode'
);

$opt = isset($opt) ? $opt : '';
if (!option_exists( $opt )) {
		foreach($cwlpoptionnames as $opt) {
		add_option( $opt, '' );
	}
}

function option_exists($name, $site_wide=false){
    global $wpdb; return $wpdb->query("SELECT * FROM ". ($site_wide ? $wpdb->base_prefix : $wpdb->prefix). "options WHERE option_name ='$name' LIMIT 1");
}