<?php
/**
 * News & Announcements — Pagination Component
 *
 * Client-side interactive pagination controls for the news grid.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="lfa-news-pagination-wrap" class="lfa-news-pagination-wrapper">
	<nav class="lfa-news-pagination" aria-label="News articles navigation">
		<button type="button" 
		        id="lfa-news-page-prev" 
		        class="lfa-news-page-btn lfa-news-page-btn--arrow" 
		        aria-label="Previous news page" 
		        disabled>
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<polyline points="15 18 9 12 15 6"></polyline>
			</svg>
			<span>Previous</span>
		</button>

		<div id="lfa-news-page-numbers" class="lfa-news-page-numbers" role="navigation" aria-label="Page numbers">
			<!-- Populated dynamically by news.js (e.g. Page 1, Page 2) -->
			<button type="button" class="lfa-news-page-num is-active" aria-current="page" data-page="1">1</button>
			<button type="button" class="lfa-news-page-num" data-page="2">2</button>
		</div>

		<button type="button" 
		        id="lfa-news-page-next" 
		        class="lfa-news-page-btn lfa-news-page-btn--arrow" 
		        aria-label="Next news page">
			<span>Next</span>
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<polyline points="9 18 15 12 9 6"></polyline>
			</svg>
		</button>
	</nav>
</div>
