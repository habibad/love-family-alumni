<?php
/**
 * Homepage Hero Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="hero-section" aria-label="Hero Banner">
	<div class="hero-bg-container">
		<img src="<?php echo esc_url( lfa_image_url( 'alumni-group-wide.jpg' ) ); ?>" 
		     alt="Love Family Alumni Members" 
		     class="hero-bg-image" 
		     loading="eager" 
		     fetchpriority="high">
		<div class="hero-overlay"></div>
	</div>

	<div class="lfa-container hero-container">
		<div class="hero-content">
			<!-- Two-line Eyebrow in Gold -->
			<div class="hero-eyebrow">
				<span class="hero-eyebrow-line">THE LOVE FAMILY ALUMNI</span>
				<span class="hero-eyebrow-line">NORTH AMERICA ZONE</span>
			</div>

			<!-- Main Title -->
			<h1 class="hero-title">
				<span class="hero-title-line">United in Love.</span>
				<span class="hero-title-line">Serving with Purpose.</span>
				<span class="hero-title-line hero-title-highlight">Preserving Our Legacy.</span>
			</h1>

			<!-- Subtitle Copy -->
			<p class="hero-description">
				A vibrant community of purpose-driven individuals connected by faith, family, friendship, service, and a shared heritage. Together, we build stronger communities and a brighter future for generations to come.
			</p>

			<!-- 4 CTA Buttons Row -->
			<div class="hero-cta-grid">
				<?php if ( is_user_logged_in() ) :
					$dashboard_url = class_exists( 'LFA_Auth' ) ? LFA_Auth::get_user_dashboard_url() : home_url( '/member-dashboard/' );
					$is_admin = current_user_can( 'manage_options' ) || current_user_can( 'lfa_view_admin_portal' );
				?>
					<a href="<?php echo esc_url( $dashboard_url ); ?>" class="btn btn-hero btn-hero-crimson">
						<?php echo lfa_icon( 'shield' ); ?>
						<span><?php echo $is_admin ? 'Admin Portal' : 'My Dashboard'; ?></span>
					</a>
					<a href="<?php echo esc_url( home_url( '/member-dashboard/#dues' ) ); ?>" class="btn btn-hero btn-hero-navy">
						<?php echo lfa_icon( 'credit-card' ); ?>
						<span>Membership Dues</span>
					</a>
					<a href="<?php echo esc_url( home_url( '/conference/2027/' ) ); ?>" class="btn btn-hero btn-hero-gold">
						<?php echo lfa_icon( 'calendar' ); ?>
						<span>2027 Conference</span>
					</a>
					<a href="<?php echo esc_url( home_url( '/member-dashboard/#profile' ) ); ?>" class="btn btn-hero btn-hero-outline">
						<?php echo lfa_icon( 'user' ); ?>
						<span>My Profile</span>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/member-register/' ) ); ?>" class="btn btn-hero btn-hero-crimson">
						<?php echo lfa_icon( 'users' ); ?>
						<span>Join Alumni</span>
					</a>
					<a href="<?php echo esc_url( home_url( '/membership/#dues-renewals' ) ); ?>" class="btn btn-hero btn-hero-navy">
						<?php echo lfa_icon( 'credit-card' ); ?>
						<span>Pay Dues</span>
					</a>
					<a href="<?php echo esc_url( home_url( '/conference/2027/' ) ); ?>" class="btn btn-hero btn-hero-gold">
						<?php echo lfa_icon( 'calendar' ); ?>
						<span>2027 Conference</span>
					</a>
					<a href="<?php echo esc_url( home_url( '/member-login/' ) ); ?>" class="btn btn-hero btn-hero-outline">
						<?php echo lfa_icon( 'user' ); ?>
						<span>Member Login</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
