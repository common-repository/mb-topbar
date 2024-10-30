<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Base;

class BaseController
{
	public $plugin_path,$plugin_url,$plugin;

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . 'mb-topbar.php';

	}

	public function activated( string $key )
	{
		$option = get_option( 'mb_topbar' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
  }

}
