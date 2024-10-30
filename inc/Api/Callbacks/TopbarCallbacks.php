<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Api\Callbacks;

use Inc\Api\Callbacks\CallbacksHelper;

class TopbarCallbacks
{

	public $callbacks_helper;

	public function bannersSectionManager()
	{
		echo '';
	}

	function register()
	{

		$this->callbacks_helper = new CallbacksHelper();

	}


	public function checkColor( $value ) {

		if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #
			return true;
		}

		return false;
	}

	public function textField( $args )
	{
		$name = $args['label_for'];
		$helper = ( ! empty( $args['helper'] ) ) ? $args['helper'] : '';
		$option_name = $args['option_name'];
		$required = ($args['required'] == "yes")?"required":"";
		$value = '';

		if ( isset($_POST["edit_post"]) ) {
      $input = get_option( $option_name );
      $value = isset( $input[$_POST["edit_post"]][$name] ) ? $input[$_POST["edit_post"]][$name] : '';
    }

    $helper_output = ( empty($helper ) ) ? '' : "<div class='mb-topbar__helper'>$helper</div>";

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" ' . $required . '>' . $helper_output;
	}

	public function colorField( $args )
	{
		$name = $args['label_for'];
    $option_name = $args['option_name'];
    $helper = ( ! empty( $args['helper'] ) ) ? $args['helper'] : '';
		$options = get_option( $option_name );
		$value = "";

		if ( isset($_POST["edit_post"]) ) {
			$input = get_option( $option_name );
			$value = isset( $input[$_POST["edit_post"]][$name] ) ? $input[$_POST["edit_post"]][$name] : '';
    }

    $helper_output = ( empty($helper ) ) ? '' : "<div class='mb-topbar__helper'>$helper</div>";

    $pick_color_text = __('Choose Color', 'mb-topbar');

    $output = '<div class="color-picker-color js-color-picker-color"';
    $output .= ' style=background-color:';
    $output .= $value;
    $output .= ';';
    $output .= '></div>';
		$output .= "<button class='button button-secondary button-small js-color-picker-button'>$pick_color_text</button>";
		$output .= '<input type="text" hidden class="js-color-input" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '">';

    echo $output;
    echo $helper_output;
	}

	public function checkboxField( $args )
	{
    $name = $args['label_for'];
    $helper = ( ! empty( $args['helper'] ) ) ? $args['helper'] : '';
		$classes = $args['class'];
		$option_name = $args['option_name'];
    $checked = false;

    $helper_output = ( empty($helper ) ) ? '' : "<div class='mb-topbar__helper'>$helper</div>";

		if ( isset($_POST["edit_post"]) ) {
			$checkbox = get_option( $option_name );
			$checked = isset( $checkbox[$_POST["edit_post"]][$name] ) ? $checkbox[$_POST["edit_post"]][$name] : false;
		}

    echo $this->callbacks_helper->checkboxToggleField($classes, $checked, $option_name, $name );
    echo $helper_output;

	}



	public function cptTable($options_list){

    echo '<table class="cpt-table">';
    echo '<tr><th class="name">';
    echo __('Menu Name', 'mb-topbar');
    echo '</th>';
    echo '<th class="text-center small">';
    echo __('Color', 'mb-topbar');;
    echo '</th>';
    echo '<th class="text-center small">';
    echo __('Active', 'mb-topbar');
    echo '</th>';
    echo '<th class="text-center small">';
    echo __('Home', 'mb-topbar');
    echo '</th>';
    echo '<th class="text-center btns">';
    echo __('Options', 'mb-topbar');
    echo '</th></tr>';

		foreach ($options_list as $key => $option) {
			$active = ! empty( $option['activate'] ) ? __('yes', 'mb-topbar') :  __('no', 'mb-topbar');
			$is_home = ! empty( $option['is_home'] ) ? __('yes', 'mb-topbar') :  __('no', 'mb-topbar');
      $color = isset( $option['color'] ) ? $option['color'] : "#fff";
      $title = isset( $option['title'] ) ? $option['title'] : '';
      $slug = isset( $option['slug'] ) ? $option['slug'] : '';

      $confirmString = esc_attr__('This action is irreversible, are you sure you want to remove this item.', 'mb-topbar');

      echo "<tr>";
      echo "<td class='name'>{$title}</td>";
      echo "<td class=\"text-center small topbar-color-bg\" style=\"background-color:{$color};\"></td>";
      echo "<td class=\"text-center small {$active}\">{$active}</td>";
      echo "<td class=\"text-center small {$is_home}\">{$is_home}</td>";
      echo "<td class=\"text-center btns\">";

			echo '<form method="post" action="" class="inline-block">';
			echo '<input type="hidden" name="edit_post" value="' . esc_attr__( $slug ) . '">';
			submit_button( 'Edit', 'primary small', 'submit', false);
			echo '</form> ';

			echo '<form method="post" action="options.php" class="inline-block">';
			settings_fields( 'mb_topbar_list_settings' );
			echo '<input type="hidden" name="remove" value="' . esc_attr__( $slug ) . '">';
			submit_button( esc_attr__('Remove', 'mb-topbar'), 'delete small', 'submit', false, array(
				'onclick' => "return confirm('$confirmString');"
			));
			echo '</form></td></tr>';
		}

		echo '</table>';
	}


}
