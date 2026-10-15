<?php
/**
 * Events Page Demo Data & Fixtures (Phase 02 / Page 05)
 *
 * NOTE: All upcoming items reflect verified briefing facts (e.g. 2027 Conference theme);
 * unconfirmed dates/venues are explicitly labeled "To Be Announced".
 * Historical items reflect genuine archive material (Omaha 2025, reunions).
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get event category filter list.
 *
 * @return array
 */
function lfa_get_event_categories(): array {
	return [
		'all'        => 'All Events',
		'conference' => 'Conferences',
		'reunion'    => 'Reunions',
		'community'  => 'Community',
		'service'    => 'Service & Impact',
		'virtual'    => 'Virtual Fellowship',
	];
}

/**
 * Get centralized events dataset.
 *
 * @return array
 */
function lfa_get_events_list(): array {
	return [
		[
			'id'          => 'event-01',
			'title'       => '2027 Alumni National Conference',
			'category'    => 'conference',
			'category_label' => 'Conference',
			'period'      => 'upcoming',
			'status_badge'=> 'Upcoming · Date Pending',
			'date_label'  => 'Year 2027 (Date TBA)',
			'theme'       => 'THY KINGDOM COME — Matthew 6:10',
			'location'    => 'North America Zone (Venue TBA)',
			'summary'     => 'The flagship continental gathering uniting The Love Family Alumni for fellowship, inspirational sessions, leadership renewal, and strategic community impact.',
			'image'       => 'conference-cinematic-bg.jpg',
			'action_label'=> 'View Conference Details',
			'action_url'  => home_url( '/conference/' ),
			'is_featured' => true,
		],
		[
			'id'          => 'event-02',
			'title'       => '2025 Omaha Alumni Reunion & Assembly',
			'category'    => 'reunion',
			'category_label' => 'Reunion Archive',
			'period'      => 'past',
			'status_badge'=> 'Archived Event',
			'date_label'  => 'July 2025',
			'theme'       => 'Faithful Generations',
			'location'    => 'Omaha, Nebraska',
			'summary'     => 'A celebrated gathering commemorating decades of shared Christian heritage, featuring keynote presentations, fellowship dinners, and alumni recognitions.',
			'image'       => 'omaha-podium-2025.jpg',
			'action_label'=> 'View Archive Highlights',
			'action_url'  => '#events-highlights',
			'is_featured' => false,
		],
		[
			'id'          => 'event-03',
			'title'       => 'Quarterly Alumni Virtual Prayer Fellowship',
			'category'    => 'virtual',
			'category_label' => 'Virtual Fellowship',
			'period'      => 'upcoming',
			'status_badge'=> 'Quarterly Series',
			'date_label'  => 'Quarterly Live Session',
			'theme'       => 'United in Prayer Across Borders',
			'location'    => 'Online via Zoom',
			'summary'     => 'An uplifting virtual gathering bringing alumni together across the US and Canada for corporate intercession, spiritual encouragement, and family support.',
			'image'       => 'hands-supporting-crop.jpg',
			'action_label'=> 'Register for Session',
			'action_url'  => home_url( '/contact/' ),
			'is_featured' => false,
		],
		[
			'id'          => 'event-04',
			'title'       => 'Regional Chapter Networking & Fellowship Dinner',
			'category'    => 'community',
			'category_label' => 'Community Gathering',
			'period'      => 'upcoming',
			'status_badge'=> 'Regional Assembly',
			'date_label'  => 'Regional Schedule',
			'theme'       => 'Connecting Across Generations',
			'location'    => 'Houston, TX & Regional Hubs',
			'summary'     => 'Local chapter networking dinners connecting alumni professionals, entrepreneurs, and families within regional metropolitan hubs.',
			'image'       => 'alumni-small-group.jpg',
			'action_label'=> 'Connect With Chapter',
			'action_url'  => home_url( '/membership/' ),
			'is_featured' => false,
		],
		[
			'id'          => 'event-05',
			'title'       => 'Diaspora Mentorship & Benevolence Drive',
			'category'    => 'service',
			'category_label' => 'Service & Impact',
			'period'      => 'upcoming',
			'status_badge'=> 'Annual Initiative',
			'date_label'  => 'Ongoing 2026–2027',
			'theme'       => 'Impacting Generations',
			'location'    => 'North America & Global Campus',
			'summary'     => 'Empowering younger scholars through academic mentorship, emergency benevolence support, and university scholarship sponsorships.',
			'image'       => 'giving-heart.jpg',
			'action_label'=> 'Explore Outreach',
			'action_url'  => home_url( '/scholarships/' ),
			'is_featured' => false,
		],
		[
			'id'          => 'event-06',
			'title'       => 'The Love Family Women Alumni Fellowship',
			'category'    => 'community',
			'category_label' => 'Women Fellowship',
			'period'      => 'past',
			'status_badge'=> 'Archive Highlights',
			'date_label'  => 'Past Gathering',
			'theme'       => 'Strength, Grace & Friendship',
			'location'    => 'Atlanta, GA & Regional Hosts',
			'summary'     => 'Dedicated sisterhood gatherings fostering deep friendships, mutual mentorship, and family values among The Love Family alumnae.',
			'image'       => 'GALLERY_APPROVED_GROUP_WOMEN.jpg',
			'action_label'=> 'View Photo Memories',
			'action_url'  => '#events-highlights',
			'is_featured' => false,
		],
	];
}
