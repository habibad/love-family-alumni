<?php
/**
 * Template Name: LFA — Business Directory
 * Description: Master template for the Love Family Alumni Business Directory (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="business-directory-wrapper lfa-business-directory" id="primary" aria-label="Business Directory">
	<?php
	// Task 01: Hero Section
	get_template_part( 'template-parts/business-directory/hero' );

	// Task 01: Search & Filter Card
	get_template_part( 'template-parts/business-directory/search-filters' );

	// Task 01: Browse by Category Strip
	get_template_part( 'template-parts/business-directory/categories' );
	?>
</div>

<?php
get_footer();
