<?php
/**
 * The template for displaying carousel pages for the stories
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
					<div class="container text-center">
						<div class="d-inline-flex">
							<h1 class="page-title display-4 gray-text embellish"><?php printf( __('%s', 'portfolio'),  single_cat_title('', false) ); ?></h1>
						</div>

						<?php if (category_description()) : ?>
							<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</div>
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
									<div class="text-center d-block">
										<h3 class="carousel-below"><a class="black-background-link" href="<?php echo $link;?>"><?php echo $name;?></a></h3>
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

			</div><!-- #content -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
