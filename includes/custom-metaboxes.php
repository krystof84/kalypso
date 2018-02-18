<?php

function cmb2_kalypso_metaboxes() {

    /**
     * Define custom metaboxes for slider post type.
     */

    $prefix = 'kalypso_';
    $front_page_ID = get_option('page_on_front');

    /*
     * Register meatabox - Slider post type
     * */
    $cmb = new_cmb2_box( array(
        'id'            => 'slider_metabox',
        'title'         => __( 'Slider settings', 'cmb2' ),
        'object_types'  => array( 'slide' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Text under the slide title', 'cmb2' ),
        'id'         => $prefix . 'text_under_slide_title',
        'type'       => 'text'
    ) );

    $cmb->add_field( array(
        'name' => __( 'Slide button url', 'cmb2' ),
        'id'   => $prefix . 'url_for_slide_button',
        'type' => 'text_url'
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Slide button name', 'cmb2' ),
        'id'         => $prefix . 'name_for_slide_button',
        'type'       => 'text'
    ) );

    /*
     * Homepage metaboxes
     * */

    $cmb = new_cmb2_box( array(
        'id'            => 'frontpage_picture_section_metabox',
        'title'         => __( 'Picture Section', 'cmb2' ),
        'object_types'  => array( 'page' ),
        'show_on'	  => array( 'id' => array( $front_page_ID, ) ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    /*
 * Repeeatable service section
 * */

    $group_field_id = $cmb->add_field( array(
        'id'          => $prefix . 'service_section',
        'type'        => 'group',
        'description' => 'Generates service section items',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'   => __('Service {#}', 'cmb2'),
            'add_button'    => __('Add Another Service', 'cmb2'),
            'remove_button' => __('Remove Service', 'cmb2'),
            'sortable'      => true,
            // 'closed'     => true,
        ),
    ) );

    $cmb->add_group_field( $group_field_id, array(
        'name' => __('Entry service name', 'cmb2'),
        'id'   => $prefix . 'service_title',
        'type' => 'text',
    ) );

    $cmb->add_group_field( $group_field_id, array(
        'name' => __('Description', 'cm2'),
        'description' => 'Write a short description for this service',
        'id'   => $prefix . 'service_description',
        'type' => 'textarea_small',
    ) );

    $cmb->add_group_field( $group_field_id, array(
        'name' => __('Entry service image', 'cmb2'),
        'id'   => $prefix . 'service_image',
        'type' => 'file',
        'query_args' => array( 'type' => 'image' ),
    ) );

    $cmb->add_group_field( $group_field_id, array(
        'name' => __('Service url', 'cmb2'),
        'id'   => $prefix . 'service_url',
        'type' => 'text_url',
    ) );


    // Picture section 1

    $cmb->add_field( array(
        'name'       => __( 'Header 1 text', 'cmb2' ),
        'id'         => $prefix . 'header_picture_section_1',
        'type'       => 'text',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Content 1 text', 'cmb2' ),
        'id'         => $prefix . 'content_picture_section_1',
        'type'       => 'textarea',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Button 1 name', 'cmb2' ),
        'id'         => $prefix . 'button_name_picture_section_1',
        'type'       => 'text',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Button 1 url', 'cmb2' ),
        'id'   => $prefix . 'button_url_picture_section_1',
        'type' => 'text_url',
    ) );

    $cmb->add_field( array(
        'name' => 'Image 1',
        'desc' => 'Recomended image size: 960 x 641px',
        'id'   => $prefix . 'image_picture_section_1',
        'type' => 'file',
        'preview_size' => array( 100, 100 ),
        'query_args' => array( 'type' => 'image' ),
        'text' => array(
            'add_upload_files_text' => 'Add or Upload image',
            'remove_image_text' => 'Remove Image',
        ),
    ) );


    // Picture section 2
    $cmb->add_field( array(
        'name'       => __( 'Header 2 text', 'cmb2' ),
        'id'         => $prefix . 'header_picture_section_2',
        'type'       => 'text',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Content 2 text', 'cmb2' ),
        'id'         => $prefix . 'content_picture_section_2',
        'type'       => 'textarea',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Button 2 name', 'cmb2' ),
        'id'         => $prefix . 'button_name_picture_section_2',
        'type'       => 'text',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Button 2 url', 'cmb2' ),
        'id'   => $prefix . 'button_url_picture_section_2',
        'type' => 'text_url',
    ) );

    $cmb->add_field( array(
        'name' => 'Image 2',
        'desc' => 'Recomended image size: 960 x 641px',
        'id'   => $prefix . 'image_picture_section_2',
        'type' => 'file',
        'preview_size' => array( 100, 100 ),
        'query_args' => array( 'type' => 'image' ),
        'text' => array(
            'add_upload_files_text' => 'Add or Upload image',
            'remove_image_text' => 'Remove Image',
        ),
    ) );

    /*
     * Logotypes Carausel
     * */

    $cmb = new_cmb2_box( array(
        'id'            => 'logos_home_section_metabox',
        'title'         => __( 'Logotype Section', 'cmb2' ),
        'object_types'  => array( 'page' ),
        'show_on'	  => array( 'id' => array( $front_page_ID, ) ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'closed'     => false,
    ) );

    $cmb->add_field( array(
        'name' => 'Logotypes',
        'desc' => '',
        'id'   => $prefix . 'logotype_home_section',
        'type' => 'file_list',
        'preview_size' => array( 160, 100 ),
        'query_args' => array( 'type' => 'image' ),
        'text' => array(
            'add_upload_files_text' => __('Add or Upload Logos', 'cmb2'),
            'remove_image_text' => __('Remove logo', 'cmb2'),
            'file_text' => __('File', 'cmb2'),
            'file_download_text' => __('Download', 'cmb2'),
            'remove_text' => __('Remove logo', 'cmb2'),
        ),
    ) );

}
add_action( 'cmb2_admin_init', 'cmb2_kalypso_metaboxes' );