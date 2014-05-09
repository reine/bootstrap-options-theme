<?php

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
require_once dirname( __FILE__ ) . '/options.php';

// Register Custom Navigation Walker
require_once dirname( __FILE__ ) . '/inc/wp_bootstrap_navwalker.php';

add_action( 'after_setup_theme', 'bootstrap_options_theme_setup' );
    if ( ! function_exists( 'bootstrap_options_theme_setup' ) ):
        function bootstrap_options_theme_setup() {  
            register_nav_menu( 'primary', __( 'Primary Navigation', 'bootstrap_options_theme' ) );
        } endif;

/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 */

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = false) {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( isset($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

/**
 * Enqueue scripts and styles for the front end.
 * 
 */
function bootstrap_options_theme_scripts() {

	// Path to additional stylesheets and scripts
    $bootstrap_css_path 	= get_template_directory_uri() . '/assets/css/bootstrap.min.css';
    $bootstrap_js_path  	= get_template_directory_uri() . '/assets/js/bootstrap.min.js';
    $fontawesome_css_path	= get_template_directory_uri() . '/assets/css/font-awesome.min.css';

	// Load the stylesheets and scripts
	wp_enqueue_style( 'bootstrap-css', $bootstrap_css_path );
	wp_enqueue_style( 'font-awesome-css', $fontawesome_css_path );
	wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script( 'bootstrap-js', $bootstrap_js_path, array('jquery') , '3.1.1', false );
	
}
add_action( 'wp_enqueue_scripts', 'bootstrap_options_theme_scripts' );
