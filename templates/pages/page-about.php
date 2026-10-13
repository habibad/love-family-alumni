<?php
/**
 * Template Name: About Us Page
 * Description: Master template for the Love Family Alumni About Us page (Phase 02)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="about-page-wrapper">
	<?php
	// Section 01: Inner Hero
	get_template_part( 'template-parts/about/hero' );

	// Section 02: Our Story (UNIBEN Origins & Global vs NA Zone)
	get_template_part( 'template-parts/about/story' );

	// Section 03: Mission & Vision
	get_template_part( 'template-parts/about/mission-vision' );

	// Section 04: Our Core Values (5 Pillars)
	get_template_part( 'template-parts/about/values' );

	// Section 05: North America Zone History & Milestones
	get_template_part( 'template-parts/about/history' );

	// Section 06: Our Community (Original Photo Grid)
	get_template_part( 'template-parts/about/community' );

	// Section 07: Leadership Preview (Dr. Evans Akpo & Executive Committee)
	get_template_part( 'template-parts/about/leadership' );

	// Section 08: Join Our Family (Membership CTA)
	get_template_part( 'template-parts/about/cta' );
	?>
</div>

<?php
get_footer();
