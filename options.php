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

	// Design & Layout data
	$design_layout_array = array(
		"1" => "Bare",
		"2" => "Freelancer",
		"3" => "Modern Business" );

	$options = array();

	$options[] = array( "name" => "General Settings", "type" => "heading" );

	/* Logo */
	$options['site_logo_uploader'] = array(
		"name" => "Site Logo",
		"desc" => "Upload an image and preview it. Preferred format is transparent PNG to allow background color to show.",
		"id" => "site_logo_uploader",
		"type" => "upload" );

	/* Design & Layout */
	$options['design_layout_select'] = array(
		"name" => "Design & Layout",
		"id" => "design_layout_select",
		"std" => "1",
		"class" => "mini",
		"type" => "select",
		"options" => $design_layout_array );

	/* Google Analytics */
	$options['ga_code_text'] = array(
		"name" => "Google Analytics Code",
		"id" => "ga_code_text",
		"desc" => "If blank, web analytics will not be enabled.",
		"std" => "", // e.g. UA-8442083-5
		"class" => "mini",
		"type" => "text" );

	/* Copyright */
	$options['copyright_text'] = array(
		"name" => "Copyright",
		"id" => "copyright_text",
		"desc" => "If blank, copyright text will not be visible.",
		"std" => "",
		"type" => "text" );

	$options[] = array( "name" => "Social Network Services", "type" => "heading" );

	/* Facebook, Twitter, Google+ URL Text Boxes */
	$options['facebook_url_text'] = array(
		"name" => "Facebook URL",
		"id" => "facebook_url_text",
		"desc" => "If blank, icon and link will not be visible.",
		"std" => "", // e.g., https://www.facebook.com/
		"type" => "text" );

	$options['twitter_url_text'] = array(
		"name" => "Twitter URL",
		"id" => "twitter_url_text",
		"desc" => "If blank, icon and link will not be visible.",
		"std" => "", // e.g., https://twitter.com/
		"type" => "text" );

	$options['linkedin_url_text'] = array(
		"name" => "LinkedIn URL",
		"id" => "linkedin_url_text",
		"desc" => "If blank, icon and link will not be visible.",
		"std" => "", // e.g., https://www.linkedin.com/in/
		"type" => "text" );

	$options['google_plus_url_text'] = array(
		"name" => "Google+ URL",
		"id" => "google_plus_url_text",
		"desc" => "If blank, icon and link will not be visible.",
		"std" => "", // e.g., https://plus.google.com/
		"type" => "text" );
	
	$options[] = array( "name" => "Site Colors", "type" => "heading" );

	// Site Colors		
	$options['topnav_background_colorpicker'] = array(
		"name" => "Top Navigation Background",
		"id" => "topnav_background_colorpicker",
		"std" => "#222222",
		"type" => "color" );

	$options['topnav_link_colorpicker'] = array(
		"name" => "Top Navigation Link",
		"id" => "topnav_link_colorpicker",
		"std" => "#999999",
		"type" => "color" );

	$options['topnav_link_hover_colorpicker'] = array(
		"name" => "Top Navigation Link (Hover)",
		"id" => "topnav_link_hover_colorpicker",
		"std" => "#FFFFFF",
		"type" => "color" );

	$options['header_background_colorpicker'] = array(
		"name" => "Header Background",
		"id" => "header_background_colorpicker",
		"std" => "#18bc9c",
		"type" => "color" );

	return $options;
}

/**
 * Front End Customizer
 *
 * Minimum Requirement: WordPress 3.4
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

		/* Design & Layout */
		$wp_customize->add_setting( 'bootstrap_options_theme[design_layout_select]', array(
			'default' => $options['design_layout_select']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_design_layout_select', array(
			'label' => $options['design_layout_select']['name'],
			'section' => 'bootstrap_options_theme_basic',
			'settings' => 'bootstrap_options_theme[design_layout_select]',
			'type' => $options['design_layout_select']['type'],
			'choices' => $options['design_layout_select']['options']
		) );

		/* Google Analytics */
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

		/* Copyright */
		$wp_customize->add_setting( 'bootstrap_options_theme[copyright_text]', array(
			'default' => $options['copyright_text']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_copyright_text', array(
			'label' => $options['copyright_text']['name'],
			'section' => 'bootstrap_options_theme_basic',
			'settings' => 'bootstrap_options_theme[copyright_text]',
			'type' => $options['copyright_text']['type']
		) );

	/* Social Network Services (Extended) */

	$wp_customize->add_section( 'bootstrap_options_theme_extended', array(
		'title' => __( 'Social Network Services', 'bootstrap_options_theme' ),
		'priority' => 110
	) );

		$wp_customize->add_setting( 'bootstrap_options_theme[facebook_url_text]', array(
			'default' => $options['facebook_url_text']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_facebook_url_text', array(
			'label' => $options['facebook_url_text']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[facebook_url_text]',
			'type' => $options['facebook_url_text']['type'],
			'priority' => 1
		) );

		$wp_customize->add_setting( 'bootstrap_options_theme[twitter_url_text]', array(
			'default' => $options['twitter_url_text']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_twitter_url_text', array(
			'label' => $options['twitter_url_text']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[twitter_url_text]',
			'type' => $options['twitter_url_text']['type'],
			'priority' => 2
		) );

		$wp_customize->add_setting( 'bootstrap_options_theme[linkedin_url_text]', array(
			'default' => $options['linkedin_url_text']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_linkedin_url_text', array(
			'label' => $options['linkedin_url_text']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[linkedin_url_text]',
			'type' => $options['linkedin_url_text']['type'],
			'priority' => 3
		) );

		$wp_customize->add_setting( 'bootstrap_options_theme[google_plus_url_text]', array(
			'default' => $options['google_plus_url_text']['std'],
			'type' => 'option'
		) );

		$wp_customize->add_control( 'bootstrap_options_theme_google_plus_url_text', array(
			'label' => $options['google_plus_url_text']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[google_plus_url_text]',
			'type' => $options['google_plus_url_text']['type']
		) );
	
	/* Site Colors (Custom) */

	$wp_customize->add_section( 'bootstrap_options_theme_custom', array(
		'title' => __( 'Site Colors', 'bootstrap_options_theme' ),
		'priority' => 115
	) );
	
		$wp_customize->add_setting( 'bootstrap_options_theme[topnav_background_colorpicker]', array(
			'default' => $options['topnav_background_colorpicker']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnav_background_color', array(
			'label'   => $options['topnav_background_colorpicker']['name'],
			'section' => 'bootstrap_options_theme_custom',
			'settings'   => 'bootstrap_options_theme[topnav_background_colorpicker]'
		) ) );

		$wp_customize->add_setting( 'bootstrap_options_theme[topnav_link_colorpicker]', array(
			'default' => $options['topnav_link_colorpicker']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnav_link_color', array(
			'label'   => $options['topnav_link_colorpicker']['name'],
			'section' => 'bootstrap_options_theme_custom',
			'settings'   => 'bootstrap_options_theme[topnav_link_colorpicker]'
		) ) );

		$wp_customize->add_setting( 'bootstrap_options_theme[topnav_link_hover_colorpicker]', array(
			'default' => $options['topnav_link_hover_colorpicker']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnav_link_hover_color', array(
			'label'   => $options['topnav_link_hover_colorpicker']['name'],
			'section' => 'bootstrap_options_theme_custom',
			'settings'   => 'bootstrap_options_theme[topnav_link_hover_colorpicker]'
		) ) );

		$wp_customize->add_setting( 'bootstrap_options_theme[header_background_colorpicker]', array(
			'default' => $options['header_background_colorpicker']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
			'label'   => $options['header_background_colorpicker']['name'],
			'section' => 'bootstrap_options_theme_custom',
			'settings'   => 'bootstrap_options_theme[header_background_colorpicker]'
		) ) );

}