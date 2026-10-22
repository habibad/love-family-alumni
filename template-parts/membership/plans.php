<?php
/**
 * Membership Page — Section 03: Membership Plans
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$plans = function_exists( 'lfa_get_membership_plans' ) ? lfa_get_membership_plans() : [];
?>

<section class="membership-plans-section" id="membership-plans" aria-label="Membership Plans">
	<div class="lfa-container">
		<!-- Section Header -->
		<div class="membership-section-header text-center">
			<span class="membership-eyebrow">CHOOSE YOUR CATEGORY</span>
			<h2 class="membership-section-title">Membership Categories</h2>
			<div class="membership-title-divider" aria-hidden="true"></div>
			<p class="membership-section-lead">
				Designed for graduates of Love Family / UNIBEN living across the United States and Canada. Choose the category that reflects your household fellowship.
			</p>
		</div>

		<!-- Plans Comparison Grid -->
		<div class="membership-plans-grid">
			<?php foreach ( $plans as $plan ) : ?>
				<div class="membership-plan-card <?php echo ! empty( $plan['is_featured'] ) ? 'plan-featured' : ''; ?>" id="plan-<?php echo esc_attr( $plan['id'] ); ?>">
					<?php if ( ! empty( $plan['is_featured'] ) ) : ?>
						<div class="plan-badge-pill" aria-label="Featured category">
							<span>Recommended for Alumni Couples</span>
						</div>
					<?php endif; ?>

					<div class="plan-card-top">
						<div class="plan-header-icon" aria-hidden="true">
							<?php if ( 'couple' === $plan['id'] ) : ?>
								<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
									<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
								</svg>
							<?php else : ?>
								<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
									<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
								</svg>
							<?php endif; ?>
						</div>

						<h3 class="plan-name"><?php echo esc_html( $plan['name'] ); ?></h3>
						<p class="plan-target"><?php echo esc_html( $plan['target'] ); ?></p>
					</div>

					<div class="plan-pricing-box">
						<div class="plan-price-status">
							<span class="price-status-icon" aria-hidden="true">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<circle cx="12" cy="12" r="10"></circle>
									<line x1="12" y1="8" x2="12" y2="12"></line>
									<line x1="12" y1="16" x2="12.01" y2="16"></line>
								</svg>
							</span>
							<span class="plan-price-text"><?php echo esc_html( $plan['price'] ); ?></span>
						</div>
						<span class="plan-cycle-note"><?php echo esc_html( $plan['cycle'] ); ?></span>
					</div>

					<div class="plan-features-wrap">
						<span class="features-label">Included Privileges &amp; Benefits:</span>
						<ul class="plan-features-list">
							<?php foreach ( $plan['features'] as $feature ) : ?>
								<li>
									<span class="check-icon" aria-hidden="true">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
											<polyline points="20 6 9 17 4 12"></polyline>
										</svg>
									</span>
									<span class="feature-text"><?php echo esc_html( $feature ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

					<div class="plan-cta-box">
						<?php
						$cta_url = is_user_logged_in() ? home_url( '/member-dashboard/#dues' ) : home_url( '/member-register/?type=' . urlencode( $plan['id'] ) );
						?>
						<a href="<?php echo esc_url( $cta_url ); ?>" class="btn <?php echo ! empty( $plan['is_featured'] ) ? 'btn-crimson' : 'btn-outline-navy'; ?> btn-block plan-action-btn">
							<span><?php echo esc_html( $plan['cta_text'] ); ?> &rarr;</span>
						</a>
						<span class="plan-footnote">No initial payment required during preliminary registration review.</span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Transparent Official Notice -->
		<div class="membership-plans-notice">
			<div class="notice-icon" aria-hidden="true">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
					<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
				</svg>
			</div>
			<div class="notice-content">
				<p>
					<strong>Official Note on Dues &amp; Contribution Schedules:</strong>
					Official membership contribution rates and collection cycles are subject to final ratification by the North America Zonal Executive Council. Neither automatic renewals nor unauthorized recurring fees will be applied without explicit member consent.
				</p>
			</div>
		</div>
	</div>
</section>
