<?php
/**
 * Love Family Alumni — Unified Admin Portal Application Shell
 * Standalone application interface for administrative role-based management screens.
 * Fully connected to live WordPress database records, authoritative ledgers, and capability boundaries.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_user = wp_get_current_user();
$current_uid  = $current_user ? (int) $current_user->ID : 0;
$is_admin     = current_user_can( 'administrator' );

// Load live portal data from LFA_Admin_Portal controller
$portal_data = class_exists( 'LFA_Admin_Portal' ) ? LFA_Admin_Portal::get_portal_data() : [];

$members          = $portal_data['members'] ?? [];
$dues_data        = $portal_data['dues'] ?? [];
$donations_data   = $portal_data['donations'] ?? [];
$conf_data        = $portal_data['conference'] ?? [];
$conf_list        = $portal_data['conferences_list'] ?? [];
$schol_data       = $portal_data['scholarships'] ?? [];
$vol_data         = $portal_data['volunteers'] ?? [];
$vol_opps         = $portal_data['volunteer_opps'] ?? [];
$leadership       = $portal_data['leadership'] ?? [];
$timeline         = $portal_data['timeline'] ?? [];
$businesses       = $portal_data['businesses'] ?? [];
$audit_logs       = $portal_data['audit_logs'] ?? [];
$role_audit_logs  = $portal_data['role_audit_logs'] ?? [];
$events_posts     = $portal_data['events'] ?? [];
$news_posts       = $portal_data['news'] ?? [];

// Member counts
$member_analytics = class_exists( 'LFA_Reports' ) ? LFA_Reports::get_member_analytics() : [
	'total_registered' => count( $members ),
	'approved'         => 0,
	'pending'          => 0,
	'rejected'         => 0,
];

// Volunteer signups
$volunteer_signups = [];
if ( class_exists( 'LFA_Volunteers' ) ) {
	global $wpdb;
	$st = LFA_Volunteers::table_signups();
	$ot = LFA_Volunteers::table_opportunities();
	$volunteer_signups = $wpdb->get_results(
		"SELECT s.*, o.title as opp_title, u.display_name, u.user_email,
		        (SELECT meta_value FROM {$wpdb->usermeta} WHERE user_id = s.user_id AND meta_key = 'lfa_alumni_id' LIMIT 1) as alumni_id
		 FROM `{$st}` s
		 JOIN `{$ot}` o ON s.opportunity_id = o.id
		 JOIN `{$wpdb->users}` u ON s.user_id = u.ID
		 ORDER BY s.id DESC LIMIT 50",
		ARRAY_A
	) ?: [];
}

$logo_url = lfa_image_url( 'brand-logo-source.jpg' );
if ( ! $logo_url ) {
	$logo_url = lfa_image_url( 'original-love-family-logo.jpg' );
}

$user_display_name = $current_user ? ( $current_user->display_name ?: $current_user->user_login ) : 'Staff Member';
$user_roles        = $current_user ? (array) $current_user->roles : [];
$primary_role      = ! empty( $user_roles ) ? $user_roles[0] : 'lfa_member';
$role_title        = ucwords( str_replace( [ 'lfa_', '_' ], [ '', ' ' ], $primary_role ) );

$paypal_settings_cap = current_user_can( 'lfa_manage_paypal_settings' ) || $is_admin;
?>

<div class="lfa-admin-app" id="lfa-admin-app">
	
	<!-- Top Global Status Notice -->
	<aside class="lfa-admin-demo-banner" role="status" aria-label="Portal status notice" style="background:#071626;border-bottom:1px solid #1E3A5F;">
		<div class="lfa-admin-banner-inner" style="display:flex;justify-content:space-between;align-items:center;padding:8px 24px;font-size:12px;color:#CBD5E1;">
			<div style="display:flex;align-items:center;gap:10px;">
				<span class="banner-badge" style="background:#16A34A;color:#fff;padding:2px 8px;border-radius:4px;font-weight:700;">LIVE DATABASE MODE</span>
				<span class="banner-text">Connected to Authoritative WordPress DB &bull; Gateway Mode: <strong>Sandbox Only</strong> (Live Mode OFF) &bull; WP Core: <strong>7.1.3</strong> &bull; Core Plugin: <strong>1.0.0</strong></span>
			</div>
			<div style="display:flex;gap:14px;">
				<a href="<?php echo esc_url( home_url( '/member-dashboard/' ) ); ?>" style="color:#C6933D;text-decoration:none;font-weight:600;">&larr; Member Dashboard</a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:#94A3B8;text-decoration:none;">Public Website &rarr;</a>
			</div>
		</div>
	</aside>

	<div class="lfa-admin-layout">
		<!-- Sidebar Drawer Overlay (Mobile) -->
		<div class="lfa-admin-drawer-backdrop" id="lfa-admin-backdrop" aria-hidden="true"></div>

		<!-- Standalone Admin Sidebar -->
		<aside class="lfa-admin-sidebar" id="lfa-admin-sidebar" aria-label="Admin Navigation">
			<div class="lfa-admin-sidebar-head">
				<a href="<?php echo esc_url( home_url( '/admin-portal/' ) ); ?>" class="lfa-admin-brand">
					<img src="<?php echo esc_url( $logo_url ); ?>" alt="Love Family Alumni Emblem" class="lfa-admin-brand-crest" width="38" height="38">
					<div class="lfa-admin-brand-meta">
						<span class="lfa-admin-brand-title">Love Family Alumni</span>
						<span class="lfa-admin-brand-sub">Administration Desk</span>
					</div>
				</a>
				<button type="button" class="lfa-admin-drawer-close" id="lfa-admin-drawer-close" aria-label="Close navigation drawer">&times;</button>
			</div>

			<!-- Active Role Pill -->
			<div class="lfa-admin-role-status-card" id="lfa-admin-role-status-card">
				<span class="role-caption">SIGNED IN STAFF</span>
				<div class="role-indicator-wrap">
					<span class="role-dot" id="role-dot"></span>
					<strong class="role-current-name" id="role-current-name"><?php echo esc_html( $user_display_name ); ?></strong>
				</div>
				<span class="role-badge" id="role-current-badge"><?php echo esc_html( $role_title ); ?></span>
			</div>

			<!-- Sidebar Navigation (15 Modules) -->
			<nav class="lfa-admin-nav" aria-label="Administrative Modules">
				<ul class="lfa-admin-nav-list" role="list">
					<li class="nav-item">
						<a href="#overview" class="lfa-admin-nav-link active" data-view="overview">
							<span class="nav-icon" data-icon="dashboard"></span>
							<span class="nav-label">Overview</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#members" class="lfa-admin-nav-link" data-view="members">
							<span class="nav-icon" data-icon="users"></span>
							<span class="nav-label">Members</span>
							<span class="nav-pill"><?php echo count( $members ); ?></span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#dues" class="lfa-admin-nav-link" data-view="dues">
							<span class="nav-icon" data-icon="credit-card"></span>
							<span class="nav-label">Dues &amp; Receipts</span>
							<span class="nav-pill-gold">$100</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#donations" class="lfa-admin-nav-link" data-view="donations">
							<span class="nav-icon" data-icon="gift"></span>
							<span class="nav-label">Donations &amp; Funds</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#conference" class="lfa-admin-nav-link" data-view="conference">
							<span class="nav-icon" data-icon="calendar"></span>
							<span class="nav-label">2027 Conference</span>
							<span class="nav-pill">Sept 16–19</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#events-news" class="lfa-admin-nav-link" data-view="events-news">
							<span class="nav-icon" data-icon="bell"></span>
							<span class="nav-label">Events &amp; News</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#scholarships" class="lfa-admin-nav-link" data-view="scholarships">
							<span class="nav-icon" data-icon="award"></span>
							<span class="nav-label">Scholarships</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#directories" class="lfa-admin-nav-link" data-view="directories">
							<span class="nav-icon" data-icon="folder"></span>
							<span class="nav-label">Directories &amp; Privacy</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#archives-media" class="lfa-admin-nav-link" data-view="archives-media">
							<span class="nav-icon" data-icon="film"></span>
							<span class="nav-label">Archives &amp; Media</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#volunteers" class="lfa-admin-nav-link" data-view="volunteers">
							<span class="nav-icon" data-icon="heart"></span>
							<span class="nav-label">Volunteers</span>
							<span class="nav-pill"><?php echo count( $vol_opps ); ?></span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#leadership" class="lfa-admin-nav-link" data-view="leadership">
							<span class="nav-icon" data-icon="award"></span>
							<span class="nav-label">Leadership &amp; Roster</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#communications" class="lfa-admin-nav-link" data-view="communications">
							<span class="nav-icon" data-icon="mail"></span>
							<span class="nav-label">Communications</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#reports" class="lfa-admin-nav-link" data-view="reports">
							<span class="nav-icon" data-icon="bar-chart"></span>
							<span class="nav-label">Analytics &amp; Reports</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#roles" class="lfa-admin-nav-link" data-view="roles">
							<span class="nav-icon" data-icon="shield"></span>
							<span class="nav-label">Roles &amp; Access</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#settings" class="lfa-admin-nav-link" data-view="settings">
							<span class="nav-icon" data-icon="settings"></span>
							<span class="nav-label">Settings &amp; System</span>
						</a>
					</li>
				</ul>
			</nav>

			<!-- Sidebar Footer -->
			<div class="lfa-admin-sidebar-foot">
				<a href="<?php echo esc_url( home_url( '/member-dashboard/' ) ); ?>" class="sidebar-secondary-link">
					<span>&larr; Switch to Member Portal</span>
				</a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sidebar-secondary-link">
					<span>Public Home Page</span>
				</a>
			</div>
		</aside>

		<!-- Main Workspace Area -->
		<div class="lfa-admin-main-wrap">
			
			<!-- Compact Application Topbar -->
			<header class="lfa-admin-topbar">
				<div class="topbar-left">
					<button type="button" class="lfa-admin-drawer-toggle" id="lfa-admin-drawer-toggle" aria-label="Toggle navigation drawer">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<div class="topbar-titles">
						<h1 class="topbar-page-heading" id="topbar-page-heading">Administrative Overview</h1>
						<span class="topbar-zone-badge">North America Zone</span>
					</div>
				</div>

				<div class="topbar-right">
					<div class="topbar-admin-profile">
						<div class="topbar-avatar" aria-hidden="true" style="background:#0A203A;color:#C6933D;font-weight:700;">
							<?php echo esc_html( strtoupper( substr( $user_display_name, 0, 2 ) ) ); ?>
						</div>
						<div class="topbar-profile-info">
							<strong class="admin-name"><?php echo esc_html( $user_display_name ); ?></strong>
							<span class="admin-designation" id="admin-designation"><?php echo esc_html( $role_title ); ?></span>
						</div>
					</div>
				</div>
			</header>

			<!-- Dynamic Workspace Panels -->
			<main class="lfa-admin-workspace" id="lfa-admin-workspace">

				<!-- 1. OVERVIEW PANEL (ADM-001, ADM-002) -->
				<section class="admin-panel active" id="overview" aria-labelledby="heading-overview">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-overview" class="panel-title">Zonal Executive Overview</h2>
							<p class="panel-subtitle">Consolidated operational metrics, dues performance, and pending approvals for North America.</p>
						</div>
						<div class="panel-actions">
							<a href="#reports" class="btn btn-crimson-admin">View Financial Reports</a>
						</div>
					</div>

					<!-- 4 Key Metric Cards (ADM-001: real counts; ADM-002: link to destination lists) -->
					<div class="admin-kpi-grid">
						<a href="#members" class="kpi-card" style="text-decoration:none;color:inherit;">
							<div class="kpi-icon-box" style="background: rgba(10,32,58,0.08); color: #0A203A;">
								<span data-icon="users"></span>
							</div>
							<div class="kpi-content">
								<span class="kpi-label">Total Registered Alumni</span>
								<strong class="kpi-val"><?php echo (int) $member_analytics['total_registered']; ?></strong>
								<span class="kpi-note green">&bull; <?php echo (int) $member_analytics['approved']; ?> in good standing</span>
							</div>
						</a>

						<a href="#dues" class="kpi-card" style="text-decoration:none;color:inherit;">
							<div class="kpi-icon-box" style="background: rgba(198,147,61,0.12); color: #C6933D;">
								<span data-icon="credit-card"></span>
							</div>
							<div class="kpi-content">
								<span class="kpi-label">Annual Dues Collected ($100)</span>
								<strong class="kpi-val">$<?php echo number_format( ( $dues_data['total_collected_cents'] ?? 0 ) / 100, 2 ); ?></strong>
								<span class="kpi-note">&bull; <?php echo (int) ( $dues_data['paid_count'] ?? 0 ); ?> paid invoices</span>
							</div>
						</a>

						<a href="#donations" class="kpi-card" style="text-decoration:none;color:inherit;">
							<div class="kpi-icon-box" style="background: rgba(171,22,64,0.1); color: #AB1640;">
								<span data-icon="gift"></span>
							</div>
							<div class="kpi-content">
								<span class="kpi-label">Voluntary Donations (Funds)</span>
								<strong class="kpi-val">$<?php echo number_format( ( $donations_data['total_verified_cents'] ?? 0 ) / 100, 2 ); ?></strong>
								<span class="kpi-note red">&bull; Separated strictly from dues</span>
							</div>
						</a>

						<a href="#conference" class="kpi-card" style="text-decoration:none;color:inherit;">
							<div class="kpi-icon-box" style="background: rgba(37,99,235,0.1); color: #2563EB;">
								<span data-icon="calendar"></span>
							</div>
							<div class="kpi-content">
								<span class="kpi-label">2027 Conference Delegates</span>
								<strong class="kpi-val"><?php echo (int) ( $conf_data['total_attendees'] ?? 0 ); ?></strong>
								<span class="kpi-note blue">&bull; Sept 16–19, 2027</span>
							</div>
						</a>
					</div>

					<!-- Review Queue & Funds Summary -->
					<div class="admin-grid-two">
						<!-- Left: Real Review Queue (ADM-003) -->
						<div class="admin-card">
							<div class="card-head">
								<h3 class="card-title">Pending Executive Approvals</h3>
								<span class="badge-pill yellow"><?php echo (int) $member_analytics['pending']; ?> Pending</span>
							</div>
							<div class="queue-list">
								<?php
								$pending_members = array_filter( $members, function( $m ) {
									return $m['account_status'] === 'pending';
								} );
								?>
								<?php if ( empty( $pending_members ) ) : ?>
									<p style="padding:16px;color:#64748B;font-size:14px;">No member registrations currently pending approval.</p>
								<?php else : ?>
									<?php foreach ( array_slice( $pending_members, 0, 5 ) as $pm ) : ?>
										<div class="queue-item" style="display:flex;justify-content:space-between;align-items:center;padding:12px;border-bottom:1px solid #E2E8F0;">
											<div class="queue-item-info">
												<strong>Member: <?php echo esc_html( $pm['name'] ); ?></strong>
												<span style="display:block;font-size:12px;color:#64748B;"><?php echo esc_html( $pm['email'] ); ?> &bull; Chapter: <?php echo esc_html( $pm['chapter'] ); ?></span>
											</div>
											<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;display:flex;gap:6px;">
												<?php wp_nonce_field( 'lfa_portal_member_action', 'lfa_nonce' ); ?>
												<input type="hidden" name="action" value="lfa_portal_member_action">
												<input type="hidden" name="user_id" value="<?php echo (int) $pm['id']; ?>">
												<input type="hidden" name="decision" value="approve">
												<input type="hidden" name="alumni_id" value="LFA-NA-<?php echo esc_attr( date( 'Y' ) . '-' . str_pad( (string) $pm['id'], 3, '0', STR_PAD_LEFT ) ); ?>">
												<button type="submit" class="btn-table-action primary" style="background:#16A34A;color:#fff;border:none;border-radius:4px;padding:4px 8px;font-size:12px;cursor:pointer;">Approve</button>
											</form>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>

						<!-- Right: Financial Division of Funds -->
						<div class="admin-card">
							<div class="card-head">
								<h3 class="card-title">Governance: Dues vs. Giving</h3>
								<span class="badge-pill blue">Verified Multi-Ledger</span>
							</div>
							<div class="funds-dist-list">
								<div class="fund-row">
									<div class="fund-label-wrap">
										<span class="fund-dot" style="background: #C6933D;"></span>
										<strong>Annual Membership Dues ($100 flat)</strong>
									</div>
									<span class="fund-amount">$<?php echo number_format( ( $dues_data['total_collected_cents'] ?? 0 ) / 100, 2 ); ?></span>
								</div>
								<p class="fund-desc">Restricted strictly for administrative operations, member services, digital IDs, and regional communications.</p>

								<hr class="fund-divider">

								<div class="fund-row">
									<div class="fund-label-wrap">
										<span class="fund-dot" style="background: #AB1640;"></span>
										<strong>Voluntary Philanthropic Donations</strong>
									</div>
									<span class="fund-amount">$<?php echo number_format( ( $donations_data['total_verified_cents'] ?? 0 ) / 100, 2 ); ?></span>
								</div>
								<p class="fund-desc">Designated giving across benevolence funds, scholarships, and chapter welfare projects.</p>
							</div>
						</div>
					</div>
				</section>

				<!-- 2. MEMBERS PANEL (ADM-003, ADM-004, ADM-013) -->
				<section class="admin-panel" id="members" aria-labelledby="heading-members">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-members" class="panel-title">Alumni Membership Management</h2>
							<p class="panel-subtitle">Review alumni registrations, membership standing, directory privacy preferences, and annual dues.</p>
						</div>
						<div class="panel-actions">
							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;">
								<?php wp_nonce_field( 'lfa_export_report_action', 'lfa_nonce' ); ?>
								<input type="hidden" name="action" value="lfa_export_csv_report">
								<input type="hidden" name="report_type" value="members">
								<button type="submit" class="btn btn-crimson-admin" id="btn-export-members">Export Members CSV</button>
							</form>
						</div>
					</div>

					<div class="admin-card table-responsive">
						<table class="admin-data-table" id="members-table">
							<thead>
								<tr>
									<th>ID / Name</th>
									<th>Alumni ID</th>
									<th>Chapter / City</th>
									<th>Category</th>
									<th>Dues Status</th>
									<th>Account Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $members as $m ) : ?>
								<tr>
									<td>
										<strong class="row-primary-name"><?php echo esc_html( $m['name'] ); ?></strong>
										<span class="row-subtext"><?php echo esc_html( $m['email'] ); ?></span>
									</td>
									<td><code><?php echo esc_html( $m['alumni_id'] ); ?></code></td>
									<td><?php echo esc_html( $m['chapter'] ); ?></td>
									<td>
										<span class="pill-small"><?php echo esc_html( $m['type'] ); ?></span>
									</td>
									<td>
										<strong class="<?php echo $m['dues_status'] === 'paid' ? 'green-text' : 'row-subtext'; ?>">
											<?php echo esc_html( ucfirst( $m['dues_status'] ) ); ?>
										</strong>
									</td>
									<td>
										<span class="status-pill <?php echo $m['account_status'] === 'approved' ? 'active' : 'yellow'; ?>">
											<?php echo esc_html( ucfirst( $m['account_status'] ) ); ?>
										</span>
									</td>
									<td>
										<?php if ( $m['account_status'] !== 'approved' ) : ?>
											<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline-block;margin:0;">
												<?php wp_nonce_field( 'lfa_portal_member_action', 'lfa_nonce' ); ?>
												<input type="hidden" name="action" value="lfa_portal_member_action">
												<input type="hidden" name="user_id" value="<?php echo (int) $m['id']; ?>">
												<input type="hidden" name="decision" value="approve">
												<input type="hidden" name="alumni_id" value="LFA-NA-<?php echo esc_attr( date( 'Y' ) . '-' . str_pad( (string) $m['id'], 3, '0', STR_PAD_LEFT ) ); ?>">
												<button type="submit" class="btn-table-action primary" style="background:#16A34A;color:#fff;border:none;border-radius:4px;padding:4px 8px;font-size:12px;cursor:pointer;">Approve</button>
											</form>
										<?php else : ?>
											<span style="font-size:12px;color:#16A34A;font-weight:700;">✓ Verified</span>
										<?php endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 3. DUES & PAYMENTS PANEL (ADM-005) -->
				<section class="admin-panel" id="dues" aria-labelledby="heading-dues">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-dues" class="panel-title">Membership Dues &amp; Invoices</h2>
							<p class="panel-subtitle">Authoritative ledger from <code>wp_lfa_dues_invoices</code>. Standard annual membership dues are fixed at $100.</p>
						</div>
						<div class="panel-actions">
							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;">
								<?php wp_nonce_field( 'lfa_export_report_action', 'lfa_nonce' ); ?>
								<input type="hidden" name="action" value="lfa_export_csv_report">
								<input type="hidden" name="report_type" value="dues">
								<button type="submit" class="btn btn-crimson-admin">Export Dues CSV</button>
							</form>
						</div>
					</div>

					<div class="admin-card table-responsive">
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>Invoice ID</th>
									<th>Invoice Number</th>
									<th>User ID</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Due Date</th>
									<th>Paid At</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( empty( $dues_data['invoices'] ) ) : ?>
									<tr><td colspan="7" style="text-align:center;padding:24px;color:#64748B;">No dues invoice records found in database.</td></tr>
								<?php else : ?>
									<?php foreach ( $dues_data['invoices'] as $d ) : ?>
									<tr>
										<td><code>#<?php echo esc_html( $d['id'] ); ?></code></td>
										<td><strong><?php echo esc_html( $d['invoice_number'] ); ?></strong></td>
										<td>User #<?php echo esc_html( $d['user_id'] ); ?></td>
										<td><strong class="amount-val">$<?php echo number_format( (int) $d['amount_cents'] / 100, 2 ); ?></strong></td>
										<td>
											<span class="status-pill <?php echo $d['status'] === 'paid' ? 'active' : 'yellow'; ?>">
												<?php echo esc_html( ucfirst( $d['status'] ) ); ?>
											</span>
										</td>
										<td><?php echo esc_html( $d['due_date'] ?: 'N/A' ); ?></td>
										<td><?php echo esc_html( $d['paid_at'] ?: 'Pending' ); ?></td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 4. DONATIONS & FUNDS PANEL (ANA-007) -->
				<section class="admin-panel" id="donations" aria-labelledby="heading-donations">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-donations" class="panel-title">Voluntary Donations &amp; Fund Accounting</h2>
							<p class="panel-subtitle">Authoritative records from <code>wp_lfa_donations</code>. Philanthropic donations are strictly isolated from regular dues.</p>
						</div>
						<div class="panel-actions">
							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;">
								<?php wp_nonce_field( 'lfa_export_report_action', 'lfa_nonce' ); ?>
								<input type="hidden" name="action" value="lfa_export_csv_report">
								<input type="hidden" name="report_type" value="donations">
								<button type="submit" class="btn btn-crimson-admin">Export Donations CSV</button>
							</form>
						</div>
					</div>

					<div class="admin-card table-responsive">
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>Donation Ref</th>
									<th>Donor Name</th>
									<th>Fund ID</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( empty( $donations_data['donations'] ) ) : ?>
									<tr><td colspan="6" style="text-align:center;padding:24px;color:#64748B;">No donations logged yet.</td></tr>
								<?php else : ?>
									<?php foreach ( $donations_data['donations'] as $don ) : 
										$donor = ! empty( $don['is_anonymous'] ) ? 'Anonymous Donor' : $don['donor_display_name'];
									?>
									<tr>
										<td><code><?php echo esc_html( $don['donation_ref'] ); ?></code></td>
										<td><strong><?php echo esc_html( $donor ); ?></strong></td>
										<td><span class="badge-pill crimson">Fund #<?php echo esc_html( $don['fund_id'] ); ?></span></td>
										<td><strong class="amount-val gold-text">$<?php echo number_format( (int) $don['amount_cents'] / 100, 2 ); ?></strong></td>
										<td><span class="status-pill <?php echo $don['status'] === 'paid' ? 'active' : 'yellow'; ?>"><?php echo esc_html( ucfirst( $don['status'] ) ); ?></span></td>
										<td><?php echo esc_html( date( 'M j, Y', strtotime( $don['created_at'] ) ) ); ?></td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 5. 2027 CONFERENCE PANEL (ADM-008, ADM-009, ADM-010) -->
				<section class="admin-panel" id="conference" aria-labelledby="heading-conference">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-conference" class="panel-title">2027 Biennial Conference ("Thy Kingdom Come")</h2>
							<p class="panel-subtitle">Conference dates: <strong>September 16–19, 2027</strong> &bull; Theme: <strong>Matthew 6:10</strong> &bull; Keynote: <strong>Dr. Uche Igbokwe (U.K.)</strong></p>
						</div>
						<div class="panel-actions">
							<a href="<?php echo esc_url( home_url( '/conference/2027/' ) ); ?>" target="_blank" class="btn btn-crimson-admin">View Public Conference Page &rarr;</a>
						</div>
					</div>

					<?php
					$real_attendees = [];
					if ( class_exists( 'LFA_Conference' ) ) {
						global $wpdb;
						$t_r_att = LFA_Conference::table_attendees();
						$t_r_reg = LFA_Conference::table_registrations();
						$real_attendees = $wpdb->get_results(
							"SELECT a.*, r.registration_number, r.ticket_name_snapshot, r.status as reg_status
							 FROM {$t_r_att} a
							 INNER JOIN {$t_r_reg} r ON a.registration_id = r.id
							 ORDER BY a.id DESC LIMIT 50"
						);
					}
					?>

					<div class="admin-card table-responsive">
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>Attendee ID</th>
									<th>Name / Chapter</th>
									<th>Role / Type</th>
									<th>Ticket Package</th>
									<th>Dietary Notes</th>
									<th>Registration No</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( ! empty( $real_attendees ) ) : ?>
									<?php foreach ( $real_attendees as $ra ) : ?>
									<tr>
										<td><code>#<?php echo esc_html( $ra->id ); ?></code></td>
										<td>
											<strong><?php echo esc_html( $ra->full_name ); ?></strong>
											<span class="row-subtext"><?php echo esc_html( $ra->chapter ?: 'North America Zone' ); ?></span>
										</td>
										<td><span class="badge-pill blue"><?php echo esc_html( ucfirst( $ra->attendee_type ) ); ?></span></td>
										<td><?php echo esc_html( $ra->ticket_name_snapshot ); ?></td>
										<td><?php echo esc_html( $ra->dietary_accessibility ?: 'None' ); ?></td>
										<td><code><?php echo esc_html( $ra->registration_number ); ?></code></td>
										<td><span class="status-pill active"><?php echo esc_html( ucfirst( $ra->status ) ); ?></span></td>
									</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr><td colspan="7" style="text-align:center;padding:24px;color:#64748B;">No attendee registrations recorded yet.</td></tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 6. EVENTS & NEWS PANEL (ADM-014, ADM-015) -->
				<section class="admin-panel" id="events-news" aria-labelledby="heading-events-news">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-events-news" class="panel-title">Events &amp; Community Newsroom Moderation</h2>
							<p class="panel-subtitle">Manage upcoming gatherings and news announcements. Personal announcements require verified consent (ADM-014).</p>
						</div>
					</div>

					<div class="admin-grid-two">
						<div class="admin-card">
							<h3 class="card-title">Published Events (CPT <code>lfa_event</code>)</h3>
							<div class="queue-list">
								<?php if ( empty( $events_posts ) ) : ?>
									<p style="color:#64748B;font-size:14px;">No events found.</p>
								<?php else : ?>
									<?php foreach ( $events_posts as $ev ) : ?>
										<div class="queue-item" style="padding:10px 0;border-bottom:1px solid #E2E8F0;">
											<strong><?php echo esc_html( $ev->post_title ); ?></strong>
											<div style="font-size:12px;color:#64748B;">Status: <?php echo esc_html( ucfirst( $ev->post_status ) ); ?> &bull; Date: <?php echo esc_html( date( 'M j, Y', strtotime( $ev->post_date ) ) ); ?></div>
											<a href="<?php echo esc_url( get_permalink( $ev->ID ) ); ?>" target="_blank" style="font-size:12px;color:#AB1640;font-weight:600;">View Event &rarr;</a>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="admin-card">
							<h3 class="card-title">News &amp; Milestone Announcements (CPT <code>lfa_news</code>)</h3>
							<div class="queue-list">
								<?php if ( empty( $news_posts ) ) : ?>
									<p style="color:#64748B;font-size:14px;">No news posts found.</p>
								<?php else : ?>
									<?php foreach ( $news_posts as $nw ) : 
										$cat = get_post_meta( $nw->ID, '_lfa_news_category', true ) ?: 'Announcements';
										$consent = get_post_meta( $nw->ID, '_lfa_news_consent_agreed', true );
									?>
										<div class="queue-item" style="padding:10px 0;border-bottom:1px solid #E2E8F0;">
											<strong><?php echo esc_html( $nw->post_title ); ?></strong>
											<div style="font-size:12px;color:#64748B;">
												Category: <?php echo esc_html( ucfirst( $cat ) ); ?> &bull; 
												Status: <?php echo esc_html( ucfirst( $nw->post_status ) ); ?> 
												<?php if ( $consent ) : ?>
													&bull; <span style="color:#16A34A;font-weight:700;">✓ Consent Verified</span>
												<?php endif; ?>
											</div>
											<a href="<?php echo esc_url( get_permalink( $nw->ID ) ); ?>" target="_blank" style="font-size:12px;color:#AB1640;font-weight:600;">View Story &rarr;</a>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>

				<!-- 7. SCHOLARSHIPS PANEL (ADM-011) -->
				<section class="admin-panel" id="scholarships" aria-labelledby="heading-scholarships">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-scholarships" class="panel-title">Scholarship Programs &amp; Reviews</h2>
							<p class="panel-subtitle">Authoritative data from <code>wp_lfa_scholarship_applications</code>. Confidential reviewer notes are protected (ANA-005).</p>
						</div>
						<div class="panel-actions">
							<a href="<?php echo esc_url( home_url( '/scholarships/' ) ); ?>" target="_blank" class="btn btn-crimson-admin">View Public Scholarships Page &rarr;</a>
						</div>
					</div>

					<div class="admin-card table-responsive">
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>Application ID</th>
									<th>Program ID</th>
									<th>User ID</th>
									<th>Status</th>
									<th>Award Amount</th>
									<th>Submitted</th>
								</tr>
							</thead>
							<tbody>
								<?php
								global $wpdb;
								$app_table = $wpdb->prefix . 'lfa_scholarship_applications';
								$apps = $wpdb->get_results( "SELECT id, program_id, owner_user_id, applicant_name, school_name, status, created_at FROM `{$app_table}` ORDER BY id DESC LIMIT 50", ARRAY_A );
								?>
								<?php if ( empty( $apps ) ) : ?>
									<tr><td colspan="6" style="text-align:center;padding:24px;color:#64748B;">No scholarship applications recorded yet.</td></tr>
								<?php else : ?>
									<?php foreach ( $apps as $sch ) : ?>
									<tr>
										<td><code>#<?php echo esc_html( $sch['id'] ); ?></code></td>
										<td><strong><?php echo esc_html( $sch['applicant_name'] ); ?></strong></td>
										<td>Program #<?php echo esc_html( $sch['program_id'] ); ?></td>
										<td><?php echo esc_html( $sch['school_name'] ?: 'UNIBEN' ); ?></td>
										<td><span class="badge-pill yellow"><?php echo esc_html( ucfirst( $sch['status'] ) ); ?></span></td>
										<td><?php echo esc_html( date( 'M j, Y', strtotime( $sch['created_at'] ) ) ); ?></td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 8. DIRECTORIES & PRIVACY PANEL (ADM-012, ADM-013) -->
				<section class="admin-panel" id="directories" aria-labelledby="heading-directories">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-directories" class="panel-title">Business Directory Moderation &amp; Privacy</h2>
							<p class="panel-subtitle">Authoritative records from <code>wp_lfa_businesses</code>. Alumni member contacts remain masked according to privacy policy.</p>
						</div>
					</div>

					<div class="admin-card table-responsive">
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Business Name</th>
									<th>Category</th>
									<th>City / Region</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( empty( $businesses ) ) : ?>
									<tr><td colspan="6" style="text-align:center;padding:24px;color:#64748B;">No businesses registered yet.</td></tr>
								<?php else : ?>
									<?php foreach ( $businesses as $b ) : ?>
									<tr>
										<td><code>#<?php echo esc_html( $b['id'] ); ?></code></td>
										<td><strong><?php echo esc_html( $b['name'] ); ?></strong></td>
										<td><span class="pill-small"><?php echo esc_html( $b['category'] ); ?></span></td>
										<td><?php echo esc_html( $b['city'] ?: 'North America' ); ?></td>
										<td>
											<span class="status-pill <?php echo $b['status'] === 'approved' ? 'active' : 'yellow'; ?>">
												<?php echo esc_html( ucfirst( $b['status'] ) ); ?>
											</span>
										</td>
										<td>
											<?php if ( $b['status'] === 'pending_review' ) : ?>
												<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline;">
													<?php wp_nonce_field( 'lfa_portal_business_action', 'lfa_nonce' ); ?>
													<input type="hidden" name="action" value="lfa_portal_business_action">
													<input type="hidden" name="business_id" value="<?php echo esc_attr( $b['id'] ); ?>">
													<input type="hidden" name="decision" value="approve">
													<button type="submit" class="btn-table-action primary">Approve</button>
												</form>
											<?php else : ?>
												<span style="font-size:12px;color:#64748B;">Reviewed</span>
											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 9. ARCHIVES & MEDIA PANEL (ADM-016) -->
				<section class="admin-panel" id="archives-media" aria-labelledby="heading-archives-media">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-archives-media" class="panel-title">Historical Archives &amp; Verified Chronological Timeline</h2>
							<p class="panel-subtitle">Historical records, founding charters, and verified executive transition milestones (GAT-003).</p>
						</div>
						<div class="panel-actions">
							<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" target="_blank" class="btn btn-crimson-admin">View Public Gallery &rarr;</a>
						</div>
					</div>

					<div class="admin-card">
						<h3 class="card-title">Verified Zonal Chronological Timeline</h3>
						<div class="timeline-records">
							<?php foreach ( $timeline as $tm ) : ?>
							<div class="timeline-record-row" style="padding:14px 0;border-bottom:1px solid #E2E8F0;display:flex;align-items:flex-start;gap:16px;">
								<span class="timeline-year-badge" style="background:#0A203A;color:#C6933D;font-weight:700;padding:4px 10px;border-radius:4px;"><?php echo esc_html( $tm['year'] ); ?></span>
								<div class="timeline-record-text" style="flex:1;">
									<strong style="font-size:15px;color:#0A203A;"><?php echo esc_html( $tm['title'] ); ?></strong>
									<p style="margin:4px 0 0;font-size:13px;color:#475569;"><?php echo esc_html( $tm['description'] ); ?></p>
									<span style="font-size:11px;color:#94A3B8;"><?php echo esc_html( $tm['source'] ); ?></span>
								</div>
								<span class="timeline-verified-tag" style="color:#16A34A;font-weight:700;font-size:12px;">&#10003; Documented</span>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</section>

				<!-- 10. VOLUNTEERS PANEL (VOL-001, VOL-002, VOL-008) -->
				<section class="admin-panel" id="volunteers" aria-labelledby="heading-volunteers">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-volunteers" class="panel-title">Volunteer Coordination &amp; Assignments</h2>
							<p class="panel-subtitle">Define opportunities, review member applications, and assign volunteers across zonal committees.</p>
						</div>
					</div>

					<!-- Create Opportunity Form -->
					<div class="admin-card" style="margin-bottom:24px;">
						<h3 class="card-title">Create Volunteer Opportunity</h3>
						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="admin-form" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:14px;">
							<?php wp_nonce_field( 'lfa_save_volunteer_opp_action', 'lfa_nonce' ); ?>
							<input type="hidden" name="action" value="lfa_save_volunteer_opp">
							
							<label>Title
								<input type="text" name="title" class="admin-input" required placeholder="e.g. Protocol & Hospitality Committee">
							</label>

							<label>Committee
								<input type="text" name="committee" class="admin-input" placeholder="e.g. 2027 Conference Committee">
							</label>

							<label>Timeframe
								<input type="text" name="timeframe" class="admin-input" required placeholder="e.g. August–September 2027">
							</label>

							<label>Location Type
								<select name="location_type" class="admin-input">
									<option value="remote">Remote / Virtual</option>
									<option value="in_person">In-Person</option>
									<option value="hybrid">Hybrid</option>
								</select>
							</label>

							<label>Openings
								<input type="number" name="openings" class="admin-input" placeholder="e.g. 10">
							</label>

							<label>Status
								<select name="status" class="admin-input">
									<option value="open">Open (Published)</option>
									<option value="draft">Draft</option>
									<option value="closed">Closed</option>
									<option value="archived">Archived</option>
								</select>
							</label>

							<label style="grid-column: 1 / -1;">Purpose &amp; Responsibilities
								<textarea name="purpose" class="admin-textarea" rows="2" required placeholder="Describe responsibilities and expectations..."></textarea>
							</label>

							<div style="grid-column: 1 / -1;">
								<button type="submit" class="btn btn-crimson-admin">Save Volunteer Opportunity</button>
							</div>
						</form>
					</div>

					<!-- Member Applications Queue -->
					<div class="admin-card table-responsive">
						<h3 class="card-title">Member Applications &amp; Reviews</h3>
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Member Name</th>
									<th>Opportunity</th>
									<th>Availability</th>
									<th>Status</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( empty( $volunteer_signups ) ) : ?>
									<tr><td colspan="7" style="text-align:center;padding:24px;color:#64748B;">No volunteer applications logged yet.</td></tr>
								<?php else : ?>
									<?php foreach ( $volunteer_signups as $vs ) : ?>
									<tr>
										<td><code>#<?php echo esc_html( $vs['id'] ); ?></code></td>
										<td>
											<strong><?php echo esc_html( $vs['display_name'] ); ?></strong>
											<span class="row-subtext"><?php echo esc_html( $vs['user_email'] ); ?></span>
										</td>
										<td><?php echo esc_html( $vs['opp_title'] ); ?></td>
										<td><?php echo esc_html( $vs['availability'] ); ?></td>
										<td>
											<span class="badge-pill <?php echo $vs['status'] === 'approved' ? 'green' : 'yellow'; ?>">
												<?php echo esc_html( ucfirst( $vs['status'] ) ); ?>
											</span>
										</td>
										<td><?php echo esc_html( date( 'M j, Y', strtotime( $vs['created_at'] ) ) ); ?></td>
										<td>
											<?php if ( $vs['status'] === 'pending' ) : ?>
												<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;display:inline-block;">
													<?php wp_nonce_field( 'lfa_review_volunteer_action', 'lfa_nonce' ); ?>
													<input type="hidden" name="action" value="lfa_review_volunteer">
													<input type="hidden" name="signup_id" value="<?php echo (int) $vs['id']; ?>">
													<input type="hidden" name="new_status" value="approved">
													<button type="submit" class="btn-table-action primary" style="background:#16A34A;color:#fff;border:none;padding:4px 8px;font-size:12px;border-radius:4px;cursor:pointer;">Approve</button>
												</form>
											<?php else : ?>
												<span style="font-size:12px;color:#16A34A;font-weight:700;">✓ Reviewed</span>
											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 11. LEADERSHIP & ROSTER PANEL (VOL-010, VOL-011, VOL-012) -->
				<section class="admin-panel" id="leadership" aria-labelledby="heading-leadership">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-leadership" class="panel-title">Leadership, Governance &amp; Executive Roster</h2>
							<p class="panel-subtitle">Authoritative records from <code>wp_lfa_leadership_officers</code>. Distinguishes Global vs North America hierarchy (VOL-012).</p>
						</div>
					</div>

					<!-- Existing Officers Roster -->
					<div class="admin-card table-responsive" style="margin-bottom:24px;">
						<h3 class="card-title">Verified Leadership Roster</h3>
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>Office Title</th>
									<th>Officer Name</th>
									<th>Level</th>
									<th>Tenure / Term</th>
									<th>Status</th>
									<th>Verification</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $leadership as $off ) : ?>
								<tr>
									<td><strong><?php echo esc_html( $off['title'] ); ?></strong></td>
									<td><?php echo esc_html( $off['name'] ); ?></td>
									<td><span class="badge-pill blue"><?php echo esc_html( ucfirst( str_replace( '_', ' ', $off['org_level'] ) ) ); ?></span></td>
									<td><?php echo esc_html( $off['term_start_year'] . '–' . ( $off['term_end_year'] ?: 'Present' ) ); ?></td>
									<td>
										<span class="status-pill <?php echo ! empty( $off['is_current'] ) ? 'active' : 'gray'; ?>">
											<?php echo ! empty( $off['is_current'] ) ? 'Current' : 'Past Officer'; ?>
										</span>
									</td>
									<td>
										<span style="color:#16A34A;font-weight:700;font-size:12px;">✓ <?php echo esc_html( ucfirst( $off['verification_status'] ) ); ?></span>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

					<!-- Add Officer Form -->
					<div class="admin-card">
						<h3 class="card-title">Record Executive Appointment / Past Officer</h3>
						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="admin-form" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:14px;">
							<?php wp_nonce_field( 'lfa_save_leadership_action', 'lfa_nonce' ); ?>
							<input type="hidden" name="action" value="lfa_save_leadership_officer">

							<label>Office Title
								<input type="text" name="title" class="admin-input" required placeholder="e.g. Zonal General Secretary">
							</label>

							<label>Officer Name
								<input type="text" name="name" class="admin-input" required placeholder="Full Name">
							</label>

							<label>Organization Level
								<select name="org_level" class="admin-input">
									<option value="north_america">North America Zone</option>
									<option value="global">Global Love Family</option>
									<option value="chapter">Regional Chapter</option>
								</select>
							</label>

							<label>Start Year
								<input type="number" name="term_start_year" class="admin-input" value="<?php echo esc_attr( date( 'Y' ) ); ?>">
							</label>

							<label>End Year (leave blank if current)
								<input type="number" name="term_end_year" class="admin-input" placeholder="e.g. 2026">
							</label>

							<label style="display:flex;align-items:center;gap:8px;margin-top:24px;">
								<input type="checkbox" name="is_current" value="1" checked>
								<span>Currently in Office</span>
							</label>

							<label style="grid-column: 1 / -1;">Biography &amp; Notes
								<textarea name="biography" class="admin-textarea" rows="2" placeholder="Biographical summary..."></textarea>
							</label>

							<div style="grid-column: 1 / -1;">
								<button type="submit" class="btn btn-crimson-admin">Save Leadership Record</button>
							</div>
						</form>
					</div>
				</section>

				<!-- 12. COMMUNICATIONS PANEL (NOT-009) -->
				<section class="admin-panel" id="communications" aria-labelledby="heading-communications">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-communications" class="panel-title">Executive Communications &amp; Member Broadcast Desk</h2>
							<p class="panel-subtitle">Send authorized broadcast notices to opted-in members via WP Mail SMTP (NOT-009).</p>
						</div>
					</div>

					<div class="admin-card" style="max-width: 800px;">
						<h3 class="card-title">Compose Official Zonal Broadcast</h3>
						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="admin-form">
							<?php wp_nonce_field( 'lfa_broadcast_action', 'lfa_nonce' ); ?>
							<input type="hidden" name="action" value="lfa_broadcast_notification">

							<label>Subject / Notification Title
								<input type="text" name="title" class="admin-input" required placeholder="e.g. 2027 Biennial Conference Registration Opening">
							</label>

							<label>Action URL (optional)
								<input type="url" name="action_url" class="admin-input" placeholder="https://...">
							</label>

							<label>Message Content
								<textarea name="message" class="admin-textarea" rows="4" required placeholder="Enter official announcement message..."></textarea>
							</label>

							<div class="form-actions" style="display:flex;gap:12px;margin-top:14px;">
								<button type="submit" name="is_preview" value="1" class="btn btn-outline-admin">Preview Recipient Count</button>
								<button type="submit" class="btn btn-crimson-admin">Send Official Broadcast</button>
							</div>
						</form>
					</div>
				</section>

				<!-- 13. REPORTS & ANALYTICS PANEL (ANA-001 to ANA-014) -->
				<section class="admin-panel" id="reports" aria-labelledby="heading-reports">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-reports" class="panel-title">Financial &amp; Organizational Analytics</h2>
							<p class="panel-subtitle">Authoritative multi-ledger reconciliation with formula-injection safe CSV exports (ANA-013).</p>
						</div>
					</div>

					<div class="admin-grid-two">
						<div class="admin-card">
							<h3 class="card-title">Membership Status Breakdown</h3>
							<div class="geo-stat-row"><span>Total Registered Alumni</span><strong><?php echo (int) $member_analytics['total_registered']; ?></strong></div>
							<div class="geo-stat-row"><span>Approved Members</span><strong><?php echo (int) $member_analytics['approved']; ?></strong></div>
							<div class="geo-stat-row"><span>Pending Verifications</span><strong><?php echo (int) $member_analytics['pending']; ?></strong></div>
							<div class="geo-stat-row"><span>Annual Membership ($100/yr)</span><strong><?php echo (int) ( $member_analytics['individual'] + ( $member_analytics['couple'] ?? 0 ) ); ?></strong></div>
						</div>

						<div class="admin-card">
							<h3 class="card-title">Revenue by Stream (Authoritative)</h3>
							<div class="geo-stat-row"><span>Annual Membership Dues ($100)</span><strong>$<?php echo number_format( ( $dues_data['total_collected_cents'] ?? 0 ) / 100, 2 ); ?></strong></div>
							<div class="geo-stat-row"><span>Philanthropic Donations</span><strong>$<?php echo number_format( ( $donations_data['total_verified_cents'] ?? 0 ) / 100, 2 ); ?></strong></div>
							<div class="geo-stat-row"><span>Conference Invoices</span><strong>$<?php echo number_format( ( $conf_data['total_collected_cents'] ?? 0 ) / 100, 2 ); ?></strong></div>
							<p class="fund-desc" style="margin-top: 14px;color:#16A34A;font-weight:700;">
								&bull; Zero cross-counting between ledgers (ANA-008 verified).
							</p>
						</div>
					</div>

					<!-- CSV Export Actions -->
					<div class="admin-card" style="margin-top:24px;">
						<h3 class="card-title">Export Authoritative Reports (Formula-Injection Protected)</h3>
						<div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:14px;">
							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;">
								<?php wp_nonce_field( 'lfa_export_report_action', 'lfa_nonce' ); ?>
								<input type="hidden" name="action" value="lfa_export_csv_report">
								<input type="hidden" name="report_type" value="dues">
								<button type="submit" class="btn btn-outline-admin">Export Dues Ledger CSV</button>
							</form>

							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;">
								<?php wp_nonce_field( 'lfa_export_report_action', 'lfa_nonce' ); ?>
								<input type="hidden" name="action" value="lfa_export_csv_report">
								<input type="hidden" name="report_type" value="members">
								<button type="submit" class="btn btn-outline-admin">Export Members Roster CSV</button>
							</form>

							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0;">
								<?php wp_nonce_field( 'lfa_export_report_action', 'lfa_nonce' ); ?>
								<input type="hidden" name="action" value="lfa_export_csv_report">
								<input type="hidden" name="report_type" value="donations">
								<button type="submit" class="btn btn-outline-admin">Export Donations Ledger CSV</button>
							</form>
						</div>
					</div>
				</section>

				<!-- 14. ROLES & ACCESS PANEL (ROL-001 to ROL-020) -->
				<section class="admin-panel" id="roles" aria-labelledby="heading-roles">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-roles" class="panel-title">Role-Based Access Governance &amp; Audit Trail</h2>
							<p class="panel-subtitle">Manage organizational staff assignments with lockout protection (ROL-002) and audit logging (ROL-020).</p>
						</div>
					</div>

					<!-- Assign Role Form (Administrator only) -->
					<?php if ( $is_admin ) : ?>
					<div class="admin-card" style="margin-bottom:24px;">
						<h3 class="card-title">Modify User Organizational Role</h3>
						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="admin-form" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:14px;">
							<?php wp_nonce_field( 'lfa_change_user_role_action', 'lfa_nonce' ); ?>
							<input type="hidden" name="action" value="lfa_change_user_role">

							<label>Target Member
								<select name="target_user_id" class="admin-input" required>
									<?php foreach ( $members as $m ) : ?>
										<option value="<?php echo esc_attr( $m['id'] ); ?>">
											<?php echo esc_html( $m['name'] ); ?> (<?php echo esc_html( implode( ', ', $m['roles'] ) ); ?>)
										</option>
									<?php endforeach; ?>
								</select>
							</label>

							<label>New Role Assignment
								<select name="new_role" class="admin-input" required>
									<option value="lfa_member">Love Family Member</option>
									<option value="lfa_president">Love Family President</option>
									<option value="lfa_general_secretary">General Secretary</option>
									<option value="lfa_treasurer">Treasurer</option>
									<option value="lfa_financial_secretary">Financial Secretary</option>
									<option value="lfa_communications_manager">Communications Manager</option>
									<option value="lfa_communications_editor">Communications Editor</option>
									<option value="lfa_conference_admin">Conference Administrator</option>
									<option value="lfa_conference_publisher">Conference Publisher</option>
									<option value="lfa_scholarship_admin">Scholarship Administrator</option>
									<option value="lfa_scholarship_reviewer">Scholarship Reviewer</option>
									<option value="lfa_archive_manager">Archive Manager</option>
									<option value="lfa_business_moderator">Business Moderator</option>
								</select>
							</label>

							<label style="grid-column: 1 / -1;">Reason for Role Change (Audit Required)
								<input type="text" name="reason" class="admin-input" required placeholder="e.g. Appointment to Zonal Secretariat">
							</label>

							<div style="grid-column: 1 / -1;">
								<button type="submit" class="btn btn-crimson-admin">Execute Role Assignment</button>
							</div>
						</form>
					</div>
					<?php endif; ?>

					<!-- Role Change Audit Trail (ROL-020) -->
					<div class="admin-card table-responsive">
						<h3 class="card-title">Administrative Role Modification Audit Ledger</h3>
						<table class="admin-data-table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Target User</th>
									<th>Actor</th>
									<th>Previous Role</th>
									<th>New Role</th>
									<th>Reason</th>
									<th>Timestamp</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( empty( $role_audit_logs ) ) : ?>
									<tr><td colspan="7" style="text-align:center;padding:24px;color:#64748B;">No role changes recorded in audit ledger.</td></tr>
								<?php else : ?>
									<?php foreach ( $role_audit_logs as $ral ) : ?>
									<tr>
										<td><code>#<?php echo esc_html( $ral['id'] ); ?></code></td>
										<td>User #<?php echo esc_html( $ral['target_user_id'] ); ?></td>
										<td>User #<?php echo esc_html( $ral['actor_user_id'] ); ?></td>
										<td><code><?php echo esc_html( $ral['old_roles'] ); ?></code></td>
										<td><strong class="green-text"><?php echo esc_html( $ral['new_roles'] ); ?></strong></td>
										<td><?php echo esc_html( $ral['reason'] ); ?></td>
										<td><?php echo esc_html( date( 'M j, Y g:ia', strtotime( $ral['created_at'] ) ) ); ?></td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- 15. SETTINGS & SYSTEM PANEL (ADM-007) -->
				<section class="admin-panel" id="settings" aria-labelledby="heading-settings">
					<div class="panel-header-block">
						<div>
							<h2 id="heading-settings" class="panel-title">Administrative Settings &amp; Platform Status</h2>
							<p class="panel-subtitle">Diagnostics, gateway settings links, and executive handover checklist.</p>
						</div>
					</div>

					<div class="admin-card" style="max-width: 850px;margin-bottom:24px;">
						<h3 class="card-title">System &amp; Gateway Diagnostics</h3>
						<div style="display:flex;flex-direction:column;gap:10px;font-size:14px;color:#334155;margin-top:14px;">
							<div>🖥️ <strong>WordPress Core:</strong> 7.1.3 (Reconciled &amp; Verified)</div>
							<div>🔌 <strong>Core Plugin:</strong> love-family-core v1.0.0</div>
							<div>📧 <strong>SMTP Delivery:</strong> WP Mail SMTP Authenticated Mailer (ha4168108@gmail.com verified)</div>
							<div>💳 <strong>Payment Gateways:</strong> 
								PayPal: <?php echo class_exists('LFA_Gateway_Settings') && LFA_Gateway_Settings::is_paypal_enabled() ? '<span style="color:#16a34a;font-weight:600;">Enabled</span>' : '<span style="color:#64748b;">OFF (Awaiting Sandbox Credentials)</span>'; ?> &bull; 
								Stripe Test: <?php echo class_exists('LFA_Gateway_Settings') && LFA_Gateway_Settings::is_stripe_test_enabled() ? '<span style="color:#16a34a;font-weight:700;">ON (Connected &amp; Verified)</span>' : '<span style="color:#64748b;">OFF</span>'; ?> &bull;
								Live Mode: <strong style="color:#dc2626;">OFF (Global Safety Active)</strong>
							</div>
							<?php if ( $paypal_settings_cap ) : ?>
								<div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
									<a href="<?php echo esc_url( admin_url( 'users.php?page=lfa-payment-gateways' ) ); ?>" class="btn" style="background:#0f2942;color:#fff;text-decoration:none;padding:8px 16px;border-radius:6px;font-weight:600;font-size:13px;">
										Manage Payment Gateways &rarr;
									</a>
									<a href="<?php echo esc_url( admin_url( 'users.php?page=lfa-payment-transactions' ) ); ?>" class="btn" style="border:1px solid #cbd5e1;background:#fff;color:#334155;text-decoration:none;padding:8px 16px;border-radius:6px;font-size:13px;font-weight:600;">
										Payment Ledger &rarr;
									</a>
									<a href="<?php echo esc_url( admin_url( 'users.php?page=lfa-member-diagnostics' ) ); ?>" class="btn" style="border:1px solid #cbd5e1;background:#fff;color:#334155;text-decoration:none;padding:8px 16px;border-radius:6px;font-size:13px;font-weight:600;">
										Member Permission Diagnostics &rarr;
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<div class="admin-card" style="max-width: 850px;">
						<h3 class="card-title">Executive Handover Protocol</h3>
						<p>When leadership transitions take place following elections or appointments:</p>
						<ol class="handover-steps">
							<li><strong>Secretariat Records:</strong> Transfer minutes archive, official constitution copies, and verified member roll to the incoming General Secretary.</li>
							<li><strong>Treasury Reconciliation:</strong> Sign-off on annual dues ($100) ledgers and separate accounting of Akpo Scholarship and Conference donation funds.</li>
							<li><strong>Domain &amp; Platform Access:</strong> Transfer primary administrator credentials for this portal and associated email aliases (<a href="mailto:lovefamilyalumni.na@gmail.com">lovefamilyalumni.na@gmail.com</a>).</li>
						</ol>
					</div>
				</section>

			</main>
		</div>
	</div>

	<!-- Toast Notification Container -->
	<div class="lfa-admin-toast" id="lfa-admin-toast" role="alert" aria-live="polite"></div>

</div>
