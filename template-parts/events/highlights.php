<?php
/**
 * Events Page — Section 06: Past Event Highlights / Gallery
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$highlight_items = [
	[
		'image'       => 'omaha-podium-2025.jpg',
		'tag'         => '2025 Omaha Reunion',
		'title'       => 'Omaha National Assembly & Keynote',
		'date'        => 'July 2025',
		'location'    => 'Omaha, Nebraska',
		'caption'     => 'Alumni leadership presentations, awards, and fellowship during the historic 2025 gathering in Omaha.',
		'alt'         => 'Alumni podium address and presentation at the 2025 Omaha Reunion',
	],
	[
		'image'       => 'GALLERY_APPROVED_LARGE_GROUP.jpg',
		'tag'         => 'Alumni Gathering Archive',
		'title'       => 'Continental Fellowship Assembly',
		'date'        => 'Historical Assembly',
		'location'    => 'North America Chapter',
		'caption'     => 'A vibrant gathering of The Love Family alumni celebrating enduring faith, family bonds, and institutional milestones.',
		'alt'         => 'Large group gathering of The Love Family alumni commemorating shared fellowship',
	],
	[
		'image'       => 'GALLERY_APPROVED_GROUP_WOMEN.jpg',
		'tag'         => 'Sisterhood Archive',
		'title'       => 'Women Alumni Fellowship Gathering',
		'date'        => 'Regional Fellowship',
		'location'    => 'Atlanta, GA',
		'caption'     => 'An uplifting evening of sisterhood, mutual encouragement, and spiritual reflection among The Love Family alumnae.',
		'alt'         => 'Love Family women alumni fellowship dinner gathering',
	],
];

// Check if gallery/archives page exists
$archive_page = get_page_by_path( 'gallery' ) ? get_page_by_path( 'gallery' ) : get_page_by_path( 'archives' );
$archive_url  = $archive_page ? get_permalink( $archive_page ) : '';
?>

<section class="events-highlights-section" id="events-highlights" aria-label="Past Event Highlights and Photo Archive">
	<div class="lfa-container">
		
		<div class="events-section-header text-center">
			<span class="events-section-eyebrow">PHOTO MEMORIES</span>
			<h2 class="events-section-title">Past Event Highlights</h2>
			<div class="events-title-divider" aria-hidden="true"></div>
			<p class="events-section-lead">
				Reflecting on the cherished moments, joyful smiles, and lasting impact of our alumni gatherings through the years.
			</p>
		</div>

		<!-- 3-Tile Editorial Grid -->
		<div class="highlights-editorial-grid">
			<?php foreach ( $highlight_items as $item ) : ?>
				<article class="highlight-tile-card">
					<div class="highlight-tile-media">
						<img src="<?php echo esc_url( lfa_image_url( $item['image'] ) ); ?>" 
						     alt="<?php echo esc_attr( $item['alt'] ); ?>" 
						     class="highlight-tile-img" 
						     loading="eager" 
						     decoding="async">
						<div class="highlight-tile-overlay" aria-hidden="true"></div>
						
						<div class="highlight-tile-badges">
							<span class="highlight-tag-badge"><?php echo esc_html( $item['tag'] ); ?></span>
						</div>
					</div>

					<div class="highlight-tile-content">
						<div class="highlight-meta-row">
							<span class="highlight-meta-item">
								<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
									<line x1="16" y1="2" x2="16" y2="6"></line>
									<line x1="8" y1="2" x2="8" y2="6"></line>
									<line x1="3" y1="10" x2="21" y2="10"></line>
								</svg>
								<?php echo esc_html( $item['date'] ); ?>
							</span>
							<span class="highlight-meta-separator" aria-hidden="true">&bull;</span>
							<span class="highlight-meta-item">
								<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
									<circle cx="12" cy="10" r="3"></circle>
								</svg>
								<?php echo esc_html( $item['location'] ); ?>
							</span>
						</div>

						<h3 class="highlight-tile-title"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="highlight-tile-caption"><?php echo esc_html( $item['caption'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<!-- Section Bottom Action -->
		<div class="highlights-bottom-action text-center">
			<?php if ( $archive_url ) : ?>
				<a href="<?php echo esc_url( $archive_url ); ?>" class="btn btn-outline-crimson highlights-archive-btn">
					<span>Explore Full Photo Archives</span>
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<polyline points="9 18 15 12 9 6"></polyline>
					</svg>
				</a>
			<?php else : ?>
				<div class="archive-notice-wrap">
					<span class="archive-notice-badge">ARCHIVES IN CURATION</span>
					<p class="archive-notice-text">
						Full photo collections and video records from past reunions will be archived in the member portal soon.
					</p>
				</div>
			<?php endif; ?>
		</div>

	</div>
</section>
