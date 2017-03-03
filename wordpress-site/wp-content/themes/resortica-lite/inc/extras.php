<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package resortica-lite
 */

if(!function_exists('resortica_lite_body_classes')):
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    function resortica_lite_body_classes( $classes ) {
    	// Adds a class of group-blog to blogs with more than 1 published author.
    	if ( is_multi_author() ) {
    		$classes[] = 'group-blog';
    	}

    	// Adds a class of hfeed to non-singular pages.
    	if ( ! is_singular() ) {
    		$classes[] = 'hfeed';
    	}

        if ( is_page_template('page-templates/template-home.php' ) ) {
            $classes[] = 'instafeed-check';
        }

    	return $classes;
    }
    add_filter( 'body_class', 'resortica_lite_body_classes' );
endif;
