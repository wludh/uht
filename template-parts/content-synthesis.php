<?php
/**
 * The template used for displaying page content in db synthesis entries
 *
 * @package uht
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="card">
			<div class="card-body">
        <header class="text-center">
          <h1 class="card-title"><?php esc_html(the_title()); ?></h1>
        </header><!-- .entry-header -->

        <?php if( get_field('pull_quote')): ?>
          <blockquote class="blockquote">
            <p><?php esc_html(the_field('pull_quote')); ?></p>
          </blockquote>
        <?php endif; ?>
        <p class="card-text">
          <?php esc_html(the_field('synthetic_summary'));?>
        </p>
        <p class="blockquote-footer cite-link">
          <?php esc_html(the_field('source_author')); ?>, <?php esc_html(the_field('source_title')); ?>
        </p>
        <p class="blockquote-footer cite">
          <?php esc_html(the_field_without_wpautop('citation')); ?>
        </p>
		    <p class="card-text" style="text-align: right;">
          <?php esc_html(the_field('synthesis_author')); ?>
		    </p>

				<?php tag_buttons(); ?>

      </div><!-- .card-block -->
    </div><!-- .card -->
    <br>
  </div><!-- .container -->

    <div class="container">
    	<?php dynamic_content()?>
    </div>

    <br>

	<?php edit_post_link( esc_html__( 'Edit' ), '<footer class="entry-footer"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
