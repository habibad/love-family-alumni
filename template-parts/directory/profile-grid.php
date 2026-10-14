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
					Showing <strong class="results-current-range">1 &ndash; <?php echo esc_html( min( 8, $total_count ) ); ?></strong> of <strong class="results-total-count"><?php echo esc_html( $total_count ); ?></strong> alumni
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

	<!-- Alumni Profile Preview Modal -->
	<div class="directory-profile-modal-backdrop" id="directory-profile-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modal-profile-name">
		<div class="directory-profile-modal-card">
			<button type="button" class="modal-close-btn" id="modal-close-btn" aria-label="Close profile details">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</button>

			<div class="modal-profile-header">
				<div class="modal-profile-avatar-wrap">
					<img src="" alt="" class="modal-profile-avatar-img" id="modal-profile-avatar">
					<div class="modal-profile-avatar-fallback" id="modal-profile-fallback">
						<span id="modal-profile-initial">A</span>
					</div>
					<span class="modal-profile-badge" id="modal-profile-batch">Class of 2005</span>
				</div>

				<div class="modal-profile-header-info">
					<h3 class="modal-profile-name" id="modal-profile-name">Alumni Name</h3>
					<p class="modal-profile-title" id="modal-profile-title">Professional Title</p>
					<p class="modal-profile-company" id="modal-profile-company">Company</p>
				</div>
			</div>

			<div class="modal-profile-body">
				<div class="modal-meta-grid">
					<div class="modal-meta-cell">
						<span class="modal-meta-label">Location</span>
						<span class="modal-meta-val" id="modal-profile-location">City, Country</span>
					</div>
					<div class="modal-meta-cell">
						<span class="modal-meta-label">Industry</span>
						<span class="modal-meta-val" id="modal-profile-industry">Industry Sector</span>
					</div>
				</div>

				<div class="modal-bio-block">
					<h4 class="modal-block-title">About</h4>
					<p class="modal-bio-text" id="modal-profile-bio">Bio description...</p>
				</div>

				<div class="modal-privacy-notice">
					<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
						<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
					</svg>
					<span>Demonstration profile preview. Direct member communication requires verified alumni directory credentials.</span>
				</div>
			</div>

			<div class="modal-profile-footer">
				<a href="#" id="modal-profile-email" class="btn btn-crimson modal-action-btn">
					<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
						<polyline points="22,6 12,13 2,6"></polyline>
					</svg>
					<span>Send Message</span>
				</a>
				<a href="#" id="modal-profile-linkedin" target="_blank" rel="noopener noreferrer" class="btn btn-outline-neutral modal-action-btn">
					<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
						<path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37h2.79V10.9H6.46M7.86 6.54a1.63 1.63 0 0 0-1.63 1.63c0 .9.73 1.63 1.63 1.63.9 0 1.63-.73 1.63-1.63 0-.9-.73-1.63-1.63-1.63z"/>
					</svg>
					<span>LinkedIn</span>
				</a>
			</div>
		</div>
	</div>
</section>
