<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;
use Inc\Api\Callbacks\CallbacksHelper;

class DashboardCallbacks extends BaseController
{


	public function adminSectionManager()
	{
		echo '';
	}

	function register()
	{
    $this->callbacks_helper = new CallbacksHelper();
	}


	public function dashboardCallbckFields( $args ) {
		$name = $args['label_for'];
		$option_name = $args['option_name'];
	}

	public function imageField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$options = get_option( $option_name );
    $value = isset( $options[$name] ) ? $options[$name] : "" ;

    $upload_button_title = ( ! empty( $value ) ) ? __('Edit', 'mb-topbar') : __('Upload', 'mb-topbar');
    $remove_button_title = __('Remove', 'mb-topbar');
    $logo_classes = ( ! empty( $value ) ) ? 'logo-image js-logo-image' : 'logo-image js-logo-image empty';

    echo "<div class='$logo_classes' style='background-image: url(";
    echo esc_url_raw($value);
    echo ");'></div>";
    echo "<button class='button button-secondary button-small js-logo-media-btn'>$upload_button_title</button>";
    echo "<button class='button button-secondary button-small js-logo-media-remove-btn'>$remove_button_title</button>";
		echo '<input type="text" hidden class="regular-text js-logo-url" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '">';
  }

	public function textField( $args )
	{
		$name = $args['label_for'];
		$helper = ( ! empty( $args['helper'] ) ) ? $args['helper'] : '';
		$option_name = $args['option_name'];
		$required = ($args['required'] == "yes")?"required":"";
    $value = '';

    $options = get_option( $option_name );
    $value = ! empty($options[$name]) ? $options[$name] : '';

    $helper_output = ( empty($helper ) ) ? '' : "<div class='mb-topbar__helper'>$helper</div>";

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" ' . $required . '>' . $helper_output;
  }

  public function checkboxField( $args )
	{
    $name = $args['label_for'];
    $helper = ( ! empty( $args['helper'] ) ) ? $args['helper'] : '';
		$classes = $args['class'];
		$option_name = $args['option_name'];

    $checkbox = get_option( $option_name );
    $checked = ! empty($checkbox[$name]) ?: false;

    $helper_output = ( empty($helper ) ) ? '' : "<div class='mb-topbar__helper'>$helper</div>";

    echo $this->callbacks_helper->checkboxToggleField($classes, $checked, $option_name, $name );
    echo $helper_output;

	}

}
