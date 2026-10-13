<?php
/**
 * Template Name: Leadership Page
 * Description: Master template for the Love Family Alumni Leadership page (Phase 02 / Page 02)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="leadership-page-wrapper lfa-leadership">
	<?php
	// Section 01: Leadership Page Hero
	get_template_part( 'template-parts/leadership/hero' );

	// Section 02: President's Introduction
	get_template_part( 'template-parts/leadership/president' );

	// Section 03: Executive Team
	get_template_part( 'template-parts/leadership/executive-team' );

	// Section 04: Board of Trustees / Board Members
	get_template_part( 'template-parts/leadership/board-members' );

	// Section 05: Advisory Council
	get_template_part( 'template-parts/leadership/advisory-council' );

	// Section 06: Join Our Leadership Community CTA
	get_template_part( 'template-parts/leadership/join-cta' );
	?>
</div>

<?php
get_footer();
