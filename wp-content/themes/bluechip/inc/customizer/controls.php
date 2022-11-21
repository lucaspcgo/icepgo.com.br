<?php 

/**
 * Customizer settings
 *
 * @package bluechip
 */

if ( ! function_exists( 'bluechip_theme_customizer' ) ) :
  function bluechip_theme_customizer( $wp_customize ) {

    /* Homepage Sections */
    $wp_customize->add_section( 'bluechip_homepage' , array(
      'title'       => __( 'Homepage Sections', 'bluechip' ),
      'priority'    => 30,
      'description' => __( 'Select a page to be assigned for each section', 'bluechip' ),
    ) );

    $wp_customize->add_setting( 'bluechip_banner', array (
      'sanitize_callback' => 'bluechip_sanitize_dropdown_pages',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bluechip_banner', array(
      'label'    => __( 'Banner', 'bluechip' ),
      'section'  => 'bluechip_homepage',
      'settings' => 'bluechip_banner',
      'type'     => 'dropdown-pages'
    ) ) );

    $wp_customize->add_setting( 'bluechip_section_1', array (
      'sanitize_callback' => 'bluechip_sanitize_dropdown_pages',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bluechip_section_1', array(
      'label'    => __( 'Section 1', 'bluechip' ),
      'section'  => 'bluechip_homepage',
      'settings' => 'bluechip_section_1',
      'type'     => 'dropdown-pages'
    ) ) );

    $wp_customize->add_setting( 'bluechip_section_2', array (
      'sanitize_callback' => 'bluechip_sanitize_dropdown_pages',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bluechip_section_2', array(
      'label'    => __( 'Section 2', 'bluechip' ),
      'section'  => 'bluechip_homepage',
      'settings' => 'bluechip_section_2',
      'type'     => 'dropdown-pages'
    ) ) );

    $wp_customize->add_setting( 'bluechip_section_3', array (
      'sanitize_callback' => 'bluechip_sanitize_dropdown_pages',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bluechip_section_3', array(
      'label'    => __( 'Section 3', 'bluechip' ),
      'section'  => 'bluechip_homepage',
      'settings' => 'bluechip_section_3',
      'type'     => 'dropdown-pages'
    ) ) );

    $wp_customize->add_setting( 'bluechip_section_4', array (
      'sanitize_callback' => 'bluechip_sanitize_dropdown_pages',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bluechip_section_4', array(
      'label'    => __( 'Section 4', 'bluechip' ),
      'section'  => 'bluechip_homepage',
      'settings' => 'bluechip_section_4',
      'type'     => 'dropdown-pages'
    ) ) );

    $wp_customize->add_setting( 'bluechip_section_5', array (
      'sanitize_callback' => 'bluechip_sanitize_dropdown_pages',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bluechip_section_5', array(
      'label'    => __( 'Section 5', 'bluechip' ),
      'section'  => 'bluechip_homepage',
      'settings' => 'bluechip_section_5',
      'type'     => 'dropdown-pages'
    ) ) );
    
    /* color scheme option */
    $wp_customize->add_setting( 'bluechip_color_settings', array (
      'default' => '#1565c0',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bluechip_color_settings', array(
      'label'    => __( 'Primary Color Scheme', 'bluechip' ),
      'section'  => 'colors',
      'settings' => 'bluechip_color_settings',
    ) ) );

    $wp_customize->add_setting( 'bluechip_footer_bg', array (
      'default' => '#191919',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bluechip_footer_bg', array(
      'label'    => __( 'Footer Background', 'bluechip' ),
      'section'  => 'colors',
      'settings' => 'bluechip_footer_bg',
    ) ) );
  
  }
endif;
add_action('customize_register', 'bluechip_theme_customizer');


/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'bluechip_sanitize_checkbox' ) ) :
  function bluechip_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
      return 1;
    } else {
      return '';
    }
  }
endif;

/**
 * Sanitize text field html
 */
if ( ! function_exists( 'bluechip_sanitize_field_html' ) ) :
  function bluechip_sanitize_field_html( $str ) {
    $allowed_html = array(
    'a' => array(
    'href' => array(),
    ),
    'br' => array(),
    'span' => array(),
    );
    $str = wp_kses( $str, $allowed_html );
    return $str;
  }
endif;

if ( ! function_exists( 'bluechip_sanitize_dropdown_pages' ) ) :
  function bluechip_sanitize_dropdown_pages( $page_id, $setting ) {
    // Ensure $input is an absolute integer.
    $page_id = absint( $page_id );

    // If $page_id is an ID of a published page, return it; otherwise, return the default.
    return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
  }
endif;