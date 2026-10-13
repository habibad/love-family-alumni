<?php
/**
 * Membership Page — Section 08: Frequently Asked Questions (Accordion)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faqs = function_exists( 'lfa_get_membership_faqs' ) ? lfa_get_membership_faqs() : [];
?>

<section class="membership-faq-section" id="membership-faq" aria-label="Frequently Asked Questions">
	<div class="lfa-container">
		<!-- Section Header -->
		<div class="membership-section-header text-center">
			<span class="membership-eyebrow">COMMON QUESTIONS</span>
			<h2 class="membership-section-title">Frequently Asked Questions</h2>
			<div class="membership-title-divider" aria-hidden="true"></div>
			<p class="membership-section-lead">
				Find answers to common inquiries regarding alumni eligibility, dues structures, registration timelines, and directory access.
			</p>
		</div>

		<!-- Accordion Container -->
		<div class="membership-faq-accordion" data-accordion="true">
			<?php foreach ( $faqs as $index => $faq ) : 
				$faq_id = 'faq-item-' . ( $index + 1 );
				$panel_id = 'faq-panel-' . ( $index + 1 );
				$is_first = ( 0 === $index );
			?>
				<div class="faq-accordion-item <?php echo $is_first ? 'is-active' : ''; ?>" id="<?php echo esc_attr( $faq_id ); ?>">
					<h3 class="faq-accordion-header">
						<button type="button" 
						        class="faq-accordion-trigger" 
						        id="trigger-<?php echo esc_attr( $faq_id ); ?>"
						        aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>" 
						        aria-controls="<?php echo esc_attr( $panel_id ); ?>">
							<span class="faq-trigger-question"><?php echo esc_html( $faq['q'] ); ?></span>
							<span class="faq-trigger-icon" aria-hidden="true">
								<svg class="chevron-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</button>
					</h3>

					<div class="faq-accordion-panel" 
					     id="<?php echo esc_attr( $panel_id ); ?>" 
					     role="region" 
					     aria-labelledby="trigger-<?php echo esc_attr( $faq_id ); ?>" 
					     <?php echo ! $is_first ? 'hidden' : ''; ?>>
						<div class="faq-panel-content">
							<p><?php echo esc_html( $faq['a'] ); ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Still have questions help box -->
		<div class="membership-faq-helpbox">
			<div class="helpbox-icon" aria-hidden="true">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
					<path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
				</svg>
			</div>
			<div class="helpbox-content">
				<h4 class="helpbox-title">Have a specific question not covered here?</h4>
				<p class="helpbox-desc">Reach out to our Membership Secretariat at <a href="mailto:lovefamilyalumni.na@gmail.com">lovefamilyalumni.na@gmail.com</a>. We will be delighted to assist you.</p>
			</div>
		</div>
	</div>
</section>
