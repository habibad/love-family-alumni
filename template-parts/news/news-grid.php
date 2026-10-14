<?php
/**
 * News & Announcements — News Grid Section
 *
 * Renders the 3-column desktop / 2-column tablet / 1-column mobile news listing,
 * empty state, and client-side pagination wrapper.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$all_news = function_exists( 'lfa_get_demo_news' ) ? lfa_get_demo_news() : [];
?>
<section class="lfa-news-grid-section" id="news-grid-section" aria-labelledby="lfa-news-grid-title">
	<div class="lfa-container">
		<!-- Section Header -->
		<div class="lfa-news-section-header">
			<div class="lfa-news-section-header__text">
				<span class="lfa-news-kicker">COMMUNITY DISPATCHES</span>
				<h2 id="lfa-news-grid-title" class="lfa-news-section-title">
					Latest News & Community Updates
				</h2>
				<p class="lfa-news-section-lead">
					Browse verified dispatches, alumni celebrations, fellowship reports, and official notices across the North America Zone.
				</p>
			</div>
		</div>

		<!-- News Cards Grid Container -->
		<div id="lfa-news-cards-grid" class="lfa-news-grid" role="region" aria-label="News articles list">
			<?php
			if ( ! empty( $all_news ) ) :
				foreach ( $all_news as $index => $story ) :
					get_template_part(
						'template-parts/news/news-card',
						null,
						[
							'story' => $story,
							'index' => $index,
						]
					);
				endforeach;
			endif;
			?>
		</div>

		<!-- Friendly Empty Results State -->
		<div id="lfa-news-empty-state" class="lfa-news-empty" style="display: none;" role="status">
			<div class="lfa-news-empty__card">
				<div class="lfa-news-empty__icon-wrap">
					<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<circle cx="11" cy="11" r="8"></circle>
						<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						<line x1="8" y1="11" x2="14" y2="11"></line>
					</svg>
				</div>
				<h3 class="lfa-news-empty__title">No Matching Stories Found</h3>
				<p class="lfa-news-empty__message">
					We couldn't find any articles matching your current filter criteria. Try adjusting your keyword search or selecting another category.
				</p>
				<button type="button" id="lfa-news-empty-reset-btn" class="lfa-news-btn lfa-news-btn--primary">
					Reset All Filters
				</button>
			</div>
		</div>

		<!-- Client-Side Pagination Component -->
		<?php get_template_part( 'template-parts/news/pagination' ); ?>
	</div>
</section>
