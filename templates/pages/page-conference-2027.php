<?php
/**
 * Template Name: LFA — 2027 Conference Page
 * Description: Master template for the Love Family Alumni 2027 Conference page (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="conference-page-wrapper lfa-conference" aria-label="2027 Conference">
	<?php
	// Section 01: Conference Hero
	get_template_part( 'template-parts/conference/hero' );

	// Section 02: Conference Overview
	get_template_part( 'template-parts/conference/overview' );

	// Task A: About Conference & Expectations
	get_template_part( 'template-parts/conference/about' );
	get_template_part( 'template-parts/conference/expectations' );

	// Task B: Program & Speakers
	get_template_part( 'template-parts/conference/program' );
	get_template_part( 'template-parts/conference/speakers' );

	// Task C: Registration Preview, Sponsorship & Accommodation
	$conf_2027 = class_exists('LFA_Conference') ? LFA_Conference::get_conference_by_id(1) : null;
	get_template_part( 'template-parts/conference/registration-preview', null, [ 'conference' => $conf_2027 ] );
	get_template_part( 'template-parts/conference/sponsorship' );
	get_template_part( 'template-parts/conference/accommodation' );

	// Task D: Previous Conferences, FAQs & Final CTA
	get_template_part( 'template-parts/conference/memories' );
	get_template_part( 'template-parts/conference/faq' );
	get_template_part( 'template-parts/conference/join-cta' );
	?>
</div>

<?php
get_footer();
