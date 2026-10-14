<?php
/**
 * Contact Us — Connect With Your Alumni Community
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$community_data = $args['data']['community_cards'] ?? [];
$cards          = $community_data['cards'] ?? [];
?>

<section class="lfa-contact__community" aria-labelledby="lfa-contact-community-heading">
	<div class="lfa-contact__container">
		
		<!-- Section Header -->
		<div class="lfa-contact__section-header text-center">
			<div class="lfa-contact__eyebrow lfa-contact__eyebrow--crimson">
				<?php echo esc_html( $community_data['eyebrow'] ?? 'MORE WAYS TO CONNECT' ); ?>
			</div>
			<h2 id="lfa-contact-community-heading" class="lfa-contact__section-heading">
				<?php echo esc_html( $community_data['heading'] ?? 'Your Place in the Love Family Community.' ); ?>
			</h2>
			<p class="lfa-contact__section-lead">
				<?php echo esc_html( $community_data['lead'] ?? 'Explore dedicated programs and initiatives designed to support our members at every stage of their alumni journey.' ); ?>
			</p>
		</div>

		<!-- 3 Community Cards Grid -->
		<div class="lfa-contact__community-grid" role="region" aria-label="Alumni Network Pathways">
			<?php foreach ( $cards as $card ) :
				$image_url = lfa_image_url( $card['image'] );
			?>
				<article class="lfa-contact__comm-card">
					<!-- Visual Media Wrap with Overlay -->
					<div class="comm-card-media" style="--comm-bg: url('<?php echo esc_url( $image_url ); ?>');">
						<div class="comm-card-overlay" aria-hidden="true"></div>
						<span class="comm-card-tag"><?php echo esc_html( $card['tag'] ); ?></span>
					</div>

					<!-- Card Content -->
					<div class="comm-card-content">
						<h3 class="comm-card-title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="comm-card-desc"><?php echo esc_html( $card['description'] ); ?></p>
						
						<hr class="comm-card-divider">

						<div class="comm-card-footer">
							<a href="<?php echo esc_url( $card['cta_url'] ); ?>" class="comm-card-link">
								<span><?php echo esc_html( $card['cta_label'] ); ?></span>
								<svg class="action-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>
