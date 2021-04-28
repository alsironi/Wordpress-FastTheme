<?php

// ------------ DISABLE JQUERY ------------

function afz_disable_jquery(){
    wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts', 'afz_disable_jquery');

// ------------ STYLES AND SCRIPTS ------------

// Register scripts/styles. They can be optionally enqueued later on
function afz_register_scripts_and_styles(){
	
	// Register Bootstrap CSS
	wp_register_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css');

	// Register Popper JS for Bootstrap
	wp_register_script( 'popper-js', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');

	// Register Bootstrap JS
	wp_register_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js', array('popper-js'));

	// Register flatpickr (vanilla JS amazing datepicker)
	wp_register_script( 'flatpickr-js', 'https://cdn.jsdelivr.net/npm/flatpickr');
	wp_register_style( 'flatpickr-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');

}
add_action( 'wp_loaded', 'afz_register_scripts_and_styles' );

// Enqueue scripts/styles where we need them
function afz_enqueue_scripts_and_styles(){

	// Enqueue Bootstrap CSS
	wp_enqueue_style('bootstrap-css');
	wp_enqueue_script('bootstrap-js');


}
add_action( 'wp_enqueue_scripts', 'afz_enqueue_scripts_and_styles', 99 );

// ------------ IMAGES ------------

// Add thumbs support
add_theme_support( 'post-thumbnails', array( 'post' ) );


// ------------ HEAD ------------

// Head tags
if (!function_exists('head_tags')){
function head_tags(){

	// Default content
	$page_title=get_bloginfo( 'name' );
	$page_description=get_bloginfo( 'description' );
	$page_url=get_bloginfo( 'url' );
	$featured_image='';

	// Prepare specific content
	if( is_single() || is_page() ) {

		$post_id = get_queried_object_id();
		$page_url = get_permalink($post_id);
		$page_title = get_the_title($post_id);
		$page_description = wp_trim_words( get_post_field('post_content', $post_id), 25 );
		$featured_image = get_the_post_thumbnail_url($post_id);

	}

	// If normal posts category
	if( is_category() ){

		$category = get_queried_object();
		$page_title = $category->name;
		$page_description = category_description();

	}



	// Print tags
	echo '<title>'.$page_title.'</title>
	<meta name="description" content="' . strip_tags($page_description) . '">
	<meta property="og:locale" content="es" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="' . strip_tags($page_title) . '" />
	<meta property="og:description" content="' . strip_tags($page_description) . '" />
	<meta property="og:url" content="' . esc_url($page_url) . '" />
	<meta property="og:image" content="' . esc_url($featured_image) . '" />
	<meta property="og:site_name" content="'. get_bloginfo( 'name' ) . '" />';
}
}


// Avoid replacing stuff
add_filter('run_wptexturize', '__return_false');