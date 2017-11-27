<?php
/**
 * The template for displaying category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uht
 */

get_header(); ?>

	<div id="primary" class="container">
		<main id="main" class="site-main">

				<div id="content" class="site-content archive" role="main">

					<header class="archive-header">
						<h1 class="display-4 text-center text-light"><?php printf( __('%s', 'portfolio'), '<strong>' . single_cat_title('', false) . '</strong>'); ?></h1>

						<?php if (category_description()) : ?>
						<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</header><!-- .archive-header -->

					<?php

						$args = array(
							'posts_per_page' => -1,
							'category' => $cat,
							'order' => 'ASC'
						);
						$posts = get_posts($args); ?>
						<div id="carouselControls" class="carousel slide" data-interval="false">
							<div class="carousel-inner">
								<?php
								$i = 0;
								foreach( $posts as $post):

									$link = get_permalink($post);
									$name = get_the_title($post);

									if ( $i == 0):?>
										<div class="carousel-item active">
										<?php else: ?>
											<div class="carousel-item">
									<?php endif; ?>
										<div class="embed-responsive embed-responsive-16by9">
											<?php esc_url(the_field('story_embed_code'));
											$i = $i + 1; ?>
										</div>
										<div class="carousel-caption d-none d-md-block">
											<h3><a class="black-background-link" href="<?php echo $link;?>"><?php echo $name;?></a></h3>
										</div>

									</div> <!-- carousel-item -->
								<?php endforeach; ?>
							</div> <!-- carousel-inner -->
							<a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
    						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    						<span class="sr-only">Previous</span>
  						</a>
  						<a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
    						<span class="carousel-control-next-icon" aria-hidden="true"></span>
    						<span class="sr-only">Next</span>
  						</a>

						</div> <!-- carousel slide -->



						<br>

						<?php
						/*$args = array('categories' =>the_category_ID( false ));
	 					$tags = get_category_tags($args);
						foreach( $tags as $tag): ?>
							<!--<a class="btn btn-outline-light" href="<?php echo esc_url($tag->tag_link);?>"><?php echo($tag->tag_name); ?></a>-->
						<?php endforeach;	*/
						?>


				</div><!-- #content -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
