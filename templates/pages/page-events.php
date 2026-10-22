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

// Check if a specific event detail is requested via ?event=slug
$req_slug = isset( $_GET['event'] ) ? sanitize_title( wp_unslash( $_GET['event'] ) ) : '';

if ( ! empty( $req_slug ) ) {
	$event = class_exists( 'LFA_Events' ) ? LFA_Events::get_event_by_slug( $req_slug ) : null;

	if ( ! $event ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( '404' );
		exit;
	}

	// EVE-018: If conference-linked event, redirect to existing conference details
	if ( ! empty( $event['linked_conf_url'] ) ) {
		wp_safe_redirect( $event['linked_conf_url'], 302 );
		exit;
	}

	get_header();
	get_template_part( 'template-parts/events/single-detail', null, [ 'event' => $event ] );
	get_footer();
	return;
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
