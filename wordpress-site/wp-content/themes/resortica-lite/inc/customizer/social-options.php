<?php
/* Social Section  */
$wp_customize->add_setting(
  'resortica_lite_options[social_media_enabled_header]',
  array(
    'default'=>1,
    'type'=>'option',
    'sanitize_callback'=>'resortica_lite_sanitize_checkbox',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'social_media_enabled_header', array(
  'label'    => __( 'Enable Social Media Icons in Header', 'resortica-lite' ),
  'type'     =>'checkbox',
  'section'  => 'social_section',
  'settings' => 'resortica_lite_options[social_media_enabled_header]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[social_media_enabled_footer]',
  array(
    'default'=>1,
    'type'=>'option',
    'sanitize_callback'=>'resortica_lite_sanitize_checkbox',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'social_media_enabled_footer', array(
  'label'    => __( 'Enable Social Media Icons in Footer', 'resortica-lite' ),
  'type'     =>'checkbox',
  'section'  => 'social_section',
  'settings' => 'resortica_lite_options[social_media_enabled_footer]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[email_id]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'sanitize_callback' =>'sanitize_email',
    'capability'        =>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'email_id', array(
  'label'        =>  __('Email ID', 'resortica-lite' ),
  'type'=>'email',
  'section'    => 'social_section',
  'settings'   => 'resortica_lite_options[email_id]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[phone_no]',
  array(
    'default'=>'',
    'type'=>'option',
    'sanitize_callback'=>'absint',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'phone_no', array(
  'label'        =>  __('Phone Number', 'resortica-lite' ),
  'type'=>'text',
  'section'    => 'social_section',
  'settings'   => 'resortica_lite_options[phone_no]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[twitter_link]',
  array(
    'default'=>'',
    'type'=>'option',
    'sanitize_callback'=>'esc_url_raw',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'twitter_link', array(
  'label'        =>  __('Twitter', 'resortica-lite' ),
  'type'=>'url',
  'section'    => 'social_section',
  'settings'   => 'resortica_lite_options[twitter_link]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[fb_link]',
  array(
    'default'=>'',
    'type'=>'option',
    'sanitize_callback'=>'esc_url_raw',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'fb_link', array(
  'label'        => __( 'Facebook', 'resortica-lite' ),
  'type'=>'url',
  'section'    => 'social_section',
  'settings'   => 'resortica_lite_options[fb_link]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[linkedin_link]',
  array(
    'default'=>'',
    'type'=>'option',
    'sanitize_callback'=>'esc_url_raw',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'linkedin_link', array(
  'label'        => __( 'LinkedIn', 'resortica-lite' ),
  'type'=>'url',
  'section'    => 'social_section',
  'settings'   => 'resortica_lite_options[linkedin_link]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[gplus]',
  array(
    'default'=>'',
    'type'=>'option',
    'sanitize_callback'=>'esc_url_raw',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'gplus', array(
  'label'        => __( 'Google+', 'resortica-lite' ),
  'type'=>'url',
  'section'    => 'social_section',
  'settings'   => 'resortica_lite_options[gplus]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[youtube_link]',
  array(
    'default'=>'',
    'type'=>'option',
    'sanitize_callback'=>'esc_url_raw',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'youtube_link', array(
  'label'        => __( 'Youtube', 'resortica-lite' ),
  'type'=>'url',
  'section'    => 'social_section',
  'settings'   => 'resortica_lite_options[youtube_link]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[instagram]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'sanitize_callback' =>'esc_url_raw',
    'capability'        =>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'instagram', array(
  'label'    => __( 'Instagram', 'resortica-lite' ),
  'type'     =>'url',
  'section'  => 'social_section',
  'settings' => 'resortica_lite_options[instagram]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[pinterest]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'sanitize_callback' =>'esc_url_raw',
    'capability'        =>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'pinterest', array(
  'label'    => __( 'Pinterest', 'resortica-lite' ),
  'type'     =>'url',
  'section'  => 'social_section',
  'settings' => 'resortica_lite_options[pinterest]'
  ) );