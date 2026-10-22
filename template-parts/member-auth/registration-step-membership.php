<?php
/**
 * Member Auth — Registration Step 03: Membership Selection & Privacy
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$auth_data       = require get_theme_file_path( 'inc/data/demo-member-auth.php' );
$tiers           = $auth_data['registration']['membership_tiers'];
$privacy_options = $auth_data['registration']['privacy_options'];
$affiliations    = $auth_data['registration']['affiliations'];
?>

<div class="registration-step-content" id="step-panel-3" data-step="3" role="tabpanel" aria-labelledby="step-tab-3" style="display: none;">
	<div class="step-header">
		<div class="step-header-main">
			<span class="step-badge">STEP 03 OF 04</span>
			<h2 class="step-title">Account Preferences &amp; Privacy</h2>
			<p class="step-desc">Configure your directory visibility and privacy options. Free General User registration allows immediate account creation; paid membership ($100/yr) can be upgraded from the Membership page.</p>
		</div>
		<div class="step-header-meta" aria-hidden="true">
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
				<span>~1 Min</span>
			</span>
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
				<span>Privacy Setup</span>
			</span>
		</div>
	</div>

	<!-- Account Tier Notice: Free General User Account -->
	<div class="form-group mb-6" id="group-reg-tier">
		<input type="hidden" name="membership_tier" id="tier_general" value="general">
		<input type="hidden" name="membership_type" value="general">
		<div style="background:#f8fafc;border:1px solid #e2e8f0;border-left:4px solid #0f2942;border-radius:8px;padding:16px 20px;">
			<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
				<div>
					<span style="font-size:11px;font-weight:700;color:#0f2942;letter-spacing:0.5px;text-transform:uppercase;">Account Type</span>
					<h4 style="margin:2px 0 4px 0;font-size:16px;color:#0f172a;font-weight:700;">Free General User Account</h4>
					<p style="margin:0;font-size:13px;color:#64748b;line-height:1.4;">
						Registration creates a free general user account. Paid membership ($100/year) is purchased separately from the Membership page.
					</p>
				</div>
				<span class="badge" style="background:#e0f2fe;color:#0369a1;font-weight:700;padding:4px 10px;border-radius:20px;font-size:12px;">NO PAYMENT REQUIRED</span>
			</div>
		</div>
	</div>

	<!-- Directory Privacy Controls -->
	<div class="privacy-selection-block">
		<div class="privacy-header">
			<h4 class="privacy-title">Directory Visibility &amp; Privacy Preferences</h4>
			<p class="privacy-lead">Control how your personal profile will appear across the Love Family North America network.</p>
		</div>

		<div class="privacy-cards-grid">
			<?php foreach ( $privacy_options as $key => $option ) : ?>
				<label class="privacy-option-card <?php echo 'members_only' === $key ? 'privacy-recommended' : ''; ?>" for="privacy_<?php echo esc_attr( $key ); ?>">
					<input type="radio" 
					       name="directory_privacy" 
					       id="privacy_<?php echo esc_attr( $key ); ?>" 
					       value="<?php echo esc_attr( $key ); ?>" 
					       <?php checked( $key, 'members_only' ); ?> 
					       class="privacy-radio-input">
					<div class="privacy-card-inner">
						<div class="privacy-top-row">
							<span class="privacy-badge-pill"><?php echo esc_html( $option['badge'] ); ?></span>
							<div class="privacy-check-icon" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
							</div>
						</div>
						<strong class="privacy-opt-name"><?php echo esc_html( $option['name'] ); ?></strong>
						<p class="privacy-opt-desc"><?php echo esc_html( $option['description'] ); ?></p>
					</div>
				</label>
			<?php endforeach; ?>
		</div>

		<!-- Transparent Privacy Assurance Callout -->
		<div class="privacy-audit-notice">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
			<p>
				<strong>Privacy Enforcement Notice:</strong> Actual directory access permissions and profile visibility will be strictly enforced server-side upon backend integration. No personal details are published or shared from this demonstration interface.
			</p>
		</div>
	</div>

	<!-- Step Navigation -->
	<div class="step-nav-row space-between">
		<button type="button" class="btn btn-outline-navy btn-step-prev" data-prev="2">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="19" y1="12" x2="5" y2="12"></line>
				<polyline points="12 19 5 12 12 5"></polyline>
			</svg>
			<span>Back to Alumni Info</span>
		</button>
		<button type="button" class="btn btn-crimson btn-step-next" data-next="4">
			<span>Proceed to Review &amp; Confirm</span>
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="5" y1="12" x2="19" y2="12"></line>
				<polyline points="12 5 19 12 12 19"></polyline>
			</svg>
		</button>
	</div>
</div>
