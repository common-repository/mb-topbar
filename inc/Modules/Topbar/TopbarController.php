<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Modules\Topbar;


use Inc\Modules\Topbar\TopbarBuilder;
use Inc\Modules\Topbar\PageTemplater;
use Inc\Base\BaseController;
use Inc\Modules\Base\ModulesController;

class TopbarController extends BaseController
{
    private $layout_builder,$code;


    function register(){

        $this->layout_builder = new TopbarBuilder();
        $this->layout_builder->register();
        $this->code = $this->layout_builder->getTopbarBuilderCode();

        $this->registerRouteApi();
        add_action( 'plugins_loaded', array( $this, 'registerPageTemplate' ) );
    }

    function registerRouteApi(){
        add_action( 'rest_api_init', function () {
            register_rest_route( 'mbwp-topbar/v1', '/api', array(
                'methods' => 'GET',
                'callback' => array($this,'routeApiCallback'),
            ));
        });
    }

    function routeApiCallback() {
        return $this->code;
    }

    function registerPageTemplate() {
      $page_temaplte = new PageTemplater();
    }
}
