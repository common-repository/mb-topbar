<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Pages\Settings;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\CallbacksHelper;
use Inc\Api\Callbacks\TopbarCallbacks;
use Inc\Api\Callbacks\TemplatesController;

/**
*
*/
class TopbarController extends BaseController
{
	public $settings,$callbacks,$callbacks_helper,$topbar_callback;

	public $subpages = array();

	public $custom_post_types = array();

	public function register()
	{

		$this->settings = new SettingsApi();

		$this->callbacks = new TemplatesController();

		$this->topbar_callback = new TopbarCallbacks();
		$this->topbar_callback->register();

		$this->callbacks_helper = new CallbacksHelper();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();

		$this->settings->addSubPages( $this->subpages )->register();
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'mb_topbar',
				'page_title' => '',
				'menu_title' => 'Showcase',
				'capability' => 'manage_options',
				'menu_slug' => 'mb_topbar_list_page',
				'callback' => array( $this->callbacks, 'topbarTemplate' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'mb_topbar_list_settings',
				'option_name' => 'mb_topbar_list',
				'callback' => array( $this->callbacks_helper, 'topbarSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'mb_topbar_list_page_index',
				'title' => '',
				'callback' => array( $this->topbar_callback, 'bannersSectionManager' ),
				'page' => 'mb_topbar_list_page'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'activate',
				'title' => __( 'Activate', 'mb-topbar' ),
				'callback' => array( $this->topbar_callback, 'checkboxField' ),
				'page' => 'mb_topbar_list_page',
				'section' => 'mb_topbar_list_page_index',
				'args' => array(
					'option_name' => 'mb_topbar_list',
					'label_for' => 'activate',
          'class' => 'ui-toggle',
          'helper' => __( 'Only activated items will be shown in the menu', 'mb-topbar' ),
				)
			),
			array(
				'id' => 'is_home',
				'title' => __( 'Homepage', 'mb-topbar' ),
				'callback' => array( $this->topbar_callback, 'checkboxField' ),
				'page' => 'mb_topbar_list_page',
				'section' => 'mb_topbar_list_page_index',
				'args' => array(
					'option_name' => 'mb_topbar_list',
					'label_for' => 'is_home',
          'class' => 'ui-toggle',
          'helper' => __( 'If custom homepage is checked this is homepage', 'mb-topbar' ),
				)
			),

			array(
				'id' => 'title',
				'title' => __( 'Showcase Name', 'mb-topbar' ),
				'callback' => array( $this->topbar_callback, 'textField' ),
				'page' => 'mb_topbar_list_page',
				'section' => 'mb_topbar_list_page_index',
				'args' => array(
					'option_name' => 'mb_topbar_list',
					'label_for' => 'title',
					'placeholder' => '',
          'required' => 'yes',
          'helper' => __( 'This name is for menu on top of the page', 'mb-topbar' ),
				)
			),

			array(
				'id' => 'slug',
				'title' => __( 'Slug', 'mb-topbar' ),
				'callback' => array( $this->topbar_callback, 'textField' ),
				'page' => 'mb_topbar_list_page',
				'section' => 'mb_topbar_list_page_index',
				'args' => array(
					'option_name' => 'mb_topbar_list',
					'label_for' => 'slug',
					'placeholder' => 'slug-address',
          'required' => 'yes',
          'helper' => __( 'This is the slug for the page, it appears in address bar. Slug should be unique from other items.', 'mb-topbar' ),
				)
			),

			array(
				'id' => 'link',
				'title' => __( 'Showcase Website', 'mb-topbar' ),
				'callback' => array( $this->topbar_callback, 'textField' ),
				'page' => 'mb_topbar_list_page',
				'section' => 'mb_topbar_list_page_index',
				'args' => array(
					'option_name' => 'mb_topbar_list',
					'label_for' => 'link',
					'placeholder' => 'link',
          'required' => 'yes',
          'helper' => __( 'Link to the showcase, this link will be in the iframe below menu', 'mb-topbar' ),
				)
			),
			array(
				'id' => "color",
				'title' => __( "Topbar BG Color", 'mb-topbar' ),
				'callback' => array( $this->topbar_callback, 'colorField' ),
				'page' => 'mb_topbar_list_page',
				'section' => 'mb_topbar_list_page_index',
				'args' => array(
					'option_name' => 'mb_topbar_list',
          'label_for' => "color",
          'helper' => __( 'This is custom color of the topbar', 'mb-topbar' ),
				)
			),

		);

		$this->settings->setFields( $args );
	}

}
