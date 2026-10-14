<?php
/**
 * Scholarships Task 03 — static FRONTEND sample data.
 * Illustrative participation ideas only; none are confirmed programs or services.
 * No recipient biographies, sponsors, award amounts, eligibility or deadlines are fabricated.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	'support_options' => [
		[
			'number'      => '01',
			'icon'        => 'mentorship',
			'eyebrow'     => 'SHARE EXPERTISE',
			'title'       => 'Guide & Mentor',
			'description' => 'An illustrative way alumni could share their experience, guidance, and professional insight with future learners.',
		],
		[
			'number'      => '02',
			'icon'        => 'opportunity',
			'eyebrow'     => 'OPEN DOORS',
			'title'       => 'Share Opportunities',
			'description' => 'A possible future channel for alumni to highlight verified educational resources, internships, and learning experiences.',
		],
		[
			'number'      => '03',
			'icon'        => 'support',
			'eyebrow'     => 'BUILD TOGETHER',
			'title'       => 'Explore Partnership',
			'description' => 'Learn how an official scholarship initiative might welcome support once arrangements are confirmed by the organization.',
		],
	],
	'faqs'            => [
		[
			'question' => 'Are scholarship applications open now?',
			'answer'   => 'No application opening has been confirmed for this website. The form shown above is a non-submitting frontend demonstration, not a live application.',
		],
		[
			'question' => 'Which scholarships are currently available?',
			'answer'   => 'The program cards on this page are illustrative examples. Official scholarship names, availability, and award information will appear only after confirmation by the organization.',
		],
		[
			'question' => 'Who can apply for a scholarship?',
			'answer'   => 'Eligibility has not yet been provided. When official opportunities are announced, their requirements and supporting documents must be published before accepting applications.',
		],
		[
			'question' => 'What are the application deadlines?',
			'answer'   => 'No verified application dates or deadlines have been supplied. Please do not rely on a sample program as an open call for applications.',
		],
		[
			'question' => 'Can I submit supporting documents or personal information?',
			'answer'   => 'Not at this stage. Document uploading, secure data storage, review, and submission confirmation are not enabled during frontend development.',
		],
		[
			'question' => 'How can alumni or partners get involved?',
			'answer'   => 'The participation ideas shown here are illustrative. Please contact the alumni organization through its verified contact channel for information on any officially available partnership opportunities.',
		],
	],
];
