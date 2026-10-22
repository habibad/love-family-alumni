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

/**
 * Ensure essential theme pages (Member Auth & Dashboard) exist in WordPress
 */
function lfa_ensure_essential_pages(): void {
	// Guard against repetitive database operations on every request
	static $checked = false;
	if ( $checked ) {
		return;
	}
	$checked = true;

	$pages = [
		'member-login'     => [
			'title'    => 'Member Login',
			'template' => 'page-member-login.php',
		],
		'member-register'  => [
			'title'    => 'Member Registration',
			'template' => 'page-member-register.php',
		],
		'member-dashboard' => [
			'title'    => 'Member Dashboard',
			'template' => 'page-member-dashboard.php',
		],
		'forgot-password'  => [
			'title'    => 'Forgot Password',
			'template' => 'page-forgot-password.php',
		],
	];

	$needs_flush = false;

	foreach ( $pages as $slug => $info ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$page_id = wp_insert_post( [
				'post_title'   => $info['title'],
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			] );
			if ( ! is_wp_error( $page_id ) ) {
				update_post_meta( $page_id, '_wp_page_template', $info['template'] );
				$needs_flush = true;
			}
		} else {
			$current_template = get_post_meta( $page->ID, '_wp_page_template', true );
			if ( empty( $current_template ) || 'default' === $current_template ) {
				update_post_meta( $page->ID, '_wp_page_template', $info['template'] );
			}
		}
	}

	if ( $needs_flush ) {
		flush_rewrite_rules( false );
	}
}
add_action( 'after_switch_theme', 'lfa_ensure_essential_pages' );
add_action( 'init', 'lfa_ensure_essential_pages', 20 );
