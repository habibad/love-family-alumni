<?php
/**
 * Member Auth — Login Form & Split Screen Component
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$auth_data = require get_theme_file_path( 'inc/data/demo-member-auth.php' );
$brand     = $auth_data['brand'];
$login     = $auth_data['login'];
?>

<div class="lfa-auth-split-wrapper" id="lfa-login-wrapper">
	<!-- Left Panel: Editorial & Brand Showcase -->
	<aside class="auth-panel-editorial" aria-label="Alumni Portal Overview">
		<div class="editorial-backdrop" style="background-image: url('<?php echo esc_url( lfa_image_url( $brand['bg_photo'] ) ); ?>');"></div>
		<div class="editorial-overlay"></div>

		<div class="editorial-content">
			<!-- Back to Home Link -->
			<div class="editorial-top-nav">
				<a href="<?php echo esc_url( $brand['home_url'] ); ?>" class="back-home-link" aria-label="Return to Love Family Alumni Homepage">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="19" y1="12" x2="5" y2="12"></line>
						<polyline points="12 19 5 12 12 5"></polyline>
					</svg>
					<span>Return to Homepage</span>
				</a>
			</div>

			<!-- Brand Identity Header -->
			<div class="editorial-brand">
				<div class="brand-crest-wrap">
					<img src="<?php echo esc_url( lfa_image_url( $brand['crest_img'] ) ); ?>" 
					     alt="Love Family Alumni Emblem" 
					     width="64" 
					     height="64" 
					     class="editorial-crest-img">
				</div>
				<div class="brand-text-block">
					<span class="editorial-brand-name"><?php echo esc_html( $brand['name'] ); ?></span>
					<span class="editorial-brand-zone"><?php echo esc_html( $brand['zone'] ); ?></span>
				</div>
			</div>

			<!-- Editorial Copy -->
			<div class="editorial-copy">
				<span class="auth-eyebrow"><?php echo esc_html( $login['eyebrow'] ); ?></span>
				<h1 class="auth-editorial-title"><?php echo esc_html( $login['heading'] ); ?></h1>
				<div class="auth-gold-divider" aria-hidden="true"></div>
				<p class="auth-editorial-lead">
					<?php echo esc_html( $login['supporting_text'] ); ?>
				</p>
			</div>

			<!-- Portal Value Pillars -->
			<div class="editorial-highlights" aria-label="Portal Services">
				<?php foreach ( $login['highlights'] as $item ) : ?>
					<div class="highlight-item">
						<div class="highlight-icon-wrap" aria-hidden="true">
							<?php
							switch ( $item['icon'] ) {
								case 'id-card':
									echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><line x1="15" y1="8" x2="17" y2="8"/><line x1="15" y1="12" x2="17" y2="12"/><line x1="7" y1="16" x2="17" y2="16"/></svg>';
									break;
								case 'connect':
									echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
									break;
								case 'calendar':
									echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
									break;
								default:
									echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>';
									break;
							}
							?>
						</div>
						<div class="highlight-text">
							<strong class="highlight-title"><?php echo esc_html( $item['title'] ); ?></strong>
							<p class="highlight-desc"><?php echo esc_html( $item['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Editorial Footer Tag -->
			<div class="editorial-bottom-note">
				<span class="security-badge">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
					Official Alumni Portal · North America Zone
				</span>
			</div>
		</div>
	</aside>

	<!-- Right Panel: Interactive Login Form -->
	<main class="auth-panel-form" id="login-form-panel" aria-label="Member Login Form">
		<div class="auth-form-card">
			<!-- Mobile Brand Header (Visible only on smaller screens) -->
			<div class="auth-mobile-header">
				<a href="<?php echo esc_url( $brand['home_url'] ); ?>" class="mobile-brand-link">
					<img src="<?php echo esc_url( lfa_image_url( $brand['crest_img'] ) ); ?>" 
					     alt="Love Family Alumni Emblem" 
					     width="48" 
					     height="48" 
					     class="mobile-crest-img">
					<div class="mobile-brand-text">
						<span class="mobile-title"><?php echo esc_html( $brand['name'] ); ?></span>
						<span class="mobile-zone"><?php echo esc_html( $brand['zone'] ); ?></span>
					</div>
				</a>
			</div>

			<!-- Form Header -->
			<div class="auth-card-header">
				<div class="badge-pill-auth">MEMBER ACCESS</div>
				<h2 class="auth-form-title"><?php echo esc_html( $login['form']['heading'] ); ?></h2>
				<p class="auth-form-subtitle"><?php echo esc_html( $login['form']['subtitle'] ); ?></p>
			</div>

			<!-- Official Portal Sign In Notice -->
			<div class="auth-demo-banner" role="status">
				<div class="demo-banner-icon" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
					</svg>
				</div>
				<div class="demo-banner-text">
					<strong>Secure Member Authentication</strong>
					<span>Access is restricted to email-verified and administrator-approved Love Family Alumni accounts.</span>
				</div>
			</div>

			<!-- Form Feedback Toast / Alert Container -->
			<div id="login-alert-box" class="auth-alert-box" aria-live="polite" style="display: none;"></div>
			<?php
			if ( class_exists( 'LFA_Core' ) ) {
				echo LFA_Core::notice_html();
			}
			?>

			<!-- Interactive Login Form -->
			<form id="lfa-login-form" class="lfa-auth-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
				<input type="hidden" name="action" value="lfa_member_login">
				<?php wp_nonce_field( 'lfa_member_login', 'lfa_login_nonce' ); ?>
				<?php
				$redirect_to = isset( $_REQUEST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_REQUEST['redirect_to'] ) ) : '';
				if ( ! empty( $redirect_to ) ) : ?>
					<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">
				<?php endif; ?>
				<!-- Email Address Field -->
				<div class="form-group" id="group-login-email">
					<label for="login_email" class="form-label">
						<span>Email Address</span>
						<span class="required-mark" aria-hidden="true">*</span>
					</label>
					<div class="input-with-icon">
						<span class="input-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
						</span>
						<input type="email" 
						       id="login_email" 
						       name="email" 
						       class="form-control" 
						       placeholder="alumnus@lovefamilyalumni.org" 
						       autocomplete="email" 
						       required 
						       aria-required="true"
						       aria-describedby="login_email_error">
					</div>
					<span class="form-error-msg" id="login_email_error" role="alert"></span>
				</div>

				<!-- Password Field with Show/Hide Toggle -->
				<div class="form-group" id="group-login-password">
					<div class="label-row">
						<label for="login_password" class="form-label">
							<span>Password</span>
							<span class="required-mark" aria-hidden="true">*</span>
						</label>
						<a href="<?php echo esc_url( $brand['forgot_url'] ); ?>" class="auth-inline-link link-forgot">Forgot Password?</a>
					</div>
					<div class="input-with-icon input-password-wrap">
						<span class="input-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
						</span>
						<input type="password" 
						       id="login_password" 
						       name="password" 
						       class="form-control" 
						       placeholder="••••••••••••" 
						       autocomplete="current-password" 
						       required 
						       aria-required="true"
						       aria-describedby="login_password_error">
						<button type="button" 
						        class="btn-toggle-password" 
						        aria-label="Show password" 
						        aria-pressed="false"
						        data-target="login_password">
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
					<span class="form-error-msg" id="login_password_error" role="alert"></span>
				</div>

				<!-- Remember Me Checkbox -->
				<div class="form-row-remember">
					<label class="lfa-custom-checkbox" for="login_remember">
						<input type="checkbox" id="login_remember" name="remember" value="1">
						<span class="checkbox-indicator" aria-hidden="true">
							<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
						</span>
						<span class="checkbox-label-text">
							Remember me on this browser
						</span>
					</label>
				</div>

				<!-- Action Buttons -->
				<div class="auth-action-group">
					<button type="submit" class="btn btn-crimson btn-block btn-auth-submit" id="btn-login-submit">
						<span>Sign In to Member Portal</span>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</button>
				</div>
			</form>

			<!-- Switch to Registration Link -->
			<div class="auth-card-footer">
				<p class="switch-auth-text">
					Not yet registered in the North America Zone?
					<a href="<?php echo esc_url( $brand['register_url'] ); ?>" class="switch-link">
						<strong>Create an Alumni Account &rarr;</strong>
					</a>
				</p>
			</div>
		</div>
	</main>
</div>
