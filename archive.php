<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uht
 */

get_header(); ?>

	<div id="primary" class="container">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header>
				<div class="container text-center">
					<div class="d-inline-flex">
						<?php
						single_term_title( '<h1 class="page-title display-4 embellish">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</div>
				</div>
			</header><!-- .page-header -->

			<div class="card-columns">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();


				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );


				endwhile;

		 	/*the_posts_navigation();*/?>
	 		</div>

		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
		<br>
	</div><!-- #primary -->
	<br>

<?php
get_sidebar();
get_footer();
