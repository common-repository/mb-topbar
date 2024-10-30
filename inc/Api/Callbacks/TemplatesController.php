<?php 
/**
 * @package  MBTopbar
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class TemplatesController extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/dashboard.php" );
	}

	public function topbarTemplate()
	{
		return require_once( "$this->plugin_path/templates/topbar.php" );
	}

}