<?php
/**
 * Demo Data for Love Family Alumni — Contact Us Page
 *
 * Centralized static data repository for frontend demonstration:
 * - Verified email & institutional contact details
 * - Hero content & anchor CTAs
 * - Quick contact cards & social links
 * - Inquiry options for contact form
 * - Community connection cards
 * - Verified FAQ items & answers
 * - Final CTA content
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	// Section 01: Hero Section
	'hero' => [
		'breadcrumbs' => [
			[ 'label' => 'Home', 'url' => home_url( '/' ) ],
			[ 'label' => 'Contact Us', 'url' => home_url( '/contact/' ) ],
		],
		'eyebrow'       => 'CONNECT WITH LOVE FAMILY',
		'heading_main'  => 'Every Connection',
		'heading_gold'  => 'Strengthens Our Family.',
		'description'   => "Have a question, an idea, or a story to share? We're here to connect, support, and grow together as one alumni community.",
		'primary_cta'   => [
			'label' => 'Send a Message',
			'url'   => '#contact-form',
		],
		'secondary_cta' => [
			'label' => 'Explore Membership',
			'url'   => home_url( '/membership/' ),
		],
		'cover_image'   => 'original-alumni-community-group.jpg',
		'status_badge'  => 'OFFICIAL COMMUNICATIONS · NORTH AMERICA ZONE',
	],

	// Section 02: Quick Contact Cards
	'quick_info' => [
		'eyebrow'     => 'REACH OUT TO US',
		'heading'     => "We're Here to Help You Connect.",
		'description' => 'Reach out to our leadership and administrative coordinators across North America through our official communication channels.',
		'cards'       => [
			[
				'id'          => 'email',
				'icon'        => 'mail',
				'title'       => 'Email Our Team',
				'value'       => 'lovefamilyalumni.na@gmail.com',
				'action_label'=> 'Send an Email',
				'action_url'  => 'mailto:lovefamilyalumni.na@gmail.com',
				'is_external' => false,
			],
			[
				'id'          => 'location',
				'icon'        => 'map-pin',
				'title'       => 'North America Zone',
				'value'       => 'Connecting Love Family alumni across North America and beyond.',
				'action_label'=> 'Alumni Directory',
				'action_url'  => home_url( '/directory/' ),
				'is_external' => false,
			],
			[
				'id'          => 'social',
				'icon'        => 'users',
				'title'       => 'Follow Our Community',
				'value'       => 'Stay connected with news, events, and important alumni updates.',
				'action_label'=> 'View Latest News',
				'action_url'  => home_url( '/news/' ),
				'is_external' => false,
			],
		],
		'social_links' => [
			[ 'name' => 'Facebook', 'url' => 'https://facebook.com', 'icon' => 'facebook' ],
			[ 'name' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => 'linkedin' ],
			[ 'name' => 'YouTube',  'url' => 'https://youtube.com',  'icon' => 'youtube' ],
		],
	],

	// Section 03: Main Contact Form
	'form_section' => [
		'heading'     => 'Start a Conversation With Us.',
		'description' => "Whether you're reconnecting with the alumni family, asking about membership, or exploring ways to contribute, we'd love to hear from you.",
		'info_panel'  => [
			'eyebrow'     => 'GET IN TOUCH',
			'heading'     => "Let's Keep the Conversation Going.",
			'body'        => "We welcome your inquiries, feedback, and stories. Reach out to our team and we'll ensure your message is directed to the right alumni representative.",
			'email'       => 'lovefamilyalumni.na@gmail.com',
			'region'      => 'North America Zone (USA & Canada)',
			'motto'       => 'One Family. Across Borders. Impacting Generations.',
		],
		'inquiry_types' => [
			'General Inquiry',
			'Membership Support',
			'Alumni Directory',
			'Events & Conferences',
			'Scholarships & Giving',
			'Business Directory',
			'Partnerships & Collaboration',
			'Other',
		],
		'notice' => 'This is a frontend preview. Messages are not being sent yet.',
	],

	// Section 04: Connect With Your Alumni Community
	'community_cards' => [
		'eyebrow' => 'MORE WAYS TO CONNECT',
		'heading' => 'Your Place in the Love Family Community.',
		'lead'    => 'Explore dedicated programs and initiatives designed to support our members at every stage of their alumni journey.',
		'cards'   => [
			[
				'title'       => 'Become a Member',
				'description' => 'Join the alumni network and stay connected with fellow members across regional chapters.',
				'cta_label'   => 'Explore Membership',
				'cta_url'     => home_url( '/membership/' ),
				'image'       => 'original-small-group.jpg',
				'tag'         => 'MEMBERSHIP',
			],
			[
				'title'       => 'Explore Alumni Events',
				'description' => 'Discover opportunities to reconnect, celebrate, and participate in conferences and meetups.',
				'cta_label'   => 'View Events',
				'cta_url'     => home_url( '/events/' ),
				'image'       => 'Warm Banquet Gathering with Navy Overlay.png',
				'tag'         => 'GATHERINGS',
			],
			[
				'title'       => 'Support Our Mission',
				'description' => 'Find ways to contribute to our shared legacy and support student scholarships and outreach.',
				'cta_label'   => 'Explore Giving',
				'cta_url'     => home_url( '/give/' ),
				'image'       => 'giving-heart.jpg',
				'tag'         => 'CONTRIBUTION',
			],
		],
	],

	// Section 05: Contact FAQs
	'faq' => [
		'eyebrow' => 'COMMON QUESTIONS',
		'heading' => 'A Few Things You Might Want to Know.',
		'lead'    => 'Find quick answers to common questions about connecting with the Love Family Alumni network.',
		'items'   => [
			[
				'question' => 'How can I join the Love Family Alumni community?',
				'answer'   => 'You can register through our Membership page to join the North America Zone network. Registered members receive invitations to regional gatherings, newsletters, and access to the Alumni Directory.',
				'link_url' => home_url( '/membership/' ),
				'link_text'=> 'Visit Membership Page &rarr;',
			],
			[
				'question' => 'How do I update my membership information?',
				'answer'   => 'Send an inquiry using the contact form above under "Membership Support" or email our administration team directly with your updated contact info, chapter, and graduation year.',
				'link_url' => 'mailto:lovefamilyalumni.na@gmail.com',
				'link_text'=> 'Email Member Support &rarr;',
			],
			[
				'question' => 'Where can I find upcoming alumni events?',
				'answer'   => 'Visit our Events page and our 2027 Conference hub to explore scheduled reunions, webinars, chapter meetups, and national biennial gatherings.',
				'link_url' => home_url( '/events/' ),
				'link_text'=> 'View Upcoming Events &rarr;',
			],
			[
				'question' => 'How can I share news or an announcement?',
				'answer'   => 'We celebrate alumni milestones! You can submit announcements regarding career promotions, academic honors, weddings, or community service via our News team.',
				'link_url' => home_url( '/news/' ),
				'link_text'=> 'Visit News & Announcements &rarr;',
			],
			[
				'question' => 'How can I support alumni scholarships and initiatives?',
				'answer'   => 'You can explore our Give / Donations section to see how alumni contributions support student scholarships, mentorship programs, and community outreach projects.',
				'link_url' => home_url( '/give/' ),
				'link_text'=> 'Explore Giving Options &rarr;',
			],
			[
				'question' => 'How do I contact the North America Zone leadership?',
				'answer'   => 'You can view executive profiles on our Leadership page or send an inquiry via the form above by selecting "Partnerships & Collaboration" or "General Inquiry."',
				'link_url' => home_url( '/leadership/' ),
				'link_text'=> 'Meet Our Leadership &rarr;',
			],
		],
	],

	// Section 06: Final Contact CTA
	'final_cta' => [
		'eyebrow'     => 'ONE FAMILY. ONE CONNECTION.',
		'heading'     => "Let's Continue Building Our Legacy Together.",
		'description' => 'Every conversation is an opportunity to strengthen our community, share experiences, and create meaningful connections.',
		'primary_btn' => [
			'label' => 'Get in Touch',
			'url'   => '#contact-form',
		],
		'secondary_btn' => [
			'label' => 'Discover Our Story',
			'url'   => home_url( '/about/' ),
		],
	],
];
