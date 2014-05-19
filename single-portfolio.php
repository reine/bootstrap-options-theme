<?php
/**
 * The template for displaying a single portfolio
 *
 * @package WordPress
 * @subpackage Bootstrap Options Theme
 */

get_header(); ?>

        <section id="single-portfolio-item" class="success">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-8 col-lg-offset-2">

					<?php
					if ( have_posts() ) :

						while ( have_posts() ) :
							the_post(); ?>

				        	<h2><?php the_title(); ?></h2>
                            <hr class="star-light">

                            <?php the_post_thumbnail( 'large', array('class'=>'img-responsive img-centered') ); ?>
                            <div class="portfolio-description"><?php the_content(); ?></div>

				    <?php
				    	endwhile;

				    else:

				    	_e('Sorry, no posts matched your criteria.', "bootstrap-options-theme");

				    endif; ?>

    				</div>
    			</div><!-- .row -->
    		</div><!-- .container -->
    	</section><!-- #single-portfolio-item -->

<?php get_footer(); ?>