<?php
/**
 * About Page Section 08 — Join Our Family (Membership CTA)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="about-cta-section" id="join-family-cta" aria-label="Join Love Family Alumni">
	<!-- Atmospheric Skyline Background Layer -->
	<div class="about-cta-bg-layer" aria-hidden="true">
		<img src="<?php echo esc_url( lfa_image_url( 'cta-skyline-bg.jpg' ) ); ?>" 
		     alt="" 
		     class="about-cta-bg-img" 
		     loading="lazy">
		<div class="about-cta-overlay"></div>
	</div>

	<div class="lfa-container about-cta-container">
		<div class="about-cta-grid">
			<!-- Left Column: Icon & Pitch -->
			<div class="about-cta-left">
				<div class="about-cta-icon-wrap">
					<img src="<?php echo esc_url( lfa_image_url( 'cta-community-icon.png' ) ); ?>" 
					     alt="Community Icon" 
					     width="120" 
					     height="96" 
					     class="about-cta-icon-img" 
					     loading="lazy">
				</div>
				<div class="about-cta-divider" aria-hidden="true"></div>
				<div class="about-cta-text">
					<span class="about-cta-eyebrow">YOUR FAMILY IS WAITING</span>
					<h2 class="about-cta-title">Ready to Reconnect and Walk With Us?</h2>
					<p class="about-cta-sub">
						Whether you graduated decades ago or just recently arrived in North America, there is a dedicated place for you at our family table.
					</p>
				</div>
			</div>

			<!-- Right Column: Action Buttons using Approved Homepage Tokens -->
			<div class="about-cta-right">
				<a href="<?php echo esc_url( home_url( '/join/' ) ); ?>" class="btn btn-join-now">
					<span>Join Alumni Now</span>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-join-contact">
					<span>Contact Secretariat</span>
				</a>
			</div>
		</div>
	</div>
</section>
