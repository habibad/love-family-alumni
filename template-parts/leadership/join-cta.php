<?php
/**
 * Leadership Page — Section 06: Join Our Leadership Community CTA
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_bg_image = lfa_image_url( 'cta-skyline-bg.jpg' );
$contact_url  = home_url( '/contact/' );
?>

<section class="leadership-join-cta-section" id="join-leadership" aria-label="Join Our Leadership Community">
	<div class="leadership-cta-bg-layer" style="background-image: url('<?php echo esc_url( $cta_bg_image ); ?>');" aria-hidden="true">
		<div class="leadership-cta-overlay"></div>
	</div>

	<div class="lfa-container leadership-cta-container">
		<div class="leadership-cta-inner">
			<!-- Left: Community Icon & Divider & Content Group -->
			<div class="leadership-cta-content-group">
				<div class="leadership-cta-icon-wrap" aria-hidden="true">
					<svg class="leadership-community-icon-svg" width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
						<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
					</svg>
				</div>

				<div class="leadership-cta-divider" aria-hidden="true"></div>

				<div class="leadership-cta-text-wrap">
					<span class="leadership-cta-eyebrow">JOIN OUR LEADERSHIP COMMUNITY</span>
					<h2 class="leadership-cta-title">Make a Difference. Get Involved.</h2>
					<p class="leadership-cta-desc">
						Support our leadership initiatives and be part of a stronger alumni community.
					</p>
				</div>
			</div>

			<!-- Right: Contact Leadership Action Button -->
			<div class="leadership-cta-action-group">
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn leadership-contact-btn">
					<span>Contact Leadership</span>
				</a>
			</div>
		</div>
	</div>
</section>
