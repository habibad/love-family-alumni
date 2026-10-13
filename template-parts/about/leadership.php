<?php
/**
 * About Page Section 07 — Leadership Preview
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="about-leadership-section" id="leadership" aria-label="Organizational Leadership">
	<div class="lfa-container about-leadership-container">
		<div class="about-leadership-card">
			<div class="about-leadership-grid">
				<!-- Col 1: President Portrait with Distinct Framing -->
				<div class="leadership-portrait-col">
					<div class="leadership-portrait-frame">
						<div class="portrait-corner-gold top-left" aria-hidden="true"></div>
						<div class="portrait-corner-gold bottom-right" aria-hidden="true"></div>
						<img src="<?php echo esc_url( lfa_image_url( 'president-portrait-office-chair.png' ) ); ?>" 
						     alt="Dr. Evans Akpo — Zonal President, Love Family Alumni North America Zone" 
						     class="leadership-president-img" 
						     loading="lazy">
					</div>
					<div class="leadership-nameplate">
						<h3 class="nameplate-name">Dr. Evans Akpo</h3>
						<span class="nameplate-title">Zonal President</span>
						<span class="nameplate-zone">Love Family Alumni — North America Zone</span>
					</div>
				</div>

				<!-- Col 2: Leadership Vision & Zonal Governance Structure -->
				<div class="leadership-content-col">
					<div class="leadership-eyebrow-wrap">
						<span class="section-eyebrow eyebrow-crimson">GOVERNANCE & STEWARDSHIP</span>
					</div>

					<h2 class="leadership-heading">
						Guided by Servant Leadership.<br>
						<span class="leadership-heading-sub">Dedicated to Generational Impact.</span>
					</h2>

					<p class="leadership-lead-text">
						The leadership of Love Family Alumni – North America Zone is grounded in the foundational biblical tenet that true leadership is servant stewardship.
					</p>

					<p class="leadership-body-text">
						Under the stewardship of Dr. Evans Akpo and the Zonal Executive Committee, our leadership team oversees continental chapter harmonization, membership welfare, scholarship endowments, annual conference planning, and regional alumni engagement across the USA and Canada.
					</p>

					<!-- Governance Structure Highlights -->
					<div class="leadership-pillars-preview">
						<div class="lead-pill-item">
							<span class="pill-dot" aria-hidden="true"></span>
							<div class="pill-text">
								<strong>Zonal Executive Council:</strong> Strategic policy, spiritual oversight & continental governance
							</div>
						</div>
						<div class="lead-pill-item">
							<span class="pill-dot" aria-hidden="true"></span>
							<div class="pill-text">
								<strong>Regional Chapter Leads:</strong> Local fellowship coordinators across major US & Canadian hubs
							</div>
						</div>
						<div class="lead-pill-item">
							<span class="pill-dot" aria-hidden="true"></span>
							<div class="pill-text">
								<strong>Functional Committees:</strong> Dedicated teams for Welfare, Scholarships, Conferences & Mentorship
							</div>
						</div>
					</div>

					<!-- Direct Call-to-Action to Leadership Page -->
					<div class="leadership-cta-wrap">
						<a href="<?php echo esc_url( home_url( '/leadership/' ) ); ?>" class="btn btn-leadership-primary">
							<span>Meet Our Full Executive Leadership</span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						</a>
						<span class="leadership-cta-note">Explore profiles of zonal executives & committee chairs</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
