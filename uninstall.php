<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  MBTopbar
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Access the database via SQL
global $wpdb;

$sql_topbar = $wpdb->prepare( "DELETE FROM wp_options WHERE option_name = 'mb_topbar'" );
$sql_topbar_list = $wpdb->prepare( "DELETE FROM wp_options WHERE option_name = 'mb_topbar_list'" );

$topbar_result = $wpdb->get_results( $sql_topbar , ARRAY_A );
$topbar_list_result = $wpdb->get_results( $sql_topbar_list , ARRAY_A );
