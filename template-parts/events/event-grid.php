<?php
/**
 * Events Page — Section 04: Event Grid & Results Wrapper
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$events = lfa_get_events_list();
$total_events = count( $events );
?>

<section class="events-grid-section" id="events-listing" aria-label="Events Directory">
	<div class="lfa-container">
		
		<!-- Results Counter Bar -->
		<div class="events-results-bar">
			<span class="events-count-text">
				Showing <strong class="events-current-count"><?php echo esc_html( $total_events ); ?></strong> events across North America Zone
			</span>
		</div>

		<!-- 3-Column Events Grid -->
		<div class="events-cards-grid" id="events-cards-grid">
			<?php foreach ( $events as $event ) : ?>
				<?php
				get_template_part(
					'template-parts/events/event-card',
					null,
					[ 'event' => $event ]
				);
				?>
			<?php endforeach; ?>
		</div>

		<!-- Empty State (Shown via JS when 0 matches) -->
		<div class="events-empty-state" id="events-empty-state" style="display: none;">
			<div class="empty-icon-wrap" aria-hidden="true">
				<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
					<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
					<line x1="16" y1="2" x2="16" y2="6"></line>
					<line x1="8" y1="2" x2="8" y2="6"></line>
					<line x1="3" y1="10" x2="21" y2="10"></line>
					<line x1="9" y1="14" x2="15" y2="20"></line>
					<line x1="15" y1="14" x2="9" y2="20"></line>
				</svg>
			</div>
			<h3 class="empty-title">New Events Will Be Announced Soon</h3>
			<p class="empty-desc">
				No events currently match your selected filters. Please adjust your criteria or reset filters to explore all community gatherings.
			</p>
			<button type="button" class="btn btn-outline-crimson events-reset-trigger">Reset All Filters</button>
		</div>

	</div>
</section>
