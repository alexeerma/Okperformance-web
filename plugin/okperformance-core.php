<?php
/**
 * Plugin Name: OKPerformance Core
 * Plugin URI:  https://okperformance.eu/
 * Description: Core content types, homepage options, and business logic for OKPerformance.
 * Version:     1.0.2
 * Author:      Alex
 * Author URI:  https://alexeerma.ee/
 * Text Domain: okperformance
 *
 * @package OKPerformanceCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OKPERFORMANCE_CORE_VERSION', '1.0.0' );
define( 'OKPERFORMANCE_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'OKPERFORMANCE_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load translations for shared OKPerformance strings.
 *
 * @return void
 */
function okperformance_core_load_textdomain() {
	load_plugin_textdomain( 'okperformance', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'okperformance_core_load_textdomain' );

require_once OKPERFORMANCE_CORE_PATH . 'includes/services.php';
require_once OKPERFORMANCE_CORE_PATH . 'includes/packages.php';
require_once OKPERFORMANCE_CORE_PATH . 'includes/home-options.php';
require_once OKPERFORMANCE_CORE_PATH . 'includes/security.php';

/**
 * Flush rewrite rules after the core plugin is activated.
 *
 * @return void
 */
function okperformance_core_activate() {
	if ( function_exists( 'okperformance_register_services_post_type' ) ) {
		okperformance_register_services_post_type();
	}

	if ( function_exists( 'okperformance_register_packages_post_type' ) ) {
		okperformance_register_packages_post_type();
	}

	if ( function_exists( 'okperformance_home_register_current_wpml_strings' ) ) {
		okperformance_home_register_current_wpml_strings();
	}

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'okperformance_core_activate' );

/**
 * Flush rewrite rules after the core plugin is deactivated.
 *
 * @return void
 */
function okperformance_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'okperformance_core_deactivate' );
