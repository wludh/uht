<?php
/**
 * The template used for displaying page content in db link entries
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
           <?php if( get_field('statistic_text')): ?>
             <p class="card-text">
               <?php esc_html(the_field('statistic_text')); ?>
             </p>
           <?php endif; ?>
           <?php if( get_field('statistic_source') && get_field('statistic_source_url')): ?>
             <p class="blockquote-footer cite-link">
               <a href=" <?php esc_url(the_field('statistic_source_url'));?>" target="_blank"><?php esc_html(the_field('statistic_source')); ?></a>
			       </p>
		       <?php elseif( get_field('statistic_source')): ?>
             <p class="blockquote-footer cite-link">
               <?php the_field('statistic_source'); ?>
			       </p>
		       <?php endif; ?>

		       <?php

		       $image = get_field('chart_or_diagram');

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

              <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_html($alt); ?>" class="size-large" />

              <?php if( $caption ): ?>
                <p class="wp-caption-text"><?php echo esc_html($caption); ?></p>
              <?php endif; ?>
            <?php endif; ?>

            <?php if( get_field('chart_creator') && get_field('chart_source') && get_field('chart_source_url')): ?>
              <p class="blockquote-footer cite-link">
                <?php esc_html(the_field('chart_creator')); ?>, <a href="<?php esc_url(the_field('chart_source_url')); ?>" target="_blank"><?php esc_html(the_field('chart_source')); ?></a>
              </p>
            <?php elseif( get_field('chart_source') && get_field('chart_source_url')): ?>
              <p class="blockquote-footer cite-link">
                <a href="<?php esc_url(the_field('chart_source_url')); ?>" target="_blank"><?php esc_html(the_field('chart_source')); ?></a>
              </p>
            <?php elseif( get_field('chart_creator') && get_field('chart_source')): ?>
              <p class="blockquote-footer">
                <?php esc_html(the_field('chart_creator')); ?>, <?php esc_html(the_field('chart_source')); ?>
              </p>
            <?php elseif( get_field('chart_creator')): ?>
              <p class="blockquote-footer">
                <?php esc_html(the_field('chart_creator')); ?>
              </p>
            <?php endif;

            tag_buttons()

            ?>

          </div><!-- .card-block -->
        </div><!-- .card -->
        <br>
      </div><!-- .container -->

      <div class="container">
      	<?php dynamic_content();?>
      </div>

	<?php edit_post_link( esc_html__( 'Edit' ), '<footer class="entry-footer"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
