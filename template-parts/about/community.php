<?php
/**
 * About Page Section 06 — Our Community
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="about-community-section" id="our-community" aria-label="Our Community in Action">
	<div class="lfa-container about-community-container">
		<div class="about-section-header text-center">
			<span class="section-eyebrow eyebrow-crimson">COMMUNITY & FELLOWSHIP</span>
			<h2 class="about-section-title">Faces of Fellowship: Across North America</h2>
			<div class="about-header-gold-line center-line" aria-hidden="true"></div>
			<p class="about-section-subtitle">
				Original moments of reunion, joy, and sisterhood captured from our zonal gatherings, national conferences, and regional meetups.
			</p>
		</div>

		<!-- Editorial Photo Grid / Collage -->
		<div class="community-photo-grid">
			<!-- Photo 1: Featured Wide Reunion -->
			<div class="comm-photo-item photo-span-wide">
				<div class="comm-photo-card">
					<img src="<?php echo esc_url( lfa_image_url( 'alumni-group-wide.jpg' ) ); ?>" 
					     alt="Love Family Alumni continental reunion gathering" 
					     class="comm-img" 
					     loading="lazy">
					<div class="comm-photo-overlay">
						<span class="comm-badge">CONTINENTAL REUNION</span>
						<h3 class="comm-photo-title">Generations of Alumni Gathering in One Accord</h3>
						<p class="comm-photo-desc">Alumni across graduating decades connecting at the North America zonal gathering.</p>
					</div>
				</div>
			</div>

			<!-- Photo 2: Women of Fellowship -->
			<div class="comm-photo-item photo-portrait">
				<div class="comm-photo-card">
					<img src="<?php echo esc_url( lfa_image_url( 'women-alumni-group.jpg' ) ); ?>" 
					     alt="Women of Love Family Alumni in fellowship" 
					     class="comm-img" 
					     loading="lazy">
					<div class="comm-photo-overlay">
						<span class="comm-badge">SISTERHOOD</span>
						<h3 class="comm-photo-title">Women of Love Family Alumni</h3>
						<p class="comm-photo-desc">Celebrating faith, mutual support, and leadership across careers and homes.</p>
					</div>
				</div>
			</div>

			<!-- Photo 3: Omaha 2025 Reunion Podium -->
			<div class="comm-photo-item photo-standard">
				<div class="comm-photo-card">
					<img src="<?php echo esc_url( lfa_image_url( 'omaha-podium-2025.jpg' ) ); ?>" 
					     alt="Omaha 2025 Conference reunion gathering" 
					     class="comm-img" 
					     loading="lazy">
					<div class="comm-photo-overlay">
						<span class="comm-badge">OMAHA 2025</span>
						<h3 class="comm-photo-title">Conference Fellowship & Ministry</h3>
						<p class="comm-photo-desc">Reconnecting, worshipping, and planning for our zonal future.</p>
					</div>
				</div>
			</div>

			<!-- Photo 4: Small Group Connection -->
			<div class="comm-photo-item photo-standard">
				<div class="comm-photo-card">
					<img src="<?php echo esc_url( lfa_image_url( 'alumni-small-group.jpg' ) ); ?>" 
					     alt="Alumni close-knit regional fellowship" 
					     class="comm-img" 
					     loading="lazy">
					<div class="comm-photo-overlay">
						<span class="comm-badge">REGIONAL FELLOWSHIP</span>
						<h3 class="comm-photo-title">Lifelong Brotherhood & Sisterhood</h3>
						<p class="comm-photo-desc">Bonds that began in Benin, strengthened across North American cities.</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Community Gallery Footer Note -->
		<div class="community-gallery-cta">
			<p class="gallery-cta-text">
				Explore full albums from all our past conferences and regional celebrations.
			</p>
			<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn-community-gallery">
				<span>View Full Photo Gallery</span>
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="5" y1="12" x2="19" y2="12"></line>
					<polyline points="12 5 19 12 12 19"></polyline>
				</svg>
			</a>
		</div>
	</div>
</section>
