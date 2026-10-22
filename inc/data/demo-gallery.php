<?php
/**
 * Demo Data for Love Family Alumni — Archives & Gallery Page
 * Comprehensive static data repository covering:
 * - Hero photographic content & heritage narrative
 * - Featured photo album collections
 * - Interactive chronological timeline (2021, 2024, 2025, 2026, 2027)
 * - Archived videos & conference recordings
 * - Historical documents, constitutions & meeting minutes
 * - Publications, conference programs & newsletters
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
			[ 'label' => 'Gallery & Archives', 'url' => home_url( '/gallery/' ) ],
		],
		'eyebrow'       => 'OUR HERITAGE · OUR MEMORIES · DIGITAL ARCHIVES',
		'heading_main'  => 'Moments That Define',
		'heading_gold'  => 'Our Legacy.',
		'description'   => 'Preserving our shared history, celebrating meaningful connections, and honoring the memories, documents, and recordings that bring generations of Love Family alumni together.',
		'primary_cta'   => [
			'label' => 'Explore Gallery & Documents',
			'url'   => '#gallery-media-archives',
		],
		'secondary_cta' => [
			'label' => 'Historical Timeline',
			'url'   => '#historical-timeline',
		],
		'cover_image'   => 'original-alumni-group.jpg',
		'status_pill'   => 'HISTORICAL ARCHIVE &amp; COMMUNITY REPOSITORY',
	],

	// Section 02: Our Heritage
	'heritage' => [
		'label'        => 'OUR HERITAGE',
		'heading'      => 'Every Generation Has a Story Worth Preserving.',
		'paragraphs'   => [
			'From the historic grounds of the University of Benin to thriving professional and community networks across North America, the Love Family journey spans decades of enduring faith, shared purpose, and generational brotherhood and sisterhood.',
			'This living archive stands as a tribute to the pioneers, leaders, and members whose devotion built the foundation we stand upon today. Every photograph, recording, and document in this collection captures not merely an event, but a chapter in a legacy that continues to inspire future generations.',
		],
		'image'        => 'original-women-community-group.jpg',
		'image_alt'    => 'Love Family Alumni members gathered in fellowship',
		'image_caption'=> 'Generations in fellowship — celebrating enduring bonds across borders.',
		'quote'        => 'One Family. Across borders. Impacting generations.',
	],

	// Section 03: Featured Collections (3 Album Cards)
	'featured_albums' => [
		[
			'id'          => 'heritage',
			'title'       => 'Heritage & Historical Moments',
			'category'    => 'Heritage & Milestones',
			'cover'       => 'original-alumni-group.jpg',
			'description' => 'Archival photographs documenting foundational gatherings, milestones, and the enduring legacy of Love Family alumni.',
			'link'        => '#featured-collections',
			'is_demo'     => true,
		],
		[
			'id'          => 'reunions',
			'title'       => 'Alumni Gatherings & Reunions',
			'category'    => 'Community & Fellowship',
			'cover'       => 'original-small-group.jpg',
			'description' => 'Cherished memories from annual regional meetups, fellowship dinners, and chapter connections across North America.',
			'link'        => '#featured-collections',
			'is_demo'     => true,
		],
		[
			'id'          => 'conferences',
			'title'       => 'Conferences & Community Events',
			'category'    => 'Conferences & Keynotes',
			'cover'       => 'omaha-podium-2025.jpg',
			'description' => 'Keynotes, leadership sessions, workshops, and celebratory banquet moments from recent national and regional conferences.',
			'link'        => '#featured-collections',
			'is_demo'     => true,
		],
	],

	// Section 04: Interactive Historical Timeline
	'timeline' => [
		[
			'year'     => '2021',
			'badge'    => 'Foundation',
			'title'    => 'North America Chapter Consolidation',
			'desc'     => 'Formal inauguration and structural consolidation of the Love Family Alumni in North America, establishing regional communication links and chapter coordination.',
			'location' => 'Continental Virtual Assembly',
		],
		[
			'year'     => '2024',
			'badge'    => 'Bylaws & Governance',
			'title'    => 'Ratification of Regional Constitution & $100 Dues',
			'desc'     => 'Adoption of official zonal governance articles, standardized annual dues ($100), digital member credentials, and structured welfare protocols.',
			'location' => 'Executive Plenary Assembly',
		],
		[
			'year'     => '2025',
			'badge'    => 'Education & Philanthropy',
			'title'    => 'Akpo Family Scholarship Endowment Launch',
			'desc'     => 'Establishment of the dedicated Akpo Family Scholarship endowment fund, providing university tuition support for high-achieving scholars.',
			'location' => 'Omaha Assembly & National Gathering',
		],
		[
			'year'     => '2026',
			'badge'    => 'Digital Modernization',
			'title'    => 'Application Portals & Directory Launch',
			'desc'     => 'Launch of the independent Member Dashboard and Admin Control Center, digital business registry, and pre-conference mobilization.',
			'location' => 'North America Zone',
		],
		[
			'year'     => '2027',
			'badge'    => 'Biennial Flagship',
			'title'    => '2027 Continental Conference: “Thy Kingdom Come”',
			'desc'     => 'September 16–19, 2027: Landmark gathering under Matthew 6:10 with Keynote Speaker Dr. Uche Igbokwe (U.K.), uniting alumni for fellowship, worship, and generational legacy.',
			'location' => 'North America Host City (September 16–19, 2027)',
		],
	],

	// Section 05: Archived Videos
	'videos' => [
		[
			'id'       => 'vid-01',
			'title'    => '2025 Omaha Alumni Assembly & Keynote Excerpt',
			'duration' => '18:45',
			'speaker'  => 'Alumni Executive Council',
			'date'     => 'August 2025',
			'desc'     => 'Highlights of the presidential address, state of the fellowship, and generational testimonies.',
		],
		[
			'id'       => 'vid-02',
			'title'    => 'Love Family Worship Archive: Historic Campus Fellowship',
			'duration' => '24:10',
			'speaker'  => 'University Fellowship Choir & Alumni Voices',
			'date'     => 'Archival Recording',
			'desc'     => 'Cherished choral and worship moments preserved from historic university fellowship gatherings.',
		],
		[
			'id'       => 'vid-03',
			'title'    => 'Pre-Conference 2027 Mobilization Summit',
			'duration' => '12:30',
			'speaker'  => 'Zonal Planning Committee',
			'date'     => 'September 2026',
			'desc'     => 'Visionary overview of "Thy Kingdom Come" theme and continental preparations.',
		],
	],

	// Section 06: Historical Documents
	'documents' => [
		[
			'id'       => 'doc-01',
			'title'    => 'Constitution & Bylaws of The Love Family Alumni (North America Zone)',
			'pages'    => '28 Pages',
			'format'   => 'Official PDF',
			'date'     => 'Ratified 2024',
			'desc'     => 'The foundational charter defining membership rights, $100 annual dues, executive roles, and electoral procedures.',
		],
		[
			'id'       => 'doc-02',
			'title'    => 'Executive Meeting Minutes & Resolutions Archive',
			'pages'    => '14 Pages',
			'format'   => 'Archival PDF',
			'date'     => '2025–2026 Summary',
			'desc'     => 'Official Secretariat records detailing committee appointments, conference milestones, and scholarship resolutions.',
		],
		[
			'id'       => 'doc-03',
			'title'    => 'Akpo Family Scholarship Charter & Selection Guidelines',
			'pages'    => '8 Pages',
			'format'   => 'Governance PDF',
			'date'     => 'Endowed 2025',
			'desc'     => 'Eligibility criteria, academic GPA standards, transcript verification, and review committee protocols.',
		],
	],

	// Section 07: Publications & Newsletters
	'publications' => [
		[
			'id'       => 'pub-01',
			'title'    => 'The Legacy Bulletin &mdash; Annual Alumni Publication',
			'issue'    => 'Vol. IV, 2026 Edition',
			'format'   => 'Color Digital Publication',
			'desc'     => 'Feature interviews with pioneering alumni, chapter updates from Dallas, Houston, Atlanta, and Toronto, and professional spotlights.',
		],
		[
			'id'       => 'pub-02',
			'title'    => '2027 Conference Delegate Prospectus ("Thy Kingdom Come")',
			'issue'    => 'Preliminary Commemorative Edition',
			'format'   => 'Conference Brochure',
			'desc'     => 'Event overview, keynote profile of Dr. Uche Igbokwe (U.K.), schedule outline, and sponsorship tiers.',
		],
	],
];
