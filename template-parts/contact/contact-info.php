<?php
/**
 * Contact Us — Quick Contact Information Cards
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$info_data    = $args['data']['quick_info'] ?? [];
$cards        = $info_data['cards'] ?? [];
$social_links = $info_data['social_links'] ?? [];
?>

<section class="lfa-contact__quick-info" aria-labelledby="lfa-contact-info-heading">
	<div class="lfa-contact__container">
		<!-- Section Header -->
		<div class="lfa-contact__section-header text-center">
			<div class="lfa-contact__eyebrow lfa-contact__eyebrow--crimson">
				<?php echo esc_html( $info_data['eyebrow'] ?? 'REACH OUT TO US' ); ?>
			</div>
			<h2 id="lfa-contact-info-heading" class="lfa-contact__section-heading">
				<?php echo esc_html( $info_data['heading'] ?? "We're Here to Help You Connect." ); ?>
			</h2>
			<p class="lfa-contact__section-lead">
				<?php echo esc_html( $info_data['description'] ?? 'Reach out to our leadership and administrative coordinators across North America through our official communication channels.' ); ?>
			</p>
		</div>

		<!-- 3 Cards Grid -->
		<div class="lfa-contact__cards-grid" role="region" aria-label="Official Contact Channels">
			<?php foreach ( $cards as $card ) : ?>
				<article class="lfa-contact__info-card" id="contact-card-<?php echo esc_attr( $card['id'] ); ?>">
					<!-- Icon Wrap -->
					<div class="card-icon-wrap" aria-hidden="true">
						<?php if ( 'mail' === $card['icon'] ) : ?>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
						<?php elseif ( 'map-pin' === $card['icon'] ) : ?>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
								<circle cx="12" cy="10" r="3"></circle>
							</svg>
						<?php else : ?>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
								<circle cx="9" cy="7" r="4"></circle>
								<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
								<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
							</svg>
						<?php endif; ?>
					</div>

					<!-- Card Content -->
					<h3 class="card-title"><?php echo esc_html( $card['title'] ); ?></h3>
					<p class="card-desc"><?php echo esc_html( $card['value'] ); ?></p>

					<?php if ( 'social' === $card['id'] && ! empty( $social_links ) ) : ?>
						<!-- Social Links Icons Strip -->
						<div class="card-social-strip" aria-label="Official Social Channels">
							<?php foreach ( $social_links as $soc ) : ?>
								<a href="<?php echo esc_url( $soc['url'] ); ?>" 
								   target="_blank" 
								   rel="noopener noreferrer" 
								   class="social-pill" 
								   aria-label="<?php echo esc_attr( $soc['name'] ); ?>">
									<?php echo lfa_icon( $soc['icon'] ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<hr class="card-divider">

					<!-- Action CTA Link -->
					<a href="<?php echo esc_url( $card['action_url'] ); ?>" class="card-action-link">
						<span><?php echo esc_html( $card['action_label'] ); ?></span>
						<svg class="action-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
