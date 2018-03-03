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
define('GMAP_KEY', 'AIzaSyDIUPfOyKzeaPFaLixyctinvKsWNlsSseU');

// Add google map api key to plugin cmb_field_map
add_filter( 'cmb2_render_pw_map', function() {
    wp_deregister_script( 'pw-google-maps-api' );
    wp_register_script( 'pw-google-maps-api', '//maps.googleapis.com/maps/api/js?libraries=places&key='.GMAP_KEY, null, null );
}, 12 );

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

        add_theme_support( 'custom-logo', array(
            'height'      => 40,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );

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
        add_image_size( 'kalypso-picture-section-size', 960, 641, true );
        add_image_size( 'kalypso-logo-size', 230, 114, true );
        add_image_size( 'kalypso-service-logo-size', 128, 128, true );
        add_image_size( 'kalypso-single-page-slider-size', 800, 449, true );
    }
endif; // kalypso_setup
add_action( 'after_setup_theme', 'kalypso_setup' );

/*
 * Add SVG Support
 * */
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
        return $data;
    }

    $filetype = wp_check_filetype( $filename, $mimes );

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4 );

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );


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

    // Font Awesome CDN
    wp_enqueue_style( 'kalypso-font-awesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css', array(), null );

    // Main script file
    wp_enqueue_script( 'kalypso-script', get_template_directory_uri() . '/src/js/main.js', array( 'jquery', 'kalypso-slick-carousel', 'kalypso-owl-carousel' ), '0.2', true );

    // slick Carousel script
    wp_enqueue_script( 'kalypso-slick-carousel', get_template_directory_uri() . '/src/js/slick.min.js', array( 'jquery' ), '1', true );

    // Owl Carousel script
    wp_enqueue_script( 'kalypso-owl-carousel', get_template_directory_uri() . '/src/js/owl.carousel.min.js', array( 'jquery' ), '1', true );
}
add_action( 'wp_enqueue_scripts', 'kalypso_scripts' );


/*
 * WP Customizer Init
 * */

function your_theme_customizer_setting($wp_customize) {

    //
    // Add second logo field in WordPress Customizer -> Site identity - Homepage
    //

    $wp_customize->add_setting('kalypso_logo_in_slide_menu');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'kalypso_logo_in_slide_menu', array(
        'label' => __('Signet logo in menu slide', 'kalypso'),
        'description' => __('Signet logo in slide menu should have 176px x 176px'),
        'section' => 'title_tagline',
        'settings' => 'kalypso_logo_in_slide_menu',
        'priority' => 8
    )));

    //
    // Add footer text in WP Customizer
    //

    // Create custom panel.
    $wp_customize->add_panel( 'text_blocks', array(
        'priority'       => 500,
        'theme_supports' => '',
        'title'          => __( 'Text Blocks', 'kalypso' ),
        'description'    => __( 'Set editable text for certain content.', 'kalypso' ),
    ) );
    // Add Footer Text
    // Add section.
    $wp_customize->add_section( 'custom_footer_text' , array(
        'title'    => __('Change Footer Text','kalypso'),
        'panel'    => 'text_blocks',
        'priority' => 10
    ) );
    // Add setting
    $wp_customize->add_setting( 'footer_text_block', array(
        'default'           => __( 'default text', 'kalypso' ),
        'sanitize_callback' => 'sanitize_text'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            'custom_footer_text',
            array(
                'label'    => __( 'Footer Text', 'kalypso' ),
                'section'  => 'custom_footer_text',
                'settings' => 'footer_text_block',
                'type'     => 'text'
            )
        )
    );
    // Sanitize text
    function sanitize_text( $text ) {
        return sanitize_text_field( $text );
    }
}
add_action('customize_register', 'your_theme_customizer_setting');


/*
 * Register Widgets
 * */

function kalypso_widgets_init() {

    register_sidebar( array(
        'name'          => 'Footer 1',
        'id'            => 'kal-footer-widget-1',
        'before_widget' => '<div class="footer__widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="footer__widget-title">',
        'after_title'   => '</p>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer 2',
        'id'            => 'kal-footer-widget-2',
        'before_widget' => '<div class="footer__widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="footer__widget-title">',
        'after_title'   => '</p>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer 3',
        'id'            => 'kal-footer-widget-3',
        'before_widget' => '<div class="footer__widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="footer__widget-title">',
        'after_title'   => '</p>',
    ) );

}
add_action( 'widgets_init', 'kalypso_widgets_init' );

/*
 * Add Variables to global Timber Context
 * */
function add_to_context( $context ) {
    $context['footerWidget1'] = Timber::get_widgets('kal-footer-widget-1');
    $context['footerWidget2'] = Timber::get_widgets('kal-footer-widget-2');
    $context['footerWidget3'] = Timber::get_widgets('kal-footer-widget-3');

    return $context;
}
add_filter( 'timber/context', 'add_to_context' );


/*
 * Custom posts
 * */
include 'includes/custom-posts.php';

/*
 * Custom metaboxes
 * */
include 'includes/custom-metaboxes.php';