<?php
/**
 * Member Auth — Registration Step 01: Personal Details
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$auth_data = require get_theme_file_path( 'inc/data/demo-member-auth.php' );
$countries = $auth_data['registration']['countries'];
?>

<div class="registration-step-content" id="step-panel-1" data-step="1" role="tabpanel" aria-labelledby="step-tab-1">
	<div class="step-header">
		<div class="step-header-main">
			<span class="step-badge">STEP 01 OF 04</span>
			<h2 class="step-title">Personal Details &amp; Account Security</h2>
			<p class="step-desc">Please provide your legal contact details and choose a secure password for your portal account.</p>
		</div>
		<div class="step-header-meta" aria-hidden="true">
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
				<span>~2 Min</span>
			</span>
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
				<span>SSL Demo</span>
			</span>
		</div>
	</div>

	<div class="form-grid-two">
		<!-- Full Name -->
		<div class="form-group col-span-2" id="group-reg-name">
			<label for="reg_fullname" class="form-label">
				<span>Full Name</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="input-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
				</span>
				<input type="text" 
				       id="reg_fullname" 
				       name="fullname" 
				       class="form-control" 
				       placeholder="e.g. Dr. Emmanuel Osagie" 
				       autocomplete="name" 
				       required 
				       aria-required="true"
				       aria-describedby="reg_fullname_error">
			</div>
			<span class="form-error-msg" id="reg_fullname_error" role="alert"></span>
		</div>

		<!-- Email Address -->
		<div class="form-group" id="group-reg-email">
			<label for="reg_email" class="form-label">
				<span>Email Address</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="input-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
				</span>
				<input type="email" 
				       id="reg_email" 
				       name="email" 
				       class="form-control" 
				       placeholder="alumnus@example.com" 
				       autocomplete="email" 
				       required 
				       aria-required="true"
				       aria-describedby="reg_email_error">
			</div>
			<span class="form-error-msg" id="reg_email_error" role="alert"></span>
		</div>

		<!-- Phone Number -->
		<div class="form-group" id="group-reg-phone">
			<label for="reg_phone" class="form-label">
				<span>Phone Number</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="input-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
				</span>
				<input type="tel" 
				       id="reg_phone" 
				       name="phone" 
				       class="form-control" 
				       placeholder="+1 (555) 000-0000" 
				       autocomplete="tel" 
				       required 
				       aria-required="true"
				       aria-describedby="reg_phone_error">
			</div>
			<span class="form-error-msg" id="reg_phone_error" role="alert"></span>
		</div>

		<!-- Country Selection -->
		<div class="form-group" id="group-reg-country">
			<label for="reg_country" class="form-label">
				<span>Country of Residence</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="select-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
				</span>
				<select id="reg_country" name="country" class="form-control" required aria-required="true" aria-describedby="reg_country_error">
					<option value="">Select country...</option>
					<?php foreach ( $countries as $code => $country_name ) : ?>
						<option value="<?php echo esc_attr( $country_name ); ?>" <?php selected( $country_name, 'United States' ); ?>>
							<?php echo esc_html( $country_name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<span class="form-error-msg" id="reg_country_error" role="alert"></span>
		</div>

		<!-- City / State -->
		<div class="form-group" id="group-reg-citystate">
			<label for="reg_citystate" class="form-label">
				<span>City, State / Province</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="input-with-icon">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
				</span>
				<input type="text" 
				       id="reg_citystate" 
				       name="citystate" 
				       class="form-control" 
				       placeholder="e.g. Houston, TX or Toronto, ON" 
				       required 
				       aria-required="true"
				       aria-describedby="reg_citystate_error">
			</div>
			<span class="form-error-msg" id="reg_citystate_error" role="alert"></span>
		</div>

		<!-- Password -->
		<div class="form-group" id="group-reg-password">
			<label for="reg_password" class="form-label">
				<span>Create Password</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="input-with-icon input-password-wrap">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
				</span>
				<input type="password" 
				       id="reg_password" 
				       name="password" 
				       class="form-control" 
				       placeholder="Minimum 12 characters" 
				       autocomplete="new-password" 
				       minlength="12"
				       required 
				       aria-required="true"
				       aria-describedby="reg_password_error">
				<button type="button" 
				        class="btn-toggle-password" 
				        aria-label="Show password" 
				        aria-pressed="false"
				        data-target="reg_password">
					<svg class="icon-eye-show" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
						<circle cx="12" cy="12" r="3"></circle>
					</svg>
					<svg class="icon-eye-hide" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display: none;">
						<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
						<line x1="1" y1="1" x2="23" y2="23"></line>
					</svg>
				</button>
			</div>
			<div class="password-meter-wrap" aria-hidden="true">
				<div class="password-meter-bar" id="reg-password-meter"></div>
			</div>
			<span class="password-hint-text">Minimum 12 characters with letters &amp; numbers</span>
			<span class="form-error-msg" id="reg_password_error" role="alert"></span>
		</div>

		<!-- Confirm Password -->
		<div class="form-group" id="group-reg-confirmpass">
			<label for="reg_confirmpassword" class="form-label">
				<span>Confirm Password</span>
				<span class="required-mark" aria-hidden="true">*</span>
			</label>
			<div class="input-with-icon input-password-wrap">
				<span class="input-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
				</span>
				<input type="password" 
				       id="reg_confirmpassword" 
				       name="confirmpassword" 
				       class="form-control" 
				       placeholder="Repeat your password" 
				       autocomplete="new-password" 
				       minlength="12"
				       required 
				       aria-required="true"
				       aria-describedby="reg_confirmpassword_error">
				<button type="button" 
				        class="btn-toggle-password" 
				        aria-label="Show password" 
				        aria-pressed="false"
				        data-target="reg_confirmpassword">
					<svg class="icon-eye-show" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
						<circle cx="12" cy="12" r="3"></circle>
					</svg>
					<svg class="icon-eye-hide" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display: none;">
						<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
						<line x1="1" y1="1" x2="23" y2="23"></line>
					</svg>
				</button>
			</div>
			<div class="password-meter-wrap password-meter-placeholder" aria-hidden="true">
				<div class="password-meter-bar" id="reg-confirm-meter"></div>
			</div>
			<span class="password-hint-text">Must match the password entered on the left</span>
			<span class="form-error-msg" id="reg_confirmpassword_error" role="alert"></span>
		</div>
	</div>

	<!-- Step Navigation -->
	<div class="step-nav-row space-between">
		<div class="step-nav-security">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
				<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
			</svg>
			<span>SSL Encrypted Session &bull; Zero Server Data Stored</span>
		</div>
		<button type="button" class="btn btn-crimson btn-step-next" data-next="2">
			<span>Continue to Alumni Information</span>
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="5" y1="12" x2="19" y2="12"></line>
				<polyline points="12 5 19 12 12 19"></polyline>
			</svg>
		</button>
	</div>
</div>
