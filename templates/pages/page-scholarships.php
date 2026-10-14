<?php
/**
 * Template Name: LFA — Scholarships
 * Description: Master template for Love Family Alumni Scholarships Page (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$programs = require get_theme_file_path( 'inc/data/demo-scholarships.php' );
?>

<main id="primary" class="lfa-scholarships" aria-label="Scholarships and student support">
	<?php get_template_part( 'template-parts/scholarships/hero' ); ?>
	<?php get_template_part( 'template-parts/scholarships/intro' ); ?>
	<?php get_template_part( 'template-parts/scholarships/programs', null, [ 'programs' => $programs ] ); ?>

	<?php
	// Task 02: How Scholarship Support Works
	get_template_part( 'template-parts/scholarships/how-it-works' );

	// Task 02: Scholarship Application Preview (Interactive Demo)
	get_template_part( 'template-parts/scholarships/application-preview', null, [ 'programs' => $programs ] );

	// Task 03: Centralized Static Data
	$scholarships_task03 = require get_theme_file_path( 'inc/data/scholarships-task03-data.php' );

	// Task 03: Section 01 — Recipient Stories (Placeholder with Community Photo)
	get_template_part( 'template-parts/scholarships/recipient-stories' );

	// Task 03: Section 02 — Opportunities to Give Back & Partner Acknowledgments
	get_template_part( 'template-parts/scholarships/supporters', null, [ 'data' => $scholarships_task03 ] );

	// Task 03: Section 03 — Frequently Asked Questions (Native Accessible Accordions)
	get_template_part( 'template-parts/scholarships/faqs', null, [ 'data' => $scholarships_task03 ] );

	// Task 03: Section 04 — Final Call to Action
	get_template_part( 'template-parts/scholarships/final-cta' );
	?>
</main>

<?php
get_footer();
