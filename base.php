<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body <?php body_class(); ?>>
<?php
if( is_active_sidebar( 'upstart_top_cta_widgets' ) ): ?>
<div id="top-cta" class="outer-container">
	<div class="container clr">
		<?php dynamic_sidebar( 'upstart_top_cta_widgets' ); ?>
	</div>
</div> <?php
endif; ?>

<header id="site-header" class="outer-container" role="banner">
	<div class="container clr">
		<h1 id="site-title" class="col-xs-12 col-md-4">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php
				echo apply_filters( 'upstart_logo', get_bloginfo( 'name' ) );
			?></a>
		</h1>
		
		<nav id="primary-nav" class="col-xs-12 col-md-8">
			<a href="#" id="nav-toggle"><i class="fa fa-bars"></i></a>
			
			<?php
			wp_nav_menu( array(
				'container' 	 => false,
				'depth' 	 	 => 2,
				'theme_location' => 'upstart_primary_nav',
			) ); ?>
		</nav>
	</div>
</header>

<?php
if( is_front_page() && is_active_sidebar( 'upstart_feature_widgets' ) ): ?>
<div id="feature-widgets" class="outer-container">
	<?php dynamic_sidebar( 'upstart_feature_widgets' ); ?>
</div> <?php
endif; ?>

<div id="site-content" class="outer-container">
	<div class="container clr">
		<div id="main" class="col-xs-12 col-md-8" role="main">
			<?php 
			get_template_part( 'partials/page', 'header' );
			load_template( $upstart_content_template ); ?>
		</div>
		
		<?php
		if( ! is_404() && ! is_page_template() &&
			is_active_sidebar( 'upstart_sidebar_widgets' ) ): ?>
		<div id="sidebar" class="col-xs-12 col-md-4" role="complementary">
			<?php dynamic_sidebar( 'upstart_sidebar_widgets' ); ?>
		</div> <?php
		endif; ?>
	</div>
</div>

<?php
if( is_active_sidebar( 'upstart_footer_widgets' ) ): ?>
<div id="footer-widgets" class="outer-container">
	<div class="container clr">
		<?php dynamic_sidebar( 'upstart_footer_widgets' ); ?>
	</div>
</div> <?php
endif; ?>

<footer id="site-footer" class="outer-container" role="contentinfo">
	<div class="container clr">
		<div class="col-xs-12">
			<span id="copyright">
				&copy; <?php echo Date( 'Y' ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
				   rel="home"><?php bloginfo( 'name' ); ?></a>
			</span>
			
			<span id="generator">
				Powered by
				<a href="http://wordpress.org" rel="generator">WordPress</a>
			</span>
			
			<span id="designer">
				Designed by
				<a href="http://devamigo.com" rel="designer">Devamigo</a>
			</span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>