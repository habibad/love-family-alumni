<?php
/**
 * Membership Page — Section 06: Member Portal Preview
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$portal_features = function_exists( 'lfa_get_portal_preview_features' ) ? lfa_get_portal_preview_features() : [];
?>

<section class="membership-portal-section" id="portal-preview" aria-label="Member Portal Preview">
	<div class="lfa-container">
		<!-- Section Header -->
		<div class="membership-section-header text-center">
			<span class="membership-eyebrow">DIGITAL ECOSYSTEM PREVIEW</span>
			<h2 class="membership-section-title">The Member Portal Experience</h2>
			<div class="membership-title-divider" aria-hidden="true"></div>
			<p class="membership-section-lead">
				The Love Family North America Member Portal serves as your authenticated dashboard for credentials, conference registration, networking, welfare support, and diaspora engagement.
			</p>
			<div class="portal-demo-disclaimer">
				<span class="disclaimer-badge" style="background:#0F172A;color:#C6933D;font-weight:700;">AUTHENTICATED APPLICATION</span>
				<span class="disclaimer-note">All modules below are connected to your authoritative alumni profile and database ledgers.</span>
			</div>
		</div>

		<!-- Feature Cards Grid (8 Cards) -->
		<div class="membership-portal-grid">
			<?php foreach ( $portal_features as $feature ) : ?>
				<div class="portal-feature-card" id="portal-module-<?php echo esc_attr( $feature['id'] ); ?>">
					<div class="portal-card-top">
						<div class="portal-icon-wrapper" aria-hidden="true">
							<?php
							switch ( $feature['icon'] ) {
								case 'user':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>';
									break;
								case 'id-card':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><line x1="15" y1="8" x2="17" y2="8"/><line x1="15" y1="12" x2="17" y2="12"/><line x1="7" y1="16" x2="17" y2="16"/></svg>';
									break;
								case 'bell':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>';
									break;
								case 'credit-card':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>';
									break;
								case 'calendar':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
									break;
								case 'connect':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
									break;
								case 'briefcase':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>';
									break;
								case 'heart-hand':
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>';
									break;
								default:
									echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>';
									break;
							}
							?>
						</div>
						<span class="portal-card-tag">Portal Service</span>
					</div>

					<div class="portal-card-body">
						<h3 class="portal-feature-title"><?php echo esc_html( $feature['title'] ); ?></h3>
						<p class="portal-feature-desc"><?php echo esc_html( $feature['desc'] ); ?></p>
					</div>

					<div class="portal-card-footer">
						<span class="portal-status-text">
							<span class="portal-status-dot" aria-hidden="true" style="background:#10B981;"></span>
							Active Portal Service
						</span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Interactive Navigation Callout -->
		<div class="portal-login-cta">
			<div class="portal-login-cta-content">
				<h4 class="login-cta-title">Already registered as an Alumni Member?</h4>
				<p class="login-cta-desc">Access your dedicated member dashboard, annual dues statements, conference registrations, and alumni profile.</p>
			</div>
			<div class="portal-login-cta-action">
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( home_url( '/member-dashboard/' ) ); ?>" class="btn btn-crimson">
						<span>Open Member Dashboard &rarr;</span>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/member-login/' ) ); ?>" class="btn btn-outline-gold">
						<span>Member Sign In &rarr;</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
