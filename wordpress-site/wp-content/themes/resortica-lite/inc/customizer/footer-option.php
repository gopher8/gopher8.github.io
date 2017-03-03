<?php
$wp_customize->add_setting('resortica_lite_options[footer_text]',
    array(
        'default' => '',
        'type' => 'option',
        'sanitize_callback' => 'esc_html'
        )
    );
$wp_customize->add_control('footer_text',
    array(
        'label' => esc_html__('Footer Text','resortica-lite'),
        'type' => 'text',
        'section' => 'footer_options',
        'settings' => 'resortica_lite_options[footer_text]',
        ));