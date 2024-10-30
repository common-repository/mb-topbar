<?php
/**
 * @package  MBTopbar
 */

namespace Inc\Modules\Languages;

use Inc\Base\BaseController;

/**
 * Class Internationalization
 */
class Internationalization extends BaseController
{


  /**
   * Register all the hooks
   *
   * @since 1.0.0
   */
  public function register() : void {
    add_action( 'plugins_loaded', [ $this, 'load_plugin_textdomain'], 10, 1 );
  }


  /**
   * Load the plugin text domain for translation.
   *
   * @since 1.0.0
   */
  public function load_plugin_textdomain() {
    load_plugin_textdomain(
      'mb-topbar',
      false,
      $this->plugin_path . 'languages/'
    );
  }
}
