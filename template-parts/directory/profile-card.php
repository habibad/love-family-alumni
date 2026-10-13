<?php
/**
 * Alumni Directory — Profile Card Component
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$profile = $args['profile'] ?? [];
if ( empty( $profile ) ) {
	return;
}

$avatar_url = ! empty( $profile['avatar'] ) ? lfa_image_url( $profile['avatar'] ) : '';
?>

<div class="directory-profile-card" data-id="<?php echo esc_attr( $profile['id'] ); ?>" data-year="<?php echo esc_attr( $profile['batch'] ); ?>" data-profession="<?php echo esc_attr( $profile['title'] ); ?>" data-location="<?php echo esc_attr( $profile['location'] ); ?>" data-country="<?php echo esc_attr( $profile['country'] ?? '' ); ?>">
	<!-- Card Media & Batch Badge -->
	<div class="profile-media-wrapper">
		<?php if ( $avatar_url ) : ?>
			<img src="<?php echo esc_url( $avatar_url ); ?>" 
			     alt="<?php echo esc_attr( $profile['name'] ); ?>" 
			     class="profile-media-img" 
			     loading="lazy" 
			     decoding="async">
		<?php else : ?>
			<div class="profile-media-placeholder">
				<span class="placeholder-initials"><?php echo esc_html( substr( $profile['name'], 0, 1 ) ); ?></span>
			</div>
		<?php endif; ?>

		<span class="profile-batch-badge">Class of <?php echo esc_html( $profile['batch'] ); ?></span>
	</div>

	<!-- Card Information -->
	<div class="profile-card-body">
		<h3 class="profile-name"><?php echo esc_html( $profile['name'] ); ?></h3>
		<p class="profile-title"><?php echo esc_html( $profile['title'] ); ?></p>

		<div class="profile-meta-list">
			<div class="profile-meta-item">
				<svg class="meta-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
					<circle cx="12" cy="10" r="3"></circle>
				</svg>
				<span class="meta-text"><?php echo esc_html( $profile['location'] ); ?></span>
			</div>

			<div class="profile-meta-item">
				<svg class="meta-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
					<path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
				</svg>
				<span class="meta-text"><?php echo esc_html( $profile['industry'] ); ?></span>
			</div>
		</div>

		<!-- Card Social & Preview Actions -->
		<div class="profile-card-actions">
			<a href="<?php echo esc_url( $profile['email'] ); ?>" class="card-action-btn" title="Contact <?php echo esc_attr( $profile['name'] ); ?>" aria-label="Send email">
				<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
					<polyline points="22,6 12,13 2,6"></polyline>
				</svg>
			</a>

			<a href="<?php echo esc_url( $profile['linkedin'] ); ?>" target="_blank" rel="noopener noreferrer" class="card-action-btn" title="LinkedIn Profile" aria-label="LinkedIn">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
					<rect x="2" y="9" width="4" height="12"></rect>
					<circle cx="4" cy="4" r="2"></circle>
				</svg>
			</a>

			<button type="button" class="card-action-btn preview-action-btn" title="View Profile Summary" aria-label="View Profile">
				<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
					<circle cx="12" cy="7" r="4"></circle>
				</svg>
			</button>
		</div>
	</div>
</div>
