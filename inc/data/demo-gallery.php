<?php
/**
 * Demo Data for Love Family Alumni — Archives & Gallery Page
 *
 * Centralized static data repository for Task 01:
 * - Hero photographic content
 * - Heritage introduction & archival narrative
 * - Featured collections / album cards
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
		'eyebrow'       => 'OUR HERITAGE · OUR MEMORIES',
		'heading_main'  => 'Moments That Define',
		'heading_gold'  => 'Our Legacy.',
		'description'   => 'Preserving our shared history, celebrating meaningful connections, and honoring the memories that bring generations of Love Family alumni together.',
		'primary_cta'   => [
			'label' => 'Explore Gallery',
			'url'   => '#featured-collections',
		],
		'secondary_cta' => [
			'label' => 'Our Heritage',
			'url'   => '#gallery-heritage',
		],
		'cover_image'   => 'original-alumni-group.jpg',
		'status_pill'   => 'HISTORICAL ARCHIVE &amp; COMMUNITY GALLERY',
	],

	// Section 02: Our Heritage
	'heritage' => [
		'label'        => 'OUR HERITAGE',
		'heading'      => 'Every Generation Has a Story Worth Preserving.',
		'paragraphs'   => [
			'From the historic grounds of the University of Benin to thriving professional and community networks across North America, the Love Family journey spans decades of enduring faith, shared purpose, and generational brotherhood and sisterhood.',
			'This living archive stands as a tribute to the pioneers, leaders, and members whose devotion built the foundation we stand upon today. Every photograph in this collection captures not merely an event, but a chapter in a legacy that continues to inspire future generations.',
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
];
