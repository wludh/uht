<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package uht
 */

get_header(); ?>

	<section id="primary" class="container">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'uht' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->
			<?php
			$i = 0;
			/* Start the Loop */?>
			<!--<div class="row">-->
			<?php while ( have_posts() ) : the_post();

			if($i % 4 == 0) {?>
				<!--<div class="row">-->
					<div class="card-deck">
			<?php
		}

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );?>
<?php
				$i++;
				if($i != 0 && $i % 4 == 0) { ?>
        </div><!--/.row-->
        <div class="clearfix"></div>

			<?php
				}

		endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
	</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
