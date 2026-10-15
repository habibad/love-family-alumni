<?php
/**
 * Member Auth — Registration Step 02: Alumni Information
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$auth_data    = require get_theme_file_path( 'inc/data/demo-member-auth.php' );
$affiliations = $auth_data['registration']['affiliations'];
$professions  = $auth_data['registration']['professions'];
?>

<div class="registration-step-content" id="step-panel-2" data-step="2" role="tabpanel" aria-labelledby="step-tab-2" style="display: none;">
	<div class="step-header">
		<div class="step-header-main">
			<span class="step-badge">STEP 02 OF 04</span>
			<h2 class="step-title">Alumni Background &amp; Professional Profile</h2>
			<p class="step-desc">Help us establish your fellowship connection and connect you with fellow professionals across North America.</p>
		</div>
		<div class="step-header-meta" aria-hidden="true">
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
				<span>~1 Min</span>
			</span>
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
				<span>Directory Info</span>
			</span>
		</div>
	</div>

	<div class="form-grid-two">
		<!-- Alumni Connection / Affiliation -->
		<div class="form-group" id="group-reg-affiliation">
			<label for="reg_affiliation" class="form-label">
				<span>Alumni Connection / Affiliation</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="select-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
				</span>
				<select id="reg_affiliation" name="affiliation" class="form-control" required aria-required="true" aria-describedby="reg_affiliation_error">
					<option value="">Select alumni connection...</option>
					<?php foreach ( $affiliations as $key => $affil_title ) : ?>
						<option value="<?php echo esc_attr( $affil_title ); ?>">
							<?php echo esc_html( $affil_title ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<span class="form-error-msg" id="reg_affiliation_error" role="alert"></span>
		</div>

		<!-- Graduation Year / Batch (if applicable) -->
		<div class="form-group" id="group-reg-batch">
			<label for="reg_batch" class="form-label">
				<span>Graduation Year / Fellowship Batch</span>
				<span class="optional-label">(If applicable)</span>
			</label>
			<div class="select-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
				</span>
				<select id="reg_batch" name="batch" class="form-control">
					<option value="">Select graduation year or batch...</option>
					<option value="Associate / Not Applicable">Associate / Not Applicable</option>
					<?php for ( $y = 2026; $y >= 1980; $y-- ) : ?>
						<option value="<?php echo esc_attr( 'Class of ' . $y ); ?>">Class of <?php echo esc_html( $y ); ?></option>
					<?php endfor; ?>
				</select>
			</div>
		</div>

		<!-- Profession / Industry -->
		<div class="form-group" id="group-reg-profession">
			<label for="reg_profession" class="form-label">
				<span>Profession / Sector</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="select-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
				</span>
				<select id="reg_profession" name="profession" class="form-control" required aria-required="true" aria-describedby="reg_profession_error">
					<option value="">Select professional field...</option>
					<?php foreach ( $professions as $key => $prof_name ) : ?>
						<option value="<?php echo esc_attr( $prof_name ); ?>">
							<?php echo esc_html( $prof_name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<span class="form-error-msg" id="reg_profession_error" role="alert"></span>
		</div>

		<!-- Current Employer / Organization -->
		<div class="form-group" id="group-reg-employer">
			<label for="reg_employer" class="form-label">
				<span>Employer / Organization</span>
				<span class="optional-label">(Optional)</span>
			</label>
			<div class="input-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line><line x1="9" y1="13" x2="9.01" y2="13"></line><line x1="15" y1="13" x2="15.01" y2="13"></line><line x1="9" y1="17" x2="9.01" y2="17"></line><line x1="15" y1="17" x2="15.01" y2="17"></line></svg>
				</span>
				<input type="text" 
				       id="reg_employer" 
				       name="employer" 
				       class="form-control" 
				       placeholder="e.g. Memorial Hermann Health System / Self-Employed">
			</div>
		</div>

		<!-- Business Ownership Indication -->
		<div class="form-group col-span-2" id="group-reg-business-owner">
			<label class="form-label mb-2">
				<span>Business Ownership in North America</span>
			</label>
			<div class="business-radio-toggle">
				<label class="business-toggle-option">
					<input type="radio" name="is_business_owner" value="yes" id="business_owner_yes">
					<span class="toggle-card">
						<span class="toggle-icon-wrap" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" y1="8" x2="19" y2="14"></line><line x1="22" y1="11" x2="16" y2="11"></line></svg>
						</span>
						<span class="toggle-text-block">
							<strong>Yes, I own or manage a business</strong>
							<small>Eligible for listing in the Love Family North America Business Directory.</small>
						</span>
					</span>
				</label>

				<label class="business-toggle-option">
					<input type="radio" name="is_business_owner" value="no" id="business_owner_no" checked>
					<span class="toggle-card">
						<span class="toggle-icon-wrap" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
						</span>
						<span class="toggle-text-block">
							<strong>No, general professional member</strong>
							<small>Focus on alumni networking, directory connect, and zonal events.</small>
						</span>
					</span>
				</label>
			</div>
		</div>

		<!-- Short Introduction / Bio (Optional) -->
		<div class="form-group col-span-2" id="group-reg-intro">
			<label for="reg_intro" class="form-label">
				<span>Short Introduction / Fellowship Note</span>
				<span class="optional-label">(Optional)</span>
			</label>
			<textarea id="reg_intro" 
			          name="intro" 
			          class="form-control" 
			          rows="3" 
			          placeholder="Briefly introduce yourself, your current city, or share a favorite memory from your Love Family fellowship days..."></textarea>
		</div>
	</div>

	<!-- Step Navigation -->
	<div class="step-nav-row space-between">
		<button type="button" class="btn btn-outline-navy btn-step-prev" data-prev="1">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="19" y1="12" x2="5" y2="12"></line>
				<polyline points="12 19 5 12 12 5"></polyline>
			</svg>
			<span>Back to Personal Details</span>
		</button>
		<button type="button" class="btn btn-crimson btn-step-next" data-next="3">
			<span>Continue to Membership</span>
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="5" y1="12" x2="19" y2="12"></line>
				<polyline points="12 5 19 12 12 19"></polyline>
			</svg>
		</button>
	</div>
</div>
