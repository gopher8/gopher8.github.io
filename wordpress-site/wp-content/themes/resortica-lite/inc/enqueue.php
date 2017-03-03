<?php

/**
 * Register Google fonts for Resortica Lite.
 *
 * Create your own resortica_lite_fonts_url() function to override in a child theme.
 *
 * @since Resortica Lite
 *
 * @return string Google fonts URL for the theme.
 */
if ( ! function_exists( 'resortica_lite_fonts_url' ) ) :
    function resortica_lite_fonts_url() {
        $fonts_url = '';
        $fonts     = array();

        /* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'resortica-lite' ) ) {
            $fonts[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
        }

        /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'resortica-lite' ) ) {
            $fonts[] = 'Roboto';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

if(!function_exists('resortica_lite_scripts')):
    /**
     * Enqueue scripts and styles.
     */
    function resortica_lite_scripts() {
        wp_enqueue_style( 'resortica-lite-fonts', resortica_lite_fonts_url() , array(), null);

        wp_enqueue_style( 'resortica-lite-style', get_stylesheet_uri() );
        wp_enqueue_style( 'resortica-lite-custom',get_template_directory_uri() . '/assets/css/resortica-lite.css', array(), '27062016' );
        $resortica_lite_theme_options = resortica_lite_theme_options();
        $version_wp = get_bloginfo('version');
        if($version_wp < 4.7){
            $custom_css = $resortica_lite_theme_options['custom_css'];
        }
        else{
            $custom_css = "";
        }
        $banner_image = $resortica_lite_theme_options['banner_image'];
        $testimonial_font_color = $resortica_lite_theme_options['testimonial_font_color'];
        $show_gradient = $resortica_lite_theme_options['show_gradient'];

        $color = ".header{background: url($banner_image) no-repeat center center fixed;}
            .client-testimonials h1.section-title, .client-testimonials .testimonial-slide .client-testimonial p, .client-testimonials .slick-next, .client-testimonials .slick-prev {
                    color: $testimonial_font_color
                }
            .client-testimonials span.pagingInfo {
                color: $testimonial_font_color
            }
            ";
        if ($show_gradient != 1) {
            $color .= " .gradient-bg:before {
                    display: none !important;
                }";
        }
        $color .= $custom_css;
        wp_add_inline_style( 'resortica-lite-custom', $color );


        wp_enqueue_script( 'resortica-lite-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '23062016', true );
        wp_enqueue_script( 'resortica-lite-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

        wp_enqueue_script( 'resortica-lite-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '3.3.6', true );
        wp_enqueue_script( 'slick-script', get_template_directory_uri() . '/assets/js/slick.min.js', array(), '1.6.0', true );
        wp_enqueue_script( 'countto', get_template_directory_uri() . '/assets/js/jquery.countTo.js', array(), '22082016', true );
        wp_enqueue_script( 'sidr', get_template_directory_uri() . '/assets/js/jquery.sidr.min.js', array(), '22082016', true );
        wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/fitvids.min.js', array(), '22082016', true );
        wp_enqueue_script( 'resortica-lite-app', get_template_directory_uri() . '/assets/js/app.js', array(), '22082016', true );



        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'resortica_lite_scripts' );
endif;
