<?php
/**
 * The template for displaying home page
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render( 'front-page.twig', $context );