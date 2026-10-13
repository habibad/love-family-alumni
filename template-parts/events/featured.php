<?php
/**
 * Events Page — Section 02: Featured Event (2027 Conference)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$featured_img = lfa_image_url( 'conference-cinematic-bg.jpg' );
?>

<section class="events-featured-section" id="featured-conference" aria-label="Featured Event: 2027 Conference">
	<div class="lfa-container">
		
		<div class="featured-event-card">
			<div class="featured-event-grid">
				
				<!-- Media Column -->
				<div class="featured-media-col">
					<div class="featured-media-wrapper">
						<img src="<?php echo esc_url( $featured_img ); ?>" 
						     alt="2027 Conference Gathering Preview" 
						     class="featured-media-img" 
						     loading="lazy" 
						     decoding="async">
						<div class="featured-media-overlay" aria-hidden="true"></div>
						
						<div class="featured-media-badge">
							<span class="media-badge-icon" aria-hidden="true">&#9733;</span>
							<span class="media-badge-text">Continental Assembly</span>
						</div>

						<div class="featured-media-caption">
							<span class="media-caption-title">2027 Biennial Flagship</span>
							<span class="media-caption-sub">North America Zone</span>
						</div>
					</div>
				</div>

				<!-- Editorial Information Column -->
				<div class="featured-content-col">
					<div class="featured-content-inner">
						
						<div class="featured-tag-row">
							<span class="featured-pill-badge">FEATURED EVENT</span>
							<span class="featured-status-pill">Planning in Progress</span>
						</div>

						<h2 class="featured-event-title">2027 Conference</h2>

						<div class="featured-theme-box">
							<span class="theme-label">OFFICIAL THEME</span>
							<h3 class="theme-quote">&ldquo;THY KINGDOM COME&rdquo;</h3>
							<span class="theme-scripture">Matthew 6:10</span>
						</div>

						<p class="featured-event-desc">
							The flagship continental gathering uniting Love Family Alumni across the United States, Canada, and our global diaspora. Join fellow alumni for an inspiring weekend of fellowship, worship, leadership renewal, and collaborative impact.
						</p>

						<div class="featured-meta-grid">
							<div class="featured-meta-item">
								<svg class="meta-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
									<line x1="16" y1="2" x2="16" y2="6"></line>
									<line x1="8" y1="2" x2="8" y2="6"></line>
									<line x1="3" y1="10" x2="21" y2="10"></line>
								</svg>
								<div class="meta-text-wrap">
									<span class="meta-label">Date</span>
									<span class="meta-val meta-val-pending">To Be Announced</span>
								</div>
							</div>

							<div class="featured-meta-item">
								<svg class="meta-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
									<circle cx="12" cy="10" r="3"></circle>
								</svg>
								<div class="meta-text-wrap">
									<span class="meta-label">Venue</span>
									<span class="meta-val meta-val-pending">To Be Announced</span>
								</div>
							</div>
						</div>

						<div class="featured-actions-row">
							<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="btn btn-crimson featured-btn-cta">
								<span>View Conference Details</span>
								<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							</a>
							<span class="featured-notice-inline">Early registration notices will be published here upon ratification.</span>
						</div>

					</div>
				</div>

			</div>
		</div>

	</div>
</section>
