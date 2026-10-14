<?php
/**
 * News & Announcements — Search & Filter Toolbar
 *
 * Provides client-side search, category filtering, sorting, and reset controls.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = function_exists( 'lfa_get_demo_news_categories' ) ? lfa_get_demo_news_categories() : [];
?>
<section class="lfa-news-toolbar-section" id="news-explorer" aria-label="News Search and Filters">
	<div class="lfa-container">
		<div class="lfa-news-filter-card">
			<form id="lfa-news-filter-form" class="lfa-news-filter-form" onsubmit="return false;" role="search" aria-label="Search alumni news">
				<div class="lfa-news-filter-grid">
					<!-- Keyword Search Field -->
					<div class="lfa-news-filter-group lfa-news-filter-group--search">
						<label for="lfa-news-search-input" class="lfa-news-filter-label">Search Stories</label>
						<div class="lfa-news-input-wrap">
							<svg class="lfa-news-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<circle cx="11" cy="11" r="8"></circle>
								<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
							</svg>
							<input type="search" 
							       id="lfa-news-search-input" 
							       class="lfa-news-input" 
							       placeholder="Search news, topics, keywords..." 
							       autocomplete="off"
							       aria-label="Search news stories">
						</div>
					</div>

					<!-- Category Dropdown -->
					<div class="lfa-news-filter-group lfa-news-filter-group--category">
						<label for="lfa-news-category-select" class="lfa-news-filter-label">Category</label>
						<div class="lfa-news-select-wrap">
							<select id="lfa-news-category-select" class="lfa-news-select" aria-label="Filter news by category">
								<option value="">All Categories</option>
								<?php foreach ( $categories as $cat ) : ?>
									<option value="<?php echo esc_attr( $cat ); ?>"><?php echo esc_html( $cat ); ?></option>
								<?php endforeach; ?>
							</select>
							<svg class="lfa-news-select-caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</div>
					</div>

					<!-- Sort Selector -->
					<div class="lfa-news-filter-group lfa-news-filter-group--sort">
						<label for="lfa-news-sort-select" class="lfa-news-filter-label">Sort By</label>
						<div class="lfa-news-select-wrap">
							<select id="lfa-news-sort-select" class="lfa-news-select" aria-label="Sort news stories">
								<option value="newest">Newest First</option>
								<option value="oldest">Oldest First</option>
							</select>
							<svg class="lfa-news-select-caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</div>
					</div>

					<!-- Actions: Search & Reset -->
					<div class="lfa-news-filter-group lfa-news-filter-group--actions">
						<span class="lfa-news-filter-label">&nbsp;</span>
						<div class="lfa-news-btn-cluster">
							<button type="button" id="lfa-news-search-btn" class="lfa-news-btn lfa-news-btn--primary">
								<span>Search</span>
							</button>
							<button type="button" id="lfa-news-reset-btn" class="lfa-news-btn lfa-news-btn--outline-navy" title="Clear search and reset filters">
								<span>Reset</span>
							</button>
						</div>
					</div>
				</div>

				<!-- Live Filter Results Status Bar -->
				<div class="lfa-news-filter-status" aria-live="polite">
					<div class="lfa-news-status-count">
						Showing <strong id="lfa-news-current-count">1–6</strong> of <strong id="lfa-news-total-count">12</strong> stories
					</div>
					<div id="lfa-news-active-tags" class="lfa-news-active-tags" style="display: none;">
						<!-- Dynamic filter pills populated by JS -->
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
