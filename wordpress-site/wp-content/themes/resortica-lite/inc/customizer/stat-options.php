<?php
$wp_customize->add_setting('resortica_lite_options[restotica_lite_stat_1]', array(
        'type'              => 'info',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new Restrotica_Lite_Section_Info( $wp_customize, 'restotica_lite_stat_1', array(
        'label'    => __( 'Stats One', 'resortica-lite' ),
        'section'  => 'stat_options',
        'settings' => 'resortica_lite_options[restotica_lite_stat_1]',
        ) )
);
$wp_customize->add_setting(
  'resortica_lite_options[stat_title_1]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'esc_html',
    )
  );
$wp_customize->add_control( 'stat_title_1', array(
  'label'    => __( 'Title:', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_title_1]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[stat_number_1]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'absint',
    )
  );
$wp_customize->add_control( 'stat_number_1', array(
  'label'    => __( 'Number', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_number_1]'
  ) );

$wp_customize->add_setting('resortica_lite_options[restotica_lite_stat_2]', array(
        'type'              => 'info',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control( new Restrotica_Lite_Section_Info( $wp_customize, 'restotica_lite_stat_2', array(
        'label'    => __( 'Stats Two', 'resortica-lite' ),
        'section'  => 'stat_options',
        'settings' => 'resortica_lite_options[restotica_lite_stat_2]',
        ) )
);

$wp_customize->add_setting(
  'resortica_lite_options[stat_title_2]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'esc_html',
    )
  );
$wp_customize->add_control( 'stat_title_2', array(
  'label'    => __( 'Title:', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_title_2]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[stat_number_2]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'absint',
    )
  );
$wp_customize->add_control( 'stat_number_2', array(
  'label'    => __( 'Number', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_number_2]'
  ) );

$wp_customize->add_setting('resortica_lite_options[restotica_lite_stat_3]', array(
        'type'              => 'info',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control( new Restrotica_Lite_Section_Info( $wp_customize, 'restotica_lite_stat_3', array(
        'label'    => __( 'Stats Three', 'resortica-lite' ),
        'section'  => 'stat_options',
        'settings' => 'resortica_lite_options[restotica_lite_stat_3]',
        ) )
);

$wp_customize->add_setting(
  'resortica_lite_options[stat_title_3]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'esc_html',
    )
  );
$wp_customize->add_control( 'stat_title_3', array(
  'label'    => __( 'Title:', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_title_3]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[stat_number_3]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'absint',
    )
  );
$wp_customize->add_control( 'stat_number_3', array(
  'label'    => __( 'Number', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_number_3]'
  ) );


$wp_customize->add_setting('resortica_lite_options[restotica_lite_stat_4]', array(
        'type'              => 'info',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control( new Restrotica_Lite_Section_Info( $wp_customize, 'restotica_lite_stat_4', array(
        'label'    => __( 'Stats Four', 'resortica-lite' ),
        'section'  => 'stat_options',
        'settings' => 'resortica_lite_options[restotica_lite_stat_4]',
        ) )
);

$wp_customize->add_setting(
  'resortica_lite_options[stat_title_4]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'esc_html',
    )
  );
$wp_customize->add_control( 'stat_title_4', array(
  'label'    => __( 'Title:', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_title_4]'
  ) );

$wp_customize->add_setting(
  'resortica_lite_options[stat_number_4]',
  array(
    'default'           =>'',
    'type'              =>'option',
    'capability'        =>'edit_theme_options',
    'sanitize_callback' =>'absint',
    )
  );
$wp_customize->add_control( 'stat_number_4', array(
  'label'    => __( 'Number', 'resortica-lite' ),
  'type'     =>'text',
  'section'  => 'stat_options',
  'settings' => 'resortica_lite_options[stat_number_4]'
  ) );