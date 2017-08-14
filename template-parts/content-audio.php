<?php
/**
 * The template used for displaying page content in db audio entries
 *
 * @package uht
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="container">
		<div class="card">
			<div class="card-block">
        <header class="text-center">
		        <h1 class="entry-title"><?php esc_html(the_title()); ?></h1>
	      </header><!-- .entry-header -->

		<?php esc_url(the_field('embed_code')); ?>

    <?php if( get_field('copyright_statement')): ?>
      <p class="cc">
        <?php esc_html(the_field('copyright_statement')); ?>
      </p>
    <?php endif; ?>

		<?php if( get_field('pull_quote')): ?>
      <blockquote class="blockquote">
        <p class="card-text"><?php esc_html(the_field('pull_quote')); ?></p>
      </blockquote>
		<?php endif; ?>
		<?php if( get_field('display_text')): ?>
			<p class="card-text">
				<?php esc_html(the_field('display_text')); ?>
			</p>
		<?php endif; ?>

    <?php if( get_field('transcript')): ?>
      <details><!--Requires HTML5. Would it be better to use JavaScript?-->
        <summary class="cc">Click to view transcript</summary>
        <p class="card-text"><?php esc_html(the_field('transcript')); ?></p>
      </details>
    <?php endif;?>

		<?php tag_buttons(); ?>

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
</div>
