<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Photo_Gallery_WP_Featured_Plugins {
	/**
	 * Prints Featured Plugins page 
	 */
	public function show_page( ){
		include( PHOTO_GALLERY_WP_TEMPLATES_PATH.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'photo-gallery-wp-admin-featured-plugins.php' );
	}
}