<?php
/**
 * Template Name: About Us
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$context['meetTeamPerson'] = get_post_meta( get_the_ID(), 'meet_team_section_repeat_group', true );
$context['headerSlider'] = get_post_meta( get_the_ID(), 'kalypso_header_slider_section', true );
$context['descriptionSlider'] = get_post_meta( get_the_ID(), 'kalypso_description_slider_section', true );
$context['imagesSlider'] = get_post_meta( get_the_ID(), 'kalypso_images_slider_section', true );

Timber::render( array( 'custom-pages/about-us.twig' ), $context );

