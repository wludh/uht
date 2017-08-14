<?php
/**
 * Template Name: DB Entry Synthesis
 * Template Post Type: database_entry
 *
 * This is the template that displays full width page without sidebar
 *
 * @package uht
 */

get_header(); ?>

  <div id="primary" class="container">

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'synthesis' ); ?>

		<?php
		  // If comments are open or we have at least one comment, load up the comment template
		if ( get_theme_mod( 'activello_page_comments', 1 ) == 1 ) :
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		  endif;
		?>

		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->

  </div><!-- #primary -->

<?php get_footer(); ?>
