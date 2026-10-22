<?php
/**
 * Events Page — Event Card Component
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$event = $args['event'] ?? [];
if ( empty( $event ) ) {
	return;
}

$event_img_url = ! empty( $event['image_url'] ) ? $event['image_url'] : ( ! empty( $event['image'] ) ? lfa_image_url( $event['image'] ) : '' );
$event_img_alt = ! empty( $event['image_alt'] ) ? $event['image_alt'] : ( $event['title'] ?? 'Event Image' );
?>

<div class="event-card" 
     data-id="<?php echo esc_attr( $event['id'] ); ?>" 
     data-category="<?php echo esc_attr( $event['category'] ); ?>" 
     data-period="<?php echo esc_attr( $event['period'] ); ?>" 
     data-title="<?php echo esc_attr( $event['title'] ); ?>">
	
	<!-- Card Media & Status Badges -->
	<div class="event-card-media-wrap">
		<?php if ( $event_img_url ) : ?>
			<img src="<?php echo esc_url( $event_img_url ); ?>" 
			     alt="<?php echo esc_attr( $event_img_alt ); ?>" 
			     class="event-card-img" 
			     loading="eager" 
			     decoding="async">
		<?php endif; ?>
		
		<div class="event-card-media-overlay" aria-hidden="true"></div>

		<!-- Status / Category Badges -->
		<div class="event-card-badges">
			<span class="event-category-badge"><?php echo esc_html( $event['category_label'] ); ?></span>
			<span class="event-status-badge <?php echo esc_attr( $event['period'] ); ?>">
				<?php echo esc_html( $event['status_badge'] ); ?>
			</span>
		</div>
	</div>

	<!-- Card Body Content -->
	<div class="event-card-body">
		
		<!-- Meta: Date & Location -->
		<div class="event-card-meta">
			<span class="event-meta-pill">
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
					<line x1="16" y1="2" x2="16" y2="6"></line>
					<line x1="8" y1="2" x2="8" y2="6"></line>
					<line x1="3" y1="10" x2="21" y2="10"></line>
				</svg>
				<span><?php echo esc_html( $event['date_label'] ); ?></span>
			</span>

			<span class="event-meta-pill">
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
					<circle cx="12" cy="10" r="3"></circle>
				</svg>
				<span><?php echo esc_html( $event['location'] ); ?></span>
			</span>
		</div>

		<!-- Event Title -->
		<h3 class="event-card-title"><?php echo esc_html( $event['title'] ); ?></h3>

		<?php if ( ! empty( $event['theme'] ) ) : ?>
			<div class="event-card-theme">
				<span class="theme-tag">Theme:</span>
				<span class="theme-text">&ldquo;<?php echo esc_html( $event['theme'] ); ?>&rdquo;</span>
			</div>
		<?php endif; ?>

		<p class="event-card-summary">
			<?php echo esc_html( $event['summary'] ); ?>
		</p>

		<!-- Card Action Footer -->
		<div class="event-card-footer">
			<a href="<?php echo esc_url( $event['action_url'] ); ?>" class="btn btn-outline-crimson event-action-btn">
				<span><?php echo esc_html( $event['action_label'] ); ?></span>
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<polyline points="9 18 15 12 9 6"></polyline>
				</svg>
			</a>
		</div>

	</div>
</div>
