<?php

namespace VWP\Includes;

class admin
{
  function __construct()
  {
    add_action( 'admin_menu', [$this, 'vwp_admin_menu'] );
  }

  public function vwp_admin_menu()
  {
    $hook = add_menu_page(
      __( 'Contact Manager', 'vue_wp_practice' ),
      __( 'Contact Manager', 'vue_wp_practice' ),
      'manage_options',
      'vue_wp_practice',
      [$this, 'admin_menu_page'],
      'dashicons-text',
      10
    );

    add_action( 'load-' . $hook, [$this, 'init_hooks'] );
  }

  public function init_hooks()
  {
    add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );
  }

  public function admin_menu_page()
  {
    echo '<div id="vwp-admin-app"></div>';
  }

  public function enqueue_scripts()
  {
    wp_enqueue_style( 'fontawsome' );
    wp_enqueue_script( 'vwp-admin-script' );
  }
}