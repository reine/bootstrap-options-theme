<?php
/**
 * The template for displaying the 'Freelancer' alternate header.
 *
 * @package WordPress
 * @subpackage Bootstrap Options Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', false, 'right' ); echo get_bloginfo('name'); ?></title>
    <?php
        wp_head();
        if (of_get_option('design_layout_select') == "2") { custom_freelancer_fonts(); }
    ?>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</head>

<body <?php body_class('index'); ?> id="page-top">

    <?php if ( of_get_option('ga_code_text') != '' ): ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', '<?php echo of_get_option("ga_code_text"); ?>', '<?php echo $_SERVER["HTTP_HOST"]; ?>');
      ga('send', 'pageview');
    </script>
    <?php endif; ?>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="freelancer-navbar">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#freelancer-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <?php
                // Display logo if a file have been uploaded
                if ( of_get_option('site_logo_uploader') ) : ?>
                    <div id="freelancer-logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo of_get_option('site_logo_uploader'); ?>" class="img-responsive" />
                        </a>
                    </div>
                <?php else: ?>
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php echo get_bloginfo('name'); ?>
                    </a>
                <?php endif; ?>

            </div><!-- .navbar-header -->

            <?php
            	wp_nav_menu(array(
					'menu'              => 'alternate-menu',
	                'theme_location'    => 'secondary',
	                'depth'             => 2,
	                'container'         => 'div',
	                'container_class'   => 'collapse navbar-collapse',
	        		'container_id'      => 'freelancer-navbar-collapse-1',
	                'menu_class'        => 'nav navbar-nav navbar-right',
	                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                'walker'            => new wp_bootstrap_navwalker()
	                )
				);
			?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
