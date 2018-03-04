<?php
/**
 * Template Name: Contact
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['mapLocation'] = get_post_meta( get_the_ID(), 'kalypso_location', true );
$context['GMAP_KEY'] = GMAP_KEY;
$context['address'] = get_post_meta( get_the_ID(), 'kalypso_address', true );
$context['phoneNumber'] = get_post_meta( get_the_ID(), 'kalypso_phone_number', true );
$context['emailAddress'] = get_post_meta( get_the_ID(), 'kalypso_email_address', true );

Timber::render( array( 'custom-pages/contact.twig' ), $context );

