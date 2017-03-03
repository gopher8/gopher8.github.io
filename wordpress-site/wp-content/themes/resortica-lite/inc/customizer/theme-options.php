<?php
if (!function_exists('resortica_lite_get_categories_select')) :
    function resortica_lite_get_categories_select()
  {
    $resrotica_cat = get_categories();
    $results = array();

    if (!empty($resrotica_cat)) :
      $results['resortica_lite_default'] = __('Select Category','resortica-lite');
    foreach ($resrotica_cat as $result) {
      $results[$result->slug] = $result->name;
    }
    endif;
    return $results;
  }
endif;

//Support section
$wp_customize->add_section( 'resortica_lite_theme_support', array(
        'title' => __( 'Support','resortica-lite' ),
        'priority' => 1, // Mixed with top-level-section hierarchy.
  ) );

$wp_customize->add_setting('resortica_lite_options[support_links]',
    array(
      'type' => 'option',
      'default' => '',
      'sanitize_callback' => 'esc_url',
      'capability' => 'edit_theme_options',
      )
    );
$wp_customize->add_control(new Resortica_Lite_Support_Control($wp_customize,'support_links',array(
  'label' => 'Support',
  'section' => 'resortica_lite_theme_support',
  'settings' => 'resortica_lite_options[support_links]',
  'type' => 'resortica-lite-support',
  )
  )
);

/*Site title*/

$wp_customize->add_setting('resortica_lite_options[site_title_chk]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'resortica_lite_sanitize_checkbox',
    'default' => 1,
     ));
$wp_customize->add_control( 'site_title_chk', array(
    'type'          => 'checkbox',
    'section'         => 'title_tagline',
    'settings'   => 'resortica_lite_options[site_title_chk]',
    'label'         => __( 'Show/Hide Site Title', 'resortica-lite' ),
));

$wp_customize->add_setting('resortica_lite_options[tagline_chk]', array(
    'type' => 'option',
    'sanitize_callback' => 'resortica_lite_sanitize_checkbox',
    'default' => 1,
    ));
$wp_customize->add_control( 'tagline_chk', array(
    'type'          => 'checkbox',
    'section'         => 'title_tagline',
    'settings'   => 'resortica_lite_options[tagline_chk]',
    'label'         => __( 'Show/Hide Tagline', 'resortica-lite' ),
));

//Decor Image
$wp_customize->add_setting(
    'resortica_lite_options[decor_image]',
    array(
      'type'              => 'option',
      'default'           =>'',
      'sanitize_callback' =>'resortica_lite_sanitize_image',
      'capability'        => 'edit_theme_options',
    )
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'decor_image', array(
        'label'        => __( 'Add Decor Image', 'resortica-lite' ),
        'section'    => 'title_tagline',
        'settings'   => 'resortica_lite_options[decor_image]',
        'priority'          => 1,
    )
  )
);


//Banner section
$wp_customize->add_setting(
  'resortica_lite_options[banner_title]',
  array(
    'default'=>'',
    'type'=>'option',
    'capability'=>'edit_theme_options',
    'sanitize_callback'=>'esc_html',

    )
  );
$wp_customize->add_control('banner_title', array(
  'label'        => __('Banner Title', 'resortica-lite'),
  'type'=>'text',
  'section'    => 'banner_options',
  'settings'   => 'resortica_lite_options[banner_title]'
  ) );

$wp_customize->add_setting('resortica_lite_options[banner_description]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => '',
    )
  );
$wp_customize->add_control('banner_description',
  array(
    'type'              => 'textarea',
    'section'           => 'banner_options',
    'label'             => esc_html__('Banner Description','resortica-lite'),
    'settings'   => 'resortica_lite_options[banner_description]'
    )
  );

$wp_customize->add_setting(
    'resortica_lite_options[banner_image]',
    array(
      'type'              => 'option',
      'default'           =>'',
      'sanitize_callback' =>'resortica_lite_sanitize_image',
      'capability'        => 'edit_theme_options',
    )
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'banner_image', array(
        'label'        => __( 'Banner Image', 'resortica-lite' ),
        'section'    => 'banner_options',
        'settings'   => 'resortica_lite_options[banner_image]',
    )
  )
);

//Gradient settings

$wp_customize->add_setting(
  'resortica_lite_options[show_gradient]',
  array(
    'default'=>1,
    'type'=>'option',
    'capability'=>'edit_theme_options',
    'sanitize_callback'=>'esc_html',

    )
  );
$wp_customize->add_control('show_gradient', array(
  'label'        => __('Show Gradient?', 'resortica-lite'),
  'description'        => __('Show/hide Gradient throughout the site.', 'resortica-lite'),
  'type'=>'checkbox',
  'section'    => 'gradient_options',
  'settings'   => 'resortica_lite_options[show_gradient]'
  ) );

/* Testimonial Options */
$wp_customize->add_setting('resortica_lite_options[testimonial_category]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => 'resortica_lite_default',
    )
  );
$wp_customize->add_control('testimonial_category',
  array(
    'type'              => 'select',
    'section'           => 'testimonial_options',
    'label'             => esc_html__('Testimonial Category','resortica-lite'),
    'choices'           => resortica_lite_get_categories_select(),
    'settings'   => 'resortica_lite_options[testimonial_category]'
    )
  );

$wp_customize->add_setting(
      'resortica_lite_options[testimonial_bg_image]',
      array(
        'type'              => 'option',
        'default'           =>'',
        'sanitize_callback' =>'resortica_lite_sanitize_image',
        'capability'        => 'edit_theme_options',
      )
  );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'testimonial_bg_image', array(
          'label'        => __( 'Add Background Image', 'resortica-lite' ),
          'section'    => 'testimonial_options',
          'settings'   => 'resortica_lite_options[testimonial_bg_image]',
      )
    )
  );

  $wp_customize->add_setting(
      'resortica_lite_options[testimonial_font_color]',
       array(
          'type'      => 'option',
        'default'          => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
      ) );
    $wp_customize->add_control(new WP_Customize_Color_Control ( $wp_customize, 'testimonial_font_color', array(
        'label' => __( 'Testimonial Font Color', 'resortica-lite' ),
        'section'     => 'testimonial_options',
        'settings'   => 'resortica_lite_options[testimonial_font_color]')
      ) );

  /* Pre-Footer */
  $wp_customize->add_setting(
    'resortica_lite_options[pre_footer_display]',
    array(
      'default'           =>1,
      'type'              =>'option',
      'sanitize_callback' =>'resortica_lite_sanitize_checkbox',
      'capability'        =>'edit_theme_options'
      )
    );
  $wp_customize->add_control( 'pre_footer_display', array(
    'label'    => __( 'Enable Pre-Footer on Home Page', 'resortica-lite' ),
    'type'     =>'checkbox',
    'section'  => 'pre_footer_options',
    'settings' => 'resortica_lite_options[pre_footer_display]'
    )
  );

/* Intro Options*/
$wp_customize->add_setting(
  'resortica_lite_options[intro_pages]',
  array(
    'default'=>0,
    'type'=>'option',
    'sanitize_callback'=>'absint',
    'capability'=>'edit_theme_options'
    )
  );
$wp_customize->add_control( 'intro_pages', array(
  'label'        =>  __('Choose Introduction Page :', 'resortica-lite' ),
  'type'    => 'dropdown-pages',
  'section'    => 'introduction_options',
  'settings'   => 'resortica_lite_options[intro_pages]'
  ) );

/* Mid Section Options*/
$wp_customize->add_setting('resortica_lite_options[restotica_lite_mid_sec1]', array(
        'type'              => 'info',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new Restrotica_Lite_Section_Info( $wp_customize, 'restotica_lite_mid_sec1', array(
        'label'    => __( 'Mid Section 1', 'resortica-lite' ),
        'section'  => 'mid_section_options',
        'settings' => 'resortica_lite_options[restotica_lite_mid_sec1]',
        ) )
);
$wp_customize->add_setting('resortica_lite_options[mid_section_1_title]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => '',
    )
  );
  $wp_customize->add_control('mid_section_1_title',
    array(
      'type' => 'text',
      'section' => 'mid_section_options',
      'label' => __('Add Section 1 Title','resortica-lite'),
      'settings' => 'resortica_lite_options[mid_section_1_title]',
      )
    );
$wp_customize->add_setting('resortica_lite_options[mid_section_1_cat]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => 'resortica_lite_default',
    )
  );
$wp_customize->add_control('mid_section_1_cat',
  array(
    'type'              => 'select',
    'section'           => 'mid_section_options',
    'label'             => esc_html__('Mid Section 1','resortica-lite'),
    'choices'           => resortica_lite_get_categories_select(),
    'settings'   => 'resortica_lite_options[mid_section_1_cat]'
    )
  );

$wp_customize->add_setting(
    'resortica_lite_options[mid_bg_image]',
    array(
      'type'              => 'option',
      'default'           =>'',
      'sanitize_callback' =>'resortica_lite_sanitize_image',
      'capability'        => 'edit_theme_options',
    )
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mid_bg_image', array(
        'label'        => __( 'Add Background Image', 'resortica-lite' ),
        'section'    => 'mid_section_options',
        'settings'   => 'resortica_lite_options[mid_bg_image]',
    )
  )
);

  $wp_customize->add_setting('resortica_lite_options[restotica_lite_mid_sec2]', array(
          'type'              => 'info',
          'capability'        => 'edit_theme_options',
          'sanitize_callback' => 'esc_html',
      )
  );
  $wp_customize->add_control( new Restrotica_Lite_Section_Info( $wp_customize, 'restotica_lite_mid_sec2', array(
          'label'    => __( 'Mid Section 2', 'resortica-lite' ),
          'section'  => 'mid_section_options',
          'settings' => 'resortica_lite_options[restotica_lite_mid_sec2]',
          ) )
  );
  $wp_customize->add_setting('resortica_lite_options[mid_section_2_title]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => '',
    )
  );
  $wp_customize->add_control('mid_section_2_title',
    array(
      'type' => 'text',
      'section' => 'mid_section_options',
      'label' => __('Add Section 2 Title','resortica-lite'),
      'settings' => 'resortica_lite_options[mid_section_2_title]',
      )
    );

  $wp_customize->add_setting('resortica_lite_options[mid_section_2_cat]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => 'resortica_lite_default',
    )
  );
  $wp_customize->add_control('mid_section_2_cat',
  array(
    'type'              => 'select',
    'section'           => 'mid_section_options',
    'label'             => esc_html__('Mid Section 2','resortica-lite'),
    'choices'           => resortica_lite_get_categories_select(),
    'settings'   => 'resortica_lite_options[mid_section_2_cat]'
    )
  );

  $wp_customize->add_setting('resortica_lite_options[mid_section_3_title]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => '',
    )
  );

  $wp_customize->add_setting('resortica_lite_options[restotica_lite_mid_sec3]', array(
          'type'              => 'info',
          'capability'        => 'edit_theme_options',
          'sanitize_callback' => 'esc_html',
      )
  );
  $wp_customize->add_control( new Restrotica_Lite_Section_Info( $wp_customize, 'restotica_lite_mid_sec3', array(
          'label'    => __( 'Mid Section 3', 'resortica-lite' ),
          'section'  => 'mid_section_options',
          'settings' => 'resortica_lite_options[restotica_lite_mid_sec3]',
          ) )
  );
  $wp_customize->add_control('mid_section_3_title',
    array(
      'type' => 'text',
      'section' => 'mid_section_options',
      'label' => __('Add Section 3 Title','resortica-lite'),
      'settings' => 'resortica_lite_options[mid_section_3_title]',
      )
    );

$wp_customize->add_setting('resortica_lite_options[mid_section_3_cat]',
  array(
    'type' => 'option',
    'sanitize_callback' => 'esc_html',
    'default' => 'resortica_lite_default',
    )
  );
$wp_customize->add_control('mid_section_3_cat',
  array(
    'type'              => 'select',
    'section'           => 'mid_section_options',
    'label'             => esc_html__('Mid Section 3','resortica-lite'),
    'choices'           => resortica_lite_get_categories_select(),
    'settings'   => 'resortica_lite_options[mid_section_3_cat]'
    )
  );
$version_wp = get_bloginfo('version');
  if($version_wp < 4.7){
  /* Custom CSS section */
  $wp_customize->add_setting(
    'resortica_lite_options[custom_css]',
    array(
      'default'=>'',
      'type'=>'option',
      'capability'=>'edit_theme_options',
      'sanitize_callback'=>'resortica_lite_sanitize_css'
      )
    );
  $wp_customize->add_control( 'custom_css', array(
    'label'        => __( 'Add CSS', 'resortica-lite' ),
    'type'=>'textarea',
    'section'    => 'custom_css_options',
    'settings'   => 'resortica_lite_options[custom_css]'
    ) );
}