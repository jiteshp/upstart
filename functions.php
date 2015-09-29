<?php
/**
 *	Set the content width
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_content_width' ) ) {
	function upstart_content_width() {
		$GLOBALS['content_width'] = 
			apply_filters( 'upstart_content_width', 960 );
	}
	
	add_action( 'after_setup_theme', 'upstart_content_width' );
}

/**
 *	Add support for theme features
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_setup' ) ) {
	function upstart_setup() {
		add_theme_support( 'custom-background', array(
			'default-color' => 'BBBBBB',
		) );
		
		add_theme_support( 'custom-header', array(
			'flex-height' 	=> true,
			'flex-width' 	=> true,
			'header-text' 	=> false,
			'height' 		=> 104,
			'width' 		=> 260,
		) );
		
		add_theme_support( 'html5', array(
			'caption', 'comment-form', 'comment-list', 'gallery', 'search-form',
		) );
		
		add_theme_support( 'post-thumbnails' );
		
		add_theme_support( 'title-tag' );
		
		register_nav_menu( 'upstart_primary_nav', 'Primary Navigation Menu' );
	}
	
	add_action( 'after_setup_theme', 'upstart_setup' );
}

/**
 *	Update image sizes
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_image_sizes' ) ) {
	function upstart_image_sizes() {
		update_option( 'large_size_h', 0 );
		update_option( 'large_size_w', 0 );
		
		update_option( 'medium_size_h', 0 );
		update_option( 'medium_size_w', 0 );
		
		update_option( 'thumbnail_size_h', 0 );
		update_option( 'thumbnail_size_w', 0 );
		
		set_post_thumbnail_size( 1200, 630 );
	}
	
	add_action( 'after_setup_theme', 'upstart_image_sizes' );
}

/**
 *	Register theme widget areas
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_widget_areas' ) ) {
	function upstart_widget_areas() {
		register_sidebar( array(
			'id'			=> 'upstart_sidebar_widgets',
			'name'			=> 'Sidebar',
			'before_widget' => '<aside class="widget">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		
		register_sidebar( array(
			'id'			=> 'upstart_feature_widgets',
			'name'			=> 'Feature Box',
			'before_widget' => '<aside class="widget"><div class="container">',
			'after_widget'	=> '</div></aside>',
			'before_title'	=> '<h2 class="widget-title">',
			'after_title'	=> '</h2>',
		) );
		
		register_sidebar( array(
			'id'			=> 'upstart_footer_widgets',
			'name'			=> 'Footer',
			'before_widget' => '<aside class="widget">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		
		register_sidebar( array(
			'id'			=> 'upstart_top_cta_widgets',
			'name'			=> 'Top Call To Action',
			'before_widget' => '<aside class="widget">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title screen-reader-text">',
			'after_title'	=> '</h4>',
		) );
	}
	
	add_action( 'widgets_init', 'upstart_widget_areas' );
}

/**
 *	Enqueue theme styles & scripts
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_assets' ) ) {
	function upstart_assets() {
		wp_enqueue_style( 'upstart-style', get_stylesheet_uri() );
		wp_enqueue_style( 'upstart-fonts', upstart_get_fonts_uri() );
		wp_enqueue_style( 'upstart-icons', 
			'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
		
		if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'upstart-fitvids',
			get_template_directory_uri() . '/js/jquery.fitvids.js',
			array( 'jquery' ), null, true );
		wp_enqueue_script( 'upstart-match-height',
			get_template_directory_uri() . '/js/jquery.matchHeight.js',
			array( 'jquery' ), null, true );
		wp_enqueue_script( 'upstart-scroll-to',
			get_template_directory_uri() . '/js/jquery.scrollTo.js',
			array( 'jquery' ), null, true );
		wp_enqueue_script( 'upstart-script',
			get_template_directory_uri() . '/js/script.js',
			array( 'upstart-fitvids', 'upstart-match-height', 'upstart-scroll-to' ), 
			null, true );
	}
	
	add_action( 'wp_enqueue_scripts', 'upstart_assets' );
}

/**
 *	Custom templating
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_templating' ) ) {
	function upstart_templating( $template ) {
		global $upstart_content_template;
		$upstart_content_template = $template;
		
		return get_template_directory() . '/base.php';
	}
	
	add_filter( 'template_include', 'upstart_templating' );
}

/**
 *	Clean body class
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_body_class' ) ) {
	function upstart_body_class( $classes ) {
		$classes = array( 'custom-background' );
		
		if( is_front_page() ) {
			$classes[] = 'home';
		}
		
		if( is_404() || is_page_template() || 
			! is_active_sidebar( 'upstart_sidebar_widgets' ) ) {
			$classes[] = 'full-width';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'upstart_body_class' );
}

/**
 *	Clean post class
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_post_class' ) ) {
	function upstart_post_class( $classes ) {
		return array( 'entry' );
	}
	
	add_filter( 'post_class', 'upstart_post_class' );
}

/**
 *	Clean head section
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_clean_head' ) ) {
	function upstart_clean_head() {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}
	
	add_action( 'init', 'upstart_clean_head' );
}

/**
 *	Clean admin dashboard
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_clean_admin' ) ) {
	function upstart_clean_admin() {
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );  
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );  
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );  
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );  
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );

		remove_meta_box( 'authordiv', 'post', 'normal' );
		remove_meta_box( 'commentsdiv', 'post', 'normal' );
		remove_meta_box( 'postcustom', 'post', 'normal' );
		remove_meta_box( 'revisionsdiv', 'post', 'normal' );
		remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
	}
	
	add_action( 'admin_init', 'upstart_clean_admin' );
}

/**
 *	Remove unwanted widgets
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_clean_widgets' ) ) {
	function upstart_clean_widgets() {
		unregister_widget( 'WP_Widget_Archives' );
		unregister_widget( 'WP_Widget_Calendar' );
		unregister_widget( 'WP_Widget_Categories' );
		unregister_widget( 'WP_Widget_Links' );
		unregister_widget( 'WP_Widget_Meta' );
		unregister_widget( 'WP_Widget_Pages' );
		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_RSS' );
		unregister_widget( 'WP_Widget_Tag_Cloud' );
	}
	
	add_action( 'widgets_init', 'upstart_clean_widgets' );
}

/**
 *	Remove plugin styles
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_clean_styles' ) ) {
	function upstart_clean_styles() {
		$styles_to_remove = array(
			'contact-form-7',
			'contact-form-7-rtl',
		);
		
		foreach( $styles_to_remove as $style ) {
			wp_deregister_style( $style );
		}
	}
	
	add_action( 'wp_print_styles', 'upstart_clean_styles' );
}

/**
 *	Remove tags
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_remove_tags' ) ) {
	function upstart_remove_tags() {
		register_taxonomy( 'post_tag', array() );
	}
	
	add_action( 'after_setup_theme', 'upstart_remove_tags' );
}

/**
 *	Custom logo
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_custom_logo' ) ) {
	function upstart_custom_logo( $logo ) {
		$header_image = get_header_image();
		
		if( $header_image ) {
			$logo = sprintf( '<img src="%1$s" alt="%2$s">',
				esc_url( $header_image ), esc_attr( $logo ) );
		}
		
		return $logo;
	}
	
	add_filter( 'upstart_logo', 'upstart_custom_logo' );
}

/**
 *	Custom excerpt length
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_excerpt_length' ) ) {
	function upstart_excerpt_length() {
		return 25;
	}
	
	add_filter( 'excerpt_length', 'upstart_excerpt_length' );
}

/**
 *	Custom excerpt more
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_excerpt_more' ) ) {
	function upstart_excerpt_more() {
		return sprintf( '&nbsp;&hellip;<p><a href="%1$s">Read more</a></p>',
			esc_url( get_the_permalink() ) );
	}
	
	add_filter( 'excerpt_more', 'upstart_excerpt_more' );
}
 
/**
 *	Return fonts URI
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_get_fonts_uri' ) ) {
	function upstart_get_fonts_uri() {
		$fonts = apply_filters( 'upstart_fonts', array(
			'Open Sans:400,700',
			'Gentium Book Basic:400,400italic,700',
		) );
		
		return add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
		), 'https://fonts.googleapis.com/css' );
	}
}

/**
 *	Customizer options
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_customizer_options' ) ) {
	function upstart_customizer_options( $wp_customize ) {
		$wp_customize->add_setting( 'upstart_accent_color' );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'upstart_accent_color', array(
				'label'		=> 'Accent Color',
				'section'	=> 'colors',
			)
		) );
		
		$wp_customize->add_setting( 'upstart_feature_image' );
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
			$wp_customize, 'upstart_feature_image', array(
				'label'			=> 'Feature Image',
				'section'		=> 'header_image',
				'flex_height'	=> true,
				'flex_width'	=> false,
				'height'		=> 600,
				'width'			=> 1020,
			)
		) );
	}
	
	add_action( 'customize_register', 'upstart_customizer_options' );
}

/**
 *	Customizer output
 *	----------------------------------------------------------------------------
 */
if( ! function_exists( 'upstart_customizer_output' ) ) {
	function upstart_customizer_output() {
		$accent_color = get_theme_mod( 'upstart_accent_color', false );
		
		$feature_image = false;
		if( ( $feature_image_id = get_theme_mod( 'upstart_feature_image', false ) ) ) {
			$feature_image = wp_get_attachment_image_src( $feature_image_id );
		} ?>
<!-- custom styles from the customizer -->		
<style id="custom-styles" type="text/css">
<?php 
if( $feature_image ): ?>
#feature-widgets .widget:first-child { 
	background-image: url( '<?php echo esc_url( $feature_image[0] ); ?>' ); 
} <?php 
endif;

if( $accent_color ): ?>
a { 
	color: <?php _e( $accent_color ); ?>;
}
a:hover { 
	border-color: <?php _e( $accent_color ); ?>;
}
blockquote {
	border-left-color: <?php _e( $accent_color ); ?>;
}
h1 a:hover, .h1 a:hover {
	color: <?php _e( $accent_color ); ?>;
}
.entry-meta a:hover {
	color: <?php _e( $accent_color ); ?>;
}
input[type=submit], .btn {
	background-color: <?php _e( $accent_color ); ?>;
	border-color: <?php _e( $accent_color ); ?>;
}
input[type=submit].btn-white, .btn.btn-white {
	color: <?php _e( $accent_color ); ?>;
}
input[type=submit].btn-white:hover, .btn.btn-white:hover {
	background-color: <?php _e( $accent_color ); ?>;
	border-color: <?php _e( $accent_color ); ?>;
}
input[type=submit].btn-min, .btn.btn-min {
	border-color: <?php _e( $accent_color ); ?>;
	color: <?php _e( $accent_color ); ?>;
}
input[type=submit].btn-min:hover, .btn.btn-min:hover {
	background-color: <?php _e( $accent_color ); ?>;
	border-color: <?php _e( $accent_color ); ?>;
}
input[type=submit].btn-min-white:hover, .btn.btn-min-white:hover {
	color: <?php _e( $accent_color ); ?>;
} <?php
endif; ?>
</style> <?php
		echo "\n\n";
	}
	
	add_action( 'wp_head', 'upstart_customizer_output' );
}