<?php
function cwlp_effect_styles() {
    $cwlp_efsty = get_option( 'cwlpeffecttype' );
    if ( $cwlp_efsty === '1' ) {
        wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/sqbubble.css', [], CWLP_VER, null );
        wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/sqbubble.js', [], CWLP_VER, true );
    } elseif ( $cwlp_efsty === '2' ) {
        wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/cirbubble.css', [], CWLP_VER, null );
        wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/sqbubble.js', [], CWLP_VER, true );
    } elseif ( $cwlp_efsty === '3' ) {
        wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/pulsating.css', [], CWLP_VER, null );
        wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/pulsating.js', [], CWLP_VER, true );
    } elseif ( $cwlp_efsty === '4' ) {
        wp_enqueue_style( 'cwlp-effect-style', CWLP_LOGIN_ASSETS . 'effect/css/badkonak.css', [], CWLP_VER, null );
        wp_enqueue_script( 'cwlp-effect-script', CWLP_LOGIN_ASSETS . 'effect/js/sqbubble.js', [], CWLP_VER, true );
    } elseif ( $cwlp_efsty === '5' ) {
		$cwlp5 = '#snow-canvas {position: fixed;top: 0;left: 0;width: 100%;height: 100%;pointer-events: none;z-index: 9999;}';
		wp_add_inline_style( 'cwlp-main', $cwlp5 );
	} elseif ( $cwlp_efsty === '6' ) {
		$cwlp5 = '#wp-login {position:relative;z-index: 1;}body {background: #333;}snow-fall {--snow-fall-size: 1.5em;--snow-fall-color: rgba(255,255,255,0.8);}snow-fall > *{will-change: transform, opacity;}';
		wp_add_inline_style( 'cwlp-main', $cwlp5 );
	}
}

add_action( 'login_enqueue_scripts', 'cwlp_effect_styles', 100 );

function cwlp_snowfall() {
    $cwlp_efst = get_option( 'cwlpeffecttype' );
    if ( $cwlp_efst === '5' ) {
        echo '<canvas id="snow-canvas"></canvas>';

        // Output the script tag directly.
        echo '<script src="'. esc_url(CWLP_LOGIN_ASSETS . 'effect/js/snb.js').'"></script>';
    } elseif ( $cwlp_efst === '6' ) {
		echo '<snow-fall mode="page" id="snow-component" text="❄"></snow-fall>';
        echo '<script src="'. esc_url(CWLP_LOGIN_ASSETS . 'effect/js/snf.js').'"></script>';
    }
}
add_action( 'login_footer', 'cwlp_snowfall', 9999 );