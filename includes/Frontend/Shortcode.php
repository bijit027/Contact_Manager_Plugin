<?php

namespace VWP\Includes\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode
{
    /**
     * Initializes the class
     */
    function __construct()
    {
        add_shortcode( 'contact-code', [$this, 'render_shortcode'] );
    }

    public function loadAssets()
    {
        wp_enqueue_style(
            'contact_frontends_css',
            VWP_CONTACTS_BASE_DIR . 'assets/css/frontend.css',
        );
    }

    /**
     * Shortcode handler class
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_shortcode( $atts = [], $content = '' )
    {

        $this->loadAssets();

        global $wpdb;
        $atts = shortcode_atts( array(
            'id' => ''
        ), $atts );
        $id = $atts['id'];

        if ( !empty( $atts['id'] ) ) {

            $items = vwp_get_contacts_by_id( $id );
            return $this->renderAttributesBasis( $items );
        } else {
            $items = vwp_get_all_contacts( $atts );
            return $this->renderWithoutAttributes( $items );
           
        }
    }

    public function renderAttributesBasis( $items )
    {

        ob_start();
        include_once VWP_CONTACTS_PATH . '/includes/views/AttributeRender.php';
        $content = ob_get_clean();
        return $content;
    }

    public function renderWithoutAttributes( $items )
    {
        ob_start();
        include_once VWP_CONTACTS_PATH . '/includes/views/AttributeRender.php';
        $content = ob_get_clean();
        return $content;
    }
}
