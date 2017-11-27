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
						<h1 class="display-4 text-center"><?php printf( __('%s', 'portfolio'), '<strong>' . single_cat_title('', false) . '</strong>'); ?></h1>

						<?php if (category_description()) : ?>
						<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</header><!-- .archive-header -->
					<?php

					$children = get_term_children($cat, 'category');
					$parent = get_category_parents($cat);

					if( $parent == 'Stories/Miriam/'): // This is not the best way to do this, but it works. Checks to see if the category is a child of "Stories;" returns TRUE if it is
						$stories = TRUE;
						elseif( $parent == 'Stories/Trudy/'):
							$stories = TRUE;
							elseif( $parent == 'Stories/Lena/'):
								$stories = TRUE;
								elseif( $parent == 'Stories/Sonya/'):
									$stories = TRUE;
									elseif( $parent == 'Stories/Holly/'):
										$stories = TRUE;
										elseif( $parent == 'Stories/Carla/'):
											$stories = TRUE;
					endif;


					// If the category is a child of "Stories", then display embedded videos as carousel, otherwise, display children or posts as cards

					if( $stories == TRUE):
						$args = array(
							'posts_per_page' => -1,
							'category' => $cat,
						);
						$posts = get_posts($args); ?>
						<div id="StoriesCarouselControls" class="carousel slide" data-ride="carousel">
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
										<h3><a href="<?php echo $link;?>"><?php echo $name;?></a></h3>
									</div>

									</div>
								<?php endforeach; ?>
							</div>
							<a class="carousel-control-prev" href="#StoriesCarouselControls" role="button" data-slide="prev">
    						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    						<span class="sr-only">Previous</span>
  						</a>
  						<a class="carousel-control-next" href="#StoriesCarouselControls" role="button" data-slide="next">
    						<span class="carousel-control-next-icon" aria-hidden="true"></span>
    						<span class="sr-only">Next</span>
  						</a>
						</div>
						<br>
						<?php
						$tags = get_tags(); // Right now, this just returns all the tags. Need to get just the tags from the category, but that's easier said than done.
						foreach( $tags as $tag):
							$tag_link = get_tag_link($tag->term_id);?>
							<a class="btn btn-outline-secondary text-dark" href="<?php echo esc_url($tag_link);?>"><?php echo esc_html($tag->name);?></a>
						<?php endforeach;


						?>
					</div>




					<?php else:

					if( !empty($children)): // If the category has children, display children as cards
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
															<h2 class="block-title">
																<?php echo $cat_name; ?>
															</h2>
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
		else: // If there are no children in the category, display posts as cards

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
															<h2 class="block-title">
																<?php echo $name; ?>
															</h2>
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
		endif; // End of conditional that checks whether the category is a child of "Stories"
						?>


				</div><!-- #content -->




		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
