<?php
/**
 * Give / Donations — Donation Preview Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$preview_data   = $args['data']['preview'] ?? [];
$categories     = $args['data']['categories'] ?? [];
$default_cause  = 'Community Outreach';
foreach ( $categories as $c ) {
	if ( ! empty( $c['is_active'] ) ) {
		$default_cause = $c['title'];
		break;
	}
}
$preset_amounts = $preview_data['preset_amounts'] ?? [ 25, 50, 100, 250 ];
$default_amount = $preview_data['default_amount'] ?? 50;
?>

<section id="donation-preview" class="lfa-give__preview" aria-labelledby="lfa-give-preview-heading">
	<div class="lfa-give__container">
		<div class="lfa-give__preview-layout">
			
			<!-- Left Column: Context & Narrative -->
			<div class="lfa-give__preview-info">
				<div class="lfa-give__eyebrow lfa-give__eyebrow--gold">
					<?php echo esc_html( $preview_data['eyebrow'] ?? 'YOUR GIVING JOURNEY' ); ?>
				</div>
				<h2 id="lfa-give-preview-heading" class="lfa-give__preview-heading">
					<?php echo esc_html( $preview_data['heading_main'] ?? 'Every Act of Support' ); ?><br>
					<span class="lfa-gold"><?php echo esc_html( $preview_data['heading_gold'] ?? 'Starts Somewhere.' ); ?></span>
				</h2>
				<p class="lfa-give__preview-lead">
					<?php echo esc_html( $preview_data['description'] ?? 'See how future giving options might work. The controls on this page are a demonstration only; no donations are accepted or processed.' ); ?>
				</p>

				<hr class="lfa-give__preview-divider">

				<!-- Journey Steps -->
				<div class="lfa-give__journey-steps" aria-label="Giving process steps">
					<div class="journey-step">
						<span class="step-text">Choose a cause</span>
						<svg class="step-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
					</div>
					<div class="journey-step">
						<span class="step-text">Choose an amount</span>
						<svg class="step-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
					</div>
					<div class="journey-step">
						<span class="step-text">Review demo</span>
					</div>
				</div>
			</div>

			<!-- Right Column: Interactive Demo Card -->
			<div class="lfa-give__preview-card-wrap">
				<div class="lfa-give__card-preview" id="interactive-donation-card">
					<!-- Top Meta -->
					<div class="lfa-give__card-preview-header">
						<span class="card-eyebrow"><?php echo esc_html( $preview_data['demo_badge'] ?? 'INTERACTIVE DEMO' ); ?></span>
						<span class="badge-no-payment"><?php echo esc_html( $preview_data['notice_pill'] ?? 'NO PAYMENT' ); ?></span>
					</div>

					<h3 class="lfa-give__card-preview-title">
						<?php echo esc_html( $preview_data['card_title'] ?? 'Your Giving Preview' ); ?>
					</h3>

					<hr class="lfa-give__card-preview-hr">

					<!-- Selected Cause Display -->
					<div class="lfa-give__cause-row">
						<span class="cause-label">Selected cause</span>
						<span class="cause-val" id="preview-cause-display"><?php echo esc_html( $default_cause ); ?></span>
					</div>

					<!-- Sample Amounts -->
					<div class="lfa-give__amounts-block">
						<div class="amounts-label-row">
							<span class="amounts-title"><?php echo esc_html( $preview_data['amount_label'] ?? 'Choose a sample amount' ); ?></span>
							<span class="amounts-unit"><?php echo esc_html( $preview_data['amount_unit'] ?? 'USD · illustrative' ); ?></span>
						</div>

						<div class="lfa-give__amount-presets" role="radiogroup" aria-label="Sample donation amounts">
							<?php foreach ( $preset_amounts as $amt ) :
								$is_preset_active = ( (int) $amt === (int) $default_amount );
							?>
								<button type="button" 
								        class="lfa-give__amount-btn <?php echo $is_preset_active ? 'is-active' : ''; ?>"
								        data-amount="<?php echo esc_attr( $amt ); ?>"
								        role="radio"
								        aria-checked="<?php echo $is_preset_active ? 'true' : 'false'; ?>">
									$<?php echo esc_html( $amt ); ?>
								</button>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- Custom Amount Input -->
					<div class="lfa-give__custom-amount-block">
						<label for="give-custom-amount" class="custom-amount-label">
							<?php echo esc_html( $preview_data['custom_label'] ?? 'Or try a custom demo amount' ); ?>
						</label>
						<div class="lfa-give__input-wrapper">
							<span class="currency-prefix" aria-hidden="true">$</span>
							<input type="number" 
							       id="give-custom-amount" 
							       class="lfa-give__custom-input" 
							       placeholder="<?php echo esc_attr( $preview_data['custom_placeholder'] ?? 'Enter custom amount' ); ?>" 
							       min="1" 
							       step="any"
							       aria-label="Custom demo amount">
						</div>
					</div>

					<!-- Review Demo Selection CTA Button -->
					<button type="button" id="give-review-btn" class="btn btn-crimson lfa-give__btn-submit">
						<span><?php echo esc_html( $preview_data['cta_label'] ?? 'Review Demo Selection' ); ?></span>
						<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="7" y1="17" x2="17" y2="7"></line>
							<polyline points="7 7 17 7 17 17"></polyline>
						</svg>
					</button>

					<!-- Bottom Safety Notice -->
					<div class="lfa-give__safety-notice">
						<svg class="notice-info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<circle cx="12" cy="12" r="10"></circle>
							<line x1="12" y1="16" x2="12" y2="12"></line>
							<line x1="12" y1="8" x2="12.01" y2="8"></line>
						</svg>
						<p class="notice-text">
							<strong>Preview only.</strong> <?php echo esc_html( $preview_data['safety_notice'] ?? 'No payment gateway, personal data submission, transaction, receipt or stored donation record.' ); ?>
						</p>
					</div>

				</div>
			</div>

		</div>
	</div>

	<!-- Browser-based Small Review Modal / Panel (Frontend Only) -->
	<div id="give-review-modal" class="lfa-give__modal" role="dialog" aria-modal="true" aria-labelledby="modal-review-title" hidden>
		<div class="lfa-give__modal-backdrop" id="give-modal-backdrop"></div>
		<div class="lfa-give__modal-content">
			<button type="button" class="lfa-give__modal-close" id="give-modal-close-x" aria-label="Close review dialog">&times;</button>
			
			<div class="lfa-give__modal-header">
				<span class="badge-no-payment">FRONTEND DEMO ONLY</span>
				<h3 id="modal-review-title" class="lfa-give__modal-title">Demo Selection Summary</h3>
				<p class="lfa-give__modal-lead">Review your simulated giving options before official programs are established.</p>
			</div>

			<div class="lfa-give__modal-body">
				<div class="summary-line">
					<span class="summary-label">Selected Cause:</span>
					<strong class="summary-value" id="modal-summary-cause"><?php echo esc_html( $default_cause ); ?></strong>
				</div>
				<div class="summary-line">
					<span class="summary-label">Simulated Amount:</span>
					<strong class="summary-value text-crimson" id="modal-summary-amount">$<?php echo esc_html( $default_amount ); ?>.00 USD</strong>
				</div>
				<div class="summary-line">
					<span class="summary-label">Transaction Mode:</span>
					<span class="summary-tag">Static Demonstration (Zero Charges)</span>
				</div>

				<div class="lfa-give__modal-disclaimer">
					<p>Notice: This is a frontend demo interface for layout review and alumni experience feedback. Antigravity has not connected any payment processor (PayPal, Stripe, Pushpay) and no database records are generated.</p>
				</div>
			</div>

			<div class="lfa-give__modal-footer">
				<button type="button" class="btn btn-crimson" id="give-modal-close-btn">
					Done with Preview
				</button>
			</div>
		</div>
	</div>
</section>
