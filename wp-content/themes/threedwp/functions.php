<?php
/**
 * threedwp functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package threedwp
 */

if ( ! function_exists( 'threedwp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function threedwp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on threedwp, use a find and replace
	 * to change 'threedwp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'threedwp', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'threedwp' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'threedwp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'threedwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function threedwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'threedwp_content_width', 640 );
}
add_action( 'after_setup_theme', 'threedwp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function threedwp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'threedwp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'threedwp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function threedwp_scripts() {
	wp_enqueue_style( 'threedwp-style', get_stylesheet_uri() );

	wp_enqueue_script( 'threedwp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	

	wp_enqueue_script( 'threedwp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'threedwp_scripts' );


function app_scripts() {
	wp_enqueue_script( 'threedwp-threejs', get_template_directory_uri() . '/js/three.min.js', array(), '20120206', true );
	wp_enqueue_script( 'threedwp-renderer', get_template_directory_uri() . '/js/app-assets/CanvasRenderer.js', array(), '20120206', true );
	wp_enqueue_script( 'threedwp-projector', get_template_directory_uri() . '/js/app-assets/Projector.js', array(), '20120206', true );
	wp_enqueue_script( 'threedwp-detector', get_template_directory_uri() . '/js/app-assets/detector.js', array(), '20120206', true );
	wp_enqueue_script( 'threedwp-stats', get_template_directory_uri() . '/js/app-assets/stats.min.js', array(), '20120206', true );
	wp_enqueue_script( 'threedwp-appjs', get_template_directory_uri() . '/js/app.js', array(), '20120206', true );
	
}

add_action( 'wp_enqueue_scripts', 'app_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
