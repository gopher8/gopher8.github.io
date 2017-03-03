<?php
/**
 * Theme Customizer
 *
 * @package Blanche
 */
function blanche_customize_register($wp_customize){
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action('customize_register', 'blanche_customize_register');
function blanche_customizer_css() {
    ?>
    <style type="text/css">
       a.more-link span { background: #<?php background_color(); ?>; }
    </style>
    <?php
}
add_action( 'wp_head', 'blanche_customizer_css' );

function blanche_customize_preview_js() {
	wp_enqueue_script( 'blanche_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'blanche_customize_preview_js' );