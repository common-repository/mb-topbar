<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Api\Callbacks;

class CallbacksHelper
{

    function checkboxToggleField( $classes, $checked, $option_name, $field_name, $subfield_name = "" ){

        $sub_name = ($subfield_name == "") ? "": $subfield_name;
        $sub_name_wrap = ($sub_name == "") ? "" : "[" . $sub_name . "]";

        $output = '<div class="' . $classes . '">';
        $output .= "<input type='checkbox' id='${field_name}${sub_name}' name='${option_name}[${field_name}]$sub_name_wrap' value='1'" . ( $checked ? "checked":"" ) . ">";
        $output .= "<label for=${field_name}${sub_name}><div></div></label>";
        $output .= '</span></div>';

        return $output;

    }


	public function sanitizeDashboardValues( $input )
	{
		$output = array();

    $output["wp_logo_link"] = esc_url_raw( $input["wp_logo_link"] );
    $output["select_title"] = isset( $input["select_title"] ) ? sanitize_text_field($input["select_title"]) : '';
    $output["custom_homepage"] = isset( $input["custom_homepage"] ) ?: false;

		return $output;
    }

    public function topbarSanitize( $input )
	{

    $output = get_option('mb_topbar_list');

		if ( isset($_POST["remove"]) ) {
			unset($output[$_POST["remove"]]);

			return $output;
    }

    $activate = ! empty($input['activate'] ) ?: false;
    $is_home = ! empty($input['is_home'] ) ?: false;
    $title = sanitize_text_field( $input['title'] );
    $slug = str_replace(' ', '-', strtolower(sanitize_text_field( $input['slug'] )));
    $link = esc_url_raw( $input['link'] );
    $color = sanitize_text_field( $input['color'] );

    $input_array = [
      'activate' => $activate,
      'is_home' => $is_home,
      'title' => $title,
      'slug' => $slug,
      'link' => $link,
      'color' => $color,
    ];

		if ( empty($output) ||  empty( $output[$slug] ) ) {
      $output[$slug] = $input_array;

      return $output;
    }

    $output[$slug] = $input_array;

    return $output;
	}

}
