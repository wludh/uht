<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package uht
 */

get_header(); ?>

	<div id="primary" class="container">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			/*$categories = get_the_category();
			foreach( $categories as $category ):
				$parents = get_category_parents($category->cat_ID, false, ",");
				$parent = "/" . $parents . "/";

				$stories = preg_match( '/Stories/', $parent);
				$questions = preg_match( '/Questions/', $parent);

				$cat_IDs = array();
				$cat_IDs[] = $category->cat_ID;

				if ( $questions == 1):
					$qvar = 1;
				endif;

			endforeach;

			if ( $qvar == 1):
				$post_ID = get_the_ID();
				$next_ID = next_page_ID($post_ID);
				$prev_ID = previous_page_ID($post_ID);
				$next_cat = get_the_category($next_ID);
				$prev_cat = get_the_category($prev_ID);
				var_dump($prev_cat);
				foreach( $next_cat as $q):
					$next_cat_ID = array();
					$next_cat_ID[] = $q->cat_ID;
				endforeach;
				foreach( $prev_cat as $p):
					$prev_cat_ID = array();
					$prev_cat_ID[] = $p->cat_ID;
				endforeach;
				var_dump($prev_cat_ID);
				$final_cat = array_intersect($cat_IDs, $next_cat_ID, $prev_cat_ID);

				?>
				get_category_link($final_cat[0]);
			endif;*/

			the_post_navigation( array(
				'prev_text' =>  '%title',
				'next_text' => '%title',
				'in_same_term' => true,
			));

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		tag_buttons();
		?>
		</main><!-- #main -->
		<br>
		<div class="container">
			<?php dynamic_content();?>
		</div>
		<br>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
