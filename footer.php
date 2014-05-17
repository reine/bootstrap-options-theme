<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Bootstrap Options Theme
 */

	// Display correct footer template based on selected design & layout
	if (of_get_option('design_layout_select') == "2"):

	    get_template_part( 'footer', 'freelancer' );

	elseif (of_get_option('design_layout_select') == "3"):

	    get_template_part( 'footer', 'modern-business' );

	else:

		// Default index (Bare)

	endif;

	wp_footer(); ?>

</body>
</html>