<?php
/**
 * Demo Data for Love Family Alumni — Give / Donations Page
 *
 * Centralized static data repository for frontend demonstration.
 * No real financial or payment data is stored or processed.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	// Hero Content
	'hero' => [
		'breadcrumbs' => [
			[ 'label' => 'Home', 'url' => home_url( '/' ) ],
			[ 'label' => 'Give & Support', 'url' => home_url( '/give/' ) ],
		],
		'eyebrow'       => 'GIVE & SUPPORT —— LOVE FAMILY ALUMNI',
		'heading_main'  => 'Together, We Build',
		'heading_gold'  => 'A Lasting Legacy.',
		'description'   => 'Explore ways to support education, encourage alumni connections, and strengthen the community we share.',
		'primary_cta'   => [
			'label' => 'Explore Giving Options',
			'url'   => '#give-categories',
		],
		'secondary_cta' => [
			'label' => 'Our Shared Mission',
			'url'   => '#give-mission',
		],
		'disclaimer'    => 'Frontend demonstration — donations are not currently being collected.',
		'status_badge'  => '01 / COMMUNITY & LEGACY',
	],

	// Giving Mission Section
	'mission' => [
		'eyebrow'     => 'WHY WE GIVE',
		'heading_1'   => 'More Than Giving.',
		'heading_2'   => 'Growing Together.',
		'description' => 'Love Family Alumni brings people together around connection, service and a shared sense of purpose. This giving page will help members understand future opportunities to contribute once official programs are confirmed.',
		'pillars'     => [
			[
				'number' => '01',
				'title'  => 'Education',
			],
			[
				'number' => '02',
				'title'  => 'Community',
			],
			[
				'number' => '03',
				'title'  => 'Legacy',
			],
		],
	],

	// Ways to Give / Donation Categories
	'categories' => [
		[
			'id'          => 'education-scholarships',
			'number'      => '01',
			'title'       => 'Education & Scholarships',
			'description' => 'An illustrative opportunity to support learning and future generations.',
			'icon'        => 'scholarship',
			'is_active'   => false,
		],
		[
			'id'          => 'alumni-programs',
			'number'      => '02',
			'title'       => 'Alumni Programs',
			'description' => 'A sample giving category for connection, mentoring and alumni events.',
			'icon'        => 'users',
			'is_active'   => false,
		],
		[
			'id'          => 'community-outreach',
			'number'      => '03',
			'title'       => 'Community Outreach',
			'description' => 'A sample category for initiatives that bring our wider community together.',
			'icon'        => 'globe',
			'is_active'   => true, // Default active matching approved visual preview
		],
		[
			'id'          => 'general-support',
			'number'      => '04',
			'title'       => 'General Support',
			'description' => 'A sample unrestricted category pending organizational confirmation.',
			'icon'        => 'heart',
			'is_active'   => false,
		],
	],

	// Donation Preview Section
	'preview' => [
		'eyebrow'       => 'YOUR GIVING JOURNEY',
		'heading_main'  => 'Every Act of Support',
		'heading_gold'  => 'Starts Somewhere.',
		'description'   => 'See how future giving options might work. The controls on this page are a demonstration only; no donations are accepted or processed.',
		'steps'         => [
			'Choose a cause',
			'Choose an amount',
			'Review demo',
		],
		'demo_badge'    => 'INTERACTIVE DEMO',
		'notice_pill'   => 'NO PAYMENT',
		'card_title'    => 'Your Giving Preview',
		'amount_label'  => 'Choose a sample amount',
		'amount_unit'   => 'USD · illustrative',
		'preset_amounts' => [ 25, 50, 100, 250 ],
		'default_amount' => 50, // Default active matching approved visual preview
		'custom_label'  => 'Or try a custom demo amount',
		'custom_placeholder' => 'Enter custom amount',
		'cta_label'     => 'Review Demo Selection',
		'safety_notice' => 'Preview only. No payment gateway, personal data submission, transaction, receipt or stored donation record.',
	],
];
