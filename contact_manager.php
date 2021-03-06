<?php

/**
 * Plugin Name: Contact Manager
 * Plugin URI: https://developer.wordpress.org/plugins/plugin-basics/header-requirements/
 * Description: This is a awesome plugin!
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Bijit Deb
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://developer.wordpress.org/plugins/plugin-basics/header-requirements/
 * Text Domain: vue_wp_practice
 * Domain Path: /languages
 */

/*
WP Vue Init is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
WP Vue Init is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Awesome goal tracker. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( !defined( 'ABSPATH' ) ) {
  exit;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
  require_once __DIR__ . '/vendor/autoload.php';
}

final class Vue_Wp_practice
{
  /**
   * Define Plugin Version
   */
  const VERSION = '1.0.0';

  /**
   * Construct Function
   */
  public function __construct()
  {
    $this->plugin_constants();
    register_activation_hook( __FILE__, [$this, 'activate'] );
    register_deactivation_hook( __FILE__, [$this, 'deactivate'] );
    add_action( 'plugins_loaded', [$this, 'init_plugin'] );
  }

  /**
   * Plugin Constants
   * @since 1.0.0
   */
  public function plugin_constants()
  {
    define( 'VWP_VERSION', self::VERSION );
    define( 'VWP_PLUGIN_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );
    define( 'VWP_PLUGIN_URL', trailingslashit( plugins_url('', __FILE__) ) );
    define( 'VWP_ASSETS', VWP_PLUGIN_URL . '/assets' );
    define( 'VWP_CONTACTS_BASE_DIR', plugin_dir_url( __FILE__ ) );
    define( 'VWP_CONTACTS_PATH', __DIR__ );
  }

  /**
   * Singletone Instance
   * @since 1.0.0
   */
  public static function init()
  {
    static $instance = false;

    if ( !$instance ) {
      $instance = new self();
    }

    return $instance;
  }

  /**
   * On Plugin Activation
   * @since 1.0.0
   */
  public function activate()
  {
    $installer = new VWP\Includes\installer();
    $installer->run();
  }

  /**
   * On Plugin De-actiavtion
   * @since 1.0.0
   */
  public function deactivate()
  {
    // On plugin deactivation
  }

  /**
   * Init Plugin
   * @since 1.0.0
   */
  public function init_plugin()
  {
    new \VWP\Includes\assets();
    new \VWP\Includes\models();
    if (is_admin()) {
      new \VWP\Includes\admin();
    } else {
      new \VWP\Includes\frontend();
    }
  }
}

/**
 * Initialize Main Plugin
 * @since 1.0.0
 */
function Vue_Wp_practice()
{
  return Vue_Wp_practice::init();
}

// Run the Plugin
Vue_Wp_practice();
