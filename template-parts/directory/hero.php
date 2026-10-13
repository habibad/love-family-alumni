<?php
/**
 * Alumni Directory — Section 01: Hero Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_image_filename = 'Warm Banquet Gathering with Navy Overlay.png';
$hero_bg_image = lfa_image_url( $hero_image_filename );
?>

<section class="directory-hero-section" id="directory-hero" aria-label="Alumni Directory Hero">
	<div class="directory-hero-bg-wrapper">
		<img src="<?php echo esc_url( $hero_bg_image ); ?>" 
		     alt="Love Family Alumni Community Gathering" 
		     class="directory-hero-bg-img" 
		     loading="eager" 
		     decoding="async">
		<div class="directory-hero-gradient-overlay" aria-hidden="true"></div>
	</div>

	<div class="lfa-container directory-hero-container">
		<div class="directory-hero-inner">
			<div class="directory-hero-content">
				<span class="directory-hero-eyebrow">ALUMNI DIRECTORY</span>

				<h1 class="directory-hero-title">
					One Family.<br>
					A Global Network.
				</h1>

				<p class="directory-hero-description">
					Browse our alumni directory to reconnect with classmates, expand your network, and explore new opportunities across generations and regions.
				</p>
			</div>
		</div>
	</div>
</section>
