<?php
/**
 * The template used for displaying page content in db image entries
 *
 * @package uht
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="card">
			<div class="card-block">
				<header class="text-center">
					<h1 class="card-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

					<?php

					$image = get_field('image');

					if( !empty($image) ):

			// vars
			$url = $image['url'];
			$title = $image['title'];
			$alt = $image['alt'];
			$caption = $image['caption'];

			// thumbnail
			$size = 'thumbnail';
			$thumb = $image['sizes'][ $size ];
			$width = $image['sizes'][ $size . '-width' ];
			$height = $image['sizes'][ $size . '-height' ];?>


				<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" class="size-large" />

			<?php if( $caption ): ?>

					<p class="wp-caption-text"><?php echo $caption; ?></p>

			<?php endif; ?>

			<?php if( get_field('copyright_statement')): ?>
				<p class="cc">
					<?php esc_html(the_field('copyright_statement')); ?>
				</p>
			<?php endif; ?>

		<?php endif; ?>

		<?php if( get_field('pull_quote')): ?>
			<blockquote class="blockquote">
					<p class="card-text"><?php esc_html(the_field('pull_quote')); ?></p>
			</blockquote>
		<?php endif; ?>

		<?php if( get_field('image_creator') && get_field('source') && get_field('source_url')): ?>
			<p>
				- <?php esc_html(the_field('creator')); ?>, <a href="<?php the_field('source_url'); ?>" target="_blank"><?php esc_html(the_field('source')); ?></a>
			</p>
		<?php elseif( get_field('image_creator') && get_field('source')): ?>
			<p class="blockquote-footer cite-link"><?php esc_html(the_field('creator')); ?>, <?php esc_html(the_field('source')); ?>
			</p>
		<?php elseif( get_field('source') && get_field('source_url')): ?>
			<p class="blockquote-footer cite-link"><a href="<?php esc_url(the_field('source_url')); ?>" target="_blank"><?php esc_html(the_field('source')); ?></a>
			</p>
		<?php elseif( get_field('source')): ?>
			<p class="blockquote-footer cite-link"><?php esc_html(the_field('source'));?>
			</p>
		<?php endif;

		tag_buttons();

		?>

	</div><!-- .card-block -->
</div><!-- .card -->
<br>
	</div><!-- .entry-content -->
<div class="container">
	<?php dynamic_content();?>
</div>
<br>

	<?php edit_post_link( esc_html__( 'Edit' ), '<footer class="entry-footer"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
