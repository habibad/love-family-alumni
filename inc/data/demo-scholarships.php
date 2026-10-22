<?php
/**
 * Love Family Alumni — Scholarship Programs Data
 * Featuring the official Akpo Family Scholarship endowed program.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	[
		'id'          => 'akpo-family-scholarship',
		'label'       => 'OFFICIAL ENDOWED PROGRAM',
		'title'       => 'Akpo Family Scholarship',
		'subtitle'    => 'Academic Excellence & Christian Leadership Endowment',
		'description' => 'The official flagship scholarship established by the Akpo family to empower exceptional undergraduate and graduate scholars connected to the Love Family alumni community, university fellowships, and UNIBEN campus roots.',
		'number'      => '01',
		'tone'        => 'crimson',
		'status'      => 'Endowed Program · Annual Award Cycle',
		'eligibility' => 'Full-time students in accredited university programs (including UNIBEN) with minimum 3.5 / 5.0 GPA or Second Class Upper standing, demonstrating academic achievement and fellowship service.',
		'deadline'    => 'Annual Application Window: September 01 – October 31',
		'award_type'  => 'Tuition & Book Grant + Executive Alumni Mentorship',
		'is_flagship' => true,
	],
	[
		'id'          => 'demo-leaders',
		'label'       => 'LEADERSHIP & SERVICE',
		'title'       => 'Future Leaders Fellowship Grant',
		'subtitle'    => 'Community Impact & Fellowship Stewardship',
		'description' => 'A merit grant recognizing young leaders who demonstrate active service, Christian integrity, and community engagement within their campus or regional chapters.',
		'number'      => '02',
		'tone'        => 'navy',
		'status'      => 'Program details confirmed by committee',
		'eligibility' => 'Students actively participating in Christian fellowship, volunteer activities, or community service initiatives.',
		'deadline'    => 'Application cycle: Concurrently with Annual Conference',
		'award_type'  => 'Project Support & Leadership Development Subsidy',
		'is_flagship' => false,
	],
	[
		'id'          => 'demo-welfare',
		'label'       => 'STUDENT WELLBEING & ACCESS',
		'title'       => 'Alumni Student Welfare Grant',
		'subtitle'    => 'Hardship Support & Study Continuation',
		'description' => 'Targeted emergency educational resource grants providing relief for students facing unforeseen economic hardships during their degree progression.',
		'number'      => '03',
		'tone'        => 'gold',
		'status'      => 'Discretionary Review by Welfare Desk',
		'eligibility' => 'Alumni descendants and verified fellowship students in need of emergency academic fee support.',
		'deadline'    => 'Rolling quarterly reviews',
		'award_type'  => 'Direct Academic Assistance Grant',
		'is_flagship' => false,
	],
];
