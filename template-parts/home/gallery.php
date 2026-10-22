<?php
/**
 * Homepage Community Gallery Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$gallery_items = [
	[
		'image' => 'omaha-podium-2025.jpg',
		'alt'   => 'Alumni Gathering and Podium Presentation at Omaha 2025',
		'class' => 'gallery-card-podium',
	],
	[
		'image' => 'women-alumni-group.jpg',
		'alt'   => 'Women of Love Family Alumni in Traditional Attire',
		'class' => 'gallery-card-women',
	],
	[
		'image' => 'alumni-small-group.jpg',
		'alt'   => 'Alumni Members Connecting at North America Fellowship',
		'class' => 'gallery-card-group',
	],
];
?>
<section class="gallery-section" aria-label="Our People, Our Community">
	<div class="lfa-container">
		<div class="gallery-header-row">
			<div class="gallery-header-left">
				<span class="section-eyebrow eyebrow-crimson">OUR PEOPLE, OUR COMMUNITY</span>
				<h2 class="section-heading gallery-heading">Fellowship. Friendship. Family.</h2>
			</div>
			<div class="gallery-header-right">
				<p class="gallery-header-blurb">
					Moments from our events, gatherings and community engagements across North America.
				</p>
				<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn-outline-navy btn-gallery">
					View All Gallery
				</a>
			</div>
		</div>

		<div class="gallery-grid">
			<?php foreach ( $gallery_items as $item ) : ?>
				<div class="gallery-card <?php echo esc_attr( $item['class'] ); ?>">
					<div class="gallery-card-media">
						<img src="<?php echo esc_url( lfa_image_url( $item['image'] ) ); ?>" 
						     alt="<?php echo esc_attr( $item['alt'] ); ?>" 
						     loading="eager" 
						     decoding="async"
						     class="gallery-card-img">
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
