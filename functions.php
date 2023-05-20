<?php
/**
 *TsvCountryMusic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TsvCountryMusic
 */

if ( ! defined( 'TSVCOUNTRYMUSIC_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'TSVCOUNTRYMUSIC_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tsvcountrymusic_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based onTsvCountryMusic, use a find and replace
		* to change 'tsvcountrymusic' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'tsvcountrymusic', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'tsvcountrymusic' ),
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
			'tsvcountrymusic_custom_background_args',
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

add_action( 'after_setup_theme', 'tsvcountrymusic_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tsvcountrymusic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tsvcountrymusic_content_width', 640 );
}

add_action( 'after_setup_theme', 'tsvcountrymusic_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tsvcountrymusic_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tsvcountrymusic' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tsvcountrymusic' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'tsvcountrymusic_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tsvcountrymusic_scripts() {
	wp_enqueue_style( 'tsvcountrymusic-style', get_stylesheet_uri(), array(), TSVCOUNTRYMUSIC_VERSION );
	wp_style_add_data( 'tsvcountrymusic-style', 'rtl', 'replace' );

	wp_enqueue_script( 'tsvcountrymusic-navigation', get_template_directory_uri() . '/js/navigation.js', array(), TSVCOUNTRYMUSIC_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'tsvcountrymusic_scripts' );

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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

function add_category_chooser() {
	global $post;
	if ( 'post-lister.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
		add_meta_box( 'category_chooser', 'Post list Template Category', "meta_box_callback", 'page', 'side' );
	}
}

add_action( 'add_meta_boxes', 'add_category_chooser' );

function meta_box_callback() {
	global $post;
	$field = 'chosen_category';
	?>
	<p>
		<?php $saved_chosen_category = get_post_meta( $post->ID, $field, true ) ?? null ?>
		<select name="<?php echo $field; ?>" id="post-list-category-select">
			<option value="" <?php echo $saved_chosen_category == null ? 'selected' : '' ?>>-- None</option>
			<?php
			foreach ( get_categories( '' ) as $category ) {
				echo '<option value="' . $category->name . '" '
					 . ( isset( $saved_chosen_category ) && $saved_chosen_category == $category->name ? 'selected>' : '>' )
					 . $category->name
					 . '</option>';
			}
			?>
		</select>
	</p>
	<?php
}

function save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$field = 'chosen_category';
	if ( isset( $_POST[ $field ] ) ) {
		update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
	}
}

add_action( 'save_post', 'save_meta_box' );
