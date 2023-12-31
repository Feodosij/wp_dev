<?php
/**
 * wp_dev functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp_dev
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_dev_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wp_dev, use a find and replace
		* to change 'wp_dev' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wp_dev', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'header-nav' => esc_html__( 'Primary', 'wp_dev' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wp_dev_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wp_dev_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_dev_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_dev_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_dev_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_dev_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wp_dev' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp_dev' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wp_dev_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_dev_scripts() {
	wp_enqueue_style( 'wp_dev-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wp_dev-style', 'rtl', 'replace' );
	wp_enqueue_style( 'wp_dev_main_style', get_template_directory_uri() . '/css/main.css', array() );

	wp_enqueue_script('jquery');

	wp_enqueue_script( 'wp_dev-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css' );

	
    wp_enqueue_script('ajax-filter', get_template_directory_uri() . '/js/ajax-filter.js', array('jquery'), '', true);
    wp_localize_script('ajax-filter', 'ajax_object', array(
		'ajax_url' => admin_url('admin-ajax.php'),
	));
	
}
add_action( 'wp_enqueue_scripts', 'wp_dev_scripts' );

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


/**
 ********************************************************** Wp_dev - my custom code 
 */

 function create_post_type_News() {
	register_post_type( 'news',
	array(
		'labels'      => array(
			'name'          => __('News'),
			'singular_name' => __('News'),
			'add_new' => __('Add News'),
		),
			'public'      => true,
			'has_archive' => true,
			'menu_position' => 5,
			'rewrite' => 'news',
			'menu_icon' => 'dashicons-star-filled',
			'supports' => array('title', 'editor', 'thumbnail', 'post-formats', 'excerpt'),	
		)
	);
}

add_action('init', 'create_post_type_News');

function create_news_taxonomy() {
    $labels = array(
        'name' => __('News Categories'),
        'singular_name' => __('News Category'),
    );

    register_taxonomy('news_category', 'news', array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
    ));

    wp_insert_term('Politics', 'news_category');
    wp_insert_term('Technology', 'news_category');
    wp_insert_term('Science', 'news_category');
    wp_insert_term('Sports', 'news_category');
    wp_insert_term('Culture', 'news_category');
}
add_action('init', 'create_news_taxonomy');





function filter_news() {
    $selected_categories = $_POST['news_categories'];

    $args = array(
        'post_type' => 'news',
        'posts_per_page' => 5,
    );

    if (!empty($selected_categories)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'news_category',
                'field' => 'term_id',
                'terms' => $selected_categories,
            ),
        );
    }

    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            ?>
            <div class="post_news">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php the_content(); ?>
            </div>
            <?php
        endwhile;
    else :
        echo '<p>No results found.</p>';
    endif;

    wp_reset_postdata();

    die();
}
add_action('wp_ajax_filter_news', 'filter_news');
add_action('wp_ajax_nopriv_filter_news', 'filter_news');
