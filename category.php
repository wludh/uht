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
						<h1 class="archive-title"><?php printf( __('%s', 'portfolio'), '<strong>' . single_cat_title('', false) . '</strong>'); ?></h1>

						<?php if (category_description()) : ?>
						<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</header><!-- .archive-header -->
					<?php

					$children = get_term_children($cat, 'category');

					if( !empty($children)):
						$categories = get_categories( array(
							'child_of' => $cat,
							'order' => 'rand',
						) );
						/*Return categories as cards*/
						$i = 0;
						foreach( $categories as $category ) :
							if($i % 3 == 0): ?>
								<div class="card-deck">
									<?php
							endif; ?>
							<div class="col-sm-4">
								<div class="card">
										<?php

										$cat_name = esc_html( $category->name);
										$cat_link = esc_url( get_category_link($category->term_id));
										$cat_ID =  get_cat_ID($cat_name);

										$image = get_field('category_image', 'category_' . $cat_ID);
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

											<a href="<?php echo $cat_link;?>">
												<img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
												<div class="card-img-overlay">
													<div class="cardbox">
														<header class="text-center">
															<h2 class="block-title">
																<?php echo $cat_name; ?>
															</h2>
														</header>
													</div>
												</div>
											</a>
											<?php
										else:
												$cat_ID = get_cat_ID('Uncategorized');
												$image = get_field('category_image', 'category_' . $cat_ID);

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

										<a href="<?php echo $cat_link;?>">
											<img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
											<div class="card-img-overlay">
												<div class="cardbox">
													<header class="text-center">
														<h2 class="block-title">
															<?php echo $cat_name; ?>
														</h2>
													</header>
												</div>
											</div>
										</a>
									<?php endif;?>

						</div>
					</div>

				<?php
				$i++;
				if($i != 0 && $i % 3 == 0): ?>
					</div><!--/.row-->
					<br>
					<div class="clearfix"></div>

					<?php
				endif;
			endforeach;
			else:

						/*Return posts as cards*/

						$args = array(
							'posts_per_page' => -1,
							'category' => $cat,
							'order' => 'rand'
						);
						$posts = get_posts($args);

						$i = 0;
						foreach( $posts as $post ) :
							setup_postdata($post);
							if($i % 3 == 0) {?>
								<div class="card-deck">
									<?php
							}?>
							<div class="col-sm-4">
								<div class="card">

										<?php

										$name = get_the_title($post);
										$link = get_permalink($post);
										$ID =  get_the_ID($post);

										$image = get_field('category_image', 'category_' . $ID);
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

											<a href="<?php echo $link;?>">
												<img class="card-image" src="<?php echo $url;?>" alt="<?php echo $alt; ?>" class="size-thumbnail"/>
												<div class="card-img-overlay">
													<div class="cardbox">
														<header class="text-center">
															<h2 class="block-title">
																<?php echo $name; ?>
															</h2>
														</header>
													</div>
												</div>
											</a>
											<?php
											else:
												$cat_ID = get_cat_ID('Uncategorized');
												$image = get_field('category_image', 'category_' . $cat_ID);

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

										<a href="<?php echo $link;?>">
											<img class="card-image size-thumbnail" src="<?php echo $url;?>" alt="<?php echo $alt; ?>">
											<div class="card-img-overlay">
												<div class="cardbox">
													<header class="text-center">
														<h2 class="block-title">
															<?php echo $name; ?>
														</h2>
													</header>
												</div>
											</div>
										</a>
									<?php endif;?>

						</div>
					</div>
			
				<?php
				$i++;
				if($i != 0 && $i % 3 == 0) { ?>
				</div><!--/.row-->
				<br>
				<div class="clearfix"></div>

			<?php
				} ?>

						<?php endforeach;
					endif;
						?>


				</div><!-- #content -->




		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
