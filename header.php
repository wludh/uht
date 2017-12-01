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
	<link href="https://fonts.googleapis.com/css?family=Oswald:300,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:500,800" rel="stylesheet">
	<!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="https://use.fontawesome.com/a01839e7a7.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

		<!-- Brand and toggle get grouped for better mobile display -->

		<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark" style="background-color: #637E9C !important">
			<a class="fullBrand navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<a class="shortBrand navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">UHT</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>


			<div class="collapse navbar-collapse" id="navbarToggler">
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
<!--/.container-fluid -->
	</nav>
	<br>
</header><!-- #masthead -->

<div id="content" class="site-content">
