<?php
/**
 * Extra functions for this theme.
 *
 * @package Blanche
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function blanche_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'blanche_page_menu_args' );

/**
* Defines new blog excerpt length and link text.
*/
function blanche_new_excerpt_length($length) {
	return 80;
}
add_filter('excerpt_length', 'blanche_new_excerpt_length');

function blanche_new_excerpt_more($more) {
	global $post;
	return '<a class="more-link" href="'.esc_url(get_permalink($post->ID)) . '"><span>'. __('Read More', 'blanche-lite') .'</span></a>';
}
add_filter('excerpt_more', 'blanche_new_excerpt_more');

/**
* Adds excerpt support for pages.
*/
add_post_type_support( 'page', 'excerpt');


/**
* Manages display of archive titles.
*/
function blanche_get_the_archive_title( $title ) {
   if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( __( 'Y','blanche-lite' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( __( 'F Y','blanche-lite' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( __( 'F j, Y','blanche-lite' ) );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = esc_html__( 'Archives', 'blanche-lite' );
    }
    return $title;
};
add_filter( 'get_the_archive_title', 'blanche_get_the_archive_title', 10, 1 );