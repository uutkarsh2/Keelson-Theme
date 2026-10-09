<?php
/**
 * =========================================================
 * KEELSON WORDPRESS THEME
 * functions.php
 * =========================================================
 */


/* =========================================================
 * 1. THEME SETUP
 * ========================================================= */

function keelson_theme_setup() {

	/**
	 * Let WordPress manage the <title> tag
	 */
	add_theme_support( 'title-tag' );


	/**
	 * Featured images
	 */
	add_theme_support( 'post-thumbnails' );


	/**
	 * Custom logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 250,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);


	/**
	 * HTML5 support
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


	/**
	 * Responsive embeds
	 */
	add_theme_support( 'responsive-embeds' );


	/**
	 * Editor styles
	 */
	add_theme_support( 'editor-styles' );


	/**
	 * WordPress menus
	 */
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'keelson' ),
			'footer'  => __( 'Footer Menu', 'keelson' ),
		)
	);
}

add_action(
	'after_setup_theme',
	'keelson_theme_setup'
);


/* =========================================================
 * 2. ENQUEUE CSS & JAVASCRIPT
 * ========================================================= */

function keelson_enqueue_assets() {

	/**
	 * Main stylesheet
	 */
	wp_enqueue_style(
		'keelson-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		'1.0.0'
	);


	/**
	 * Main JavaScript
	 */
	wp_enqueue_script(
		'keelson-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		'1.0.0',
		true
	);
}

add_action(
	'wp_enqueue_scripts',
	'keelson_enqueue_assets'
);


/* =========================================================
 * 3. IMAGE SIZES
 * ========================================================= */

function keelson_image_sizes() {

	/**
	 * Blog card image
	 */
	add_image_size(
		'keelson-blog-card',
		700,
		440,
		true
	);


	/**
	 * Blog featured image
	 */
	add_image_size(
		'keelson-blog-featured',
		1400,
		900,
		false
	);


	/**
	 * General card image
	 */
	add_image_size(
		'keelson-card',
		700,
		440,
		true
	);


	/**
	 * General large image
	 */
	add_image_size(
		'keelson-large',
		1400,
		900,
		false
	);
}

add_action(
	'after_setup_theme',
	'keelson_image_sizes'
);


/* =========================================================
 * 4. ACF OPTIONS PAGE
 * ========================================================= */

function keelson_acf_options_page() {

	/**
	 * Only run if ACF is available
	 */
	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_page(
			array(
				'page_title' => 'Keelson Settings',
				'menu_title' => 'Keelson Settings',
				'menu_slug'  => 'keelson-settings',
				'capability' => 'manage_options',
				'redirect'   => false,
			)
		);
	}
}

add_action(
	'acf/init',
	'keelson_acf_options_page'
);


/* =========================================================
 * 5. ACF JSON SAVE
 * ========================================================= */

function keelson_acf_json_save_path( $path ) {

	return get_stylesheet_directory() . '/acf-json';
}

add_filter(
	'acf/settings/save_json',
	'keelson_acf_json_save_path'
);


/* =========================================================
 * 6. ACF JSON LOAD
 * ========================================================= */

function keelson_acf_json_load_path( $paths ) {

	$paths[] = get_stylesheet_directory() . '/acf-json';

	return $paths;
}

add_filter(
	'acf/settings/load_json',
	'keelson_acf_json_load_path'
);


/* =========================================================
 * 7. EXCERPT LENGTH
 * ========================================================= */

function keelson_excerpt_length( $length ) {

	return 22;
}

add_filter(
	'excerpt_length',
	'keelson_excerpt_length'
);


/* =========================================================
 * 8. EXCERPT MORE
 * ========================================================= */

function keelson_excerpt_more( $more ) {

	return '...';
}

add_filter(
	'excerpt_more',
	'keelson_excerpt_more'
);


/* =========================================================
 * 9. BODY CLASS
 * ========================================================= */

function keelson_body_classes( $classes ) {

	/**
	 * Homepage
	 */
	if ( is_front_page() ) {
		$classes[] = 'keelson-home';
	}


	/**
	 * Pages
	 */
	if ( is_page() ) {
		$classes[] = 'keelson-page';
	}


	/**
	 * Single posts
	 */
	if ( is_single() ) {
		$classes[] = 'keelson-single';
	}


	/**
	 * Blog archive
	 */
	if ( is_home() ) {
		$classes[] = 'keelson-blog';
	}


	/**
	 * Search results
	 */
	if ( is_search() ) {
		$classes[] = 'keelson-search';
	}


	/**
	 * Archives
	 */
	if ( is_archive() ) {
		$classes[] = 'keelson-archive';
	}

	return $classes;
}

add_filter(
	'body_class',
	'keelson_body_classes'
);


/* =========================================================
 * 10. CUSTOM EDITOR STYLE
 * ========================================================= */

function keelson_editor_styles() {

	add_editor_style(
		'assets/css/main.css'
	);
}

add_action(
	'after_setup_theme',
	'keelson_editor_styles'
);


/* =========================================================
 * 11. PROJECTS CUSTOM POST TYPE
 * ========================================================= */

function keelson_register_projects_cpt() {

	$labels = array(

		'name' =>
			__( 'Projects', 'keelson' ),

		'singular_name' =>
			__( 'Project', 'keelson' ),

		'menu_name' =>
			__( 'Projects', 'keelson' ),

		'name_admin_bar' =>
			__( 'Project', 'keelson' ),

		'add_new' =>
			__( 'Add New', 'keelson' ),

		'add_new_item' =>
			__( 'Add New Project', 'keelson' ),

		'new_item' =>
			__( 'New Project', 'keelson' ),

		'edit_item' =>
			__( 'Edit Project', 'keelson' ),

		'view_item' =>
			__( 'View Project', 'keelson' ),

		'all_items' =>
			__( 'All Projects', 'keelson' ),

		'search_items' =>
			__( 'Search Projects', 'keelson' ),

		'not_found' =>
			__( 'No projects found.', 'keelson' ),

		'not_found_in_trash' =>
			__( 'No projects found in Trash.', 'keelson' ),
	);


	$args = array(

		'labels' =>
			$labels,

		'public' =>
			true,

		'show_ui' =>
			true,

		'show_in_menu' =>
			true,

		'show_in_rest' =>
			true,

		'menu_icon' =>
			'dashicons-portfolio',

		'supports' =>
			array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
			),

		'has_archive' =>
			true,

		'rewrite' =>
			array(
				'slug' => 'projects',
			),

		'publicly_queryable' =>
			true,
	);


	register_post_type(
		'project',
		$args
	);
}

add_action(
	'init',
	'keelson_register_projects_cpt'
);


/* =========================================================
 * 12. SERVICES CUSTOM POST TYPE
 * ========================================================= */

function keelson_register_services_cpt() {

	$labels = array(

		'name' =>
			__( 'Services', 'keelson' ),

		'singular_name' =>
			__( 'Service', 'keelson' ),

		'menu_name' =>
			__( 'Services', 'keelson' ),

		'name_admin_bar' =>
			__( 'Service', 'keelson' ),

		'add_new' =>
			__( 'Add New', 'keelson' ),

		'add_new_item' =>
			__( 'Add New Service', 'keelson' ),

		'new_item' =>
			__( 'New Service', 'keelson' ),

		'edit_item' =>
			__( 'Edit Service', 'keelson' ),

		'view_item' =>
			__( 'View Service', 'keelson' ),

		'all_items' =>
			__( 'All Services', 'keelson' ),

		'search_items' =>
			__( 'Search Services', 'keelson' ),

		'not_found' =>
			__( 'No services found.', 'keelson' ),

		'not_found_in_trash' =>
			__( 'No services found in Trash.', 'keelson' ),
	);


	$args = array(

		'labels' =>
			$labels,

		'public' =>
			true,

		'show_ui' =>
			true,

		'show_in_menu' =>
			true,

		'show_in_rest' =>
			true,

		'menu_icon' =>
			'dashicons-admin-tools',

		'supports' =>
			array(
				'title',
				'editor',
				'thumbnail',
			),

		'has_archive' =>
			true,

		'rewrite' =>
			array(
				'slug' => 'services',
			),

		'publicly_queryable' =>
			true,
	);


	register_post_type(
		'service',
		$args
	);
}

add_action(
	'init',
	'keelson_register_services_cpt'
);


/* =========================================================
 * 13. CUSTOM IMAGE SIZES IN MEDIA LIBRARY
 * ========================================================= */

function keelson_custom_image_sizes( $sizes ) {

	return array_merge(
		$sizes,
		array(
			'keelson-blog-card' =>
				__( 'Keelson Blog Card', 'keelson' ),

			'keelson-blog-featured' =>
				__( 'Keelson Blog Featured', 'keelson' ),

			'keelson-card' =>
				__( 'Keelson Card', 'keelson' ),

			'keelson-large' =>
				__( 'Keelson Large', 'keelson' ),
		)
	);
}

add_filter(
	'image_size_names_choose',
	'keelson_custom_image_sizes'
);


/* =========================================================
 * 14. REMOVE WORDPRESS GENERATOR META
 * ========================================================= */

remove_action(
	'wp_head',
	'wp_generator'
);


/* =========================================================
 * 15. SECURITY / CLEAN HEAD
 * ========================================================= */

remove_action(
	'wp_head',
	'rsd_link'
);

remove_action(
	'wp_head',
	'wlwmanifest_link'
);


/* =========================================================
 * 16. FOOTER WIDGET AREA
 * ========================================================= */

function keelson_register_widget_areas() {

	register_sidebar(
		array(
			'name' =>
				__( 'Footer Widget Area', 'keelson' ),

			'id' =>
				'footer-widget',

			'description' =>
				__( 'Widgets displayed in the footer.', 'keelson' ),

			'before_widget' =>
				'<div class="footer-widget">',

			'after_widget' =>
				'</div>',

			'before_title' =>
				'<h3>',

			'after_title' =>
				'</h3>',
		)
	);
}

add_action(
	'widgets_init',
	'keelson_register_widget_areas'
);


/* =========================================================
 * 17. PROJECT / SERVICE SUPPORT FOR REST API
 * ========================================================= */

function keelson_register_rest_fields() {

	/**
	 * Reserved for future custom REST fields.
	 *
	 * We are keeping this function here so the theme
	 * can be extended later without changing the
	 * existing structure.
	 */
}

add_action(
	'rest_api_init',
	'keelson_register_rest_fields'
);


add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {

    // Remove the default path
    $paths = array();

    // Add theme acf-json directory
    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
});


function keelson_register_faq_block() {

    if (function_exists('acf_register_block_type')) {

        acf_register_block_type(array(
            'name'            => 'faq-block',
            'title'           => __('FAQ Block', 'keelson'),
            'description'     => __('How We Work accordion block.', 'keelson'),
            'render_template' => 'template-parts/Faq-block.php',
            'category'        => 'widgets',
            'icon'            => 'editor-help',
            'keywords'        => array('faq', 'accordion', 'how we work'),
            'mode'            => 'edit',
            'supports'        => array(
                'align' => false,
                'jsx'   => false,
            ),
        ));

    }

}
add_action('acf/init', 'keelson_register_faq_block');