<?php
require_once( __DIR__ . '/vendor/autoload.php' );

$timber = new Timber\Timber();

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	
	return;
}

Timber::$dirname = array('templates', 'views');


// Define Google Maps API key
define('GMAP_KEY', 'xxxxxx');

/**
 * Add common modules to the view context
 *
 * @param array $context
 */
function kalypso_add_to_context( $context ) {
    // Add menus to context
    $context['menu'] = [
        'primary' => new \Timber\Menu( 'primary' ),
        'footer' => new \Timber\Menu( 'footer' ),
    ];

    return $context;
}
add_filter( 'timber/context', 'kalypso_add_to_context' );


if ( ! function_exists( 'bstone_fonts_url' ) ) :
    /**
     * Register Google fonts.
     */
    function kalypso_fonts_url() {
        $fonts_url = '';
        $fonts     = array(
            'Source+Sans+Pro:300,400,600,700',
        );
        $subsets   = 'latin,latin-ext';

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => implode( '|', $fonts ),
                'subset' => $subsets,
            ), 'https://fonts.googleapis.com/css?family=' );
        }

        return $fonts_url;
    }
endif;

/**
 * Setup theme
 */
if ( ! function_exists( 'kalypso_setup' ) ) :
    function kalypso_setup() {

        load_theme_textdomain( 'kalypso' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        register_nav_menus( array(
            'primary' => __( 'Menu Główne', 'kalypso' ),
            'footer' => __( 'Menu w stopce', 'kalypso' ),
        ) );

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        add_editor_style( array( 'build/styles/editor-style.css', kalypso_fonts_url() ) );
    }
endif; // kalypso_setup
add_action( 'after_setup_theme', 'kalypso_setup' );
