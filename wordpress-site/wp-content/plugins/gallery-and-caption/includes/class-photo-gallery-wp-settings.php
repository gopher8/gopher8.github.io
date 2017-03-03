<?php

class Photo_Gallery_WP_Settings extends WPDEV_Settings_API
{
    public $plugin_id = 'photo_gallery_wp';

    public function __construct(){
        $config = array(
            'menu_slug' => 'photo_gallery_wp_general_options',
            'parent_slug' => 'photo_gallery_wp_gallery',
            'page_title' => __( 'General Options', 'photo-gallery-wp' ),
            'title' => __('Photo Gallery WP General Options','photo-gallery-wp'),
            'menu_title'=> __( 'General Options', 'photo-gallery-wp' ),
        );
        $this->init();
        $this->init_panels();
        $this->init_sections();
        $this->init_controls();

        parent::__construct( $config);
        $this->add_css('free-banner',Photo_Gallery_WP()->plugin_url()."/assets/style/free-banner.css");
    }

    /**
     * Initialize user defined variables
     */
    public function init(){
        $this->init_gallery_content_pop_up();
        $this->init_content_slider();
        $this->init_lightbox_gallery();
        $this->init_controls_thumbnails();
        $this->init_controls_justified();
        $this->init_controls_slider();
        $this->init_controls_masonry();
        $this->init_controls_mosaic();
    }

    /**
     *
     */
    public function init_panels(){
        $this->panels = array(
            'gallery_content_pop_up' => array(
                'title' => __('Gallery / Content Pop Up','photo-gallery-wp'),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            ),
            'content_slider' => array (
                'title' => __( 'Content Slider', 'photo-gallery-wp' ),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            ),
            'lightbox_gallery' => array (
                'title' => __( 'Lightbox-Gallery', 'photo-gallery-wp' ),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            ),
            'slider' => array (
                'title' => __( 'Slider', 'photo-gallery-wp' ),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            ),
            'thumbnails' => array (
                'title' => __( 'Thumbnails', 'photo-gallery-wp' ),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            ),
            'justified' => array (
                'title' => __( 'Justified', 'photo-gallery-wp' ),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            ),
            'masonry' => array(
                'title' => __( 'Masonry', 'photo-gallery-wp' ),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            ),
            'mosaic' => array(
                'title' => __( 'Mosaic', 'photo-gallery-wp' ),
                'disabled' => true,
                'disabled_link' => 'https://goo.gl/LwtCFf'
            )
        );
    }

    public function init_sections(){
        $this->sections = array(
            'content_styles' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Content Styles', 'photo-gallery-wp' ),
            ),
            'element_styles' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Element Styles', 'photo-gallery-wp' ),
            ),
            'popup_styles' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Popup Styles', 'photo-gallery-wp' ),
            ),
            'pagination_styles' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Pagination Styles', 'photo-gallery-wp' ),
            ),
            'load_more_styles' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Load More Styles', 'photo-gallery-wp' ),
            ),
            'element_title' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Element Title', 'photo-gallery-wp' ),
            ),
            'element_link_button' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Element Link Button', 'photo-gallery-wp' ),
            ),
            'popup_title' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Popup Title', 'photo-gallery-wp' ),
            ),
            'popup_description' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Popup Description', 'photo-gallery-wp' ),
            ),
            'popup_link_button' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Popup Link Button', 'photo-gallery-wp' ),
            ),
            'rating_styles' => array(
                'panel' => 'gallery_content_pop_up',
                'title' => __( 'Ratings Styles', 'photo-gallery-wp' ),
            ),
            'content_slider_container' => array (
                'panel' => 'content_slider',
                'title' => __( 'Slider Container', 'photo-gallery-wp' ),
            ),
            'content_slider_link_button' => array (
                'panel' => 'content_slider',
                'title' => __( 'Link Button', 'photo-gallery-wp' ),
            ),
            'content_slider_title' => array (
                'panel' => 'content_slider',
                'title' => __( 'Title', 'photo-gallery-wp' ),
            ),
            'content_slider_description' => array (
                'panel' => 'content_slider',
                'title' => __( 'Description', 'photo-gallery-wp' ),
            ),
            'content_slider_rating_styles' => array (
                'panel' => 'content_slider',
                'title' => __( 'Ratings Styles', 'photo-gallery-wp' ),
            ),
            'lightbox_gallery_content_styles' => array (
                'panel' => 'lightbox_gallery',
                'title' => __( 'Content Styles', 'photo-gallery-wp' ),
            ),
            'lightbox_gallery_load_more_styles' => array (
                'panel' => 'lightbox_gallery',
                'title' => __( 'Load More Styles', 'photo-gallery-wp' ),
            ),
            'lightbox_gallery_image' => array (
                'panel' => 'lightbox_gallery',
                'title' => __( 'Image', 'photo-gallery-wp' ),
            ),
            'lightbox_gallery_title' => array (
                'panel' => 'lightbox_gallery',
                'title' => __( 'Title', 'photo-gallery-wp' ),
            ),
            'lightbox_gallery_pagination_styles' => array (
                'panel' => 'lightbox_gallery',
                'title' => __( 'Pagination Styles', 'photo-gallery-wp' ),
            ),
            'lightbox_gallery_rating_styles' => array (
                'panel' => 'lightbox_gallery',
                'title' => __( 'Ratings Styles', 'photo-gallery-wp' ),
            ),
            'thumbnails_container_slider' => array (
                'panel' => 'thumbnails',
                'title' => __( 'Container Style', 'photo-gallery-wp' ),
            ),
            'thumbnails_title' => array (
                'panel' => 'thumbnails',
                'title' => __( 'Title', 'photo-gallery-wp' ),
            ),
            'thumbnails_load_more_styles' => array (
                'panel' => 'thumbnails',
                'title' => __( 'Load More Styles', 'photo-gallery-wp' ),
            ),
            'thumbnails_image' => array (
                'panel' => 'thumbnails',
                'title' => __( 'Image', 'photo-gallery-wp' ),
            ),
            'thumbnails_pagination_style' => array (
                'panel' => 'thumbnails',
                'title' => __( 'Pagination Styles', 'photo-gallery-wp' ),
            ),
            'thumbnails_rating_styles' => array (
                'panel' => 'thumbnails',
                'title' => __( 'Ratings Styles', 'photo-gallery-wp' ),
            ),
            'justified_element_styles' => array (
                'panel' => 'justified',
                'title' => __( 'Element Styles', 'photo-gallery-wp' ),
            ),
            'justified_load_more_styles' => array (
                'panel' => 'justified',
                'title' => __( 'Load More Styles', 'photo-gallery-wp' ),
            ),
            'justified_element_title' => array (
                'panel' => 'justified',
                'title' => __( 'Element Title', 'photo-gallery-wp' ),
            ),
            'justified_pagination_style' => array (
                'panel' => 'justified',
                'title' => __( 'Pagination Styles', 'photo-gallery-wp' ),
            ),
            'justified_rating_styles' => array (
                'panel' => 'justified',
                'title' => __( 'Ratings Styles', 'photo-gallery-wp' ),
            ),
            'slider_options' => array (
                'panel' => 'slider',
                'title' => __( 'Slider options', 'photo-gallery-wp' ),
            ),
            'slider_arrows' => array (
                'panel' => 'slider',
                'title' => __( 'Arrows', 'photo-gallery-wp' ),
            ),
            'slider_thumbnail' => array (
                'panel' => 'slider',
                'title' => __( 'Thumbnails', 'photo-gallery-wp' ),
            ),
            'slider_bullet' => array (
                'panel' => 'slider',
                'title' => __( 'Bullets', 'photo-gallery-wp' ),
            ),
            'slider_title' => array (
                'panel' => 'slider',
                'title' => __( 'Title', 'photo-gallery-wp' ),
            ),
            'slider_description' => array (
                'panel' => 'slider',
                'title' => __( 'Description', 'photo-gallery-wp' ),
            ),
            'masonry_content_styles' => array (
                'panel' => 'masonry',
                'title' => __( 'Content Styles', 'photo-gallery-wp' ),
            ),
            'masonry_image_styles' => array (
                'panel' => 'masonry',
                'title' => __( 'Image Styles', 'photo-gallery-wp' ),
            ),
            'masonry_title_styles' => array (
                'panel' => 'masonry',
                'title' => __( 'Title Styles', 'photo-gallery-wp' ),
            ),
            'masonry_rating_styles' => array (
                'panel' => 'masonry',
                'title' => __( 'Ratings Styles', 'photo-gallery-wp' ),
            ),
            'masonry_load_more_styles' => array (
                'panel' => 'masonry',
                'title' => __( 'Load More Styles', 'photo-gallery-wp' ),
            ),
            'masonry_pagination_styles' => array (
                'panel' => 'masonry',
                'title' => __( 'Pagination Styles', 'photo-gallery-wp' ),
            ),
            'mosaic_content_styles' => array (
                'panel' => 'mosaic',
                'title' => __( 'Content Styles', 'photo-gallery-wp' ),
            ),
            'mosaic_image_styles' => array (
                'panel' => 'mosaic',
                'title' => __( 'Image Styles', 'photo-gallery-wp' ),
            ),
            'mosaic_title_styles' => array (
                'panel' => 'mosaic',
                'title' => __( 'Title Styles', 'photo-gallery-wp' ),
            ),
        );
    }

    /**
     * Display the admin page
     */
    public function init_controls()
    {
        $this->controls = array();
        $controls_gallery_content_pop_up = $this->controls_gallery_content_pop_up();
        $controls_content_slider = $this->controls_content_slider();
        $controls_lightbox_gallery = $this->controls_lightbox_gallery();
        $controls_thumbnails = $this->controls_thumbnails();
        $controls_justified = $this->controls_justified();
        $controls_slider = $this->controls_slider();
        $controls_masonry = $this->controls_masonry();
        $controls_mosaic = $this->controls_mosaic();

        foreach ($controls_gallery_content_pop_up as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }
        foreach ($controls_content_slider as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }
        foreach ($controls_lightbox_gallery as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }
        foreach ($controls_thumbnails as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }
        foreach ($controls_justified as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }
        foreach ($controls_slider as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }
        foreach ($controls_masonry as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }
        foreach ($controls_mosaic as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }

    }

    private function init_controls_slider()
    {
        $this->slider_show_arrows = $this->get_option("slider_show_arrows", 2);
        $this->slider_options_border = $this->get_option("slider_options_border", 0);
        $this->slider_options_border_color = $this->get_option("slider_options_border_color", 'CCCCCC');
        $this->slider_options_border_radius = $this->get_option("slider_options_border_radius", 0);
        $this->slider_arrows_buttons = $this->get_option("slider_arrows_buttons", 'arrows-0.png');
        $this->slider_show_thumbnails = $this->get_option("slider_show_thumbnails", 2);
        $this->slider_thumbnails_position = $this->get_option("slider_thumbnails_position", 'show_all');
        $this->slider_show_bullets = $this->get_option("slider_show_bullets", 2);
        $this->slider_bullets_position = $this->get_option("slider_bullets_position", 1);
        $this->slider_bullets_background = $this->get_option("slider_bullets_background", 'CCCCCC');
        $this->slider_bullets_background_hover = $this->get_option("slider_bullets_background_hover", '646464');
        $this->slider_bullets_orientation = $this->get_option("slider_bullets_orientation", 1);
        $this->slider_bullets_rows = $this->get_option("slider_bullets_rows", 1);
        $this->slider_inline_space_horizontal = $this->get_option("slider_inline_space_horizontal", 10);
        $this->slider_inline_space_vertical = $this->get_option("slider_inline_space_vertical", 10);
        $this->slider_title_hover_color = $this->get_option("slider_title_hover_color", '30FF4F');
        $this->slider_title_opacity = $this->get_option("slider_title_opacity", 0);
        $this->slider_title_border = $this->get_option("slider_title_border", 1);
        $this->slider_title_border_color = $this->get_option("slider_title_border_color", 'FFFFFF');
        $this->slider_title_border_raduis = $this->get_option("slider_title_border_raduis", 2);
        $this->slider_title_font_size = $this->get_option("slider_title_font_size", 18);
        $this->slider_title_font_color = $this->get_option("slider_title_font_color", 'FFFFFF');
        $this->slider_description_color = $this->get_option("slider_description_color", '000000');
        $this->slider_description_text_color = $this->get_option("slider_description_text_color", '000000');
        $this->slider_description_hover_color = $this->get_option("slider_description_hover_color", '000000');
        $this->slider_description_opacity = $this->get_option("slider_description_opacity", 80);
        $this->slider_description_border = $this->get_option("slider_description_border", 0);
        $this->slider_description_border_color = $this->get_option("slider_description_border_color", 'FFDB47');
        $this->slider_description_border_raduis = $this->get_option("slider_description_border_raduis", 2);
        $this->slider_description_font_size = $this->get_option("slider_description_font_size", 14);
        $this->slider_description_font_color = $this->get_option("slider_description_font_color", 'FFFFFF');
    }

    private function controls_slider()
    {
        return array (
            'slider_show_arrows' => array(
                'section' => 'slider_arrows',
                'type' => 'select',
                'choices' => array (
                    2 => 'Always',
                    1 => 'On Hover',
                    0 => 'Never',
                ),
                'default' => $this->slider_show_arrows,
                'label' => __('Show Arrows', 'photo-gallery-wp'),
                'help' => __('slider_show_arrows', 'photo-gallery-wp')
            ),
            'slider_options_border' => array(
                'section' => 'slider_options',
                'type' => 'number',
                'default' => $this->slider_options_border,
                'label' => __('Slider Border', 'photo-gallery-wp'),
            ),
            'slider_options_border_color' => array(
                'section' => 'slider_options',
                'type' => 'color',
                'default' => $this->slider_options_border_color,
                'label' => __('Slider Border Color', 'photo-gallery-wp'),
            ),
            'slider_options_border_radius' => array(
                'section' => 'slider_options',
                'type' => 'number',
                'default' => $this->slider_options_border_radius,
                'label' => __('Slider Border Radius', 'photo-gallery-wp'),
            ),
            'slider_arrows_buttons' => array(
                'section' => 'slider_arrows',
                'type' => 'image_radio',
                'default' => $this->slider_arrows_buttons,
                'label' => __('Arrows Styles', 'photo-gallery-wp'),
                'help' => __('slider_arrows_buttons', 'photo-gallery-wp'),
                'width' => 80,
                'height' => 80,
                'choices' => array(
                    'arrows-0.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-0.png',
                    'arrows-1.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-1.png',
                    'arrows-2.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-2.png',
                    'arrows-3.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-3.png',
                    'arrows-4.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-4.png',
                    'arrows-5.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-5.png',
                    'arrows-6.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-6.png',
                    'arrows-7.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-7.png',
                    'arrows-8.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-8.png',
                    'arrows-9.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-9.png',
                    'arrows-10.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-10.png',
                    'arrows-11.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-11.png',
                    'arrows-12.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-12.png',
                    'arrows-13.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-13.png',
                    'arrows-14.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-14.png',
                    'arrows-15.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-15.png',
                    'arrows-16.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-16.png',
                    'arrows-17.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-17.png',
                    'arrows-18.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-18.png',
                    'arrows-19.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-19.png',
                    'arrows-20.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-20.png',
                    'arrows-21.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-21.png',
                    'arrows-34.png' => PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/arrows-34.png',
                )
            ),
            'slider_show_thumbnails' => array(
                'section' => 'slider_thumbnail',
                'type' => 'select',
                'choices' => array (
                    2 => 'Always',
                    1 => 'On Hover',
                    0 => 'Never',
                ),
                'default' => $this->slider_show_thumbnails,
                'label' => __('Show Thumbnails', 'photo-gallery-wp'),
                'help' => __('slider_show_thumbnails', 'photo-gallery-wp')
            ),
            'slider_thumbnails_position' => array(
                'section' => 'slider_thumbnail',
                'type' => 'select',
                'choices' => array (
                    'default' => 'Default',
                    'show_all' => 'Show All',
                ),
                'default' => $this->slider_thumbnails_position,
                'label' => __('Position', 'photo-gallery-wp'),
                'help' => __('slider_thumbnails_position', 'photo-gallery-wp')
            ),
            'slider_show_bullets' => array(
                'section' => 'slider_bullet',
                'type' => 'select',
                'choices' => array (
                    2 => 'Always',
                    1 => 'On Hover',
                    0 => 'Never',
                ),
                'default' => $this->slider_show_bullets,
                'label' => __('Show Bullets', 'photo-gallery-wp'),
                'help' => __('slider_show_bullets', 'photo-gallery-wp')
            ),
            'slider_bullets_position' => array(
                'section' => 'slider_bullet',
                'type' => 'radio_position',
                'choices' => array (1,2,3,4,5,6,7,8,9,),
                'default' => $this->slider_bullets_position,
                'label' => __('Position', 'photo-gallery-wp'),
                'help' => __('slider_bullets_position', 'photo-gallery-wp')
            ),
            'slider_bullets_background' => array(
                'section' => 'slider_bullet',
                'type' => 'color',
                'default' => $this->slider_bullets_background,
                'label' => __('Bullets Background', 'photo-gallery-wp'),
                'help' => __('slider_bullets_background', 'photo-gallery-wp')
            ),
            'slider_bullets_background_hover' => array(
                'section' => 'slider_bullet',
                'type' => 'color',
                'default' => $this->slider_bullets_background_hover,
                'label' => __('Bullets Background on Hover', 'photo-gallery-wp'),
                'help' => __('slider_bullets_background_hover', 'photo-gallery-wp')
            ),
            'slider_bullets_orientation' => array(
                'section' => 'slider_bullet',
                'type' => 'radio',
                'default' => $this->slider_bullets_orientation,
                'choices' => array(
                    0 => 'Horizontal',
                    1 => 'Vertical',
                ),
                'label' => __('Orientation', 'photo-gallery-wp'),
                'help' => __('slider_bullets_orientation', 'photo-gallery-wp')
            ),
            'slider_bullets_rows' => array(
                'section' => 'slider_bullet',
                'type' => 'number',
                'attrs' => array(
                    'min' => 1
                ),
                'default' => $this->slider_bullets_rows,
                'label' => __('Rows', 'photo-gallery-wp'),
                'help' => __('slider_bullets_rows', 'photo-gallery-wp')
            ),
            'slider_inline_space_horizontal' => array(
                'section' => 'slider_bullet',
                'type' => 'number',
                'attrs' => array(
                    'min' => 1
                ),
                'default' => $this->slider_inline_space_horizontal,
                'label' => __('Inline Space(px) Horizontal', 'photo-gallery-wp'),
                'help' => __('slider_inline_space_horizontal', 'photo-gallery-wp')
            ),
            'slider_inline_space_vertical' => array(
                'section' => 'slider_bullet',
                'type' => 'number',
                'attrs' => array(
                    'min' => 1
                ),
                'default' => $this->slider_inline_space_vertical,
                'label' => __('Inline Space(px) Vertical', 'photo-gallery-wp'),
                'help' => __('slider_inline_space_vertical', 'photo-gallery-wp')
            ),
            'slider_title_hover_color' => array(
                'section' => 'slider_title',
                'type' => 'color',
                'default' => $this->slider_title_hover_color,
                'label' => __('Hover Color', 'photo-gallery-wp'),
                'help' => __('slider_title_hover_color', 'photo-gallery-wp')
            ),
            'slider_title_opacity' => array(
                'section' => 'slider_title',
                'type' => 'simple_slider',
                'default' => $this->slider_title_opacity,
                'label' => __('Opacity(%)', 'photo-gallery-wp'),
                'choices' => range(0,100)
            ),
            'slider_title_border' => array(
                'section' => 'slider_title',
                'type' => 'number',
                'default' => $this->slider_title_border,
                'label' => __('Border (px)', 'photo-gallery-wp'),
                'help' => __('slider_title_border', 'photo-gallery-wp')
            ),
            'slider_title_border_color' => array(
                'section' => 'slider_title',
                'type' => 'color',
                'default' => $this->slider_title_border_color,
                'label' => __('Border Color', 'photo-gallery-wp'),
                'help' => __('slider_title_border_color', 'photo-gallery-wp')
            ),
            'slider_title_border_raduis' => array(
                'section' => 'slider_title',
                'type' => 'number',
                'attrs' => array(
                    'min' => 0
                ),
                'default' => $this->slider_title_border_raduis,
                'label' => __('Border Radius', 'photo-gallery-wp'),
                'help' => __('slider_title_border_raduis', 'photo-gallery-wp')
            ),
            'slider_title_font_size' => array(
                'section' => 'slider_title',
                'type' => 'number',
                'attrs' => array(
                    'min' => 4
                ),
                'default' => $this->slider_title_font_size,
                'label' => __('Font Size (px)', 'photo-gallery-wp'),
                'help' => __('slider_title_font_size', 'photo-gallery-wp')
            ),
            'slider_title_font_color' => array(
                'section' => 'slider_title',
                'type' => 'color',
                'default' => $this->slider_title_font_color,
                'label' => __('Font Color', 'photo-gallery-wp'),
                'help' => __('slider_title_font_color', 'photo-gallery-wp')
            ),
            'slider_description_color' => array(
                'section' => 'slider_title',
                'type' => 'color',
                'default' => $this->slider_description_color,
                'label' => __('Background Color', 'photo-gallery-wp'),
            ),
            'slider_description_text_color' => array(
                'section' => 'slider_description',
                'type' => 'color',
                'default' => $this->slider_description_text_color,
                'label' => __('Color', 'photo-gallery-wp'),
            ),
            'slider_description_hover_color' => array(
                'section' => 'slider_description',
                'type' => 'color',
                'default' => $this->slider_description_hover_color,
                'label' => __('Hover Color', 'photo-gallery-wp'),
            ),
            'slider_description_opacity' => array(
                'section' => 'slider_description',
                'type' => 'simple_slider',
                'default' => $this->slider_description_opacity,
                'label' => __('Opacity(%)', 'photo-gallery-wp'),
                'choices' => range(0,100)
            ),
            'slider_description_border' => array(
                'section' => 'slider_description',
                'type' => 'number',
                'default' => $this->slider_description_border,
                'label' => __('Border (px)', 'photo-gallery-wp'),
            ),
            'slider_description_border_color' => array(
                'section' => 'slider_description',
                'type' => 'color',
                'default' => $this->slider_description_border_color,
                'label' => __('Border Color', 'photo-gallery-wp'),
            ),
            'slider_description_border_radius' => array(
                'section' => 'slider_description',
                'type' => 'number',
                'attrs' => array(
                    'min' => 0
                ),
                'default' => $this->slider_description_border_radius,
                'label' => __('Border Radius', 'photo-gallery-wp'),
            ),
            'slider_description_font_size' => array(
                'section' => 'slider_description',
                'type' => 'number',
                'attrs' => array(
                    'min' => 4
                ),
                'default' => $this->slider_description_font_size,
                'label' => __('Font Size (px)', 'photo-gallery-wp'),
            ),
            'slider_description_font_color' => array(
                'section' => 'slider_description',
                'type' => 'color',
                'default' => $this->slider_description_font_color,
                'label' => __('Background Color', 'photo-gallery-wp'),
            ),
        );
    }

    private function init_controls_justified()
    {
        $this->view8_element_height = $this->get_option("view8_element_height", 100);
        $this->view8_element_padding = $this->get_option("view8_element_padding", 0);
        $this->view8_element_justify = $this->get_option("view8_element_justify", 'yes');
        $this->view8_element_randomize = $this->get_option("view8_element_randomize", 'no');
        $this->view8_element_cssAnimation = $this->get_option("view8_element_cssAnimation", 'no');
        $this->video_view8_loadmore_text = $this->get_option("video_view8_loadmore_text", 'Load More');
        $this->video_view8_loadmore_position = $this->get_option("video_view8_loadmore_position", 'center');
        $this->view8_element_animation_speed = $this->get_option("view8_element_animation_speed", 2000);
        $this->video_view8_loadmore_fontsize = $this->get_option("video_view8_loadmore_fontsize", 14);
        $this->video_view8_loadmore_font_color = $this->get_option("video_view8_loadmore_font_color", 'FF1C1C');
        $this->video_view8_loadmore_font_color_hover = $this->get_option("video_view8_loadmore_font_color_hover", 'FF4242');
        $this->video_view8_button_color = $this->get_option("video_view8_button_color", '26A6FC');
        $this->video_view8_button_color_hover = $this->get_option("video_view8_button_color_hover", '0FEFFF');
        $this->video_view8_loading_type = $this->get_option("video_view8_loading_type", '3');
        $this->view8_element_show_caption = $this->get_option("view8_element_show_caption", 'yes');
        $this->view8_element_title_font_size = $this->get_option("view8_element_title_font_size", 13);
        $this->view8_element_title_font_color = $this->get_option("view8_element_title_font_color", '3AD6FC');
        $this->view8_element_title_background_color = $this->get_option("view8_element_title_background_color", 'FF1C1C');
        $this->view8_element_title_overlay_transparency = $this->get_option("view8_element_title_overlay_transparency", '90');
        $this->video_view8_paginator_fontsize = $this->get_option("video_view8_paginator_fontsize", 18);
        $this->video_view8_paginator_color = $this->get_option("video_view8_paginator_color", 'eeeeee');
        $this->video_view8_paginator_icon_color = $this->get_option("video_view8_paginator_icon_color", '26A6FC');
        $this->video_view8_paginator_icon_size = $this->get_option("video_view8_paginator_icon_size", 18);
        $this->video_view8_paginator_icon_color = $this->get_option("video_view8_paginator_icon_color", '26A6FC');
        $this->video_view8_paginator_position = $this->get_option("video_view8_paginator_position", 'center');
        $this->just_rating_count = $this->get_option("just_rating_count", 'no');
        $this->just_likedislike_bg = $this->get_option("just_likedislike_bg", 'FFFFFF');
        $this->just_likedislike_bg_trans = $this->get_option("just_likedislike_bg_trans", '0');
        $this->just_likedislike_font_color = $this->get_option("just_likedislike_font_color", '030303');
        $this->just_active_font_color = $this->get_option("just_active_font_color", 'EDEDED');
        $this->just_likedislike_thumb_color = $this->get_option("just_likedislike_thumb_color", 'FFFFFF');
        $this->just_likedislike_thumb_active_color = $this->get_option("just_likedislike_thumb_active_color", '0ECC5A');
        $this->just_heart_likedislike_thumb_color = $this->get_option("just_heart_likedislike_thumb_color", 'E0E0E0');
        $this->just_heart_likedislike_thumb_color = $this->get_option("just_heart_likedislike_thumb_color", 'E0E0E0');
        $this->just_heart_likedislike_thumb_active_color = $this->get_option("just_heart_likedislike_thumb_active_color", 'F23D3D');
    }

    private function controls_justified()
    {
        return array (
            'view8_element_height' => array(
                'section' => 'justified_element_styles',
                'type' => 'number',
                'default' => $this->view8_element_height,
                'label' => __('Image height in px', 'photo-gallery-wp'),
                'help' => __('view8_element_height', 'photo-gallery-wp')
            ),
            'view8_element_padding' => array(
                'section' => 'justified_element_styles',
                'type' => 'number',
                'default' => $this->view8_element_padding,
                'label' => __('Image margin in px', 'photo-gallery-wp'),
                'help' => __('view8_element_padding', 'photo-gallery-wp')
            ),
            'view8_element_justify' => array(
                'section' => 'justified_element_styles',
                'type' => 'checkbox',
                'default' => $this->view8_element_justify,
                'label' => __('Image Justify', 'photo-gallery-wp'),
                'help' => __('view8_element_justify', 'photo-gallery-wp')
            ),
            'view8_element_randomize' => array(
                'section' => 'justified_element_styles',
                'type' => 'checkbox',
                'default' => $this->view8_element_randomize,
                'label' => __('Image Randomize', 'photo-gallery-wp'),
                'help' => __('view8_element_randomize', 'photo-gallery-wp')
            ),
            'view8_element_cssAnimation' => array(
                'section' => 'justified_element_styles',
                'type' => 'checkbox',
                'default' => $this->view8_element_cssAnimation,
                'label' => __('Opening With Animation', 'photo-gallery-wp'),
                'help' => __('view8_element_cssAnimation', 'photo-gallery-wp')
            ),
            'view8_element_animation_speed' => array(
                'section' => 'justified_element_styles',
                'type' => 'number',
                'default' => $this->view8_element_animation_speed,
                'label' => __('Opening Animation Speed', 'photo-gallery-wp'),
                'help' => __('view8_element_animation_speed', 'photo-gallery-wp')
            ),
            'video_view8_loadmore_text' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'text',
                'default' => $this->video_view8_loadmore_text,
                'label' => __('Load More Text', 'photo-gallery-wp'),
                'help' => __('video_view8_loadmore_text', 'photo-gallery-wp')
            ),
            'video_view8_loadmore_position' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'select',
                'default' => $this->video_view8_loadmore_position,
                'label' => __('Load More Position', 'photo-gallery-wp'),
                'help' => __('video_view8_loadmore_position', 'photo-gallery-wp'),
                'choices' => array(
                    'left' => 'Left',
                    'center'=> 'Center',
                    'right' => 'Right'
                )
            ),
            'video_view8_loadmore_fontsize' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'number',
                'default' => $this->video_view8_loadmore_fontsize,
                'label' => __('Load More Font Size in px', 'photo-gallery-wp'),
                'help' => __('video_view8_loadmore_fontsize', 'photo-gallery-wp')
            ),
            'video_view8_loadmore_font_color' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view8_loadmore_font_color,
                'label' => __('Load More Font Color', 'photo-gallery-wp'),
                'help' => __('video_view8_loadmore_font_color', 'photo-gallery-wp')
            ),
            'video_view8_loadmore_font_color_hover' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view8_loadmore_font_color_hover,
                'label' => __('Load More Font Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view8_loadmore_font_color_hover', 'photo-gallery-wp')
            ),
            'video_view8_button_color' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view8_button_color,
                'label' => __('Load More Background Color', 'photo-gallery-wp'),
                'help' => __('video_view8_button_color', 'photo-gallery-wp')
            ),
            'video_view8_button_color_hover' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view8_button_color_hover,
                'label' => __('Load More Background Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view8_button_color_hover', 'photo-gallery-wp')
            ),
            'video_view8_loading_type' => array(
                'section' => 'justified_load_more_styles',
                'type' => 'image_radio',
                'default' => $this->video_view8_loading_type,
                'label' => __('Loading Animation', 'photo-gallery-wp'),
                'help' => __('video_view8_loading_type', 'photo-gallery-wp'),
                'width' => 30,
                'height' => 30,
                'choices' => array(
                    1 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading1.gif',
                    2 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading4.gif',
                    3 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading36.gif',
                    4 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading51.gif',
                )
            ),
            'view8_element_show_caption' => array(
                'section' => 'justified_element_title',
                'type' => 'checkbox',
                'default' => $this->view8_element_show_caption,
                'label' => __('Show Title', 'photo-gallery-wp'),
                'help' => __('view8_element_show_caption', 'photo-gallery-wp')
            ),
            'view8_element_title_font_size' => array(
                'section' => 'justified_element_title',
                'type' => 'number',
                'default' => $this->view8_element_title_font_size,
                'label' => __('Element Title Font Size', 'photo-gallery-wp'),
                'help' => __('view8_element_title_font_size', 'photo-gallery-wp')
            ),
            'view8_element_title_font_color' => array(
                'section' => 'justified_element_title',
                'type' => 'color',
                'default' => $this->view8_element_title_font_color,
                'label' => __('Element Title Font Color', 'photo-gallery-wp'),
                'help' => __('view8_element_title_font_color', 'photo-gallery-wp')
            ),
            'view8_element_title_background_color' => array(
                'section' => 'justified_element_title',
                'type' => 'color',
                'default' => $this->view8_element_title_background_color,
                'label' => __('Element Title Background Color', 'photo-gallery-wp'),
                'help' => __('view8_element_title_background_color', 'photo-gallery-wp')
            ),
            'view8_element_title_overlay_transparency' => array(
                'section' => 'justified_element_title',
                'type' => 'simple_slider',
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100),
                'default' => $this->view8_element_title_overlay_transparency,
                'label' => __('Elements Title Overlay Opacity', 'photo-gallery-wp'),
                'help' => __('view8_element_title_overlay_transparency', 'photo-gallery-wp')
            ),
            'video_view8_paginator_fontsize' => array(
                'section' => 'justified_pagination_style',
                'type' => 'number',
                'default' => $this->video_view8_paginator_fontsize,
                'label' => __('Pagination Font Size', 'photo-gallery-wp'),
                'help' => __('video_view8_paginator_fontsize', 'photo-gallery-wp')
            ),
            'video_view8_paginator_color' => array(
                'section' => 'justified_pagination_style',
                'type' => 'color',
                'default' => $this->video_view8_paginator_color,
                'label' => __('Pagination Font Color', 'photo-gallery-wp'),
                'help' => __('video_view8_paginator_color', 'photo-gallery-wp')
            ),
            'video_view8_paginator_icon_size' => array(
                'section' => 'justified_pagination_style',
                'type' => 'number',
                'default' => $this->video_view8_paginator_icon_size,
                'label' => __('Pagination Icons Size in px', 'photo-gallery-wp'),
                'help' => __('video_view8_paginator_icon_size', 'photo-gallery-wp')
            ),
            'video_view8_paginator_icon_color' => array(
                'section' => 'justified_pagination_style',
                'type' => 'color',
                'default' => $this->video_view8_paginator_icon_color,
                'label' => __('Pagination Icons Color', 'photo-gallery-wp'),
                'help' => __('video_view8_paginator_icon_color', 'photo-gallery-wp')
            ),
            'video_view8_paginator_position' => array(
                'section' => 'justified_pagination_style',
                'type' => 'select',
                'choices' => array(
                    'left' => 'Left',
                    'center'=> 'Center',
                    'right' => 'Right'
                ),
                'default' => $this->video_view8_paginator_position,
                'label' => __('Pagination Position', 'photo-gallery-wp'),
                'help' => __('video_view8_paginator_position', 'photo-gallery-wp')
            ),
            'just_rating_count' => array(
                'section' => 'justified_rating_styles',
                'type' => 'checkbox',
                'default' => $this->just_rating_count,
                'label' => __('Show Ratings Count', 'photo-gallery-wp'),
                'help' => __('just_rating_count', 'photo-gallery-wp')
            ),
            'just_likedislike_bg' => array(
                'section' => 'justified_rating_styles',
                'type' => 'color',
                'default' => $this->just_likedislike_bg,
                'label' => __('Ratings Background Color', 'photo-gallery-wp'),
                'help' => __('just_likedislike_bg', 'photo-gallery-wp')
            ),
            'just_likedislike_bg_trans' => array(
                'section' => 'justified_rating_styles',
                'type' => 'simple_slider',
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100),
                'default' => $this->just_likedislike_bg_trans,
                'label' => __('Ratings Background Color Opacity', 'photo-gallery-wp'),
                'help' => __('just_likedislike_bg_trans', 'photo-gallery-wp')
            ),
            'just_likedislike_font_color' => array(
                'section' => 'justified_rating_styles',
                'type' => 'color',
                'default' => $this->just_likedislike_font_color,
                'label' => __('Ratings Font Color', 'photo-gallery-wp'),
                'help' => __('just_likedislike_font_color', 'photo-gallery-wp')
            ),
            'just_active_font_color' => array(
                'section' => 'justified_rating_styles',
                'type' => 'color',
                'default' => $this->just_active_font_color,
                'label' => __('Ratings Rated Font Color', 'photo-gallery-wp'),
                'help' => __('just_active_font_color', 'photo-gallery-wp')
            ),
            'just_likedislike_thumb_color' => array(
                'section' => 'justified_rating_styles',
                'type' => 'color',
                'default' => $this->just_likedislike_thumb_color,
                'label' => __('Like/Dislike Icon Color', 'photo-gallery-wp'),
                'help' => __('just_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'just_likedislike_thumb_active_color' => array(
                'section' => 'justified_rating_styles',
                'type' => 'color',
                'default' => $this->just_likedislike_thumb_active_color,
                'label' => __('Like/Dislike Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('just_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
            'just_heart_likedislike_thumb_color' => array(
                'section' => 'justified_rating_styles',
                'type' => 'color',
                'default' => $this->just_heart_likedislike_thumb_color,
                'label' => __('Heart Icon Color', 'photo-gallery-wp'),
                'help' => __('just_heart_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'just_heart_likedislike_thumb_active_color' => array(
                'section' => 'justified_rating_styles',
                'type' => 'color',
                'default' => $this->just_heart_likedislike_thumb_active_color,
                'label' => __('Heart Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('just_heart_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
        );
    }

    private function init_controls_thumbnails()
    {
        $this->thumb_box_padding = $this->get_option("thumb_box_padding", 28);
        $this->thumb_box_background = $this->get_option("thumb_box_background", '333333');
        $this->thumb_box_use_shadow = $this->get_option("thumb_box_use_shadow", 'yes');
        $this->thumb_box_has_background = $this->get_option("thumb_box_has_background", 'yes');
        $this->thumb_title_font_size = $this->get_option("thumb_title_font_size", 16);
        $this->thumb_title_font_color = $this->get_option("thumb_title_font_color", 'FFFFFF');
        $this->thumb_title_background_color = $this->get_option("thumb_title_background_color", 'CCCCCC');
        $this->thumb_title_background_transparency = $this->get_option("thumb_title_background_transparency", '70');
        $this->thumb_view_text = $this->get_option("thumb_view_text", 'View Picture');
        $this->video_view7_loadmore_text = $this->get_option("video_view7_loadmore_text", 'View Picture');
        $this->video_view7_loadmore_position = $this->get_option("video_view7_loadmore_position", 'center');
        $this->video_view7_loadmore_fontsize = $this->get_option("video_view7_loadmore_fontsize", 19);
        $this->video_view7_loadmore_font_color = $this->get_option("video_view7_loadmore_font_color", 'CCCCCC');
        $this->video_view7_loadmore_font_color_hover = $this->get_option("video_view7_loadmore_font_color_hover", 'D9D9D9');
        $this->video_view7_button_color_hover = $this->get_option("video_view7_button_color_hover", '8F827C');
        $this->video_view7_loading_type = $this->get_option("video_view7_loading_type", '1');
        $this->image_natural_size_thumbnail = $this->get_option("image_natural_size_thumbnail", 'resize');
        $this->thumb_image_width = $this->get_option("thumb_image_width", 230);
        $this->thumb_image_height = $this->get_option("thumb_image_height", 150);
        $this->thumb_image_border_width = $this->get_option("thumb_image_border_width", 1);
        $this->thumb_image_border_color = $this->get_option("thumb_image_border_color", '444444');
        $this->thumb_image_border_radius = $this->get_option("thumb_image_border_radius", 5);
        $this->thumb_margin_image = $this->get_option("thumb_margin_image", 1);
        $this->video_view7_paginator_fontsize = $this->get_option("video_view7_paginator_fontsize", 22);
        $this->video_view7_paginator_color = $this->get_option("video_view7_paginator_color", '0A0202');
        $this->video_view7_paginator_icon_size = $this->get_option("video_ht_view7_paginator_icon_size", 22);
        $this->video_view7_paginator_icon_color = $this->get_option("video_view7_paginator_icon_color", '333333');
        $this->video_view7_paginator_icon_color = $this->get_option("video_view7_paginator_icon_color", '333333');
        $this->video_view7_paginator_position = $this->get_option("video_view7_paginator_position", 'center');
        $this->thumb_rating_count = $this->get_option("thumb_rating_count", 'yes');
        $this->thumb_likedislike_bg = $this->get_option("thumb_likedislike_bg", '63150C');
        $this->thumb_likedislike_bg_trans = $this->get_option("thumb_likedislike_bg_trans", '0');
        $this->thumb_likedislike_font_color = $this->get_option("thumb_likedislike_font_color", 'E6E6E6');
        $this->thumb_active_font_color = $this->get_option("thumb_active_font_color", 'FFFFFF');
        $this->thumb_likedislike_thumb_color = $this->get_option("thumb_likedislike_thumb_color", 'F7F7F7');
        $this->thumb_likedislike_thumb_active_color = $this->get_option("thumb_likedislike_thumb_active_color", 'E65010');
        $this->thumb_heart_likedislike_thumb_color = $this->get_option("thumb_heart_likedislike_thumb_color", 'FF0000');
        $this->thumb_heart_likedislike_thumb_active_color = $this->get_option("thumb_heart_likedislike_thumb_active_color", 'C21313');
    }

    private function controls_thumbnails()
    {
        return array (
            'thumb_box_padding' => array(
                'section' => 'thumbnails_container_slider',
                'type' => 'number',
                'default' => $this->thumb_box_padding,
                'label' => __('Box padding in px', 'photo-gallery-wp'),
                'help' => __('thumb_box_padding', 'photo-gallery-wp')
            ),
            'thumb_box_background' => array(
                'section' => 'thumbnails_container_slider',
                'type' => 'color',
                'default' => $this->thumb_box_background,
                'label' => __('Box background', 'photo-gallery-wp'),
                'help' => __('thumb_box_background', 'photo-gallery-wp')
            ),
            'thumb_box_use_shadow' => array(
                'section' => 'thumbnails_container_slider',
                'type' => 'checkbox',
                'default' => $this->thumb_box_use_shadow,
                'label' => __('Box Use shadow', 'photo-gallery-wp'),
                'help' => __('thumb_box_use_shadow', 'photo-gallery-wp')
            ),
            'thumb_box_has_background' => array(
                'section' => 'thumbnails_container_slider',
                'type' => 'checkbox',
                'default' => $this->thumb_box_has_background,
                'label' => __('Box Has background', 'photo-gallery-wp'),
                'help' => __('thumb_box_has_background', 'photo-gallery-wp')
            ),
            'thumb_title_font_size' => array(
                'section' => 'thumbnails_title',
                'type' => 'number',
                'default' => $this->thumb_title_font_size,
                'label' => __('Title Font Size in px', 'photo-gallery-wp'),
                'help' => __('thumb_title_font_size', 'photo-gallery-wp')
            ),
            'thumb_title_font_color' => array(
                'section' => 'thumbnails_title',
                'type' => 'color',
                'default' => $this->thumb_title_font_color,
                'label' => __('Title Font Color', 'photo-gallery-wp'),
                'help' => __('thumb_title_font_color', 'photo-gallery-wp')
            ),
            'thumb_title_background_color' => array(
                'section' => 'thumbnails_title',
                'type' => 'color',
                'default' => $this->thumb_title_background_color,
                'label' => __('Overlay Background Color', 'photo-gallery-wp'),
                'help' => __('thumb_title_background_color', 'photo-gallery-wp')
            ),
            'thumb_title_background_transparency' => array(
                'section' => 'thumbnails_title',
                'type' => 'simple_slider',
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100),
                'default' => $this->thumb_title_background_transparency,
                'label' => __('Title Background Opacity', 'photo-gallery-wp'),
                'help' => __('thumb_title_background_transparency', 'photo-gallery-wp')
            ),
            'thumb_view_text' => array(
                'section' => 'thumbnails_title',
                'type' => 'text',
                'default' => $this->thumb_view_text,
                'label' => __('Link Text', 'photo-gallery-wp'),
                'help' => __('thumb_view_text', 'photo-gallery-wp')
            ),
            'video_view7_loadmore_text' => array(
                'section' => 'thumbnails_load_more_styles',
                'type' => 'text',
                'default' => $this->video_view7_loadmore_text,
                'label' => __('Load More Text', 'photo-gallery-wp'),
                'help' => __('video_view7_loadmore_text', 'photo-gallery-wp')
            ),
            'video_view7_loadmore_position' => array(
                'section' => 'thumbnails_load_more_styles',
                'type' => 'select',
                'choices' => array(
                    'left' => 'Left',
                    'center'=> 'Center',
                    'right' => 'Right'
                ),
                'default' => $this->video_view7_loadmore_position,
                'label' => __('Load More Position', 'photo-gallery-wp'),
                'help' => __('video_view7_loadmore_position', 'photo-gallery-wp')
            ),
            'video_view7_loadmore_fontsize' => array(
                'section' => 'thumbnails_load_more_styles',
                'type' => 'number',
                'default' => $this->video_view7_loadmore_fontsize,
                'label' => __('Load More Font Size in px', 'photo-gallery-wp'),
                'help' => __('video_view7_loadmore_fontsize', 'photo-gallery-wp')
            ),
            'video_view7_loadmore_font_color' => array(
                'section' => 'thumbnails_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view7_loadmore_font_color,
                'label' => __('Load More Font Color', 'photo-gallery-wp'),
                'help' => __('video_view7_loadmore_font_color', 'photo-gallery-wp')
            ),
            'video_view7_loadmore_font_color_hover' => array(
                'section' => 'thumbnails_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view7_loadmore_font_color_hover,
                'label' => __('Load More Font Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view7_loadmore_font_color_hover', 'photo-gallery-wp')
            ),
            'video_view7_button_color_hover' => array(
                'section' => 'thumbnails_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view7_button_color_hover,
                'label' => __('Load More Background Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view7_button_color_hover', 'photo-gallery-wp')
            ),
            'video_view7_loading_type' => array(
                'section' => 'thumbnails_load_more_styles',
                'type' => 'image_radio',
                'default' => $this->video_view7_loading_type,
                'label' => __('Loading Animation', 'photo-gallery-wp'),
                'help' => __('video_view7_loading_type', 'photo-gallery-wp'),
                'width' => 30,
                'height' => 30,
                'choices' => array(
                    1 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading1.gif',
                    2 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading4.gif',
                    3 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading36.gif',
                    4 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading51.gif',
                )
            ),
            'image_natural_size_thumbnail' => array(
                'section' => 'thumbnails_image',
                'type' => 'select',
                'default' => $this->image_natural_size_thumbnail,
                'label' => __('Image behaviour', 'photo-gallery-wp'),
                'help' => __('image_natural_size_thumbnail', 'photo-gallery-wp'),
                'choices' => array(
                    'resize' => 'Resize',
                    'natural' => 'Natural',
                )
            ),
            'thumb_image_width' => array(
                'section' => 'thumbnails_image',
                'type' => 'number',
                'default' => $this->thumb_image_width,
                'label' => __('Image Width in px', 'photo-gallery-wp'),
                'help' => __('thumb_image_width', 'photo-gallery-wp')
            ),
            'thumb_image_height' => array(
                'section' => 'thumbnails_image',
                'type' => 'number',
                'default' => $this->thumb_image_height,
                'label' => __('Image Height in px', 'photo-gallery-wp'),
                'help' => __('thumb_image_height', 'photo-gallery-wp')
            ),
            'thumb_image_border_width' => array(
                'section' => 'thumbnails_image',
                'type' => 'number',
                'default' => $this->thumb_image_border_width,
                'label' => __('Image Border Width in px', 'photo-gallery-wp'),
                'help' => __('thumb_image_border_width', 'photo-gallery-wp')
            ),
            'thumb_image_border_color' => array(
                'section' => 'thumbnails_image',
                'type' => 'color',
                'default' => $this->thumb_image_border_color,
                'label' => __('Image Border Color', 'photo-gallery-wp'),
                'help' => __('thumb_image_border_color', 'photo-gallery-wp')
            ),
            'thumb_image_border_radius' => array(
                'section' => 'thumbnails_image',
                'type' => 'number',
                'default' => $this->thumb_image_border_radius,
                'label' => __('Border Radius in px', 'photo-gallery-wp'),
                'help' => __('thumb_image_border_radius', 'photo-gallery-wp')
            ),
            'thumb_margin_image' => array(
                'section' => 'thumbnails_image',
                'type' => 'number',
                'default' => $this->thumb_margin_image,
                'label' => __('Margin Image', 'photo-gallery-wp'),
                'help' => __('thumb_margin_image', 'photo-gallery-wp')
            ),
            'video_view7_paginator_fontsize' => array(
                'section' => 'thumbnails_pagination_style',
                'type' => 'number',
                'default' => $this->video_view7_paginator_fontsize,
                'label' => __('Pagination Font Size in px', 'photo-gallery-wp'),
                'help' => __('video_view7_paginator_fontsize', 'photo-gallery-wp')
            ),
            'video_view7_paginator_color' => array(
                'section' => 'thumbnails_pagination_style',
                'type' => 'color',
                'default' => $this->video_view7_paginator_color,
                'label' => __('Pagination Font Color', 'photo-gallery-wp'),
                'help' => __('video_view7_paginator_color', 'photo-gallery-wp')
            ),
            'video_view7_paginator_icon_size' => array(
                'section' => 'thumbnails_pagination_style',
                'type' => 'number',
                'default' => $this->video_view7_paginator_icon_size,
                'label' => __('Pagination Icons Size in px', 'photo-gallery-wp'),
                'help' => __('video_view7_paginator_icon_size', 'photo-gallery-wp')
            ),
            'video_view7_paginator_icon_color' => array(
                'section' => 'thumbnails_pagination_style',
                'type' => 'color',
                'default' => $this->video_view7_paginator_icon_color,
                'label' => __('Pagination Icons Color', 'photo-gallery-wp'),
                'help' => __('video_view7_paginator_icon_color', 'photo-gallery-wp')
            ),
            'video_view7_paginator_position' => array(
                'section' => 'thumbnails_pagination_style',
                'type' => 'select',
                'choices' => array(
                    'left' => 'Left',
                    'center'=> 'Center',
                    'right' => 'Right'
                ),
                'default' => $this->video_ht_view7_paginator_position,
                'label' => __('Pagination Position', 'photo-gallery-wp'),
                'help' => __('video_ht_view7_paginator_position', 'photo-gallery-wp')
            ),
            'thumb_rating_count' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'checkbox',
                'default' => $this->thumb_rating_count,
                'label' => __('Show Ratings Count', 'photo-gallery-wp'),
                'help' => __('thumb_rating_count', 'photo-gallery-wp')
            ),
            'thumb_likedislike_bg' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'color',
                'default' => $this->thumb_likedislike_bg,
                'label' => __('Ratings Background Color', 'photo-gallery-wp'),
                'help' => __('thumb_likedislike_bg', 'photo-gallery-wp')
            ),
            'thumb_likedislike_bg_trans' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'simple_slider',
                'default' => $this->thumb_likedislike_bg_trans,
                'label' => __('Ratings Background Color Opacity', 'photo-gallery-wp'),
                'help' => __('thumb_likedislike_bg_trans', 'photo-gallery-wp'),
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100)
            ),
            'thumb_likedislike_font_color' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'color',
                'default' => $this->thumb_likedislike_font_color,
                'label' => __('Ratings Font Color', 'photo-gallery-wp'),
                'help' => __('thumb_likedislike_font_color', 'photo-gallery-wp')
            ),
            'thumb_active_font_color' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'color',
                'default' => $this->thumb_active_font_color,
                'label' => __('Ratings Rated Font Color', 'photo-gallery-wp'),
                'help' => __('thumb_active_font_color', 'photo-gallery-wp')
            ),
            'thumb_likedislike_thumb_color' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'color',
                'default' => $this->thumb_likedislike_thumb_color,
                'label' => __('Like/Dislike Icon Color', 'photo-gallery-wp'),
                'help' => __('thumb_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'thumb_likedislike_thumb_active_color' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'color',
                'default' => $this->thumb_likedislike_thumb_active_color,
                'label' => __('Like/Dislike Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('thumb_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
            'thumb_heart_likedislike_thumb_color' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'color',
                'default' => $this->thumb_heart_likedislike_thumb_color,
                'label' => __('Heart Icon Color', 'photo-gallery-wp'),
                'help' => __('thumb_heart_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'thumb_heart_likedislike_thumb_active_color' => array(
                'section' => 'thumbnails_rating_styles',
                'type' => 'color',
                'default' => $this->thumb_heart_likedislike_thumb_active_color,
                'label' => __('Heart Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('thumb_heart_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
        );
    }

    private function init_lightbox_gallery()
    {
        $this->view6_content_in_center = $this->get_option("view6_content_in_center", 'no');
        $this->view6_width = $this->get_option("view6_width", 250);
        $this->view6_border_width = $this->get_option("view6_border_width", 0);
        $this->view6_border_color = $this->get_option("view6_border_color", 'eeeeee');
        $this->view6_border_radius = $this->get_option("view6_border_radius", 3);
        $this->video_view4_loadmore_text = $this->get_option("video_view4_loadmore_text", 'View More');
        $this->video_view4_loadmore_position = $this->get_option("video_view4_loadmore_position", 'center');
        $this->video_view4_loadmore_fontsize = $this->get_option("video_view4_loadmore_fontsize", 16);
        $this->video_view4_loadmore_font_color = $this->get_option("video_view4_loadmore_font_color", 'FF0D0D');
        $this->video_view4_loadmore_font_color_hover = $this->get_option("video_view4_loadmore_font_color_hover", 'FF4040');
        $this->video_view4_button_color = $this->get_option("video_view4_button_color", '5CADFF');
        $this->video_view4_button_color_hover = $this->get_option("video_view4_button_color_hover", '99C5FF');
        $this->video_view4_loading_type = $this->get_option("video_view4_loading_type", 3);
        $this->view6_title_font_size = $this->get_option("view6_title_font_size", 16);
        $this->view6_title_font_color = $this->get_option("view6_title_font_color", '0074A2');
        $this->view6_title_font_hover_color = $this->get_option("view6_title_font_hover_color", '2EA2CD');
        $this->view6_title_background_color = $this->get_option("view6_title_background_color", '000000');
        $this->view6_title_background_transparency = $this->get_option("view6_title_background_transparency", '80');
        $this->video_view4_paginator_fontsize = $this->get_option("video_view4_paginator_fontsize", 19);
        $this->video_view4_paginator_color = $this->get_option("video_view4_paginator_color", 'FF2C2C');
        $this->video_view4_paginator_icon_size = $this->get_option("video_view4_paginator_icon_size", 21);
        $this->video_view4_paginator_icon_color = $this->get_option("video_view4_paginator_icon_color", 'B82020');
        $this->video_view4_paginator_position = $this->get_option("video_view4_paginator_position", 'center');
        $this->lightbox_rating_count = $this->get_option("lightbox_rating_count", 'yes');
        $this->lightbox_likedislike_bg = $this->get_option("lightbox_likedislike_bg", 'FFFFFF');
        $this->lightbox_likedislike_bg_trans = $this->get_option("lightbox_likedislike_bg_trans", '20');
        $this->lightbox_likedislike_font_color = $this->get_option("lightbox_likedislike_font_color", 'FFFFFF');
        $this->lightbox_active_font_color = $this->get_option("lightbox_active_font_color", 'FFFFFF');
        $this->lightbox_likedislike_thumb_color = $this->get_option("lightbox_likedislike_thumb_color", '7A7A7A');
        $this->lightbox_likedislike_thumb_active_color = $this->get_option("lightbox_likedislike_thumb_active_color", 'E83D09');
        $this->lightbox_heart_likedislike_thumb_color = $this->get_option("lightbox_heart_likedislike_thumb_color", 'B50000');
        $this->lightbox_heart_likedislike_thumb_active_color = $this->get_option("lightbox_heart_likedislike_thumb_active_color", 'EB1221');
    }

    private function controls_lightbox_gallery()
    {
        return array (
            'view6_content_in_center' => array(
                'section' => 'lightbox_gallery_content_styles',
                'type' => 'checkbox',
                'default' => $this->view6_content_in_center,
                'label' => __('Show Content In The Center', 'photo-gallery-wp'),
                'help' => __('view6_content_in_center', 'photo-gallery-wp')
            ),
            'view6_width' => array(
                'section' => 'lightbox_gallery_image',
                'type' => 'number',
                'default' => $this->view6_width,
                'label' => __('Image Width in px', 'photo-gallery-wp'),
                'help' => __('view6_width', 'photo-gallery-wp')
            ),
            'view6_border_width' => array(
                'section' => 'lightbox_gallery_image',
                'type' => 'number',
                'default' => $this->view6_border_width,
                'label' => __('Image Border Width in px', 'photo-gallery-wp'),
                'help' => __('view6_border_width', 'photo-gallery-wp')
            ),
            'view6_border_color' => array(
                'section' => 'lightbox_gallery_image',
                'type' => 'color',
                'default' => $this->view6_border_color,
                'label' => __('Image Border Color', 'photo-gallery-wp'),
                'help' => __('view6_border_color', 'photo-gallery-wp')
            ),
            'view6_border_radius' => array(
                'section' => 'lightbox_gallery_image',
                'type' => 'number',
                'default' => $this->view6_border_radius,
                'label' => __('Border Radius', 'photo-gallery-wp'),
                'help' => __('view6_border_radius', 'photo-gallery-wp')
            ),
            'video_view4_loadmore_text' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'text',
                'default' => $this->video_view4_loadmore_text,
                'label' => __('Load More Text', 'photo-gallery-wp'),
                'help' => __('video_view4_loadmore_text', 'photo-gallery-wp')
            ),
            'video_view4_loadmore_position' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'select',
                'default' => $this->video_view4_loadmore_position,
                'label' => __('Load More Position', 'photo-gallery-wp'),
                'help' => __('video_view4_loadmore_position', 'photo-gallery-wp'),
                'choices' => array(
                    'left' => 'Left',
                    'center'=> 'Center',
                    'right' => 'Right'
                )
            ),
            'video_view4_loadmore_fontsize' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'number',
                'default' => $this->video_view4_loadmore_fontsize,
                'label' => __('Load More Font Size in px', 'photo-gallery-wp'),
                'help' => __('video_view4_loadmore_fontsize', 'photo-gallery-wp')
            ),
            'video_view4_loadmore_font_color' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view4_loadmore_font_color,
                'label' => __('Load More Font Color', 'photo-gallery-wp'),
                'help' => __('video_view4_loadmore_font_color', 'photo-gallery-wp')
            ),
            'video_view4_loadmore_font_color_hover' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view4_loadmore_font_color,
                'label' => __('Load More Font Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view4_loadmore_font_color', 'photo-gallery-wp')
            ),
            'video_view4_button_color' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view4_button_color,
                'label' => __('Load More Button Color', 'photo-gallery-wp'),
                'help' => __('video_view4_button_color', 'photo-gallery-wp')
            ),
            'video_view4_button_color_hover' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'color',
                'default' => $this->video_view4_button_color_hover,
                'label' => __('Load More Background Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view4_button_color_hover', 'photo-gallery-wp')
            ),
            'video_view4_loading_type' => array(
                'section' => 'lightbox_gallery_load_more_styles',
                'type' => 'image_radio',
                'default' => $this->video_view4_loading_type,
                'label' => __('Loading Animation', 'photo-gallery-wp'),
                'help' => __('video_view4_loading_type', 'photo-gallery-wp'),
                'width' => 30,
                'height' => 30,
                'choices' => array(
                    1 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading1.gif',
                    2 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading4.gif',
                    3 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading36.gif',
                    4 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading51.gif',
                )
            ),
            'view6_title_font_size' => array(
                'section' => 'lightbox_gallery_title',
                'type' => 'number',
                'default' => $this->view6_title_font_size,
                'label' => __('Title Font Size in px', 'photo-gallery-wp'),
                'help' => __('view6_title_font_size', 'photo-gallery-wp')
            ),
            'view6_title_font_color' => array(
                'section' => 'lightbox_gallery_title',
                'type' => 'color',
                'default' => $this->view6_title_font_color,
                'label' => __('Title Font Color', 'photo-gallery-wp'),
                'help' => __('view6_title_font_color', 'photo-gallery-wp')
            ),
            'view6_title_font_hover_color' => array(
                'section' => 'lightbox_gallery_title',
                'type' => 'color',
                'default' => $this->view6_title_font_hover_color,
                'label' => __('Title Font Hover Color', 'photo-gallery-wp'),
                'help' => __('view6_title_font_hover_color', 'photo-gallery-wp')
            ),
            'view6_title_background_color' => array(
                'section' => 'lightbox_gallery_title',
                'type' => 'color',
                'default' => $this->view6_title_background_color,
                'label' => __('Title Background Color', 'photo-gallery-wp'),
                'help' => __('view6_title_background_color', 'photo-gallery-wp')
            ),
            'view6_title_background_transparency' => array(
                'section' => 'lightbox_gallery_title',
                'type' => 'simple_slider',
                'default' => $this->view6_title_background_transparency,
                'label' => __('Title Background Opacity', 'photo-gallery-wp'),
                'help' => __('view6_title_background_transparency', 'photo-gallery-wp'),
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100)
            ),
            'video_view4_paginator_fontsize' => array(
                'section' => 'lightbox_gallery_pagination_styles',
                'type' => 'number',
                'default' => $this->video_view4_paginator_fontsize,
                'label' => __('Pagination Font Size in px', 'photo-gallery-wp'),
                'help' => __('video_view4_paginator_fontsize', 'photo-gallery-wp')
            ),
            'video_view4_paginator_color' => array(
                'section' => 'lightbox_gallery_pagination_styles',
                'type' => 'color',
                'default' => $this->video_view4_paginator_color,
                'label' => __('Pagination Font Color', 'photo-gallery-wp'),
                'help' => __('video_view4_paginator_color', 'photo-gallery-wp')
            ),
            'video_view4_paginator_icon_size' => array(
                'section' => 'lightbox_gallery_pagination_styles',
                'type' => 'number',
                'default' => $this->video_view4_paginator_icon_size,
                'label' => __('Pagination Icons Size in px', 'photo-gallery-wp'),
                'help' => __('video_view4_paginator_icon_size', 'photo-gallery-wp')
            ),
            'video_view4_paginator_icon_color' => array(
                'section' => 'lightbox_gallery_pagination_styles',
                'type' => 'color',
                'default' => $this->video_view4_paginator_icon_color,
                'label' => __('Pagination Icons Color', 'photo-gallery-wp'),
                'help' => __('video_view4_paginator_icon_color', 'photo-gallery-wp')
            ),
            'video_view4_paginator_position' => array(
                'section' => 'lightbox_gallery_pagination_styles',
                'type' => 'select',
                'choices' => array(
                    'left' => "Left",
                    'center' => "Center",
                    'right' => "Right",
                ),
                'default' => $this->video_view4_paginator_position,
                'label' => __('Pagination Position', 'photo-gallery-wp'),
                'help' => __('video_view4_paginator_position', 'photo-gallery-wp')
            ),
            'lightbox_rating_count' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'checkbox',
                'default' => $this->lightbox_rating_count,
                'label' => __('Pagination Icons Color', 'photo-gallery-wp'),
                'help' => __('lightbox_rating_count', 'photo-gallery-wp')
            ),
            'lightbox_likedislike_bg' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'color',
                'default' => $this->lightbox_likedislike_bg,
                'label' => __('Ratings Background Color', 'photo-gallery-wp'),
                'help' => __('lightbox_likedislike_bg', 'photo-gallery-wp')
            ),
            'lightbox_likedislike_bg_trans' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'simple_slider',
                'default' => $this->lightbox_likedislike_bg_trans,
                "choices" => array(0,10,20,30,40,50,60,70,80,90,100),
                'label' => __('Ratings Background Color Opacity', 'photo-gallery-wp'),
                'help' => __('lightbox_likedislike_bg_trans', 'photo-gallery-wp')
            ),
            'lightbox_likedislike_font_color' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'color',
                'default' => $this->lightbox_likedislike_font_color,
                'label' => __('Ratings Font Color', 'photo-gallery-wp'),
                'help' => __('lightbox_likedislike_font_color', 'photo-gallery-wp')
            ),
            'lightbox_active_font_color' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'color',
                'default' => $this->lightbox_active_font_color,
                'label' => __('Ratings Rated Font Color', 'photo-gallery-wp'),
                'help' => __('lightbox_active_font_color', 'photo-gallery-wp')
            ),
            'lightbox_likedislike_thumb_color' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'color',
                'default' => $this->lightbox_likedislike_thumb_color,
                'label' => __('Ratings Rated Font Color', 'photo-gallery-wp'),
                'help' => __('lightbox_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'lightbox_likedislike_thumb_active_color' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'color',
                'default' => $this->lightbox_likedislike_thumb_active_color,
                'label' => __('Like/Dislike Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('lightbox_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
            'lightbox_heart_likedislike_thumb_color' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'color',
                'default' => $this->lightbox_heart_likedislike_thumb_color,
                'label' => __('Heart Icon Color', 'photo-gallery-wp'),
                'help' => __('lightbox_heart_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'lightbox_heart_likedislike_thumb_active_color' => array(
                'section' => 'lightbox_gallery_rating_styles',
                'type' => 'color',
                'default' => $this->lightbox_heart_likedislike_thumb_active_color,
                'label' => __('Heart Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('lightbox_heart_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
        );
    }

    private function init_content_slider()
    {
        $this->view5_main_image_width = $this->get_option("view5_main_image_width", 275);
        $this->view5_slider_background_color = $this->get_option("view5_slider_background_color", 'F9F9F9');
        $this->view5_icons_style = $this->get_option("view5_icons_style", 'dark');
        $this->view5_show_separator_lines = $this->get_option("view5_show_separator_lines", 'yes');
        $this->view5_show_linkbutton = $this->get_option("view5_show_linkbutton", 'yes');
        $this->view5_linkbutton_text = $this->get_option("view5_linkbutton_text", 'View More');
        $this->view5_linkbutton_text = $this->get_option("view5_linkbutton_text", 'View More');
        $this->view5_linkbutton_font_size = $this->get_option("view5_linkbutton_font_size", 14);
        $this->view5_linkbutton_color = $this->get_option("view5_linkbutton_color", 'FFFFFF');
        $this->view5_linkbutton_font_hover_color = $this->get_option("view5_linkbutton_font_hover_color", 'FFFFFF');
        $this->view5_linkbutton_background_color = $this->get_option("view5_linkbutton_background_color", '2ea2cd');
        $this->view5_linkbutton_background_hover_color = $this->get_option("view5_linkbutton_background_hover_color", '0074a2');
        $this->view5_title_font_size = $this->get_option("view5_title_font_size", 16);
        $this->view5_title_font_color = $this->get_option("view5_title_font_color", '0074a2');
        $this->view5_show_description = $this->get_option("view5_show_description", 'yes');
        $this->view5_description_font_size = $this->get_option("view5_description_font_size", 14);
        $this->view5_description_color = $this->get_option("view5_description_color", '555555');
        $this->contentsl_rating_count = $this->get_option("contentsl_rating_count", 'yes');
        $this->contentsl_likedislike_bg = $this->get_option("contentsl_likedislike_bg", '7993A3');
        $this->contentsl_likedislike_bg_trans = $this->get_option("contentsl_likedislike_bg_trans", '0');
        $this->contentsl_likedislike_font_color = $this->get_option("contentsl_likedislike_font_color", '454545');
        $this->contentsl_active_font_color = $this->get_option("contentsl_active_font_color", '1C1C1C');
        $this->contentsl_likedislike_thumb_color = $this->get_option("contentsl_likedislike_thumb_color", '2EC7E6');
        $this->contentsl_likedislike_thumb_active_color = $this->get_option("contentsl_likedislike_thumb_active_color", '2883C9');
        $this->contentsl_heart_likedislike_thumb_color = $this->get_option("contentsl_heart_likedislike_thumb_color", '84E0E3');
        $this->contentsl_heart_likedislike_thumb_active_color = $this->get_option("contentsl_heart_likedislike_thumb_active_color", '46B4E3');
    }

    private function controls_content_slider()
    {
        return array (
            'view5_main_image_width' => array(
                'section' => 'content_slider_container',
                'type' => 'number',
                'default' => $this->view5_main_image_width,
                'label' => __('Main Image Width in px', 'photo-gallery-wp'),
                'help' => __('view5_main_image_width', 'photo-gallery-wp')
            ),
            'view5_slider_background_color' => array(
                'section' => 'content_slider_container',
                'type' => 'color',
                'default' => $this->view5_slider_background_color,
                'label' => __('Slider Background Color', 'photo-gallery-wp'),
                'help' => __('view5_slider_background_color', 'photo-gallery-wp')
            ),
            'view5_icons_style' => array(
                'section' => 'content_slider_container',
                'type' => 'select',
                'default' => $this->view5_icons_style,
                'label' => __('Arrow Icons Style', 'photo-gallery-wp'),
                'help' => __('view5_icons_style', 'photo-gallery-wp'),
                'choices' => array(
                    'dark' => 'Dark',
                    'light' => 'Light'
                )
            ),
            'view5_show_separator_lines' => array(
                'section' => 'content_slider_container',
                'type' => 'checkbox',
                'default' => $this->view5_show_separator_lines,
                'label' => __('Show Separator Lines', 'photo-gallery-wp'),
                'help' => __('view5_show_separator_lines', 'photo-gallery-wp')
            ),
            'view5_show_linkbutton' => array(
                'section' => 'content_slider_link_button',
                'type' => 'checkbox',
                'default' => $this->view5_show_linkbutton,
                'label' => __('Show Link Button', 'photo-gallery-wp'),
                'help' => __('view5_show_linkbutton', 'photo-gallery-wp')
            ),
            'view5_linkbutton_text' => array(
                'section' => 'content_slider_link_button',
                'type' => 'text',
                'default' => $this->view5_linkbutton_text,
                'label' => __('Link Button Text', 'photo-gallery-wp'),
                'help' => __('view5_linkbutton_text', 'photo-gallery-wp')
            ),
            'view5_linkbutton_font_size' => array(
                'section' => 'content_slider_link_button',
                'type' => 'number',
                'default' => $this->view5_linkbutton_font_size,
                'label' => __('Link Button Font Size in px', 'photo-gallery-wp'),
                'help' => __('view5_linkbutton_font_size', 'photo-gallery-wp')
            ),
            'view5_linkbutton_color' => array(
                'section' => 'content_slider_link_button',
                'type' => 'color',
                'default' => $this->view5_linkbutton_color,
                'label' => __('Link Button Font Color', 'photo-gallery-wp'),
                'help' => __('view5_linkbutton_color', 'photo-gallery-wp')
            ),
            'view5_linkbutton_font_hover_color' => array(
                'section' => 'content_slider_link_button',
                'type' => 'color',
                'default' => $this->view5_linkbutton_font_hover_color,
                'label' => __('Link Button Font Hover Color', 'photo-gallery-wp'),
                'help' => __('view5_linkbutton_font_hover_color', 'photo-gallery-wp')
            ),
            'view5_linkbutton_background_color' => array(
                'section' => 'content_slider_link_button',
                'type' => 'color',
                'default' => $this->view5_linkbutton_background_color,
                'label' => __('Link Button Background Color', 'photo-gallery-wp'),
                'help' => __('view5_linkbutton_background_color', 'photo-gallery-wp')
            ),
            'view5_linkbutton_background_hover_color' => array(
                'section' => 'content_slider_link_button',
                'type' => 'color',
                'default' => $this->view5_linkbutton_background_hover_color,
                'label' => __('Link Button Background Hover Color', 'photo-gallery-wp'),
                'help' => __('view5_linkbutton_background_hover_color', 'photo-gallery-wp')
            ),
            'view5_title_font_size' => array(
                'section' => 'content_slider_title',
                'type' => 'number',
                'default' => $this->view5_title_font_size,
                'label' => __('Title Font Size in px', 'photo-gallery-wp'),
                'help' => __('view5_title_font_size', 'photo-gallery-wp')
            ),
            'view5_title_font_color' => array(
                'section' => 'content_slider_title',
                'type' => 'color',
                'default' => $this->view5_title_font_color,
                'label' => __('Title Font Color', 'photo-gallery-wp'),
                'help' => __('view5_title_font_color', 'photo-gallery-wp')
            ),
            'view5_show_description' => array(
                'section' => 'content_slider_description',
                'type' => 'checkbox',
                'default' => $this->view5_show_description,
                'label' => __('Show Description', 'photo-gallery-wp'),
                'help' => __('view5_show_description', 'photo-gallery-wp')
            ),
            'view5_description_font_size' => array(
                'section' => 'content_slider_description',
                'type' => 'number',
                'default' => $this->view5_description_font_size,
                'label' => __('Description Font Size in px', 'photo-gallery-wp'),
                'help' => __('view5_description_font_size', 'photo-gallery-wp')
            ),
            'view5_description_color' => array(
                'section' => 'content_slider_description',
                'type' => 'color',
                'default' => $this->view5_description_color,
                'label' => __('Description Font Color', 'photo-gallery-wp'),
                'help' => __('view5_description_color', 'photo-gallery-wp')
            ),
            'contentsl_rating_count' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'checkbox',
                'default' => $this->contentsl_rating_count,
                'label' => __('Show Ratings Count', 'photo-gallery-wp'),
                'help' => __('contentsl_rating_count', 'photo-gallery-wp')
            ),
            'contentsl_likedislike_bg' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'color',
                'default' => $this->contentsl_likedislike_bg,
                'label' => __('Ratings Background Color', 'photo-gallery-wp'),
                'help' => __('contentsl_likedislike_bg', 'photo-gallery-wp')
            ),
            'contentsl_likedislike_bg_trans' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'simple_slider',
                'default' => $this->contentsl_likedislike_bg_trans,
                'label' => __('Ratings Background Color Opacity', 'photo-gallery-wp'),
                'help' => __('contentsl_likedislike_bg_trans', 'photo-gallery-wp'),
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100)
            ),
            'contentsl_likedislike_font_color' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'color',
                'default' => $this->contentsl_likedislike_font_color,
                'label' => __('Ratings Font Color', 'photo-gallery-wp'),
                'help' => __('contentsl_likedislike_font_color', 'photo-gallery-wp')
            ),
            'contentsl_active_font_color' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'color',
                'default' => $this->contentsl_active_font_color,
                'label' => __('Ratings Rated Font Color', 'photo-gallery-wp'),
                'help' => __('contentsl_active_font_color', 'photo-gallery-wp')
            ),
            'contentsl_likedislike_thumb_color' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'color',
                'default' => $this->contentsl_likedislike_thumb_color,
                'label' => __('Like/Dislike Icon Color', 'photo-gallery-wp'),
                'help' => __('contentsl_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'contentsl_likedislike_thumb_active_color' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'color',
                'default' => $this->contentsl_likedislike_thumb_active_color,
                'label' => __('Like/Dislike Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('contentsl_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
            'contentsl_heart_likedislike_thumb_color' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'color',
                'default' => $this->contentsl_heart_likedislike_thumb_color,
                'label' => __('Heart Icon Color', 'photo-gallery-wp'),
                'help' => __('contentsl_heart_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'contentsl_heart_likedislike_thumb_active_color' => array(
                'section' => 'content_slider_rating_styles',
                'type' => 'color',
                'default' => $this->contentsl_heart_likedislike_thumb_active_color,
                'label' => __('Heart Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('contentsl_heart_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
        );
    }

    private function init_gallery_content_pop_up() {
        $this->view2_content_in_center = $this->get_option("view2_content_in_center",'no');
        $this->image_natural_size_contentpopup = $this->get_option("image_natural_size_contentpopup", 'resize');
        $this->view2_element_width = $this->get_option("view2_element_width",240);
        $this->view2_element_height = $this->get_option("view2_element_height",160);
        $this->view2_element_border_width = $this->get_option("view2_element_border_width",1);
        $this->view2_element_border_color = $this->get_option("view2_element_border_color",'DEDEDE');
        $this->view2_element_overlay_color = $this->get_option("view2_element_overlay_color",'FFFFFF');
        $this->view2_element_overlay_transparency = $this->get_option("view2_element_overlay_transparency",'70');
        $this->view2_zoombutton_style = $this->get_option("view2_zoombutton_style",'light');
        $this->view2_popup_full_width = $this->get_option("view2_popup_full_width",'yes');
        $this->view2_popup_background_color = $this->get_option("view2_popup_background_color",'FFFFFF');
        $this->view2_popup_overlay_color = $this->get_option("view2_popup_overlay_color",'000000');
        $this->view2_show_separator_lines = $this->get_option("view2_show_separator_lines",'yes');
        $this->light_box_arrowkey = $this->get_option("light_box_arrowkey",'no');
        $this->video_view1_paginator_fontsize = $this->get_option("video_view1_paginator_fontsize",'22');
        $this->video_view1_paginator_color = $this->get_option("video_view1_paginator_color",'222222');
        $this->video_view1_paginator_icon_size = $this->get_option("video_view1_paginator_icon_size",'22');
        $this->video_view1_paginator_icon_color = $this->get_option("video_view1_paginator_icon_color",'FF2C2C');
        $this->video_view1_loadmore_text = $this->get_option("video_view1_loadmore_text",'Load More');
        $this->video_view1_loadmore_fontsize = $this->get_option("video_view1_loadmore_fontsize",22);
        $this->video_view1_loadmore_font_color = $this->get_option("video_view1_loadmore_font_color",'FFFFFF');
        $this->video_view1_loadmore_font_color_hover = $this->get_option("video_view1_loadmore_font_color_hover",'F2F2F2');
        $this->video_view1_button_color = $this->get_option("video_view1_button_color",'FF2C2C');
        $this->video_view1_button_color_hover = $this->get_option("video_view1_button_color_hover",'991A1A');
        $this->view2_element_title_font_size = $this->get_option("view2_element_title_font_size",18);
        $this->view2_element_title_font_color = $this->get_option("view2_element_title_font_color",'222222');
        $this->view2_element_background_color = $this->get_option("view2_element_background_color",'F9F9F9');
        $this->view2_element_show_linkbutton = $this->get_option("view2_element_show_linkbutton",'yes');
        $this->view2_element_linkbutton_text = $this->get_option("view2_element_linkbutton_text",'View More');
        $this->view2_element_linkbutton_font_size = $this->get_option("view2_element_linkbutton_font_size",14);
        $this->view2_element_linkbutton_color = $this->get_option("view2_element_linkbutton_color",'FFFFFF');
        $this->view2_element_linkbutton_background_color = $this->get_option("view2_element_linkbutton_background_color",'2ea2cd');
        $this->view2_popup_title_font_size = $this->get_option("view2_popup_title_font_size",18);
        $this->view2_popup_title_font_color = $this->get_option("view2_popup_title_font_color",'222222');
        $this->view2_show_popup_linkbutton = $this->get_option("view2_show_popup_linkbutton",'yes');
        $this->view2_popup_linkbutton_text = $this->get_option("view2_popup_linkbutton_text",'Load More');
        $this->view2_popup_linkbutton_font_size = $this->get_option("view2_popup_linkbutton_font_size",14);
        $this->view2_popup_linkbutton_color = $this->get_option("view2_popup_linkbutton_color",'FFFFFF');
        $this->view2_popup_linkbutton_font_hover_color = $this->get_option("view2_popup_linkbutton_font_hover_color",'FFFFFF');
        $this->view2_popup_linkbutton_background_color = $this->get_option("view2_popup_linkbutton_background_color",'2ea2cd');
        $this->view2_popup_linkbutton_background_hover_color = $this->get_option("view2_popup_linkbutton_background_hover_color",'0074a2');
        $this->popup_rating_count = $this->get_option("popup_rating_count",'yes');
        $this->popup_likedislike_bg = $this->get_option("popup_likedislike_bg",'7993A3');
        $this->popup_likedislike_font_color = $this->get_option("popup_likedislike_font_color",'454545');
        $this->popup_active_font_color = $this->get_option("popup_active_font_color",'000000');
        $this->popup_likedislike_thumb_color = $this->get_option("popup_likedislike_thumb_color",'2EC7E6');
        $this->popup_likedislike_thumb_active_color = $this->get_option("popup_likedislike_thumb_active_color",'2883C9');
        $this->popup_heart_likedislike_thumb_color = $this->get_option("popup_heart_likedislike_thumb_color",'84E0E3');
        $this->view2_popup_overlay_transparency_color = $this->get_option("view2_popup_overlay_transparency_color",'70');
        $this->view2_popup_closebutton_style = $this->get_option("view2_popup_closebutton_style",'dark');
        $this->video_view1_loadmore_position = $this->get_option("video_view1_loadmore_position",'center');
        $this->video_view1_loading_type = $this->get_option("video_view1_loading_type",'2');
        $this->popup_likedislike_bg_trans = $this->get_option("popup_likedislike_bg_trans",'0');
        $this->popup_heart_likedislike_thumb_active_color = $this->get_option("popup_heart_likedislike_thumb_active_color",'46B4E3');
        $this->video_view1_paginator_position = $this->get_option("video_view1_paginator_position",'left');
        $this->view2_show_description = $this->get_option("view2_show_description",'yes');
        $this->view2_description_font_size = $this->get_option("view2_description_font_size",14);
        $this->view2_description_color = $this->get_option("view2_description_color",'222222');
    }

    private function init_controls_masonry() {
        $this->masonry_show_content_in_the_center = $this->get_option("masonry_show_content_in_the_center", 'no');
        $this->masonry_image_width_in_px = $this->get_option("masonry_image_width_in_px", '260');
        $this->masonry_image_margin_in_px = $this->get_option("masonry_image_margin_in_px", '0');
        $this->masonry_image_border_width_in_px = $this->get_option("masonry_image_border_width_in_px", '0');
        $this->masonry_image_border_color = $this->get_option("masonry_image_border_color", 'eeeeee');
        $this->masonry_image_border_radius = $this->get_option("masonry_image_border_radius", '0');
        $this->masonry_title_show_title = $this->get_option("masonry_title_show_title", 'yes');
        $this->masonry_title_font_size_in_px = $this->get_option("masonry_title_font_size_in_px", '16');
        $this->masonry_title_font_color = $this->get_option("masonry_title_font_color", '0074A2');
        $this->masonry_title_background_color = $this->get_option("masonry_title_background_color", '000000');
        $this->masonry_title_background_opacity = $this->get_option("masonry_title_background_opacity", '80');
        $this->masonry_rating_icons_color = $this->get_option("masonry_rating_icons_color", 'no');
        $this->masonry_rating_background_color = $this->get_option("masonry_rating_background_color", '7993A3');
        $this->masonry_ratings_background_color_opacity = $this->get_option("masonry_ratings_background_color_opacity", '0');
        $this->masonry_rating_font_color = $this->get_option("masonry_rating_font_color", 'ffffff');
        $this->masonry_rating_rated_font_color = $this->get_option("masonry_rating_rated_font_color", 'fafafa');
        $this->masonry_like_dislike_icon_color = $this->get_option("masonry_like_dislike_icon_color", '2EC7E6');
        $this->masonry_like_dislike_rated_icon_color = $this->get_option("masonry_like_dislike_rated_icon_color", '2883C9');
        $this->masonry_heart_icon_color = $this->get_option("masonry_heart_icon_color", '84E0E3');
        $this->masonry_heart_rated_icon_color = $this->get_option("masonry_heart_rated_icon_color", '46B4E3');
        $this->masonry_load_more_text = $this->get_option("masonry_load_more_text", 'View More');
        $this->masonry_load_more_position = $this->get_option("masonry_load_more_position", 'center');
        $this->masonry_load_more_font_size_in_px = $this->get_option("masonry_load_more_font_size_in_px", '16');
        $this->masonry_load_more_font_color = $this->get_option("masonry_load_more_font_color", 'FF0D0D');
        $this->masonry_load_more_font_font_hover_color = $this->get_option("masonry_load_more_font_font_hover_color", 'FF0D0D');
        $this->masonry_load_more_button_color = $this->get_option("masonry_load_more_button_color", '5CADFF');
        $this->masonry_load_more_background_hover_color = $this->get_option("masonry_load_more_background_hover_color", '99C5FF');
        $this->masonry_load_more_loading_animation = $this->get_option("masonry_load_more_loading_animation", '3');
        $this->masonry_pagination_font_size_in_px = $this->get_option("masonry_pagination_font_size_in_px", '19');
        $this->masonry_pagination_font_color = $this->get_option("masonry_pagination_font_color", 'FF2C2C');
        $this->masonry_pagination_icons_size_in_px = $this->get_option("masonry_pagination_icons_size_in_px", '21');
        $this->masonry_pagination_icons_color = $this->get_option("masonry_pagination_icons_color", 'B82020');
        $this->masonry_pagination_position = $this->get_option("masonry_pagination_position", 'center');
    }

    private function init_controls_mosaic() {
        $this->mosaic_show_content_in_the_center = $this->get_option("mosaic_show_content_in_the_center", 'no');
        $this->mosaic_show_content_by = $this->get_option( 'mosaic_show_content_by', 'count' );
        $this->mosaic_image_max_width_in_px = $this->get_option("mosaic_image_max_width_in_px", '150');
        $this->mosaic_image_column_count = $this->get_option("mosaic_image_column_count", '5');
        $this->mosaic_image_border_width_in_px = $this->get_option("mosaic_image_border_width_in_px", '0');
        $this->mosaic_image_border_color = $this->get_option("mosaic_image_border_color", 'eeeeee');
        $this->mosaic_image_border_radius = $this->get_option("mosaic_image_border_radius", '0');
        $this->mosaic_title_show_title = $this->get_option("mosaic_title_show_title", 'yes');
        $this->mosaic_title_font_size_in_px = $this->get_option("mosaic_title_font_size_in_px", '14');
        $this->mosaic_title_font_color = $this->get_option("mosaic_title_font_color", '0074A2');
        $this->mosaic_title_background_color = $this->get_option("mosaic_title_background_color", '000000');
        $this->mosaic_title_background_opacity = $this->get_option("mosaic_title_background_opacity", '80');
        $this->mosaic_title_font_hover_color = $this->get_option("mosaic_title_font_hover_color", 'ffffff');
    }

    private function controls_mosaic(){
        return array (
            'mosaic_show_content_in_the_center' => array(
                'section' => 'mosaic_content_styles',
                'type' => 'checkbox',
                'default' => $this->mosaic_show_content_in_the_center,
                'label' => __('Show Content In The Center', 'photo-gallery-wp')
            ),
            'mosaic_show_content_by' => array(
                'section' => 'mosaic_image_styles',
                'type' => 'select',
                'default' => $this->mosaic_show_content_by,
                'label' => __( 'Show Content by', 'photo-gallery-wp' ),
                'choices' => array(
                    'count' => __( 'Columns count', 'photo-gallery-wp' ),
                    'width' => __( 'Width', 'photo-gallery-wp' )
                )
            ),
            'mosaic_image_max_width_in_px' => array(
                'section' => 'mosaic_image_styles',
                'type' => 'number',
                'default' => $this->mosaic_image_max_width_in_px,
                'label' => __('Image Max Width in px', 'photo-gallery-wp'),
                'html_class' => ( $this->mosaic_show_content_by !== 'width' ? array('hidden') : array() )
            ),
            'mosaic_image_column_count' => array(
                'section' => 'mosaic_image_styles',
                'type' => 'number',
                'default' => $this->mosaic_image_column_count,
                'label' => __('Column count', 'photo-gallery-wp'),
                'html_class' => ( $this->mosaic_show_content_by !== 'count' ? array('hidden') : array() )
            ),
            'mosaic_image_border_width_in_px' => array(
                'section' => 'mosaic_image_styles',
                'type' => 'number',
                'default' => $this->mosaic_image_border_width_in_px,
                'label' => __('Image Border Width in px', 'photo-gallery-wp')
            ),
            'mosaic_image_border_color' => array(
                'section' => 'mosaic_image_styles',
                'type' => 'color',
                'default' => $this->mosaic_image_border_color,
                'label' => __('Image Border Color', 'photo-gallery-wp')
            ),
            'mosaic_image_border_radius' => array(
                'section' => 'mosaic_image_styles',
                'type' => 'number',
                'default' => $this->mosaic_image_border_radius,
                'label' => __('Border Radius', 'photo-gallery-wp')
            ),
            'mosaic_title_show_title' => array(
                'section' => 'mosaic_title_styles',
                'type' => 'checkbox',
                'default' => $this->mosaic_title_show_title,
                'label' => __('Show Title', 'photo-gallery-wp')
            ),
            'mosaic_title_font_size_in_px' => array(
                'section' => 'mosaic_title_styles',
                'type' => 'number',
                'default' => $this->mosaic_title_font_size_in_px,
                'label' => __('Title Font Size in px', 'photo-gallery-wp')
            ),
            'mosaic_title_font_color' => array(
                'section' => 'mosaic_title_styles',
                'type' => 'color',
                'default' => $this->mosaic_title_font_color,
                'label' => __('Title Font Color', 'photo-gallery-wp')
            ),
            'mosaic_title_font_hover_color' => array(
                'section' => 'mosaic_title_styles',
                'type' => 'color',
                'default' => $this->mosaic_title_font_hover_color,
                'label' => __('Title Font Hover Color', 'photo-gallery-wp')
            ),
            'mosaic_title_background_color' => array(
                'section' => 'mosaic_title_styles',
                'type' => 'color',
                'default' => $this->mosaic_title_background_color,
                'label' => __('Title Background Color', 'photo-gallery-wp')
            ),
            'mosaic_title_background_opacity' => array(
                'section' => 'mosaic_title_styles',
                'type' => 'simple_slider',
                'default' => $this->mosaic_title_background_opacity,
                'label' => __('Title Background Opacity', 'photo-gallery-wp'),
                'choices' => range(0,100)
            ),
        );
    }

    private function controls_masonry(){
        return array (
            'masonry_show_content_in_the_center' => array(
                'section' => 'masonry_content_styles',
                'type' => 'checkbox',
                'default' => $this->masonry_show_content_in_the_center,
                'label' => __('Show Content In The Center', 'photo-gallery-wp')
            ),
            'masonry_image_width_in_px' => array(
                'section' => 'masonry_image_styles',
                'type' => 'number',
                'default' => $this->masonry_image_width_in_px,
                'label' => __('Image Width in px', 'photo-gallery-wp')
            ),
            'masonry_image_margin_in_px' => array(
                'section' => 'masonry_image_styles',
                'type' => 'number',
                'default' => $this->masonry_image_margin_in_px,
                'label' => __('Margin in px', 'photo-gallery-wp')
            ),
            'masonry_image_border_width_in_px' => array(
                'section' => 'masonry_image_styles',
                'type' => 'number',
                'default' => $this->masonry_image_border_width_in_px,
                'label' => __('Image Border Width in px', 'photo-gallery-wp')
            ),
            'masonry_image_border_color' => array(
                'section' => 'masonry_image_styles',
                'type' => 'color',
                'default' => $this->masonry_image_border_color,
                'label' => __('Image Border Color', 'photo-gallery-wp')
            ),
            'masonry_image_border_radius' => array(
                'section' => 'masonry_image_styles',
                'type' => 'number',
                'default' => $this->masonry_image_border_radius,
                'label' => __('Border Radius', 'photo-gallery-wp')
            ),
            'masonry_title_show_title' => array(
                'section' => 'masonry_title_styles',
                'type' => 'checkbox',
                'default' => $this->masonry_title_show_title,
                'label' => __('Show Title', 'photo-gallery-wp')
            ),
            'masonry_title_font_size_in_px' => array(
                'section' => 'masonry_title_styles',
                'type' => 'number',
                'default' => $this->masonry_title_font_size_in_px,
                'label' => __('Title Font Size in px', 'photo-gallery-wp')
            ),
            'masonry_title_font_color' => array(
                'section' => 'masonry_title_styles',
                'type' => 'color',
                'default' => $this->masonry_title_font_color,
                'label' => __('Title Font Color', 'photo-gallery-wp')
            ),
            'masonry_title_font_hover_color' => array(
                'section' => 'masonry_title_styles',
                'type' => 'color',
                'default' => $this->masonry_title_font_hover_color,
                'label' => __('Title Font Hover Color', 'photo-gallery-wp')
            ),
            'masonry_title_background_color' => array(
                'section' => 'masonry_title_styles',
                'type' => 'color',
                'default' => $this->masonry_title_background_color,
                'label' => __('Title Background Color', 'photo-gallery-wp')
            ),
            'masonry_title_background_opacity' => array(
                'section' => 'masonry_title_styles',
                'type' => 'simple_slider',
                'default' => $this->masonry_title_background_opacity,
                'label' => __('Title Background Opacity', 'photo-gallery-wp'),
                'choices' => range(0,100)
            ),
            'masonry_rating_icons_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'checkbox',
                'default' => $this->masonry_rating_icons_color,
                'label' => __('Pagination Icons Color', 'photo-gallery-wp')
            ),
            'masonry_rating_background_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'color',
                'default' => $this->masonry_rating_background_color,
                'label' => __('Ratings Background Color', 'photo-gallery-wp')
            ),
            'masonry_ratings_background_color_opacity' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'simple_slider',
                'default' => $this->masonry_ratings_background_color_opacity,
                'label' => __('Ratings Background Color Opacity', 'photo-gallery-wp'),
                'choices' => range(0,100)
            ),
            'masonry_rating_font_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'color',
                'default' => $this->masonry_rating_font_color,
                'label' => __('Ratings Font Color', 'photo-gallery-wp')
            ),
            'masonry_rating_rated_font_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'color',
                'default' => $this->masonry_rating_rated_font_color,
                'label' => __('Ratings Rated Font Color', 'photo-gallery-wp')
            ),
            'masonry_like_dislike_icon_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'color',
                'default' => $this->masonry_like_dislike_icon_color,
                'label' => __('Like/Dislike Icon Color', 'photo-gallery-wp')
            ),
            'masonry_like_dislike_rated_icon_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'color',
                'default' => $this->masonry_like_dislike_rated_icon_color,
                'label' => __('Like/Dislike Rated Icon Color', 'photo-gallery-wp')
            ),
            'masonry_heart_icon_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'color',
                'default' => $this->masonry_heart_icon_color,
                'label' => __('Heart Icon Color', 'photo-gallery-wp')
            ),
            'masonry_heart_rated_icon_color' => array(
                'section' => 'masonry_rating_styles',
                'type' => 'color',
                'default' => $this->masonry_heart_rated_icon_color,
                'label' => __('Heart Rated Icon Color', 'photo-gallery-wp')
            ),
            'masonry_load_more_text' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'text',
                'default' => $this->masonry_load_more_text,
                'label' => __('Load More Text', 'photo-gallery-wp')
            ),
            'masonry_load_more_position' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'select',
                'default' => $this->masonry_load_more_position,
                'label' => __('Load More Position', 'photo-gallery-wp'),
                'choices' => array(
                    'left' => 'Left',
                    'right' => 'Right',
                    'center'=> 'Center'
                )
            ),
            'masonry_load_more_font_size_in_px' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'number',
                'default' => $this->masonry_load_more_font_size_in_px,
                'label' => __('Load More Font Size in px', 'photo-gallery-wp')
            ),
            'masonry_load_more_font_color' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'color',
                'default' => $this->masonry_load_more_font_color,
                'label' => __('Load More Font Color', 'photo-gallery-wp')
            ),
            'masonry_load_more_font_font_hover_color' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'color',
                'default' => $this->masonry_load_more_font_font_hover_color,
                'label' => __('Load More Font Hover Color', 'photo-gallery-wp')
            ),
            'masonry_load_more_button_color' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'color',
                'default' => $this->masonry_load_more_button_color,
                'label' => __('Load More Button Color', 'photo-gallery-wp')
            ),
            'masonry_load_more_background_hover_color' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'color',
                'default' => $this->masonry_load_more_background_hover_color,
                'label' => __('Load More Background Hover Color', 'photo-gallery-wp')
            ),
            'masonry_load_more_loading_animation' => array(
                'section' => 'masonry_load_more_styles',
                'type' => 'image_radio',
                'default' => $this->masonry_load_more_loading_animation,
                'label' => __('Loading Animation', 'photo-gallery-wp'),
                'width' => 30,
                'height' => 30,
                'choices' => array(
                    1 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading1.gif',
                    2 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading4.gif',
                    3 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading36.gif',
                    4 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading51.gif',
                )
            ),
            'masonry_pagination_font_size_in_px' => array(
                'section' => 'masonry_pagination_styles',
                'type' => 'number',
                'default' => $this->masonry_pagination_font_size_in_px,
                'label' => __('Pagination Font Size in px', 'photo-gallery-wp')
            ),
            'masonry_pagination_font_color' => array(
                'section' => 'masonry_pagination_styles',
                'type' => 'color',
                'default' => $this->masonry_pagination_font_color,
                'label' => __('Pagination Font Color', 'photo-gallery-wp')
            ),
            'masonry_pagination_icons_size_in_px' => array(
                'section' => 'masonry_pagination_styles',
                'type' => 'number',
                'default' => $this->masonry_pagination_icons_size_in_px,
                'label' => __('Pagination Icons Size in px', 'photo-gallery-wp')
            ),
            'masonry_pagination_icons_color' => array(
                'section' => 'masonry_pagination_styles',
                'type' => 'color',
                'default' => $this->masonry_pagination_icons_color,
                'label' => __('Pagination Icons Color', 'photo-gallery-wp')
            ),
            'masonry_pagination_position' => array(
                'section' => 'masonry_pagination_styles',
                'type' => 'select',
                'default' => $this->masonry_pagination_position,
                'label' => __('Pagination Position', 'photo-gallery-wp'),
                'choices' => array(
                    'left' => 'Left',
                    'right' => 'Right',
                    'center'=> 'Center'
                )
            ),
        );
    }

    private function controls_gallery_content_pop_up()
    {
        return array (
            'view2_content_in_center' => array(
                'section' => 'content_styles',
                'type' => 'checkbox',
                'default' => $this->view2_content_in_center,
                'label' => __('Show Content In The Center', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'image_natural_size_contentpopup' => array(
                'section' => 'element_styles',
                'type' => 'select',
                'default' => $this->image_natural_size_contentpopup,
                'label' => __('Image Behavior', 'photo-gallery-wp'),
                'help' => __('image_natural_size_contentpopup', 'photo-gallery-wp'),
                'choices' => array(
                    'resize' => 'Resize',
                    'natural' => 'Natural',
                )
            ),
            'view2_element_width' => array(
                'section' => 'element_styles',
                'type' => 'number',
                'default' => $this->view2_element_width,
                'label' => __('Element Image Width in px', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_element_height' => array(
                'section' => 'element_styles',
                'type' => 'number',
                'default' => $this->view2_element_height,
                'label' => __('Element Image Height in px', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_element_border_width' => array(
                'section' => 'element_styles',
                'type' => 'number',
                'default' => $this->view2_element_border_width,
                'label' => __('Element Border Width in px', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_element_border_color' => array(
                'section' => 'element_styles',
                'type' => 'color',
                'default' => $this->view2_element_border_color,
                'label' => __('Element Border Color', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_element_overlay_color' => array(
                'section' => 'element_styles',
                'type' => 'color',
                'default' => $this->view2_element_overlay_color,
                'label' => __('Elements Image Overlay Color', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_element_overlay_transparency' => array(
                'section' => 'element_styles',
                'type' => 'simple_slider',
                'choices' => array (0,10,20,30,40,50,60,70,80,90,100),
                'default' => $this->view2_element_overlay_transparency,
                'label' => __('Elements Image Overlay Opacity', 'photo-gallery-wp'),
                'help' => __('view2_element_overlay_transparency', 'photo-gallery-wp')
            ),
            'view2_zoombutton_style' => array(
                'section' => 'element_styles',
                'type' => 'select',
                'default' => $this->view2_zoombutton_style,
                'label' => __('Zoom Image Style', 'photo-gallery-wp'),
                'help' => __('view2_zoombutton_style', 'photo-gallery-wp'),
                'choices' => array(
                    'light' => 'Light',
                    'dark' => 'Dark',
                )
            ),
            'view2_popup_full_width' => array(
                'section' => 'popup_styles',
                'type' => 'checkbox',
                'default' => $this->view2_popup_full_width,
                'label' => __('Popup Image Full Width', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_popup_background_color' => array(
                'section' => 'popup_styles',
                'type' => 'color',
                'default' => $this->view2_popup_background_color,
                'label' => __('Popup Background Color', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_popup_overlay_color' => array(
                'section' => 'popup_styles',
                'type' => 'color',
                'default' => $this->view2_popup_overlay_color,
                'label' => __('Popup Overlay Color', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'view2_show_separator_lines' => array(
                'section' => 'popup_styles',
                'type' => 'checkbox',
                'default' => $this->view2_show_separator_lines,
                'label' => __('Show Separator Lines', 'photo-gallery-wp'),
                'help' => __('', 'photo-gallery-wp')
            ),
            'light_box_arrowkey' => array(
                'section' => 'popup_styles',
                'type' => 'checkbox',
                'default' => $this->light_box_arrowkey,
                'label' => __('Keyboard navigation', 'photo-gallery-wp'),
                'help' => __('light_box_arrowkey', 'photo-gallery-wp')
            ),
            'video_view1_paginator_fontsize' => array(
                'section' => 'pagination_styles',
                'type' => 'number',
                'default' => $this->video_view1_paginator_fontsize,
                'label' => __('Pagination Font Size in px', 'photo-gallery-wp'),
                'help' => __('video_view1_paginator_fontsize', 'photo-gallery-wp')
            ),
            'video_view1_paginator_color' => array(
                'section' => 'pagination_styles',
                'type' => 'color',
                'default' => $this->video_view1_paginator_color,
                'label' => __('Pagination Font Color', 'photo-gallery-wp'),
                'help' => __('video_view1_paginator_color', 'photo-gallery-wp')
            ),
            'video_view1_paginator_icon_size' => array(
                'section' => 'pagination_styles',
                'type' => 'number',
                'default' => $this->video_view1_paginator_icon_size,
                'label' => __('Pagination Icons Size', 'photo-gallery-wp'),
                'help' => __('video_view1_paginator_icon_size', 'photo-gallery-wp')
            ),
            'video_view1_paginator_icon_color' => array(
                'section' => 'pagination_styles',
                'type' => 'color',
                'default' => $this->video_view1_paginator_icon_color,
                'label' => __('Pagination Icons Color', 'photo-gallery-wp'),
                'help' => __('video_view1_paginator_icon_color', 'photo-gallery-wp')
            ),
            'video_view1_loadmore_text' => array(
                'section' => 'load_more_styles',
                'type' => 'text',
                'default' => $this->video_view1_loadmore_text,
                'label' => __('Load More Text', 'photo-gallery-wp'),
                'help' => __('video_view1_loadmore_text', 'photo-gallery-wp')
            ),
            'video_view1_loadmore_fontsize' => array(
                'section' => 'load_more_styles',
                'type' => 'number',
                'default' => $this->video_view1_loadmore_fontsize,
                'label' => __('Load More Font Size in', 'photo-gallery-wp'),
                'help' => __('video_view1_loadmore_fontsize', 'photo-gallery-wp')
            ),
            'video_view1_loadmore_font_color' => array(
                'section' => 'load_more_styles',
                'type' => 'color',
                'default' => $this->video_view1_loadmore_font_color,
                'label' => __('Load More Font Color', 'photo-gallery-wp'),
                'help' => __('video_view1_loadmore_font_color', 'photo-gallery-wp')
            ),
            'video_view1_loadmore_font_color_hover' => array(
                'section' => 'load_more_styles',
                'type' => 'color',
                'default' => $this->video_view1_loadmore_font_color_hover,
                'label' => __('Load More Font Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view1_loadmore_font_color_hover', 'photo-gallery-wp')
            ),
            'video_view1_button_color' => array(
                'section' => 'load_more_styles',
                'type' => 'color',
                'default' => $this->video_view1_button_color,
                'label' => __('Load More Button Color', 'photo-gallery-wp'),
                'help' => __('video_view1_button_color', 'photo-gallery-wp')
            ),
            'video_view1_button_color_hover' => array(
                'section' => 'load_more_styles',
                'type' => 'color',
                'default' => $this->video_view1_button_color_hover,
                'label' => __('Load More Background Hover Color', 'photo-gallery-wp'),
                'help' => __('video_view1_button_color_hover', 'photo-gallery-wp')
            ),
            'view2_element_title_font_size' => array(
                'section' => 'element_title',
                'type' => 'number',
                'default' => $this->view2_element_title_font_size,
                'label' => __('Element Title Font Size in px', 'photo-gallery-wp'),
                'help' => __('view2_element_title_font_size', 'photo-gallery-wp')
            ),
            'view2_element_title_font_color' => array(
                'section' => 'element_title',
                'type' => 'color',
                'default' => $this->view2_element_title_font_color,
                'label' => __('Element Title Font Color', 'photo-gallery-wp'),
                'help' => __('view2_element_title_font_color', 'photo-gallery-wp')
            ),
            'view2_element_background_color' => array(
                'section' => 'element_title',
                'type' => 'color',
                'default' => $this->view2_element_background_color,
                'label' => __('Element Title Background Color', 'photo-gallery-wp'),
                'help' => __('view2_element_background_color', 'photo-gallery-wp')
            ),
            'view2_element_show_linkbutton' => array(
                'section' => 'element_link_button',
                'type' => 'checkbox',
                'default' => $this->view2_element_show_linkbutton,
                'label' => __('Show Link Button On Element', 'photo-gallery-wp'),
                'help' => __('view2_element_show_linkbutton', 'photo-gallery-wp')
            ),
            'view2_element_linkbutton_text' => array(
                'section' => 'element_link_button',
                'type' => 'text',
                'default' => $this->view2_element_linkbutton_text,
                'label' => __('Link Button Text', 'photo-gallery-wp'),
                'help' => __('view2_element_linkbutton_text', 'photo-gallery-wp')
            ),
            'view2_element_linkbutton_font_size' => array(
                'section' => 'element_link_button',
                'type' => 'number',
                'default' => $this->view2_element_linkbutton_font_size,
                'label' => __('Link Button Font Size in px', 'photo-gallery-wp'),
                'help' => __('view2_element_linkbutton_font_size', 'photo-gallery-wp')
            ),
            'view2_element_linkbutton_color' => array(
                'section' => 'element_link_button',
                'type' => 'color',
                'default' => $this->view2_element_linkbutton_color,
                'label' => __('Link Button Font Color', 'photo-gallery-wp'),
                'help' => __('view2_element_linkbutton_color', 'photo-gallery-wp')
            ),
            'view2_element_linkbutton_background_color' => array(
                'section' => 'element_link_button',
                'type' => 'color',
                'default' => $this->view2_element_linkbutton_background_color,
                'label' => __('Link Button Background Color', 'photo-gallery-wp'),
                'help' => __('view2_element_linkbutton_background_color', 'photo-gallery-wp')
            ),
            'view2_popup_title_font_size' => array(
                'section' => 'popup_title',
                'type' => 'number',
                'default' => $this->view2_popup_title_font_size,
                'label' => __('Popup Title Font Size in px', 'photo-gallery-wp'),
                'help' => __('view2_popup_title_font_size', 'photo-gallery-wp')
            ),
            'view2_popup_title_font_color' => array(
                'section' => 'popup_title',
                'type' => 'color',
                'default' => $this->view2_popup_title_font_color,
                'label' => __('Popup Title Font Color', 'photo-gallery-wp'),
                'help' => __('view2_popup_title_font_color', 'photo-gallery-wp')
            ),
            'view2_show_popup_linkbutton' => array(
                'section' => 'popup_link_button',
                'type' => 'checkbox',
                'default' => $this->view2_show_popup_linkbutton,
                'label' => __('Show Link Button', 'photo-gallery-wp'),
                'help' => __('view2_show_popup_linkbutton', 'photo-gallery-wp')
            ),
            'view2_popup_linkbutton_text' => array(
                'section' => 'popup_link_button',
                'type' => 'text',
                'default' => $this->view2_popup_linkbutton_text,
                'label' => __('Link Button Text', 'photo-gallery-wp'),
                'help' => __('view2_popup_linkbutton_text', 'photo-gallery-wp')
            ),
            'view2_popup_linkbutton_font_size' => array(
                'section' => 'popup_link_button',
                'type' => 'number',
                'default' => $this->view2_popup_linkbutton_font_size,
                'label' => __('Link Button Font Size in px', 'photo-gallery-wp'),
                'help' => __('view2_popup_linkbutton_font_size', 'photo-gallery-wp')
            ),
            'view2_popup_linkbutton_color' => array(
                'section' => 'popup_link_button',
                'type' => 'color',
                'default' => $this->view2_popup_linkbutton_color,
                'label' => __('Link Button Font Color', 'photo-gallery-wp'),
                'help' => __('view2_popup_linkbutton_color', 'photo-gallery-wp')
            ),
            'view2_popup_linkbutton_font_hover_color' => array(
                'section' => 'popup_link_button',
                'type' => 'color',
                'default' => $this->view2_popup_linkbutton_font_hover_color,
                'label' => __('Link Button Font Hover Color', 'photo-gallery-wp'),
                'help' => __('view2_popup_linkbutton_font_hover_color', 'photo-gallery-wp')
            ),
            'view2_popup_linkbutton_background_color' => array(
                'section' => 'popup_link_button',
                'type' => 'color',
                'default' => $this->view2_popup_linkbutton_background_color,
                'label' => __('Link Button Background Color', 'photo-gallery-wp'),
                'help' => __('view2_popup_linkbutton_background_color', 'photo-gallery-wp')
            ),
            'view2_popup_linkbutton_background_hover_color' => array(
                'section' => 'popup_link_button',
                'type' => 'color',
                'default' => $this->view2_popup_linkbutton_background_hover_color,
                'label' => __('Link Button Background Hover Color', 'photo-gallery-wp'),
                'help' => __('view2_popup_linkbutton_background_hover_color', 'photo-gallery-wp')
            ),
            'popup_rating_count' => array(
                'section' => 'rating_styles',
                'type' => 'checkbox',
                'default' => $this->popup_rating_count,
                'label' => __('Show Ratings Count', 'photo-gallery-wp'),
                'help' => __('popup_rating_count', 'photo-gallery-wp')
            ),
            'popup_likedislike_bg' => array(
                'section' => 'rating_styles',
                'type' => 'color',
                'default' => $this->popup_likedislike_bg,
                'label' => __('Ratings Background Color', 'photo-gallery-wp'),
                'help' => __('popup_likedislike_bg', 'photo-gallery-wp')
            ),
            'popup_likedislike_font_color' => array(
                'section' => 'rating_styles',
                'type' => 'color',
                'default' => $this->popup_likedislike_font_color,
                'label' => __('Ratings Font Color', 'photo-gallery-wp'),
                'help' => __('popup_likedislike_font_color', 'photo-gallery-wp')
            ),
            'popup_active_font_color' => array(
                'section' => 'rating_styles',
                'type' => 'color',
                'default' => $this->popup_active_font_color,
                'label' => __('Ratings Rated Font Color', 'photo-gallery-wp'),
                'help' => __('popup_active_font_color', 'photo-gallery-wp')
            ),
            'popup_likedislike_thumb_color' => array(
                'section' => 'rating_styles',
                'type' => 'color',
                'default' => $this->popup_likedislike_thumb_color,
                'label' => __('Like/Dislike Icon Color', 'photo-gallery-wp'),
                'help' => __('popup_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'popup_likedislike_thumb_active_color' => array(
                'section' => 'rating_styles',
                'type' => 'color',
                'default' => $this->popup_likedislike_thumb_active_color,
                'label' => __('Like/Dislike Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('popup_likedislike_thumb_active_color', 'photo-gallery-wp')
            ),
            'popup_heart_likedislike_thumb_color' => array(
                'section' => 'rating_styles',
                'type' => 'color',
                'default' => $this->popup_heart_likedislike_thumb_color,
                'label' => __('Heart Icon Color', 'photo-gallery-wp'),
                'help' => __('popup_heart_likedislike_thumb_color', 'photo-gallery-wp')
            ),
            'popup_heart_likedislike_thumb_active_color' => array(
                'section' => 'rating_styles',
                'type' => 'color',
                'default' => $this->popup_heart_likedislike_thumb_active_color,
                'label' => __('Heart Rated Icon Color', 'photo-gallery-wp'),
                'help' => __('popup_heart_likedislike_thumb_active_color', 'photo-gallery-wp'),
            ),
            'video_view1_paginator_position' => array(
                'section' => 'pagination_styles',
                'type' => 'select',
                'default' => $this->video_view1_paginator_position,
                'label' => __('Pagination Position', 'photo-gallery-wp'),
                'help' => __('video_view1_paginator_position', 'photo-gallery-wp'),
                'choices' => array(
                    'left' => "Left",
                    'center' => "Center",
                    'right' => "Right",
                )
            ),
            'view2_popup_overlay_transparency_color' => array(
                'section' => 'popup_styles',
                'type' => 'simple_slider',
                'default' => $this->view2_popup_overlay_transparency_color,
                'label' => __('Popup Overlay Opacity', 'photo-gallery-wp'),
                'help' => __('view2_popup_overlay_transparency_color', 'photo-gallery-wp'),
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100)
            ),
            'view2_popup_closebutton_style' => array(
                'section' => 'popup_styles',
                'type' => 'select',
                'default' => $this->view2_popup_closebutton_style,
                'label' => __('Popup Close Button Style', 'photo-gallery-wp'),
                'help' => __('view2_popup_closebutton_style', 'photo-gallery-wp'),
                'choices' => array(
                    'light' => 'Light',
                    'dark' => 'Dark'
                )
            ),
            'video_view1_loadmore_position' => array(
                'section' => 'load_more_styles',
                'type' => 'select',
                'default' => $this->video_view1_loadmore_position,
                'label' => __('Load More Position', 'photo-gallery-wp'),
                'help' => __('video_view1_loadmore_position', 'photo-gallery-wp'),
                'choices' => array(
                    'left' => 'Left',
                    'right' => 'Rigth',
                    'center'=> 'Center'
                )
            ),
            'popup_likedislike_bg_trans' => array(
                'section' => 'rating_styles',
                'type' => 'simple_slider',
                'default' => $this->popup_likedislike_bg_trans,
                'label' => __('Ratings Background Color Opacity', 'photo-gallery-wp'),
                'help' => __('popup_likedislike_bg_trans', 'photo-gallery-wp'),
                'choices' => array(0,10,20,30,40,50,60,70,80,90,100)
            ),
            'video_view1_loading_type' => array(
                'section' => 'load_more_styles',
                'type' => 'image_radio',
                'default' => $this->video_view1_loading_type,
                'label' => __('Loading Animation', 'photo-gallery-wp'),
                'help' => __('video_view1_loading_type', 'photo-gallery-wp'),
                'width' => 30,
                'height' => 30,
                'choices' => array(
                    1 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading1.gif',
                    2 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading4.gif',
                    3 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading36.gif',
                    4 => PHOTO_GALLERY_WP_IMAGES_URL.'/front_images/arrows/loading51.gif',
                )
            ),
            'view2_show_description' => array(
                'section' => 'popup_description',
                'type' => 'checkbox',
                'default' => $this->view2_show_description,
                'label' => __('Show Description', 'photo-gallery-wp'),
                'help' => __('view2_show_description', 'photo-gallery-wp'),
            ),
            'view2_description_font_size' => array(
                'section' => 'popup_description',
                'type' => 'number',
                'default' => $this->view2_description_font_size,
                'label' => __('Description Font Size in px', 'photo-gallery-wp'),
                'help' => __('view2_description_font_size', 'photo-gallery-wp'),
            ),
            'view2_description_color' => array(
                'section' => 'popup_description',
                'type' => 'color',
                'default' => $this->view2_description_color,
                'label' => __('Description Font Color', 'photo-gallery-wp'),
                'help' => __('view2_description_color', 'photo-gallery-wp'),
            ),
        );
    }


    /**
     * Radio buttons
     *
     * @param $id
     * @param $control
     */
    protected function control_radio_position( $id, $control ){
        $default = ( isset( $control['default'] ) ? $control['default'] : "" );

        $label_str       = ( isset( $control['label'] ) ? '<span class="control-title" > ' . $control['label'] : '' );
        $label_str      .= isset( $control['help'] ) ? '<div class="wpdev_settings_help">&#63;<div class="wpdev_settings_help_block"><span class="pnt"></span><p>'. $control['help'] .'</p></div></div></span>' : '</span>';

        echo $label_str;
        ?>
        <div class="radio-block">
            <?php
            if( isset( $control['choices'] ) && !empty( $control['choices'] ) ){
                ?>
                <ul>
                    <?php
                    foreach( $control['choices'] as $key ){
                        ?>
                        <li style="display: inline-block" >
                            <input type="radio" value="<?php echo $key ?>" <?php checked($default, $key); ?> id="<?php echo $id.'-'.$key; ?>" name="wpdev_options[<?php echo $id; ?>]"  />
                            <label for="<?php echo $id.'-'.$key; ?>"><span class="radicon"></span></label>
                        </li>
                        <?php if ($key % 3 == 0) {
                            echo "<br />";
                        } ?>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <?php
    }

}