<?php
/**
 * The theme option name is set as 'bootstrap-options-theme' here.
 * In your own project, you should use a different option name.
 * I'd recommend using the name of your theme.
 *
 * This option name will be used later when we set up the options
 * for the front end theme customizer.
 */

function optionsframework_option_name() {

	$optionsframework_settings = get_option('optionsframework');
	
	// Edit 'bootstrap-options_theme' and set your own theme name instead
	$optionsframework_settings['id'] = 'bootstrap_options_theme';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		"First" => "First Option",
		"Second" => "Second Option",
		"Third" => "Third Option" );

	$options = array();

	$options[] = array( "name" => "General Settings",
		"type" => "heading" );

	/* Logo */
	$options['site_logo_uploader'] = array(
		"name" => "Site Logo",
		"desc" => "Upload an image and preview it.",
		"id" => "site_logo_uploader",
		"type" => "upload" );

	/* Google Analytics */
	$options['google_analytics_checkbox'] = array(
		"name" => "Track web pages",
		"id" => "google_analytics_checkbox",
		"std" => "0", // 0 = no; 1 = yes
		"type" => "checkbox" );

	$options['ga_code_text'] = array(
		"name" => "Google Analytics Code",
		"id" => "ga_code_text",
		"std" => "", // e.g. UA-8442083-5
		"class" => "mini",
		"type" => "text" );

	// Test settings
	$options[] = array( "name" => "Example Settings",
		"type" => "heading" );

	$options['example_text'] = array(
		"name" => "Text",
		"id" => "example_text",
		"std" => "Default Value",
		"type" => "text" );

	$options['example_select'] = array(
		"name" => "Select Box",
		"id" => "example_select",
		"std" => "First",
		"type" => "select",
		"options" => $test_array );

	$options['example_radio'] = array(
		"name" => "Radio Buttons",
		"id" => "example_radio",
		"std" => "Third",
		"type" => "radio",
		"options" => $test_array );

	$options['example_checkbox'] = array(
		"name" => "Input Checkbox",
		"desc" => "This is a work in progress.  There is are some issues with how the front end customizer saves checkbox options, and how the Options Framework does.  Bear with me a bit while I work on a solution.",
		"id" => "example_checkbox",
		"std" => "1",
		"type" => "checkbox" );
		
	$options['example_colorpicker'] = array(
		"name" => "Colorpicker",
		"id" => "example_colorpicker",
		"std" => "#666666",
		"type" => "color" );

	return $options;
}

/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 */

add_action( 'customize_register', 'bootstrap_options_theme_register' );

function bootstrap_options_theme_register($wp_customize) {

	/**
	 * This is optional, but if you want to reuse some of the defaults
	 * or values you already have built in the options panel, you
	 * can load them into $options for easy reference
	 */
	 
	$options = optionsframework_options();
	
	/* General Settings (Basic) */

	$wp_customize->add_section( 'bootstrap_options_theme_basic', array(
		'title' => __( 'General Settings', 'bootstrap_options_theme' ),
		'priority' => 100
	) );
	
		/* Logo */
		$wp_customize->add_setting( 'bootstrap_options_theme[site_logo_uploader]', array(
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo_uploader', array(
			'label' => $options['site_logo_uploader']['name'],
			'section' => 'bootstrap_options_theme_basic',
			'settings' => 'bootstrap_options_theme[site_logo_uploader]',
			'priority' => 1
		) ) );

		/* Google Analytics */
		$wp_customize->add_setting( 'bootstrap_options_theme[google_analytics_checkbox]', array(
			'default' => $options['google_analytics_checkbox']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_google_analytics_checkbox', array(
			'label' => $options['google_analytics_checkbox']['name'],
			'section' => 'bootstrap_options_theme_basic',
			'settings' => 'bootstrap_options_theme[google_analytics_checkbox]',
			'type' => $options['google_analytics_checkbox']['type']
		) );

		$wp_customize->add_setting( 'bootstrap_options_theme[ga_code_text]', array(
			'default' => $options['ga_code_text']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_ga_code_text', array(
			'label' => $options['ga_code_text']['name'],
			'section' => 'bootstrap_options_theme_basic',
			'settings' => 'bootstrap_options_theme[ga_code_text]',
			'type' => $options['ga_code_text']['type']
		) );
	
	/* Extended */

	$wp_customize->add_section( 'bootstrap_options_theme_extended', array(
		'title' => __( 'Example Settings', 'bootstrap_options_theme' ),
		'priority' => 110
	) );

		$wp_customize->add_setting( 'bootstrap_options_theme[example_text]', array(
			'default' => $options['example_text']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_example_text', array(
			'label' => $options['example_text']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[example_text]',
			'type' => $options['example_text']['type']
		) );
		
		$wp_customize->add_setting( 'bootstrap_options_theme[example_select]', array(
			'default' => $options['example_select']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_example_select', array(
			'label' => $options['example_select']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[example_select]',
			'type' => $options['example_select']['type'],
			'choices' => $options['example_select']['options']
		) );
	
		$wp_customize->add_setting( 'bootstrap_options_theme[example_radio]', array(
			'default' => $options['example_radio']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_example_radio', array(
			'label' => $options['example_radio']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[example_radio]',
			'type' => $options['example_radio']['type'],
			'choices' => $options['example_radio']['options']
		) );
		
		$wp_customize->add_setting( 'bootstrap_options_theme[example_checkbox]', array(
			'default' => $options['example_checkbox']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_example_checkbox', array(
			'label' => $options['example_checkbox']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[example_checkbox]',
			'type' => $options['example_checkbox']['type']
		) );
	
		$wp_customize->add_setting( 'bootstrap_options_theme[example_colorpicker]', array(
			'default' => $options['example_colorpicker']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'   => $options['example_colorpicker']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings'   => 'bootstrap_options_theme[example_colorpicker]'
		) ) );
}