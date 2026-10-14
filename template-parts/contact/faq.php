<?php
/**
 * Contact Us — Frequently Asked Questions Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faq_data = $args['data']['faq'] ?? [];
$items    = $faq_data['items'] ?? [];
?>

<section class="lfa-contact__faq" aria-labelledby="lfa-contact-faq-heading">
	<div class="lfa-contact__container lfa-contact__container--narrow">
		
		<!-- Section Header -->
		<div class="lfa-contact__section-header text-center">
			<div class="lfa-contact__eyebrow lfa-contact__eyebrow--crimson">
				<?php echo esc_html( $faq_data['eyebrow'] ?? 'COMMON QUESTIONS' ); ?>
			</div>
			<h2 id="lfa-contact-faq-heading" class="lfa-contact__section-heading">
				<?php echo esc_html( $faq_data['heading'] ?? 'A Few Things You Might Want to Know.' ); ?>
			</h2>
			<p class="lfa-contact__section-lead">
				<?php echo esc_html( $faq_data['lead'] ?? 'Find quick answers to common questions about connecting with the Love Family Alumni network.' ); ?>
			</p>
		</div>

		<!-- Accordion List -->
		<div class="lfa-contact__accordion-list" role="region" aria-label="Frequently Asked Questions">
			<?php foreach ( $items as $idx => $item ) : ?>
				<details class="lfa-contact__faq-item" <?php echo 0 === $idx ? 'open' : ''; ?>>
					<summary class="faq-summary">
						<span class="faq-question"><?php echo esc_html( $item['question'] ); ?></span>
						<span class="faq-chevron" aria-hidden="true">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</span>
					</summary>
					<div class="faq-answer">
						<p><?php echo esc_html( $item['answer'] ); ?></p>
						<?php if ( ! empty( $item['link_url'] ) && ! empty( $item['link_text'] ) ) : ?>
							<p class="faq-link-wrapper">
								<a href="<?php echo esc_url( $item['link_url'] ); ?>" class="faq-inline-link">
									<?php echo wp_kses_post( $item['link_text'] ); ?>
								</a>
							</p>
						<?php endif; ?>
					</div>
				</details>
			<?php endforeach; ?>
		</div>

	</div>
</section>
