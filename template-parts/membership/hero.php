<?php
/**
 * Membership Page — Section 01: Hero Section (Approved Reference)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_bg_image = lfa_image_url( 'HERO_APPROVED_FIVE_PEOPLE.jpg' );
?>

<section class="membership-hero-section" id="membership-hero" aria-label="Membership Hero">
	<div class="membership-hero-bg-wrapper">
		<img src="<?php echo esc_url( $hero_bg_image ); ?>" 
		     alt="Love Family Alumni Members" 
		     class="membership-hero-bg-img" 
		     loading="eager" 
		     decoding="async">
		<div class="membership-hero-gradient-overlay" aria-hidden="true"></div>
	</div>

	<div class="lfa-container membership-hero-container">
		<div class="membership-hero-inner">
			<!-- Left Column: Editorial Headline & Actions -->
			<div class="membership-hero-content">
				<span class="membership-hero-eyebrow">LOVE FAMILY MEMBERSHIP</span>

				<h1 class="membership-hero-title">
					Belong. Connect.<br>
					Grow <span class="hero-gold-italic">Together.</span>
				</h1>

				<p class="membership-hero-description">
					Join a vibrant community of purpose-driven individuals connected by faith, family, friendship and a shared heritage. Together, we build stronger communities and create a lasting legacy for future generations.
				</p>

				<div class="membership-hero-actions">
					<a href="#membership-plans" class="btn btn-crimson membership-btn-primary">
						Become a Member
					</a>
					<a href="#membership-benefits" class="btn btn-outline-white membership-btn-secondary">
						Explore Benefits
					</a>
				</div>
			</div>

			<!-- Far Right: Script Values Stack with Restrained Gold Accent -->
			<div class="membership-hero-values" aria-hidden="true">
				<div class="hero-values-stack">
					<span class="hero-value-item">Faith</span>
					<span class="hero-value-item">Family</span>
					<span class="hero-value-item">Friendship</span>
					<span class="hero-value-item">Service</span>
					<span class="hero-value-item">Legacy</span>
				</div>
				<div class="hero-values-gold-line"></div>
			</div>
		</div>
	</div>
</section>
