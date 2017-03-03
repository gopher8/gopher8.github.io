<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Class Photo_Gallery_WP_Frontend_Scripts
 */
class Photo_Gallery_WP_Frontend_Scripts {

	/**
	 * Photo_Gallery_WP_Frontend_Scripts constructor.
	 */
	public function __construct() {
		add_action( 'Photo_Gallery_WP_Shortcode_scripts', array( $this, 'frontend_scripts' ), 10, 4 );
		add_action( 'Photo_Gallery_WP_Shortcode_scripts', array( $this, 'frontend_styles' ), 10, 2 );
		add_action( 'Photo_gallery_wp_localize_scripts', array( $this, 'localize_scripts' ), 10, 1 );
	}

	/**
	 * Enqueue styles
	 */
	public function frontend_styles( $id, $gallery_view ) {
		wp_register_style( 'gallery-all-css', plugins_url( '../assets/style/gallery-all.css', __FILE__ ) );
		wp_enqueue_style( 'gallery-all-css' );

		wp_register_style( 'style2-os-css', plugins_url( '../assets/style/style2-os.css', __FILE__ ) );
		wp_enqueue_style( 'style2-os-css' );

		wp_register_style( 'ph-lightbox-css', plugins_url( '../assets/style/ph-lightbox.css', __FILE__ ) );
		wp_enqueue_style( 'ph-lightbox-css' );

		wp_register_style( 'fontawesome-css', plugins_url( '../assets/style/css/font-awesome.css', __FILE__ ) );
		wp_enqueue_style( 'fontawesome-css' );



		if ( $gallery_view == '1' ) {
			wp_register_style( 'animate-css', plugins_url( '../assets/style/animate-min.css', __FILE__ ) ) ;
			wp_enqueue_style( 'animate-css' );
			wp_register_style( 'liquid-slider-css', plugins_url( '../assets/style/liquid-slider.css', __FILE__ ) );
			wp_enqueue_style( 'liquid-slider-css' );
		}
		if ( $gallery_view == '4' ) {
			wp_register_style( 'thumb_view-css', plugins_url( '../assets/style/thumb_view.css', __FILE__ ) );
			wp_enqueue_style( 'thumb_view-css' );
		}
		if ( $gallery_view == '6' ) {
			wp_register_style( 'thumb_view-css', plugins_url( '../assets/style/justifiedGallery.css', __FILE__ ) );
			wp_enqueue_style( 'thumb_view-css' );
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function frontend_scripts( $id, $gallery_view, $has_youtube, $has_vimeo ) {
		$view_slug = photo_gallery_wp_get_view_slag_by_id( $id );
		if ( ! wp_script_is( 'jquery' ) ) {
			wp_enqueue_script( 'jquery' );
		}
		// Added By Karen
        if ( $view_slug == 'masonry' ) {
            wp_enqueue_script('jquery-masonry');
        }

		wp_register_script( 'ph-lightbox-js', plugins_url( '../assets/js/ph-lightbox.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'ph-lightbox-js' );

		wp_register_script( 'ph-gallery-hugeitmicro-min-js', plugins_url( '../assets/js/jquery.hugeitmicro.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'ph-gallery-hugeitmicro-min-js' );

		wp_register_script( 'ph-front-end-js-'.$view_slug, plugins_url( '../assets/js/view-' . $view_slug . '.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'ph-front-end-js-'.$view_slug );

		wp_register_script( 'ph-custom-js', plugins_url( '../assets/js/custom.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'ph-custom-js' );

        wp_register_script( 'loading', plugins_url( '../assets/js/loading.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'loading' );

		if ( $gallery_view == '1' ) {
			wp_register_script( 'easing-js', plugins_url( '../assets/js/jquery.easing.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'easing-js' );
			wp_register_script( 'touch_swipe-js', plugins_url( '../assets/js/jquery.touchSwipe.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'touch_swipe-js' );
			wp_register_script( 'liquid-slider-js', plugins_url( '../assets/js/jquery.liquid-slider.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'liquid-slider-js' );
		}
		if ( $gallery_view == '4' ) {
			wp_register_script( 'thumb-view-js', plugins_url( '../assets/js/thumb_view.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'thumb-view-js' );
			wp_register_script( 'lazyload-min-js', plugins_url( '../assets/js/jquery.lazyload.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'lazyload--min-js' );
		}
		if ( $gallery_view == '6' ) {
			wp_register_script( 'jusiifed-js', plugins_url( '../assets/js/justifiedGallery.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'jusiifed-js' );
		}
		if ( $gallery_view == '3' ) {
            wp_enqueue_script('jssor.slider-21.1.6.min',plugins_url( '../assets/js/jssor.slider-21.1.6.min.js', __FILE__ ), array( 'jquery' ));
		}
	}

	public function localize_scripts( $id ) {
		global $wpdb;
		global $post;
		$pID                    = (string) $post->ID;
		$query                  = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys WHERE id=%d", $id );
		$gallery                = $wpdb->get_results( $query );
		$admin_url              = admin_url( "admin-ajax.php" );
		$gallery_default_params = photo_gallery_wp_get_general_options();
		$gallery_params         = array();
		foreach ( $gallery_default_params as $name => $value ) {
			$gallery_params[ $name ] = get_option( $name );
		}
		$query = $wpdb->prepare( "SELECT image_url FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE gallery_id=%d", $id );
		$images       = $wpdb->get_col( $query );
		$has_youtube  = 'false';
		$has_vimeo    = 'false';
		$view_slug    = $view_slug = photo_gallery_wp_get_view_slag_by_id( $id );
		foreach ( $images as $image_row ) {
			if ( strpos( $image_row, 'youtu' ) !== false ) {
				$has_youtube = 'true';
			}
			if ( strpos( $image_row, 'vimeo' ) !== false ) {
				$has_vimeo = 'true';
			}
		}

		$gallery_view = $gallery[0]->photo_gallery_wp_sl_effects;

		$ph_lightbox_options        = array(
			'ph_lightbox_speed'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_speed,
			'ph_lightbox_style_view'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_style_view,
			'ph_slide_animation_type'            => Photo_Gallery_WP()->lightbox_settings->ph_slide_animation_type,
			'ph_lightbox_slider_animation'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_slider_animation,
			'ph_lightbox_overlay_close'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_overlay_close,
			'ph_lightbox_loop'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_loop,
			'ph_lightbox_esc_key_close'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_esc_key_close,
			'ph_lightbox_keypress_navigation'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_keypress_navigation,
			'ph_lightbox_arrows'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_arrows,
			'ph_lightbox_download_image'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_download_image,
			'ph_lightbox_default_title'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_default_title,
			'ph_lightbox_slideshow_on'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_slideshow_on,
			'ph_lightbox_slideshow_auto'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_slideshow_auto,
			'ph_lightbox_slideshow_speed'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_slideshow_speed,
			'ph_lightbox_size_fix'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_size_fix,
			'ph_lightbox_social_on_off'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_on_off,
			'ph_lightbox_social_facebook'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_facebook,
			'ph_lightbox_social_twitter'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_twitter,
			'ph_lightbox_social_google'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_google,
			'ph_lightbox_social_pinterest'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_pinterest,
			'ph_lightbox_social_linkedin'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_linkedin,
			'ph_lightbox_social_tumblr'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_tumblr,
			'ph_lightbox_social_reddit'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_reddit,
			'ph_lightbox_social_buffer'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_buffer,
			'ph_lightbox_social_digg'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_digg,
			'ph_lightbox_social_vk'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_vk,
			'ph_lightbox_social_yummly'            => Photo_Gallery_WP()->lightbox_settings->ph_lightbox_social_yummly
		);

		$ph_re_slider_options        = array(
			'ph_re_slider_widht'            => $gallery[0]->sl_width,
			'ph_re_slider_height'            => $gallery[0]->sl_height,
			'ph_re_slider_effects'            => $gallery[0]->gallery_list_effects_s,
			'ph_re_slider_pause_time'            => $gallery[0]->description,
			'ph_re_slider_change_speed'            => $gallery[0]->param,
			'pause_on_hover'                     => $gallery[0]->pause_on_hover,
			'ph_re_slider_position'            => $gallery[0]->sl_position,
			'ph_re_slider_show_thumbnails'            => Photo_Gallery_WP()->settings->slider_show_thumbnails,
			'ph_re_slider_show_thumbnails_show_all'            => Photo_Gallery_WP()->settings->slider_thumbnails_position,
			'ph_re_slider_show_bullets'            => Photo_Gallery_WP()->settings->slider_show_bullets,
			'ph_re_slider_show_bullets_orientation'            => Photo_Gallery_WP()->settings->slider_bullets_orientation,
			'ph_re_slider_show_bullets_Spacing_x'            => Photo_Gallery_WP()->settings->slider_inline_space_horizontal,
			'ph_re_slider_show_bullets_Spacing_y'            => Photo_Gallery_WP()->settings->slider_inline_space_vertical,
			'ph_re_slider_show_arrows'            => Photo_Gallery_WP()->settings->slider_show_arrows,
		);


		$justified        = array(
			'imagemargin'            => Photo_Gallery_WP()->settings->view8_element_padding,
			'imagerandomize'         => Photo_Gallery_WP()->settings->view8_element_randomize,
			'imagecssAnimation'      => Photo_Gallery_WP()->settings->view8_element_cssAnimation,
			'imagecssAnimationSpeed' => Photo_Gallery_WP()->settings->view8_element_animation_speed,
			'imageheight'            => Photo_Gallery_WP()->settings->view8_element_height,
			'imagejustify'           => Photo_Gallery_WP()->settings->view8_element_justify,
			'imageshowcaption'       => Photo_Gallery_WP()->settings->view8_element_show_caption,
		);
		$justified_params = array();
		foreach ( $justified as $name => $value ) {
			$justified_params[ $name ] = $value;
		}

		wp_localize_script( 'ph-front-end-js-'.$view_slug, 're_slider_obj', $ph_re_slider_options );
		wp_localize_script( 'ph-front-end-js-'.$view_slug, 'param_obj', $gallery_params );
		wp_localize_script( 'ph-front-end-js-'.$view_slug, 'gallery_obj', $gallery );
		wp_localize_script( 'ph-front-end-js-'.$view_slug, 'adminUrl', $admin_url );
		wp_localize_script( 'ph-front-end-js-'.$view_slug, 'postID', $pID );
		wp_localize_script( 'ph-front-end-js-'.$view_slug, 'hasYoutube', $has_youtube );
		wp_localize_script( 'ph-front-end-js-'.$view_slug, 'hasVimeo', $has_vimeo );
		wp_localize_script( 'ph-front-end-js-'.$view_slug, 'photo_param_obj', (array) Photo_Gallery_WP()->settings );
		wp_localize_script( 'ph-lightbox-js', 'lightbox_obj', $ph_lightbox_options );
		wp_localize_script( 'custom-js', 'galleryId', $id );
		wp_localize_script( 'jusiifed-js', 'justified_obj', $justified );  
	}
}

new Photo_Gallery_WP_Frontend_Scripts();