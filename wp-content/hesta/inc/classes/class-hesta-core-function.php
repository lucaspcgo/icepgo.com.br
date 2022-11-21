<?php
class hesta_core {

	function __construct() {
		// Register action/filter callbacks here...
		add_action( 'after_setup_theme', array( $this, 'hesta_setup_theme' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'hesta_scripts' ) );
		add_action( 'widgets_init', array( $this, 'hesta_register_sidebars' ) );
	}

	function hesta_setup_theme() {

		global $content_width;

		if ( ! isset( $content_width ) ) {
			$content_width = 900;
		}

		/* navigation menu */
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu, menu_depth is 3', 'hesta' ),
				'social' => __( 'Social Links Menu', 'hesta' ),
			)
		);
		
		/* woocommerce */
		add_theme_support( 'woocommerce' );
		
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_theme_support( 'custom-logo', array() );

		$args = array(
			'default-text-color' => 'fff',
			'width'              => 1000,
			'height'             => 250,
			'flex-width'         => true,
			'flex-height'        => true,
		);
		add_theme_support( 'custom-header', $args );

		add_theme_support( "custom-background", $args );

		add_theme_support( 'post-thumbnails' );

		/* image size */
		add_image_size( 'hesta-blog-thumb', 700, 430, true );
		add_image_size( 'hesta-about-thumb', 532, 345, true );

		add_theme_support( 'title-tag' );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_editor_style();

		if ( is_singular() ) {
			wp_enqueue_script( "comment-reply" );
		}

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'editor-styles' );

	}

	function hesta_scripts() {

		// Enqueue main theme stylesheet
		wp_enqueue_style( 'hesta-style', get_stylesheet_uri() );

		// Enqueue theme CSS
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );
		wp_enqueue_style( 'font-awesome-min-css', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'media-query-css', get_template_directory_uri() . '/assets/css/hesta-media-query.css' );
		
		// Enqueue JS for theme 
		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'bootstrap-min-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js' );
		wp_enqueue_script( 'owl-carousel-min-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js' );
		
		wp_enqueue_script( 'hesta-theme-script', get_template_directory_uri() . '/assets/js/hesta-theme-script.js' );
		

	}

	function hesta_register_sidebars() {
		/* Register the 'primary' sidebar. */
		register_sidebar(
			array(
				'id'            => 'sidebar-primary',
				'name'          => __( 'Primary Sidebar', 'hesta' ),
				'description'   => __( 'A sidebar for page and blog pages.', 'hesta' ),
				'before_widget' => '<div id="%1$s" class="single_sidebar_widget post_category_widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget_title">',
				'after_title'   => '</h4>',
			)
		);
		$hesta_widget = get_theme_mod( 'hesta_footer_column','3' );
		register_sidebar(
			array(
				'id'            => 'footer-widget',
				'name'          => __( 'Footer Widget Area', 'hesta' ),
				'description'   => __( 'Sidebar for footer.', 'hesta' ),
				'before_widget' => '<div id="%1$s" class="col-md-'.esc_attr($hesta_widget).' footer-widget mb-3">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="heading-2">',
				'after_title'   => '</h2>',
			)
		);
	}
}
/* initialize class */
new hesta_core();