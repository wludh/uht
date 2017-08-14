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

			<header class="text-center">
				<?php
					single_term_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$i = 0;
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			if($i % 3 == 0) {?>
				<!--<div class="card-deck">-->
					<div class="card-deck">
			<?php
		}

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );
								$i++;
								if($i != 0 && $i % 3 == 0):
									$open_div = 0;
									?>
				        	</div><!--/.card-deck-->
				        	<div class="clearfix"></div>
									<br>
								<?php
								else:
									$open_div = 1;
								endif;

			endwhile;

			if( $open_div == 1):?>
		</div><!--/.card-deck-->
		<div class="clearfix"></div>
		<br>
	<?php endif;

		 the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
		<br>
	</div><!-- #primary -->
	<br>

<?php
get_sidebar();
get_footer();
