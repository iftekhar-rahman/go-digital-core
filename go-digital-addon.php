<?php
/**
 * Plugin Name: Go Digital Addon
 * Description: Go Digital Addon
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Iftekhar Rahman
 * Author URI:  https://iftekharrahman.com/
 * Text Domain: go-digital-addon
 * 
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function go_digital_addon() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Go_Digital_Addon\Plugin::instance();

}
add_action( 'plugins_loaded', 'go_digital_addon' );