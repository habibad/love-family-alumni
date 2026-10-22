<?php
/**
 * Template Name: LFA — Member Registration
 * Description: Master template for the Love Family Alumni Multi-Step Member Registration page (/member-register/)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$auth_data    = require get_theme_file_path( 'inc/data/demo-member-auth.php' );
$brand        = $auth_data['brand'];
$registration = $auth_data['registration'];
$steps        = $registration['steps'];
?>

<div id="primary" class="lfa-member-auth lfa-register-screen" aria-label="Love Family Alumni Member Registration">
	<!-- Registration Hero Banner -->
	<header class="register-hero-banner" aria-label="Alumni Registration Header">
		<div class="register-hero-bg-layer" aria-hidden="true">
			<img src="<?php echo esc_url( lfa_image_url( 'cta-skyline-bg.jpg' ) ); ?>" 
			     alt="" 
			     class="register-hero-bg-img" 
			     loading="eager" 
			     decoding="async">
			<div class="register-hero-overlay"></div>
		</div>

		<div class="lfa-container register-hero-container">
			<div class="register-hero-content-wrap">
				<div class="register-hero-badge-wrap">
					<span class="register-hero-emblem-pill">
						<img src="<?php echo esc_url( lfa_image_url( $brand['crest_img'] ) ); ?>" 
						     alt="Love Family Emblem" 
						     width="22" 
						     height="22" 
						     class="register-hero-emblem">
						<span>LOVE FAMILY ALUMNI &bull; NORTH AMERICA ZONE</span>
					</span>
				</div>

				<h1 class="register-hero-title">
					Alumni Membership <span class="register-title-gold">Registration</span>
				</h1>

				<p class="register-hero-lead">
					Establish your official alumni presence across the United States and Canada. Connect with fellow alumni, participate in the professional directory, and support our shared generational legacy.
				</p>

				<div class="register-trust-badges">
					<span class="trust-pill">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
						<span>SSL Encrypted Preview</span>
					</span>
					<span class="trust-divider" aria-hidden="true">&bull;</span>
					<span class="trust-pill">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
						<span>Directory Privacy Controls</span>
					</span>
					<span class="trust-divider" aria-hidden="true">&bull;</span>
					<span class="trust-pill">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
						<span>USA &amp; Canada Alumni Network</span>
					</span>
				</div>
			</div>
		</div>
	</header>

	<!-- Registration Interactive Stage -->
	<div class="register-stage-section">
		<div class="lfa-container lfa-auth-container">
			<div class="register-layout-wrapper">
				<!-- Multi-Step Interactive Stepper Bar (Clean 4-Segment Grid) -->
				<nav class="lfa-stepper-nav" aria-label="Registration Progress">
					<ol class="stepper-list" id="lfa-stepper-list">
						<?php foreach ( $steps as $num => $step ) : ?>
							<li class="stepper-item <?php echo 1 === $num ? 'step-active' : ''; ?>" 
							    id="stepper-step-<?php echo esc_attr( $num ); ?>" 
							    data-step="<?php echo esc_attr( $num ); ?>">
								<button type="button" 
								        class="stepper-btn" 
								        id="step-tab-<?php echo esc_attr( $num ); ?>" 
								        aria-controls="step-panel-<?php echo esc_attr( $num ); ?>" 
								        aria-current="<?php echo 1 === $num ? 'step' : 'false'; ?>">
									<div class="stepper-header-row">
										<span class="stepper-circle">
											<span class="stepper-num"><?php echo esc_html( $step['num'] ); ?></span>
											<svg class="stepper-check-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
												<polyline points="20 6 9 17 4 12"></polyline>
											</svg>
										</span>
										<span class="stepper-tag">STEP <?php echo esc_html( $step['num'] ); ?></span>
									</div>
									<div class="stepper-label-group">
										<strong class="stepper-title"><?php echo esc_html( $step['title'] ); ?></strong>
									</div>
									<div class="stepper-segment-track" aria-hidden="true">
										<div class="segment-progress"></div>
									</div>
								</button>
							</li>
						<?php endforeach; ?>
					</ol>
				</nav>

				<!-- Registration Multi-Step Form Wrapper -->
				<div class="register-form-card">
					<!-- In-browser Alert / Message Box -->
					<div id="register-alert-box" class="auth-alert-box" aria-live="polite" style="display: none;"></div>
					<?php
					if ( class_exists( 'LFA_Core' ) ) {
						echo LFA_Core::notice_html();
					}
					?>

					<form id="lfa-registration-form" class="lfa-auth-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
						<input type="hidden" name="action" value="lfa_register_member">
						<?php wp_nonce_field( 'lfa_register_member', 'lfa_registration_nonce' ); ?>
						<div style="position:absolute;left:-10000px" aria-hidden="true">
							<label>Leave this field empty<input type="text" name="lfa_website" tabindex="-1" autocomplete="off"></label>
						</div>
						<?php
						// Step 01: Personal Details
						get_template_part( 'template-parts/member-auth/registration-step-personal' );

						// Step 02: Alumni Information
						get_template_part( 'template-parts/member-auth/registration-step-alumni' );

						// Step 03: Membership Selection & Privacy
						get_template_part( 'template-parts/member-auth/registration-step-membership' );

						// Step 04: Review Details & Confirmation
						get_template_part( 'template-parts/member-auth/registration-review' );
						?>
					</form>
				</div>

				<!-- Switch to Login Footer Link -->
				<div class="register-footer-switch text-center">
					<p class="switch-auth-text">
						Already have an active member account?
						<a href="<?php echo esc_url( $brand['login_url'] ); ?>" class="switch-link">
							<strong>Sign In to Member Portal &rarr;</strong>
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
