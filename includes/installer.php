<?php

namespace VWP\Includes;

class installer
{
  function __construct()
  {
  }

  public function run()
  {
    $this->add_version();
    $this->create_contacts_table();
  }

  public function add_version()
  {
    $is_installed = get_option( 'vwp_is_installed' );
    if ( !$is_installed ) {
      update_option( 'vwp_is_installed', time() );
    }
    update_option( 'vwp_is_installed', VWP_VERSION );
  }

  public function create_contacts_table()
  {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'contacts';
    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
      `id` int(10) NOT NULL AUTO_INCREMENT,
      `name` varchar(200) DEFAULT NULL,
      `photo` varchar(200) DEFAULT NULL,
      `email` varchar(200) DEFAULT NULL,
      `mobile` varchar(200) DEFAULT NULL,
      `company` varchar(200) DEFAULT NULL,
      `title` varchar(200) DEFAULT NULL,
      
      PRIMARY KEY(`id`)
      ) $charset_collate;";

    if ( !function_exists( 'dbDelta' ) ) {
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    }

    dbDelta( $sql );
  }
}