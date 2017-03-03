<?php
/**
 * Themes functions and definitions
 *
 * @package Blanche
 */
function blanche_setup() {
	global $content_width;
		if ( ! isset( $content_width ) ){
      		$content_width = 1200;
		}
	load_theme_textdomain( 'blanche-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo');
	add_theme_support( 'customize-selective-refresh-widgets' );
	register_nav_menus( array(
			'main-menu' => esc_html__( 'Primary Menu', 'blanche-lite' ),
			'social' 	=> esc_html__( 'Social', 'blanche-lite' )
		) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('blanche-blogthumb', 720, 9999);
}
add_action( 'after_setup_theme', 'blanche_setup' );

/**
 * Register widget areas.
 *
 */
function blanche_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blanche-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Top Widget', 'blanche-lite' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Front Widget', 'blanche-lite' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'blanche-lite' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blanche_widgets_init' );

/**
 * Including theme scrips and styles.
 */
function blanche_scripts_styles() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if (!is_admin()) {
		wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery-reaktion', get_template_directory_uri() . '/js/reaktion.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'responsive-videos', get_template_directory_uri() . '/js/responsive-videos.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery-onscreen', get_template_directory_uri() . '/js/on-screen.js', array( 'jquery' ), '', true );
		wp_enqueue_style('blanche-hind-font', '//fonts.googleapis.com/css?family=Hind:400,300,500,600,700', array(), '1', 'screen'); 
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
		wp_enqueue_style('animate-style', get_template_directory_uri().'/animate.css', array(), '1', 'screen'); 
		wp_enqueue_style( 'blanche-style', get_stylesheet_uri());
	}
}
add_action( 'wp_enqueue_scripts', 'blanche_scripts_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';