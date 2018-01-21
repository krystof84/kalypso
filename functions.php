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

        add_image_size( 'kalypso-full-slide-size', 1920, 540, true );
    }
endif; // kalypso_setup
add_action( 'after_setup_theme', 'kalypso_setup' );


/**
 * Register Google fonts.
 */
if ( ! function_exists( 'kalypso_fonts_url' ) ) :
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
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function kalypso_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'kalypso_javascript_detection', 0 );


/**
 * Enqueues scripts and styles.
 */
function kalypso_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'kalypso-fonts', kalypso_fonts_url(), array(), null );

    // Add main css file
    wp_enqueue_style( 'kalypso-style-main', get_template_directory_uri() . '/src/css/main.css', array(), '0.2' );

    // Main script file
    wp_enqueue_script( 'kalypso-script', get_template_directory_uri() . '/src/js/main.js', array( 'jquery' ), '0.2', true );

    // slick Carousel script
    wp_enqueue_script( 'kalypso-slick-carousel', get_template_directory_uri() . '/src/js/slick.min.js', array( 'jquery' ), '1', true );
}
add_action( 'wp_enqueue_scripts', 'kalypso_scripts' );

/*
 * Custom posts
 * */
include 'includes/custom-posts.php';


/*
 * Custom metaboxes
 * */
include 'includes/custom-metaboxes.php';