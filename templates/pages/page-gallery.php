<?php
/**
 * Template Name: LFA — Archives & Gallery
 * Description: Master template for Love Family Alumni Archives & Photo Gallery Page (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Centralized static data repository
$gallery_data = require get_theme_file_path( 'inc/data/demo-gallery.php' );
?>

<div id="primary" class="lfa-gallery" aria-label="Love Family Alumni Archives and Photo Gallery">
	<?php
	// Task 01: Hero Section
	get_template_part( 'template-parts/gallery/hero', null, [ 'data' => $gallery_data ] );

	// Task 01: Our Heritage Editorial Section
	get_template_part( 'template-parts/gallery/heritage', null, [ 'data' => $gallery_data ] );

	// Task 01: Featured Collections (3 Album Cards)
	get_template_part( 'template-parts/gallery/featured-albums', null, [ 'data' => $gallery_data ] );
	?>
</div>

<?php
get_footer();
