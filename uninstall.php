<?php

if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();

	$options_array = array(
		'stylecwlp',
		'cwlploginposition',
		'cwlp-custom-ibc',
		'cwlp-custom-ibu',
		'cwlp-bshadow',
		'cwlp-fontfamily',
		'cwlp-logo-url',
		'cwlp-custom-logo',
		'cwlp-lswitch',
		'captcha_style',
		'recaptcha_site_key',
		'recaptcha_secret_key',
		'cwlp-dmode',
		'cwlp-instagram',
		'cwlp-telegram',
		'cwlp-pinterest',
		'cwlp-whatsapp',
		'cwlp-facebook',
		'cwlp-twitter',
		'cwlp-linkedin',
		'cwlp-login-urls',
		'cwlp-login-url-message',
		'cwlp-login-error-style',
		'cwlplabeluname',
		'cwlplabelpass',
		'cwlplabelremember',
		'cwlplabelpasslost',
		'cwlplabelogin',
		'cwlpeffecttype'
	);
	
foreach ($options_array as $option) {
	delete_option( $option );
}
?>