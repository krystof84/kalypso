<?php
/**
 * The template for displaying home page
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['slide1url'] = get_template_directory_uri() . '/src/img/demo/slider-1.png';
$context['slide2url'] = get_template_directory_uri() . '/src/img/demo/slider-2.png';
$context['slide3url'] = get_template_directory_uri() . '/src/img/demo/slider-3.png';
Timber::render( 'front-page.twig', $context );