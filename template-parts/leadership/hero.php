<?php
/**
 * Leadership Page — Section 01: Hero Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_bg_image = lfa_image_url( 'original-alumni-group.jpg' );
?>

<section class="leadership-hero" aria-label="Leadership Page Hero">
	<div class="leadership-hero-bg-media" style="background-image: url('<?php echo esc_url( $hero_bg_image ); ?>');">
		<div class="leadership-hero-overlay" aria-hidden="true"></div>
		<div class="leadership-hero-watermark" aria-hidden="true">
			<?php echo lfa_icon( 'watermark', 'leadership-watermark-svg' ); ?>
		</div>
	</div>

	<div class="lfa-container leadership-hero-container">
		<div class="leadership-hero-content">
			<!-- Breadcrumb -->
			<nav class="leadership-breadcrumb" aria-label="Breadcrumb">
				<ol class="breadcrumb-list">
					<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
					<li class="breadcrumb-separator" aria-hidden="true">›</li>
					<li class="breadcrumb-item current" aria-current="page">Leadership</li>
				</ol>
			</nav>

			<!-- Eyebrow -->
			<div class="leadership-eyebrow-wrap">
				<span class="leadership-eyebrow">OUR LEADERSHIP</span>
			</div>

			<!-- Heading -->
			<h1 class="leadership-hero-title">
				<span class="title-line">Servant Leadership.</span>
				<span class="title-line title-highlight">A Stronger Community.</span>
			</h1>

			<!-- Intro Description -->
			<p class="leadership-hero-desc">
				Explore the people and governing bodies supporting connection, fellowship, service, and stewardship across the Love Family Alumni North America Zone.
			</p>
		</div>
	</div>
</section>
