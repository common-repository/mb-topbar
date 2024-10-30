<?php
/**
 * @package  MBTopbar
 */
namespace Inc\Modules\Topbar;

use Inc\Base\BaseController;

class DatabaseController extends BaseController
{
    public function getLayoutOptions(){

        $topbar_list_default = array(
			array(
                "title" => "Selection",
                "is_home" => "1",
                "slug" => "",
                "link" => "",
                "color" => "#111111"
			)
        );
        $topbar_list_array = array();

        $options = get_option( "mb_topbar" );
        $topbar_list = get_option( "mb_topbar_list" );

        $logo_link = (! empty($options["wp_logo_link"] ) ) ? $options["wp_logo_link"] : null;
        $select_title = (! empty($options["select_title"] ) ) ? $options["select_title"] : null;
        $custom_homepage = (! empty($options["custom_homepage"] ) ) ?: false;

        if(! empty ($topbar_list ) ){
            foreach ($topbar_list as $key => $value) {
                if(isset ($value['activate'] ) && $value['activate'] == 1){
                    $topbar_list_array[] = $value;
                }
            }
        }

        $topbar_options = array(
            "plugin_url" => $this->plugin_url,
            "logo_url" => esc_url_raw( $logo_link ),
            "select_title" => $select_title,
            "custom_homepage" => $custom_homepage,
            "projects" => ( count($topbar_list_array) > 0 ) ? $topbar_list_array : $topbar_list_default

        );

        return $topbar_options;

    }
}
