<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uht
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
	<header class="page-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="page-header">', '</h1>' );
		else :
			the_title( '<h2 class="page-header"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'uht' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			$categories = get_the_category();
			foreach( $categories as $category ):
				$parents = get_category_parents($category->cat_ID, false, ",");
				$parent = "/" . $parents . "/";

				$stories = preg_match( '/Stories/', $parent);
				$questions = preg_match( '/Questions/', $parent);

				/*if ( $stories == 1):
					echo 'category is stories';
				endif;*/

				if ( $questions == 1):
					$cat_ID = $category->cat_ID;
					

				endif;
			endforeach;?>


	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->