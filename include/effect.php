<?php
function cwlp_effect_styles() {
	$cwlp_efsty = get_option( 'cwlpeffecttype' );
	if ( $cwlp_efsty === '1' ) {
		wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/sqbubble.css', '', '1.0' );
		wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/sqbubble.js', '' , true );
	} elseif ( $cwlp_efsty === '2' ) {
		wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/cirbubble.css', '', '1.0' );
		wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/sqbubble.js', '' , true );
	} elseif ( $cwlp_efsty === '3' ) {
		wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/pulsating.css', '', '1.0' );
		wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/pulsating.js', array( 'jquery') , '1' );
	} elseif ( $cwlp_efsty === '4' ) {
		wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/badkonak.css', '', '1.0' );
		wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/sqbubble.js', '' , true );
	}
}
add_action( 'login_enqueue_scripts', 'cwlp_effect_styles' );

