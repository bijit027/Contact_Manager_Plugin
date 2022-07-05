<?php

namespace VWP\Includes;

class assets
{
  function __construct()
  {
    if ( is_admin() ) {
      add_action( 'admin_enqueue_scripts', [$this, 'register'] );
    } else {
      add_action( 'wp_enqueue_scripts', [$this, 'register'] );
    }
  }

  public function register()
  {
    $this->register_scripts( $this->get_scripts() );
    wp_localize_script( 'vwp', 'ajax_url', array(
      'ajaxurl' => admin_url( 'admin-ajax.php' )
    ) );
     $this->register_styles( $this->get_styles() );
  }

  private function register_scripts( $scripts )
  {
    foreach ( $scripts as $handle => $script ) {
      $deps      = isset( $script['deps'] ) ? $script['deps'] : false;
      $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;
      $version   = isset( $script['version']) ? $script['version'] : VWP_VERSION;
      wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
    }
    
  }

  public function register_styles( $styles )
  {
    foreach ( $styles as $handle => $style ) {
      $deps = isset( $style['deps'] ) ? $style['deps'] : false;

      wp_register_style( $handle, $style['src'], $deps, VWP_VERSION );
    }
  }

  public function get_scripts()
  {
    return [
      'vwp-admin-script' => [
        'src'       => VWP_ASSETS . '/admin/admin.js',
        'deps'      => null,
        'version'   => filemtime(VWP_PLUGIN_PATH . 'assets/admin/admin.js'),
        'in_footer' => true
      ],
    ];
  }

  public function get_styles()
  {
    return [
      'fontawsome' => [
        'src' => "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css",
      ],
       'bootstrap' => [
        'src' => 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css'
      ]
    ];
  }
}
