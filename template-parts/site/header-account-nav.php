<?php
/**
 * Site Header Account Navigation Component (Phase 07)
 * Renders Login CTA for guests or modern accessible Profile Dropdown for authenticated members/staff.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lfa_dropdown_icon' ) ) {
	function lfa_dropdown_icon( string $name ): string {
		return match ( $name ) {
			'home' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
			'user' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
			'shield' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
			'calendar' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>',
			'building' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M8 10h.01"/><path d="M16 10h.01"/><path d="M8 14h.01"/><path d="M16 14h.01"/></svg>',
			'award' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>',
			'gear' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>',
			'admin' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>',
			'logout' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>',
			default => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8"/></svg>',
		};
	}
}

if ( ! is_user_logged_in() ) : ?>
	<div class="nav-actions">
		<a href="<?php echo esc_url( home_url( '/member-login/' ) ); ?>" class="btn btn-crimson btn-login">
			Login
		</a>
	</div>
<?php
else :
	$user = wp_get_current_user();
	$uid = (int) $user->ID;
	$admin = current_user_can( 'manage_options' );
	$account_status = (string) get_user_meta( $uid, 'lfa_account_status', true );
	$is_approved = ( $account_status === 'approved' || $admin );
	$name = $user->display_name ? $user->display_name : $user->user_login;

	// Compute initials
	if ( ! empty( $user->first_name ) && ! empty( $user->last_name ) ) {
		$initials = strtoupper( substr( $user->first_name, 0, 1 ) . substr( $user->last_name, 0, 1 ) );
	} else {
		$words = preg_split( '/\s+/', trim( (string) $name ) );
		if ( count( $words ) >= 2 ) {
			$initials = strtoupper( substr( $words[0], 0, 1 ) . substr( $words[1], 0, 1 ) );
		} else {
			$initials = strtoupper( substr( (string) $name, 0, 2 ) );
		}
	}

	// Avatar resolution
	$has_avatar = class_exists( 'LFA_Media' ) && LFA_Media::has_avatar( $uid );
	$avatar_url = $has_avatar ? LFA_Media::get_avatar_url( $uid ) : '';

	// Human-readable Role Chip
	if ( $admin ) {
		$role_label = 'Administrator';
	} elseif ( in_array( 'lfa_president', (array)$user->roles, true ) ) {
		$role_label = 'Love Family President';
	} elseif ( in_array( 'lfa_general_secretary', (array)$user->roles, true ) ) {
		$role_label = 'General Secretary';
	} elseif ( in_array( 'lfa_treasurer', (array)$user->roles, true ) ) {
		$role_label = 'Treasurer';
	} elseif ( in_array( 'lfa_financial_secretary', (array)$user->roles, true ) ) {
		$role_label = 'Financial Secretary';
	} elseif ( in_array( 'lfa_communications_manager', (array)$user->roles, true ) ) {
		$role_label = 'Communications Manager';
	} elseif ( in_array( 'lfa_communications_editor', (array)$user->roles, true ) ) {
		$role_label = 'Communications Editor';
	} elseif ( in_array( 'lfa_archive_manager', (array)$user->roles, true ) ) {
		$role_label = 'Archive Manager';
	} elseif ( in_array( 'lfa_conference_pub', (array)$user->roles, true ) ) {
		$role_label = 'Conference Publisher';
	} elseif ( in_array( 'lfa_conference_admin', (array)$user->roles, true ) || current_user_can( 'lfa_manage_conferences' ) ) {
		$role_label = 'Conference Administrator';
	} elseif ( in_array( 'lfa_scholarship_admin', (array)$user->roles, true ) || current_user_can( 'lfa_manage_scholarships' ) ) {
		$role_label = 'Scholarship Administrator';
	} elseif ( in_array( 'lfa_scholarship_rev', (array)$user->roles, true ) || current_user_can( 'lfa_review_scholarships' ) ) {
		$role_label = 'Scholarship Reviewer';
	} elseif ( in_array( 'lfa_business_moderator', (array)$user->roles, true ) || current_user_can( 'lfa_manage_business_directory' ) ) {
		$role_label = 'Business Moderator';
	} elseif ( $is_approved ) {
		$role_label = 'Alumni Member';
	} else {
		$role_label = 'Account Review Pending';
	}

	// Portal Navigation Links (only for approved members/admins)
	$links = [];
	if ( $is_approved ) {
		$links[] = [ 'title' => 'Dashboard', 'url' => home_url( '/member-dashboard/' ), 'icon' => 'home' ];
		$links[] = [ 'title' => 'Notifications', 'url' => home_url( '/member-dashboard/#notifications' ), 'icon' => 'award' ];
		$links[] = [ 'title' => 'Volunteers', 'url' => home_url( '/member-dashboard/#volunteers' ), 'icon' => 'user' ];
		$links[] = [ 'title' => 'My Profile', 'url' => home_url( '/member-dashboard/#profile' ), 'icon' => 'user' ];
		$links[] = [ 'title' => 'Membership & Dues', 'url' => home_url( '/member-dashboard/#dues' ), 'icon' => 'shield' ];
		$links[] = [ 'title' => 'My Conferences', 'url' => home_url( '/member-dashboard/#conference' ), 'icon' => 'calendar' ];
		$links[] = [ 'title' => 'My Businesses', 'url' => home_url( '/member-dashboard/#businesses' ), 'icon' => 'building' ];
		$links[] = [ 'title' => 'My Scholarship Applications', 'url' => home_url( '/member-dashboard/#scholarships' ), 'icon' => 'award' ];
		$links[] = [ 'title' => 'Account Settings', 'url' => home_url( '/member-dashboard/#settings' ), 'icon' => 'gear' ];
	}

	// Staff specific links (capability-checked)
	$staff_links = [];
	if ( $admin || current_user_can( 'lfa_view_admin_portal' ) ) {
		$staff_links[] = [ 'title' => 'Admin Portal', 'url' => home_url( '/admin-portal/' ), 'icon' => 'shield' ];
	}
	if ( current_user_can( 'lfa_manage_conferences' ) ) {
		$staff_links[] = [ 'title' => 'Manage Conferences', 'url' => admin_url( 'users.php?page=lfa-conferences' ), 'icon' => 'calendar' ];
	}
	if ( current_user_can( 'lfa_review_scholarships' ) || current_user_can( 'lfa_manage_scholarships' ) ) {
		$staff_links[] = [ 'title' => 'Scholarship Review', 'url' => admin_url( 'users.php?page=lfa-scholarship-applications' ), 'icon' => 'award' ];
	}
	if ( current_user_can( 'lfa_manage_business_directory' ) || current_user_can( 'lfa_manage_businesses' ) ) {
		$staff_links[] = [ 'title' => 'Business Moderation', 'url' => admin_url( 'users.php?page=lfa-business-pending' ), 'icon' => 'building' ];
	}
	if ( $admin ) {
		$staff_links[] = [ 'title' => 'WordPress Admin Area', 'url' => admin_url(), 'icon' => 'admin' ];
	}

	$instance_id = 'lfa-profile-popover-' . $uid;
?>
	<div class="nav-actions">
		<div class="lfa-profile-menu-root" data-lfa-profile-menu>
			<button type="button" class="lfa-profile-trigger" data-lfa-profile-trigger
			        aria-haspopup="true" aria-expanded="false" aria-controls="<?php echo esc_attr( $instance_id ); ?>"
			        aria-label="User account menu for <?php echo esc_attr( $name ); ?>">
				<span class="lfa-profile-avatar" aria-hidden="true">
					<?php if ( $has_avatar && $avatar_url ) : ?>
						<img src="<?php echo esc_url( $avatar_url ); ?>" alt="">
					<?php else : ?>
						<?php echo esc_html( $initials ); ?>
					<?php endif; ?>
				</span>
				<span class="lfa-profile-label">Profile</span>
				<span class="lfa-profile-chevron" aria-hidden="true">
					<svg width="10" height="6" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 1 5 5 9 1"></polyline></svg>
				</span>
			</button>

			<div id="<?php echo esc_attr( $instance_id ); ?>" class="lfa-profile-popover" data-lfa-profile-popover hidden aria-label="Account navigation">
				<div class="lfa-profile-user-card">
					<strong class="lfa-profile-user-name"><?php echo esc_html( $name ); ?></strong>
					<span class="lfa-profile-user-email"><?php echo esc_html( $user->user_email ); ?></span>
					<span class="lfa-profile-role-badge">
						<span class="lfa-profile-role-dot" aria-hidden="true"></span>
						<?php echo esc_html( $role_label ); ?>
					</span>
				</div>

				<?php if ( ! $is_approved ) : ?>
					<div style="padding: 10px 12px; font-size: 12px; color: #b45309; background: #fffbeb; border-radius: 8px; margin: 6px 4px;">
						Your alumni account is pending administrator review. Member portal access will be enabled upon verification.
					</div>
				<?php endif; ?>

				<nav class="lfa-profile-menu-list">
					<?php foreach ( $links as $l ) : ?>
						<a href="<?php echo esc_url( $l['url'] ); ?>" class="lfa-profile-item">
							<span class="lfa-item-icon" aria-hidden="true"><?php echo lfa_dropdown_icon( $l['icon'] ); ?></span>
							<span><?php echo esc_html( $l['title'] ); ?></span>
						</a>
					<?php endforeach; ?>

					<?php if ( ! empty( $staff_links ) ) : ?>
						<div class="lfa-profile-divider" role="separator"></div>
						<?php foreach ( $staff_links as $sl ) : ?>
							<a href="<?php echo esc_url( $sl['url'] ); ?>" class="lfa-profile-item">
								<span class="lfa-item-icon" aria-hidden="true"><?php echo lfa_dropdown_icon( $sl['icon'] ); ?></span>
								<span><?php echo esc_html( $sl['title'] ); ?></span>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>

					<div class="lfa-profile-divider" role="separator"></div>
					<a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="lfa-profile-item lfa-profile-item-logout">
						<span class="lfa-item-icon" aria-hidden="true"><?php echo lfa_dropdown_icon( 'logout' ); ?></span>
						<span>Log Out</span>
					</a>
				</nav>
			</div>
		</div>
	</div>
<?php endif; ?>
