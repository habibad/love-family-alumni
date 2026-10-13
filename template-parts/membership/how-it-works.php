<?php
/**
 * Membership Page — Section 04: How Membership Works (Timeline)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$steps = function_exists( 'lfa_get_membership_steps' ) ? lfa_get_membership_steps() : [];
?>

<section class="membership-process-section" id="how-it-works" aria-label="How Membership Works">
	<div class="lfa-container">
		<!-- Section Header -->
		<div class="membership-section-header text-center">
			<span class="membership-eyebrow">SIMPLE 4-STEP ONBOARDING</span>
			<h2 class="membership-section-title">How Membership Works</h2>
			<div class="membership-title-divider" aria-hidden="true"></div>
			<p class="membership-section-lead">
				We have designed an intentional, respectful accreditation process to preserve authentic alma mater connections and maintain trusted community fellowship.
			</p>
		</div>

		<!-- Step Timeline Grid -->
		<div class="membership-steps-timeline">
			<div class="timeline-connecting-line" aria-hidden="true"></div>

			<div class="membership-steps-grid">
				<?php foreach ( $steps as $index => $step ) : ?>
					<div class="membership-step-card" id="step-<?php echo esc_attr( $step['step'] ); ?>">
						<div class="step-badge-wrap">
							<span class="step-number"><?php echo esc_html( $step['step'] ); ?></span>
							<div class="step-icon-circle" aria-hidden="true">
								<?php
								switch ( $step['icon'] ) {
									case 'id-card':
										echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><line x1="15" y1="8" x2="17" y2="8"/><line x1="15" y1="12" x2="17" y2="12"/><line x1="7" y1="16" x2="17" y2="16"/></svg>';
										break;
									case 'mail':
										echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>';
										break;
									case 'user':
										echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>';
										break;
									case 'graduation-cap':
										echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>';
										break;
									default:
										echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>';
										break;
								}
								?>
							</div>
						</div>

						<div class="step-content">
							<h3 class="step-title"><?php echo esc_html( $step['title'] ); ?></h3>
							<p class="step-desc"><?php echo esc_html( $step['desc'] ); ?></p>
						</div>

						<?php if ( $index < count( $steps ) - 1 ) : ?>
							<div class="step-arrow-indicator" aria-hidden="true">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Process Callout -->
		<div class="membership-process-footer">
			<div class="process-footer-inner">
				<div class="process-footer-text">
					<h4 class="process-footer-title">Ready to begin your journey with Love Family Alumni?</h4>
					<p class="process-footer-desc">Our onboarding team is here to assist graduates through every stage of registration.</p>
				</div>
				<div class="process-footer-action">
					<a href="mailto:lovefamilyalumni.na@gmail.com" class="btn btn-navy">
						<span>Inquire with Zonal Secretariat</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
