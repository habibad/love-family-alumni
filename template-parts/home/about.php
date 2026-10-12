<?php
/**
 * Homepage About Us Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="about-section lfa-about" id="about-us" aria-label="About Us">
	<div class="lfa-about-container">
		<div class="about-grid">
			<!-- Left Column: Copy & Action -->
			<div class="about-copy-col">
				<span class="about-eyebrow">ABOUT US</span>
				<h2 class="about-heading">One Family. A Stronger Tomorrow.</h2>
				<p class="about-text">
					The Love Family Alumni – North America Zone is a dynamic and inclusive community of alumni united by our shared heritage, values, and commitment to making a positive impact. We foster fellowship, support personal and professional growth, give back to our communities, and keep our family legacy alive for future generations.
				</p>
				<div class="about-btn-wrap">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn about-btn">
						Learn More About Us
					</a>
				</div>
			</div>

			<!-- Right Column: Branded Composite Visual -->
			<div class="about-visual-col">
				<div class="about-composition-card">
					<div class="about-comp-image">
						<img src="<?php echo esc_url( lfa_image_url( 'hands-supporting-crop.jpg' ) ); ?>" 
						     alt="Hands united in fellowship" 
						     loading="lazy" 
						     class="comp-hands-img">
						<div class="comp-image-fade" aria-hidden="true"></div>
					</div>
					<div class="about-comp-values">
						<ul class="comp-values-list">
							<li>Faith</li>
							<li>Family</li>
							<li>Friendship</li>
							<li>Service</li>
							<li>Legacy</li>
						</ul>
						<div class="comp-values-bar" aria-hidden="true"></div>
					</div>
					<div class="about-comp-brand">
						<div class="comp-brand-crest">
							<img src="<?php echo esc_url( lfa_image_url( 'original-brand-emblem-source.jpg' ) ); ?>" 
							     alt="Love Family Symbol" 
							     width="130" 
							     height="130">
						</div>
						<p class="comp-script-text">
							<span>Across Generations,</span>
							<span>Around the World</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
