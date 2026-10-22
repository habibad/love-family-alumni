<?php
/**
 * News & Announcements — Featured News Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$featured_story = null;
if ( class_exists( 'LFA_News' ) ) {
	$res = LFA_News::get_news( [ 'featured' => true, 'per_page' => 1 ] );
	if ( ! empty( $res['items'] ) ) {
		$featured_story = $res['items'][0];
	} else {
		$res2 = LFA_News::get_news( [ 'per_page' => 1 ] );
		if ( ! empty( $res2['items'] ) ) {
			$featured_story = $res2['items'][0];
		}
	}
}

if ( ! $featured_story ) {
	$title         = 'Welcome to the Alumni Newsroom: Reconnecting Generations Across North America';
	$story_url     = home_url( '/news-details/?story=2027-conference-preparations' );
	$excerpt       = 'An overview of how our digital newsroom will share verified updates, celebrate community milestones, honor alumni achievements, and preserve our fellowship and legacy.';
	$category_name = 'Announcements';
	$date_display  = 'September 2, 2026';
	$read_time     = '3 min read';
	$featured_img  = get_theme_file_uri( '/assets/images/original-women-community-group.jpg' );
	$badge_text    = 'Official Fellowship';
} else {
	$title         = $featured_story['title'];
	$story_url     = $featured_story['permalink'];
	$excerpt       = $featured_story['summary'] ?? ( $featured_story['excerpt'] ?? '' );
	$category_name = $featured_story['category_label'] ?? 'Announcements';
	$date_display  = $featured_story['date'];
	$read_time     = $featured_story['read_time'] ?? '3 min read';
	$featured_img  = ! empty( $featured_story['image_url'] ) ? $featured_story['image_url'] : get_theme_file_uri( '/assets/images/original-women-community-group.jpg' );
	$badge_text    = 'Official Fellowship';
}
?>
<section class="lfa-news-featured-section" id="featured-story" aria-labelledby="lfa-news-featured-title">
	<div class="lfa-container">
		<div class="lfa-news-featured-header">
			<span class="lfa-news-kicker">FEATURED STORY</span>
		</div>

		<article class="lfa-news-featured-card">
			<!-- Media Column (55% desktop split) -->
			<div class="lfa-news-featured-media">
				<div class="lfa-news-featured-img-wrap">
					<img src="<?php echo esc_url( $featured_img ); ?>" 
					     alt="<?php echo esc_attr( $title ); ?>" 
					     class="lfa-news-featured-img" 
					     width="800" 
					     height="500" 
					     loading="eager">
					<div class="lfa-news-featured-img-badge">
						<span><?php echo esc_html( $badge_text ); ?></span>
					</div>
				</div>
			</div>

			<!-- Editorial Content Column (45% desktop split) -->
			<div class="lfa-news-featured-body">
				<div class="lfa-news-featured-meta">
					<span class="lfa-news-category-badge"><?php echo esc_html( $category_name ); ?></span>
					<span class="lfa-news-date">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
							<line x1="16" y1="2" x2="16" y2="6"></line>
							<line x1="8" y1="2" x2="8" y2="6"></line>
							<line x1="3" y1="10" x2="21" y2="10"></line>
						</svg>
						<?php echo esc_html( $date_display ); ?>
					</span>
					<span class="lfa-news-read-time"><?php echo esc_html( $read_time ); ?></span>
				</div>

				<h2 id="lfa-news-featured-title" class="lfa-news-featured-headline">
					<a href="<?php echo esc_url( $story_url ); ?>">
						<?php echo esc_html( $title ); ?>
					</a>
				</h2>

				<p class="lfa-news-featured-excerpt">
					<?php echo esc_html( $excerpt ); ?>
				</p>

				<div class="lfa-news-featured-footer">
					<a href="<?php echo esc_url( $story_url ); ?>" class="lfa-news-btn lfa-news-btn--read">
						<span>Read Full Story</span>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</a>
				</div>
			</div>
		</article>
	</div>
</section>
