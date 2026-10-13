<?php
/**
 * Template Name: Alumni Directory Page
 * Description: Master template for the Love Family Alumni Directory page (Phase 02 / Page 04)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="directory-page-wrapper lfa-directory">
	<?php
	// Section 01: Hero Section
	get_template_part( 'template-parts/directory/hero' );

	// Section 02: Search & Filter Bar
	get_template_part( 'template-parts/directory/search-filters' );

	// Section 03: Alumni Profile Grid
	get_template_part( 'template-parts/directory/profile-grid' );

	// Section 04: Privacy Notice (Task 03)
	// get_template_part( 'template-parts/directory/privacy' );

	// Section 05: Reconnect & Join CTA (Task 03)
	// get_template_part( 'template-parts/directory/join-cta' );
	?>
</div>

<?php
get_footer();
