<?php
/**
 * Static Demo News & Announcements Data Fixture
 *
 * Provides centralized demo data for the Love Family Alumni Newsroom.
 * All records are synthetic sample notices for frontend testing.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve all demo news items.
 *
 * @return array List of news associative arrays.
 */
function lfa_get_demo_news(): array {
	static $news = null;

	if ( null !== $news ) {
		return $news;
	}

	$json_file = get_template_directory() . '/inc/data/demo-news.json';

	if ( file_exists( $json_file ) ) {
		$content = file_get_contents( $json_file );
		$data    = json_decode( $content, true );
		if ( isset( $data['items'] ) && is_array( $data['items'] ) ) {
			$news = $data['items'];
		}
	}

	if ( ! is_array( $news ) ) {
		$news = [];
	}

	return $news;
}

/**
 * Retrieve the featured news story for the hero/featured section.
 *
 * @return array Featured news story data.
 */
function lfa_get_featured_news(): array {
	$all = lfa_get_demo_news();

	if ( ! empty( $all ) ) {
		return $all[0];
	}

	return [
		'id'          => 1,
		'slug'        => 'demo-news-01',
		'title'       => '[Demo] Welcome to the Alumni Newsroom',
		'category'    => 'Announcements',
		'date'        => '2026-09-02',
		'excerpt'     => 'Overview of how this future newsroom will share updates, community milestones and verified alumni stories.',
		'body'        => 'This is a synthetic preview article for layout testing only. It is not an official Love Family Alumni announcement.',
		'image'       => null,
		'is_demo'     => true,
	];
}

/**
 * Find a demo news story by slug.
 *
 * @param string $slug Story slug.
 * @return array|null News story array or null if not found.
 */
function lfa_get_news_by_slug( string $slug ): ?array {
	$all = lfa_get_demo_news();
	foreach ( $all as $item ) {
		if ( isset( $item['slug'] ) && $item['slug'] === $slug ) {
			return $item;
		}
	}
	return null;
}

/**
 * Retrieve unique categories present in the demo dataset.
 *
 * @return array List of category strings.
 */
function lfa_get_demo_news_categories(): array {
	return [
		'Announcements',
		'Alumni Stories',
		'Achievements & Awards',
		'Professional Milestones',
		'Scholarships & Giving',
		'Conference Updates',
		'Community Celebrations',
		'Memorial Notices',
	];
}

/**
 * Map demo news stories to authentic project assets for realistic visual representation.
 *
 * @param string $slug Story slug.
 * @return string Full asset URL.
 */
function lfa_get_demo_news_image( string $slug ): string {
	$map = [
		'demo-news-01' => '/assets/images/original-alumni-community-group.jpg',
		'demo-news-02' => '/assets/images/GALLERY_APPROVED_GROUP_WOMEN.jpg',
		'demo-news-03' => '/assets/images/original-five-person-community.jpg',
		'demo-news-04' => '/assets/images/biz-prof-services.jpg',
		'demo-news-05' => '/assets/images/giving-heart.jpg',
		'demo-news-06' => '/assets/images/omaha-podium-2025.jpg',
		'demo-news-07' => '/assets/images/Warm Banquet Gathering with Navy Overlay.png',
		'demo-news-08' => '/assets/images/hands-supporting-crop.jpg',
		'demo-news-09' => '/assets/images/women-alumni-group.jpg',
		'demo-news-10' => '/assets/images/alumni-group-wide.jpg',
		'demo-news-11' => '/assets/images/GALLERY_APPROVED_LARGE_GROUP.jpg',
		'demo-news-12' => '/assets/images/scholarship-cap.jpg',
	];

	$rel = $map[ $slug ] ?? '/assets/images/original-alumni-group.jpg';
	return get_theme_file_uri( $rel );
}

