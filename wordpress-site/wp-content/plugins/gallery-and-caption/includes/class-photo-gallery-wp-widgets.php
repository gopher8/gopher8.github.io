<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Class Photo_Gallery_WP_Widgets
 */
class Photo_Gallery_WP_Widgets {

	/**
	 * Photo_Gallery_WP_Widgets constructor.
	 */
	public function __construct() {
		add_action( 'widgets_init', array($this,'register_widget'));
	}

	/**
	 * Register Photo Gallery WP Widget
	 */
	public function register_widget(){
		register_widget( 'Photo_Gallery_WP_Widget' );
	}
}

new Photo_Gallery_WP_Widgets();
