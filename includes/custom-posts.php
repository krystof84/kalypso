<?php
function kalypso_silde_post_init() {
    $labels = array(
        'name'               => _x( 'Slides', 'kalypso' ),
        'singular_name'      => _x( 'Slide', 'kalypso' ),
        'menu_name'          => _x( 'Slides', 'admin menu', 'kalypso' ),
        'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'kalypso' ),
        'add_new'            => _x( 'Add New', 'book', 'kalypso' ),
        'add_new_item'       => __( 'Add New Slide', 'kalypso' ),
        'new_item'           => __( 'New Slide', 'kalypso' ),
        'edit_item'          => __( 'Edit Slide', 'kalypso' ),
        'view_item'          => __( 'View Slide', 'kalypso' ),
        'all_items'          => __( 'All Slides', 'kalypso' ),
        'search_items'       => __( 'Search Slides', 'kalypso' ),
        'parent_item_colon'  => __( 'Parent Slides:', 'kalypso' ),
        'not_found'          => __( 'No slides found.', 'kalypso' ),
        'not_found_in_trash' => __( 'No slides found in Trash.', 'kalypso' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'kalypso' ),
        'public'             => false,
        'show_ui'            => true,
        'menu_position'      => 5,
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'thumbnail', 'page-attributes' )
    );

    register_post_type( 'slide', $args );
}
add_action( 'init', 'kalypso_silde_post_init' );