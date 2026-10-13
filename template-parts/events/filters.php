<?php
/**
 * Events Page — Section 03: Search & Event Filters
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = lfa_get_event_categories();
?>

<section class="events-filters-section" id="events-browse" aria-label="Browse and Filter Events">
	<div class="lfa-container">
		
		<div class="events-filters-header text-center">
			<span class="events-section-eyebrow">EXPLORE EVENTS</span>
			<h2 class="events-section-title">Gather. Celebrate. Make an Impact.</h2>
			<div class="events-title-divider" aria-hidden="true"></div>
			<p class="events-section-lead">
				Discover upcoming community assemblies, chapter dinners, and meaningful archive reunions across our North America Zone.
			</p>
		</div>

		<div class="events-filter-card">
			<form id="events-filter-form" class="events-filter-form" role="search" onsubmit="return false;">
				
				<!-- Row 1: Category Filter Chips -->
				<div class="category-chips-wrapper" role="tablist" aria-label="Filter events by category">
					<?php foreach ( $categories as $slug => $label ) : ?>
						<button type="button" 
						        class="category-chip-btn <?php echo ( 'all' === $slug ) ? 'active' : ''; ?>" 
						        data-category="<?php echo esc_attr( $slug ); ?>"
						        role="tab"
						        aria-selected="<?php echo ( 'all' === $slug ) ? 'true' : 'false'; ?>">
							<?php echo esc_html( $label ); ?>
						</button>
					<?php endforeach; ?>
				</div>

				<!-- Row 2: Search Input & Controls -->
				<div class="events-controls-row">
					
					<!-- Search Input -->
					<div class="events-search-group">
						<span class="search-icon" aria-hidden="true">
							<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="11" cy="11" r="8"></circle>
								<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
							</svg>
						</span>
						<label for="events-search-input" class="screen-reader-text">Search events by title, city, or topic</label>
						<input type="text" 
						       id="events-search-input" 
						       name="keyword" 
						       class="form-control events-search-control" 
						       placeholder="Search events by title, city, or topic..." 
						       autocomplete="off">
					</div>

					<!-- Period Selector (Upcoming vs Past) -->
					<div class="events-select-group">
						<label for="events-period-select" class="screen-reader-text">Filter by period</label>
						<div class="select-wrapper">
							<select id="events-period-select" name="period" class="form-select events-select">
								<option value="all" selected>All Periods</option>
								<option value="upcoming">Upcoming Events</option>
								<option value="past">Past Gatherings</option>
							</select>
							<span class="select-chevron" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</div>
					</div>

					<!-- Sort Selector -->
					<div class="events-select-group">
						<label for="events-sort-select" class="screen-reader-text">Sort events</label>
						<div class="select-wrapper">
							<select id="events-sort-select" name="sort" class="form-select events-select">
								<option value="default">Sort: Default</option>
								<option value="title_asc">Title: A to Z</option>
								<option value="title_desc">Title: Z to A</option>
							</select>
							<span class="select-chevron" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</div>
					</div>

					<!-- Reset Button -->
					<div class="events-reset-group">
						<button type="button" id="events-reset-btn" class="btn btn-outline-neutral events-reset-btn">
							<svg class="reset-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
							</svg>
							<span>Reset</span>
						</button>
					</div>

				</div>

			</form>
		</div>

	</div>
</section>
