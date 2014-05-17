<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Bootstrap Options Theme
 */

get_header();

      // Display correct index template based on selected design & layout
      if (of_get_option('design_layout_select') == "2"):

            get_template_part( 'index', 'freelancer' );

      elseif (of_get_option('design_layout_select') == "3"):

            get_template_part( 'index', 'modern-business' );

      else:

      // Default index (Bare)
?>

      <div class="container" id="bare-row">
            <div class="row">
                  <div class="col-lg-12">
                        <h1>A better Bootstrap starter template.</h1>
                        <p>Complete with pre-defined file paths that you won't have to change!</p>
                  </div>
            </div>
      </div>
      <!-- /.container -->

<?php
      endif;

get_footer();
?>