<?php
/**
 * Homepage 2027 Conference Featured Event Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="conference-section" aria-label="Featured Event: 2027 Conference">
	<div class="conference-crowd-overlay" aria-hidden="true"></div>

	<div class="lfa-container">
		<div class="conference-banner">
			<!-- Left: Speaker Cutout -->
			<div class="conference-leader-col">
				<div class="conference-leader-wrap">
					<img src="<?php echo esc_url( lfa_image_url( 'speaker-fedora-seamless.png' ) ); ?>" 
					     alt="2027 Conference Speaker" 
					     loading="lazy" 
					     class="conference-leader-img">
				</div>
			</div>

			<!-- Center: Conference Details -->
			<div class="conference-info-col">
				<div class="conference-badge">FEATURED EVENT</div>
				<h2 class="conference-title">2027 CONFERENCE</h2>
				<div class="conference-theme">
					<span class="theme-label">THEME:</span> 
					<span class="theme-name">THY KINGDOM COME</span>
				</div>

				<div class="conference-gold-line" aria-hidden="true"></div>

				<div class="conference-meta-row">
					<div class="conference-meta-item">
						<span class="meta-icon"><?php echo lfa_icon( 'calendar' ); ?></span>
						<div class="meta-text">
							<span class="meta-primary">JULY 2027</span>
							<span class="meta-sub">Date Coming Soon</span>
						</div>
					</div>

					<div class="conference-meta-divider" aria-hidden="true"></div>

					<div class="conference-meta-item">
						<span class="meta-icon"><?php echo lfa_icon( 'map-pin' ); ?></span>
						<div class="meta-text">
							<span class="meta-primary">North America</span>
							<span class="meta-sub">(Details to be announced)</span>
						</div>
					</div>
				</div>
			</div>

			<!-- Right: Copy & Actions -->
			<div class="conference-action-col">
				<p class="conference-blurb">
					A time of reunion, renewal and greater impact. Join us for inspiring sessions, fellowship and a shared vision for the future.
				</p>
				<div class="conference-btn-row">
					<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="btn btn-crimson btn-conference">
						Register Now
					</a>
					<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="btn btn-wine-outline btn-conference">
						View Details
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
