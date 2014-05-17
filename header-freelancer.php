<?php
/**
 * The template for displaying the 'Freelancer' header.
 *
 * @package WordPress
 * @subpackage Bootstrap Options Theme
 */
?>

    <nav class="navbar navbar-default navbar-fixed-top" id="freelancer-navbar">
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
					'menu'              => 'main-menu',
	                'theme_location'    => 'primary',
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
