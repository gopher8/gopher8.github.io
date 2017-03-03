<?php
/* Call-to-action Options */
$wp_customize->add_setting(
  'resortica_lite_options[call_to_action_show]',
  array(
    'default'=>1,
    'type'=>'option',
    'capability'=>'edit_theme_options',
    'sanitize_callback'=>'resortica_lite_sanitize_checkbox',
    )
  );
$wp_customize->add_control( 'call_to_action_show', array(
  'label'        => __( 'Enable CTA on Home Page', 'resortica-lite' ),
  'type'=>'checkbox',
  'section'    => 'call_to_action_options',
  'settings'   => 'resortica_lite_options[call_to_action_show]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[call_to_action_title]',
  array(
    'default'=>'',
    'type'=>'option',
    'capability'=>'edit_theme_options',
    'sanitize_callback'=>'esc_html',
    )
  );
$wp_customize->add_control( 'call_to_action_title', array(
  'label'        => __( 'Call To Action Title', 'resortica-lite' ),
  'type'=>'text',
  'section'    => 'call_to_action_options',
  'settings'   => 'resortica_lite_options[call_to_action_title]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[call_to_action_description]',
  array(
    'default'=>'',
    'type'=>'option',
    'capability'=>'edit_theme_options',
    'sanitize_callback'=>'esc_html',
    )
  );
$wp_customize->add_control( 'call_to_action_description', array(
  'label'        => __( 'Call To Action Description', 'resortica-lite' ),
  'type'=>'textarea',
  'section'    => 'call_to_action_options',
  'settings'   => 'resortica_lite_options[call_to_action_description]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[call_to_action_btn_txt]',
  array(
    'default'=>'',
    'type'=>'option',
    'capability'=>'edit_theme_options',
    'sanitize_callback'=>'esc_html',
    )
  );
$wp_customize->add_control( 'call_to_action_btn_txt', array(
  'label'        => __( 'Call To Action Button Text', 'resortica-lite' ),
  'type'=>'text',
  'section'    => 'call_to_action_options',
  'settings'   => 'resortica_lite_options[call_to_action_btn_txt]'
  ) );
$wp_customize->add_setting(
  'resortica_lite_options[call_to_action_btn_link]',
  array(
    'default'=>'',
    'type'=>'option',
    'capability'=>'edit_theme_options',
    'sanitize_callback'=>'esc_url_raw',
    )
  );
$wp_customize->add_control( 'call_to_action_btn_link', array(
  'label'        => __( 'Call To Action Button Link', 'resortica-lite' ),
  'type'=>'text',
  'section'    => 'call_to_action_options',
  'settings'   => 'resortica_lite_options[call_to_action_btn_link]'
  ) );