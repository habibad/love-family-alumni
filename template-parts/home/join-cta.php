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
<section class="join-cta-section" aria-label="Join Love Family Alumni">
	<div class="join-cta-bg-container">
		<img src="<?php echo esc_url( lfa_image_url( 'skyline-banner-clean.jpg' ) ); ?>" 
		     alt="" 
		     class="join-cta-bg-img" 
		     loading="lazy" 
		     aria-hidden="true">
		<div class="join-cta-overlay"></div>
	</div>

	<div class="lfa-container join-cta-container">
		<div class="join-cta-grid">
			<!-- Left: Icon & Pitch -->
			<div class="join-cta-left">
				<div class="join-cta-icon-wrap">
					<svg width="56" height="56" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="join-cta-icon">
						<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
					</svg>
				</div>
				<div class="join-cta-divider" aria-hidden="true"></div>
				<div class="join-cta-text">
					<span class="join-eyebrow">YOU BELONG HERE!</span>
					<h2 class="join-title">Join the Love Family Alumni Today.</h2>
					<p class="join-sub">Stay connected. Stay inspired. Be part of a community making a difference.</p>
				</div>
			</div>

			<!-- Right: Actions -->
			<div class="join-cta-right">
				<a href="<?php echo esc_url( home_url( '/join/' ) ); ?>" class="btn btn-crimson btn-cta-large">
					Join Now
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-cta-outline btn-cta-large">
					Contact Us
				</a>
			</div>
		</div>
	</div>
</section>
