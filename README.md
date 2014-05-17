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
* Basic Options in the Theme Panel
	* Site Logo Uploader
	* Design & Layout Selector
	* Google Analytics Code
	* Social Network Services URL Settings
	* Site Color Settings
* *Other features to be added as needed*

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

##Support

This is a work in progress - use at your own risk.

If you find any bugs, please report them at the [Issues](https://github.com/reine/bootstrap-options-theme/issues) section of the project repository. Do note that I may not always reply to them as needed because I also work on my client projects.

**Important:** This theme is intended for developers use. If you are an end-user, please give a copy to your developer and let him/her customize it for you (unless you're a developer yourself too). I would just like to prevent support questions that asks me why the theme didn't work in their live WordPress sites.

##Copyright & License

Bootstrap Options Theme is released under GPL v2. Wherever a third-party code is used, owner of the said code retains his/her own copyright & license. As much as possible, we will only use open source codes.
