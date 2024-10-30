<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Base;

use Inc\Base\BaseController;

class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdmin' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueFront' ) );
	}

	function enqueueAdmin() {

    // enqueue only on setting page
    if( ( ! empty($_GET["page"] ) && $_GET["page"] == "mb_topbar" ) || ( ! empty($_GET["page"] ) && $_GET["page"] == "mb_topbar_list_page" ) ) {

      wp_enqueue_media();
      wp_enqueue_script( 'wp-i18n' );

      $main_admin_style = $this->plugin_url . 'skin/public/styles/adminTopBar.css';
      wp_register_style( 'mbwp-admin-style', $main_admin_style, '', '1.0.0', false );
      wp_enqueue_style( 'mbwp-admin-style' );


      $main_admin_script = $this->plugin_url . 'skin/public/scripts/adminTopBar.js';
      wp_register_script( 'mbwp-admin-scripts', $main_admin_script, array('jquery','wp-color-picker' ), '1.0.0', true );
      wp_enqueue_script( 'mbwp-admin-scripts' );
    }
	}

	function enqueueFront() {

    // load only on topbar page template
    if ( get_page_template_slug() ===  'frontpage.php' ) {
      $main_admin_style = $this->plugin_url . 'skin/public/styles/applicationTopBar.css';
      wp_register_style( 'mbwp-frontend-style', $main_admin_style, '', '1.0.0', false );
      wp_enqueue_style( 'mbwp-frontend-style' );



      wp_deregister_script( 'jquery' );

      wp_enqueue_script( 'wp-element' );
      wp_enqueue_script( 'wp-components' );
      wp_enqueue_script( 'wp-i18n' );
      wp_enqueue_script( 'react' );
      wp_enqueue_script( 'react-dom' );

      $main_script = $this->plugin_url . 'skin/public/scripts/applicationTopBar.js';
      wp_register_script( 'mbwp-scripts', $main_script, array(), '1.0.0', true );
      wp_enqueue_script( 'mbwp-scripts' );

      wp_localize_script(
       'mbwp-scripts',
        'topbarOptions',
        array(
            "homeUrl" => esc_url_raw( site_url() ),
            'restUrl' => esc_url_raw( rest_url() . 'mbwp-topbar/v1/api' ),
        )
      );
    }
	}
}
