<?php
/**
 * @package  MBTopbar
 */
/*
Plugin Name: MB Topbar
Plugin URI: https://github.com/Tihi321/mbwp-topbar
Description: This plugin implements topbar
Version: 1.0.0
Author: Tihomir Selak
Author URI: https://www.tihomir-selak.from.hr
License: GPLv2 or later
Text Domain: mb-topbar
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_mb_topbar() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_mb_topbar' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_mb_topbar() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mb_topbar' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}
