<?php
/**
 * Contact Us — Hero Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_data = $args['data']['hero'] ?? [];
$image_url = lfa_image_url( $hero_data['cover_image'] ?? 'original-alumni-community-group.jpg' );
?>

<section class="lfa-contact__hero" aria-labelledby="lfa-contact-hero-heading" style="--contact-hero-bg: url('<?php echo esc_url( $image_url ); ?>');">
	<div class="lfa-contact__hero-overlay" aria-hidden="true"></div>
	<div class="lfa-contact__container lfa-contact__hero-inner">
		<div class="lfa-contact__hero-content">
			<!-- Breadcrumb -->
			<nav class="lfa-contact__breadcrumbs" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span class="sep" aria-hidden="true">/</span>
				<span class="current">Contact Us</span>
			</nav>

			<!-- Eyebrow -->
			<div class="lfa-contact__eyebrow lfa-contact__eyebrow--gold">
				<?php echo esc_html( $hero_data['eyebrow'] ?? 'CONNECT WITH LOVE FAMILY' ); ?>
			</div>

			<!-- Main Heading -->
			<h1 id="lfa-contact-hero-heading" class="lfa-contact__hero-heading">
				<?php echo esc_html( $hero_data['heading_main'] ?? 'Every Connection' ); ?><br>
				<span class="lfa-gold"><?php echo esc_html( $hero_data['heading_gold'] ?? 'Strengthens Our Family.' ); ?></span>
			</h1>

			<!-- Subtitle -->
			<p class="lfa-contact__hero-lead">
				<?php echo esc_html( $hero_data['description'] ?? "Have a question, an idea, or a story to share? We're here to connect, support, and grow together as one alumni community." ); ?>
			</p>

			<!-- Action Buttons -->
			<div class="lfa-contact__hero-actions">
				<a href="<?php echo esc_url( $hero_data['primary_cta']['url'] ?? '#contact-form' ); ?>" class="btn btn-crimson lfa-contact__btn-cta">
					<span><?php echo esc_html( $hero_data['primary_cta']['label'] ?? 'Send a Message' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="12" y1="5" x2="12" y2="19"></line>
						<polyline points="19 12 12 19 5 12"></polyline>
					</svg>
				</a>

				<a href="<?php echo esc_url( $hero_data['secondary_cta']['url'] ?? home_url( '/membership/' ) ); ?>" class="btn btn-outline-white lfa-contact__btn-secondary">
					<span><?php echo esc_html( $hero_data['secondary_cta']['label'] ?? 'Explore Membership' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="5" y1="12" x2="19" y2="12"></line>
						<polyline points="12 5 19 12 12 19"></polyline>
					</svg>
				</a>
			</div>
		</div>

		<!-- Hero Bottom Strip -->
		<div class="lfa-contact__hero-bottom">
			<div class="lfa-contact__hero-notice">
				<span class="notice-bullet" aria-hidden="true">&#9678;</span>
				<span><?php echo esc_html( $hero_data['status_badge'] ?? 'OFFICIAL COMMUNICATIONS · NORTH AMERICA ZONE' ); ?></span>
			</div>
			<div class="lfa-contact__hero-badge">
				THE LOVE FAMILY ALUMNI &middot; ESTABLISHED FELLOWSHIP
			</div>
		</div>
	</div>
</section>
