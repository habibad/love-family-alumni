<?php
/**
 * Homepage Join the Love Family Alumni CTA Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="join-cta-section lfa-final-cta" id="join-alumni-cta" aria-label="Join Love Family Alumni">
	<div class="join-cta-bg-container">
		<img src="<?php echo esc_url( lfa_image_url( 'cta-skyline-bg.jpg' ) ); ?>" 
		     alt="" 
		     class="join-cta-bg-img" 
		     loading="eager" 
		     decoding="async"
		     aria-hidden="true">
		<div class="join-cta-overlay"></div>
	</div>

	<div class="lfa-container join-cta-container">
		<div class="join-cta-grid">
			<!-- Left: Community Icon & Pitch -->
			<div class="join-cta-left">
				<div class="join-cta-icon-wrap">
					<img src="<?php echo esc_url( lfa_image_url( 'cta-community-icon.png' ) ); ?>" 
					     alt="Community Icon" 
					     width="128" 
					     height="102" 
					     class="join-cta-icon-img"
					     loading="eager">
				</div>
				<div class="join-cta-divider" aria-hidden="true"></div>
				<div class="join-cta-text">
					<span class="join-eyebrow">YOU BELONG HERE!</span>
					<h2 class="join-title">Join the Love Family Alumni Today.</h2>
					<p class="join-sub">Stay connected. Stay inspired. Be part of a community making a difference.</p>
				</div>
			</div>

			<!-- Right: Action Buttons -->
			<div class="join-cta-right">
				<a href="<?php echo esc_url( home_url( '/join/' ) ); ?>" class="btn btn-join-now">
					Join Now
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-join-contact">
					Contact Us
				</a>
			</div>
		</div>
	</div>
</section>

