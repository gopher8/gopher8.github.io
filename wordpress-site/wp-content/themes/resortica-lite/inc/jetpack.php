<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package resortica-lite
 */

if(!function_exists('resortica_lite_jetpack_setup')):
	/**
	 * Jetpack setup function.
	 *
	 * See: https://jetpack.com/support/infinite-scroll/
	 * See: https://jetpack.com/support/responsive-videos/
	 */
	function resortica_lite_jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'resortica_lite_infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );
	}
	add_action( 'after_setup_theme', 'resortica_lite_jetpack_setup' );
endif;

if(!function_exists('resortica_lite_infinite_scroll_render')):
	/**
	 * Custom render function for Infinite Scroll.
	 */
	function resortica_lite_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
			    get_template_part( 'template-parts/contents/content', 'search' );
			else :
			    get_template_part( 'template-parts/contents/content', get_post_format() );
			endif;
		}
	}
endif;