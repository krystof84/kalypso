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

Timber::render( 'front-page.twig', $context );