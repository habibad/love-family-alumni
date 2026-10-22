<?php
/**
 * Single Event Template for Love Family Alumni
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = get_the_ID();
$event   = null;

if ( class_exists( 'LFA_Events' ) ) {
	$post = get_post( $post_id );
	if ( $post && ( $post->post_status === 'publish' || current_user_can( 'edit_post', $post_id ) ) ) {
		if ( method_exists( 'LFA_Events', 'format_event_item' ) ) {
			$event = LFA_Events::format_event_item( $post );
		} elseif ( method_exists( 'LFA_Events', 'format_event' ) ) {
			$event = LFA_Events::format_event( $post );
		}
	}
}

if ( ! $event ) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
	get_template_part( '404' );
	exit;
}

// EVE-018: If conference-linked event, redirect to existing conference details
if ( ! empty( $event['linked_conf_url'] ) ) {
	wp_safe_redirect( $event['linked_conf_url'], 302 );
	exit;
}

get_header();
?>
<main id="main-content" class="lfa-events-single-view" role="main" aria-label="Event Details">
	<?php
	get_template_part( 'template-parts/events/single-detail', null, [ 'event' => $event ] );
	?>
</main>
<?php
get_footer();
