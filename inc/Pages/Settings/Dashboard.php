<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Pages\Settings;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\CallbacksHelper;
use Inc\Api\Callbacks\DashboardCallbacks;
use Inc\Api\Callbacks\TemplatesController;

class Dashboard extends BaseController
{
	public $settings,$callbacks,$callbacks_mngr,$callbacks_hand,$callbacks_helper;

	public $pages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new TemplatesController();

		$this->callbacks_mngr = new DashboardCallbacks();
		$this->callbacks_mngr->register();

		$this->callbacks_helper = new CallbacksHelper();



		$this->setPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
	}

	public function setPages()
	{
		$this->pages = array(
			array(
				'page_title' => 'MB Topbar',
				'menu_title' => 'MB Topbar',
				'capability' => 'manage_options',
				'menu_slug' => 'mb_topbar',
				'callback' => array( $this->callbacks, 'adminDashboard' ),
				'icon_url' => "dashicons-archive",
				'position' => 110
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'mb_topbar_settings',
				'option_name' => 'mb_topbar',
				'callback' => array( $this->callbacks_helper, 'sanitizeDashboardValues' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'mb_topbar_dashboard',
				'title' => '',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'mb_topbar'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
      array(
        'id' => "wp_logo_link",
        'title' => __( 'Logo', 'mb-topbar' ),
        'callback' => array( $this->callbacks_mngr, 'imageField' ),
        'page' => 'mb_topbar',
        'section' => 'mb_topbar_dashboard',
        'args' => array(
          'option_name' => 'mb_topbar',
          'label_for' => "wp_logo_link",
          "placeholder" => "link to logo"
        )
      ),
			array(
				'id' => 'select_title',
				'title' => __( 'Title', 'mb-topbar' ),
				'callback' => array( $this->callbacks_mngr, 'textField' ),
				'page' => 'mb_topbar',
				'section' => 'mb_topbar_dashboard',
				'args' => array(
					'option_name' => 'mb_topbar',
					'label_for' => 'select_title',
          'placeholder' => '',
          'required' => 'no',
          'helper' => __( 'Optional select title, between logo and select field', 'mb-topbar' ),
				)
			),
			array(
				'id' => 'custom_homepage',
				'title' => __( 'Custom Homepage', 'mb-topbar' ),
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'mb_topbar',
				'section' => 'mb_topbar_dashboard',
				'args' => array(
					'option_name' => 'mb_topbar',
					'label_for' => 'custom_homepage',
          'class' => 'ui-toggle',
          'helper' => __( 'This options allows you to name first item to show on the page, if unchecked first active item will be shown', 'mb-topbar' ),
				)
			),
    );

		$this->settings->setFields( $args );
	}

}
