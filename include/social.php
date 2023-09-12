<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * CWLP Social Funtion
 *
 * CWLP Social Funtion is responsible for work plugin social bar options
 *
 * @since 2.0
 */

function cwlp_socials() {
	$direction = is_rtl() ? '-rtl' : '';
	$cwinsta = get_option( 'cwlp-instagram' );
	$cwteleg = get_option( 'cwlp-telegram' );
	$cwpinter = get_option( 'cwlp-pinterest' );
	$cwwhats = get_option( 'cwlp-whatsapp' );
	$cwfaceboo = get_option( 'cwlp-facebook' );
	$cwtwitt = get_option( 'cwlp-twitter' );
	$cwlinked = get_option( 'cwlp-linkedin' );
	if (empty($cwteleg) && empty($cwinsta) && empty($cwpinter) && empty($cwapar) && empty($cwfaceboo) && empty($cwtwitt) && empty($cwlinked)) {
		wp_dequeue_style( 'social-bar' );
		wp_deregister_script( 'social-bar' );
	} else {
		add_action( 'login_footer', 'cwlp_social_foot' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'social-bar', CWLP_LOGIN_ASSETS .'css/cwlp-socialer'.$direction.'.css', array( 'font-awesome' ), '2.0' );
	}
	function cwlp_social_foot() {
		$cwinsta = get_option( 'cwlp-instagram' );
		$cwteleg = get_option( 'cwlp-telegram' );
		$cwpinter = get_option( 'cwlp-pinterest' );
		$cwwhats = get_option( 'cwlp-whatsapp' );
		$cwfaceboo = get_option( 'cwlp-facebook' );
		$cwtwitt = get_option( 'cwlp-twitter' );
		$cwlinked = get_option( 'cwlp-linkedin' );
		echo '<div class="cwlp-icon-bar" id="cwlp-social-n">' . PHP_EOL;
			echo '<i class="fa fa-times-circle fa-2x close-bu" id="masoudnkh"></i>' . PHP_EOL;
				echo '<div class="cwlpsociali">' . PHP_EOL;
					if ( ! empty($cwinsta ) ) {
						echo '<a href="https://www.instagram.com/'.$cwinsta.'" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a>' . PHP_EOL;
					}
					if ( ! empty($cwteleg ) ) {
						echo '<a href="https://t.me/'.$cwteleg.'" class="telegram" target="_blank"><i class="fa fa-telegram"></i></a>' . PHP_EOL;
					}
					if ( !empty( $cwpinter ) ) {
						echo '<a href="https://www.pinterest.com/'.$cwpinter.'" class="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>' . PHP_EOL;
					}
					if ( !empty( $cwwhats ) ) {
						echo '<a href="https://wa.me/'.$cwwhats.'" class="whatsapp" target="_blank"><i class="fa fa-whatsapp"></i></a>' . PHP_EOL;
					}
					if ( !empty( $cwfaceboo ) ) {
						echo '<a href="https://www.facebook.com/'.$cwfaceboo.'" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>' . PHP_EOL;
					}
					if ( !empty( $cwtwitt ) ) {
						echo '<a href="https://twitter.com/'.$cwtwitt.'" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>' . PHP_EOL;
					}
					if ( !empty( $cwlinked ) ) {
						echo '<a href="https://www.linkedin.com/in/'.$cwlinked.'" class="linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>' . PHP_EOL;
					}
				echo '</div>' . PHP_EOL;
			echo '</div>' . PHP_EOL;
			if (empty($cwteleg) && empty($cwinsta) && empty($cwpinter) && empty($cwapar) && empty($cwfaceboo) && empty($cwtwitt) && empty($cwlinked)) {
			
			} else {
				echo '<script>jQuery(function($){$(".fa").click(function(){$(this).toggleClass("fa-times-circle fa-plus-circle adoni");});$(".fa").click(function(){$(".cwlpsociali").toggle("slow",function(){});});});</script>';
			}
	}
}

add_action( 'login_enqueue_scripts', 'cwlp_socials' );
