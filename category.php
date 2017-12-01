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
				<header>
					<div class="container text-center">
						<div class="d-inline-flex">
							<?php
							$children = get_term_children($cat, 'category');
							$parent = get_category_parents($cat);
							if( !empty($children)):?>
								<h1 class="display-4 embellish"><?php printf( __('%s', 'portfolio'),  single_cat_title('', false) ); ?></h1>
							<?php else: ?>
								<h1 class="display-4 embellish-lower"><?php printf( __('%s', 'portfolio'),  single_cat_title('', false) ); ?></h1>
							<?php endif; ?>
						</div>

						<?php
						if (category_description()) : ?>
							<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</div>
				</header><!-- .archive-header -->

				<?php

				// If a category has children, display children; if not display posts

				if( !empty($children)): // If the category has children, display children as cards
					$categories = get_categories( array(
						'child_of' => $cat,
						'order' => 'rand',
					) );
					/*Return categories as cards*/
					?>
					<div class="card-columns">
					<?php
					foreach( $categories as $category ) : ?>
						<div class="card">
							<?php

							$cat_name = esc_html( $category->name);
							$cat_link = esc_url( get_category_link($category->term_id));									$cat_ID =  get_cat_ID($cat_name);

							$image = get_field('category_image', 'category_' . $cat_ID);
							if( !empty($image) ): // Checks to see if the category has an image assigned

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
												<?php
												if ( strlen ($cat_name) < 10 ): ?>
													<h2 class="block-title">
														<?php echo $cat_name; ?>
													</h2>
												<?php
												else: ?>
													<h2 class="block-title responsive-title">
														<?php echo $cat_name; ?>
													</h2>
												<?php
												endif; ?>
											</header>
										</div>
									</div>
								</a>
								<?php
								else: // If there's not featured image, uses the default
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
													<?php
													if ( strlen ( $cat_name ) < 10 ): ?>
														<h2 class="block-title">
															<?php echo $cat_name; ?>
														</h2>
													<?php
													else: ?>
														<h2 class="block-title responsive-title">
															<?php echo $cat_name; ?>
														</h2>
													<?php endif; ?>
												</header>
											</div>
										</div>
									</a>
									<?php endif;?>
						</div>
					<?php
					endforeach; ?>
					</div>
				<?php
				else: // If there are no children in the category, display posts as cards

					/*Return posts as cards*/

					$args = array(
						'posts_per_page' => -1,
						'category' => $cat,
						'order' => 'rand'
					);
					$posts = get_posts($args);
					?>
					<div class="card-columns">
						<?php
						foreach( $posts as $post ) :
							setup_postdata($post); ?>
								<div class="card">
									<?php

									$name = get_the_title($post);
									$link = get_permalink($post);
									$ID =  get_the_ID($post);

									$image = get_field('category_image', 'category_' . $ID);
									if( !empty($image) ): // Checks for featured category image

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
														<?php
														if ( strlen ($name) < 10 ): ?>
															<h2 class="block-title">
																<?php echo $name; ?>
															</h2>
														<?php
														else: ?>
															<h2 class="block-title responsive-title">
																<?php echo $name; ?>
															</h2>
														<?php
														endif; ?>
													</header>
												</div>
											</div>
										</a>
										<?php
										else: // If no featured image, uses default
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
															<?php
															if ( strlen ($name) < 10 ): ?>
																<h2 class="block-title">
																	<?php echo $name; ?>
																</h2>
															<?php
															else: ?>
																<h2 class="block-title responsive-title">
																	<?php echo $name; ?>
																</h2>
															<?php
															endif; ?>
														</header>
													</div>
												</div>
											</a>
										<?php endif;?>
								</div>

						<?php endforeach; ?>
					</div>
				<?php endif; // End of conditional that checks for children

						?>


			</div><!-- #content -->




		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
