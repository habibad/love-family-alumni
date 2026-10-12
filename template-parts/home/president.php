<?php
/**
 * Homepage President's Message Section
 * Precision Matched to APPROVED_PRESIDENT_REFERENCE.png
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="president-section lfa-president" id="president-message" aria-label="President's Message">
	<div class="lfa-container president-container">
		<!-- Subtle upper-right watermark emblem -->
		<div class="president-watermark-wrap" aria-hidden="true">
			<img src="<?php echo esc_url( lfa_image_url( 'president-logo-watermark.jpg' ) ); ?>" 
			     alt="" 
			     class="president-watermark-img">
		</div>

		<div class="president-grid">
			<!-- Zone 1: Left Portrait Block -->
			<div class="president-photo-col">
				<div class="president-photo-frame">
					<img src="<?php echo esc_url( lfa_image_url( 'president-portrait-office-chair.png' ) ); ?>" 
					     alt="Dr. Evans Akpo - President, Love Family Alumni North America Zone" 
					     loading="lazy" 
					     class="president-img">
				</div>
			</div>

			<!-- Zone 2: Editorial Content Block -->
			<div class="president-content-col">
				<span class="president-eyebrow">PRESIDENT'S MESSAGE</span>
				<h2 class="president-heading">
					<span class="president-heading-line">Building a Legacy</span>
					<span class="president-heading-line">Through People</span>
				</h2>
				<p class="president-text">
					Welcome to the Love Family Alumni – North America Zone. Our strength lies in our people — a community connected by love, driven by purpose, and committed to leaving a lasting legacy. Let us continue to support one another, create opportunities, and make a meaningful impact together.
				</p>
				<div class="president-gold-divider" aria-hidden="true"></div>
				
				<!-- Signoff & CTA row: 2 columns in 1 row -->
				<div class="president-signoff-row">
					<div class="president-signoff">
						<span class="president-name">Dr. Evans Akpo</span>
						<span class="president-title">President, Love Family Alumni – North America Zone</span>
					</div>
					<div class="president-cta-wrap">
						<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn president-btn">
							Read Full Message
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
