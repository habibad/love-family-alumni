<?php
/**
 * Leadership Page — Section 02: President Introduction Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$president_portrait = lfa_image_url( 'original-president-portrait.jpg' );
?>

<section class="leadership-president-section" aria-label="President's Introduction">
	<div class="lfa-container leadership-president-container">
		<div class="leadership-president-grid">
			<!-- Col 1: Portrait Media Frame -->
			<div class="leadership-president-media-col">
				<div class="leadership-portrait-frame">
					<img src="<?php echo esc_url( $president_portrait ); ?>" 
					     alt="Dr. Evans Akpo — President, Love Family Alumni North America Zone" 
					     width="520" 
					     height="620" 
					     class="leadership-portrait-img"
					     loading="eager">
				</div>
			</div>

			<!-- Col 2: Editorial Content -->
			<div class="leadership-president-content-col">
				<div class="leadership-president-eyebrow-wrap">
					<span class="leadership-president-eyebrow">PRESIDENT</span>
				</div>

				<h2 class="leadership-president-name">Dr. Evans Akpo</h2>
				
				<div class="leadership-president-designation">
					<span>President, Love Family Alumni – North America Zone</span>
				</div>

				<div class="leadership-president-divider" aria-hidden="true"></div>

				<div class="leadership-president-bio">
					<p class="bio-lead">
						Dr. Evans Akpo provides visionary leadership and oversees the strategic direction of the Love Family Alumni – North America Zone.
					</p>
					<p>
						Our leadership is committed to strengthening alumni relationships, preserving our shared heritage, and creating opportunities for meaningful service across generations.
					</p>
					<p>
						His commitment to service, unity, and community impact continues to strengthen our alumni network across the region and beyond.
					</p>
				</div>

				<div class="leadership-president-actions">
					<a href="<?php echo esc_url( home_url( '/#president-message' ) ); ?>" class="btn btn-primary-red leadership-message-btn">
						<span>Read Full Message</span>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
