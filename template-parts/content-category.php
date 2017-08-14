<?php
/**
 * Template part for displaying results in archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uht
 */

?>

<div class="col-sm-4">
<div class="card">
	<div class="card-block">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_title( sprintf( '<h4 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

	</header><!-- .entry-header -->

	<div class="card-text">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<div class="card-text text-muted">
		<?php the_tags(""); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
</div>
</div>
</div>
