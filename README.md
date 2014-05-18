Bootstrap Options Theme
=======================

####Options Framework Theme with Bootstrap 3.0+ for WordPress

A skeleton front-end template that allows a developer to build a WordPress theme with options. It harnesses the power of Bootstrap to easily create a responsive and mobile-friendly theme in less time.

##Features

Herewith is a list of features:

* [Options Framework + Theme Customizer v1.6](http://wptheming.com/2012/07/options-framework-theme-customizer/)
* [Bootstrap v3.1.1](http://getbootstrap.com)
* [Font Awesome v4.0.3](http://fortawesome.github.io/Font-Awesome/)
* [WP Bootstrap Nav Walker](https://github.com/twittem/wp-bootstrap-navwalker) class
* **Basic Options in the Theme Panel**
	* Site Logo Uploader
	* Design & Layout Selector
	* Google Analytics Code
	* Social Network Services URL Settings
	* Site Color Settings
* **Advanced Options**
	* Frontpage Custom Content
	* Portfolio (custom post type and shortcode)
* *Other features to be added as needed*

###Site Logo###

The theme allows uploading of logo. If there is no image (default setting), the blog name is shown. Recommended maximum height of image is 80px and should be in transparent PNG format to enable the background color to show through.

Or, you can set it to any size you want so that it'll fit in your design. Just add the following codes in your theme:

	<?php
	// Display logo if a file have been uploaded
	if ( of_get_option('site_logo_uploader') ) : ?>
		<div id="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo of_get_option('site_logo_uploader'); ?>" class="img-responsive" />
			</a>
		</div>
	<?php else: ?>
		<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php echo get_bloginfo('name'); ?>
		</a>
	<?php endif; ?>

###Design & Layout###

From the [Start Bootstrap](http://startbootstrap.com/) website, three layouts were selected as starter design & layout for this theme. They are as follows:

* [Bare](http://startbootstrap.com/bare) (default)
* [Freelancer](http://startbootstrap.com/freelancer)
* [Modern Business](http://startbootstrap.com/modern-business)

If you have your own design, use **Bare** as your skeleton and customize it. If you want a one-page website, use **Freelancer** instead. If it's a multi-purpose full website that you want, then use **Modern Business**.

All styling overrides can be added inside the **style.css** file.

###Google Analytics Code###

If this option is not blank, the code will be added in the header of the theme. You will need a third-party WordPress plugin to display the analytics inside your dashboard - I recommend [Google Analytics Dashboard for WP](https://wordpress.org/plugins/google-analytics-dashboard-for-wp/).

If you use the abovementioned plugin, make sure to disable addition of tracking code so that it will use the one provided by the theme.

###Social Network Services###

The theme provides for the addition of links to various popular social network services, such as:

* Facebook
* Twitter
* LinkedIn
* Google+

If their option fields are not blank, the icon and corresponding links will be visible in the frontend.

Your favorite social network not on the list? Don't fret, you can easily add the codes for it - just replace **new_sns** with your own variable.

	$options['new_sns_url_text'] = array(
		"name" => "Your New SNS URL",
		"id" => "new_sns_url_text",
		"desc" => "If blank, icon and link will not be visible.",
		"std" => "", // e.g., https://yournewsns.com/
		"type" => "text" );

Example:

	$options['youtube_url_text'] = array(
		"name" => "YouTube URL",
		"id" => "youtube_url_text",
		"desc" => "If blank, icon and link will not be visible.",
		"std" => "", // e.g., https://youtube.com/
		"type" => "text" );

If you want the new option field to be visible in the frontend customizer as well, these are the codes that you will need:

	$wp_customize->add_setting( 'bootstrap_options_theme[new_sns_url_text]', array(
			'default' => $options['new_sns_url_text']['std'],
			'type' => 'option'
		) );

	$wp_customize->add_control( 'bootstrap_options_theme_new_sns_url_text', array(
			'label' => $options['new_sns_url_text']['name'],
			'section' => 'bootstrap_options_theme_extended',
			'settings' => 'bootstrap_options_theme[new_sns_url_text]',
			'type' => $options['new_sns_url_text']['type']
		) );

Only the **Freelancer** layout have implemented the social media icons & links in the frontend because this feature is included in the said template.

###Site Colors###

The theme samples a color picker option for the top navigation background. You can add as many color options as you need, depending on your design or depending on how much customization you want your client can manage without knowing a single code.

Sample code for the theme options panel:

	$options['topnav_background_colorpicker'] = array(
		"name" => "Top Navigation Background",
		"id" => "topnav_background_colorpicker",
		"std" => "#222222",
		"type" => "color" );

Sample code for the frontend customizer:

	$wp_customize->add_setting( 'bootstrap_options_theme[topnav_background_colorpicker]', array(
			'default' => $options['topnav_background_colorpicker']['std'],
			'type' => 'option'
		) );
		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnav_background_color', array(
			'label'   => $options['topnav_background_colorpicker']['name'],
			'section' => 'bootstrap_options_theme_custom',
			'settings'   => 'bootstrap_options_theme[topnav_background_colorpicker]'
		) ) );
		
###Portfolio (Custom Post Type and Shortcode)###

The theme samples a portfolio custom post type and shortcode because both the Freelance and Modern Business layouts support this feature.

If you will you the Bare layout to create your own, use the following shortcode in your post/page views:

	<?php echo do_shortcode('[portfolio items="x"]{content}[/portfolio]'); ?>

where **x** denotes the number of portfolio items to display and **content** is how you want the output parameters displayed on the page.

Sample usage:

	<?php
	$portfolio_output = '[portfolio items="6"]
		<div class="col-sm-4 portfolio-item">
			<a href="{PERMALINK}" class="portfolio-link">
				<div class="caption">
					<div class="caption-content">
						<i class="fa fa-search fa-3x"></i>
					</div>
				</div>
				{THUMBNAIL}
			</a>
		</div>
	[/portfolio]';
	echo do_shortcode($portfolio_output); ?>

Currently, the shortcode output only displays the link and the thumbnail image. If you want to add other information, edit the raw output inside the **functions.php** file.

Sample code:

	// Prepare required output
	$parameters = array(
		'PERMALINK' => get_permalink(),
		'THUMBNAIL' => get_the_post_thumbnail( $post_id, 'large', array('class'=>'img-responsive img-home-portfolio') )
	);

You can add these other parameters as you need it:

	'TITLE'			=> get_the_title(),
    'CONTENT'		=> get_the_content(),
    'CATEGORIES'	=> get_the_category_list(', '),
    'EXCERPT'		=> get_the_excerpt(),

##Setup & Installation

###System Requirements

The theme is tested on WordPress v3.9. Minimum version requirement is v3.4.

###Installation Instructions

Install the theme:

* via Git
* via downloaded ZIP file

####Git Install

Start by cloning the project from its git repository, as such:

`git clone https://github.com/reine/bootstrap-options-theme.git`

Make sure to clone it inside the **wp-content/themes** directory.

####ZIP Install

Download the [latest copy](https://github.com/reine/bootstrap-options-theme/archive/master.zip) and install the theme inside WordPress.

##Screenshots##

*General Settings*
![screenshot - general settings](/assets/screens/screenshot-panel-general-settings.png?raw=true)

*Social Network Services*
![screenshot - social network services](/assets/screens/screenshot-panel-sns.png?raw=true)

*Bare Design & Layout in Theme Customizer*
![screenshot - bare layout](/assets/screens/screenshot-panel-bare-layout.png?raw=true)

*Freelancer Design & Layout in Theme Customizer*
![screenshot - freelancer layout](/assets/screens/screenshot-panel-freelancer-layout.png?raw=true)

*Modern Business Design & Layout in Theme Customizer*
![screenshot - modern business layout](/assets/screens/screenshot-panel-modern-business-layout.png?raw=true)

*Site Color Settings in Theme Customizer*
![screenshot - site colors](/assets/screens/screenshot-panel-color-settings.png?raw=true)

*Site Logo Settings in Theme Customizer*
![screenshot - site logo](/assets/screens/screenshot-panel-logo-settings.png?raw=true)

##Support

This is a work in progress - use at your own risk.

If you find any bugs, please report them at the [Issues](https://github.com/reine/bootstrap-options-theme/issues) section of the project repository. Do note that I may not always reply to them as needed because I also work on my client projects.

**Important:** This theme is intended for developers use. If you are an end-user, please give a copy to your developer and let him/her customize it for you (unless you're a developer yourself too). I would just like to prevent support questions that asks me why the theme didn't work in their live WordPress sites.

##Copyright & License

Bootstrap Options Theme is released under GPL v2. Wherever a third-party code is used, owner of the said code retains his/her own copyright & license. As much as possible, we will only use open source codes.
