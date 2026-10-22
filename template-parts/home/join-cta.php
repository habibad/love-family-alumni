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
<section class="join-cta-section lfa-final-cta" id="join-alumni-cta" aria-label="Join TheLove Family Alumni">
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
				<?php if ( is_user_logged_in() ) :
					$dash_url = class_exists( 'LFA_Auth' ) ? LFA_Auth::get_user_dashboard_url() : home_url( '/member-dashboard/' );
					$is_admin = current_user_can( 'manage_options' ) || current_user_can( 'lfa_view_admin_portal' );
				?>
					<a href="<?php echo esc_url( $dash_url ); ?>" class="btn btn-join-now">
						<?php echo $is_admin ? 'Admin Portal &rarr;' : 'My Dashboard &rarr;'; ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/member-register/' ) ); ?>" class="btn btn-join-now">
						Join Now
					</a>
				<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-join-contact">
					Contact Us
				</a>
			</div>
		</div>
	</div>
</section>

