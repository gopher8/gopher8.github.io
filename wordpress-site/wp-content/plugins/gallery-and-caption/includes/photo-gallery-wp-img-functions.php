<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Get all general options parameters in a single array
 *
 * @todo: use wp_options instead
 *
 * @return array Array of all general options
 */
function photo_gallery_wp_get_general_options()
{
    $gallery_default__params = array(
        'ht_view2_element_linkbutton_text' => 'View More',
        'ht_view2_element_show_linkbutton' => 'on',
        'ht_view2_element_linkbutton_color' => 'ffffff',
        'ht_view2_element_linkbutton_font_size' => '14',
        'ht_view2_element_linkbutton_background_color' => '2ea2cd',
        'ht_view2_show_popup_linkbutton' => 'on',
        'ht_view2_popup_linkbutton_text' => 'View More',
        'ht_view2_popup_linkbutton_background_hover_color' => '0074a2',
        'ht_view2_popup_linkbutton_background_color' => '2ea2cd',
        'ht_view2_popup_linkbutton_font_hover_color' => 'ffffff',
        'ht_view2_popup_linkbutton_color' => 'ffffff',
        'ht_view2_popup_linkbutton_font_size' => '14',
        'ht_view2_description_color' => '222222',
        'ht_view2_description_font_size' => '14',
        'ht_view2_show_description' => 'on',
        'ht_view2_thumbs_width' => '75',
        'ht_view2_thumbs_height' => '75',
        'ht_view2_thumbs_position' => 'before',
        'ht_view2_show_thumbs' => 'on',
        'ht_view2_popup_background_color' => 'FFFFFF',
        'ht_view2_popup_overlay_color' => '000000',
        'ht_view2_popup_overlay_transparency_color' => '70',
        'ht_view2_popup_closebutton_style' => 'dark',
        'ht_view2_show_separator_lines' => 'on',
        'ht_view2_show_popup_title' => 'on',
        'ht_view2_element_title_font_size' => '18',
        'ht_view2_element_title_font_color' => '222222',
        'ht_view2_popup_title_font_size' => '18',
        'ht_view2_popup_title_font_color' => '222222',
        'ht_view2_element_overlay_color' => 'FFFFFF',
        'ht_view2_element_overlay_transparency' => '70',
        'ht_view2_zoombutton_style' => 'light',
        'ht_view2_element_border_width' => '1',
        'ht_view2_element_border_color' => 'dedede',
        'ht_view2_element_background_color' => 'f9f9f9',
        'ht_view2_element_width' => '275',
        'ht_view2_element_height' => '160',
        'ht_view5_icons_style' => 'dark',
        'ht_view5_show_separator_lines' => 'on',
        'ht_view5_linkbutton_text' => 'View More',
        'ht_view5_show_linkbutton' => 'on',
        'ht_view5_linkbutton_background_hover_color' => '0074a2',
        'ht_view5_linkbutton_background_color' => '2ea2cd',
        'ht_view5_linkbutton_font_hover_color' => 'ffffff',
        'ht_view5_linkbutton_color' => 'ffffff',
        'ht_view5_linkbutton_font_size' => '14',
        'ht_view5_description_color' => '555555',
        'ht_view5_description_font_size' => '14',
        'ht_view5_show_description' => 'on',
        'ht_view5_thumbs_width' => '75',
        'ht_view5_thumbs_height' => '75',
        'ht_view5_show_thumbs' => 'on',
        'ht_view5_title_font_size' => '16',
        'ht_view5_title_font_color' => '0074a2',
        'ht_view5_main_image_width' => '275',
        'ht_view5_slider_tabs_font_color' => 'd9d99',
        'ht_view5_slider_tabs_background_color' => '555555',
        'ht_view5_slider_background_color' => 'f9f9f9',
        'ht_view6_title_font_size' => '16',
        'ht_view6_title_font_color' => '0074A2',
        'ht_view6_title_font_hover_color' => '2EA2CD',
        'ht_view6_title_background_color' => '000000',
        'ht_view6_title_background_transparency' => '80',
        'ht_view6_border_radius' => '3',
        'ht_view6_border_width' => '0',
        'ht_view6_border_color' => 'eeeeee',
        'ht_view6_width' => '275',
        'light_box_size' => '17',
        'light_box_width' => '500',
        'light_box_transition' => 'elastic',
        'light_box_speed' => '800',
        'light_box_href' => 'False',
        'light_box_title' => 'false',
        'light_box_scalephotos' => 'true',
        'light_box_rel' => 'false',
        'light_box_scrolling' => 'false',
        'light_box_opacity' => '20',
        'light_box_open' => 'false',
        'light_box_overlayclose' => 'true',
        'light_box_esckey' => 'false',
        'light_box_arrowkey' => 'false',
        'light_box_loop' => 'true',
        'light_box_data' => 'false',
        'light_box_classname' => 'false',
        'light_box_fadeout' => '300',
        'light_box_closebutton' => 'false',
        'light_box_current' => 'image',
        'light_box_previous' => 'previous',
        'light_box_next' => 'next',
        'light_box_close' => 'close',
        'light_box_iframe' => 'false',
        'light_box_inline' => 'false',
        'light_box_html' => 'false',
        'light_box_photo' => 'false',
        'light_box_height' => '500',
        'light_box_innerwidth' => 'false',
        'light_box_innerheight' => 'false',
        'light_box_initialwidth' => '300',
        'light_box_initialheight' => '100',
        'light_box_maxwidth' => '900',
        'light_box_maxheight' => '700',
        'light_box_slideshow' => 'false',
        'light_box_slideshowspeed' => '2500',
        'light_box_slideshowauto' => 'true',
        'light_box_slideshowstart' => 'start slideshow',
        'light_box_slideshowstop' => 'stop slideshow',
        'light_box_fixed' => 'true',
        'light_box_top' => 'false',
        'light_box_bottom' => 'false',
        'light_box_left' => 'false',
        'light_box_right' => 'false',
        'light_box_reposition' => 'false',
        'light_box_retinaimage' => 'true',
        'light_box_retinaurl' => 'false',
        'light_box_retinasuffix' => '@2x.$1',
        'light_box_returnfocus' => 'true',
        'light_box_trapfocus' => 'true',
        'light_box_fastiframe' => 'true',
        'light_box_preloading' => 'true',
        'lightbox_open_position' => '5',
        'light_box_style' => '1',
        'light_box_size_fix' => 'false',
        'slider_crop_image' => 'crop',
        'slider_title_color' => '000000',
        'slider_title_font_size' => '13',
        'slider_description_color' => 'ffffff',
        'slider_description_font_size' => '12',
        'slider_title_position' => 'right-top',
        'slider_description_position' => 'right-bottom',
        'slider_title_border_size' => '0',
        'slider_title_border_color' => 'ffffff',
        'slider_title_border_radius' => '4',
        'slider_description_border_size' => '0',
        'slider_description_border_color' => 'ffffff',
        'slider_description_border_radius' => '0',
        'slider_slideshow_border_size' => '0',
        'slider_slideshow_border_color' => 'ffffff',
        'slider_slideshow_border_radius' => '0',
        'slider_navigation_type' => '1',
        'slider_navigation_position' => 'bottom',
        'slider_title_background_color' => 'ffffff',
        'slider_description_background_color' => '000000',
        'slider_title_transparent' => 'on',
        'slider_description_transparent' => 'on',
        'slider_slider_background_color' => 'ffffff',
        'slider_dots_position' => 'top',
        'slider_active_dot_color' => 'ffffff',
        'slider_dots_color' => '000000',
        'slider_description_width' => '70',
        'slider_description_height' => '50',
        'slider_description_background_transparency' => '70',
        'slider_description_text_align' => 'justify',
        'slider_title_width' => '30',
        'slider_title_height' => '50',
        'slider_title_background_transparency' => '70',
        'slider_title_text_align' => 'right',
        'slider_title_has_margin' => 'off',
        'slider_description_has_margin' => 'off',
        'slider_show_arrows' => 'on',
        'thumb_image_behavior' => 'on',
        'thumb_image_width' => '240',
        'thumb_image_height' => '150',
        'thumb_image_border_width' => '1',
        'thumb_image_border_color' => '444444',
        'thumb_image_border_radius' => '5',
        'thumb_margin_image' => '1',
        'thumb_title_font_size' => '16',
        'thumb_title_font_color' => 'FFFFFF',
        'thumb_title_background_color' => 'CCCCCC',
        'thumb_title_background_transparency' => '80',
        'thumb_box_padding' => '28',
        'thumb_box_background' => '333333',
        'thumb_box_use_shadow' => 'on',
        'thumb_box_has_background' => 'on',
        'thumb_view_text' => 'View Picture',
        'ht_view8_element_cssAnimation' => 'false',
        'ht_view8_element_height' => '120',
        'ht_view8_element_maxheight' => '155',
        'ht_view8_element_show_caption' => 'true',
        'ht_view8_element_padding' => '0',
        'ht_view8_element_border_radius' => '5',
        'ht_view8_icons_style' => 'dark',
        'ht_view8_element_title_font_size' => '13',
        'ht_view8_element_title_font_color' => '3AD6FC',
        'ht_view8_popup_background_color' => '000000',
        'ht_view8_popup_overlay_transparency_color' => '0',
        'ht_view8_popup_closebutton_style' => 'dark',
        'ht_view8_element_title_overlay_transparency' => '90',
        'ht_view8_element_size_fix' => 'false',
        'ht_view8_element_title_background_color' => 'FF1C1C',
        'ht_view8_element_justify' => 'true',
        'ht_view8_element_randomize' => 'false',
        'ht_view8_element_animation_speed' => '2000',
        'ht_view2_content_in_center' => 'off',
        'ht_view6_content_in_center' => 'off',
        'ht_view2_popup_full_width' => 'on',
        'ht_view9_title_fontsize' => '18',
        'ht_view9_title_color' => 'FFFFFF',
        'ht_view9_desc_color' => '000000',
        'ht_view9_desc_fontsize' => '14',
        'ht_view9_element_title_show' => 'true',
        'ht_view9_element_desc_show' => 'true',
        'ht_view9_general_width' => '100',
        'view9_general_position' => 'center',
        'view9_title_textalign' => 'left',
        'view9_desc_textalign' => 'justify',
        'view9_image_position' => '2',
        'ht_view9_title_back_color' => '000000',
        'ht_view9_title_opacity' => '70',
        'ht_view9_desc_opacity' => '100',
        'ht_view9_desc_back_color' => 'FFFFFF',
        'ht_view9_general_space' => '0',
        'ht_view9_general_separator_size' => '0',
        'ht_view9_general_separator_color' => '010457',
        'view9_general_separator_style' => 'dotted',
        'ht_view9_paginator_fontsize' => '22',
        'ht_view9_paginator_color' => '1046B3',
        'ht_view9_paginator_icon_color' => '1046B3',
        'ht_view9_paginator_icon_size' => '18',
        'view9_paginator_position' => 'center',
        'video_view9_loadmore_position' => 'center',
        'video_ht_view9_loadmore_fontsize' => '19',
        'video_ht_view9_button_color' => '5CADFF',
        'video_ht_view9_loadmore_font_color' => '000000',
        'video_ht_view9_loadmore_font_color' => 'Load More',
        'loading_type' => '2',
        'video_ht_view9_loadmore_text' => 'View More',
        'video_ht_view8_paginator_position' => 'center',
        'video_ht_view8_paginator_icon_size' => '18',
        'video_ht_view8_paginator_icon_color' => '26A6FC',
        'video_ht_view8_paginator_color' => '26A6FC',
        'video_ht_view8_paginator_fontsize' => '18',
        'video_ht_view8_loadmore_position' => 'center',
        'video_ht_view8_loadmore_fontsize' => '14',
        'video_ht_view8_button_color' => '26A6FC',
        'video_ht_view8_loadmore_font_color' => 'FF1C1C',
        'video_ht_view8_loading_type' => '3',
        'video_ht_view8_loadmore_text' => 'View More',
        'video_ht_view7_paginator_fontsize' => '22',
        'video_ht_view7_paginator_color' => '0A0202',
        'video_ht_view7_paginator_icon_color' => '333333',
        'video_ht_view7_paginator_icon_size' => '22',
        'video_ht_view7_paginator_position' => 'center',
        'video_ht_view7_loadmore_position' => 'center',
        'video_ht_view7_loadmore_fontsize' => '19',
        'video_ht_view7_button_color' => '333333',
        'video_ht_view7_loadmore_font_color' => 'CCCCCC',
        'video_ht_view7_loading_type' => '1',
        'video_ht_view7_loadmore_text' => 'View More',
        'video_ht_view4_paginator_fontsize' => '19',
        'video_ht_view4_paginator_color' => 'FF2C2C',
        'video_ht_view4_paginator_icon_color' => 'B82020',
        'video_ht_view4_paginator_icon_size' => '21',
        'video_ht_view4_paginator_position' => 'center',
        'video_ht_view4_loadmore_position' => 'center',
        'video_ht_view4_loadmore_fontsize' => '16',
        'video_ht_view4_button_color' => '5CADFF',
        'video_ht_view4_loadmore_font_color' => 'FF0D0D',
        'video_ht_view4_loading_type' => '3',
        'video_ht_view4_loadmore_text' => 'View More',
        'video_ht_view1_paginator_fontsize' => '22',
        'video_ht_view1_paginator_color' => '222222',
        'video_ht_view1_paginator_icon_color' => 'FF2C2C',
        'video_ht_view1_paginator_icon_size' => '22',
        'video_ht_view1_paginator_position' => 'left',
        'video_ht_view1_loadmore_position' => 'center',
        'video_ht_view1_loadmore_fontsize' => '22',
        'video_ht_view1_button_color' => 'FF2C2C',
        'video_ht_view1_loadmore_font_color' => 'FFFFFF',
        'video_ht_view1_loading_type' => '2',
        'video_ht_view1_loadmore_text' => 'Load More',
        'video_ht_view9_loadmore_font_color_hover' => 'D9D9D9',
        'video_ht_view9_button_color_hover' => '8F827C',
        'video_ht_view8_loadmore_font_color_hover' => 'FF4242',
        'video_ht_view8_button_color_hover' => '0FEFFF',
        'video_ht_view7_loadmore_font_color_hover' => 'D9D9D9',
        'video_ht_view7_button_color_hover' => '8F827C',
        'video_ht_view4_loadmore_font_color_hover' => 'FF4040',
        'video_ht_view4_button_color_hover' => '99C5FF',
        'video_ht_view1_loadmore_font_color_hover' => 'F2F2F2',
        'video_ht_view1_button_color_hover' => '991A1A',
        'image_natural_size_thumbnail' => 'resize',
        'image_natural_size_contentpopup' => 'resize',
        'ht_popup_rating_count' => 'on',
        'ht_popup_likedislike_bg' => '7993A3',
        'ht_contentsl_rating_count' => 'on',
        'ht_popup_likedislike_bg_trans' => '0',
        'ht_popup_likedislike_thumb_color' => '2EC7E6',
        'ht_popup_likedislike_thumb_active_color' => '2883C9',
        'ht_popup_likedislike_font_color' => '454545',
        'ht_popup_active_font_color' => '000000',
        'ht_contentsl_likedislike_bg' => '7993A3',
        'ht_contentsl_likedislike_bg_trans' => '0',
        'ht_contentsl_likedislike_thumb_color' => '2EC7E6',
        'ht_contentsl_likedislike_thumb_active_color' => '2883C9',
        'ht_contentsl_likedislike_font_color' => '454545',
        'ht_contentsl_active_font_color' => '1C1C1C',
        'ht_lightbox_rating_count' => 'on',
        'ht_lightbox_likedislike_bg' => 'FFFFFF',
        'ht_lightbox_likedislike_bg_trans' => '20',
        'ht_lightbox_likedislike_thumb_color' => '7A7A7A',
        'ht_lightbox_likedislike_thumb_active_color' => 'E83D09',
        'ht_lightbox_likedislike_font_color' => 'FFFFFF',
        'ht_lightbox_active_font_color' => 'FFFFFF',
        'ht_slider_rating_count' => 'on',
        'ht_slider_likedislike_bg' => 'FFFFFF',
        'ht_slider_likedislike_bg_trans' => '70',
        'ht_slider_likedislike_thumb_color' => '000000',
        'ht_slider_likedislike_thumb_active_color' => 'FF3D3D',
        'ht_slider_likedislike_font_color' => '3D3D3D',
        'ht_slider_active_font_color' => '1C1C1C',
        'ht_thumb_rating_count' => 'on',
        'ht_thumb_likedislike_bg' => '63150C',
        'ht_thumb_likedislike_bg_trans' => '0',
        'ht_thumb_likedislike_thumb_color' => 'F7F7F7',
        'ht_thumb_likedislike_thumb_active_color' => 'E65010',
        'ht_thumb_likedislike_font_color' => 'E6E6E6',
        'ht_thumb_active_font_color' => 'FFFFFF',
        'ht_just_rating_count' => 'off',
        'ht_just_likedislike_bg' => 'FFFFFF',
        'ht_just_likedislike_bg_trans' => '0',
        'ht_just_likedislike_thumb_color' => 'FFFFFF',
        'ht_just_likedislike_thumb_active_color' => '0ECC5A',
        'ht_just_likedislike_font_color' => '030303',
        'ht_just_active_font_color' => 'EDEDED',
        'ht_blog_rating_count' => 'on',
        'ht_blog_likedislike_bg' => '0B0B63',
        'ht_blog_likedislike_bg_trans' => '0',
        'ht_blog_likedislike_thumb_color' => '8F827C',
        'ht_blog_likedislike_thumb_active_color' => '5CADFF',
        'ht_blog_likedislike_font_color' => '4D4B49',
        'ht_blog_active_font_color' => '020300',
        'ht_popup_heart_likedislike_thumb_color' => '84E0E3',
        'ht_popup_heart_likedislike_thumb_active_color' => '46B4E3',
        'ht_contentsl_heart_likedislike_thumb_color' => '84E0E3',
        'ht_contentsl_heart_likedislike_thumb_active_color' => '46B4E3',
        'ht_lightbox_heart_likedislike_thumb_color' => 'B50000',
        'ht_lightbox_heart_likedislike_thumb_active_color' => 'EB1221',
        'ht_slider_heart_likedislike_thumb_color' => '8F8F8F',
        'ht_slider_heart_likedislike_thumb_active_color' => 'FF2A12',
        'ht_thumb_heart_likedislike_thumb_color' => 'FF0000',
        'ht_thumb_heart_likedislike_thumb_active_color' => 'C21313',
        'ht_just_heart_likedislike_thumb_color' => 'E0E0E0',
        'ht_just_heart_likedislike_thumb_active_color' => 'F23D3D',
        'ht_blog_heart_likedislike_thumb_color' => 'D63E48',
        'ht_blog_heart_likedislike_thumb_active_color' => 'E00000',
        'photo_gallery_wp_admin_image_hover_preview' => 'on'
    );

    return $gallery_default__params;
}

function photo_gallery_wp_get_view_slag_by_id($id)
{
    global $wpdb;
    $query = $wpdb->prepare("SELECT photo_gallery_wp_sl_effects from " . $wpdb->prefix . "photo_gallery_wp_gallerys WHERE id=%d", $id);
    $view = $wpdb->get_var($query);
    switch ($view) {
        case 0:
            $slug = 'content-popup';
            break;
        case 1:
            $slug = 'content-slider';
            break;
        case 3:
            $slug = 'slider';
            break;
        case 4:
            $slug = 'thumbnails';
            break;
        case 5:
            $slug = 'lightbox-gallery';
            break;
        case 6:
            $slug = 'justified';
            break;
        case 7:
            $slug = 'masonry';
            break;
        case 8:
            $slug = 'mosaic';
            break;
    }

    return $slug;
}

/**
 * Get attachment ID by image src
 *
 * @param $image_url
 *
 * @return mixed
 */
function photo_gallery_wp_get_image_id($image_url)
{
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $wpdb->prefix . "posts WHERE guid='%s';", $image_url));
    if($attachment)
        return $attachment[0];
}

/**
 * Get image url by image src, width, height
 *
 * @param $image_src
 * @param $image_width
 * @param $image_height
 * @param bool $is_attachment
 *
 * @return false|string
 */
function photo_gallery_wp_get_image_by_sizes_and_src($image_src, $image_sizes, $is_thumbnail)
{
    $is_attachment = photo_gallery_wp_get_image_id($image_src);
    $is_readable   = is_readable( $image_src );
    if ( $is_readable ) {
        $img_sizes  = getimagesize( $image_src );
        $img_height = $img_sizes[1];
    } else {
        $img_height = null;
    }

    if (is_string($image_sizes)) {
        $image_sizes = $image_sizes;
        $img_width = intval($image_sizes);
    }
    if (is_object($image_sizes)) {
        // Closures are currently implemented as objects
        $image_sizes = array($image_sizes, '');
    }
    if (!$is_attachment) {
        $image_url = $image_src;
    } else {
        $attachment_id = photo_gallery_wp_get_image_id($image_src);
        $natural_img_width = explode(',', wp_get_attachment_image_sizes($attachment_id, 'full'));
        $natural_img_width = $natural_img_width[1];
        $natural_img_width = str_replace(' ', '', $natural_img_width);
        $natural_img_width = intval(str_replace('px', '', $natural_img_width));
        if ($is_thumbnail) {
            $image_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
        } elseif ($image_sizes[0] <= 300 || $image_sizes[0] == '' ) {
            if( $img_height <=  $natural_img_width)
                $image_url = wp_get_attachment_image_url( $attachment_id, 'medium' );
            else
                $image_url = wp_get_attachment_image_url( $attachment_id, 'large' );
        }
        elseif($image_sizes[0] <= 700){
            $image_url = wp_get_attachment_image_url( $attachment_id, 'large' );
        } elseif ($image_sizes[0] >= $natural_img_width) {
            $image_url = wp_get_attachment_image_url($attachment_id, 'full');
        } else {
            $image_url = wp_get_attachment_image_url($attachment_id, $image_sizes);
        }
    }

    return $image_url;
}

/**
 * Get User IP
 * @return mixed
 */
function photo_gallery_wp_get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $huge_it_ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $huge_it_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $huge_it_ip = $_SERVER['REMOTE_ADDR'];
    }

    return $huge_it_ip;
}
