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
			<h2 class="step-title">Select Membership Category &amp; Privacy</h2>
			<p class="step-desc">Select whether your membership represents an individual alumnus or an alumni couple, and establish your directory visibility.</p>
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

	<!-- Membership Category Selection Cards -->
	<div class="form-group mb-6" id="group-reg-tier">
		<label class="form-label mb-3">
			<span>Choose Membership Category</span>
			<span class="required-mark" aria-hidden="true">*</span>
		</label>

		<div class="membership-tier-cards-grid">
			<!-- Individual Membership -->
			<label class="tier-selection-card" for="tier_individual" id="card-tier-individual">
				<input type="radio" 
				       name="membership_tier" 
				       id="tier_individual" 
				       value="individual" 
				       checked 
				       class="tier-radio-input">
				<div class="tier-card-inner">
					<div class="tier-card-header">
						<div class="tier-badge-pill"><?php echo esc_html( $tiers['individual']['badge'] ); ?></div>
						<div class="tier-radio-check" aria-hidden="true">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
						</div>
					</div>
					<h4 class="tier-title"><?php echo esc_html( $tiers['individual']['name'] ); ?></h4>
					<p class="tier-target"><?php echo esc_html( $tiers['individual']['target'] ); ?></p>
					
					<div class="tier-dues-box">
						<span class="dues-amount"><?php echo esc_html( $tiers['individual']['dues_summary'] ); ?></span>
						<span class="dues-schedule">Standard Annual Dues</span>
					</div>

					<p class="tier-note-disclaimer">
						<?php echo esc_html( $tiers['individual']['dues_note'] ); ?>
					</p>

					<ul class="tier-benefits-list">
						<?php foreach ( $tiers['individual']['features'] as $f ) : ?>
							<li>
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
								<span><?php echo esc_html( $f ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</label>

			<!-- Couple Membership -->
			<label class="tier-selection-card" for="tier_couple" id="card-tier-couple">
				<input type="radio" 
				       name="membership_tier" 
				       id="tier_couple" 
				       value="couple" 
				       class="tier-radio-input">
				<div class="tier-card-inner">
					<div class="tier-card-header">
						<div class="tier-badge-pill gold-badge"><?php echo esc_html( $tiers['couple']['badge'] ); ?></div>
						<div class="tier-radio-check" aria-hidden="true">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
						</div>
					</div>
					<h4 class="tier-title"><?php echo esc_html( $tiers['couple']['name'] ); ?></h4>
					<p class="tier-target"><?php echo esc_html( $tiers['couple']['target'] ); ?></p>
					
					<div class="tier-dues-box">
						<span class="dues-amount pending-dues"><?php echo esc_html( $tiers['couple']['dues_summary'] ); ?></span>
						<span class="dues-schedule">Zonal Executive Ratification</span>
					</div>

					<p class="tier-note-disclaimer">
						<?php echo esc_html( $tiers['couple']['dues_note'] ); ?>
					</p>

					<ul class="tier-benefits-list">
						<?php foreach ( $tiers['couple']['features'] as $f ) : ?>
							<li>
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
								<span><?php echo esc_html( $f ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</label>
		</div>
	</div>

	<!-- Conditional Spouse / Household Information (Revealed when Couple is chosen) -->
	<div class="conditional-spouse-block" id="spouse-details-section" style="display: none;" aria-live="polite">
		<div class="spouse-block-header">
			<div class="spouse-icon-wrap" aria-hidden="true">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
					<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
				</svg>
			</div>
			<div class="spouse-header-text">
				<h4 class="spouse-block-title">Spouse / Partner Alumni Details</h4>
				<p class="spouse-block-subtitle">Because you selected Couple Membership, please provide your spouse or partner's details for joint alumni records.</p>
			</div>
		</div>

		<div class="form-grid-two">
			<!-- Spouse Full Name -->
			<div class="form-group" id="group-reg-spouse-name">
				<label for="reg_spouse_name" class="form-label">
					<span>Spouse Full Name</span>
					<span class="required-mark" aria-hidden="true">*</span>
				</label>
				<div class="input-with-icon">
					<span class="input-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					</span>
					<input type="text" 
					       id="reg_spouse_name" 
					       name="spouse_name" 
					       class="form-control" 
					       placeholder="e.g. Mrs. Grace Osagie" 
					       aria-describedby="reg_spouse_name_error">
				</div>
				<span class="form-error-msg" id="reg_spouse_name_error" role="alert"></span>
			</div>

			<!-- Spouse Email -->
			<div class="form-group" id="group-reg-spouse-email">
				<label for="reg_spouse_email" class="form-label">
					<span>Spouse Email Address</span>
					<span class="optional-label">(Optional)</span>
				</label>
				<div class="input-with-icon">
					<span class="input-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
					</span>
					<input type="email" 
					       id="reg_spouse_email" 
					       name="spouse_email" 
					       class="form-control" 
					       placeholder="spouse@example.com">
				</div>
			</div>

			<!-- Spouse Alumni Connection -->
			<div class="form-group col-span-2" id="group-reg-spouse-affiliation">
				<label for="reg_spouse_affiliation" class="form-label">
					<span>Spouse Alumni Connection</span>
				</label>
				<div class="select-with-icon">
					<span class="input-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
					</span>
					<select id="reg_spouse_affiliation" name="spouse_affiliation" class="form-control">
						<option value="Also Love Family / UNIBEN Alumnus/Alumna">Also Love Family / UNIBEN Alumnus / Alumna</option>
						<option value="Associate / Partner Household Member">Associate / Partner Household Member</option>
						<option value="Other Fellowship Affiliation">Other Fellowship Affiliation</option>
					</select>
				</div>
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
