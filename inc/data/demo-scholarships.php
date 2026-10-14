<?php
/**
 * Entirely fictional frontend demo fixtures. Not real scholarship offerings.
 * In backend phase this data source will be replaced with verified WP content.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	[
		'id'          => 'demo-edu',
		'label'       => 'ACADEMIC SUPPORT',
		'title'       => 'Education Access',
		'description' => 'An illustrative program concept focused on supporting educational opportunity and student development.',
		'number'      => '01',
		'tone'        => 'navy',
		'status'      => 'Program details pending confirmation',
		'eligibility' => 'Eligibility requirements have not been provided by the organization.',
		'deadline'    => 'Application dates: To be announced',
	],
	[
		'id'          => 'demo-leaders',
		'label'       => 'LEADERSHIP & SERVICE',
		'title'       => 'Future Leaders',
		'description' => 'An illustrative concept recognizing leadership, service, and a commitment to community.',
		'number'      => '02',
		'tone'        => 'crimson',
		'status'      => 'Program details pending confirmation',
		'eligibility' => 'Eligibility requirements have not been provided by the organization.',
		'deadline'    => 'Application dates: To be announced',
	],
	[
		'id'          => 'demo-welfare',
		'label'       => 'STUDENT WELLBEING',
		'title'       => 'Student Support',
		'description' => 'An illustrative opportunity to help students access resources, encouragement, and community support.',
		'number'      => '03',
		'tone'        => 'gold',
		'status'      => 'Program details pending confirmation',
		'eligibility' => 'Eligibility requirements have not been provided by the organization.',
		'deadline'    => 'Application dates: To be announced',
	],
];
