<?php
/**
 * Love Family Alumni — Member Dashboard Demo Data
 * 
 * Centralized static demonstration data for the member dashboard.
 * NOT a live member record. No authentication or PII.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) && php_sapi_name() !== 'cli' ) {
	exit;
}

return [
	'member' => [
		'name'                 => 'Sample Alumni Member',
		'first_name'           => 'Sample',
		'initials'             => 'SA',
		'id'                   => 'LFA-DEMO-0001',
		'email'                => 'sample.member@example.com',
		'phone'                => 'Not provided',
		'city'                 => 'Demo City',
		'country'              => 'United States (sample)',
		'profession'           => 'Community Professional (sample)',
		'affiliation'          => 'Alumni details awaiting verification',
		'membership_type'      => 'Individual (demo)',
		'membership_status'    => 'Active (illustrative)',
		'directory_visibility' => 'Members Only (preview)',
	],
	'dues' => [
		'annual_amount' => 'To be confirmed',
		'status'        => 'Demo status — no payment connected',
		'next_due'      => 'Not confirmed',
		'history'       => [
			[
				'reference'   => 'DEMO-INV-001',
				'description' => 'Membership dues example',
				'date'        => 'Sample date',
				'amount'      => 'TBC',
				'status'      => 'Example only',
			],
			[
				'reference'   => 'DEMO-INV-002',
				'description' => 'Renewal record example',
				'date'        => 'Sample date',
				'amount'      => 'TBC',
				'status'      => 'Example only',
			],
		],
	],
	'conference' => [
		'title'        => '2027 Love Family Alumni Conference',
		'theme'        => 'THY KINGDOM COME — Matthew 6:10',
		'year'         => '2027',
		'date'         => 'To be announced',
		'venue'        => 'To be announced',
		'registration' => 'Registration not yet connected',
	],
	'businesses' => [
		[
			'title'    => 'Sample Consulting Studio',
			'category' => 'Consulting & Professional Services',
			'status'   => 'Demo draft',
		],
		[
			'title'    => 'Example Community Enterprise',
			'category' => 'Education & Training',
			'status'   => 'Demo pending review',
		],
	],
	'activity' => [
		[
			'icon'   => 'user',
			'title'  => 'Profile information preview',
			'detail' => 'Example member account activity',
		],
		[
			'icon'   => 'credit-card',
			'title'  => 'Membership dues preview',
			'detail' => 'No transaction or receipt exists',
		],
		[
			'icon'   => 'calendar',
			'title'  => 'Conference interest',
			'detail' => 'Registration is not open in this demo',
		],
	],
];
