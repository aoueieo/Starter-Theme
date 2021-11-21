<?php
/**
 * AWD Digital Theme Customizer
 *
 * @package AWD_Digital
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function awd_digital_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'awd_digital_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'awd_digital_customize_partial_blogdescription',
			)
		);
	}


	// Theme layout settings.
	$wp_customize->add_section(
		'awd_theme_layout_options',
		array(
			'title'       => __( 'Theme Layout Settings', 'awd-digital' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width defaults', 'awd-digital' ),
		)
	);

	$wp_customize->add_setting(
		'awd_container_type',
		array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'awd_container_type',
			array(
				'label'       => __( 'Container Width', 'awd-digital' ),
				'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'awd-digital' ),
				'section'     => 'awd_theme_layout_options',
				'settings'    => 'awd_container_type',
				'type'        => 'select',
				'choices'     => array(
					'container'       => __( 'Fixed width container', 'awd-digital' ),
					'container-fluid' => __( 'Full width container', 'awd-digital' ),
				),				
			)
		)
	);
}

add_action( 'customize_register', 'awd_digital_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function awd_digital_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function awd_digital_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function awd_digital_customize_preview_js() {
	wp_enqueue_script( 'awd-digital-customizer', get_template_directory_uri() . '/inc/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'awd_digital_customize_preview_js' );
