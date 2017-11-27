<?php
/**
 * uht functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uht
 */

if ( ! function_exists( 'uht_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function uht_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on uht, use a find and replace
		 * to change 'uht' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'uht', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'uht' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'uht_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'uht_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uht_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uht_content_width', 640 );
}
add_action( 'after_setup_theme', 'uht_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uht_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uht' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'uht' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uht_widgets_init' );

/**
 * Enqueue scripts and styles.
 */


function uht_scripts() {

		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');

		wp_enqueue_style( 'uht-style', get_stylesheet_uri() );

	wp_enqueue_script( 'uht-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'uht-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'pooper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js');

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'uht_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function custom_post_type_cat_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_category() || is_tag()) {
      $query->set( 'post_type', array( 'post', 'database_entry', 'glossary_entry' ) );
    }
  }
}

add_action('pre_get_posts','custom_post_type_cat_filter');

 // Register custom navigation walker
    require_once('wp-bootstrap-navwalker.php');

		// Bootstrap navigation
function bootstrap_nav()
{
	wp_nav_menu( array(
            'theme_location'    => 'header-menu',
            'depth'             => 2,
            'container'         => 'false',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
    );
}

function dynamic_content() {?>
	<div class="container">

	<?php global $post;
	$tag_ids = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) ); //Get the tag ids for all tags in the post

	if( !empty($tag_ids)):

	$pageID = get_the_ID();

	$postarray = array(); //Set up array for storing all the posts with all the tags

	foreach($tag_ids as $tag_id):
	  $args = array(
	    'tag__in' => $tag_id, //must use tag id for this field
	    'post_type' => array(
	      'database_entry',
	      'glossary_entry',
	      'post'
	    ),
	    'posts_per_page' => -1); //get all posts

	    $newposts = get_posts($args); //get all posts with the_tags
	    foreach ($newposts as $post): //push post data for each post in the tags to the array
	      setup_postdata($post);
	      $postidarray[] = get_the_ID();
	    endforeach;
	  endforeach;
	  $postiduniq = array_unique($postidarray); //remove any duplicate posts
	  shuffle($postiduniq); //shuffle the array to give the appearance of randomness

		//set up variables for the first three posts in the array
		$IDone = $postiduniq[0];
	  if ($IDone == $pageID): //check to make sure the post id isn't the same as the post currently being displayed
	    $IDone = $postiduniq[3];
	  endif;
	  $IDtwo = $postiduniq[1];
	  if ($IDtwo == $pageID):
	    $IDtwo = $postiduniq[3];
	  endif;
	  $IDthree = $postiduniq[2];
	  if ($IDthree == $pageID):
	    $IDthree = $postiduniq[3];
	  endif;
	  $titleone = get_the_title($IDone);
	  $titletwo = get_the_title($IDtwo);
	  $titlethree = get_the_title($IDthree);

		//retrieve the category for each post and store the category ID in a variable (there should only be a single category for a given post)
		$catsone = get_the_category($IDone);
		foreach ($catsone as $catone):
			$catoneID = $catone->term_id;
		endforeach;
		$catstwo = get_the_category($IDtwo);
		foreach ($catstwo as $cattwo):
			$cattwoID = $cattwo->term_id;
		endforeach;
		$catsthree = get_the_category($IDthree);
		foreach ($catsthree as $catthree):
			$catthreeID = $catthree->term_id;
		endforeach;


	  ?>

	  <div class="card-deck">
	    <div class="col-sm-4">

	          <?php
						//Check for a featured thumbnail for the individual post first
	          if ( has_post_thumbnail($IDone)):?>
	            <a href="<?php echo esc_url(get_permalink($IDone));?>">
								 <div class="card">
	              <img class="card-image" src="<?php echo esc_url(get_the_post_thumbnail_url($IDone));?>">
	              <div class="card-img-overlay">
	                <div class="cardbox">
	                  <h4 class="block-title"><?php echo sprintf( esc_html__($titleone));?></h4>
										<?php/* if( get_field('pull_quote', $IDone)):
											$quote = get_field('pull_quote', $IDone);
											$quote_length = strlen ( $quote );
											if( $quote_length < 75 ):
											?>
											<blockquote class="block-quote">
												<p ><?php esc_url(the_field('pull_quote', $IDone));?></p>
											</blockquote>
										<?php endif;
									endif;*/?>
	                </div>
	              </div>
							</div>
	            </a>
	            <?php
							//next check for a pull quote for the individual post
							elseif (get_field('pull_quote', $IDone)): ?>
							<a href="<?php echo esc_url(get_permalink($IDone));?>">
								<div class="card blue-border mb-3">
									<div class="card-body">
									<h4 class="card-title text-center text-dark"><?php echo sprintf(esc_html($titleone));?></h4>
									<div class="lede-right">
									<blockquote class="blockquote text-right text-secondary mb-0">
										<p><?php esc_html(the_field('pull_quote', $IDone));?></p>
									</blockquote>
								</div>
								</div>
							</div>
							</a>
							<?php

							//then check for a default image for the post's category
							elseif (get_field('category_image', 'category_' . $catoneID)):

							$catimageone = get_field('category_image', 'category_' . $catoneID);

							// vars
							$url = $catimageone['url'];
							$title = $catimageone['title'];
							$alt = $catimageone['alt'];
							$caption = $catimageone['caption'];

							// thumbnail
							$size = 'thumbnail';
							$thumb = $catimageone['sizes'][ $size ];
							$width = $catimageone['sizes'][ $size . '-width' ];
							$height = $catimageone['sizes'][ $size . '-height' ];

							?>

								<a href="<?php echo esc_url(get_permalink($IDone));?>">
									 <div class="card">
	                <img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
	                <div class="card-img-overlay">
	                  <div class="cardbox">
	                    <h4 class="block-title"><?php echo sprintf( esc_html__($titleone));?></h4>
	                    <?php/* if( get_field('pull_quote', $IDone)):
												$quote = get_field('pull_quote', $IDone);
												$quote_length = strlen ( $quote );
												if( $quote_length < 75 ):
												?>
	                      <blockquote class="block-quote">
	                        <p ><?php esc_html(the_field('pull_quote', $IDone));?></p>
	                      </blockquote>
	                    <?php endif;
										endif;*/?>
									</div>
								</div>
							</div>
						</a>

						<?php
					else: //if no featured image, pull quote or category image, display default image

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

								<a href="<?php echo esc_url(get_permalink($IDone));?>">
									 <div class="card">
	                <img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
	                <div class="card-img-overlay">
	                  <div class="cardbox">
	                    <h4 class="block-title"><?php echo sprintf( esc_html__($titleone));?></h4>
	                    <?php/* if( get_field('pull_quote', $IDone)):
												$quote = get_field('pull_quote', $IDone);
												$quote_length = strlen ( $quote );
												if( $quote_length < 75 ):
												?>
	                      <blockquote class="block-quote">
	                        <p ><?php esc_html(the_field('pull_quote', $IDone));?></p>
	                      </blockquote>
	                    <?php endif;
										endif;*/?>
	                  </div>
	                </div>
								</div>
	              </a>
	          <?php endif;?>

	      </div>


	    <div class="col-sm-4">


	          <?php
	          if ( has_post_thumbnail($IDtwo)):?>
	            <a href="<?php echo esc_url(get_permalink($IDtwo));?>">
								<div class="card">
	              <img class="card-image" src="<?php echo get_the_post_thumbnail_url($IDtwo);?>">
	              <div class="card-img-overlay">
	                <div class="cardbox">
	                  <h4 class="block-title"><?php echo sprintf( esc_html__($titletwo));?></h4>
										<?php /*if( get_field('pull_quote', $IDtwo)):
											$quote = get_field('pull_quote', $IDtwo);
											$quote_length = strlen ( $quote );
											if( $quote_length < 75 ):
											?>
											<blockquote class="block-quote">
												<p ><?php the_field('pull_quote', $IDtwo);?></p>
											</blockquote>
										<?php endif;
									endif;*/?>
	                </div>
	              </div>
							</div>
	            </a>
	            <?php

							elseif (get_field('pull_quote', $IDtwo)): ?>
							<a href="<?php echo esc_url(get_permalink($IDtwo));?>">
								<div class="card blue-border mb-3">
									<div class="card-body">
									<h4 class="card-title text-center text-dark"><?php echo sprintf(esc_html($titletwo));?></h4>
									<div class="lede-right">
									<blockquote class="blockquote text-right text-secondary mb-0">
										<p><?php esc_html(the_field('pull_quote', $IDtwo));?></p>
									</blockquote>
								</div>
								</div>
							</div>
							</a>

							<?php
							//then check for a default image for the post's category
							elseif (get_field('category_image', 'category_' . $cattwoID)):

							$catimagetwo = get_field('category_image', 'category_' . $cattwoID);

							// vars
							$url = $catimagetwo['url'];
							$title = $catimagetwo['title'];
							$alt = $catimagetwo['alt'];
							$caption = $catimagetwo['caption'];

							// thumbnail
							$size = 'thumbnail';
							$thumb = $catimagetwo['sizes'][ $size ];
							$width = $catimagetwo['sizes'][ $size . '-width' ];
							$height = $catimagetwo['sizes'][ $size . '-height' ];

							?>

								<a href="<?php echo esc_url(get_permalink($IDtwo));?>">
									 <div class="card">
	                <img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
	                <div class="card-img-overlay">
	                  <div class="cardbox">
	                    <h4 class="block-title"><?php echo sprintf( esc_html__($titletwo));?></h4>
	                    <?php/* if( get_field('pull_quote', $IDone)):
												$quote = get_field('pull_quote', $IDone);
												$quote_length = strlen ( $quote );
												if( $quote_length < 75 ):
												?>
	                      <blockquote class="block-quote">
	                        <p ><?php esc_html(the_field('pull_quote', $IDone));?></p>
	                      </blockquote>
	                    <?php endif;
										endif;*/?>
									</div>
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

	              <a href="<?php echo esc_url(get_permalink($IDtwo));?>">
									<div class="card">
	                <img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
	                <div class="card-img-overlay">
	                  <div class="cardbox">
	                    <h4 class="block-title"><?php echo sprintf( esc_html__($titletwo));?></h4>
											<?php /*if( get_field('pull_quote', $IDtwo)):
											 $quote = get_field('pull_quote', $IDtwo);
											 $quote_length = strlen ( $quote );
											 if( $quote_length < 75 ):
											 ?>
											 <blockquote class="block-quote">
												 <p ><?php the_field('pull_quote', $IDtwo);?></p>
											 </blockquote>
										 <?php endif;
									 endif;*/?>
	                  </div>
	                </div>
								</div>
	              </a>
	          <?php endif;?>

	    </div>

	    <div class="col-sm-4">

	          <?php
	          if ( has_post_thumbnail($IDthree)):?>
	            <a href="<?php echo esc_url(get_permalink($IDthree));?>">
								<div class="card">
	              <img class="card-image" src="<?php echo get_the_post_thumbnail_url($IDthree);?>">
	              <div class="card-img-overlay">
	                <div class="cardbox">
	                  <h4 class="block-title"><?php echo sprintf( esc_html__($titlethree));?></h4>
										<?php/* if( get_field('pull_quote', $IDthree)):
											$quote = get_field('pull_quote', $IDthree);
											$quote_length = strlen ( $quote );
											if( $quote_length < 75 ):
											?>
											<blockquote class="block-quote">
												<p ><?php the_field('pull_quote', $IDthree);?></p>
											</blockquote>
										<?php endif;
									endif;*/?>
	                </div>
	              </div>
							</div>
	            </a>
	            <?php

							elseif (get_field('pull_quote', $IDthree)): ?>
							<a href="<?php echo esc_url(get_permalink($IDthree));?>">
								<div class="card blue-border mb-3">
									<div class="card-body">
									<h4 class="card-title text-center text-dark"><?php echo sprintf(esc_html($titlethree));?></h4>
									<div class="lede-right">
									<blockquote class="blockquote text-right text-secondary mb-0">
										<p><?php esc_html(the_field('pull_quote', $IDthree));?></p>
									</blockquote>
								</div>
								</div>
							</div>
							</a>
							<?php

							//then check for a default image for the post's category
							elseif (get_field('category_image', 'category_' . $catthreeID)):

							$catimagethree = get_field('category_image', 'category_' . $catthreeID);

							// vars
							$url = $catimagethree['url'];
							$title = $catimagethree['title'];
							$alt = $catimagethree['alt'];
							$caption = $catimagethree['caption'];

							// thumbnail
							$size = 'thumbnail';
							$thumb = $catimagethree['sizes'][ $size ];
							$width = $catimagethree['sizes'][ $size . '-width' ];
							$height = $catimagethree['sizes'][ $size . '-height' ];

							?>

								<a href="<?php echo esc_url(get_permalink($IDthree));?>">
									 <div class="card">
	                <img class="card-image size-thumbnail" src="<?php echo esc_url($url);?>" alt="<?php echo esc_html__($alt); ?>">
	                <div class="card-img-overlay">
	                  <div class="cardbox">
	                    <h4 class="block-title"><?php echo sprintf( esc_html__($titlethree));?></h4>
	                    <?php/* if( get_field('pull_quote', $IDone)):
												$quote = get_field('pull_quote', $IDone);
												$quote_length = strlen ( $quote );
												if( $quote_length < 75 ):
												?>
	                      <blockquote class="block-quote">
	                        <p ><?php esc_html(the_field('pull_quote', $IDone));?></p>
	                      </blockquote>
	                    <?php endif;
										endif;*/?>
									</div>
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

	              <a href="<?php echo esc_url(get_permalink($IDthree));?>">
									<div class="card">
	                <img class="card-image size-thumbnail" src="<?php echo $url;?>" alt="<?php echo $alt; ?>">
	                <div class="card-img-overlay">
	                  <div class="cardbox">
	                    <h4 class="block-title"><?php echo sprintf( esc_html__($titlethree));?></h4>
											<?php /*if( get_field('pull_quote', $IDthree)):
											 $quote = get_field('pull_quote', $IDthree);
											 $quote_length = strlen ( $quote );
											 if( $quote_length < 75 ):
											 ?>
											 <blockquote class="block-quote">
												 <p ><?php the_field('pull_quote', $IDthree);?></p>
											 </blockquote>
										 <?php endif;
									 endif;*/?>
	                  </div>
	                </div>
								</div>
	              </a>
	          <?php endif;?>


	    </div>
	  </div>
		<br>
	</div>
	<br>
	<?php
endif;
}

function the_field_without_wpautop( $field_name ) {

	remove_filter('acf_the_content', 'wpautop');

	the_field( $field_name );

	add_filter('acf_the_content', 'wpautop');

}

function tag_buttons() {
	$tags = get_the_tags();
	if( !empty($tags) ):
	foreach( $tags as $tag ):
		$tag_link = get_tag_link($tag->term_id);?>
		<a class="btn btn-outline-secondary text-dark" href="<?php echo esc_url($tag_link);?>"><?php echo esc_html($tag->name);?></a>
	<?php endforeach;
endif;
}

function next_page_ID($id) {
    // Get all pages under this section
    $post = get_post($id);
    $post_parent = $post->post_parent;
    $get_pages_query = 'child_of=' . $post_parent . '&parent=' . $post_parent . '&sort_column=menu_order&sort_order=asc';
	$get_pages = get_pages($get_pages_query);
	$next_page_id = '';
    // Count results
	$page_count = count($get_pages);

	for ($p=0; $p < $page_count; $p++) {
	  	// Get the array key for our entry
		if ($id == $get_pages[$p]->ID) break;
	}

	// Assign our next key
	$next_key = $p+1;

	// If there isn't a value assigned for the previous key, go all the way to the end
	if (isset($get_pages[$next_key])) {
		$next_page_id = $get_pages[$next_key]->ID;
	}
	return $next_page_id;
}
/* =============================================================
    PREVIOUS PAGE ID
    A function to get the previous page's ID.
    $id = ID of the page you want to find the previous page for.
 * ============================================================= */
function previous_page_ID($id) {
    // Get all pages under this section
    $post = get_post($id);
    $post_parent = $post->post_parent;
    $get_pages_query = 'child_of=' . $post_parent . '&parent=' . $post_parent . '&sort_column=menu_order&sort_order=asc';
	$get_pages = get_pages($get_pages_query);
	$prev_page_id = '';
	// Count results
	$page_count = count($get_pages);

	for($p=0; $p < $page_count; $p++) {
	  // get the array key for our entry
		if ($id == $get_pages[$p]->ID) break;
	}

	// assign our next & previous keys
	$prev_key = $p-1;
	$last_key = $page_count-1;

	// if there isn't a value assigned for the previous key, go all the way to the end
	if (isset($get_pages[$prev_key])) {
		$prev_page_id = $get_pages[$prev_key]->ID;
	}
  	return $prev_page_id;
}


/* Get all tags in a category */

function get_category_tags($args) {
    global $wpdb;
	$tags = $wpdb->get_results
	("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
		FROM
			wp_posts as p1
			LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

			wp_posts as p2
			LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name
	");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}
