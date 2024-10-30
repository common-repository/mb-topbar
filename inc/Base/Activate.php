<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'mb_topbar' ) ) {
			update_option( 'mb_topbar', $default );
		}

		if ( ! get_option( 'mb_topbar_list' ) ) {
			update_option( 'mb_topbar_list', $default );
		}

	}
}
