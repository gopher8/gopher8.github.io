<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//todo: correct urls
class Photo_Gallery_WP_Admin_Assets {

	/**
	 * Photo_Gallery_WP_Admin_Assets constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * @param $hook hook of current page
	 */
	public function admin_styles( $hook ){
		if( in_array($hook, Photo_Gallery_WP()->admin->pages ) ){
			wp_enqueue_style( "gallery_admin_css", Photo_Gallery_WP()->plugin_url()."/assets/style/admin.style.css", false );
			wp_enqueue_style( "jquery_ui", esc_url("http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"), false );
			wp_enqueue_style( "simple_slider_css", Photo_Gallery_WP()->plugin_url()."/assets/style/simple-slider_sl.css",  false );
            wp_enqueue_style( "featured_plugins", Photo_Gallery_WP()->plugin_url()."/assets/style/featured-plugins.css",  false );
            wp_enqueue_style( "free-banner", Photo_Gallery_WP()->plugin_url()."/assets/style/free-banner.css",  false );
		}
		$edit_pages = array('post.php','post-new.php');
		if ( in_array( $hook, $edit_pages ) ){
            wp_enqueue_style('shortcode-components', Photo_Gallery_WP()->plugin_url()."/assets/style/shortcode-components.css");
        }

		if( $hook === Photo_Gallery_WP()->admin->pages['licensing'] ){
			wp_enqueue_style( 'photo-gallery-licensing', Photo_Gallery_WP()->plugin_url()."/assets/style/licensing.css",  false );
		}
	}

	public function admin_scripts( $hook ) {

		if( in_array($hook, Photo_Gallery_WP()->admin->pages ) ){
			wp_enqueue_media();
			wp_enqueue_script( "gallery_admin_js", Photo_Gallery_WP()->plugin_url()."/assets/js/admin.js", false );
			wp_enqueue_script( "jquery_ui_new", esc_url("http://code.jquery.com/ui/1.10.4/jquery-ui.js"), false );
			wp_enqueue_script( "simple_slider_js", Photo_Gallery_WP()->plugin_url().'/assets/js/simple-slider.js', false );
			wp_enqueue_script( 'param_block2', Photo_Gallery_WP()->plugin_url()."/assets/js/jscolor.js");
		}
		$edit_pages = array('post.php','post-new.php');
		if ( in_array( $hook, $edit_pages ) ){
            wp_enqueue_script('shortcode-components', Photo_Gallery_WP()->plugin_url()."/assets/js/shortcode-components.js", array('jquery'));
        }
	}

	public function localize_scripts(){

	}
}

new Photo_Gallery_WP_Admin_Assets();