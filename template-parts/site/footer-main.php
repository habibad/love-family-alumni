<?php
/**
 * Site Main Footer
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="site-footer lfa-site-footer" id="site-footer" role="contentinfo">
	<div class="lfa-container footer-content-wrap">
		<div class="footer-grid">
			<!-- Col 1: Brand Identity -->
			<div class="footer-col footer-col-brand">
				<div class="footer-brand-wrap">
					<div class="footer-brand-logo">
						<img src="<?php echo esc_url( lfa_image_url( 'footer-logo-circle.png' ) ); ?>" 
						     alt="Love Family Alumni Emblem" 
						     width="165" 
						     height="165" 
						     class="footer-crest-img">
					</div>
					<div class="footer-brand-info">
						<div class="footer-brand-title">The LOVE FAMILY ALUMNI</div>
						<div class="footer-brand-zone">NORTH AMERICA ZONE</div>
						<p class="footer-tagline">
							One family, Across borders.<br>
							Impacting generations.
						</p>
					</div>
				</div>
			</div>

			<div class="footer-vertical-divider" aria-hidden="true"></div>

			<!-- Col 2: Quick Links (2 sub-columns with divider) -->
			<div class="footer-col footer-col-links">
				<h3 class="footer-heading">Quick Links</h3>
				<div class="footer-links-duo">
					<ul class="footer-links-list">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a></li>
						<li><a href="<?php echo esc_url( home_url( '/leadership/' ) ); ?>">Leadership</a></li>
						<li><a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>">Membership</a></li>
						<li><a href="<?php echo esc_url( home_url( '/events/' ) ); ?>">Events</a></li>
						<li><a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>">Conference</a></li>
					</ul>

					<div class="footer-links-sub-divider" aria-hidden="true"></div>

					<ul class="footer-links-list">
						<li><a href="<?php echo esc_url( home_url( '/directory/' ) ); ?>">Directory</a></li>
						<li><a href="<?php echo esc_url( home_url( '/scholarships/' ) ); ?>">Scholarships</a></li>
						<li><a href="<?php echo esc_url( home_url( '/give/' ) ); ?>">Give</a></li>
						<li><a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">Gallery</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
					</ul>
				</div>
			</div>

			<div class="footer-vertical-divider" aria-hidden="true"></div>

			<!-- Col 3: Contact & Social -->
			<div class="footer-col footer-col-contact">
				<h3 class="footer-heading">Contact Us</h3>
				<ul class="footer-contact-list">
					<li>
						<a href="mailto:lovefamilyalumni.na@gmail.com" class="footer-contact-item">
							<span class="footer-icon-gold" aria-hidden="true">
								<svg width="24" height="20" viewBox="0 0 24 20" fill="none">
									<rect x="1" y="2" width="22" height="16" rx="2" stroke="#E5C170" stroke-width="2"/>
									<path d="M2 3l10 8 10-8" stroke="#E5C170" stroke-width="2" stroke-linecap="round"/>
								</svg>
							</span>
							<span class="footer-contact-text">lovefamilyalumni.na@gmail.com</span>
						</a>
					</li>
					<li>
						<div class="footer-contact-item">
							<span class="footer-icon-gold" aria-hidden="true">
								<svg width="20" height="26" viewBox="0 0 24 28" fill="#E5A83B">
									<path d="M12 1C5.93 1 1 5.93 1 12c0 7.8 11 15 11 15s11-7.2 11-15c0-6.07-4.93-11-11-11zm0 16a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
								</svg>
							</span>
							<span class="footer-contact-text">North America Zone</span>
						</div>
					</li>
				</ul>
				<div class="footer-social-links">
					<a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social-chip" aria-label="Facebook">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
							<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
						</svg>
					</a>
					<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="footer-social-chip" aria-label="LinkedIn">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
							<path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37h2.79V10.9H6.46M7.86 6.54a1.63 1.63 0 0 0-1.63 1.63c0 .9.73 1.63 1.63 1.63.9 0 1.63-.73 1.63-1.63 0-.9-.73-1.63-1.63-1.63z"/>
						</svg>
					</a>
					<a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="footer-social-chip footer-social-chip-youtube" aria-label="YouTube">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
							<path d="M21.582 6.186a2.506 2.506 0 0 0-1.768-1.782C18.251 4 12 4 12 4s-6.251 0-7.814.404a2.506 2.506 0 0 0-1.768 1.782A26.31 26.31 0 0 0 2 12a26.31 26.31 0 0 0 .418 5.814 2.506 2.506 0 0 0 1.768 1.782C5.749 20 12 20 12 20s6.251 0 7.814-.404a2.506 2.506 0 0 0 1.768-1.782A26.31 26.31 0 0 0 22 12a26.31 26.31 0 0 0-.418-5.814zM9.9 15.46V8.54L15.9 12l-6 3.46z"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bottom Tagline Banner -->
	<div class="lfa-container footer-bottom-bar">
		<div class="footer-gold-hr" aria-hidden="true"></div>
		<p class="legacy-tagline">
			TOGETHER, WE BUILD. TOGETHER, WE RISE. TOGETHER, WE LEAVE A LEGACY.
		</p>
	</div>
</footer>
