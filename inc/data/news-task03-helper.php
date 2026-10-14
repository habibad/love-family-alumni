<?php
/**
 * News & Announcements — Task 03 Data Adapter Helper
 *
 * Integrates with canonical Task 02 demo news fixtures and provides
 * single story retrieval, related stories calculation, and URL generation.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lfa_news_task03_records' ) ) {
	/**
	 * Retrieve the canonical 12 demo news records.
	 *
	 * @return array
	 */
	function lfa_news_task03_records(): array {
		if ( function_exists( 'lfa_get_demo_news' ) ) {
			$records = lfa_get_demo_news();
			if ( is_array( $records ) ) {
				return isset( $records['items'] ) && is_array( $records['items'] ) ? $records['items'] : $records;
			}
		}

		$theme = get_template_directory();
		$paths = [
			$theme . '/inc/data/demo-news.json',
			$theme . '/assets/data/demo-news.json',
			$theme . '/data/demo-news.json',
		];

		foreach ( $paths as $path ) {
			if ( file_exists( $path ) && is_readable( $path ) ) {
				$decoded = json_decode( (string) file_get_contents( $path ), true );
				if ( is_array( $decoded ) && isset( $decoded['items'] ) && is_array( $decoded['items'] ) ) {
					return $decoded['items'];
				}
			}
		}

		return [];
	}
}

if ( ! function_exists( 'lfa_news_task03_find' ) ) {
	/**
	 * Find a story by slug.
	 *
	 * @param string $slug Story slug.
	 * @return array|null Story data or null if not found.
	 */
	function lfa_news_task03_find( string $slug ): ?array {
		$clean_slug = sanitize_title( $slug );
		if ( '' === $clean_slug ) {
			return null;
		}

		foreach ( lfa_news_task03_records() as $story ) {
			if ( ! is_array( $story ) ) {
				continue;
			}
			if ( isset( $story['slug'] ) && sanitize_title( (string) $story['slug'] ) === $clean_slug ) {
				return $story;
			}
		}

		return null;
	}
}

if ( ! function_exists( 'lfa_news_task03_related' ) ) {
	/**
	 * Retrieve up to $limit related stories for the current story.
	 * Prioritizes matching categories, excludes current story.
	 *
	 * @param array $current Current story data.
	 * @param int   $limit   Number of related stories.
	 * @return array
	 */
	function lfa_news_task03_related( array $current, int $limit = 3 ): array {
		$current_slug = $current['slug'] ?? '';
		$current_cat  = $current['category'] ?? '';

		$candidates = array_values( array_filter(
			lfa_news_task03_records(),
			static function ( $item ) use ( $current_slug ) {
				return is_array( $item ) && ! empty( $item['slug'] ) && $item['slug'] !== $current_slug;
			}
		) );

		usort( $candidates, static function ( $a, $b ) use ( $current_cat ) {
			$match_a = ( ( $a['category'] ?? '' ) === $current_cat ) ? 0 : 1;
			$match_b = ( ( $b['category'] ?? '' ) === $current_cat ) ? 0 : 1;
			return $match_a <=> $match_b;
		} );

		return array_slice( $candidates, 0, max( 0, $limit ) );
	}
}

if ( ! function_exists( 'lfa_news_task03_detail_url' ) ) {
	/**
	 * Build canonical detail preview URL for a story slug.
	 *
	 * @param string $slug Story slug.
	 * @return string Full URL.
	 */
	function lfa_news_task03_detail_url( string $slug ): string {
		return add_query_arg( 'story', sanitize_title( $slug ), home_url( '/news-details/' ) );
	}
}
