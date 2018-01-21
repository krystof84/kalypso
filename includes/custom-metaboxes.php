<?php

function cmb2_kalypso_metaboxes() {

    /**
     * Define custom metaboxes for slider post type.
     */

    $prefix = 'kalypso_';

    // Init metabox
    $cmb = new_cmb2_box( array(
        'id'            => 'slider_metabox',
        'title'         => __( 'Slider settings', 'cmb2' ),
        'object_types'  => array( 'slide' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ) );

    // Header text field
    $cmb->add_field( array(
        'name'       => __( 'Text under the slide title', 'cmb2' ),
//        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => $prefix . 'text_under_slide_title',
        'type'       => 'text'
    ) );

    // URL for anchor
    $cmb->add_field( array(
        'name' => __( 'Slide button url', 'cmb2' ),
        'id'   => $prefix . 'url_for_slide_button',
        'type' => 'text_url'
    ) );

    // Name of anchor
    $cmb->add_field( array(
        'name'       => __( 'Slide button name', 'cmb2' ),
        'id'         => $prefix . 'name_for_slide_button',
        'type'       => 'text'
    ) );

}
add_action( 'cmb2_admin_init', 'cmb2_kalypso_metaboxes' );