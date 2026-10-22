<?php
/**
 * Alumni Directory — Section 05: Reconnect & Join CTA Banner
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_bg_image = lfa_image_url( 'cta-skyline-bg.jpg' );
$cta_icon_img = lfa_image_url( 'cta-community-icon.png' );
?>

<section class="directory-join-cta-section" id="directory-join-cta" aria-label="Stay Connected Call to Action">
	<div class="directory-join-bg-wrapper" aria-hidden="true">
		<img src="<?php echo esc_url( $cta_bg_image ); ?>" 
		     alt="" 
		     class="directory-join-bg-img" 
		     loading="lazy" 
		     decoding="async">
		<div class="directory-join-gradient-overlay"></div>
	</div>

	<div class="lfa-container directory-join-container">
		<div class="directory-join-inner">
			
			<!-- Left: Community Icon & Content -->
			<div class="directory-join-left">
				<div class="directory-join-icon-wrap" aria-hidden="true">
					<img src="<?php echo esc_url( $cta_icon_img ); ?>" 
					     alt="Community Icon" 
					     width="96" 
					     height="76" 
					     class="directory-join-icon-img" 
					     loading="lazy">
				</div>

				<div class="directory-join-text-wrap">
					<span class="directory-join-eyebrow">STAY CONNECTED</span>
					<h2 class="directory-join-title">Reconnect. Network. Make an Impact.</h2>
					<p class="directory-join-subtitle">
						Update your information, find alumni and be part of a stronger community.
					</p>
				</div>
			</div>

			<!-- Right: Action Button -->
			<div class="directory-join-right">
				<a href="<?php echo esc_url( is_user_logged_in() ? home_url( '/member-dashboard/#profile' ) : home_url( '/join/' ) ); ?>" class="btn directory-join-btn">
					<?php echo is_user_logged_in() ? 'Update Your Profile' : 'Join or Update Profile'; ?>
				</a>
			</div>

		</div>
	</div>
</section>
