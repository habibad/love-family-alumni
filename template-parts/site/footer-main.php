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
<footer class="site-footer" role="contentinfo">
	<div class="lfa-container footer-content-wrap">
		<div class="footer-grid">
			<!-- Col 1: Brand -->
			<div class="footer-col footer-col-brand">
				<div class="footer-brand">
					<div class="footer-brand-logo">
						<img src="<?php echo esc_url( lfa_image_url( 'brand-love-family-symbol-original.jpg' ) ); ?>" 
						     alt="Love Family Alumni Emblem" 
						     width="56" 
						     height="56" 
						     class="footer-crest-img">
					</div>
					<div class="footer-brand-text">
						<span class="footer-brand-title">LOVE FAMILY ALUMNI</span>
						<span class="footer-brand-zone">NORTH AMERICA ZONE</span>
					</div>
				</div>
				<p class="footer-tagline">
					One family. Across borders.<br>Impacting generations.
				</p>
			</div>

			<div class="footer-vertical-divider" aria-hidden="true"></div>

			<!-- Col 2: Quick Links (2 sub-columns with divider) -->
			<div class="footer-col footer-col-links">
				<h3 class="footer-heading">Quick Links</h3>
				<div class="footer-links-duo">
					<ul class="footer-links-list">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a></li>
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

			<!-- Col 4: Contact & Social -->
			<div class="footer-col footer-col-contact">
				<h3 class="footer-heading">Contact Us</h3>
				<ul class="footer-contact-list">
					<li>
						<a href="mailto:lovefamilyalumni.na@gmail.com" class="footer-contact-item">
							<span class="footer-icon-gold"><?php echo lfa_icon( 'mail' ); ?></span>
							<span>lovefamilyalumni.na@gmail.com</span>
						</a>
					</li>
					<li>
						<div class="footer-contact-item">
							<span class="footer-icon-gold"><?php echo lfa_icon( 'map-pin' ); ?></span>
							<span>North America Zone</span>
						</div>
					</li>
				</ul>
				<div class="footer-social-links">
					<a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Facebook">
						<?php echo lfa_icon( 'facebook' ); ?>
					</a>
					<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="LinkedIn">
						<?php echo lfa_icon( 'linkedin' ); ?>
					</a>
					<a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="YouTube">
						<?php echo lfa_icon( 'youtube' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bottom Tagline Banner -->
	<div class="footer-bottom-bar">
		<div class="lfa-container text-center">
			<div class="footer-gold-hr" aria-hidden="true"></div>
			<p class="legacy-tagline">
				TOGETHER, WE BUILD. TOGETHER, WE RISE. TOGETHER, WE LEAVE A LEGACY.
			</p>
		</div>
	</div>
</footer>
