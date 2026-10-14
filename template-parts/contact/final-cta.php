<?php
/**
 * Contact Us — Final Call to Action
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_data  = $args['data']['final_cta'] ?? [];
$image_url = lfa_image_url( 'conference-cinematic-bg.jpg' );
?>

<section class="lfa-contact__final-cta" aria-labelledby="lfa-contact-cta-heading" style="--cta-bg-img: url('<?php echo esc_url( $image_url ); ?>');">
	<div class="lfa-contact__cta-overlay" aria-hidden="true"></div>
	<div class="lfa-contact__container text-center">
		
		<div class="lfa-contact__cta-content">
			<!-- Gold Eyebrow -->
			<div class="lfa-contact__eyebrow lfa-contact__eyebrow--gold">
				<?php echo esc_html( $cta_data['eyebrow'] ?? 'ONE FAMILY. ONE CONNECTION.' ); ?>
			</div>

			<!-- Main Heading -->
			<h2 id="lfa-contact-cta-heading" class="lfa-contact__cta-heading">
				<?php echo esc_html( $cta_data['heading'] ?? "Let's Continue Building Our Legacy Together." ); ?>
			</h2>

			<!-- Description -->
			<p class="lfa-contact__cta-lead">
				<?php echo esc_html( $cta_data['description'] ?? 'Every conversation is an opportunity to strengthen our community, share experiences, and create meaningful connections.' ); ?>
			</p>

			<!-- Action Buttons -->
			<div class="lfa-contact__cta-actions">
				<a href="<?php echo esc_url( $cta_data['primary_btn']['url'] ?? '#contact-form' ); ?>" class="btn btn-white-solid lfa-contact__btn-cta-main">
					<span><?php echo esc_html( $cta_data['primary_btn']['label'] ?? 'Get in Touch' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="12" y1="5" x2="12" y2="19"></line>
						<polyline points="19 12 12 19 5 12"></polyline>
					</svg>
				</a>

				<a href="<?php echo esc_url( $cta_data['secondary_btn']['url'] ?? home_url( '/about/' ) ); ?>" class="btn btn-outline-white lfa-contact__btn-cta-secondary">
					<span><?php echo esc_html( $cta_data['secondary_btn']['label'] ?? 'Discover Our Story' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="5" y1="12" x2="19" y2="12"></line>
						<polyline points="12 5 19 12 12 19"></polyline>
					</svg>
				</a>
			</div>
		</div>

	</div>
</section>
