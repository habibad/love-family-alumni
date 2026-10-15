<?php
/**
 * Gallery / Archives — Hero Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_data = $args['data']['hero'] ?? [];
$image_url = lfa_image_url( $hero_data['cover_image'] ?? 'original-alumni-group.jpg' );
?>

<section class="lfa-gallery__hero" aria-labelledby="lfa-gallery-hero-heading" style="--gallery-hero-bg: url('<?php echo esc_url( $image_url ); ?>');">
	<div class="lfa-gallery__hero-overlay" aria-hidden="true"></div>
	<div class="lfa-gallery__container lfa-gallery__hero-inner">
		<div class="lfa-gallery__hero-content">
			<!-- Breadcrumb -->
			<nav class="lfa-gallery__breadcrumbs" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span class="sep" aria-hidden="true">/</span>
				<span class="current">Gallery &amp; Archives</span>
			</nav>

			<!-- Eyebrow -->
			<div class="lfa-gallery__eyebrow lfa-gallery__eyebrow--gold">
				<?php echo esc_html( $hero_data['eyebrow'] ?? 'OUR HERITAGE · OUR MEMORIES' ); ?>
			</div>

			<!-- Main Heading -->
			<h1 id="lfa-gallery-hero-heading" class="lfa-gallery__hero-heading">
				<?php echo esc_html( $hero_data['heading_main'] ?? 'Moments That Define' ); ?><br>
				<span class="lfa-gold"><?php echo esc_html( $hero_data['heading_gold'] ?? 'Our Legacy.' ); ?></span>
			</h1>

			<!-- Subtitle -->
			<p class="lfa-gallery__hero-lead">
				<?php echo esc_html( $hero_data['description'] ?? 'Preserving our shared history, celebrating meaningful connections, and honoring the memories that bring generations of Love Family alumni together.' ); ?>
			</p>

			<!-- Action Buttons -->
			<div class="lfa-gallery__hero-actions">
				<a href="<?php echo esc_url( $hero_data['primary_cta']['url'] ?? '#featured-collections' ); ?>" class="btn btn-crimson lfa-gallery__btn-cta">
					<span><?php echo esc_html( $hero_data['primary_cta']['label'] ?? 'Explore Gallery' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="7" y1="17" x2="17" y2="7"></line>
						<polyline points="7 7 17 7 17 17"></polyline>
					</svg>
				</a>

				<a href="<?php echo esc_url( $hero_data['secondary_cta']['url'] ?? '#gallery-heritage' ); ?>" class="btn btn-outline-white lfa-gallery__btn-secondary">
					<span><?php echo esc_html( $hero_data['secondary_cta']['label'] ?? 'Our Heritage' ); ?></span>
					<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="12" y1="5" x2="12" y2="19"></line>
						<polyline points="19 12 12 19 5 12"></polyline>
					</svg>
				</a>
			</div>
		</div>

		<!-- Hero Bottom Strip -->
		<div class="lfa-gallery__hero-bottom">
			<div class="lfa-gallery__hero-notice">
				<span class="notice-bullet" aria-hidden="true">&#9678;</span>
				<span><?php echo wp_kses_post( $hero_data['status_pill'] ?? 'HISTORICAL ARCHIVE &amp; COMMUNITY GALLERY' ); ?></span>
			</div>
			<div class="lfa-gallery__hero-badge">
				THE LOVE FAMILY ALUMNI &middot; NORTH AMERICA ZONE
			</div>
		</div>
	</div>
</section>
