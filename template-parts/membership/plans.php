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
$plan  = $plans[0] ?? [
	'id'       => 'membership',
	'name'     => 'Annual Membership',
	'target'   => 'For verified Love Family / UNIBEN alumni residing across North America.',
	'price'    => '$100.00 USD',
	'cycle'    => 'Annual Contribution / One Year Validity ($100/yr)',
	'features' => [
		'Full access to the verified North America Zone Alumni Directory',
		'Exclusive access to the North America Business Directory',
		'Eligibility for North America Zonal Conference registration',
		'Direct inclusion in diaspora welfare, benevolence, and prayer chains',
		'Voting participation in Zonal assembly meetings and committee elections',
		'Personalized digital Alumni Credential & verification badge',
	],
];

$user_id       = get_current_user_id();
$is_logged_in  = is_user_logged_in();
$standing_info = $is_logged_in && class_exists( 'LFA_Payment_Entitlements' ) 
	? LFA_Payment_Entitlements::get_dues_standing( $user_id, true ) 
	: [];
$dues_standing  = $standing_info['standing'] ?? 'unpaid';
$is_full_member = $is_logged_in && class_exists( 'LFA_Payment_Entitlements' ) 
	? LFA_Payment_Entitlements::is_full_member( $user_id, true ) 
	: false;
$starts_at   = $standing_info['starts_at'] ?? null;
$ends_at     = $standing_info['ends_at'] ?? null;
$is_approved = $is_logged_in && class_exists( 'LFA_Payment_Entitlements' )
	? LFA_Payment_Entitlements::is_account_approved( $user_id )
	: false;

// Resolve State
if ( ! $is_logged_in ) {
	$state = 'guest';
} elseif ( $is_full_member ) {
	$state = 'active_paid';
} elseif ( $dues_standing === 'expired' ) {
	$state = 'expired';
} else {
	$state = 'general_user';
}
?>

<section class="membership-plans-section" id="membership-plans" aria-label="Membership Plans">
	<div class="lfa-container">
		<!-- Section Header -->
		<div class="membership-section-header text-center">
			<span class="membership-eyebrow">ANNUAL DUES &amp; PRIVILEGES</span>
			<h2 class="membership-section-title">
				<?php 
				if ( $state === 'active_paid' ) {
					echo 'Your Membership Is Active';
				} elseif ( $state === 'expired' ) {
					echo 'Renew Your Membership';
				} elseif ( $state === 'general_user' ) {
					echo 'Activate Your Membership';
				} else {
					echo 'Annual Membership';
				}
				?>
			</h2>
			<div class="membership-title-divider" aria-hidden="true"></div>
			<p class="membership-section-lead">
				Designed for graduates of Love Family / UNIBEN living across the United States and Canada. One unified annual membership package supporting fellowship, community initiatives, and member resources.
			</p>
		</div>

		<!-- Plans Comparison Grid -->
		<div class="membership-plans-grid" style="display:flex;justify-content:center;max-width:540px;margin:0 auto;">
			<div class="membership-plan-card plan-featured" id="plan-membership" style="width:100%;">
				<div class="plan-badge-pill" aria-label="Official package">
					<?php if ( $state === 'active_paid' ) : ?>
						<span style="background:#16a34a;color:#fff;">MEMBERSHIP ACTIVE &bull; $100/YR</span>
					<?php elseif ( $state === 'expired' ) : ?>
						<span style="background:#dc2626;color:#fff;">MEMBERSHIP EXPIRED &bull; RENEWAL REQUIRED</span>
					<?php else : ?>
						<span>Annual Membership &mdash; $100/year</span>
					<?php endif; ?>
				</div>

				<div class="plan-card-top">
					<div class="plan-header-icon" aria-hidden="true">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
							<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
						</svg>
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
					<?php if ( $state === 'active_paid' ) : ?>
						<!-- State 1: Active Paid Member -->
						<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:16px;margin-bottom:16px;font-size:13px;color:#166534;line-height:1.6;text-align:left;">
							<div style="display:flex;align-items:center;gap:6px;font-weight:700;margin-bottom:6px;color:#15803d;">
								<span>✓</span> <span>Active Paid Member in Good Standing</span>
							</div>
							<?php if ( ! empty( $starts_at ) ) : ?>
								<div><strong>Start Date:</strong> <?php echo esc_html( wp_date( get_option( 'date_format' ), strtotime( $starts_at ) ) ); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $ends_at ) ) : ?>
								<div><strong>Expiration Date:</strong> <?php echo esc_html( wp_date( get_option( 'date_format' ), strtotime( $ends_at ) ) ); ?></div>
							<?php endif; ?>
							<div style="margin-top:6px;font-size:12px;color:#166534;">
								<a href="<?php echo esc_url( home_url( '/member-dashboard/#dues' ) ); ?>" style="color:#15803d;font-weight:700;text-decoration:underline;">View Invoices &amp; Receipts &rarr;</a>
							</div>
						</div>
						<a href="<?php echo esc_url( home_url( '/member-dashboard/' ) ); ?>" class="btn btn-outline-navy btn-block plan-action-btn">
							<span>Go to Member Dashboard &rarr;</span>
						</a>
						<span class="plan-footnote">Your annual membership is active. Duplicate payment is not permitted for the active period.</span>

					<?php elseif ( $state === 'expired' ) : ?>
						<!-- State 2: Expired Member -->
						<div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:14px;margin-bottom:16px;font-size:13px;color:#991b1b;line-height:1.5;text-align:left;">
							<strong>Membership Expired:</strong> Your annual Love Family Alumni membership has expired<?php echo !empty($ends_at) ? ' on ' . esc_html( wp_date( get_option( 'date_format' ), strtotime( $ends_at ) ) ) : ''; ?>. Renew your $100 annual dues to restore access to member-exclusive features.
						</div>
						<a href="<?php echo esc_url( home_url( '/member-dashboard/#dues' ) ); ?>" class="btn btn-crimson btn-block plan-action-btn" style="background:#dc2626;border-color:#b91c1c;">
							<span>Renew Membership &mdash; $100 &rarr;</span>
						</a>
						<span class="plan-footnote">Instant automatic restoration of member benefits upon payment settlement.</span>

					<?php elseif ( $state === 'general_user' ) : ?>
						<!-- State 3: Logged-In General User -->
						<?php if ( ! $is_approved ) : ?>
							<div style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:14px;margin-bottom:16px;font-size:13px;color:#92400e;line-height:1.5;text-align:left;">
								<strong>Alumni Verification Pending:</strong> Your alumnus identity is currently awaiting administrator review. Once verified, you will be able to complete your $100 annual membership dues.
							</div>
							<a href="<?php echo esc_url( home_url( '/member-dashboard/' ) ); ?>" class="btn btn-outline-navy btn-block plan-action-btn">
								<span>View My Dashboard &rarr;</span>
							</a>
							<span class="plan-footnote">You can manage your profile while alumni verification is being reviewed.</span>
						<?php else : ?>
							<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:14px;margin-bottom:16px;font-size:13px;color:#166534;line-height:1.5;text-align:left;">
								<strong>Alumni Account Approved!</strong> Purchase your $100 annual membership to immediately activate directory, business, and conference privileges.
							</div>
							<a href="<?php echo esc_url( home_url( '/member-dashboard/#dues' ) ); ?>" class="btn btn-crimson btn-block plan-action-btn">
								<span>Purchase Membership &mdash; $100/year &rarr;</span>
							</a>
							<span class="plan-footnote">One full calendar year of member access starting from payment verification.</span>
						<?php endif; ?>

					<?php else : ?>
						<!-- State 4: Guest Visitor -->
						<a href="<?php echo esc_url( home_url( '/member-register/' ) ); ?>" class="btn btn-crimson btn-block plan-action-btn">
							<span>Create Account to Join &rarr;</span>
						</a>
						<span class="plan-footnote">Registration creates your free general account. Paid membership ($100/yr) is purchased upon login.</span>
					<?php endif; ?>
				</div>
			</div>
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
