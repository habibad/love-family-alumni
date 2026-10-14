<?php
/**
 * News & Announcements — Featured News Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$featured_img   = get_theme_file_uri( '/assets/images/original-women-community-group.jpg' );
$story_url      = home_url( '/news-details/?story=demo-news-01' );
?>
<section class="lfa-news-featured-section" id="featured-story" aria-labelledby="lfa-news-featured-title">
	<div class="lfa-container">
		<div class="lfa-news-featured-header">
			<span class="lfa-news-kicker">FEATURED STORY</span>
			<span class="lfa-news-demo-pill" title="Synthetic preview data for design review">DEMO STORY — CONTENT PREVIEW</span>
		</div>

		<article class="lfa-news-featured-card">
			<!-- Media Column (55% desktop split) -->
			<div class="lfa-news-featured-media">
				<div class="lfa-news-featured-img-wrap">
					<img src="<?php echo esc_url( $featured_img ); ?>" 
					     alt="Love Family Alumni community members gathered in fellowship" 
					     class="lfa-news-featured-img" 
					     width="800" 
					     height="500" 
					     loading="eager">
					<div class="lfa-news-featured-img-badge">
						<span>Historical Alumni Fellowship</span>
					</div>
				</div>
			</div>

			<!-- Editorial Content Column (45% desktop split) -->
			<div class="lfa-news-featured-body">
				<div class="lfa-news-featured-meta">
					<span class="lfa-news-category-badge">Announcements</span>
					<span class="lfa-news-date">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
							<line x1="16" y1="2" x2="16" y2="6"></line>
							<line x1="8" y1="2" x2="8" y2="6"></line>
							<line x1="3" y1="10" x2="21" y2="10"></line>
						</svg>
						September 2, 2026
					</span>
					<span class="lfa-news-read-time">3 min read</span>
				</div>

				<h2 id="lfa-news-featured-title" class="lfa-news-featured-headline">
					<a href="<?php echo esc_url( $story_url ); ?>">
						Welcome to the Alumni Newsroom: Reconnecting Generations Across North America
					</a>
				</h2>

				<p class="lfa-news-featured-excerpt">
					An overview of how our digital newsroom will share verified updates, celebrate community milestones, honor alumni achievements, and preserve our fellowship and legacy.
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
