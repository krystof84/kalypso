<?php
/**
 * The template for displaying home page
 */

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

$slidesArgs = array(
    'post_type' => 'slide',
    'order' => 'ASC',
    'order_by' => 'menu_order',
    'posts_per_page' => -1,
);

$context['slides'] = Timber::get_posts( $slidesArgs );

$context['pictureImageHeader1'] = get_post_meta( get_the_ID(), 'kalypso_header_picture_section_1', true );
$context['pictureImageDesc1'] = get_post_meta( get_the_ID(), 'kalypso_content_picture_section_1', true );
$context['pictureImageButtonName1'] = get_post_meta( get_the_ID(), 'kalypso_button_name_picture_section_1', true );
$context['pictureImageButtonUrl1'] = get_post_meta( get_the_ID(), 'kalypso_button_url_picture_section_1', true );
$context['pictureImageUrl1'] = get_post_meta( get_the_ID(), 'kalypso_image_picture_section_1', true );

$context['pictureImageHeader2'] = get_post_meta( get_the_ID(), 'kalypso_header_picture_section_2', true );
$context['pictureImageDesc2'] = get_post_meta( get_the_ID(), 'kalypso_content_picture_section_2', true );
$context['pictureImageButtonName2'] = get_post_meta( get_the_ID(), 'kalypso_button_name_picture_section_2', true );
$context['pictureImageButtonUrl2'] = get_post_meta( get_the_ID(), 'kalypso_button_url_picture_section_2', true );
$context['pictureImageUrl2'] = get_post_meta( get_the_ID(), 'kalypso_image_picture_section_2', true );

$context['logos'] = get_post_meta( get_the_ID(), 'kalypso_logotype_home_section', true);

Timber::render( 'front-page.twig', $context );