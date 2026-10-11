<?php
/**
 * Theme Setup
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lfa_theme_setup(): void {
	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable featured images
	add_theme_support( 'post-thumbnails' );

	// HTML5 markup support
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	// Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Custom logo support
	add_theme_support(
		'custom-logo',
		[
			'height'      => 80,
			'width'       => 280,
			'flex-width'  => true,
			'flex-height' => true,
		]
	);

	// Navigation menus
	register_nav_menus(
		[
			'primary'     => __( 'Primary Navigation', 'love-family-theme' ),
			'utility'     => __( 'Top Utility Bar', 'love-family-theme' ),
			'footer_nav'  => __( 'Footer Quick Links', 'love-family-theme' ),
			'footer_sub'  => __( 'Footer Secondary Links', 'love-family-theme' ),
		]
	);

	// Image sizes
	add_image_size( 'lfa-hero', 1920, 800, true );
	add_image_size( 'lfa-gallery', 600, 450, true );
	add_image_size( 'lfa-portrait', 700, 850, true );
	add_image_size( 'lfa-card', 400, 260, true );
}
add_action( 'after_setup_theme', 'lfa_theme_setup' );
