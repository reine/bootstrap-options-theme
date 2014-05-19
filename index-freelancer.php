<?php
/**
 * The main template file for Freelancer.
 *
 * @package WordPress
 * @subpackage Bootstrap Options Theme
 */

get_header(); ?>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if ( of_get_option('frontpage_content_editor_media') ) :
                        echo of_get_option('frontpage_content_editor_media', '');
                    else:
                    ?>
                    <img class="img-responsive" src="<?php echo get_template_directory_uri().'/assets/'; ?>img/profile.png" alt="">
                    <div class="intro-text">
                        <span class="name">Start Bootstrap</span>
                        <hr class="star-light">
                        <span class="skills">Web Developer - Graphic Artist - User Experience Designer</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Portfolio</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">

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

            </div>
        </div>
    </section>

    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo do_shortcode('[content name="about"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    &nbsp;
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>