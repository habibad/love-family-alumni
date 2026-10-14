<?php
/**
 * Static Demo Business Data Fixture
 *
 * Provides centralized demo data for the Love Family Alumni Business Directory.
 * All listings are marked as fictitious sample records for frontend testing.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve all demo businesses.
 *
 * @return array List of business associative arrays.
 */
function lfa_get_demo_businesses(): array {
	static $businesses = null;

	if ( null !== $businesses ) {
		return $businesses;
	}

	$json_file = get_template_directory() . '/inc/data/demo-businesses.json';

	if ( file_exists( $json_file ) ) {
		$content    = file_get_contents( $json_file );
		$businesses = json_decode( $content, true );
	}

	if ( ! is_array( $businesses ) ) {
		$businesses = [];
	}

	return $businesses;
}

/**
 * Retrieve the 8 standard business directory categories with icons.
 *
 * @return array Category metadata list.
 */
function lfa_get_business_categories(): array {
	return [
		[
			'id'    => 'technology-it',
			'name'  => 'Technology & IT',
			'icon'  => 'laptop',
			'count' => 12,
		],
		[
			'id'    => 'healthcare-wellness',
			'name'  => 'Healthcare & Wellness',
			'icon'  => 'heart-pulse',
			'count' => 9,
		],
		[
			'id'    => 'education-training',
			'name'  => 'Education & Training',
			'icon'  => 'graduation-cap',
			'count' => 8,
		],
		[
			'id'    => 'real-estate-construction',
			'name'  => 'Real Estate & Construction',
			'icon'  => 'building',
			'count' => 14,
		],
		[
			'id'    => 'finance-investment',
			'name'  => 'Finance & Investment',
			'icon'  => 'chart-line',
			'count' => 11,
		],
		[
			'id'    => 'consulting-professional',
			'name'  => 'Consulting & Professional',
			'icon'  => 'users',
			'count' => 15,
		],
		[
			'id'    => 'retail-ecommerce',
			'name'  => 'Retail & E-commerce',
			'icon'  => 'shopping-bag',
			'count' => 7,
		],
		[
			'id'    => 'travel-hospitality',
			'name'  => 'Travel & Hospitality',
			'icon'  => 'plane',
			'count' => 8,
		],
	];
}
