<?php
/**
 * Gallery / Archives — Our Heritage Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heritage_data = $args['data']['heritage'] ?? [];
$image_url     = lfa_image_url( $heritage_data['image'] ?? 'original-women-community-group.jpg' );
?>

<section id="gallery-heritage" class="lfa-gallery__heritage" aria-labelledby="lfa-gallery-heritage-heading">
	<div class="lfa-gallery__container">
		<div class="lfa-gallery__heritage-grid">
			
			<!-- Left Column: Editorial Story -->
			<div class="lfa-gallery__heritage-content">
				<div class="lfa-gallery__eyebrow lfa-gallery__eyebrow--gold">
					<?php echo esc_html( $heritage_data['label'] ?? 'OUR HERITAGE' ); ?>
				</div>

				<h2 id="lfa-gallery-heritage-heading" class="lfa-gallery__heritage-heading">
					<?php echo esc_html( $heritage_data['heading'] ?? 'Every Generation Has a Story Worth Preserving.' ); ?>
				</h2>

				<!-- Gold Editorial Ornament -->
				<div class="lfa-gallery__ornament" aria-hidden="true">
					<span class="ornament-line"></span>
					<span class="ornament-diamond">&#9670;</span>
					<span class="ornament-line"></span>
				</div>

				<div class="lfa-gallery__heritage-body">
					<?php foreach ( ( $heritage_data['paragraphs'] ?? [] ) as $para ) : ?>
						<p class="heritage-paragraph"><?php echo esc_html( $para ); ?></p>
					<?php endforeach; ?>
				</div>

				<div class="lfa-gallery__heritage-quote">
					<span class="quote-mark">&ldquo;</span>
					<blockquote class="quote-text"><?php echo esc_html( $heritage_data['quote'] ?? 'One Family. Across borders. Impacting generations.' ); ?></blockquote>
				</div>
			</div>

			<!-- Right Column: Archival Photo Composition -->
			<div class="lfa-gallery__heritage-media">
				<div class="lfa-gallery__heritage-card">
					<div class="heritage-card-inner">
						<img src="<?php echo esc_url( $image_url ); ?>" 
						     alt="<?php echo esc_attr( $heritage_data['image_alt'] ?? 'Love Family Alumni fellowship' ); ?>" 
						     class="heritage-img"
						     loading="lazy">
						<div class="heritage-caption-bar">
							<span class="caption-icon" aria-hidden="true">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
									<circle cx="8.5" cy="8.5" r="1.5"></circle>
									<polyline points="21 15 16 10 5 21"></polyline>
								</svg>
							</span>
							<span class="caption-text"><?php echo esc_html( $heritage_data['image_caption'] ?? 'Generations in fellowship — celebrating enduring bonds across borders.' ); ?></span>
						</div>
					</div>
					<div class="heritage-frame-accent" aria-hidden="true"></div>
				</div>
			</div>

		</div>
	</div>
</section>
