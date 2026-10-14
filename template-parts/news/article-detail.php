<?php
/**
 * News & Announcements — Single Article Detail Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$story = isset( $args['story'] ) && is_array( $args['story'] ) ? $args['story'] : [];
if ( empty( $story ) ) {
	return;
}

$slug     = (string) ( $story['slug'] ?? 'demo-news-01' );
$category = (string) ( $story['category'] ?? 'Community News' );
$raw_title = (string) ( $story['title'] ?? 'News Update' );
$title    = str_replace( '[Demo] ', '', $raw_title );
$body     = (string) ( $story['body'] ?? $story['excerpt'] ?? '' );
$date     = (string) ( $story['date'] ?? '' );
$formatted_date = ( $date && strtotime( $date ) ) ? date_i18n( 'F j, Y', strtotime( $date ) ) : 'September 2, 2026';
$image    = function_exists( 'lfa_get_demo_news_image' ) ? lfa_get_demo_news_image( $slug ) : '';
?>

<article class="lfa-news-task03-article" aria-labelledby="lfa-article-title">
	<!-- Editorial Dark Navy Hero Header -->
	<header class="lfa-news-task03-article__hero">
		<div class="lfa-container lfa-news-task03-container">
			<nav class="lfa-news-task03-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span class="lfa-news-breadcrumb-separator" aria-hidden="true">/</span>
				<a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">News & Announcements</a>
				<span class="lfa-news-breadcrumb-separator" aria-hidden="true">/</span>
				<span class="lfa-news-breadcrumb-current" aria-current="page"><?php echo esc_html( $category ); ?></span>
			</nav>

			<span class="lfa-news-task03-eyebrow"><?php echo esc_html( $category ); ?></span>
			<h1 id="lfa-article-title" class="lfa-news-task03-article__title"><?php echo esc_html( $title ); ?></h1>

			<div class="lfa-news-task03-meta">
				<span class="lfa-news-task03-demo">DEMO CONTENT — NOT AN OFFICIAL ANNOUNCEMENT</span>
				<span class="lfa-news-task03-date">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
						<line x1="16" y1="2" x2="16" y2="6"></line>
						<line x1="8" y1="2" x2="8" y2="6"></line>
						<line x1="3" y1="10" x2="21" y2="10"></line>
					</svg>
					<time datetime="<?php echo esc_attr( $date ); ?>"><?php echo esc_html( $formatted_date ); ?></time>
				</span>
				<span class="lfa-news-task03-readtime">3 min read</span>
			</div>
		</div>
	</header>

	<!-- Article Body & Sidebar Two-Column Layout -->
	<div class="lfa-container lfa-news-task03-container lfa-news-task03-article__layout">
		<!-- Main Editorial Content Column -->
		<div class="lfa-news-task03-article__main">
			<?php if ( $image ) : ?>
				<div class="lfa-news-task03-article__media">
					<img class="lfa-news-task03-article__image" 
					     src="<?php echo esc_url( $image ); ?>" 
					     alt="<?php echo esc_attr( $title ); ?>" 
					     loading="eager" 
					     width="800" 
					     height="450">
					<span class="lfa-news-caption">Photo: Love Family Alumni Archive — North America Zone Fellowship</span>
				</div>
			<?php else : ?>
				<div class="lfa-news-task03-article__image-fallback" role="img" aria-label="Editorial visual placeholder">
					<span>LOVE FAMILY ALUMNI · NEWSROOM</span>
				</div>
			<?php endif; ?>

			<div class="lfa-news-task03-body prose">
				<p class="lfa-news-task03-lead">
					<?php echo esc_html( $body ); ?>
				</p>
				<p>
					The Love Family Alumni network connects thousands of graduates, professionals, and supporters across the United States and Canada. As part of our Phase 02 static frontend demonstration, this article illustrates the typography, media proportions, and editorial layout planned for the final newsroom publication workflow.
				</p>
				<blockquote>
					"Maintaining our bonds of unity, honoring our shared legacy, and supporting the next generation of leaders across North America."
				</blockquote>
				<p>
					During full backend integration, this view will be populated directly from verified WordPress Posts, complete with author attribution, tagged categories, event attachments, and approved media releases.
				</p>
			</div>

			<div class="lfa-news-task03-back-wrap">
				<a class="lfa-news-task03-back" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">
					← Back to All News & Announcements
				</a>
			</div>
		</div>

		<!-- Sidebar Column -->
		<aside class="lfa-news-task03-sidebar" aria-label="Article information">
			<div class="lfa-news-task03-sidebar__card">
				<h2 class="lfa-news-task03-sidebar__title">About This Story</h2>
				<div class="lfa-news-task03-sidebar__item">
					<span class="lfa-news-task03-sidebar__label">Category</span>
					<span class="lfa-news-task03-sidebar__value"><?php echo esc_html( $category ); ?></span>
				</div>
				<div class="lfa-news-task03-sidebar__item">
					<span class="lfa-news-task03-sidebar__label">Publication Status</span>
					<span class="lfa-news-task03-sidebar__value lfa-news-task03-sidebar__value--pill">Frontend Preview</span>
				</div>
				<div class="lfa-news-task03-sidebar__item">
					<span class="lfa-news-task03-sidebar__label">Alumni Zone</span>
					<span class="lfa-news-task03-sidebar__value">North America</span>
				</div>
				<p class="lfa-news-task03-sidebar__note">
					Real community announcements will only be published after editorial review and member authorization.
				</p>
				<a class="lfa-news-task03-button lfa-news-task03-button--full" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">
					Browse Newsroom →
				</a>
			</div>
		</aside>
	</div>
</article>
