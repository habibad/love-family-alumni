<?php
/**
 * Shared Reusable Leadership Profile Card Component
 *
 * @package Love_Family_Theme
 *
 * Expected $args:
 * - name (string)
 * - position (string)
 * - status (string: 'pending'|'verified')
 * - status_label (string)
 * - image_url (string, optional)
 * - initials (string, optional)
 * - email (string, optional)
 * - linkedin (string, optional)
 * - variant (string: 'default'|'compact')
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$card_name      = ! empty( $args['name'] ) ? $args['name'] : __( 'Profile Pending Confirmation', 'love-family-theme' );
$card_position  = ! empty( $args['position'] ) ? $args['position'] : __( 'Leadership Officer', 'love-family-theme' );
$card_status    = ! empty( $args['status'] ) ? $args['status'] : 'pending';
$status_label   = ! empty( $args['status_label'] ) ? $args['status_label'] : __( 'Pending Confirmation', 'love-family-theme' );
$image_url      = ! empty( $args['image_url'] ) ? $args['image_url'] : '';
$initials       = ! empty( $args['initials'] ) ? $args['initials'] : 'LFA';
$email_url      = ! empty( $args['email'] ) ? $args['email'] : 'mailto:lovefamilyalumni.na@gmail.com?subject=' . rawurlencode( 'Leadership Inquiry: ' . $card_position );
$linkedin_url   = ! empty( $args['linkedin'] ) ? $args['linkedin'] : 'https://www.linkedin.com';
$variant_class  = ! empty( $args['variant'] ) ? 'is-' . esc_attr( $args['variant'] ) : 'is-default';
?>

<div class="leader-profile-card <?php echo esc_attr( $variant_class ); ?>" data-status="<?php echo esc_attr( $card_status ); ?>">
	<!-- Card Media / Portrait Frame -->
	<div class="leader-card-media-wrap">
		<?php if ( ! empty( $image_url ) ) : ?>
			<img src="<?php echo esc_url( $image_url ); ?>" 
			     alt="<?php echo esc_attr( $card_name . ' — ' . $card_position ); ?>" 
			     width="400" 
			     height="400" 
			     loading="lazy" 
			     class="leader-card-portrait">
		<?php else : ?>
			<!-- Dignified Institutional Silhouette Placeholder -->
			<div class="leader-card-placeholder" aria-label="<?php echo esc_attr( $card_position . ' (Pending)' ); ?>">
				<svg class="placeholder-silhouette-svg" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<rect width="200" height="200" fill="#EDF2F7"/>
					<!-- Subtle Background Seal -->
					<circle cx="100" cy="100" r="75" stroke="#CBD5E1" stroke-width="1.5" stroke-dasharray="4 4" opacity="0.6"/>
					<!-- Head & Shoulders Silhouette -->
					<path d="M100 102C116.569 102 130 88.5685 130 72C130 55.4315 116.569 42 100 42C83.4315 42 70 55.4315 70 72C70 88.5685 83.4315 102 100 102Z" fill="#94A3B8"/>
					<path d="M48 168C48 138.177 71.281 114 100 114C128.719 114 152 138.177 152 168V176H48V168Z" fill="#94A3B8"/>
					<!-- Initials Monogram Badge -->
					<circle cx="100" cy="148" r="16" fill="#0A192F" stroke="#DDA83A" stroke-width="1.5"/>
					<text x="100" y="153" text-anchor="middle" font-family="'Inter', sans-serif" font-size="10" font-weight="700" fill="#FFFFFF" letter-spacing="0.5"><?php echo esc_html( $initials ); ?></text>
				</svg>
			</div>
		<?php endif; ?>

		<?php if ( 'pending' === $card_status ) : ?>
			<span class="leader-card-status-pill" title="<?php esc_attr_e( 'Official record undergoing secretariat confirmation', 'love-family-theme' ); ?>">
				<?php echo esc_html( $status_label ); ?>
			</span>
		<?php endif; ?>
	</div>

	<!-- Card Content -->
	<div class="leader-card-body">
		<h3 class="leader-card-name"><?php echo esc_html( $card_name ); ?></h3>
		<p class="leader-card-designation"><?php echo esc_html( $card_position ); ?></p>

		<!-- Card Action / Social Links -->
		<div class="leader-card-actions">
			<a href="<?php echo esc_url( $email_url ); ?>" 
			   class="leader-action-btn action-mail" 
			   title="<?php echo esc_attr( sprintf( __( 'Send inquiry regarding %s', 'love-family-theme' ), $card_position ) ); ?>" 
			   aria-label="<?php echo esc_attr( sprintf( __( 'Email regarding %s', 'love-family-theme' ), $card_position ) ); ?>">
				<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
					<path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
				</svg>
			</a>
			<a href="<?php echo esc_url( $linkedin_url ); ?>" 
			   class="leader-action-btn action-linkedin" 
			   target="_blank" 
			   rel="noopener noreferrer" 
			   title="<?php esc_attr_e( 'Connect on LinkedIn', 'love-family-theme' ); ?>" 
			   aria-label="<?php esc_attr_e( 'LinkedIn profile', 'love-family-theme' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
					<path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37h2.79V10.9H6.46M7.86 6.54a1.63 1.63 0 0 0-1.63 1.63c0 .9.73 1.63 1.63 1.63.9 0 1.63-.73 1.63-1.63 0-.9-.73-1.63-1.63-1.63z"/>
				</svg>
			</a>
		</div>
	</div>
</div>
