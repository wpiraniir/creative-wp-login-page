<?php defined( 'ABSPATH' ) or die( 'This script cannot be accessed directly.' );

/**
 * Plugin Name: Creative WP Login Page
 * Plugin URI: https://wordpress.org/plugins/creative-wp-login-page/
 * Description: Creative WordPress login page plugin makes your login page more beautiful.
 * Author: WP irani
 * Author URI: https://wpirani.ir/
 * Version: 10.1
 * Text Domain: cwlp
 * Domain Path: /langs
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

define( 'CWLP_LOGIN_FOLDER', plugin_dir_path( __FILE__ ) );
define( 'CWLP_LOGIN_PATH', plugin_dir_url( __FILE__ ) );
define( 'CWLP_LOGIN_ASSETS', CWLP_LOGIN_PATH . 'assets/' );
define( 'CWLP_VER', '10.1' );

update_option( 'cwlp_version', CWLP_VER );

load_plugin_textdomain( 'cwlp', false, dirname( plugin_basename( __FILE__ ) ) . '/langs' );

function cwlp_set_page( $links ) {
	$settings_link = '<a href="admin.php?page=cwlp-settings">' . __( 'Settings', 'cwlp' ) . '</a>';
	array_unshift( $links, $settings_link );
	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'cwlp_set_page' );


function cwlp_upgrader() {
    $simple_version = get_option('simple_style', true);
		if ( '0' != $simple_version ) {
			add_option('simple_style', '1');
		}
	}
add_action('plugins_loaded', 'cwlp_upgrader' );

require_once __DIR__ . '/options/options-framework.php';

function has_image_processing_extension() {
	return extension_loaded('gd');
}

require_once CWLP_LOGIN_FOLDER . 'include/settings.php';
require_once CWLP_LOGIN_FOLDER . 'include/init.php';
require_once CWLP_LOGIN_FOLDER . 'include/login-page.php';
require_once CWLP_LOGIN_FOLDER . 'include/social.php';
require_once CWLP_LOGIN_FOLDER . 'include/effect.php';
require_once CWLP_LOGIN_FOLDER . 'include/captcha.php';
require_once CWLP_LOGIN_FOLDER . 'vendor/option-check.php';


