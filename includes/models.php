<?php

namespace VWP\Includes;


class models
{

  function __construct()
  {
    add_action( 'admin_enqueue_scripts', [$this, 'vwp_admin_scripts'] );
    add_action( 'wp_ajax_vwp_insert_contact_table', [$this, 'vwp_insert_contact_table'] );
    add_action( 'wp_ajax_vwp_get_contacts', [$this, 'vwp_get_contacts'] );
    add_action( 'wp_ajax_vwp_get_contact_lists', [$this, 'vwp_get_contact_lists'] );
    add_action( 'wp_ajax_vwp_get_single_data', [$this, 'vwp_get_single_data'] );
    add_action( 'wp_ajax_vwp_update_contact_list', [$this, 'vwp_update_contact_list'] );
    add_action( 'wp_ajax_vwp_delete_contact', [$this, 'vwp_delete_contact'] );
  }



  public function vwp_admin_scripts()
  {
    wp_enqueue_script( 'vwp', VWP_ASSETS . 'js/contatc-form.js', null, VWP_VERSION, true );
    wp_localize_script( 'vwp', 'ajax_url', array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'wpsfb_nonce' => wp_create_nonce('wpsfb_ajax_nonce')
    ));
  }


  public function vwp_insert_contact_table()
  {
    if (!wp_verify_nonce($_POST['wpsfb_nonce'], 'wpsfb_ajax_nonce')) {
      return wp_send_json_error('Busted! Please login!', 400);
    }

    global $wpdb;

    if (!empty($_POST['name'])) {
      $title = sanitize_text_field($_POST['name']);
    } else {
      return wp_send_json_error("please enter name", 400);
    }

    if (!empty($_POST['photo'])) {
      $details = sanitize_text_field($_POST['photo']);
    } else {
      return wp_send_json_error("please enter img url", 400);
    }

    if (!empty($_POST['email'])) {
      $details = sanitize_text_field($_POST['email']);
    } else {
      return wp_send_json_error("please enter email", 400);
    }
    if (!empty($_POST['mobile'])) {
      $details = sanitize_text_field($_POST['mobile']);
    } else {
      return wp_send_json_error("please enter mobile", 400);
    }
    if (!empty($_POST['company'])) {
      $details = sanitize_text_field($_POST['company']);
    } else {
      return wp_send_json_error("please enter company", 400);
    }
    if (!empty($_POST['title'])) {
      $details = sanitize_text_field($_POST['title']);
    } else {
      return wp_send_json_error("please enter title", 400);
    }

   

    $defaults = [

      'name'    => sanitize_text_field( ( isset($_POST['name']) ? $_POST['name'] : '' ) ),
      'photo'   => sanitize_text_field( ( isset($_POST['photo']) ? $_POST['photo'] : '' ) ),
      'email'   => sanitize_text_field( ( isset($_POST['email']) ? $_POST['email'] : '' ) ),
      'mobile'  => sanitize_text_field( ( isset($_POST['mobile']) ? $_POST['mobile'] : '' ) ),
      'company' => sanitize_text_field( ( isset($_POST['company']) ? $_POST['company'] : '' ) ),
      'title'   => sanitize_text_field( ( isset($_POST['title']) ? $_POST['title'] : '' ) ),
      
    ];
    error_log( print_r( $defaults, 1 ) );

    $table_name = $wpdb->prefix . 'contacts';

    $inserted = $wpdb->insert(
      $table_name,
      $defaults
    );

    if ( !$inserted ) {
      return wp_send_json_error( "Error while posting data", 500 );
    }
    return wp_send_json_success( [
      'message' => __( "Successfully posted data", "textdomain" )
    ], 200 );
  }

  public function vwp_get_contacts()
  {
    wp_send_json_success( "this is response", 200 );
  }


  /**
   * Fetching data for contact table
   */
  public function vwp_get_contact_lists()
  {
    global $wpdb;

    $request = $wpdb->get_results(
      "SELECT * FROM {$wpdb->prefix}contacts"
    );
    if ( is_wp_error( $request ) ) {
      return false;
    }
    wp_send_json_success( $request, 200 );

    die();
  }

  // Get Single Data
  public function vwp_get_single_data()
  {
    global $wpdb;
    $post_id = ( isset( $_POST['id'] ) ? $_POST['id'] : '' );


    $single_data = $wpdb->get_results(
      "SELECT * FROM {$wpdb->prefix}contacts WHERE id = {$post_id}"
    );

    if ( is_wp_error( $single_data ) ) {
      return false;
    }
    wp_send_json_success( $single_data, 200 );
    die();
  }


  /*
   * Updating Table's row
   */
  public function vwp_update_contact_list()
  {
    if (!wp_verify_nonce($_POST['wpsfb_nonce'], 'wpsfb_ajax_nonce')) {
      return wp_send_json_error('Busted! Please login!', 400);
    }

    global $wpdb;

    if (!empty($_POST['name'])) {
      $title = sanitize_text_field($_POST['name']);
    } else {
      return wp_send_json_error("please enter name", 400);
    }

    if (!empty($_POST['photo'])) {
      $details = sanitize_text_field($_POST['photo']);
    } else {
      return wp_send_json_error("please enter img url", 400);
    }

    if (!empty($_POST['email'])) {
      $details = sanitize_text_field($_POST['email']);
    } else {
      return wp_send_json_error("please enter email", 400);
    }
    if (!empty($_POST['mobile'])) {
      $details = sanitize_text_field($_POST['mobile']);
    } else {
      return wp_send_json_error("please enter mobile", 400);
    }
    if (!empty($_POST['company'])) {
      $details = sanitize_text_field($_POST['company']);
    } else {
      return wp_send_json_error("please enter company", 400);
    }
    if (!empty($_POST['title'])) {
      $details = sanitize_text_field($_POST['title']);
    } else {
      return wp_send_json_error("please enter title", 400);
    }
    
    $id           = sanitize_text_field( ( isset( $_POST['id'] ) ? $_POST['id'] : '' ) );
    $name         = sanitize_text_field( ( isset( $_POST['name'] ) ? $_POST['name'] : '' ) );
    $photo        = sanitize_text_field( ( isset( $_POST['photo'] ) ? $_POST['photo'] : '' ) );
    $email        = sanitize_text_field( ( isset( $_POST['email'] ) ? $_POST['email'] : '' ) );
    $mobile       = sanitize_text_field( ( isset( $_POST['mobile'] ) ? $_POST['mobile'] : '' ) );
    $company      = sanitize_text_field( ( isset( $_POST['company'] ) ? $_POST['company'] : '' ) );
    $title        = sanitize_text_field( ( isset( $_POST['title'] ) ? $_POST['title'] : '' ) );
    $table_name   = $wpdb->prefix .  'contacts';
    $where        = ['id' => $id];

    $updated      =  $wpdb->update(
      $table_name,
      array(
        'name'        => $name,
        'photo'       => $photo,
        'email'       => $email,
        'mobile'      => $mobile,
        'company'     => $company,
        'title'       => $title,
      ),
      $where
    );

//     if ( !$updated ) {
//       return wp_send_json_error( "Error while posting data", 500 );
//     }
    return wp_send_json_success( [
      'message' => __( "Successfully update data", "textdomain" )
    ], 200 );
    die();
  }


  /**
   * Deleting Table's row
   */
  public function vwp_delete_contact()
  {

    if (!wp_verify_nonce($_POST['wpsfb_nonce'], 'wpsfb_ajax_nonce')) {
      return wp_send_json_error('Busted! Please login!', 400);
    }

    global $wpdb;
    
    $table_name = $wpdb->prefix . 'contacts';
    $id         = isset( $_POST['id'] ) ? $_POST['id'] : '';

    $wpdb->delete( $table_name, array( 'id' => $id ) );
    die();

  }
}
