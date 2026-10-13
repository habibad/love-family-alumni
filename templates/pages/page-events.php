<?php
/**
 * Template Name: Events Page
 * Description: Master template for the Love Family Alumni Events page (Phase 02 / Page 05)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="events-page-wrapper lfa-events">
	<?php
	// Section 01: Events Hero (Full bleed)
	get_template_part( 'template-parts/events/hero' );

	// Section 02: Featured Event / Next Gathering (2027 Conference)
	get_template_part( 'template-parts/events/featured' );

	// Section 03: Search & Event Filters
	get_template_part( 'template-parts/events/filters' );

	// Section 04: Events Listing Grid
	get_template_part( 'template-parts/events/event-grid' );

	// Section 05: Events Calendar & Upcoming Notice
	get_template_part( 'template-parts/events/calendar' );

	// Section 06: Past Event Highlights / Gallery
	get_template_part( 'template-parts/events/highlights' );

	// Section 07: Community CTA
	get_template_part( 'template-parts/events/cta' );
	?>
</div>

<?php
get_footer();
