<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Modules\Topbar;

use Inc\Modules\Topbar\DatabaseController;

class TopbarBuilder extends DatabaseController
{

    private $layout_options = array();
    private $db_controller;

	function register() {
        $this->db_controller = new DatabaseController();
        $this->layout_options = $this->db_controller->getLayoutOptions();
    }

    function getTopbarBuilderCode(){
        return $this->layout_options;
    }

}