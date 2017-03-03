<?php
/**
 * resortica-lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package resortica-lite
 */

if ( ! function_exists( 'resortica_lite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function resortica_lite_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on resortica-lite, use a find and replace
		 * to change 'resortica-lite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'resortica-lite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'resortica-lite' ),
			'footer'  => esc_html__( 'Footer', 'resortica-lite' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'resortica_lite_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'post-formats', apply_filters( 'resortica_lite_post_formats', array('image', 'video', 'gallery')) );

		add_theme_support( 'custom-logo');
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'resortica_lite_setup' );

/**
 * Registers an editor stylesheet for the theme.
 */
if ( ! function_exists( 'resortica_lite_theme_add_editor_styles' ) ) :
	function resortica_lite_theme_add_editor_styles() {
	    add_editor_style( 'style.css' );
	}
	add_action( 'admin_init', 'resortica_lite_theme_add_editor_styles' );
endif;

if(!function_exists('resortica_lite_content_width')):
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function resortica_lite_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'resortica_lite_content_width', 780 );
	}
	add_action( 'after_setup_theme', 'resortica_lite_content_width', 0 );
endif;


if ( ! function_exists( 'resortica_lite_content_width_tweak' ) ) :
    function resortica_lite_content_width_tweak() {
        if ( is_page_template( 'page-templates/template-blank.php' ) ) :
            global $content_width;
            $content_width = 1170; /* pixels */
            endif;
    }
endif;
add_action( 'template_redirect', 'resortica_lite_content_width_tweak' );


/**
 * Include registered sidebars.
 */
require get_template_directory() . '/inc/register-widget.php';

/**
 * Include Scripts And STyles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include registered sidebars.
 */
require get_template_directory() . '/inc/theme-option-settings.php';

/**
 * Include resortca functions.
 */
require get_template_directory() . '/lib/resortica-functions.php';

/**
 * Include resortca functions.
 */
require get_template_directory() . '/lib/resortica-lite-nav-walker.php';

/**
 * Include resortca functions.
 */
require get_template_directory() . '/lib/class-tgm-plugin-activation.php';

/**
 * Include resortca customizer control.
 */
 require get_template_directory() . '/inc/customizer/customizer-control.php';