<?php
/**
 * Membership Page — Section 07: Alumni Community Gallery
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$photos = [
	[
		'image'   => 'alumni-group-wide.jpg',
		'caption' => 'Annual Reunion Banquet & Alumni Gathering',
		'tag'     => 'National Fellowship',
		'alt'     => 'Love Family Alumni members gathered in celebratory fellowship',
		'large'   => true,
	],
	[
		'image'   => 'women-alumni-group.jpg',
		'caption' => 'Alumni Sisters in Faith and Sisterhood',
		'tag'     => 'Sisterhood Network',
		'alt'     => 'Love Family Alumni women celebrating togetherness',
		'large'   => false,
	],
	[
		'image'   => 'omaha-podium-2025.jpg',
		'caption' => 'Keynote Ministry at the Omaha Conference',
		'tag'     => 'Spiritual Growth',
		'alt'     => 'Speaker ministering at the Love Family alumni conference podium',
		'large'   => false,
	],
	[
		'image'   => 'alumni-small-group.jpg',
		'caption' => 'Regional Chapter Fellowship & Prayer',
		'tag'     => 'Regional Chapters',
		'alt'     => 'Alumni group members smiling together in close fellowship',
		'large'   => false,
	],
];
?>

<section class="membership-community-section" id="alumni-community" aria-label="Alumni Community Gallery">
	<div class="lfa-container">
		<!-- Section Header -->
		<div class="membership-section-header text-center">
			<span class="membership-eyebrow">OUR VIBRANT FELLOWSHIP</span>
			<h2 class="membership-section-title">Memories, Moments &amp; Milestones</h2>
			<div class="membership-title-divider" aria-hidden="true"></div>
			<p class="membership-section-lead">
				From university corridors to cities across North America, our authentic bonds continue to flourish through shared worship, laughter, and lifelong friendship.
			</p>
		</div>

		<!-- Gallery Grid -->
		<div class="membership-gallery-grid">
			<?php foreach ( $photos as $index => $photo ) : ?>
				<div class="membership-gallery-item <?php echo $photo['large'] ? 'item-large' : 'item-standard'; ?>">
					<div class="gallery-photo-wrap">
						<img src="<?php echo esc_url( lfa_image_url( $photo['image'] ) ); ?>" 
						     alt="<?php echo esc_attr( $photo['alt'] ); ?>" 
						     class="gallery-photo-img" 
						     loading="lazy" 
						     decoding="async">
						<div class="gallery-photo-overlay" aria-hidden="true"></div>
						<div class="gallery-photo-caption">
							<span class="gallery-tag"><?php echo esc_html( $photo['tag'] ); ?></span>
							<p class="gallery-text"><?php echo esc_html( $photo['caption'] ); ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
