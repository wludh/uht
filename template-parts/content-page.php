<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uht
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if( get_field('story_link')): ?>
		<div class="row">
		<div class="col-12">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="<?php esc_url(the_field('story_link')); ?>" allowfullscreen></iframe>
			</div>
		</div>
	</div>
			<?php if( get_field('story_copyright')): ?>
	      <p class="cc">
	        <?php esc_html(the_field('story_copyright')); ?>
	      </p>
	    <?php endif; ?>
			<?php if( get_field('story_transcript')): ?>
	      <details><!--Requires HTML5. Would it be better to use JavaScript?-->
	        <summary class="cc">Click to view transcript</summary>
	        <p class="card-text"><?php esc_html(the_field('story_transcript')); ?></p>
	      </details>
	    <?php endif;
		endif;



			the_content();

			the_post_navigation( array(
				'prev_text' =>  '%title',
				'next_text' => '%title',
				'in_same_term' => true,
			));
		?>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'uht' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
