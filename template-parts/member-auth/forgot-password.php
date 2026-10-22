<?php
/**
 * Member Auth — Forgot Password Component
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$auth_data = require get_theme_file_path( 'inc/data/demo-member-auth.php' );
$brand     = $auth_data['brand'];
$forgot    = $auth_data['forgot_password'];
?>

<div class="lfa-forgot-wrapper" id="lfa-forgot-container">
	<div class="auth-recovery-card">
		<!-- Top Navigation Link -->
		<div class="card-top-nav">
			<a href="<?php echo esc_url( $brand['login_url'] ); ?>" class="back-login-link" aria-label="Return to Member Login">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="19" y1="12" x2="5" y2="12"></line>
					<polyline points="12 19 5 12 12 5"></polyline>
				</svg>
				<span>Return to Member Login</span>
			</a>
		</div>

		<!-- Brand Crest -->
		<div class="card-brand-header text-center">
			<div class="brand-crest-center">
				<img src="<?php echo esc_url( lfa_image_url( $brand['crest_img'] ) ); ?>" 
				     alt="Love Family Alumni Emblem" 
				     width="60" 
				     height="60" 
				     class="recovery-crest-img">
			</div>
			<span class="auth-eyebrow"><?php echo esc_html( $forgot['eyebrow'] ); ?></span>
			<h1 class="recovery-title"><?php echo esc_html( $forgot['heading'] ); ?></h1>
			<p class="recovery-lead"><?php echo esc_html( $forgot['supporting_text'] ); ?></p>
		</div>

		<!-- Secure Password Recovery Notice -->
		<div class="auth-demo-banner" role="status">
			<div class="demo-banner-icon" aria-hidden="true">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
				</svg>
			</div>
			<div class="demo-banner-text">
				<strong>Official Account Recovery</strong>
				<span>Enter your registered email address. A secure, single-use password reset link will be sent to your inbox.</span>
			</div>
		</div>

		<!-- Interactive Alert Box -->
		<div id="forgot-alert-box" class="auth-alert-box" aria-live="polite" style="display: none;"></div>
		<?php
		if ( class_exists( 'LFA_Core' ) ) {
			echo LFA_Core::notice_html();
		}
		?>

		<!-- Interactive Password Recovery Form -->
		<form id="lfa-forgot-form" class="lfa-auth-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
			<input type="hidden" name="action" value="lfa_forgot_password">
			<?php wp_nonce_field( 'lfa_forgot_password', 'lfa_forgot_nonce' ); ?>
			<div class="form-group" id="group-forgot-email">
				<label for="forgot_email" class="form-label">
					<span>Registered Email Address</span>
					<span class="required-mark" aria-hidden="true">*</span>
				</label>
				<div class="input-with-icon">
					<span class="input-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
					</span>
					<input type="email" 
					       id="forgot_email" 
					       name="email" 
					       class="form-control" 
					       placeholder="alumnus@lovefamilyalumni.org" 
					       autocomplete="email" 
					       required 
					       aria-required="true"
					       aria-describedby="forgot_email_error">
				</div>
				<span class="form-error-msg" id="forgot_email_error" role="alert"></span>
			</div>

			<div class="auth-action-group">
				<button type="submit" class="btn btn-crimson btn-block" id="btn-forgot-submit">
					<span>Send Password Reset Link</span>
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="5" y1="12" x2="19" y2="12"></line>
						<polyline points="12 5 19 12 12 19"></polyline>
					</svg>
				</button>
			</div>

			<!-- Backend Integration Note -->
			<div class="recovery-footer-note">
				<p>
					Need immediate assistance accessing your account? Please contact our zonal administrators at
					<a href="mailto:lovefamilyalumni.na@gmail.com" class="auth-inline-link">lovefamilyalumni.na@gmail.com</a>.
				</p>
			</div>
		</form>
	</div>
</div>
