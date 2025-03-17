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
	$cwinsta   = get_option( 'cwlp-instagram' );
	$cwteleg   = get_option( 'cwlp-telegram' );
	$cwpinter  = get_option( 'cwlp-pinterest' );
	$cwwhats   = get_option( 'cwlp-whatsapp' );
	$cwfaceboo = get_option( 'cwlp-facebook' );
	$cwtwitt   = get_option( 'cwlp-twitter' );
	$cwlinked  = get_option( 'cwlp-linkedin' );
	$cwdmode   = get_option( 'cwlp-dmode' );

	if ( empty( $cwteleg ) && empty( $cwinsta ) && empty( $cwpinter ) && empty( $cwwhats ) && empty( $cwfaceboo ) && empty( $cwtwitt ) && empty( $cwlinked ) ) {
		wp_dequeue_style( 'social-bar' );
		wp_deregister_script( 'social-bar' );
	} else {
		add_action( 'login_footer', 'cwlp_social_foot' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'social-bar', CWLP_LOGIN_ASSETS . 'css/cwlp-socialer' . $direction . '.css', '', '2.0' );
		$fa6b = '@font-face {font-family: "Font Awesome 6 Brands";src: url("data:font/woff2;charset=utf-8;base64,d09GMgABAAAAAAiEAA0AAAAAESwAAAguAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP0ZGVE0cGh4GYACDAhEICpAIjCkLGgABNgIkAzAEIAWJVAeBAhtMDlGUb1KK7MsC25gW/K8Jk4yE8bC948E+vAKelC2tRuMvYm6ENtxiEzwPdGbvz0RccVbO5trJZouNmgJcqEoqZwsfQOd6EjzP3/yO3hdo5IGugVmExUUYr/3HJP4/5YFj/Pib/gMKozVtrPHuSELOoPxH5vz5a/XfLkZRmS1wFNWF4H82oVFBF217CzajR3BXa9utd0N7cUMt4q0SIVQSV/v98jfEfBsaKrRGSPfkqx+inkQtRVGNHgmRbiERKokhJDqx/cW8lg5gBx7gl/CiAAH45MKGOMD7q89IAHy65vI7EcAB5AAKgmBHMAAKYJD35CSMIJOkDxjr+vxKPnvzFYwqmrN4OBnhuTMn89AXhceekIf+H+QhQqVsg3K5rYZIVVJchNnCdrGwtgaWXSwLDyqGLwrTR9PnpF/5aRUfvyd+/g/ICOfsz53/lXuze6V7uOtc5xvON50xhwNBCyQmECIjCqDw7xGIOPnfUJs5YOT5ZIFyr6Va4GyAHBUDIhoaIyoK7Lcg35ptzCgItibGGc66YEF2fD5qYRCAJEJL1DB1exLHudwWLcq8bqc7d9ZsEVjjIrDBR8GKALX0Z8+xsUI96DkjgJJiRdrjeRnbyEnkInTInMMcnIHIy5RnRVFgBHIUdEnzAkYQSeFe7GfyMr3KZyuk/3SQIaT312CWD5W02esok1xTnr9dDS53Pyxd/j4/jQrtOO+fw9fYGGI/Cc51RbdxoddyFM3zBiQj0KmwK8q7IotIbIcZgSX2WaK9ybBW+lpBs3A8eSfLusyeg0cUWZHe8gdflyx+nq8l90EqX3VFXgYTTloFMc6Pt4ep6gRJE+GogYLX2eIeJwiCyrYfuQJFx4wA2PPVkY6+db9f+b2eZYvkMUvuMtxxuX/Svdf2JtWBrx6ukfQ498MwFZUgcTaKE0njqDK7wsUPiQiHQjnc7MtUILVmvjP/Pl7e8vTVv3Y8iLqKUVo2wEHzVIYk5+levEjSNAuRqKzbsu7H/atbmoC7bp/dUFRVU6CQ4uwiQ3ioaRgW7yaDlsvN0xK3eQ9vtTGrou1vlDNrk3OD1cx8cnF5Ga/jhuMzOBCjJUZA5bjIiyRpnJCQyXDIEVtECzYTVFFkkVJWDNNxyI49pn52cngtHAXN8y7b9cR3v9Y9f6puu5B3lgLnGQiUHFdNGJlU20kwiXOyu4I7I+baUTNC2W8Cz9ZcOaJ2QaHjwr+X4LWFNOH1XrQC4zPJtTMfNurn3nIRLGXqBJ24rN7JexZ0Uc1nm49b9ffVf8RbFHHtR8y48MKUi/k66Yj9uKS1JrsWb9Qf5ZjnGrjGM7rGFJwDq7uv+XmnxyKPqmUOvXcljFmhASkMWfT75/P3f+EG8qvuZjIBY8ujZdFIY7hxmcwn3nSTcwLbfKeeekHK5n5k7IoVJmXiyQ/UOt5MbF8ZVgsd9uffv+mjD/WPHzN8+tzSL/j9QWJmzEmSMWIkk2YzMVkSjAQjC9zXd4zrCDgPHmzIlp+AUaW5Rw67WsbYxrZfv8BNz5Ql/Nj0R6yu3z6U8tXPnq3Cwt+/zEo11BN2XXFlmKly7uFRxc88u63LqNbnGtTywSVTPQ0fvBh+6dl7HMqSJWjXXufvmHqewX0s8wdt1NYBzJ+/cmVhR5ZaEi+8/jqmEjObk724CR/6SeMGdxrSrvKBdFGm2x2LpUUanfWUR2rXDOXZN/U57Bv7bRMLA/Ee3VdVWVml6evjxkwWV2aakjbLtFDRkG9aTzygUoetUls+ev493eMpsprN1iIP8fee70EwLNKd7RHHe5OJR3frFq/dxO7dG9uXhDsW8FJR8csPO0c+UrJ2Q4ktKP7em15+2dmUa/4/aFd1j/FmRPX7DDI5Omwyk2b3ykRlciw6WXoORd7g9XBPfFh8Tvnw9VuLi78Z3hvdkVVJbU0wkLUwIhhN0/YL0QULFDV1YgUijDu8teucVz6+eeiOO4K9lRnTPcLvd8ZIkjRjJjbSuOL3fe1VmWFC05muz7/I863fb7vrzq++qc49s7xczvyvvCwyyjy+ntjXN5kvuXiPpsZsJtPK5tFZ2dVGY6RcNRoBQECFyI2TO89a6h75q0Up7FAszf8ryF2ABaWBmJ0AbpShtIHm4FDoIQ+Z5gojLZLO4obc3RbbUzHSWFvSxoQccSXiCtBDEIo5HhTM3AsqdZILBoplBxhpV7xgokDZDTYald/BTq46Czxkq2dt7cWsPoCKGKzAMCBAaGc6KLi4FlRm8CgYaJcwGFkv54KJYcoksDFPOR/sNKuV4KFeXXlWLy71BqIkSLKFtQzSzwDr0ailmzo3J06C1ahomE30so4RrkIteHdcVXfd9XWiw5t692w7Ro2voKGjEWEtnaymh3VozKCXfjawkk7WQks0mv5G89x3aW+TitysZuuasKkwphmf+Vqa6KKX9XTi74vEJr3ZJ4majqH+rH9YGXNy1rKOwbYjJieATlt/xvhotRkBcRs2UY3avmi9sS0TaUcb5rg6ODtZOKC3Nft8rQYO+Nqc3lptf3L/MFJLbSy0qKNrM4ipzUTYxKUkOmPcFDOLgX5nbIrpomb85awiwbohFCdnW15L8jQG6R5L0evoLeR2UKiFYRMkWMkKBtOaYdbbso7uqll3oYU8GzNyXe/6t8UljxpzVgyub2aJQGzRJOtop0WX9kHrTjKmmW6/Fa+0LexDkk6KPEZsKrUhs0UDZ/9BKGjndwCCIoqoYhCjmMQsFrGKzbxh9eAYvTXiesR9bVHLYJAdNo/57Vv1mIP/OL9ZVE8eo7eGAQA=") format("woff2");font-weight: normal;font-style: normal;font-display: swap;} .fab {font-family: "Font Awesome 6 Brands";font-weight: 400;font-style: normal;line-height: 0;}.fa-x-twitter:before {content: "\e61b";}.fa-instagram:before {content: "\f16d";}.fa-linkedin:before {content: "\f08c";}.fa-facebook:before {content: "\f09a";}.fa-whatsapp:before {content: "\f232";}.fa-telegram:before {content: "\f2c6";}.fa-pinterest:before {content: "\f0d2";}';
		wp_add_inline_style( 'social-bar', $fa6b );
		?>
		<style>
		<?php
		if ( $cwdmode === '0' ) {
			echo '.cwlp-icon-bar a {display: block;} @media screen and (max-width: 768px) {.cwlp-icon-bar a{display: inline-block !important;}}';
		} else {
			echo '.cwlp-icon-bar a {display: inline-block !important;}';
		}
		?>
		</style>
		<?php
	}
}

function cwlp_social_foot() {
	$cwinsta   = get_option( 'cwlp-instagram' );
	$cwteleg   = get_option( 'cwlp-telegram' );
	$cwpinter  = get_option( 'cwlp-pinterest' );
	$cwwhats   = get_option( 'cwlp-whatsapp' );
	$cwfaceboo = get_option( 'cwlp-facebook' );
	$cwtwitt   = get_option( 'cwlp-twitter' );
	$cwlinked  = get_option( 'cwlp-linkedin' );

	ob_start();
	?>
	<div class="cwlp-icon-bar" id="cwlp-social-n">
	<i class="dashicons dashicons-no close-bu" id="masoudnkh"></i>
	<div class="cwlpsociali">
			<?php if ( ! empty( $cwinsta ) ) : ?>
				<a href="https://www.instagram.com/<?php echo esc_attr($cwinsta); ?>" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
			<?php endif; ?>
			<?php if ( ! empty( $cwteleg ) ) : ?>
				<a href="https://t.me/<?php echo esc_attr($cwteleg); ?>" class="telegram" target="_blank"><i class="fab fa-telegram"></i></a>
			<?php endif; ?>
			<?php if ( ! empty( $cwpinter ) ) : ?>
				<a href="https://www.pinterest.com/<?php echo esc_attr($cwpinter); ?>" class="pinterest" target="_blank"><i class="fab fa-pinterest"></i></a>
			<?php endif; ?>
			<?php if ( ! empty( $cwwhats ) ) : ?>
				<a href="https://wa.me/<?php echo esc_attr($cwwhats); ?>" class="whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
			<?php endif; ?>
			<?php if ( ! empty( $cwfaceboo ) ) : ?>
				<a href="https://www.facebook.com/<?php echo esc_attr($cwfaceboo); ?>" class="facebook" target="_blank"><i class="fab fa-facebook"></i></a>
			<?php endif; ?>
			<?php if ( ! empty( $cwtwitt ) ) : ?>
				<a href="https://twitter.com/<?php echo esc_attr($cwtwitt); ?>" class="twitter" target="_blank"><i class="fab fa-x-twitter"></i></a>
			<?php endif; ?>
			<?php if ( ! empty( $cwlinked ) ) : ?>
				<a href="https://www.linkedin.com/in/<?php echo esc_attr($cwlinked); ?>" class="linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>
			<?php endif; ?>
		</div>
	</div>
	<?php

	$output = ob_get_clean();

	echo wp_kses_post($output);

	if ( empty( $cwteleg ) && empty( $cwinsta ) && empty( $cwpinter ) && empty( $cwwhats ) && empty( $cwfaceboo ) && empty( $cwtwitt ) && empty( $cwlinked ) ) {
		return;
	}

	?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
		  const iconBarIcons = document.querySelectorAll('.cwlp-icon-bar .dashicons');
		  const socialIcons = document.querySelector('.cwlpsociali');

		  if (!iconBarIcons || !socialIcons) {
			console.error("Elements not found. Check your selectors.");
			return;
		  }

		  socialIcons.style.overflow = 'hidden';
		  socialIcons.style.transition = 'max-height 0.6s ease-in-out';
		  const originalHeight = socialIcons.offsetHeight;
		  socialIcons.style.maxHeight = originalHeight + 'px';
		  socialIcons.style.display = 'block';

		  iconBarIcons.forEach(icon => {
			icon.addEventListener('click', function() {
			  this.classList.toggle('dashicons-no');
			  this.classList.toggle('dashicons-plus');
			  this.classList.toggle('adoni');

			  if (socialIcons.style.maxHeight === '0px') {
				socialIcons.style.maxHeight = originalHeight + 'px';
			  } else {
				socialIcons.style.maxHeight = '0px';
			  }
			});
		  });
		});
	</script>
	<?php
}

add_action( 'login_enqueue_scripts', 'cwlp_socials' );
