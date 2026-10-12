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
<section class="conference-section lfa-featured-conference" id="conference-featured" aria-label="Featured Event: 2027 Conference">
	<!-- Background layers: cinematic crowd, lighting & globe -->
	<div class="conference-bg-layer" aria-hidden="true">
		<img src="<?php echo esc_url( lfa_image_url( 'conference-cinematic-bg.jpg' ) ); ?>" 
		     alt="" 
		     class="conference-bg-img">
		<div class="conference-bg-overlay"></div>
	</div>

	<div class="conference-container">
		<div class="conference-banner">
			<!-- Zone 1 (Left): Speaker Cutout -->
			<div class="conference-leader-col">
				<div class="conference-leader-wrap">
					<img src="<?php echo esc_url( lfa_image_url( 'speaker-fedora-master.png' ) ); ?>" 
					     alt="2027 Conference Speaker" 
					     loading="eager" 
					     decoding="async"
					     class="conference-leader-img">
				</div>
			</div>

			<!-- Zone 2 (Center): Conference Editorial Details -->
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
						<span class="meta-icon" aria-hidden="true">
							<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
								<rect x="3" y="4" width="18" height="18" rx="3" ry="3"></rect>
								<line x1="8" y1="2" x2="8" y2="5"></line>
								<line x1="16" y1="2" x2="16" y2="5"></line>
								<line x1="3" y1="9" x2="21" y2="9"></line>
								<path d="M7 13h3.5v5H7z" stroke-width="1.6" fill="rgba(229,168,59,0.3)"></path>
								<path d="M13.5 13H17v5h-3.5z" stroke-width="1.6" fill="rgba(229,168,59,0.3)"></path>
							</svg>
						</span>
						<div class="meta-text">
							<span class="meta-primary">JULY 2027</span>
							<span class="meta-sub">Date Coming Soon</span>
						</div>
					</div>

					<div class="conference-meta-divider" aria-hidden="true"></div>

					<div class="conference-meta-item">
						<span class="meta-icon" aria-hidden="true">
							<svg width="38" height="44" viewBox="0 0 24 28" fill="currentColor">
								<path d="M12 1C5.93 1 1 5.93 1 12c0 7.8 11 15 11 15s11-7.2 11-15c0-6.07-4.93-11-11-11zm0 16a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
							</svg>
						</span>
						<div class="meta-text">
							<span class="meta-primary">North America</span>
							<span class="meta-sub">(Details to be announced)</span>
						</div>
					</div>
				</div>
			</div>

			<!-- Vertical Gold Separator -->
			<div class="conference-vertical-divider" aria-hidden="true"></div>

			<!-- Zone 3 (Right): Copy & Actions -->
			<div class="conference-action-col">
				<p class="conference-blurb">
					A time of reunion, renewal and<br class="conf-desk-br">
					greater impact. Join us for inspiring<br class="conf-desk-br">
					sessions, fellowship and a shared<br class="conf-desk-br">
					vision for the future.
				</p>
				<div class="conference-btn-row">
					<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="btn btn-conference btn-conference-register">
						Register Now
					</a>
					<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="btn btn-conference btn-conference-details">
						View Details
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
