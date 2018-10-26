<?php
/**
 * Cocoberg Theme Customizer
 *
 * @package Cocoberg
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cocoberg_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'cocoberg_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'cocoberg_customize_partial_blogdescription',
		) );
	}

	/**
	 * Cocoberg Theme Layouts.
	 *
	 */
    require_once( trailingslashit( get_template_directory() ) . 'inc/customize/cocoberg-radio-image.php' );

    $wp_customize->register_control_type( 'Cocoberg_Customize_Control_Radio_Image' );

	$wp_customize->add_section( 'cocoberg_theme_layouts_section' , array(
        'title'    => __( 'Chocoberg Layouts', 'cocoberg' ),
        'priority' => 210,
    ) );   

    $wp_customize->add_setting( 'cocoberg_theme_layouts_settings' , array(
		'default'   => 'full-width',
        'transport' => 'refresh',
	) );

    $wp_customize->add_control( new Cocoberg_Customize_Control_Radio_Image( $wp_customize, 'cocoberg_layout', array(
		'label'			=> esc_html__( 'Cocoberg Layout', 'cocoberg' ),
		'description' 	=> esc_html__( 'Choose a layout for the blog posts.', 'cocoberg' ),
		'section'       => 'cocoberg_theme_layouts_section',
		'settings'      => 'cocoberg_theme_layouts_settings',
		'choices'		=> [
			'block' => [
				'label' => esc_html__( 'Block (Gutenberg)', 'cocoberg' ),
				'url'   => '%s/block.png'
			],
			'full-width' => [
				'label' => esc_html__( 'Full Width', 'cocoberg' ),
				'url'   => '%s/full-width.png'
			],
			'right-sidebar' => [
				'label' => esc_html__( 'Right Sidebar', 'cocoberg' ),
				'url'   => '%s/right-sidebar.png'
			],
			'left-sidebar' => [
				'label' => esc_html__( 'Left Sidebar', 'cocoberg' ),
				'url'   => '%s/left-sidebar.png'
			],
		]
    ) ) );

	/**
	 * Cocoberg Social Media Link.
	 *
	 */
	$wp_customize->add_section( 'cocoberg_social_link_section' , array(
        'title'    => __( 'Chocoberg Social Link', 'cocoberg' ),
        'priority' => 210,
    ) );  

	$wp_customize->add_setting( 'cocoberg_social_link_settings' , array(
		'default'   => '',
        'transport' => 'refresh',
    ) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cocoberg_facebook', array(
        'label'          => __( 'Facebook', 'cocoberg' ),
		'section'        => 'cocoberg_social_link_section',
		'settings'       => 'cocoberg_social_link_settings',
		'type'           => 'text',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cocoberg_twitter', array(
        'label'          => __( 'Twitter', 'cocoberg' ),
		'section'        => 'cocoberg_social_link_section',
		'settings'       => 'cocoberg_social_link_settings',
		'type'           => 'text',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cocoberg_instagram', array(
        'label'          => __( 'Instagram', 'cocoberg' ),
		'section'        => 'cocoberg_social_link_section',
		'settings'       => 'cocoberg_social_link_settings',
		'type'           => 'text',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cocoberg_github', array(
        'label'          => __( 'Github', 'cocoberg' ),
		'section'        => 'cocoberg_social_link_section',
		'settings'       => 'cocoberg_social_link_settings',
		'type'           => 'text',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cocoberg_youtube', array(
        'label'          => __( 'Youtube', 'cocoberg' ),
		'section'        => 'cocoberg_social_link_section',
		'settings'       => 'cocoberg_social_link_settings',
		'type'           => 'text',
	) ) );

}
add_action( 'customize_register', 'cocoberg_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cocoberg_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cocoberg_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cocoberg_customize_preview_js() {
	wp_enqueue_script( 'cocoberg-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cocoberg_customize_preview_js' );