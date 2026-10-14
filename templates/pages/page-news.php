<?php
/**
 * Template Name: LFA — News & Announcements
 * Description: Master template for Love Family Alumni News & Announcements (Task 01: Hero + Featured Story)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="news-page-wrapper lfa-news" id="primary" aria-label="News and Announcements">
	<?php
	// Task 01: News Hero Section
	get_template_part( 'template-parts/news/hero' );

	// Task 01: Featured News Section (55/45 Editorial Split)
	get_template_part( 'template-parts/news/featured' );

	// Task 02: Search & Filter Toolbar
	get_template_part( 'template-parts/news/filters' );

	// Task 02: Latest News Cards Grid & Pagination
	get_template_part( 'template-parts/news/news-grid' );

	// Task 03: Community Updates ("The Moments We Share")
	get_template_part( 'template-parts/news/community-updates' );

	// Task 03: News CTA ("Every Story Strengthens Our Family")
	get_template_part( 'template-parts/news/news-cta' );
	?>
</div>

<?php
get_footer();
