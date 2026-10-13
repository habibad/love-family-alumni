<?php
/**
 * Events Page — Section 07: Community CTA
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_bg_img = lfa_image_url( 'cta-skyline-bg.jpg' );
$cta_icon   = lfa_image_url( 'cta-community-icon.png' );
?>

<section class="events-cta-section" id="events-community-cta" aria-label="Join Community and Gatherings">
	<!-- Atmospheric Skyline Background Layer -->
	<div class="events-cta-bg-layer" aria-hidden="true">
		<img src="<?php echo esc_url( $cta_bg_img ); ?>" 
		     alt="" 
		     class="events-cta-bg-img" 
		     loading="lazy">
		<div class="events-cta-overlay"></div>
	</div>

	<div class="lfa-container events-cta-container">
		<div class="events-cta-grid">
			
			<!-- Left Column: Icon & Pitch -->
			<div class="events-cta-left">
				<div class="events-cta-icon-wrap">
					<img src="<?php echo esc_url( $cta_icon ); ?>" 
					     alt="Love Family Community Icon" 
					     width="110" 
					     height="88" 
					     class="events-cta-icon-img" 
					     loading="lazy">
				</div>
				<div class="events-cta-divider" aria-hidden="true"></div>
				<div class="events-cta-text">
					<span class="events-cta-eyebrow">BE PART OF THE MOMENT</span>
					<h2 class="events-cta-title">Every Gathering Strengthens Our Family.</h2>
					<p class="events-cta-sub">
						Whether you attend our flagship continental assemblies, connect at local chapter networking dinners, or lift voices in quarterly prayer, your presence enriches the entire Love Family diaspora.
					</p>
				</div>
			</div>

			<!-- Right Column: Action Buttons -->
			<div class="events-cta-right">
				<a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn btn-join-now events-btn-join">
					<span>Explore Membership</span>
					<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="5" y1="12" x2="19" y2="12"></line>
						<polyline points="12 5 19 12 12 19"></polyline>
					</svg>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-join-contact events-btn-contact">
					<span>Contact Us</span>
				</a>
			</div>

		</div>
	</div>
</section>
