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

if ( ! function_exists( 'bootstrap_options_theme_setup' ) ) {
    function bootstrap_options_theme_setup() {

        register_nav_menu( 'primary', __( 'Primary Navigation', 'bootstrap_options_theme' ) );

        // Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 672, 372, true );
		add_image_size( 'bootstrap-options-theme-full-width', 1038, 576, true );

    }
}
add_action( 'after_setup_theme', 'bootstrap_options_theme_setup' );

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
    $dynamic_css_path		= get_template_directory_uri() . '/assets/css/dynamic-css.php';

    $bootstrap_js_path  	= get_template_directory_uri() . '/assets/js/bootstrap.min.js';
    $freelancer_js_path		= get_template_directory_uri() . '/assets/js/freelancer.js';
    $mbusiness_js_path		= get_template_directory_uri() . '/assets/js/modern-business.js';

    $freelancer_addtl_jquery_easing_js_path 	= get_template_directory_uri() . '/assets/js/jquery.easing.min.js';
    $freelancer_addtl_classie_js_path 			= get_template_directory_uri() . '/assets/js/classie.js';
    $freelancer_addtl_cbpAnimatedHeader_js_path	= get_template_directory_uri() . '/assets/js/cbpAnimatedHeader.min.js';

    add_action( 'wp_head', 'add_dynamic_css' );

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

/**
 * Additional link references for fonts.
 * 
 */
if ( !function_exists( 'custom_freelancer_fonts' ) ) {
	function custom_freelancer_fonts() { ?>

	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

	<?php
	}
}

/**
 * Dynamic style overrides, based on site color options
 * 
 */
function add_dynamic_css() {

	// Define option variables
	$topnav_background_colorpicker 		= of_get_option('topnav_background_colorpicker');
	$topnav_link_colorpicker 			= of_get_option('topnav_link_colorpicker');
	$topnav_link_hover_colorpicker		= of_get_option('topnav_link_hover_colorpicker');
	$header_background_colorpicker 		= of_get_option('header_background_colorpicker');
	$footer_background_colorpicker 		= of_get_option('footer_background_colorpicker');
	$copyright_background_colorpicker 	= of_get_option('footer_copyright_background_colorpicker');
	$portfolio_caption_rgb_color		= hex2rgb($header_background_colorpicker);

	// Display correct styles & scripts based on selected design & layout
	if (of_get_option('design_layout_select') == "2"):
?>
	<style type="text/css">
		/* Freelancer */
		body {
			background-color: <?php echo $copyright_background_colorpicker; ?>
		}
		header {
			background: <?php echo $header_background_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-brand {
			color: <?php echo $topnav_link_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-brand:hover, #freelancer-navbar .navbar-brand:focus {
			color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-nav>li>a {
			color: <?php echo $topnav_link_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-nav>li>a:hover, #freelancer-navbar .navbar-nav>li>a:focus {
			color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-toggle .icon-bar {
			background-color: <?php echo $topnav_link_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-toggle {
			border-color: <?php echo $topnav_link_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-toggle:hover, #freelancer-navbar .navbar-toggle:focus {
			background-color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		#freelancer-navbar .navbar-nav>.active>a {
			background-color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		section.success {
			background: <?php echo $header_background_colorpicker; ?>;
		}
		hr.star-light:after {
			background-color: <?php echo $header_background_colorpicker; ?>;
		}
		hr.star-primary {
			border-color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		hr.star-primary:after {
			color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		.btn-outline:hover, .btn-outline:focus, .btn-outline:active, .btn-outline.active {
			color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		footer .footer-above {
			background-color: <?php echo $footer_background_colorpicker; ?>;
		}
		footer .footer-below {
			background-color: <?php echo $copyright_background_colorpicker; ?>;
		}
		#portfolio {
			background: <?php echo $copyright_background_colorpicker; ?>;
		}
		#portfolio hr.star-primary:after {
			background-color: <?php echo $copyright_background_colorpicker; ?>;
		}
		#portfolio .portfolio-item .portfolio-link .caption {
			background: rgba(<?php echo $portfolio_caption_rgb_color; ?>,.9);
		}
		section#single-portfolio-item {
			background: <?php echo $header_background_colorpicker; ?>;
			margin: 30px 0 0;
		}
		section#single-portfolio-item h2 {
			text-align: center;
		}
	</style>

	<?php elseif (of_get_option('design_layout_select') == "3"): ?>

	<style type="text/css">
		/* Modern Business */
		.navbar {
			background: <?php echo $topnav_background_colorpicker; ?> !important;
		}
		.navbar-inverse .navbar-nav>li>a {
			color: <?php echo $topnav_link_colorpicker; ?> !important;
		}
		.navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus {
			color: <?php echo $topnav_link_hover_colorpicker; ?> !important;
		}
		#modern-business-navbar .navbar-toggle .icon-bar {
			background-color: <?php echo $topnav_link_colorpicker; ?>;
		}
		#modern-business-navbar .navbar-toggle {
			border-color: <?php echo $topnav_link_colorpicker; ?>;
		}
		#modern-business-navbar .navbar-toggle:hover, #modern-business-navbar .navbar-toggle:focus {
			background-color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
	</style>

	<?php else: ?>

	<style type="text/css">
		.navbar {
			background: <?php echo $topnav_background_colorpicker; ?> !important;
		}
		.navbar-inverse .navbar-nav>li>a {
			color: <?php echo $topnav_link_colorpicker; ?> !important;
		}
		.navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus {
			color: <?php echo $topnav_link_hover_colorpicker; ?> !important;
		}
		.navbar-inverse .navbar-toggle .icon-bar {
			background-color: <?php echo $topnav_link_colorpicker; ?>;
		}
		.navbar-inverse .navbar-toggle {
			border-color: <?php echo $topnav_link_colorpicker; ?>;
		}
		.navbar-inverse .navbar-toggle:hover, .navbar-inverse .navbar-toggle:focus {
			background-color: <?php echo $topnav_link_hover_colorpicker; ?>;
		}
		header {
			background: <?php echo $header_background_colorpicker; ?>;
		}
	</style>

	<?php
	endif;
}

/**
 * Register Custom Post Type : PORTFOLIOS
 * 
 */
function portfolio_post_type() {

	$labels = array(
		'name'                => 'Portfolios',
		'singular_name'       => 'Portfolio',
		'menu_name'           => 'Portfolios',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Items',
		'view_item'           => 'View Item',
		'add_new_item'        => 'Add New Item',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Item',
		'update_item'         => 'Update Item',
		'search_items'        => 'Search Item',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'portfolio',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'portfolio',
		'description'         => 'Manage portfolio of clients and projects',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-images-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'portfolio',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'portfolio', $args );
	flush_rewrite_rules();

}

// Hook into the 'init' action
add_action( 'init', 'portfolio_post_type', 0 );

/**
 * Add Shortcode for Portfolio Items
 * (e.g., [portfolio items="3"]{content}[/portfolio] )
 * 
 * @param  array  $atts    	Attributes
 * @param  string $content 	Enclosed content
 * @return string          	Pre-formatted (escaped & encoded) output
 */
function portfolio_items_shortcode( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'items' => '3'
		), $atts )
	);

	// Code
	$output = '';
	$the_query = new WP_Query( array ( 'posts_per_page' => $items, 'post_type' => 'portfolio', 'post_status' => 'publish' ) );
	
	if ( $the_query->have_posts() ) :

		while ( $the_query->have_posts() ):
			$the_query->the_post();

			// Prepare required output
			$parameters = array(
	            'PERMALINK' => get_permalink(),
	            'THUMBNAIL' => get_the_post_thumbnail( $post_id, 'large', array('class'=>'img-responsive img-home-portfolio') )
	        );

	        $finds = $replaces = array();
	        foreach ($parameters as $find => $replace) {
	            $finds[] = '{' . $find . '}';
	            $replaces[] = $replace;
	        }
	        $output .= str_replace($finds, $replaces, $content);

		endwhile;

	else:

		$output = 'No portfolio items found.';

	endif;

	wp_reset_postdata();
	return $output;

}
add_shortcode( 'portfolio', 'portfolio_items_shortcode' );

/**
 * Convert Hex Color to RGB
 * By c.bavota (http://bavotasan.com)
 * 
 * @param  string $hex Color in hex format
 * @return string      RGB value separated by commas
 */
function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb);
}