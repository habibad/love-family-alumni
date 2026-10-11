<?php
/**
 * Homepage President's Message Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="president-section" aria-label="President's Message">
	<div class="president-watermark" aria-hidden="true">
		<?php echo lfa_icon( 'watermark' ); ?>
	</div>

	<div class="lfa-container">
		<div class="president-grid">
			<!-- Left Column: Executive Portrait (Desk & Chair) -->
			<div class="president-photo-col">
				<div class="president-photo-frame">
					<img src="<?php echo esc_url( lfa_image_url( 'leadership-portrait-desk.png' ) ); ?>" 
					     alt="Dr. Evans Akpo - President, Love Family Alumni North America Zone" 
					     loading="lazy" 
					     class="president-img">
				</div>
			</div>

			<!-- Right Column: Message & Attribution -->
			<div class="president-message-col">
				<span class="section-eyebrow eyebrow-gold">PRESIDENT'S MESSAGE</span>
				<h2 class="section-heading president-heading">Building a Legacy Through People</h2>
				<p class="president-text">
					Welcome to the Love Family Alumni – North America Zone. Our strength lies in our people — a community connected by love, driven by purpose, and committed to leaving a lasting legacy. Let us continue to support one another, create opportunities, and make a meaningful impact together.
				</p>

				<div class="president-gold-divider" aria-hidden="true"></div>

				<div class="president-signoff-row">
					<div class="president-meta">
						<span class="president-name">Dr. Evans Akpo</span>
						<span class="president-title">President, Love Family Alumni – North America Zone</span>
					</div>
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-crimson btn-president-cta">
						Read Full Message
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
