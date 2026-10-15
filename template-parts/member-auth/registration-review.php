<?php
/**
 * Member Auth — Registration Step 04: Review & Confirmation
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$auth_data = require get_theme_file_path( 'inc/data/demo-member-auth.php' );
$brand     = $auth_data['brand'];
?>

<div class="registration-step-content" id="step-panel-4" data-step="4" role="tabpanel" aria-labelledby="step-tab-4" style="display: none;">
	<div class="step-header">
		<div class="step-header-main">
			<span class="step-badge">STEP 04 OF 04</span>
			<h2 class="step-title">Review Registration Details &amp; Consent</h2>
			<p class="step-desc">Please review all submitted information below. You may click "Edit" on any section to modify your details before previewing.</p>
		</div>
		<div class="step-header-meta" aria-hidden="true">
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
				<span>Final Step</span>
			</span>
			<span class="meta-pill">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
				<span>Static Preview</span>
			</span>
		</div>
	</div>

	<!-- Review Summary Container (Dynamically updated via JS) -->
	<div class="review-summary-grid">
		<!-- Section 1: Personal Details Summary -->
		<div class="summary-section-card" id="summary-card-personal">
			<div class="summary-card-header">
				<div class="summary-title-group">
					<span class="summary-num">01</span>
					<h4 class="summary-heading">Personal Details</h4>
				</div>
				<button type="button" class="btn-review-edit" data-target-step="1" aria-label="Edit Personal Details">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
					<span>Edit</span>
				</button>
			</div>
			<div class="summary-card-body">
				<dl class="summary-dl">
					<div class="summary-row">
						<dt>Full Name:</dt>
						<dd id="sum-name" class="highlight-val">Not provided</dd>
					</div>
					<div class="summary-row">
						<dt>Email Address:</dt>
						<dd id="sum-email">Not provided</dd>
					</div>
					<div class="summary-row">
						<dt>Phone Number:</dt>
						<dd id="sum-phone">Not provided</dd>
					</div>
					<div class="summary-row">
						<dt>Location:</dt>
						<dd id="sum-location">Not provided</dd>
					</div>
					<div class="summary-row">
						<dt>Security:</dt>
						<dd class="text-success">Password entered &amp; verified (client-side only)</dd>
					</div>
				</dl>
			</div>
		</div>

		<!-- Section 2: Alumni Information Summary -->
		<div class="summary-section-card" id="summary-card-alumni">
			<div class="summary-card-header">
				<div class="summary-title-group">
					<span class="summary-num">02</span>
					<h4 class="summary-heading">Alumni Information</h4>
				</div>
				<button type="button" class="btn-review-edit" data-target-step="2" aria-label="Edit Alumni Information">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
					<span>Edit</span>
				</button>
			</div>
			<div class="summary-card-body">
				<dl class="summary-dl">
					<div class="summary-row">
						<dt>Affiliation:</dt>
						<dd id="sum-affiliation">Not selected</dd>
					</div>
					<div class="summary-row">
						<dt>Graduation / Batch:</dt>
						<dd id="sum-batch">Not specified</dd>
					</div>
					<div class="summary-row">
						<dt>Profession:</dt>
						<dd id="sum-profession">Not selected</dd>
					</div>
					<div class="summary-row">
						<dt>Employer / Org:</dt>
						<dd id="sum-employer">Not specified</dd>
					</div>
					<div class="summary-row">
						<dt>Business Owner:</dt>
						<dd id="sum-business">No</dd>
					</div>
					<div class="summary-row" id="sum-row-intro">
						<dt>Introduction:</dt>
						<dd id="sum-intro">None provided</dd>
					</div>
				</dl>
			</div>
		</div>

		<!-- Section 3: Membership Category & Privacy Summary -->
		<div class="summary-section-card" id="summary-card-membership">
			<div class="summary-card-header">
				<div class="summary-title-group">
					<span class="summary-num">03</span>
					<h4 class="summary-heading">Membership &amp; Directory Privacy</h4>
				</div>
				<button type="button" class="btn-review-edit" data-target-step="3" aria-label="Edit Membership & Privacy">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
					<span>Edit</span>
				</button>
			</div>
			<div class="summary-card-body">
				<dl class="summary-dl">
					<div class="summary-row">
						<dt>Selected Category:</dt>
						<dd id="sum-tier" class="highlight-val">Individual Membership</dd>
					</div>
					<div class="summary-row" id="sum-row-spouse" style="display: none;">
						<dt>Spouse Details:</dt>
						<dd id="sum-spouse">None</dd>
					</div>
					<div class="summary-row">
						<dt>Dues Schedule:</dt>
						<dd id="sum-dues">$100 Annual Dues requirement (No payment charged during preview)</dd>
					</div>
					<div class="summary-row">
						<dt>Directory Privacy:</dt>
						<dd id="sum-privacy">Members Only (Recommended)</dd>
					</div>
				</dl>
			</div>
		</div>
	</div>

	<!-- Strict Static Demonstration Notice Banner -->
	<div class="auth-demo-banner banner-prominent" role="alert">
		<div class="demo-banner-icon icon-prominent" aria-hidden="true">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
				<line x1="12" y1="9" x2="12" y2="13"></line>
				<line x1="12" y1="17" x2="12.01" y2="17"></line>
			</svg>
		</div>
		<div class="demo-banner-text">
			<strong class="banner-strong-title">Important Notice — Static Demonstration Preview</strong>
			<p class="banner-body-text">
				This is a frontend demonstration. Your registration has not been submitted or saved. No user account is created, no database records are modified, and no confirmation emails or payment charges occur during this phase.
			</p>
		</div>
	</div>

	<!-- Consent and Placeholder Terms Checkbox -->
	<div class="consent-block" id="group-reg-consent">
		<label class="lfa-custom-checkbox" for="reg_consent">
			<input type="checkbox" id="reg_consent" name="consent" value="1" required aria-required="true">
			<span class="checkbox-indicator" aria-hidden="true">
				<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
			</span>
			<span class="checkbox-label-text">
				I confirm that the information entered above is accurate and express my interest in joining the Love Family Alumni Association (North America Zone).
				<small class="consent-disclaimer">(Placeholder terms &amp; conditions notice for frontend review purposes)</small>
			</span>
		</label>
		<span class="form-error-msg" id="reg_consent_error" role="alert"></span>
	</div>

	<!-- Step Navigation / Final Action -->
	<div class="step-nav-row space-between">
		<button type="button" class="btn btn-outline-navy btn-step-prev" data-prev="3">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="19" y1="12" x2="5" y2="12"></line>
				<polyline points="12 19 5 12 12 5"></polyline>
			</svg>
			<span>Back to Membership</span>
		</button>
		<button type="button" class="btn btn-crimson btn-reg-submit" id="btn-reg-preview-submit">
			<span>Review Registration Preview</span>
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
				<polyline points="22 4 12 14.01 9 11.01"></polyline>
			</svg>
		</button>
	</div>

	<!-- Registration Demonstration Success Modal -->
	<div id="reg-success-modal" class="auth-modal-backdrop" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="reg-modal-title">
		<div class="auth-modal-card modal-card-lg">
			<button type="button" class="modal-close-btn" id="reg-modal-close-btn" aria-label="Close dialog">&times;</button>
			
			<div class="modal-icon-badge badge-success" aria-hidden="true">
				<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
					<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
					<polyline points="22 4 12 14.01 9 11.01"></polyline>
				</svg>
			</div>

			<h3 id="reg-modal-title" class="modal-title">Registration Preview Verified!</h3>
			<p class="modal-desc">
				All client-side validation rules have passed successfully. Your simulated membership registration preview is complete.
			</p>

			<div class="modal-info-panel">
				<div class="panel-header-badge">PREVIEW AUDIT CONFIRMATION</div>
				<ul class="modal-audit-list">
					<li>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
						<span><strong>Zero Database Writes:</strong> No database rows or user accounts were created.</span>
					</li>
					<li>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
						<span><strong>Zero Network Persistence:</strong> Passwords and personal data remain isolated in browser memory only.</span>
					</li>
					<li>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
						<span><strong>Dues Protection:</strong> No payment gateway initiated ($100 annual requirement preserved for backend phase).</span>
					</li>
				</ul>
			</div>

			<div class="modal-actions-row">
				<a href="<?php echo esc_url( $brand['login_url'] ); ?>" class="btn btn-crimson">
					<span>View Member Login Preview</span>
				</a>
				<a href="<?php echo esc_url( $brand['home_url'] ); ?>" class="btn btn-outline-navy">
					<span>Return to Homepage</span>
				</a>
				<button type="button" class="btn btn-ghost" id="reg-modal-dismiss-btn">
					Close Preview
				</button>
			</div>
		</div>
	</div>
</div>
