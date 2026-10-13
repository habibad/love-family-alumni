<?php
/**
 * Events Page — Section 05: Events Calendar & Upcoming Notice
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="events-calendar-section" id="events-calendar" aria-label="Events Calendar and Announcements">
	<div class="lfa-container">
		
		<div class="events-section-header text-center">
			<span class="events-section-eyebrow">CALENDAR &amp; SCHEDULE</span>
			<h2 class="events-section-title">Plan Your Fellowship Ahead</h2>
			<div class="events-title-divider" aria-hidden="true"></div>
			<p class="events-section-lead">
				Official dates and assembly venues are confirmed by executive leadership and published as finalized.
			</p>
		</div>

		<div class="calendar-layout-grid">
			
			<!-- Left Column: Interactive Month Calendar Preview -->
			<div class="calendar-widget-col">
				<div class="calendar-card">
					
					<!-- Calendar Header Controls -->
					<div class="calendar-header">
						<button type="button" class="calendar-nav-btn prev-month-btn" id="cal-prev-btn" aria-label="Previous month">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<polyline points="15 18 9 12 15 6"></polyline>
							</svg>
						</button>

						<div class="calendar-current-month" id="cal-month-title" aria-live="polite">
							<!-- Populated via JS e.g. "October 2026" -->
							<span class="cal-month-name">October</span>
							<span class="cal-year-num">2026</span>
						</div>

						<button type="button" class="calendar-nav-btn next-month-btn" id="cal-next-btn" aria-label="Next month">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<polyline points="9 18 15 12 9 6"></polyline>
							</svg>
						</button>
					</div>

					<!-- Days of the Week Bar -->
					<div class="calendar-weekdays-row" aria-hidden="true">
						<span>Su</span>
						<span>Mo</span>
						<span>Tu</span>
						<span>We</span>
						<span>Th</span>
						<span>Fr</span>
						<span>Sa</span>
					</div>

					<!-- Calendar Days Grid (Interactive JS) -->
					<div class="calendar-days-grid" id="cal-days-grid" role="grid" aria-label="Monthly Calendar Days">
						<!-- JavaScript populates day cells dynamically -->
					</div>

					<!-- Calendar Footer Note -->
					<div class="calendar-footer-note">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<circle cx="12" cy="12" r="10"></circle>
							<line x1="12" y1="16" x2="12" y2="12"></line>
							<line x1="12" y1="8" x2="12.01" y2="8"></line>
						</svg>
						<span>Dates are highlighted only upon verified executive confirmation.</span>
					</div>

				</div>
			</div>

			<!-- Right Column: Navy Official Notice Panel -->
			<div class="calendar-notice-col">
				<div class="notice-panel-card">
					
					<div class="notice-panel-header">
						<div class="notice-pill-badge">
							<span class="notice-badge-dot" aria-hidden="true"></span>
							<span>OFFICIAL BULLETIN</span>
						</div>
						<h3 class="notice-panel-title">Upcoming Event Schedule</h3>
					</div>

					<!-- Coming Soon Banner Box -->
					<div class="notice-status-box">
						<div class="status-box-icon" aria-hidden="true">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
								<line x1="16" y1="2" x2="16" y2="6"></line>
								<line x1="8" y1="2" x2="8" y2="6"></line>
								<line x1="3" y1="10" x2="21" y2="10"></line>
							</svg>
						</div>
						<div class="status-box-content">
							<h4 class="status-box-heading">Upcoming dates will be published once confirmed.</h4>
							<p class="status-box-text">
								The executive planning committee is actively finalizing the dates and continental venue for the 2027 Biennial Gathering.
							</p>
						</div>
					</div>

					<!-- Verified Facts List -->
					<div class="notice-info-list">
						<div class="notice-info-item">
							<div class="info-item-dot" aria-hidden="true"></div>
							<div class="info-item-text">
								<strong>2027 Biennial National Conference:</strong>
								<span>Theme verified as <em>&ldquo;THY KINGDOM COME&rdquo; (Matthew 6:10)</em>. Location and registration schedule pending announcement.</span>
							</div>
						</div>

						<div class="notice-info-item">
							<div class="info-item-dot" aria-hidden="true"></div>
							<div class="info-item-text">
								<strong>Quarterly Virtual Fellowships:</strong>
								<span>Quarterly online prayer assemblies are announced directly through official chapter communications.</span>
							</div>
						</div>

						<div class="notice-info-item">
							<div class="info-item-dot" aria-hidden="true"></div>
							<div class="info-item-text">
								<strong>Local Chapter Gatherings:</strong>
								<span>City-specific fellowship dinners in Houston, Dallas, Atlanta, and Canadian hubs are coordinated locally.</span>
							</div>
						</div>
					</div>

					<!-- Action Link in Notice -->
					<div class="notice-panel-footer">
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline-white notice-btn">
							<span>Inquire With Event Committee</span>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						</a>
					</div>

				</div>
			</div>

		</div>

	</div>
</section>
