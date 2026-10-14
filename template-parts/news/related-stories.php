<?php
/**
 * News & Announcements — Related Stories Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$story   = isset( $args['story'] ) && is_array( $args['story'] ) ? $args['story'] : null;
$related = ( $story && function_exists( 'lfa_news_task03_related' ) ) ? lfa_news_task03_related( $story, 3) : [];

if ( empty( $related ) ) {
	return;
}
?>
<section class="lfa-news-task03-related" aria-labelledby="lfa-related-heading">
	<div class="lfa-container lfa-news-task03-container">
		<div class="lfa-news-section-header">
			<span class="lfa-news-kicker">EXPLORE MORE</span>
			<h2 id="lfa-related-heading" class="lfa-news-section-title">
				More from Our Newsroom
			</h2>
			<p class="lfa-news-section-lead">
				Continue reading latest updates, milestones, and reports from the Love Family Alumni network.
			</p>
		</div>

		<div class="lfa-news-task03-related__grid">
			<?php foreach ( $related as $item ) : ?>
				<?php
				$rel_id       = $item['id'] ?? 0;
				$rel_slug     = (string) ( $item['slug'] ?? 'demo-news-' . $rel_id );
				$rel_title    = str_replace( '[Demo] ', '', (string) ( $item['title'] ?? 'Alumni Update' ) );
				$rel_category = (string) ( $item['category'] ?? 'General' );
				$rel_date     = (string) ( $item['date'] ?? '' );
				$rel_excerpt  = (string) ( $item['excerpt'] ?? '' );
				$rel_url      = function_exists( 'lfa_news_task03_detail_url' ) ? lfa_news_task03_detail_url( $rel_slug ) : home_url( '/news-details/?story=' . urlencode( $rel_slug ) );
				$rel_image    = function_exists( 'lfa_get_demo_news_image' ) ? lfa_get_demo_news_image( $rel_slug ) : '';
				?>
				<article class="lfa-news-card lfa-news-task03-related__card">
					<?php if ( $rel_image ) : ?>
						<div class="lfa-news-card__media">
							<a href="<?php echo esc_url( $rel_url ); ?>" class="lfa-news-card__media-link" tabindex="-1" aria-hidden="true">
								<img src="<?php echo esc_url( $rel_image ); ?>" 
								     alt="<?php echo esc_attr( $rel_title ); ?>" 
								     class="lfa-news-card__img" 
								     loading="lazy" 
								     width="400" 
								     height="250">
							</a>
							<span class="lfa-news-card__demo-tag">DEMO</span>
						</div>
					<?php endif; ?>

					<div class="lfa-news-card__body">
						<div class="lfa-news-card__meta">
							<span class="lfa-news-card__category"><?php echo esc_html( $rel_category ); ?></span>
							<?php if ( $rel_date && strtotime( $rel_date ) ) : ?>
								<span class="lfa-news-card__date">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
										<line x1="16" y1="2" x2="16" y2="6"></line>
										<line x1="8" y1="2" x2="8" y2="6"></line>
										<line x1="3" y1="10" x2="21" y2="10"></line>
									</svg>
									<?php echo esc_html( date_i18n( 'F j, Y', strtotime( $rel_date ) ) ); ?>
								</span>
							<?php endif; ?>
						</div>

						<h3 class="lfa-news-card__title">
							<a href="<?php echo esc_url( $rel_url ); ?>">
								<?php echo esc_html( $rel_title ); ?>
							</a>
						</h3>

						<p class="lfa-news-card__excerpt">
							<?php echo esc_html( $rel_excerpt ); ?>
						</p>

						<div class="lfa-news-card__footer">
							<a href="<?php echo esc_url( $rel_url ); ?>" class="lfa-news-card__read-link">
								<span>Read Story</span>
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
