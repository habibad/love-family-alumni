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

$is_real  = ! empty( $story['id'] ) && empty( $story['is_demo'] );
$slug     = (string) ( $story['slug'] ?? 'demo-news-01' );
$category = (string) ( $story['category'] ?? 'Community News' );
$raw_title = (string) ( $story['title'] ?? 'News Update' );
$title    = str_replace( '[Demo] ', '', $raw_title );
$body     = (string) ( $story['body'] ?? $story['excerpt'] ?? '' );
$content  = (string) ( $story['content'] ?? '' );
$date     = (string) ( $story['date'] ?? '' );
$formatted_date = ( $date && strtotime( $date ) ) ? date_i18n( 'F j, Y', strtotime( $date ) ) : 'September 2, 2026';
$author   = (string) ( $story['author_name'] ?? 'Communications Team' );
$caption  = (string) ( $story['image_caption'] ?? 'Photo: Love Family Alumni Archive — North America Zone Fellowship' );

if ( ! empty( $story['image_url'] ) ) {
	$image = $story['image_url'];
} elseif ( function_exists( 'lfa_get_demo_news_image' ) ) {
	$image = lfa_get_demo_news_image( $slug );
} else {
	$image = '';
}
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
				<?php if ( $is_real ) : ?>
					<span class="lfa-news-task03-demo" style="background:rgba(198,147,61,0.2);color:#E5C170;border:1px solid #C6933D;">OFFICIAL ANNOUNCEMENT</span>
				<?php else : ?>
					<span class="lfa-news-task03-demo">DEMO CONTENT — NOT AN OFFICIAL ANNOUNCEMENT</span>
				<?php endif; ?>
				<span class="lfa-news-task03-date">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
						<line x1="16" y1="2" x2="16" y2="6"></line>
						<line x1="8" y1="2" x2="8" y2="6"></line>
						<line x1="3" y1="10" x2="21" y2="10"></line>
					</svg>
					<time datetime="<?php echo esc_attr( $date ); ?>"><?php echo esc_html( $formatted_date ); ?></time>
				</span>
				<span class="lfa-news-task03-author" style="color:#CBD5E1;font-size:0.85rem;">
					By <?php echo esc_html( $author ); ?>
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
					<span class="lfa-news-caption"><?php echo esc_html( $caption ); ?></span>
				</div>
			<?php else : ?>
				<div class="lfa-news-task03-article__image-fallback" role="img" aria-label="Editorial visual placeholder">
					<span>LOVE FAMILY ALUMNI · NEWSROOM</span>
				</div>
			<?php endif; ?>

			<div class="lfa-news-task03-body prose">
				<?php if ( $is_real && ! empty( $content ) ) : ?>
					<div class="lfa-article-real-content" style="font-size:1.05rem;line-height:1.75;color:#1E293B;">
						<?php echo wp_kses_post( wpautop( $content ) ); ?>
					</div>
				<?php else : ?>
					<p class="lfa-news-task03-lead">
						<?php echo esc_html( $body ); ?>
					</p>
					<p>
						The Love Family Alumni network connects thousands of graduates, professionals, and supporters across the United States and Canada. As part of our community newsroom, this article illustrates the typography, media proportions, and editorial layout planned for the verified publication workflow.
					</p>
					<blockquote>
						"Maintaining our bonds of unity, honoring our shared legacy, and supporting the next generation of leaders across North America."
					</blockquote>
				<?php endif; ?>
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
					<span class="lfa-news-task03-sidebar__value lfa-news-task03-sidebar__value--pill">
						<?php echo $is_real ? 'Published' : 'Frontend Preview'; ?>
					</span>
				</div>
				<div class="lfa-news-task03-sidebar__item">
					<span class="lfa-news-task03-sidebar__label">Author</span>
					<span class="lfa-news-task03-sidebar__value"><?php echo esc_html( $author ); ?></span>
				</div>
				<div class="lfa-news-task03-sidebar__item">
					<span class="lfa-news-task03-sidebar__label">Alumni Zone</span>
					<span class="lfa-news-task03-sidebar__value">North America</span>
				</div>
				<p class="lfa-news-task03-sidebar__note">
					Real community announcements are published only after editorial review and documented member consent.
				</p>
				<a class="lfa-news-task03-button lfa-news-task03-button--full" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">
					Browse Newsroom →
				</a>
			</div>
		</aside>
	</div>
</article>
