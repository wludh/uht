<?php
/**
 * Template part for displaying results in archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uht
 */

?>

<div class="col-sm-4">
	<div class="card">
		<div class="card-block">

				<?php if (has_post_thumbnail()):
					$url = get_the_post_thumbnail_url();
					?>
					<a href="<?php echo esc_url(get_permalink());?>">
						<img class="card-img size-thumbnail" src="<?php echo esc_url($url);?>">
						<div class="card-img-overlay">
							<div class="cardbox">
								<h4 class="block-title"><?php esc_html(the_title()); ?></h4>
								<?php if( get_field('pull_quote')):
									$quote = get_field('pull_quote');
									$quote_length = strlen ( $quote );
									if( $quote_length < 75 ):
									?>
									<blockquote class="block-quote">
										<p ><?php esc_url(the_field('pull_quote'));?></p>
									</blockquote>
								<?php endif;
							endif;?>
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
					$height = $image['sizes'][ $size . '-height' ];

					?>

						<a href="<?php echo esc_url(get_permalink());?>">
							<img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
							<div class="card-img-overlay">
								<div class="cardbox">
									<h4 class="block-title"><?php echo sprintf(esc_html(get_the_title())); ?></h4>
									<?php if( get_field('pull_quote')):
										$quote = get_field('pull_quote');
										$quote_length = strlen ( $quote );
										if( $quote_length < 75 ):
										?>
										<blockquote class="block-quote">
											<p ><?php esc_html(the_field('pull_quote'));?></p>
										</blockquote>
									<?php endif;
								endif;?>
								</div>
							</div>
						</a>
				<?php endif;?>

			</div>
		</div>
	</div>
