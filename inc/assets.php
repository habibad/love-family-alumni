<?php
/**
 * Enqueue scripts and styles
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lfa_enqueue_assets(): void {
	// Google Fonts: Playfair Display (Serif display), Inter (Sans-serif UI), Caveat (Script)
	wp_enqueue_style(
		'lfa-google-fonts',
		'https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Inter:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&display=swap',
		[],
		null
	);

	// Main stylesheet
	wp_enqueue_style(
		'lfa-main-style',
		get_template_directory_uri() . '/assets/css/main.css',
		[ 'lfa-google-fonts' ],
		filemtime( get_template_directory() . '/assets/css/main.css' )
	);

	// Theme style.css for metadata/fallbacks
	wp_enqueue_style(
		'lfa-theme-style',
		get_stylesheet_uri(),
		[ 'lfa-main-style' ],
		filemtime( get_template_directory() . '/style.css' )
	);

	// About Us Page Scoped Stylesheet (Phase 02)
	if ( is_page( 'about' ) || is_page_template( 'templates/pages/page-about.php' ) || is_page_template( 'page-about.php' ) ) {
		wp_enqueue_style(
			'lfa-about-style',
			get_template_directory_uri() . '/assets/css/about.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/about.css' ) ? filemtime( get_template_directory() . '/assets/css/about.css' ) : '1.0.0'
		);
	}

	// Main frontend JavaScript
	wp_enqueue_script(
		'lfa-main-js',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		filemtime( get_template_directory() . '/assets/js/main.js' ),
		true
	);

	// Localize script data if needed
	wp_localize_script(
		'lfa-main-js',
		'lfaData',
		[
			'homeUrl' => home_url( '/' ),
			'themeUrl' => get_template_directory_uri(),
		]
	);
}
add_action( 'wp_enqueue_scripts', 'lfa_enqueue_assets' );
