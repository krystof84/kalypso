<?php
/**
 * Template Name: About Us
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$context['meetTeamPerson'] = get_post_meta( get_the_ID(), 'meet_team_section_repeat_group', true );

Timber::render( array( 'custom-pages/about-us.twig' ), $context );

