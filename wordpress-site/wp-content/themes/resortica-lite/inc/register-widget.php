<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if(!function_exists('resortica_lite_widgets_init')):
    function resortica_lite_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'resortica-lite' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'resortica-lite' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Pre-Footer Widget 1', 'resortica-lite' ),
            'id'            => 'sidebar-2',
            'description'   => esc_html__( 'Add Pre Footer widgets here.', 'resortica-lite' ),
            'before_widget' => '<aside id="%1$s" class="widget widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Pre-Footer Widget 2', 'resortica-lite' ),
            'id'            => 'sidebar-3',
            'description'   => esc_html__( 'Add Pre Footer widgets here.', 'resortica-lite' ),
            'before_widget' => '<aside id="%1$s" class="widget widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Pre-Footer Widget 3', 'resortica-lite' ),
            'id'            => 'sidebar-4',
            'description'   => esc_html__( 'Add Pre Footer widgets here.', 'resortica-lite' ),
            'before_widget' => '<aside id="%1$s" class="widget widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
    }
    add_action( 'widgets_init', 'resortica_lite_widgets_init' );
endif;