<?php
/**
 * Demo Data & Configuration for Love Family Alumni — Member Authentication & Registration
 *
 * Centralized static configuration for:
 * - Login split-panel content & brand highlights
 * - Registration 4-stage workflow configuration
 * - Countries, professions, and affiliations lists
 * - Membership tiers (Individual & Couple with official constraints)
 * - Privacy options & disclaimers
 * - Forgot password recovery copy
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	// Common Brand Details
	'brand' => [
		'name'          => 'Love Family Alumni',
		'zone'          => 'North America Zone',
		'tagline'       => 'One Family. Across Borders. Impacting Generations.',
		'logo_img'      => 'brand-logo-source.jpg',
		'crest_img'     => 'original-brand-emblem-source.jpg',
		'bg_photo'      => 'Warm Banquet Gathering with Navy Overlay.png',
		'home_url'      => home_url( '/' ),
		'login_url'     => home_url( '/member-login/' ),
		'register_url'  => home_url( '/member-register/' ),
		'forgot_url'    => home_url( '/forgot-password/' ),
		'membership_url'=> home_url( '/membership/' ),
	],

	// Screen 01: Member Login
	'login' => [
		'eyebrow'         => 'LOVE FAMILY ALUMNI — MEMBER PORTAL',
		'heading'         => 'Welcome Back to the Family.',
		'supporting_text' => 'Stay connected, manage your membership, and continue building our shared legacy across the United States and Canada.',
		'highlights'      => [
			[
				'icon'  => 'id-card',
				'title' => 'Alumni Identification',
				'desc'  => 'Access your verified digital alumni ID and chapter membership status.',
			],
			[
				'icon'  => 'connect',
				'title' => 'North America Directory',
				'desc'  => 'Search and connect with thousands of alumni across states and provinces.',
			],
			[
				'icon'  => 'calendar',
				'title' => '2027 Zonal Conference',
				'desc'  => 'Manage registrations, event schedules, and priority delegate access.',
			],
		],
		'form' => [
			'heading'      => 'Member Login',
			'subtitle'     => 'Enter your alumni credentials to access the secure member portal.',
			'demo_notice'  => 'Frontend Demonstration Preview — Backend authentication will be connected in Phase 02.',
		],
	],

	// Screen 02: Multi-Step Member Registration
	'registration' => [
		'eyebrow'         => 'ALUMNI MEMBERSHIP REGISTRATION',
		'heading'         => 'Join the North America Alumni Network',
		'supporting_text' => 'Complete the 4-step registration preview below to establish your official alumni presence.',
		'steps'           => [
			1 => [
				'id'    => 'personal',
				'num'   => '01',
				'title' => 'Personal Details',
				'desc'  => 'Your identity and direct contact information',
			],
			2 => [
				'id'    => 'alumni',
				'num'   => '02',
				'title' => 'Alumni Information',
				'desc'  => 'Your connection, profession, and background',
			],
			3 => [
				'id'    => 'membership',
				'num'   => '03',
				'title' => 'Membership Selection',
				'desc'  => 'Annual membership package and directory privacy',
			],
			4 => [
				'id'    => 'review',
				'num'   => '04',
				'title' => 'Review & Confirm',
				'desc'  => 'Review summary and static submission preview',
			],
		],
		'countries' => [
			'United States'  => 'United States',
			'Canada'         => 'Canada',
			'Nigeria'        => 'Nigeria',
			'United Kingdom' => 'United Kingdom',
			'Other'          => 'Other International Location',
		],
		'affiliations' => [
			'uniben_graduate' => 'Love Family / UNIBEN Alumnus / Alumna',
			'diaspora_member' => 'Love Family Diaspora Member (North America)',
			'former_fellowship'=> 'Former Campus Fellowship Executive / Member',
			'associate_member'=> 'Associate Member / Partner Household',
		],
		'professions' => [
			'Healthcare & Medicine'      => 'Healthcare & Medicine',
			'Software & Technology'      => 'Software & Technology',
			'Engineering & Energy'       => 'Engineering & Energy',
			'Finance, Banking & Audit'   => 'Finance, Banking & Accounting',
			'Law & Legal Practice'       => 'Law & Legal Practice',
			'Higher Education & Research'=> 'Higher Education & Research',
			'Business Management & Admin'=> 'Business Management & Consulting',
			'Real Estate & Construction' => 'Real Estate & Construction',
			'Ministry, NGO & Non-Profit' => 'Ministry, Non-Profit & Public Sector',
			'Arts, Media & Design'       => 'Arts, Media & Design',
			'Other Profession'           => 'Other Profession / Field',
		],
		'membership_tiers' => [
			'membership' => [
				'id'            => 'membership',
				'name'          => 'Annual Membership',
				'badge'         => 'Official Package',
				'target'        => 'For Love Family / UNIBEN alumni residing in North America.',
				'dues_summary'  => '$100 / Year',
				'dues_note'     => 'Annual membership dues ($100 annual contribution). Dues are payable after administrator account approval.',
				'features'      => [
					'Official digital Alumni ID verification',
					'Full North America Alumni Directory access',
					'Exclusive North America Business Directory access',
					'Eligibility for North America Zonal Conference registration',
					'Voting privileges in zonal assemblies',
				],
			],
		],
		'privacy_options' => [
			'public' => [
				'id'          => 'public',
				'name'        => 'Public Directory',
				'badge'       => 'Highest Visibility',
				'description' => 'Your profile summary (name, city, profession, chapter) will be visible in the public alumni directory.',
			],
			'members_only' => [
				'id'          => 'members_only',
				'name'        => 'Members Only',
				'badge'       => 'Recommended',
				'description' => 'Visible only to verified, logged-in alumni members. Hidden from external search engines and visitors.',
			],
			'private' => [
				'id'          => 'private',
				'name'        => 'Strictly Private',
				'badge'       => 'Confidential',
				'description' => 'Completely hidden from all directories. Only authorized executive administrators can access your records.',
			],
		],
	],

	// Screen 03: Forgot Password
	'forgot_password' => [
		'eyebrow'         => 'ACCOUNT RECOVERY',
		'heading'         => 'Reset Your Password',
		'supporting_text' => 'Enter the email address registered with your Love Family Alumni account. When backend services are activated, a secure reset link will be dispatched to your inbox.',
		'disclaimer'      => 'Demonstration Preview: Password recovery will become fully operational during backend integration. No reset emails or security tokens are generated during this frontend phase.',
	],
];
