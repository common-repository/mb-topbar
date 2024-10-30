<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Base;

use Inc\Base\BaseController;

class ActionLinks extends BaseController
{
	public function register()
	{
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
	}

	public function settings_link( $links )
	{
		$settings_link = '<a href="admin.php?page=mb_topbar">' . esc_html__( 'Settings', 'mb-topbar' ) . '</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}
