<?php
/**
 * Give / Donations — Donation Intent & Preview Section (Phase 08 Real Backend Integration)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$preview_data   = $args['data']['preview'] ?? [];
$categories     = $args['data']['categories'] ?? [];

$default_cause     = 'General Love Family Alumni Fund';
$default_slug      = 'general-fund';
$default_db_id     = 1;
$default_guest_ok  = 0;

if ( class_exists( 'LFA_Donation' ) ) {
	$db_funds = LFA_Donation::get_published_funds();
	if ( ! empty( $db_funds ) ) {
		$first_fund        = $db_funds[0];
		$default_cause     = $first_fund->title;
		$default_slug      = $first_fund->slug;
		$default_db_id     = (int) $first_fund->id;
		$default_guest_ok  = (int) $first_fund->guest_giving_enabled;
	}
}

$preset_amounts = [ 25, 50, 100, 250 ];
$default_amount = 50;

$is_logged_in  = is_user_logged_in();
$current_user  = $is_logged_in ? wp_get_current_user() : null;
$prefill_name  = $current_user ? $current_user->display_name : '';
$prefill_email = $current_user ? $current_user->user_email : '';
$login_url     = home_url( '/member-login/?redirect_to=' . urlencode( home_url( '/give/' ) ) );

$stripe_test_enabled = class_exists( 'LFA_Gateway_Settings' ) && LFA_Gateway_Settings::is_stripe_test_enabled();
?>

<?php if ( isset( $_GET['payment_session_id'] ) ) : ?>
<div style="max-width:1200px;margin:16px auto 0 auto;padding:0 24px;">
	<div id="lfa-give-reconcile-banner" style="background:#eff6ff;border:1px solid #bfdbfe;border-left:4px solid #3b82f6;padding:14px 20px;border-radius:8px;font-size:14px;color:#1e40af;" data-session-id="<?php echo esc_attr( sanitize_text_field( wp_unslash( $_GET['payment_session_id'] ) ) ); ?>">
		<div style="display:flex;align-items:center;gap:12px;">
			<span class="lfa-reconcile-spinner" style="display:inline-block;width:16px;height:16px;border:2px solid #93c5fd;border-top-color:#1d4ed8;border-radius:50%;animation:lfa-spin 0.8s linear infinite;"></span>
			<span id="lfa-give-reconcile-status"><strong>Verifying Test Donation...</strong> Reconciling Stripe checkout session with database ledger...</span>
		</div>
	</div>
</div>
<?php endif; ?>

<section id="donation-preview" class="lfa-give__preview" aria-labelledby="lfa-give-preview-heading">
	<div class="lfa-give__container">
		<div class="lfa-give__preview-layout">
			
			<!-- Left Column: Context & Narrative -->
			<div class="lfa-give__preview-info">
				<div class="lfa-give__eyebrow lfa-give__eyebrow--gold">
					YOUR GIVING JOURNEY
				</div>
				<h2 id="lfa-give-preview-heading" class="lfa-give__preview-heading">
					Every Act of Support<br>
					<span class="lfa-gold">Makes an Eternal Impact.</span>
				</h2>
				<p class="lfa-give__preview-lead">
					Partner with our fellowship through intentional giving. Your contributions directly empower student scholarships, regional gatherings, historical archives, and member welfare programs across North America.
				</p>

				<hr class="lfa-give__preview-divider">

				<!-- Journey Steps -->
				<div class="lfa-give__journey-steps" aria-label="Giving process steps">
					<div class="journey-step">
						<span class="step-text">Choose a cause</span>
						<svg class="step-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
					</div>
					<div class="journey-step">
						<span class="step-text">Select amount</span>
						<svg class="step-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
					</div>
					<div class="journey-step">
						<span class="step-text">Register gift</span>
					</div>
				</div>

				<?php if ( $is_logged_in ) : ?>
					<div style="margin-top: 24px; padding: 14px 18px; background: rgba(255,255,255,0.06); border-radius: 8px; border: 1px solid rgba(255,255,255,0.12);">
						<div style="font-size: 13px; color: #d4af37; font-weight: 600; text-transform: uppercase;">Authenticated Member Giving</div>
						<div style="font-size: 14px; color: #fff; margin-top: 4px;">
							Signed in as <strong><?php echo esc_html( $prefill_name ); ?></strong>. All donations will be recorded to your alumni membership profile.
						</div>
					</div>
				<?php endif; ?>
			</div>

			<!-- Right Column: Interactive Giving Card -->
			<div class="lfa-give__preview-card-wrap">
				<div class="lfa-give__card-preview" id="interactive-donation-card">
					<!-- Top Meta -->
					<div class="lfa-give__card-preview-header">
						<span class="card-eyebrow">OFFICIAL GIVING INTENT</span>
						<span class="badge-no-payment" id="gateway-status-badge">PAYMENT GATEWAY PENDING</span>
					</div>

					<h3 class="lfa-give__card-preview-title">
						Support Love Family Alumni
					</h3>

					<hr class="lfa-give__card-preview-hr">

					<!-- Hidden form state -->
					<input type="hidden" id="give-fund-id" value="<?php echo esc_attr( $default_db_id ); ?>">
					<input type="hidden" id="give-fund-slug" value="<?php echo esc_attr( $default_slug ); ?>">
					<input type="hidden" id="give-fund-guest-enabled" value="<?php echo esc_attr( $default_guest_ok ); ?>">
					<input type="hidden" id="give-is-logged-in" value="<?php echo $is_logged_in ? '1' : '0'; ?>">

					<!-- Selected Cause Display -->
					<div class="lfa-give__cause-row">
						<span class="cause-label">Designated Fund:</span>
						<span class="cause-val" id="preview-cause-display"><?php echo esc_html( $default_cause ); ?></span>
					</div>

					<!-- Sample Amounts -->
					<div class="lfa-give__amounts-block">
						<div class="amounts-label-row">
							<span class="amounts-title">Choose an amount</span>
							<span class="amounts-unit">USD ($)</span>
						</div>

						<div class="lfa-give__amount-presets" role="radiogroup" aria-label="Donation amounts">
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
							Or enter a custom gift amount
						</label>
						<div class="lfa-give__input-wrapper">
							<span class="currency-prefix" aria-hidden="true">$</span>
							<input type="number" 
							       id="give-custom-amount" 
							       class="lfa-give__custom-input" 
							       placeholder="Enter custom USD amount" 
							       min="1" 
							       step="any"
							       aria-label="Custom donation amount">
						</div>
					</div>

					<!-- Donor Identification Details -->
					<div style="margin-top: 18px; padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.1);">
						<div style="margin-bottom: 12px;">
							<label for="give-donor-name" style="display:block; font-size: 13px; color: #e0e0e0; margin-bottom: 4px; font-weight: 500;">
								Donor Display Name *
							</label>
							<input type="text" 
							       id="give-donor-name" 
							       class="lfa-give__custom-input" 
							       style="width: 100%; border-radius: 6px; padding: 8px 12px;"
							       value="<?php echo esc_attr( $prefill_name ); ?>" 
							       placeholder="Your full name"
							       required>
						</div>

						<div style="margin-bottom: 12px;">
							<label for="give-donor-email" style="display:block; font-size: 13px; color: #e0e0e0; margin-bottom: 4px; font-weight: 500;">
								Donor Email Address *
							</label>
							<input type="email" 
							       id="give-donor-email" 
							       class="lfa-give__custom-input" 
							       style="width: 100%; border-radius: 6px; padding: 8px 12px;"
							       value="<?php echo esc_attr( $prefill_email ); ?>" 
							       placeholder="email@example.com"
							       required>
						</div>

						<!-- Anonymous Giving Checkbox (GIV-021, GIV-022) -->
						<div style="margin: 12px 0;">
							<label style="display: flex; align-items: flex-start; gap: 8px; font-size: 13px; color: #ddd; cursor: pointer;">
								<input type="checkbox" id="give-is-anonymous" value="1" style="margin-top: 2px;">
								<span>Make this contribution anonymous on public alumni donor recognitions (your information remains confidential with executive finance).</span>
							</label>
						</div>
					</div>

					<!-- Guest Policy Notice Banner (GIV-020) -->
					<div id="give-guest-policy-notice" style="display: <?php echo ( ! $is_logged_in && ! $default_guest_ok ) ? 'block' : 'none'; ?>; margin: 14px 0; padding: 12px 14px; background: rgba(234, 67, 53, 0.15); border-left: 3px solid #ea4335; border-radius: 4px; font-size: 12px; color: #ffcdd2;">
						<strong>Executive Policy Notice:</strong> Guest giving is currently restricted by executive policy. Please <a href="<?php echo esc_url( $login_url ); ?>" style="color: #fff; text-decoration: underline; font-weight: 600;">sign in with an approved alumni account</a> to submit your donation.
					</div>

					<!-- Gateway Notice Banner (GIV-023, GIV-037) -->
					<div style="margin: 14px 0; padding: 12px 14px; background: rgba(255, 193, 7, 0.1); border-left: 3px solid #ffc107; border-radius: 4px; font-size: 12px; color: #ffe082;">
						<strong>Gateway Status:</strong> PayPal Sandbox configuration is pending client merchant credentials. Submitting will register your giving intent in the official ledger (status: Pending Payment). No credit card charge will occur.
					</div>

					<!-- Error Message Box -->
					<div id="give-error-box" style="display: none; margin: 10px 0; padding: 10px 12px; background: #ffebee; border: 1px solid #ef9a9a; border-radius: 6px; color: #c62828; font-size: 13px;"></div>

					<!-- Submit Intent CTA Button -->
					<button type="button" 
					        id="give-review-btn" 
					        class="btn btn-crimson lfa-give__btn-submit"
					        <?php echo ( ! $is_logged_in && ! $default_guest_ok ) ? 'disabled style="opacity:0.6; cursor:not-allowed;"' : ''; ?>>
						<span id="give-btn-text">Submit Giving Intent</span>
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
							<strong>Official Record:</strong> All donation intents are recorded in our secure WordPress database. Receipts are issued upon verified payment capture.
						</p>
					</div>

				</div>
			</div>

		</div>
	</div>

	<!-- Review & Confirmation Modal -->
	<div id="give-review-modal" class="lfa-give__modal" role="dialog" aria-modal="true" aria-labelledby="modal-review-title" hidden>
		<div class="lfa-give__modal-backdrop" id="give-modal-backdrop"></div>
		<div class="lfa-give__modal-content">
			<button type="button" class="lfa-give__modal-close" id="give-modal-close-x" aria-label="Close dialog">&times;</button>
			
			<div class="lfa-give__modal-header">
				<span class="badge-no-payment" id="modal-status-pill">OFFICIAL INTENT REGISTERED</span>
				<h3 id="modal-review-title" class="lfa-give__modal-title">Giving Intent Summary</h3>
				<p class="lfa-give__modal-lead">Thank you! Your donation intent has been recorded in the Love Family Alumni ledger.</p>
			</div>

			<div class="lfa-give__modal-body">
				<div class="summary-line">
					<span class="summary-label">Reference ID:</span>
					<strong class="summary-value" id="modal-summary-ref" style="font-family: monospace; color: #1a73e8;">DON-2026-PENDING</strong>
				</div>
				<div class="summary-line">
					<span class="summary-label">Selected Cause:</span>
					<strong class="summary-value" id="modal-summary-cause"><?php echo esc_html( $default_cause ); ?></strong>
				</div>
				<div class="summary-line">
					<span class="summary-label">Amount:</span>
					<strong class="summary-value text-crimson" id="modal-summary-amount">$<?php echo esc_html( $default_amount ); ?>.00 USD</strong>
				</div>
				<div class="summary-line">
					<span class="summary-label">Donor Attribution:</span>
					<strong class="summary-value" id="modal-summary-donor">Anonymous Donor</strong>
				</div>
				<div class="summary-line">
					<span class="summary-label">Payment Status:</span>
					<span class="summary-tag" id="modal-summary-status" style="background: #fff8e1; color: #b06000; padding: 3px 8px; border-radius: 4px; font-weight: 600;">Pending Payment (Gateway Setup Pending)</span>
				</div>

				<div class="lfa-give__modal-disclaimer" style="margin-top: 16px; padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 12px; color: #555;">
					<?php if ( $stripe_test_enabled ) : ?>
						<p style="color:#92400e;background:#fffbeb;padding:8px 10px;border-radius:4px;border:1px solid #fde68a;margin-bottom:8px;">
							<strong>STRIPE TEST MODE — NO REAL MONEY CHARGED:</strong> Development payment testing is active. You may complete this donation intent using Stripe test cards.
						</p>
					<?php endif; ?>
					<p><strong>Official Record:</strong> All donation intents are recorded in the Love Family Alumni ledger. Official receipts are issued automatically upon verified payment settlement.</p>
				</div>

				<!-- Accessible Inline Error Box (Replaces JS alerts) -->
				<div id="give-modal-error-box" style="display:none;margin-top:14px;padding:12px 14px;background:#fef2f2;border:1px solid #fecaca;border-radius:6px;color:#991b1b;font-size:13px;" role="alert">
					<div style="display:flex;align-items:flex-start;gap:8px;">
						<span style="display:inline-block;width:18px;height:18px;background:#dc2626;color:#fff;border-radius:50%;text-align:center;line-height:18px;font-size:11px;font-weight:700;flex-shrink:0;">!</span>
						<div>
							<strong style="display:block;margin-bottom:2px;font-size:13px;">Payment Initialization Notice</strong>
							<span id="give-modal-error-msg">Failed to initialize Stripe checkout.</span>
						</div>
					</div>
					<div style="margin-top:10px;display:flex;gap:8px;">
						<button type="button" id="give-modal-retry-btn" style="background:#dc2626;color:#fff;border:none;padding:6px 14px;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">
							Retry Checkout
						</button>
						<button type="button" id="give-modal-dismiss-error-btn" style="background:transparent;color:#7f1d1d;border:1px solid #f87171;padding:6px 12px;border-radius:4px;font-size:12px;cursor:pointer;">
							Dismiss
						</button>
					</div>
				</div>
			</div>

			<div class="lfa-give__modal-footer" style="display:flex;gap:10px;justify-content:flex-end;align-items:center;">
				<button type="button" class="btn btn-outline" id="give-modal-close-btn" style="border:1px solid #dae0e8;background:#fff;color:#475569;padding:10px 18px;border-radius:6px;font-weight:600;cursor:pointer;">
					Close
				</button>
				<?php if ( $stripe_test_enabled ) : ?>
					<button type="button" class="btn btn-crimson" id="give-modal-stripe-btn" style="background:#635bff;color:#fff;border:none;padding:10px 18px;border-radius:6px;font-weight:700;cursor:pointer;display:none;">
						Pay with Stripe Test Checkout &rarr;
					</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
