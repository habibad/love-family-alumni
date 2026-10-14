<?php
/**
 * Alumni Directory — Section 04: Privacy Notice Component
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="directory-privacy-section" id="directory-privacy" aria-label="Privacy and Directory Access Notice">
	<div class="lfa-container">
		<div class="directory-privacy-card">
			<div class="directory-privacy-icon-wrapper" aria-hidden="true">
				<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
					<path d="m9 12 2 2 4-4"></path>
				</svg>
			</div>
			<div class="directory-privacy-content">
				<h3 class="directory-privacy-title">Member Privacy &amp; Directory Access</h3>
				<p class="directory-privacy-text">
					Your profile visibility is controlled by your personal privacy settings. Verified member access may be required to view direct contact channels and alumni networking features. Personal information is protected and never published without explicit consent.
				</p>
			</div>
			<div class="directory-privacy-action">
				<a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn btn-outline-navy directory-privacy-btn">
					Membership Details
				</a>
			</div>
		</div>
	</div>
</section>
