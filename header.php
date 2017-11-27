<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uht
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
	<!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="https://use.fontawesome.com/a01839e7a7.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'uht' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->


		<!-- Brand and toggle get grouped for better mobile display -->

		<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark" style="background-color: #637E9C !important">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
  		<a class="navbar-brand" href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="http://understandinghumantrafficking.org/toolbox/?cat=16">Stories</a></li>
					<li class="nav-item active">
						<a class="nav-link" href="http://understandinghumantrafficking.org/toolbox/?cat=17">Questions</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="http://understandinghumantrafficking.org/toolbox/">About</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="http://understandinghumantrafficking.org/toolbox/glossary/">Glossary</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="http://understandinghumantrafficking.org/toolbox/?cat=33">Blog</a>
					</li>
				</ul>
			</div>
		<?php /* Primary navigation */
/*wp_nav_menu( array(
  'menu' => 'primary',
  'depth' => 2,
  'container' => div,
	'container_class' => 'collapse navbar-collapse',
	'container_id' => 'navbar',
  'menu_class' => 'nav navbar-nav',
	'fallback_cb'  => 'wp_bootstrap_navwalker::fallback',
  //Process nav menu using our custom nav walker
  'walker' => new wp_bootstrap_navwalker())
);*/
?>
<!--/.container-fluid -->
	</nav>
	<br>
</header><!-- #masthead -->

<div id="content" class="site-content">
