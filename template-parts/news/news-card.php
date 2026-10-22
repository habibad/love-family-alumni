<?php
/**
 * News & Announcements — Single News Card Component
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$story = $args['story'] ?? null;
if ( ! $story || ! is_array( $story ) ) {
	return;
}

$id        = $story['id'] ?? 0;
$slug      = $story['slug'] ?? 'demo-news-' . $id;
$raw_title = $story['title'] ?? 'Alumni News Update';
// Clean prefix for editorial display while keeping data-title intact for search
$display_title = str_replace( '[Demo] ', '', $raw_title );
$category  = $story['category'] ?? 'General';
$raw_date  = $story['date'] ?? '2026-09-01';
$formatted_date = date_i18n( 'F j, Y', strtotime( $raw_date ) );
$excerpt   = $story['excerpt'] ?? ( $story['summary'] ?? '' );
$keywords  = isset( $story['keywords'] ) && is_array( $story['keywords'] ) ? implode( ',', $story['keywords'] ) : '';
$is_real   = ! empty( $story['id'] ) && empty( $story['is_demo'] );
$image_url = ! empty( $story['image_url'] ) ? $story['image_url'] : ( function_exists( 'lfa_get_demo_news_image' ) ? lfa_get_demo_news_image( $slug ) : get_theme_file_uri( '/assets/images/original-alumni-group.jpg' ) );
$story_url = ! empty( $story['permalink'] ) ? $story['permalink'] : home_url( '/news-details/?story=' . urlencode( $slug ) );
?>

<article class="lfa-news-card" 
         id="news-item-<?php echo esc_attr( $id ); ?>"
         data-id="<?php echo esc_attr( $id ); ?>"
         data-slug="<?php echo esc_attr( $slug ); ?>"
         data-title="<?php echo esc_attr( strtolower( $raw_title . ' ' . $display_title ) ); ?>"
         data-category="<?php echo esc_attr( $category ); ?>"
         data-date="<?php echo esc_attr( $raw_date ); ?>"
         data-excerpt="<?php echo esc_attr( strtolower( $excerpt ) ); ?>"
         data-keywords="<?php echo esc_attr( strtolower( $keywords ) ); ?>">
	
	<!-- Media Container (16:10 aspect ratio) -->
	<div class="lfa-news-card__media">
		<a href="<?php echo esc_url( $story_url ); ?>" class="lfa-news-card__media-link" tabindex="-1" aria-hidden="true">
			<img src="<?php echo esc_url( $image_url ); ?>" 
			     alt="<?php echo esc_attr( $display_title ); ?>" 
			     class="lfa-news-card__img" 
			     loading="lazy" 
			     width="400" 
			     height="250">
		</a>
		<?php if ( ! $is_real ) : ?>
			<span class="lfa-news-card__demo-tag" title="Synthetic preview content for frontend layout verification">DEMO</span>
		<?php endif; ?>
	</div>

	<!-- Content Body -->
	<div class="lfa-news-card__body">
		<!-- Metadata Row -->
		<div class="lfa-news-card__meta">
			<span class="lfa-news-card__category"><?php echo esc_html( $category ); ?></span>
			<span class="lfa-news-card__date">
				<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
					<line x1="16" y1="2" x2="16" y2="6"></line>
					<line x1="8" y1="2" x2="8" y2="6"></line>
					<line x1="3" y1="10" x2="21" y2="10"></line>
				</svg>
				<?php echo esc_html( $formatted_date ); ?>
			</span>
		</div>

		<!-- Title -->
		<h3 class="lfa-news-card__title">
			<a href="<?php echo esc_url( $story_url ); ?>">
				<?php echo esc_html( $display_title ); ?>
			</a>
		</h3>

		<!-- Excerpt -->
		<p class="lfa-news-card__excerpt">
			<?php echo esc_html( $excerpt ); ?>
		</p>

		<!-- Footer Link -->
		<div class="lfa-news-card__footer">
			<a href="<?php echo esc_url( $story_url ); ?>" class="lfa-news-card__read-link">
				<span>Read Story</span>
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="5" y1="12" x2="19" y2="12"></line>
					<polyline points="12 5 19 12 12 19"></polyline>
				</svg>
			</a>
		</div>
	</div>
</article>
