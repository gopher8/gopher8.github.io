<?php

/**
 * Class Photo_Gallery_WP_Lightbox_Settings
 */
class Photo_Gallery_WP_Lightbox_Settings extends WPDEV_Settings_API {

	public $plugin_id = 'photo_gallery_wp';

	public function __construct(){
		$config = array(
			'menu_slug' => 'photo_gallery_wp_lightbox_options',
			'parent_slug' => 'photo_gallery_wp_gallery',
			'page_title' => __( 'Lightbox Options', 'photo-gallery-wp' ),
			'title' => __('Photo Gallery WP Lightbox Options','photo-gallery-wp'),
			'menu_title'=> __( 'Lightbox Options', 'photo-gallery-wp' ),
		);
		$this->init();
		$this->init_sections();
		$this->init_controls();

		parent::__construct( $config);
		$this->add_css('free-banner',Photo_Gallery_WP()->plugin_url()."/assets/style/free-banner.css");
	}

	/**
	 * Initialize user defined variables
	 */
	public function init(){
		$this->ph_lightbox_style_view = $this->get_option('ph_lightbox_style_view', 1);
		$this->ph_slide_animation_type = $this->get_option('ph_slide_animation_type', 1);
		$this->ph_lightbox_speed = $this->get_option('ph_lightbox_speed', 600);
		$this->ph_lightbox_slider_animation = $this->get_option('ph_lightbox_slider_animation', 'yes');
		$this->ph_lightbox_overlay_close = $this->get_option('ph_lightbox_overlay_close', 'yes');
		$this->ph_lightbox_loop = $this->get_option('ph_lightbox_loop', 'yes');
		$this->ph_lightbox_esc_key_close = $this->get_option('ph_lightbox_esc_key_close', 'yes');
		$this->ph_lightbox_keypress_navigation = $this->get_option('ph_lightbox_keypress_navigation', 'yes');
		$this->ph_lightbox_arrows = $this->get_option('ph_lightbox_arrows', 'yes');
		$this->ph_lightbox_download_image = $this->get_option('ph_lightbox_download_image', 'yes');
		$this->ph_lightbox_default_title = $this->get_option('ph_lightbox_default_title', 'Default Title');
		$this->ph_lightbox_slideshow_on = $this->get_option('ph_lightbox_slideshow_on', 'yes');
		$this->ph_lightbox_slideshow_auto = $this->get_option('ph_lightbox_slideshow_auto', 'no');
		$this->ph_lightbox_slideshow_speed = $this->get_option('ph_lightbox_slideshow_speed', 2500);
		$this->ph_lightbox_size_fix = $this->get_option('ph_lightbox_size_fix', 'yes');
		$this->ph_lightbox_social_on_off = $this->get_option('ph_lightbox_social_on_off', 'no');
		$this->ph_lightbox_social_facebook = $this->get_option('ph_lightbox_social_facebook', 'yes');
		$this->ph_lightbox_social_twitter = $this->get_option('ph_lightbox_social_twitter', 'yes');
		$this->ph_lightbox_social_google = $this->get_option('ph_lightbox_social_google', 'yes');
		$this->ph_lightbox_social_pinterest = $this->get_option('ph_lightbox_social_pinterest', 'yes');
		$this->ph_lightbox_social_linkedin = $this->get_option('ph_lightbox_social_linkedin', 'yes');
		$this->ph_lightbox_social_tumblr = $this->get_option('ph_lightbox_social_tumblr', 'yes');
		$this->ph_lightbox_social_reddit = $this->get_option('ph_lightbox_social_reddit', 'no');
		$this->ph_lightbox_social_buffer = $this->get_option('ph_lightbox_social_buffer', 'no');
		$this->ph_lightbox_social_digg = $this->get_option('ph_lightbox_social_digg', 'no');
		$this->ph_lightbox_social_vk = $this->get_option('ph_lightbox_social_vk', 'no');
		$this->ph_lightbox_social_yummly = $this->get_option('ph_lightbox_social_yummly', 'no');
	}

	public function init_sections(){
		$this->sections = array(
			'general' => array(
				'title' => __('Internationalization','photo-gallery-wp'),
				'disabled' => true,
				'disabled_link' => 'https://goo.gl/LwtCFf'
			),
			'slideshow' => array(
				'title' => __('Slideshow','photo-gallery-wp'),
				'disabled' => true,
				'disabled_link' => 'https://goo.gl/LwtCFf'
			),
			'dimensions' => array(
				'title' => __('Dimensions','photo-gallery-wp'),
				'disabled' => true,
				'disabled_link' => 'https://goo.gl/LwtCFf'
			),
			'social_buttons' => array(
				'title' => __('Social Buttons','photo-gallery-wp'),
				'disabled' => true,
				'disabled_link' => 'https://goo.gl/LwtCFf'
			)
		);
	}

	public function init_controls(){
		$this->controls = array(
			'ph_lightbox_social_on_off' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_on_off,
				'label' => __('Social Buttons', 'photo-gallery-wp')
			),
			'ph_lightbox_social_facebook' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_facebook,
				'label' => __('Facebook', 'photo-gallery-wp')
			),
			'ph_lightbox_social_twitter' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_twitter,
				'label' => __('Twitter', 'photo-gallery-wp')
			),
			'ph_lightbox_social_google' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_google,
				'label' => __('Google Plus', 'photo-gallery-wp')
			),
			'ph_lightbox_social_pinterest' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_pinterest,
				'label' => __('Pinterest', 'photo-gallery-wp')
			),
			'ph_lightbox_social_linkedin' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_linkedin,
				'label' => __('Linkedin', 'photo-gallery-wp')
			),
			'ph_lightbox_social_tumblr' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_tumblr,
				'label' => __('Tumblr', 'photo-gallery-wp')
			),
			'ph_lightbox_social_reddit' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_reddit,
				'label' => __('Reddit', 'photo-gallery-wp')
			),
			'ph_lightbox_social_buffer' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_buffer,
				'label' => __('Buffer', 'photo-gallery-wp')
			),
			'ph_lightbox_social_digg' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_digg,
				'label' => __('Digg', 'photo-gallery-wp')
			),
			'ph_lightbox_social_vk' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_vk,
				'label' => __('VK', 'photo-gallery-wp')
			),
			'ph_lightbox_social_yummly' => array(
				'section' => 'social_buttons',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_social_yummly,
				'label' => __('Yummly', 'photo-gallery-wp')
			),
			'ph_lightbox_style_view' => array(
				'section' => 'general',
				'type' => 'select',
				'default' => $this->ph_lightbox_style_view,
				'choices' => array (
					4 => '4',
					3 => '3',
					2 => '2',
					1 => '1',
				),
				'label' => __('Lightbox style','photo-gallery-wp')
			),
			'ph_slide_animation_type' => array(
				'section' => 'general',
				'type' => 'select',
				'default' => $this->ph_slide_animation_type,
				'choices' => array (
					8 => '9',
					7 => '8',
					6 => '7',
					5 => '6',
					4 => '5',
					3 => '4',
					2 => '3',
					1 => '2',
					0 => '1',
				),
				'label' => __('Slide Animation Type','photo-gallery-wp')
				),
			'ph_lightbox_speed' => array(
				'section' => 'general',
				'type' => 'number',
				'default' => $this->ph_lightbox_speed,
				'label' => __('Speed', 'photo-gallery-wp')
			),
			'ph_lightbox_slider_animation' => array(
				'section' => 'general',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_slider_animation,
				'label' => __('Slider Animation', 'photo-gallery-wp')
			),
			'ph_lightbox_overlay_close' => array(
				'section' => 'general',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_overlay_close,
				'label' => __('Overlay Close', 'photo-gallery-wp')
			),
			'ph_lightbox_loop' => array(
				'section' => 'general',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_loop,
				'label' => __('Loop', 'photo-gallery-wp')
			),
			'ph_lightbox_esc_key_close' => array(
				'section' => 'general',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_esc_key_close,
				'label' => __('Esc Key close', 'photo-gallery-wp')
			),
			'ph_lightbox_keypress_navigation' => array(
				'section' => 'general',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_keypress_navigation,
				'label' => __('Keyboard navigation', 'photo-gallery-wp')
			),
			'ph_lightbox_arrows' => array(
				'section' => 'general',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_arrows,
				'label' => __('Arrows', 'photo-gallery-wp')
			),
			'ph_lightbox_download_image' => array(
				'section' => 'general',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_download_image,
				'label' => __('Download', 'photo-gallery-wp')
			),
			'ph_lightbox_default_title' => array(
				'section' => 'general',
				'type' => 'text',
				'default' => $this->ph_lightbox_default_title,
				'label' => __('Default Title', 'photo-gallery-wp')
			),
			'ph_lightbox_slideshow_on' => array(
				'section' => 'slideshow',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_slideshow_on,
				'label' => __('Slideshow', 'photo-gallery-wp')
			),
			'ph_lightbox_slideshow_auto' => array(
				'section' => 'slideshow',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_slideshow_auto,
				'label' => __('Slideshow auto', 'photo-gallery-wp')
			),
			'ph_lightbox_slideshow_speed' => array(
				'section' => 'slideshow',
				'type' => 'number',
				'default' => $this->ph_lightbox_slideshow_speed,
				'label' => __('Slideshow Speed', 'photo-gallery-wp')
			),
			'ph_lightbox_size_fix' => array(
				'section' => 'dimensions',
				'type' => 'checkbox',
				'default' => $this->ph_lightbox_size_fix,
				'label' => __('Popup size fix', 'photo-gallery-wp')
			),
		);
	}
}