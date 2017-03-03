<?php
/**
 * resortica-lite Theme Customizer.
 *
 * @package resortica-lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if(!function_exists('resortica_lite_customize_register')):
    function resortica_lite_customize_register( $wp_customize ) {
    	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        $wp_customize->remove_control('display_header_text');

        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'resortica_lite_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'resortica_lite_customize_partial_blogdescription',
        ) );

        $wp_customize->add_panel(
            'theme_options',
            array(
                'title' => __( 'Theme Options','resortica-lite' ),
                'priority' => 2,
                )
            );
        /* Banner section */
        $wp_customize->add_section(
            'banner_options',
            array(
                'title'    => __( 'Banner Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 1,
                )
            );

         /* Gradient section */
        $wp_customize->add_section(
            'gradient_options',
            array(
                'title'    => __( 'Gradient Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 1,
                )
            );

        /* Testimonial section */
        $wp_customize->add_section(
            'testimonial_options',
            array(
                'title'    => __( 'Testimonial Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 5,
                )
            );
        /*Call-to-action Options*/
        $wp_customize->add_section(
            'call_to_action_options',
            array(
                'title'    => __( 'Call-to-Action Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 6,
                )
            );
         /* Intro Options*/
        $wp_customize->add_section(
            'introduction_options',
            array(
                'title'    => __( 'Intro Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 2,
                )
            );

         /* Mid Section Options*/
        $wp_customize->add_section(
            'mid_section_options',
            array(
                'title'    => __( 'Mid Section Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 4,
                )
            );
        /* Stat Options*/
        $wp_customize->add_section(
            'stat_options',
            array(
                'title'    => __( 'Stat Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 3,
                )
            );
        /* Pre-Footer */
        $wp_customize->add_section(
            'pre_footer_options',
            array(
                'title'    => __( 'Pre-Footer Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 7,
                )
            );
        /* Social Section */
        $wp_customize->add_section(
            'social_section',
            array(
                'title'    => __( 'Social Options','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 8,
                )
            );
        /* Custom CSS section */
        $wp_customize->add_section(
            'custom_css_options',
            array(
                'title'    => __( 'Custom CSS','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 10,
                )
            );
         /* Footer section */
        $wp_customize->add_section(
            'footer_options',
            array(
                'title'    => __( 'Footer Section','resortica-lite' ),
                'panel' => 'theme_options',
                'priority' => 9,
                )
            );
        require get_template_directory() . '/inc/customizer/custom-class.php';
        require get_template_directory() . '/inc/customizer/theme-options.php';
        require get_template_directory() . '/inc/customizer/cta-options.php';
        require get_template_directory() . '/inc/customizer/social-options.php';
        require get_template_directory() . '/inc/customizer/stat-options.php';
        require get_template_directory() . '/inc/customizer/footer-option.php';
        require get_template_directory() . '/inc/customizer/custom-sanitization.php';


    }
    add_action( 'customize_register', 'resortica_lite_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if(!function_exists('resortica_lite_customize_preview_js')):
    function resortica_lite_customize_preview_js() {
        wp_enqueue_script( 'resortica_lite_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'jquery','customize-preview' ), '20151215', true );
    }
    add_action( 'customize_preview_init', 'resortica_lite_customize_preview_js' );
endif;


/**
 * Render the site title for the selective refresh partial.
 *
 *
 * @return void
 */
function resortica_lite_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 *
 * @return void
 */
function resortica_lite_customize_partial_blogdescription() {
    bloginfo( 'description' );
}