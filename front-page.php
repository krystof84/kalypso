<?php
/**
 * The template for displaying home page
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['slide1url'] = get_template_directory_uri() . '/src/img/demo/slide-1.jpg';
$context['slide2url'] = get_template_directory_uri() . '/src/img/demo/slide-2.jpg';
$context['slide3url'] = get_template_directory_uri() . '/src/img/demo/slide-3.jpg';
Timber::render( 'front-page.twig', $context );