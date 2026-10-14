<?php
/**
 * Template Name: LFA — Give / Donations
 * Description: Master template for Love Family Alumni Give & Donations Page (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Load centralized static data
$give_data = require get_theme_file_path( 'inc/data/demo-give.php' );
?>

<div id="primary" class="lfa-give" aria-label="Love Family Alumni Give and Donations">
	<?php
	// Task 01: Hero Section
	get_template_part( 'template-parts/give/hero', null, [ 'data' => $give_data ] );

	// Task 01: Giving Mission Section
	get_template_part( 'template-parts/give/mission', null, [ 'data' => $give_data ] );

	// Task 01: Ways to Give Categories (4 Cards)
	get_template_part( 'template-parts/give/giving-categories', null, [ 'data' => $give_data ] );

	// Task 01: Donation Preview (Interactive Demo + Review Modal)
	get_template_part( 'template-parts/give/donation-preview', null, [ 'data' => $give_data ] );
	?>
</div>

<?php
get_footer();
