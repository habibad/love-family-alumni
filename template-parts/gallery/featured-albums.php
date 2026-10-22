<?php
/**
 * Gallery / Archives — Featured Collections (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$albums = [];

if ( class_exists( 'LFA_Archives' ) ) {
	$db_collections = LFA_Archives::get_collections();
	foreach ( $db_collections as $col ) {
		// Get cover photo if available
		$photos = LFA_Archives::get_album_photos( $col['slug'] );
		$cover_url = ! empty( $photos[0]['image_url'] ) ? $photos[0]['image_url'] : get_theme_file_uri( '/assets/images/original-alumni-group.jpg' );

		$albums[] = [
			'id'          => $col['slug'],
			'title'       => $col['title'],
			'category'    => 'Curated Collection (' . $col['item_count'] . ' items)',
			'cover_url'   => $cover_url,
			'description' => $col['description'],
			'link'        => home_url( '/gallery/?album=' . urlencode( $col['slug'] ) ),
			'is_real'     => true,
		];
	}
}

if ( empty( $albums ) ) {
	$raw_albums = $args['data']['featured_albums'] ?? [];
	foreach ( $raw_albums as $a ) {
		$albums[] = [
			'id'          => $a['id'],
			'title'       => $a['title'],
			'category'    => $a['category'],
			'cover_url'   => lfa_image_url( $a['cover'] ),
			'description' => $a['description'],
			'link'        => home_url( '/gallery/?album=' . urlencode( $a['id'] ) ),
			'is_real'     => false,
		];
	}
}
?>

<section id="featured-collections" class="lfa-gallery__featured" aria-labelledby="lfa-gallery-featured-heading">
	<div class="lfa-gallery__container">
		
		<!-- Section Header -->
		<div class="lfa-gallery__section-header">
			<div class="lfa-gallery__header-meta">
				<span class="lfa-gallery__eyebrow lfa-gallery__eyebrow--crimson">FEATURED COLLECTIONS</span>
				<span class="lfa-gallery__status-pill">CURATED ALBUMS</span>
			</div>
			<h2 id="lfa-gallery-featured-heading" class="lfa-gallery__section-heading">
				Moments Preserved <span class="text-crimson">Across Generations.</span>
			</h2>
			<p class="lfa-gallery__section-lead">
				Explore curated photo collections documenting our foundational history, fellowship gatherings, and memorable conference milestones.
			</p>
		</div>

		<!-- Album Cards Grid -->
		<div class="lfa-gallery__album-grid" role="region" aria-label="Featured Album Collections">
			<?php foreach ( $albums as $album ) :
				$cover_url = $album['cover_url'];
			?>
				<article class="lfa-gallery__album-card" id="album-<?php echo esc_attr( $album['id'] ); ?>">
					<!-- Album Media -->
					<div class="album-media-wrap">
						<img src="<?php echo esc_url( $cover_url ); ?>" 
						     alt="<?php echo esc_attr( $album['title'] ); ?>" 
						     class="album-cover-img"
						     loading="lazy">
						<div class="album-overlay" aria-hidden="true"></div>
						<div class="album-badge">
							<?php echo esc_html( $album['category'] ); ?>
						</div>
					</div>

					<!-- Album Info -->
					<div class="album-content">
						<div class="album-meta-top">
							<span class="album-tag">CURATED ALBUM</span>
							<?php if ( empty( $album['is_real'] ) ) : ?>
								<span class="album-demo-flag">ILLUSTRATIVE ARCHIVE</span>
							<?php else : ?>
								<span class="album-demo-flag" style="background:rgba(10,32,58,0.08);color:#0A203A;">DOCUMENTED</span>
							<?php endif; ?>
						</div>
						<h3 class="album-title">
							<a href="<?php echo esc_url( $album['link'] ); ?>" class="album-title-link">
								<?php echo esc_html( $album['title'] ); ?>
							</a>
						</h3>
						<p class="album-desc">
							<?php echo esc_html( $album['description'] ); ?>
						</p>
						<hr class="album-divider">
						<div class="album-footer">
							<a href="<?php echo esc_url( $album['link'] ); ?>" class="album-action-link">
								<span>Explore Collection</span>
								<svg class="action-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<line x1="7" y1="17" x2="17" y2="7"></line>
									<polyline points="7 7 17 7 17 17"></polyline>
								</svg>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>
