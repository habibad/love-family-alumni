<?php
/**
 * Events Page — Section 01: Hero Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_bg_image = lfa_image_url( 'Warm Banquet Gathering with Navy Overlay.png' );
?>

<section class="events-hero-section" id="events-hero" aria-label="Events and Gatherings Hero">
	<div class="events-hero-bg-wrapper">
		<img src="<?php echo esc_url( $hero_bg_image ); ?>" 
		     alt="Love Family Alumni Community Gathering" 
		     class="events-hero-bg-img" 
		     loading="eager" 
		     decoding="async">
		<div class="events-hero-gradient-overlay" aria-hidden="true"></div>
	</div>

	<div class="lfa-container events-hero-container">
		<div class="events-hero-inner">
			<div class="events-hero-content">
				
				<!-- Breadcrumb Navigation -->
				<nav class="events-breadcrumb" aria-label="Breadcrumb">
					<ol class="breadcrumb-list">
						<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
						<li class="breadcrumb-separator" aria-hidden="true">/</li>
						<li class="breadcrumb-item breadcrumb-current" aria-current="page">Events</li>
					</ol>
				</nav>

				<span class="events-hero-eyebrow">COMMUNITY &amp; CONNECTION</span>

				<h1 class="events-hero-title">
					The Moments That<br>
					Bring Us Together.
				</h1>

				<p class="events-hero-description">
					From alumni reunions and conferences to community initiatives, stay connected through the moments that strengthen the Love Family.
				</p>

				<div class="events-hero-actions">
					<a href="#events-browse" class="btn btn-crimson events-btn-primary">
						Explore Events
					</a>
					<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="btn btn-outline-white events-btn-secondary">
						2027 Conference
					</a>
				</div>

			</div>
		</div>
	</div>
</section>
