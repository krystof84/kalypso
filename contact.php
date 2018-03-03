<?php
/**
 * Template Name: Contact
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['mapLocation'] = get_post_meta( get_the_ID(), 'kalypso_location', true );
$context['GMAP_KEY'] = GMAP_KEY;

Timber::render( array( 'custom-pages/contact.twig' ), $context );

