<?php
/**
 * About Page Section 01 — Hero
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="about-hero-section" id="about-hero" aria-label="About Love Family Alumni">
	<!-- Atmospheric Background Image & Deep Navy Overlay -->
	<div class="about-hero-bg-layer" aria-hidden="true">
		<img src="<?php echo esc_url( lfa_image_url( 'cta-skyline-bg.jpg' ) ); ?>" 
		     alt="" 
		     class="about-hero-bg-img" 
		     loading="eager" 
		     decoding="async">
		<div class="about-hero-overlay"></div>
	</div>

	<div class="lfa-container about-hero-container">
		<div class="about-hero-grid">
			<!-- Left Column: Focused Editorial Content -->
			<div class="about-hero-content-col">
				<div class="about-hero-eyebrow-wrap">
					<span class="about-hero-badge-dot" aria-hidden="true"></span>
					<span class="about-hero-eyebrow">ABOUT THE LOVE FAMILY ALUMNI</span>
				</div>

				<h1 class="about-hero-title">
					One Family. Across Borders.<br>
					<span class="about-hero-title-accent">Impacting Generations.</span>
				</h1>

				<p class="about-hero-lead">
					Founded on an enduring foundation of Christian fellowship, mutual love, and academic excellence at the University of Benin, The Love Family Alumni has grown into an influential global network.
				</p>

				<p class="about-hero-desc">
					In the North America Zone, we unite alumni across the United States and Canada into a vibrant brotherhood and sisterhood—fostering lifelong community, advancing professional growth, supporting philanthropic higher education initiatives, and ensuring our generational legacy remains unbroken.
				</p>

				<div class="about-hero-actions">
					<a href="#our-story" class="btn btn-about-hero-primary">
						<span>Explore Our Story</span>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="12" y1="5" x2="12" y2="19"></line>
							<polyline points="19 12 12 19 5 12"></polyline>
						</svg>
					</a>
					<a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn btn-about-hero-secondary">
						<span>Membership Overview</span>
					</a>
				</div>

				<div class="about-hero-stats-row">
					<div class="about-hero-stat">
						<span class="stat-number">USA & CAN</span>
						<span class="stat-label">Zonal Footprint</span>
					</div>
					<div class="about-hero-stat-divider" aria-hidden="true"></div>
					<div class="about-hero-stat">
						<span class="stat-number">5 Pillars</span>
						<span class="stat-label">Core Values</span>
					</div>
					<div class="about-hero-stat-divider" aria-hidden="true"></div>
					<div class="about-hero-stat">
						<span class="stat-number">UNIBEN</span>
						<span class="stat-label">Foundational Roots</span>
					</div>
				</div>
			</div>

			<!-- Right Column: Visualized Community Artwork -->
			<div class="about-hero-visual-col">
				<div class="about-hero-image-card">
					<div class="about-hero-image-frame">
						<img src="<?php echo esc_url( lfa_image_url( 'alumni-group-wide.jpg' ) ); ?>" 
						     alt="Love Family Alumni community members united in fellowship" 
						     class="about-hero-main-img" 
						     loading="eager" 
						     decoding="async">
						<div class="about-hero-image-glass-gradient" aria-hidden="true"></div>
					</div>

					<!-- Floating Pill Badges -->
					<div class="about-hero-floating-badge badge-top-right">
						<span class="badge-icon">🏛️</span>
						<div class="badge-text">
							<span class="badge-title">University of Benin</span>
							<span class="badge-subtitle">Shared Alma Mater Heritage</span>
						</div>
					</div>

					<div class="about-hero-floating-badge badge-bottom-left">
						<span class="badge-icon">✨</span>
						<div class="badge-text">
							<span class="badge-title">North America Zone</span>
							<span class="badge-subtitle">United in Faith & Purpose</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
