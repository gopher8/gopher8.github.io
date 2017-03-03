<?php
/**
*
* Template Name: Home
*
**/
get_header();
$resortica_lite_theme_options = resortica_lite_theme_options();
// get_template_part( 'template-parts/home-page/banner' );

get_template_part( 'template-parts/home-page/intro', 'page' );

get_template_part( 'template-parts/home-page/stats', 'section' );

get_template_part( 'template-parts/home-page/explore' );

get_template_part( 'template-parts/home-page/accomodation' );

get_template_part( 'template-parts/home-page/testimonial', 'section' );

if($resortica_lite_theme_options['call_to_action_show'] == 1):
    get_template_part( 'template-parts/home-page/cta', 'section' );
endif;

get_footer();