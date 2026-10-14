<?php
/**
 * Give / Donations — Hero Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_data = $args['data']['hero'] ?? [];
$image_url = lfa_image_url( 'original-alumni-community-group.jpg' );
?>

<section class="lfa-give__hero" aria-labelledby="lfa-give-hero-heading" style="--hero-bg: url('<?php echo esc_url( $image_url ); ?>');">
	<div class="lfa-give__hero-overlay" aria-hidden="true"></div>
	<div class="lfa-give__container lfa-give__hero-inner">
		<div class="lfa-give__hero-content">
			<!-- Breadcrumb -->
			<nav class="lfa-give__breadcrumbs" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span class="sep" aria-hidden="true">/</span>
				<span class="current">Give &amp; Support</span>
			</nav>

			<!-- Eyebrow -->
			<div class="lfa-give__eyebrow lfa-give__eyebrow--gold">
				<?php echo esc_html( $hero_data['eyebrow'] ?? 'GIVE & SUPPORT —— LOVE FAMILY ALUMNI' ); ?>
			</div>

			<!-- Main Heading -->
			<h1 id="lfa-give-hero-heading" class="lfa-give__hero-heading">
				<?php echo esc_html( $hero_data['heading_main'] ?? 'Together, We Build' ); ?><br>
				<span class="lfa-gold"><?php echo esc_html( $hero_data['heading_gold'] ?? 'A Lasting Legacy.' ); ?></span>
			</h1>

			<!-- Subtitle -->
			<p class="lfa-give__hero-lead">
				<?php echo esc_html( $hero_data['description'] ?? 'Explore ways to support education, encourage alumni connections, and strengthen the community we share.' ); ?>
			</p>

			<!-- Action Buttons -->
			<div class="lfa-give__hero-actions">
				<a href="<?php echo esc_url( $hero_data['primary_cta']['url'] ?? '#give-categories' ); ?>" class="btn btn-crimson lfa-give__btn-cta">
					<span><?php echo esc_html( $hero_data['primary_cta']['label'] ?? 'Explore Giving Options' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="7" y1="17" x2="17" y2="7"></line>
						<polyline points="7 7 17 7 17 17"></polyline>
					</svg>
				</a>

				<a href="<?php echo esc_url( $hero_data['secondary_cta']['url'] ?? '#give-mission' ); ?>" class="btn btn-outline-white lfa-give__btn-secondary">
					<span><?php echo esc_html( $hero_data['secondary_cta']['label'] ?? 'Our Shared Mission' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="12" y1="5" x2="12" y2="19"></line>
						<polyline points="19 12 12 19 5 12"></polyline>
					</svg>
				</a>
			</div>
		</div>

		<!-- Hero Bottom Strip -->
		<div class="lfa-give__hero-bottom">
			<div class="lfa-give__hero-notice">
				<span class="notice-bullet" aria-hidden="true">&#9678;</span>
				<span><?php echo esc_html( $hero_data['disclaimer'] ?? 'Frontend demonstration — donations are not currently being collected.' ); ?></span>
			</div>
			<div class="lfa-give__hero-badge">
				<?php echo esc_html( $hero_data['status_badge'] ?? '01 / COMMUNITY & LEGACY' ); ?>
			</div>
		</div>
	</div>
</section>
