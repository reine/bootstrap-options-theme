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

	// Path to stylesheets and scripts
    $bootstrap_css_path 	= get_template_directory_uri() . '/assets/css/bootstrap.min.css';
    $fontawesome_css_path	= get_template_directory_uri() . '/assets/css/font-awesome.min.css';
    $freelancer_css_path	= get_template_directory_uri() . '/assets/css/freelancer.css';
    $mbusiness_css_path		= get_template_directory_uri() . '/assets/css/modern-business.css';

    $bootstrap_js_path  	= get_template_directory_uri() . '/assets/js/bootstrap.min.js';
    $freelancer_js_path		= get_template_directory_uri() . '/assets/js/freelancer.js';
    $mbusiness_js_path		= get_template_directory_uri() . '/assets/js/modern-business.js';

    $freelancer_addtl_jquery_easing_js_path 	= get_template_directory_uri() . '/assets/js/jquery.easing.min.js';
    $freelancer_addtl_classie_js_path 			= get_template_directory_uri() . '/assets/js/classie.js';
    $freelancer_addtl_cbpAnimatedHeader_js_path	= get_template_directory_uri() . '/assets/js/cbpAnimatedHeader.min.js';

	// Display correct styles & scripts based on selected design & layout
	if (of_get_option('design_layout_select') == "2"):

		// Freelancer
		wp_enqueue_style( 'bootstrap-css', $bootstrap_css_path );
		wp_enqueue_style( 'font-awesome-css', $fontawesome_css_path );
		wp_enqueue_style( 'freelancer-css', $freelancer_css_path );
		wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css' );
		wp_enqueue_script( 'bootstrap-js', $bootstrap_js_path, array('jquery') , '3.1.1', false );
		wp_enqueue_script( 'jquery_easing-js', $freelancer_addtl_jquery_easing_js_path );
		wp_enqueue_script( 'classie-js', $freelancer_addtl_classie_js_path );
		wp_enqueue_script( 'cbpAnimatedHeader-js', $freelancer_addtl_cbpAnimatedHeader_js_path );
		wp_enqueue_script( 'freelancer-js', $freelancer_js_path );

	elseif (of_get_option('design_layout_select') == "3"):

		// Modern Business
		wp_enqueue_style( 'bootstrap-css', $bootstrap_css_path );
		wp_enqueue_style( 'font-awesome-css', $fontawesome_css_path );
		wp_enqueue_style( 'modern-business-css', $mbusiness_css_path );
		wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css' );
		wp_enqueue_script( 'bootstrap-js', $bootstrap_js_path, array('jquery') , '3.1.1', false );
		wp_enqueue_script( 'modern-business-js', $mbusiness_js_path );
		
	else:

		// Default header (Bare)
		wp_enqueue_style( 'bootstrap-css', $bootstrap_css_path );
		wp_enqueue_style( 'font-awesome-css', $fontawesome_css_path );
		wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css' );
		wp_enqueue_script( 'bootstrap-js', $bootstrap_js_path, array('jquery') , '3.1.1', false );
	
	endif;
	
}
add_action( 'wp_enqueue_scripts', 'bootstrap_options_theme_scripts' );
