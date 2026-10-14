<?php
/**
 * News & Announcements — Hero Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_bg = get_theme_file_uri( '/assets/images/original-alumni-group.jpg' );
?>
<section class="lfa-news-hero" aria-labelledby="lfa-news-hero-title">
	<div class="lfa-news-hero__bg" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');"></div>
	<div class="lfa-news-hero__overlay" aria-hidden="true"></div>
	<div class="lfa-container lfa-news-hero__container">
		<div class="lfa-news-hero__content">
			<span class="lfa-news-hero__eyebrow">NEWS & ANNOUNCEMENTS</span>
			<h1 id="lfa-news-hero-title" class="lfa-news-hero__title">
				Stories That Keep<br>
				<span class="lfa-news-hero__title-accent">Us Connected.</span>
			</h1>
			<p class="lfa-news-hero__lead">
				Stay informed with the latest updates, community milestones, member achievements, and official announcements across the Love Family Alumni — North America Zone.
			</p>
			<div class="lfa-news-hero__actions">
				<a href="#featured-story" class="lfa-news-btn lfa-news-btn--primary">
					Explore Stories <span aria-hidden="true">↓</span>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="lfa-news-btn lfa-news-btn--outline">
					Share an Announcement <span aria-hidden="true">↗</span>
				</a>
			</div>
		</div>
	</div>
</section>
