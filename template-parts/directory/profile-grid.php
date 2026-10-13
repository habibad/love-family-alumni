<?php
/**
 * Alumni Directory — Profile Grid & Results Toolbar Component
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$profiles = lfa_get_demo_alumni_profiles();
$total_count = count( $profiles );
?>

<section class="directory-grid-section" id="directory-profiles" aria-label="Alumni Profiles">
	<div class="lfa-container">
		
		<!-- Results Toolbar: Counter & View Mode Toggles -->
		<div class="directory-results-toolbar">
			<div class="results-count-wrapper">
				<span class="results-count-text">
					Showing <strong class="results-current-range">1 &ndash; <?php echo esc_html( $total_count ); ?></strong> of <strong class="results-total-count">245</strong> alumni
				</span>
			</div>

			<div class="results-view-toggles" role="group" aria-label="View layout options">
				<button type="button" class="view-toggle-btn active" data-view="grid" aria-label="Grid view" title="Grid view">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
						<rect x="3" y="3" width="7" height="7" rx="1"></rect>
						<rect x="14" y="3" width="7" height="7" rx="1"></rect>
						<rect x="14" y="14" width="7" height="7" rx="1"></rect>
						<rect x="3" y="14" width="7" height="7" rx="1"></rect>
					</svg>
				</button>
				<button type="button" class="view-toggle-btn" data-view="list" aria-label="List view" title="List view">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
						<line x1="8" y1="6" x2="21" y2="6"></line>
						<line x1="8" y1="12" x2="21" y2="12"></line>
						<line x1="8" y1="18" x2="21" y2="18"></line>
						<line x1="3" y1="6" x2="3.01" y2="6"></line>
						<line x1="3" y1="12" x2="3.01" y2="12"></line>
						<line x1="3" y1="18" x2="3.01" y2="18"></line>
					</svg>
				</button>
			</div>
		</div>

		<!-- 4-Column Profiles Grid -->
		<div class="directory-profiles-grid" id="directory-profiles-grid">
			<?php foreach ( $profiles as $profile ) : ?>
				<?php
				get_template_part(
					'template-parts/directory/profile-card',
					null,
					[ 'profile' => $profile ]
				);
				?>
			<?php endforeach; ?>
		</div>

		<!-- Empty State (Shown via JS when no matches found) -->
		<div class="directory-empty-state" id="directory-empty-state" style="display: none;">
			<div class="empty-state-icon">
				<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
					<circle cx="11" cy="11" r="8"></circle>
					<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
					<line x1="8" y1="11" x2="14" y2="11"></line>
				</svg>
			</div>
			<h4 class="empty-state-title">No Alumni Profiles Found</h4>
			<p class="empty-state-text">No alumni match your current search criteria. Try resetting your filters to explore all community members.</p>
			<button type="button" class="btn btn-outline-navy empty-reset-trigger">Reset All Filters</button>
		</div>

		<!-- Pagination Strip -->
		<div class="directory-pagination-wrapper" aria-label="Directory pagination">
			<nav class="directory-pagination">
				<a href="#prev" class="pagination-arrow pagination-prev" aria-label="Previous page">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
						<polyline points="15 18 9 12 15 6"></polyline>
					</svg>
				</a>
				<span class="pagination-item pagination-active" aria-current="page">1</span>
				<a href="#page-2" class="pagination-item">2</a>
				<a href="#page-3" class="pagination-item">3</a>
				<a href="#page-4" class="pagination-item">4</a>
				<a href="#page-5" class="pagination-item">5</a>
				<span class="pagination-item pagination-ellipsis">&hellip;</span>
				<a href="#page-21" class="pagination-item">21</a>
				<a href="#next" class="pagination-arrow pagination-next" aria-label="Next page">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
						<polyline points="9 18 15 12 9 6"></polyline>
					</svg>
				</a>
			</nav>
		</div>

	</div>
</section>
