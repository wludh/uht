<?php
/**
 * Template Name: DB Entry Link
 * Template Post Type: database_entry
 *
 * This is the template that displays database link entries.
 *
 * @package uht
 */

get_header(); ?>

  <div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'link' ); ?>

		<?php
		  // If comments are open or we have at least one comment, load up the comment template. I think we can delete this section, but am not doing so yet.
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
