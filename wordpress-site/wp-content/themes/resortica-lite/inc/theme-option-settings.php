<?php
if ( ! function_exists( 'resortica_lite_theme_options' ) ) :
    function resortica_lite_theme_options() {
        $defaults = array(
            'site_title_chk'              => '1',
            'tagline_chk'                 => '1',
            'decor_image'                 => '',
            'banner_title'                => '',
            'banner_description'          => '',
            'banner_image'                => '',
            'show_gradient'               => 1,
            'custom_css'                  => '',
            'call_to_action_show'         => 1,
            'call_to_action_title'        => '',
            'call_to_action_description'  => '',
            'call_to_action_btn_txt'      => '',
            'call_to_action_btn_link'     => '',
            'social_media_enabled_header' => 1,
            'social_media_enabled_footer' => 1,
            'email_id'                    => '',
            'phone_no'                    => '',
            'twitter_link'                => '',
            'fb_link'                     => '',
            'linkedin_link'               => '',
            'gplus'                       => '',
            'youtube_link'                => '',
            'instagram'                   => '',
            'pinterest'                   => '',
            'testimonial_category'        => 'resortica_lite_default',
            'testimonial_bg_image'        => '',
            'testimonial_font_color'      => '',
            'pre_footer_display'          => 1,
            'stat_title_1'                => '',
            'stat_number_1'               => '',
            'stat_title_2'                => '',
            'stat_number_2'               => '',
            'stat_title_3'                => '',
            'stat_number_3'               => '',
            'stat_title_4'                => '',
            'stat_number_4'               => '',
            'intro_pages'                 => 0,
            'mid_section_1_cat'           => 'resortica_lite_default',
            'mid_section_2_cat'           => 'resortica_lite_default',
            'mid_section_3_cat'           => 'resortica_lite_default',
            'mid_section_1_title'         => '',
            'mid_section_2_title'         => '',
            'mid_section_3_title'         => '',
            'mid_bg_image'                => '',
            'footer_text'                 => '',
            );

          $options = get_option('resortica_lite_options', $defaults);

          //Parse defaults again - see comments
          $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;

if ( ! function_exists( 'resortica_lite_check' ) ) :
    function resortica_lite_check($check){
        echo '<pre>';
        print_r($check);
        echo '</pre>';
    }
endif;