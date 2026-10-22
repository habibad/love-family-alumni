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
			<h2 class="step-title">Membership Package &amp; Privacy</h2>
			<p class="step-desc">Your membership includes full access to the Alumni Directory, Business Directory, and Zonal Conference eligibility for $100/year.</p>
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

	<!-- Membership Package Card (Single Package) -->
	<div class="form-group mb-6" id="group-reg-tier">
		<label class="form-label mb-3">
			<span>Membership Package</span>
		</label>

		<div class="membership-tier-cards-grid" style="grid-template-columns: 1fr;">
			<!-- Annual Membership -->
			<label class="tier-selection-card selected" for="tier_individual" id="card-tier-individual" style="cursor: default;">
				<input type="radio" 
				       name="membership_tier" 
				       id="tier_individual" 
				       value="individual" 
				       checked 
				       class="tier-radio-input"
				       style="display:none;">
				<div class="tier-card-inner">
					<div class="tier-card-header">
						<div class="tier-badge-pill">Annual Membership &mdash; $100/year</div>
						<div class="tier-radio-check" aria-hidden="true" style="background:#137333;border-color:#137333;">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
						</div>
					</div>
					<h4 class="tier-title">Annual Membership</h4>
					<p class="tier-target">Official membership for Love Family / UNIBEN alumni in North America.</p>
					
					<div class="tier-dues-box">
						<span class="dues-amount">$100 / Year</span>
						<span class="dues-schedule">One Year Validity from Payment</span>
					</div>

					<p class="tier-note-disclaimer">
						Annual membership dues ($100.00 USD). Dues are payable after administrator account verification and approval.
					</p>

					<ul class="tier-benefits-list">
						<li>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
							<span>Official digital Alumni ID verification</span>
						</li>
						<li>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
							<span>Full North America Alumni Directory access</span>
						</li>
						<li>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
							<span>North America Business Directory access &amp; listings</span>
						</li>
						<li>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
							<span>Eligibility for North America Zonal Conference registration</span>
						</li>
					</ul>
				</div>
			</label>
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
