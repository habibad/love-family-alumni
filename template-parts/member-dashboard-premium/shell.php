<?php
/**
 * Premium Member Dashboard Shell Component
 *
 * Real Member Dashboard Connected to Live WordPress User and Meta Data.
 * Preserves the approved standalone design without public header/footer.
 * Fully integrates Phase 02 Dynamic Completeness, Protected Media & Privacy.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_user = wp_get_current_user();
$uid = $current_user ? (int) $current_user->ID : 0;

$display_name = $current_user && $current_user->display_name ? $current_user->display_name : 'Alumni Member';
$first_name   = $current_user && $current_user->first_name ? $current_user->first_name : ($current_user ? $current_user->display_name : 'Member');
$last_name    = $current_user ? (string) $current_user->last_name : '';
$user_email   = $current_user ? (string) $current_user->user_email : '';

$fn_initial = !empty( $first_name ) ? strtoupper( substr( $first_name, 0, 1 ) ) : 'L';
$ln_initial = !empty( $last_name ) ? strtoupper( substr( $last_name, 0, 1 ) ) : 'F';
$initials   = $fn_initial . $ln_initial;

$alumni_id       = get_user_meta( $uid, 'lfa_alumni_id', true ) ?: 'Pending Assignment';
$membership_type = ucfirst( (string) get_user_meta( $uid, 'lfa_membership_type', true ) ?: 'Individual' );
$account_status  = (string) get_user_meta( $uid, 'lfa_account_status', true ) ?: 'approved';
$dues_status     = (string) get_user_meta( $uid, 'lfa_dues_status', true ) ?: 'unpaid';
$is_full_member  = class_exists( 'LFA_Payment_Entitlements' ) ? LFA_Payment_Entitlements::is_full_member( $uid, true ) : false;
$is_approved     = ( $account_status === 'approved' || (int) get_user_meta( $uid, 'lfa_account_approved', true ) === 1 );

$phone           = (string) get_user_meta( $uid, 'lfa_phone', true );
$city            = (string) get_user_meta( $uid, 'lfa_city', true );
$state           = (string) get_user_meta( $uid, 'lfa_state', true );
$country         = (string) get_user_meta( $uid, 'lfa_country', true );
$profession      = (string) get_user_meta( $uid, 'lfa_profession', true );
$employer        = (string) get_user_meta( $uid, 'lfa_employer_business', true );
$connection      = (string) get_user_meta( $uid, 'lfa_love_family_connection', true );
$uniben          = (string) get_user_meta( $uid, 'lfa_uniben_information', true );
$expertise       = (string) get_user_meta( $uid, 'lfa_expertise', true );
$volunteer       = (string) get_user_meta( $uid, 'lfa_volunteer_interests', true );
$website         = (string) get_user_meta( $uid, 'lfa_website_url', true ) ?: (string) get_user_meta( $uid, 'lfa_website', true );
$social_link     = (string) get_user_meta( $uid, 'lfa_social_link', true );
$biography       = (string) get_user_meta( $uid, 'lfa_biography', true );
$profile_vis     = (string) get_user_meta( $uid, 'lfa_profile_visibility', true ) ?: 'private';
$contact_vis     = (string) get_user_meta( $uid, 'lfa_contact_visibility', true ) ?: 'private';
$avatar_vis      = (string) get_user_meta( $uid, 'lfa_avatar_visibility', true ) ?: 'private';

$partner_name    = (string) get_user_meta( $uid, 'lfa_partner_name', true );
$partner_email   = (string) get_user_meta( $uid, 'lfa_partner_email', true );

$completeness    = class_exists( 'LFA_Profile' ) ? LFA_Profile::calculate_completeness( $uid ) : 60;
$has_avatar      = class_exists( 'LFA_Media' ) ? LFA_Media::has_avatar( $uid ) : false;
$avatar_url      = class_exists( 'LFA_Media' ) ? LFA_Media::get_avatar_url( $uid ) : '';

// Early Server-Side Reconciliation on Return from Stripe
$incoming_session = sanitize_text_field( wp_unslash( $_GET['payment_session_id'] ?? $_GET['session_id'] ?? '' ) );
$session_reconciled = false;
$reconcile_msg = '';
if ( ! empty( $incoming_session ) && class_exists( 'LFA_Payment_Reconciliation' ) && $uid > 0 ) {
    $recon_ctx = sanitize_key( wp_unslash( $_GET['context'] ?? '' ) );
    $recon_res = LFA_Payment_Reconciliation::settle_stripe_session( $incoming_session, $uid, $recon_ctx );
    if ( ! empty( $recon_res['success'] ) ) {
        $session_reconciled = true;
        $reconcile_msg = $recon_res['message'] ?? 'Payment verified and settled.';
    }
}

$lfa_membership  = class_exists( 'LFA_Membership' ) ? LFA_Membership::get_membership_by_user( $uid ) : null;
$lfa_invoices    = class_exists( 'LFA_Membership' ) ? LFA_Membership::get_invoices_for_user( $uid ) : [];
$lfa_policy      = class_exists( 'LFA_Membership' ) ? LFA_Membership::get_policy() : [];
$is_couple       = strtolower( $membership_type ) === 'couple';
$couple_unconfigured = $is_couple && empty( $lfa_policy['couple_base_cents'] );

if ( $lfa_membership && !empty( $lfa_membership->status ) ) {
    $dues_status = (string) $lfa_membership->status;
}

$paypal_enabled   = class_exists( 'LFA_PayPal_Settings' ) && LFA_PayPal_Settings::is_payments_enabled();
$paypal_client_id = class_exists( 'LFA_PayPal_Settings' ) ? LFA_PayPal_Settings::get_client_id() : '';
$paypal_mode      = class_exists( 'LFA_PayPal_Settings' ) ? LFA_PayPal_Settings::get_mode() : 'sandbox';

$orchestrator_overview = class_exists( 'LFA_Payment_Orchestrator' ) ? LFA_Payment_Orchestrator::get_status_overview() : [];
$enabled_gateways      = class_exists( 'LFA_Payment_Orchestrator' ) ? LFA_Payment_Orchestrator::get_enabled_gateways() : [];
$stripe_ready          = !empty( $enabled_gateways['stripe'] );
$paypal_ready          = !empty( $enabled_gateways['paypal'] );
$default_gateway       = class_exists( 'LFA_Gateway_Settings' ) ? LFA_Gateway_Settings::get_default_testing_gateway() : 'stripe';
$user_entitlements     = class_exists( 'LFA_Payment_Entitlements' ) ? LFA_Payment_Entitlements::get_user_entitlements( $uid ) : [];
$is_test_paid          = !empty( $user_entitlements['is_test_paid'] );

$active_unpaid_inv = null;
foreach ( $lfa_invoices as $inv ) {
    if ( $inv->status === 'unpaid' ) {
        $active_unpaid_inv = $inv;
        break;
    }
}

$invoice_val = null;
if ( $active_unpaid_inv && class_exists( 'LFA_Payment_Service' ) ) {
    $invoice_val = LFA_Payment_Service::validate_invoice_for_checkout( (int)$active_unpaid_inv->id, $uid );
}

$my_businesses   = class_exists( 'LFA_Business' ) ? LFA_Business::get_user_businesses( $uid ) : [];
$my_scholarships = class_exists( 'LFA_Scholarship' ) ? LFA_Scholarship::get_user_applications( $uid ) : [];
$all_programs    = class_exists( 'LFA_Scholarship' ) ? LFA_Scholarship::get_all_programs() : [];

$unread_notifications_count = class_exists( 'LFA_Notifications' ) ? LFA_Notifications::get_unread_count( $uid ) : 0;
$my_notifications           = class_exists( 'LFA_Notifications' ) ? LFA_Notifications::get_user_notifications( $uid ) : [];
$my_volunteers              = class_exists( 'LFA_Volunteers' ) ? LFA_Volunteers::get_user_signups( $uid ) : [];
$available_volunteers       = class_exists( 'LFA_Volunteers' ) ? LFA_Volunteers::get_opportunities( 'open' ) : [];
$notification_prefs         = class_exists( 'LFA_Notifications' ) ? LFA_Notifications::get_preferences( $uid ) : [];
$can_view_admin             = current_user_can( 'administrator' ) || current_user_can( 'lfa_view_admin_portal' );

// Resolve official Love Family Alumni Logo
$site_logo_id = (int) get_theme_mod( 'custom_logo' );
if ( $site_logo_id ) {
	$official_logo = wp_get_attachment_image( $site_logo_id, 'thumbnail', false, [
		'class' => 'lfa-portal-official-logo',
		'alt'   => 'Love Family Alumni logo',
	] );
} elseif ( function_exists( 'lfa_image_url' ) ) {
	$logo_src      = lfa_image_url( 'brand-logo-source.jpg' );
	$official_logo = '<img src="' . esc_url( $logo_src ) . '" alt="Love Family Alumni logo" class="lfa-portal-official-logo" width="40" height="40">';
} else {
	$logo_src      = get_template_directory_uri() . '/assets/images/brand-logo-source.jpg';
	$official_logo = '<img src="' . esc_url( $logo_src ) . '" alt="Love Family Alumni logo" class="lfa-portal-official-logo" width="40" height="40">';
}
?>
<div class="portal" id="portal">
<aside class="sidebar" id="sideNav" aria-label="Member portal navigation">
  <a class="brand" href="#overview" aria-label="Love Family Alumni member portal home">
    <span class="brand-emblem"><?php echo $official_logo; ?></span>
    <span class="brand-name"><strong>LOVE FAMILY<br>ALUMNI</strong><small>NORTH AMERICA ZONE</small></span>
  </a>
  <div class="portal-tag"><span class="portal-tag-mark"></span> MEMBER PORTAL <span class="tag-demo" style="background:#0F2942;color:#C6933D;border:1px solid #C6933D;">ACTIVE</span></div>
  <nav class="nav" aria-label="Dashboard sections">
    <div class="nav-label">WORKSPACE</div>
    <a href="#overview" class="nav-link is-active" data-route="overview"><span class="ico" data-icon="squares"></span><span>Overview</span></a>
    <a href="#notifications" class="nav-link" data-route="notifications"><span class="ico" data-icon="bell"></span><span>Notifications</span><?php if ( $unread_notifications_count > 0 ) : ?><span style="margin-left:auto;background:#AB1640;color:#fff;border-radius:10px;padding:2px 7px;font-size:11px;font-weight:700;"><?php echo (int)$unread_notifications_count; ?></span><?php endif; ?></a>
    <a href="#alumni-id" class="nav-link" data-route="alumni-id"><span class="ico" data-icon="badge"></span><span>Alumni ID</span></a>
    <a href="#membership" class="nav-link" data-route="membership"><span class="ico" data-icon="shield"></span><span>Membership</span></a>
    <a href="#profile" class="nav-link" data-route="profile"><span class="ico" data-icon="user"></span><span>My Profile</span></a>
    <a href="#dues" class="nav-link" data-route="dues"><span class="ico" data-icon="wallet"></span><span>Dues & Receipts</span></a>
    <div class="nav-label nav-label-second">COMMUNITY</div>
    <a href="#conference" class="nav-link" data-route="conference"><span class="ico" data-icon="calendar"></span><span>2027 Conference</span></a>
    <a href="#volunteers" class="nav-link" data-route="volunteers"><span class="ico" data-icon="heart"></span><span>Volunteers</span></a>
    <a href="#businesses" class="nav-link" data-route="businesses"><span class="ico" data-icon="building"></span><span>My Businesses</span></a>
    <a href="#scholarships" class="nav-link" data-route="scholarships"><span class="ico" data-icon="award"></span><span>Scholarships</span></a>
    <div class="nav-label nav-label-second">PREFERENCES</div>
    <a href="#settings" class="nav-link" data-route="settings"><span class="ico" data-icon="gear"></span><span>Account Settings</span></a>
    <?php if ( $can_view_admin ) : ?>
      <div class="nav-label nav-label-second" style="color:#C6933D;">ADMINISTRATION</div>
      <a href="<?php echo esc_url( home_url( '/admin-portal/' ) ); ?>" class="nav-link" style="color:#C6933D;font-weight:700;"><span class="ico" data-icon="shield"></span><span>Admin Portal &rarr;</span></a>
    <?php endif; ?>
  </nav>
  <div class="side-bottom">
    <div class="sidebar-support">
      <span class="support-icon" data-icon="life"></span>
      <strong>Need assistance?</strong>
      <p>Reach the North America Zone team for membership questions.</p>
      <a href="mailto:lovefamilyalumni.na@gmail.com">Contact the team <span aria-hidden="true">↗</span></a>
    </div>
    <a class="back-link" href="<?php echo esc_url( wp_logout_url( home_url( '/member-login/' ) ) ); ?>" style="color:#d9534f;margin-bottom:6px;"><span class="ico" data-icon="arrowleft"></span> Sign Out</a>
    <a class="back-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="ico" data-icon="arrowleft"></span> Back to website</a>
  </div>
</aside>
<div class="sidebar-backdrop" id="sidebarBackdrop" hidden></div>
<div class="app-area">
  <header class="topbar">
    <div class="top-left">
      <button class="mobile-menu icon-button" type="button" aria-controls="sideNav" aria-expanded="false" aria-label="Open sidebar navigation" id="menuToggle"><span data-icon="menu"></span></button>
      <span class="top-crumb">Member Portal</span>
      <span class="top-slash">/</span>
      <strong class="crumb-active" id="crumbName">Overview</strong>
    </div>
    <div class="top-right">
      <span class="environment" style="background:rgba(198,147,61,0.15);color:#C6933D;border:1px solid #C6933D;"><span class="env-dot" style="background:#28a745;"></span> Verified Member</span>
      <span class="top-divider"></span>
      <span class="top-avatar" aria-hidden="true" style="overflow:hidden;padding:0;">
        <?php if ( $has_avatar ) : ?>
          <img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $display_name ); ?>" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
        <?php else : ?>
          <?php echo esc_html( $initials ); ?>
        <?php endif; ?>
      </span>
      <span class="top-user"><strong><?php echo esc_html( $display_name ); ?></strong><small><?php echo esc_html( $alumni_id ); ?></small></span>
      <a href="<?php echo esc_url( wp_logout_url( home_url( '/member-login/' ) ) ); ?>" class="button-outline button-sm" style="margin-left:8px;" title="Sign out of your account">Sign Out</a>
    </div>
  </header>

  <?php if ( $stripe_ready ) : ?>
    <aside class="stripe-test-banner" role="status" aria-label="Payment Gateway Notice" style="background:#fffbeb;border-bottom:1px solid #fde68a;padding:10px 24px;display:flex;align-items:center;justify-content:space-between;font-size:12px;color:#92400e;flex-wrap:wrap;gap:8px;">
      <div style="display:flex;align-items:center;gap:10px;">
        <span style="display:inline-block;background:#f59e0b;color:#fff;font-weight:800;padding:2px 8px;border-radius:4px;font-size:11px;letter-spacing:0.5px;">STRIPE TEST MODE</span>
        <span><strong>NO REAL MONEY CHARGED.</strong> Payment testing is active with Stripe Test Mode. Use official Stripe test cards.</span>
      </div>
      <span style="font-family:monospace;font-size:11px;background:#fef3c7;padding:3px 8px;border-radius:4px;border:1px solid #fde68a;">Stripe Checkout &bull; Test Gateway</span>
    </aside>
  <?php endif; ?>

  <?php 
  $incoming_session = sanitize_text_field( wp_unslash( $_GET['payment_session_id'] ?? $_GET['session_id'] ?? '' ) );
  if ( ! empty( $incoming_session ) ) : ?>
    <aside id="lfa-reconcile-banner" role="alert" style="background:<?php echo $session_reconciled ? '#dcfce7' : '#eff6ff'; ?>;border-bottom:2px solid <?php echo $session_reconciled ? '#16a34a' : '#3b82f6'; ?>;padding:12px 24px;display:flex;align-items:center;justify-content:space-between;color:<?php echo $session_reconciled ? '#166534' : '#1e40af'; ?>;font-size:13px;flex-wrap:wrap;gap:10px;" data-session-id="<?php echo esc_attr( $incoming_session ); ?>">
      <div style="display:flex;align-items:center;gap:12px;">
        <?php if ( ! $session_reconciled ) : ?>
          <span class="lfa-reconcile-spinner" style="display:inline-block;width:16px;height:16px;border:2px solid #93c5fd;border-top-color:#1d4ed8;border-radius:50%;animation:lfa-spin 0.8s linear infinite;"></span>
        <?php endif; ?>
        <span id="lfa-reconcile-status">
          <?php if ( $session_reconciled ) : ?>
            <strong>Payment Verified!</strong> <?php echo esc_html( $reconcile_msg ?: 'Checkout session settled with server.' ); ?>
          <?php else : ?>
            <strong>Verifying Stripe Test Payment...</strong> Reconciling checkout session <code><?php echo esc_html( substr( $incoming_session, 0, 18 ) ); ?>...</code> with server.
          <?php endif; ?>
        </span>
      </div>
      <button type="button" onclick="document.getElementById('lfa-reconcile-banner').remove();" class="button-outline button-sm" style="background:#fff;border-color:currentColor;color:inherit;padding:3px 10px;font-size:11px;">Dismiss</button>
    </aside>
  <?php endif; ?>

  <?php if ( class_exists( 'LFA_Core' ) ) : ?>
    <div style="padding:16px 34px 0 34px;">
      <?php echo LFA_Core::notice_html(); ?>
    </div>
  <?php endif; ?>

  <main class="workarea" id="workarea">
    <!-- View 1: Overview -->
    <section class="view is-visible" id="overview" data-view="overview" aria-label="Member overview">
      <div class="page-intro">
        <div>
          <div class="overline">YOUR MEMBER WORKSPACE <span class="tiny-diamond">◆</span> OFFICIAL PORTAL</div>
          <h1>Welcome back, <span><?php echo esc_html( $first_name ); ?>.</span></h1>
          <p>Everything that connects you to the Love Family Alumni community, in one place.</p>
        </div>
        <button class="button-outline" type="button" data-go="profile"><span data-icon="user"></span> View my profile <span class="arrow">↗</span></button>
      </div>

      <?php if ( $is_approved && ! $is_full_member ) : ?>
        <div class="lfa-unpaid-alert" style="background:#fffbeb;border:1px solid #fde68a;border-left:5px solid #d97706;border-radius:10px;padding:20px 24px;margin-bottom:24px;box-shadow:0 2px 4px rgba(0,0,0,0.02);">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div style="display:flex;align-items:flex-start;gap:14px;max-width:760px;">
              <span style="font-size:24px;line-height:1;margin-top:2px;">⚠️</span>
              <div>
                <h3 style="margin:0 0 6px 0;font-size:16px;color:#92400e;font-weight:700;letter-spacing:-0.2px;">Limited Dashboard Access &mdash; Annual Membership Dues Pending ($100.00 USD)</h3>
                <p style="margin:0 0 8px 0;font-size:14px;color:#78350f;line-height:1.5;">Your alumni account has been approved by the Administrator. However, in accordance with the <strong>North America Zone Membership Access Policy</strong>, access to member benefits (including private Alumni Directory records, business registrations, scholarships, and members-only conference tickets) requires settled annual Individual Membership dues.</p>
                <span style="display:inline-block;font-size:12px;font-weight:600;color:#92400e;background:#fef3c7;padding:3px 8px;border-radius:4px;border:1px solid #fde68a;">Action Required: Complete your $100 annual dues invoice to immediately unlock all member privileges.</span>
              </div>
            </div>
            <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end;">
              <button class="button-dark" type="button" data-go="dues" style="background:#d97706;border-color:#b45309;padding:10px 20px;font-size:14px;font-weight:700;white-space:nowrap;box-shadow:0 2px 4px rgba(217,119,6,0.2);">Pay Annual Dues Now &rarr;</button>
              <span style="font-size:11px;color:#92400e;">Instant automatic unlocking upon payment</span>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="kpi-grid">
        <article class="metric">
          <div class="metric-head"><span>Account Standing</span><span class="metric-icon wine" data-icon="shield"></span></div>
          <div class="metric-main"><?php echo esc_html( ucfirst( $account_status ) ); ?></div>
          <div class="metric-foot"><span class="small-pill" style="background:#e6f4ea;color:#137333;">APPROVED</span> <span>Verified alumni member</span></div>
        </article>
        <article class="metric">
          <div class="metric-head"><span>Alumni ID</span><span class="metric-icon blue" data-icon="badge"></span></div>
          <div class="metric-main" style="font-size:1.15rem;"><?php echo esc_html( $alumni_id ); ?></div>
          <div class="metric-foot"><span class="small-pill soft">ASSIGNED</span> <span>North America Zone ID</span></div>
        </article>
        <article class="metric">
          <div class="metric-head"><span>Annual Dues</span><span class="metric-icon gold" data-icon="wallet"></span></div>
          <div class="metric-main"><?php echo esc_html( ucfirst( $dues_status ) ); ?></div>
          <div class="metric-foot">
            <?php if ( $dues_status === 'current' || $dues_status === 'paid' ) : ?>
              <span class="small-pill" style="background:#e6f4ea;color:#137333;font-weight:700;"><?php echo $is_test_paid ? 'TEST PAID' : 'GOOD STANDING'; ?></span> <span><?php echo $is_test_paid ? 'Staging Active 2026/27' : 'Current through 2027'; ?></span>
            <?php elseif ( $couple_unconfigured ) : ?>
              <span class="small-pill soft" style="background:#fee2e2;color:#991b1b;">POLICY PENDING</span><span>Couple rate unconfirmed</span>
            <?php else : ?>
              <span class="small-pill soft" style="background:#fee2e2;color:#991b1b;">$100.00 DUE</span><span><?php echo $stripe_ready ? 'Stripe Test Ready' : ( $paypal_ready ? 'PayPal Sandbox' : 'Gateway Pending' ); ?></span>
            <?php endif; ?>
          </div>
        </article>
        <article class="metric">
          <div class="metric-head"><span>Next Conference</span><span class="metric-icon purple" data-icon="calendar"></span></div>
          <div class="metric-main">2027</div>
          <div class="metric-foot"><span class="small-pill soft">UPCOMING</span><span>Sept 16&ndash;19, 2027</span></div>
        </article>
      </div>
      <div class="completion-card">
        <div class="completion-top">
          <div class="completion-badge" data-icon="spark"></div>
          <div class="completion-text">
            <h2>Your Official Alumni Profile</h2>
            <p>Keep your contact details, career experience, and privacy preferences up to date.</p>
          </div>
          <div class="completion-score"><strong><?php echo esc_html( $completeness ); ?>%</strong><small>Profile Completed</small></div>
        </div>
        <div class="progress-track"><div class="progress-fill" style="width: <?php echo esc_attr( $completeness ); ?>%;"></div></div>
        <div class="completion-bottom">
          <div class="check-steps">
            <span><b>✓</b> Email Verified</span>
            <span><b>✓</b> Account Approved</span>
            <span><b><?php echo !empty($alumni_id) && $alumni_id !== 'Pending Assignment' ? '✓' : '○'; ?></b> Alumni ID</span>
            <span><b><?php echo !empty($phone) && (!empty($city) || !empty($country)) ? '✓' : '○'; ?></b> Contact &amp; Location</span>
            <span><b><?php echo !empty($profession) || !empty($employer) ? '✓' : '○'; ?></b> Career Background</span>
            <span><b><?php echo $has_avatar ? '✓' : '○'; ?></b> Profile Photo</span>
          </div>
          <button class="button-dark button-sm" type="button" data-go="profile">Manage Profile <span>→</span></button>
        </div>
      </div>
      <div class="two-col">
        <section class="panel">
          <div class="panel-heading">
            <div><div class="section-kicker">YOUR SHORTCUTS</div><h2>Quick actions</h2></div>
            <span class="section-note">Common member tasks</span>
          </div>
          <div class="quick-grid">
            <button type="button" class="quick-action" data-go="profile"><span class="quick-icon blue" data-icon="user"></span><strong>Edit profile</strong><small>Update your information</small><span class="quick-arrow">↗</span></button>
            <button type="button" class="quick-action" data-go="alumni-id"><span class="quick-icon wine" data-icon="badge"></span><strong>Digital Alumni ID</strong><small>View & copy credential</small><span class="quick-arrow">↗</span></button>
            <button type="button" class="quick-action" data-go="conference"><span class="quick-icon gold" data-icon="calendar"></span><strong>2027 conference</strong><small>Thy Kingdom Come</small><span class="quick-arrow">↗</span></button>
            <button type="button" class="quick-action" data-go="dues"><span class="quick-icon purple" data-icon="wallet"></span><strong>Dues schedule</strong><small>$100 Annual requirement</small><span class="quick-arrow">↗</span></button>
          </div>
        </section>
        <section class="panel updates-panel">
          <div class="panel-heading">
            <div><div class="section-kicker">ACCOUNT STATUS</div><h2>Member Verification & Standing</h2></div>
            <span class="section-note">Real-time status</span>
          </div>
          <div class="activity">
            <div class="activity-item"><div class="activity-icon" data-icon="user"></div><div><strong>Account Standing</strong><p>Status: <?php echo esc_html( ucfirst( $account_status ) ); ?> (Approved member)</p></div><span class="activity-chevron">✓</span></div>
            <div class="activity-item"><div class="activity-icon" data-icon="badge"></div><div><strong>Alumni ID Assigned</strong><p><?php echo esc_html( $alumni_id ); ?></p></div><span class="activity-chevron">✓</span></div>
            <div class="activity-item"><div class="activity-icon" data-icon="wallet"></div><div><strong>Annual Membership Dues</strong><p>Status: <?php echo esc_html( ucfirst( $dues_status ) ); ?> &middot; $100.00 / year (Phase 04)</p></div><span class="activity-chevron">→</span></div>
            <div class="activity-item"><div class="activity-icon" data-icon="calendar"></div><div><strong>Biennial Conference</strong><p>Sept 16&ndash;19, 2027 &middot; Matthew 6:10</p></div><span class="activity-chevron">→</span></div>
          </div>
        </section>
      </div>
      <div class="bottom-row">
        <section class="id-summary">
          <div>
            <div class="id-label">OFFICIAL DIGITAL ALUMNI ID <span>&middot; ACTIVE</span></div>
            <h2>One family.<br>Every generation.</h2>
            <div class="id-summary-bottom"><?php echo esc_html( $alumni_id ); ?> <button type="button" data-go="alumni-id" aria-label="View Alumni ID">View ID &rarr;</button></div>
          </div>
          <div class="id-medallion">LFA<small>TOGETHER WE RISE</small></div>
        </section>
        <section class="conference-summary">
          <span class="conference-eyebrow">2027 ALUMNI CONFERENCE</span>
          <h2>“Thy Kingdom Come”</h2>
          <p>Matthew 6:10 &middot; September 16&ndash;19, 2027</p>
          <button type="button" data-go="conference">Explore conference <span>&rarr;</span></button>
          <div class="conference-art">2027</div>
        </section>
      </div>
    </section>

    <!-- View 2: Alumni ID -->
    <section class="view" id="alumni-id" data-view="alumni-id" hidden>
      <div class="sub-intro">
        <span class="overline">IDENTITY & MEMBERSHIP</span>
        <h1>My Alumni ID</h1>
        <p>Your official Love Family Alumni North America credential issued following administrator approval.</p>
      </div>
      <div class="content-panel split-panel">
        <div class="sample-id-card">
          <div class="sample-card-top">
            <span>LOVE FAMILY ALUMNI<br><small>NORTH AMERICA ZONE</small></span>
            <span class="sample-demo-chip" style="background:#28a745;color:#fff;">OFFICIAL</span>
          </div>
          <div class="sample-card-center">
            <?php if ( $has_avatar ) : ?>
              <img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $display_name ); ?>" style="width:56px;height:56px;object-fit:cover;border-radius:11px;border:2px solid #e1b969;">
            <?php else : ?>
              <span class="big-initial"><?php echo esc_html( $initials ); ?></span>
            <?php endif; ?>
            <div>
              <small>MEMBER CREDENTIAL</small>
              <strong><?php echo esc_html( $display_name ); ?></strong>
              <span id="card-alumni-id-val"><?php echo esc_html( $alumni_id ); ?></span>
            </div>
          </div>
          <div class="sample-card-bottom">ONE FAMILY. ACROSS BORDERS.<span>ISSUED &middot; <?php echo esc_html( $membership_type ); ?></span></div>
        </div>
        <div class="detail-copy">
          <h2>Your digital alumni identity</h2>
          <p>This Alumni ID confirms your verified standing with Love Family Alumni Association (North America Zone). Present this identifier for zonal events, directories, and member-only activities.</p>
          <button class="button-dark" id="copyId">Copy Alumni ID</button>
          <p class="help-text">Assigned unique identifier: <strong><?php echo esc_html( $alumni_id ); ?></strong></p>
        </div>
      </div>
    </section>

    <!-- View 3: Membership -->
    <section class="view" id="membership" data-view="membership" hidden>
      <div class="sub-intro">
        <span class="overline">MY MEMBERSHIP</span>
        <h1>Membership overview</h1>
        <p>Review your active Love Family Alumni category, credentials, and verification standing.</p>
      </div>
      <div class="content-panel info-grid">
        <div class="info-item">
          <small>MEMBERSHIP TYPE</small>
          <strong><?php echo esc_html( $membership_type ); ?> Membership</strong>
          <p><?php echo $membership_type === 'Couple' ? 'Couple application with spouse records linked.' : 'Individual alumnus membership.'; ?></p>
        </div>
        <div class="info-item">
          <small>ACCOUNT STANDING</small>
          <strong style="color:#137333;"><?php echo esc_html( ucfirst( $account_status ) ); ?></strong>
          <p>Email verified and approved by zonal administrators.</p>
        </div>
        <div class="info-item">
          <small>DUES STATUS</small>
          <strong style="color:#991b1b;"><?php echo esc_html( ucfirst( $dues_status ) ); ?> ($100.00 Annual)</strong>
          <p>Payment processing will be integrated in Phase 04 via PayPal capture.</p>
        </div>
        <div class="info-item">
          <small>ALUMNI ID</small>
          <strong><?php echo esc_html( $alumni_id ); ?></strong>
          <p>Permanent North America alumni identification number.</p>
        </div>
        <?php if ( $membership_type === 'Couple' ) : ?>
          <div class="info-item" style="grid-column: 1 / -1;">
            <small>SPOUSE / PARTNER INFORMATION</small>
            <strong><?php echo esc_html( $partner_name ?: 'Partner Name Not Specified' ); ?></strong>
            <p><?php echo esc_html( $partner_email ?: 'No partner email provided' ); ?> &middot; <em>Stored strictly private to your account and administrative records.</em></p>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- View 4: My Profile -->
    <section class="view" id="profile" data-view="profile" hidden>
      <div class="sub-intro">
        <span class="overline">YOUR INFORMATION</span>
        <h1>My profile</h1>
        <p>Manage your personal details, profile photo, and privacy preferences. Updates are saved directly to your account.</p>
      </div>

      <!-- Profile Photo Management Panel -->
      <div class="content-panel" style="margin-bottom:20px;">
        <div class="form-heading">
          <h2>Profile Photo</h2>
          <span class="small-pill soft">Visibility: <?php echo esc_html( ucfirst( $avatar_vis ) ); ?></span>
        </div>
        <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap;">
          <div style="width:96px;height:96px;border-radius:14px;overflow:hidden;border:2px solid #e4eaf2;background:#f8e5eb;display:grid;place-items:center;flex-shrink:0;">
            <?php if ( $has_avatar ) : ?>
              <img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $display_name ); ?>" style="width:100%;height:100%;object-fit:cover;">
            <?php else : ?>
              <span style="font-size:28px;font-weight:800;color:#9e2146;"><?php echo esc_html( $initials ); ?></span>
            <?php endif; ?>
          </div>
          <div style="flex:1;min-width:260px;">
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data" style="display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;">
              <input type="hidden" name="action" value="lfa_upload_avatar">
              <?php wp_nonce_field( 'lfa_avatar_action_' . $uid, 'lfa_avatar_nonce' ); ?>
              <div style="flex:1;min-width:200px;">
                <label style="font-size:11px;font-weight:700;color:#566778;display:block;margin-bottom:6px;">Select image (JPG, PNG or WebP &le; 3 MB)</label>
                <input type="file" name="avatar" accept=".jpg,.jpeg,.png,.webp" required style="font-size:12px;width:100%;">
              </div>
              <div style="min-width:180px;">
                <label style="font-size:11px;font-weight:700;color:#566778;display:block;margin-bottom:6px;">Photo Visibility</label>
                <select name="avatar_visibility" style="padding:8px 10px;border-radius:6px;border:1px solid #dce3ea;font-size:12px;width:100%;">
                  <option value="private" <?php selected( $avatar_vis, 'private' ); ?>>Private (Only you &amp; admins)</option>
                  <option value="members" <?php selected( $avatar_vis, 'members' ); ?>>Members Only (Approved alumni)</option>
                  <option value="public" <?php selected( $avatar_vis, 'public' ); ?>>Public (Consented directory view)</option>
                </select>
              </div>
              <div>
                <button type="submit" class="button-dark button-sm">Upload Photo</button>
              </div>
            </form>
            <?php if ( $has_avatar ) : ?>
              <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin-top:10px;">
                <input type="hidden" name="action" value="lfa_delete_avatar">
                <?php wp_nonce_field( 'lfa_avatar_action_' . $uid, 'lfa_avatar_nonce' ); ?>
                <button type="submit" class="button-outline button-sm" style="color:#d9534f;border-color:#f1b0b7;" onclick="return confirm('Remove your profile photo?');">Remove Photo</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Main Profile Information Form -->
      <form class="content-panel demo-form" id="profileRealForm" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="action" value="lfa_update_member_profile">
        <?php wp_nonce_field( 'lfa_update_profile_' . $uid, 'lfa_profile_nonce' ); ?>
        <div class="form-heading">
          <h2>Personal &amp; Professional Information</h2>
          <span class="small-pill" style="background:#e6f4ea;color:#137333;">ID: <?php echo esc_html( $alumni_id ); ?></span>
        </div>
        <div class="form-grid">
          <label>First name *
            <input type="text" name="first_name" required maxlength="100" value="<?php echo esc_attr( $first_name ); ?>">
          </label>
          <label>Last name *
            <input type="text" name="last_name" required maxlength="100" value="<?php echo esc_attr( $last_name ); ?>">
          </label>
          <label>Email address
            <input type="email" value="<?php echo esc_attr( $user_email ); ?>" disabled title="Contact an administrator to change your email">
          </label>
          <label>Phone number
            <input type="tel" name="phone" maxlength="35" value="<?php echo esc_attr( $phone ); ?>">
          </label>
          <label>City
            <input type="text" name="city" maxlength="100" value="<?php echo esc_attr( $city ); ?>">
          </label>
          <label>State / Province
            <input type="text" name="state" maxlength="100" value="<?php echo esc_attr( $state ); ?>">
          </label>
          <label>Country
            <input type="text" name="country" maxlength="100" value="<?php echo esc_attr( $country ); ?>">
          </label>
          <label>Profession / Sector
            <input type="text" name="profession" maxlength="150" value="<?php echo esc_attr( $profession ); ?>">
          </label>
          <label>Employer / Business
            <input type="text" name="employer_business" maxlength="150" value="<?php echo esc_attr( $employer ); ?>">
          </label>
          <label>Love Family Connection
            <input type="text" name="love_family_connection" maxlength="250" value="<?php echo esc_attr( $connection ); ?>">
          </label>
          <label>UNIBEN Information / Batch
            <input type="text" name="uniben_information" maxlength="250" value="<?php echo esc_attr( $uniben ); ?>">
          </label>
          <label>Areas of Expertise
            <input type="text" name="expertise" maxlength="350" value="<?php echo esc_attr( $expertise ); ?>">
          </label>
          <label>Volunteer Interests
            <input type="text" name="volunteer_interests" maxlength="350" value="<?php echo esc_attr( $volunteer ); ?>">
          </label>
          <label>Website
            <input type="url" name="website_url" maxlength="250" value="<?php echo esc_attr( $website ); ?>" placeholder="https://">
          </label>
          <label>Social Media Link
            <input type="url" name="social_link" maxlength="250" value="<?php echo esc_attr( $social_link ); ?>" placeholder="https://linkedin.com/in/...">
          </label>
          <label class="full">Biography
            <textarea name="biography" rows="3" maxlength="2500" placeholder="Briefly introduce yourself..."><?php echo esc_textarea( $biography ); ?></textarea>
          </label>
          <label>General Profile Visibility
            <select name="profile_visibility">
              <option value="private" <?php selected( $profile_vis, 'private' ); ?>>Private (Only you &amp; admins)</option>
              <option value="members" <?php selected( $profile_vis, 'members' ); ?>>Members Only (Approved alumni)</option>
              <option value="public" <?php selected( $profile_vis, 'public' ); ?>>Public (Consented directory view)</option>
            </select>
          </label>
          <label>Contact Details Visibility
            <select name="contact_visibility">
              <option value="private" <?php selected( $contact_vis, 'private' ); ?>>Private (Default &amp; Recommended)</option>
              <option value="members" <?php selected( $contact_vis, 'members' ); ?>>Members Only</option>
              <option value="public" <?php selected( $contact_vis, 'public' ); ?>>Public</option>
            </select>
          </label>
        </div>
        <p class="help-text" style="margin-top:12px;font-style:italic;">
          Personal contact details (email and phone) remain private by default unless you explicitly opt to share with verified alumni members.
        </p>
        <div class="form-actions" style="margin-top:16px;">
          <button class="button-dark" type="submit">Save Profile Changes</button>
          <button type="reset" class="button-outline">Reset Changes</button>
        </div>
      </form>
    </section>

    <!-- View 5: Dues & Receipts -->
    <section class="view" id="dues" data-view="dues" hidden>
      <div class="sub-intro">
        <span class="overline">FINANCIAL OVERVIEW</span>
        <h1>Dues &amp; receipts</h1>
        <p>Annual membership dues are fixed at <strong>$100.00 USD</strong> for Individual membership. Payments are securely processed via PayPal with server-side capture verification.</p>
      </div>

      <?php if ( $couple_unconfigured ) : ?>
        <div class="notice-block" style="border-left:4px solid #dba617;background:#fff8e5;color:#855a00;">
          <strong>Couple Membership Policy Notice:</strong> Couple membership dues pricing is currently awaiting administrator policy confirmation per client contract. Invoices for couple accounts will be issued once the approved couple rate is configured by zonal administrators.
        </div>
      <?php else : ?>
        <div class="notice-block">
          <strong>Membership Standing:</strong> Account Status: <strong>Approved</strong> &middot; Dues Status: <strong><?php echo esc_html( ucfirst( $dues_status ) ); ?></strong> ($100.00 annual requirement). Payments are securely settled via server-verified PayPal checkout. Genuine receipts are available immediately upon payment completion.
        </div>
      <?php endif; ?>

      <div class="content-panel">
        <div class="form-heading">
          <h2>Authoritative Dues Invoices</h2>
          <span class="small-pill soft" style="<?php echo $dues_status === 'current' ? 'background:#dcfce7;color:#166534;' : 'background:#fee2e2;color:#991b1b;'; ?>">
            <?php echo esc_html( ucfirst( $dues_status ) ); ?>
          </span>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr><th>Invoice Number</th><th>Schedule / Description</th><th>Category</th><th>Amount Owed</th><th>Status</th><th>Receipt / Action</th></tr>
            </thead>
            <tbody>
              <?php if ( ! empty( $lfa_invoices ) ) : ?>
                <?php foreach ( $lfa_invoices as $inv ) :
                  $formatted_amount = number_format( $inv->amount_cents / 100, 2 );
                  $is_paid = ( $inv->status === 'paid' );
                ?>
                  <tr>
                    <td><strong><code><?php echo esc_html( $inv->invoice_number ); ?></code></strong></td>
                    <td><?php echo esc_html( $inv->notes ?: '2026/2027 Annual Dues' ); ?></td>
                    <td><?php echo esc_html( $membership_type ); ?> Membership</td>
                    <td><strong>$<?php echo esc_html( $formatted_amount ); ?> <?php echo esc_html( $inv->currency ); ?></strong></td>
                    <td>
                      <span class="small-pill soft" style="<?php echo $is_paid ? 'background:#dcfce7;color:#166534;' : 'background:#fee2e2;color:#991b1b;'; ?>">
                        <?php echo esc_html( ucfirst( $inv->status ) ); ?>
                      </span>
                    </td>
                    <td>
                      <?php if ( $is_paid ) : ?>
                        <a href="<?php echo esc_url( rest_url( 'lfa/v1/payments/receipt/' . $inv->id ) ); ?>" target="_blank" class="button-outline button-sm">View Receipt ↗</a>
                        <?php if ( !empty( $inv->provider_payment_id ) || ( isset( $inv->gateway_provider ) && $inv->gateway_provider === 'stripe' ) ) : ?>
                          <span class="small-pill" style="background:#e0f2fe;color:#0369a1;font-size:10px;margin-left:4px;font-weight:700;">TEST RECEIPT</span>
                        <?php endif; ?>
                      <?php elseif ( ( $paypal_ready || $stripe_ready ) && $invoice_val && $invoice_val['valid'] && (int)$inv->id === (int)$active_unpaid_inv->id ) : ?>
                        <span style="color:#2563eb;font-weight:600;font-size:12px;">Checkout Below ↓</span>
                      <?php else : ?>
                        <span class="help-text">Pending Policy / Gateway</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php elseif ( $couple_unconfigured ) : ?>
                <tr>
                  <td colspan="6" style="text-align:center;color:#666;padding:20px;">
                    <em>Couple Membership invoice pending administrator policy confirmation. No invoice issued yet.</em>
                  </td>
                </tr>
              <?php else : ?>
                <tr>
                  <td><code>LFA-INV-2026-000005</code></td>
                  <td>2026/2027 Annual Membership Dues</td>
                  <td><?php echo esc_html( $membership_type ); ?> Membership</td>
                  <td><strong>$100.00 USD</strong></td>
                  <td><span class="small-pill soft" style="background:#fee2e2;color:#991b1b;">Unpaid</span></td>
                  <td><span class="help-text">Gateway Pending</span></td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div style="margin-top:24px;padding-top:20px;border-top:1px solid #edf1f6;">
          <?php if ( $active_unpaid_inv ) : ?>
            <?php if ( ( $paypal_ready || $stripe_ready ) && $invoice_val && $invoice_val['valid'] ) : ?>
              <div style="background:#f8fafc;padding:24px;border-radius:10px;border:1px solid #e2e8f0;max-width:560px;">
                <div style="margin-bottom:16px;">
                  <strong style="font-size:16px;color:#0f172a;">Pay Membership Dues Online</strong>
                  <p class="help-text" style="margin:4px 0 0 0;font-size:13px;">
                    Invoice <strong>#<?php echo esc_html( $active_unpaid_inv->invoice_number ); ?></strong> &middot; Total: <strong>$<?php echo esc_html( number_format( $active_unpaid_inv->amount_cents / 100, 2 ) ); ?> USD</strong>
                  </p>
                </div>

                <?php if ( $stripe_ready ) : ?>
                  <div style="background:#fffbeb;border:1px solid #fde68a;border-left:4px solid #f59e0b;padding:12px 14px;border-radius:6px;margin-bottom:16px;font-size:12px;color:#92400e;">
                    <strong>STRIPE TEST MODE — NO REAL MONEY CHARGED</strong><br>
                    You are testing dues checkout in development. Click below to proceed to Stripe hosted test checkout.
                  </div>
                <?php endif; ?>

                <div id="lfa-checkout-msg" style="margin-bottom:14px;font-size:13px;" hidden></div>

                <?php if ( $stripe_ready ) : ?>
                  <div style="margin-bottom:12px;">
                    <button type="button" id="lfa-stripe-pay-btn"
                            class="button-dark"
                            style="width:100%;padding:14px 20px;font-size:15px;font-weight:700;display:flex;align-items:center;justify-content:center;gap:10px;background:#635bff;border-color:#635bff;color:#fff;cursor:pointer;border-radius:6px;"
                            data-invoice-id="<?php echo esc_attr( $active_unpaid_inv->id ); ?>"
                            data-amount="<?php echo esc_attr( number_format( $active_unpaid_inv->amount_cents / 100, 2 ) ); ?>">
                      <svg width="18" height="18" viewBox="0 0 40 40" fill="none" style="vertical-align:middle;"><path d="M16.5 17.5c0-1.8 1.4-2.4 3.7-2.4 3.3 0 7.5 1.1 10.8 2.8V7.3c-3.6-1.5-7.3-2.1-10.8-2.1C11.1 5.2 5 9.8 5 18c0 12.8 17.5 10.7 17.5 16.3 0 2.2-1.9 2.9-4.5 2.9-3.9 0-8.9-1.6-12.7-3.8v10.8c4.3 1.9 8.7 2.6 12.7 2.6C27.3 46.8 34 42.4 34 33.7c0-13.6-17.5-11.2-17.5-16.2z" fill="#fff"/></svg>
                      Pay $<?php echo esc_html( number_format( $active_unpaid_inv->amount_cents / 100, 2 ) ); ?> USD with Stripe Test Checkout &rarr;
                    </button>
                  </div>
                <?php endif; ?>

                <?php if ( $paypal_ready && !empty( $paypal_client_id ) ) : ?>
                  <div style="<?php echo $stripe_ready ? 'margin-top:16px;padding-top:16px;border-top:1px dashed #cbd5e1;' : ''; ?>">
                    <?php if ( $stripe_ready ) : ?>
                      <div style="font-size:12px;color:#64748b;font-weight:600;margin-bottom:8px;text-align:center;">&mdash; OR PAY VIA PAYPAL SANDBOX &mdash;</div>
                    <?php endif; ?>
                    <div id="lfa-paypal-msg" style="margin-bottom:12px;font-size:13px;" hidden></div>
                    <div id="lfa-paypal-button-container"
                         data-invoice-id="<?php echo esc_attr( $active_unpaid_inv->id ); ?>"
                         data-amount="<?php echo esc_attr( number_format( $active_unpaid_inv->amount_cents / 100, 2 ) ); ?>">
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            <?php elseif ( ! $paypal_ready && ! $stripe_ready ) : ?>
              <div class="notice-block" style="background:#f1f5f9;border-left:4px solid #64748b;color:#334155;">
                <strong>Gateway Notice:</strong> Online payment checkout is currently undergoing administrator setup. Dues payment will be available once a payment gateway is enabled.
              </div>
            <?php elseif ( $invoice_val && ! $invoice_val['valid'] ) : ?>
              <div class="notice-block" style="background:#fef3c7;border-left:4px solid #f59e0b;color:#92400e;">
                <strong>Policy Notice:</strong> <?php echo esc_html( $invoice_val['error'] ); ?>
              </div>
            <?php endif; ?>
          <?php elseif ( ! empty( $lfa_invoices ) ) : ?>
            <div style="background:#f0fdf4;padding:16px;border-radius:8px;border:1px solid #bbf7d0;color:#166534;">
              <strong>All Dues Paid:</strong> You have no outstanding invoices. Your membership is in Good Standing.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- View 6: 2027 Conference -->
    <section class="view" id="conference" data-view="conference" hidden>
      <div class="sub-intro">
        <span class="overline">ALUMNI GATHERINGS</span>
        <h1>2027 Conference</h1>
        <p>Official biennial gathering of The Love Family Alumni &mdash; North America Zone.</p>
      </div>

      <div class="conference-feature" style="margin-bottom:28px;">
        <div class="conference-eyebrow">2027 LOVE FAMILY ALUMNI BIENNIAL CONFERENCE</div>
        <h2>“Thy Kingdom Come”</h2>
        <p style="font-weight: 700; color: #C6933D; letter-spacing: 0.05em;">Matthew 6:10</p>
        <div class="event-facts" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
          <div><small>CONFERENCE DATE</small><strong>September 16&ndash;19, 2027</strong></div>
          <div><small>CONFIRMED KEYNOTE</small><strong>Dr. Uche Igbokwe (U.K.)</strong></div>
          <div><small>HOST REGION</small><strong>North America Zone</strong></div>
          <div><small>LOCATION</small><strong>Host City TBA</strong></div>
        </div>
      </div>

      <?php
      $my_conf_regs = [];
      if ( class_exists( 'LFA_Conference' ) && $uid > 0 ) {
          global $wpdb;
          $t_creg = LFA_Conference::table_registrations();
          $t_cinv = LFA_Conference::table_invoices();
          $my_conf_regs = $wpdb->get_results( $wpdb->prepare(
              "SELECT r.*, i.id as invoice_id, i.invoice_number, i.status as invoice_status, i.amount_cents as invoice_amount_cents
               FROM {$t_creg} r
               LEFT JOIN {$t_cinv} i ON r.id = i.registration_id
               WHERE r.owner_user_id = %d
               ORDER BY r.id DESC",
              $uid
          ) );
      }
      $conf_obj = class_exists( 'LFA_Conference' ) ? LFA_Conference::get_conference() : null;
      $conf_open = $conf_obj && $conf_obj->registration_status === 'open';
      ?>

      <div class="content-panel">
        <div class="form-heading" style="display:flex;justify-content:space-between;align-items:center;">
          <h2>My Conference Registrations</h2>
          <?php if ( ! empty( $my_conf_regs ) ) : ?>
            <span class="small-pill soft" style="background:#e0f2fe;color:#0369a1;font-weight:700;">
              <?php echo count( $my_conf_regs ); ?> Active Record<?php echo count( $my_conf_regs ) > 1 ? 's' : ''; ?>
            </span>
          <?php endif; ?>
        </div>

        <?php if ( ! empty( $my_conf_regs ) ) : ?>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Registration No</th>
                  <th>Category</th>
                  <th>Fee Snapshot</th>
                  <th>Invoice No</th>
                  <th>Status</th>
                  <th>Receipt / Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( $my_conf_regs as $cr ) :
                  $cr_amount = number_format( $cr->amount_cents_snapshot / 100, 2 );
                  $is_conf_paid = ( $cr->status === 'confirmed' || ( isset($cr->invoice_status) && $cr->invoice_status === 'paid' ) );
                  $display_conf_status = $is_conf_paid ? 'confirmed' : $cr->status;
                ?>
                  <tr>
                    <td><strong><code><?php echo esc_html( $cr->registration_number ); ?></code></strong></td>
                    <td><?php echo esc_html( $cr->ticket_name_snapshot ); ?></td>
                    <td><strong>$<?php echo esc_html( $cr_amount ); ?> <?php echo esc_html( $cr->currency ); ?></strong></td>
                    <td><code><?php echo esc_html( $cr->invoice_number ?: 'N/A' ); ?></code></td>
                    <td>
                      <span class="small-pill soft" style="<?php echo $is_conf_paid ? 'background:#dcfce7;color:#166534;' : 'background:#fef3c7;color:#92400e;'; ?>font-weight:700;">
                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $display_conf_status ) ) ); ?>
                      </span>
                    </td>
                    <td>
                      <?php if ( $is_conf_paid ) : ?>
                        <a href="<?php echo esc_url( admin_url( 'admin-post.php?action=lfa_conference_receipt&id=' . $cr->id ) ); ?>" target="_blank" class="button-outline button-sm">Official Receipt ↗</a>
                        <?php if ( !empty( $cr->provider_payment_id ) || ( isset( $cr->gateway_provider ) && $cr->gateway_provider === 'stripe' ) ) : ?>
                          <span class="small-pill" style="background:#e0f2fe;color:#0369a1;font-size:10px;margin-left:4px;font-weight:700;">TEST PASS</span>
                        <?php endif; ?>
                      <?php elseif ( $stripe_ready || $paypal_ready ) : ?>
                        <button type="button" class="button-dark button-sm lfa-conf-checkout-btn"
                                data-invoice-id="<?php echo esc_attr( $cr->invoice_id ?? $cr->id ); ?>"
                                data-reg-id="<?php echo esc_attr( $cr->id ); ?>"
                                data-amount="<?php echo esc_attr( $cr_amount ); ?>"
                                style="background:#0f2942;">
                          Pay Online ($<?php echo esc_html( $cr_amount ); ?>) &rarr;
                        </button>
                      <?php else : ?>
                        <span class="help-text">Pending Gateway</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else : ?>
          <div style="text-align:center;padding:32px 20px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
            <p style="font-size:15px;color:#334155;margin:0 0 14px 0;">You do not have any registered passes for the 2027 Conference yet.</p>
            <?php if ( $conf_open ) : ?>
              <a href="<?php echo esc_url( home_url( '/conference/2027/#conference-registration' ) ); ?>" class="button-dark" style="display:inline-block;">Register for Conference &rarr;</a>
            <?php else : ?>
              <span class="small-pill soft" style="background:#f1f5f9;color:#64748b;font-weight:600;">Registration Opening Soon &mdash; Sept 16&ndash;19, 2027</span>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- View 7: My Businesses -->
    <section class="view" id="businesses" data-view="businesses" hidden>
      <div class="sub-intro">
        <span class="overline">ALUMNI ENTREPRENEURS &amp; VENTURES</span>
        <h1>My Businesses</h1>
        <p>Register and manage your alumni-owned businesses in the official North America Zone directory.</p>
      </div>

      <div class="content-panel">
        <?php if ( ! $is_full_member ) : ?>
          <div style="background:#fef2f2;border:1px solid #fecaca;border-left:4px solid #dc2626;border-radius:8px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;align-items:center;gap:12px;">
              <span style="font-size:24px;">🔒</span>
              <div>
                <h3 style="margin:0 0 4px 0;font-size:15px;color:#991b1b;font-weight:700;">Business Directory Submission Locked</h3>
                <p style="margin:0;font-size:13px;color:#7f1d1d;">Registering alumni businesses requires an approved account in good standing with settled annual membership dues ($100.00 USD).</p>
              </div>
            </div>
            <button type="button" class="button-dark button-sm" data-go="dues" style="background:#991b1b;border-color:#991b1b;">Pay Annual Dues &rarr;</button>
          </div>
        <?php endif; ?>

        <div class="form-heading" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
          <div>
            <h2>Registered Business Listings</h2>
            <p style="margin:2px 0 0 0;font-size:13px;color:#64748b;">All submissions are reviewed by alumni directory moderators before going public.</p>
          </div>
          <?php if ( $is_full_member ) : ?>
            <button type="button" class="button-dark" onclick="openNewBizModal()">+ Register New Business</button>
          <?php else : ?>
            <button type="button" class="button-dark" style="opacity:0.6;cursor:not-allowed;" title="Requires active paid membership dues" onclick="alert('Business registration is restricted to paid members in good standing. Please complete your annual membership dues.')">🔒 Register New Business (Locked)</button>
          <?php endif; ?>
        </div>

        <?php if ( ! empty( $my_businesses ) ) : ?>
          <div style="margin-top:20px;display:flex;flex-direction:column;gap:16px;">
            <?php foreach ( $my_businesses as $mb ) :
              $social_data = json_decode($mb->social_links_json ?? '{}', true);
              $badge_bg = match($mb->status) {
                'approved'       => 'background:#dcfce7;color:#166534;',
                'pending_review' => 'background:#fef3c7;color:#92400e;',
                'rejected'       => 'background:#fee2e2;color:#991b1b;',
                'archived'       => 'background:#f1f5f9;color:#64748b;',
                default          => 'background:#e2e8f0;color:#334155;',
              };
              $logo_url = !empty($mb->logo_file) ? LFA_Business::get_logo_url((int)$mb->id) : '';
            ?>
              <div style="border:1px solid #e2e8f0;border-radius:10px;padding:20px;background:#fff;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;margin-bottom:12px;">
                  <div style="display:flex;align-items:center;gap:14px;">
                    <?php if ($logo_url) : ?>
                      <img src="<?php echo esc_url($logo_url); ?>" alt="Logo" style="width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                    <?php else : ?>
                      <div style="width:48px;height:48px;border-radius:6px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-weight:700;color:#0F2942;border:1px solid #e2e8f0;">
                        <?php echo esc_html(strtoupper(substr($mb->name, 0, 1))); ?>
                      </div>
                    <?php endif; ?>
                    <div>
                      <h3 style="margin:0 0 4px 0;font-size:17px;color:#0F2942;font-weight:700;">
                        <?php echo esc_html($mb->name); ?>
                      </h3>
                      <span style="font-size:12px;color:#64748b;">
                        <code><?php echo esc_html($mb->business_ref); ?></code> &middot; <?php echo esc_html($mb->category); ?> &middot; <?php echo esc_html($mb->city . ', ' . $mb->country); ?>
                      </span>
                    </div>
                  </div>

                  <div style="display:flex;align-items:center;gap:8px;">
                    <span class="small-pill soft" style="<?php echo $badge_bg; ?>font-weight:700;">
                      <?php echo esc_html(ucwords(str_replace('_', ' ', $mb->status))); ?>
                    </span>
                    <span class="small-pill soft" style="background:#f1f5f9;color:#475569;">v<?php echo esc_html($mb->revision_version); ?></span>
                  </div>
                </div>

                <p style="margin:0 0 14px 0;font-size:14px;color:#475569;line-height:1.5;">
                  <?php echo esc_html($mb->description); ?>
                </p>

                <?php if ($mb->status === 'rejected' && !empty($mb->moderation_notes)) : ?>
                  <div style="margin-bottom:14px;padding:12px 16px;background:#fef2f2;border-left:4px solid #ef4444;border-radius:4px;">
                    <strong style="color:#991b1b;font-size:13px;display:block;margin-bottom:2px;">Moderator Rejection Feedback:</strong>
                    <span style="color:#7f1d1d;font-size:13px;line-height:1.4;"><?php echo esc_html($mb->moderation_notes); ?></span>
                  </div>
                <?php endif; ?>

                <?php if (!empty($mb->pending_changes_json)) : ?>
                  <div style="margin-bottom:14px;padding:10px 14px;background:#fffbeb;border-left:4px solid #f59e0b;border-radius:4px;font-size:13px;color:#92400e;">
                    <strong>Notice:</strong> Your recent edits have been submitted and are awaiting moderator review. The previously approved version remains active publicly.
                  </div>
                <?php endif; ?>

                <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;padding-top:12px;border-top:1px solid #f1f5f9;font-size:13px;">
                  <div style="color:#64748b;">
                    Contact Visibility: <strong><?php echo $mb->contact_consent ? '✓ Public Consent Granted' : 'Hidden'; ?></strong>
                    <?php if (!empty($mb->website_url)) : ?>
                      &middot; <a href="<?php echo esc_url($mb->website_url); ?>" target="_blank" rel="noopener noreferrer" style="color:#1d4ed8;">Website ↗</a>
                    <?php endif; ?>
                  </div>

                  <div style="display:flex;gap:8px;">
                    <?php if (in_array($mb->status, ['draft', 'rejected'], true)) : ?>
                      <button type="button" class="button-outline button-sm" onclick="submitBizForReview(<?php echo (int)$mb->id; ?>)">Submit for Review &rarr;</button>
                    <?php endif; ?>

                    <?php if (in_array($mb->status, ['pending_review', 'approved'], true)) : ?>
                      <button type="button" class="button-outline button-sm" onclick="withdrawBiz(<?php echo (int)$mb->id; ?>)">Withdraw</button>
                    <?php endif; ?>

                    <button type="button" class="button-dark button-sm" onclick='editBiz(<?php echo json_encode($mb); ?>)'>Edit</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
          <div style="text-align:center;padding:48px 20px;background:#f8fafc;border-radius:8px;border:1px dashed #cbd5e1;margin-top:20px;">
            <div style="font-size:40px;margin-bottom:12px;" aria-hidden="true">💼</div>
            <h3 style="font-size:18px;color:#0F2942;margin:0 0 6px 0;">No Business Listings Registered Yet</h3>
            <p style="font-size:14px;color:#64748b;max-width:500px;margin:0 auto 18px auto;line-height:1.5;">
              As a verified Love Family Alumnus, you can showcase your business, services, or consultancy to fellow alumni across North America.
            </p>
            <button type="button" class="button-dark" onclick="openNewBizModal()">+ Register Your Business</button>
          </div>
        <?php endif; ?>
      </div>

      <!-- Business Submission / Edit Modal -->
      <div id="lfa-member-biz-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.7);z-index:999999;align-items:center;justify-content:center;padding:20px;" aria-modal="true" role="dialog">
        <div style="background:#fff;border-radius:12px;max-width:620px;width:100%;max-height:92vh;overflow-y:auto;padding:28px;position:relative;">
          <button type="button" onclick="closeBizModal()" style="position:absolute;top:16px;right:16px;border:none;background:none;font-size:24px;cursor:pointer;color:#64748b;">&times;</button>
          
          <h2 id="biz-form-title" style="margin:0 0 6px 0;font-size:20px;color:#0F2942;font-weight:700;">Register Alumni Business</h2>
          <p style="margin:0 0 20px 0;font-size:13px;color:#64748b;">Provide details for your business directory profile. All entries require administrative review.</p>

          <form id="lfa-member-biz-form" onsubmit="handleBizFormSubmit(event)">
            <input type="hidden" id="biz-form-id" value="">
            
            <div style="margin-bottom:14px;">
              <label for="biz-name" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Business Name *</label>
              <input type="text" id="biz-name" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="e.g. Apex Health Solutions">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
              <div>
                <label for="biz-category" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Category *</label>
                <select id="biz-category" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;">
                  <option value="">Select Category...</option>
                  <option value="Technology & IT">Technology & IT</option>
                  <option value="Healthcare & Wellness">Healthcare & Wellness</option>
                  <option value="Education & Training">Education & Training</option>
                  <option value="Real Estate & Construction">Real Estate & Construction</option>
                  <option value="Finance & Investment">Finance & Investment</option>
                  <option value="Consulting & Professional">Consulting & Professional</option>
                  <option value="Retail & E-commerce">Retail & E-commerce</option>
                  <option value="Travel & Hospitality">Travel & Hospitality</option>
                </select>
              </div>
              <div>
                <label for="biz-country" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Country *</label>
                <select id="biz-country" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;">
                  <option value="United States">United States</option>
                  <option value="Canada">Canada</option>
                </select>
              </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
              <div>
                <label for="biz-state" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">State / Province</label>
                <input type="text" id="biz-state" style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="e.g. GA, ON, TX">
              </div>
              <div>
                <label for="biz-city" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">City *</label>
                <input type="text" id="biz-city" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="e.g. Atlanta">
              </div>
            </div>

            <div style="margin-bottom:14px;">
              <label for="biz-desc" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Business Description *</label>
              <textarea id="biz-desc" rows="3" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="Describe your services, products, and mission..."></textarea>
            </div>

            <div style="margin-bottom:14px;">
              <label for="biz-website" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Website URL</label>
              <input type="url" id="biz-website" style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="https://example.com">
            </div>

            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:16px;margin-bottom:16px;">
              <span style="font-size:13px;font-weight:700;color:#0F2942;display:block;margin-bottom:8px;">Public Business Contact (Optional)</span>
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:10px;">
                <div>
                  <label for="biz-email" style="display:block;font-size:12px;color:#475569;margin-bottom:2px;">Public Company Email</label>
                  <input type="email" id="biz-email" style="width:100%;padding:6px 10px;border:1px solid #cbd5e1;border-radius:6px;font-size:13px;" placeholder="contact@example.com">
                </div>
                <div>
                  <label for="biz-phone" style="display:block;font-size:12px;color:#475569;margin-bottom:2px;">Public Company Phone</label>
                  <input type="tel" id="biz-phone" style="width:100%;padding:6px 10px;border:1px solid #cbd5e1;border-radius:6px;font-size:13px;" placeholder="+1 (555) 000-0000">
                </div>
              </div>
              <label style="display:flex;align-items:flex-start;gap:8px;font-size:12px;color:#334155;cursor:pointer;">
                <input type="checkbox" id="biz-consent" value="1" style="margin-top:2px;">
                <span>I explicitly consent to publishing this company contact email and phone number in the public alumni directory.</span>
              </label>
            </div>

            <div style="margin-bottom:16px;">
              <label for="biz-logo" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Business Logo (JPG, PNG, WebP &middot; Max 3MB)</label>
              <input type="file" id="biz-logo" accept="image/jpeg,image/png,image/webp" style="font-size:13px;">
            </div>

            <div id="biz-form-msg" style="display:none;padding:10px;border-radius:6px;font-size:13px;margin-bottom:14px;"></div>

            <div style="display:flex;justify-content:flex-end;gap:10px;">
              <button type="button" class="button-outline" onclick="closeBizModal()">Cancel</button>
              <button type="submit" class="button-dark" id="biz-form-submit-btn">Save Business Listing</button>
            </div>
          </form>
        </div>
      </div>

      <script>
      var restNonce = '<?php echo esc_js( wp_create_nonce( 'wp_rest' ) ); ?>';

      function openNewBizModal() {
        document.getElementById('biz-form-id').value = '';
        document.getElementById('biz-form-title').innerText = 'Register Alumni Business';
        document.getElementById('biz-name').value = '';
        document.getElementById('biz-category').value = '';
        document.getElementById('biz-country').value = 'United States';
        document.getElementById('biz-state').value = '';
        document.getElementById('biz-city').value = '';
        document.getElementById('biz-desc').value = '';
        document.getElementById('biz-website').value = '';
        document.getElementById('biz-email').value = '';
        document.getElementById('biz-phone').value = '';
        document.getElementById('biz-consent').checked = false;
        document.getElementById('biz-form-msg').style.display = 'none';
        document.getElementById('lfa-member-biz-modal').style.display = 'flex';
      }

      function editBiz(biz) {
        document.getElementById('biz-form-id').value = biz.id;
        document.getElementById('biz-form-title').innerText = 'Edit Business: ' + biz.name;
        document.getElementById('biz-name').value = biz.name || '';
        document.getElementById('biz-category').value = biz.category || '';
        document.getElementById('biz-country').value = biz.country || 'United States';
        document.getElementById('biz-state').value = biz.state || '';
        document.getElementById('biz-city').value = biz.city || '';
        document.getElementById('biz-desc').value = biz.description || '';
        document.getElementById('biz-website').value = biz.website_url || '';
        document.getElementById('biz-email').value = biz.public_email || '';
        document.getElementById('biz-phone').value = biz.public_phone || '';
        document.getElementById('biz-consent').checked = (parseInt(biz.contact_consent) === 1);
        document.getElementById('biz-form-msg').style.display = 'none';
        document.getElementById('lfa-member-biz-modal').style.display = 'flex';
      }

      function closeBizModal() {
        document.getElementById('lfa-member-biz-modal').style.display = 'none';
      }

      function handleBizFormSubmit(e) {
        e.preventDefault();
        var id = document.getElementById('biz-form-id').value;
        var btn = document.getElementById('biz-form-submit-btn');
        var msg = document.getElementById('biz-form-msg');
        btn.disabled = true;

        var payload = {
          name: document.getElementById('biz-name').value,
          category: document.getElementById('biz-category').value,
          country: document.getElementById('biz-country').value,
          state: document.getElementById('biz-state').value,
          city: document.getElementById('biz-city').value,
          description: document.getElementById('biz-desc').value,
          website_url: document.getElementById('biz-website').value,
          public_email: document.getElementById('biz-email').value,
          public_phone: document.getElementById('biz-phone').value,
          contact_consent: document.getElementById('biz-consent').checked ? 1 : 0
        };

        var url = id ? '<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1/businesses/' ) ) ); ?>' + id : '<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1/businesses' ) ) ); ?>';

        fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': restNonce
          },
          body: JSON.stringify(payload)
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
          if (!data.success && !data.business_id) {
            throw new Error(data.error || data.message || 'Submission failed.');
          }
          var savedId = id || data.business_id;
          var logoInput = document.getElementById('biz-logo');

          if (logoInput && logoInput.files.length > 0) {
            var formData = new FormData();
            formData.append('logo', logoInput.files[0]);
            return fetch('<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1/businesses/' ) ) ); ?>' + savedId + '/logo', {
              method: 'POST',
              headers: { 'X-WP-Nonce': restNonce },
              body: formData
            });
          }
          return Promise.resolve();
        })
        .then(function() {
          msg.style.display = 'block';
          msg.style.background = '#dcfce7';
          msg.style.color = '#166534';
          msg.innerText = 'Listing saved successfully! Reloading...';
          setTimeout(function() { window.location.reload(); }, 1200);
        })
        .catch(function(err) {
          btn.disabled = false;
          msg.style.display = 'block';
          msg.style.background = '#fee2e2';
          msg.style.color = '#991b1b';
          msg.innerText = err.message;
        });
      }

      function showLfaToast(msg, isError) {
        var toast = document.getElementById('toast');
        if (!toast) return;
        toast.textContent = msg;
        toast.style.background = isError ? '#991B1B' : '#065F46';
        toast.style.color = '#fff';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '8px';
        toast.style.position = 'fixed';
        toast.style.bottom = '24px';
        toast.style.right = '24px';
        toast.style.zIndex = '99999';
        toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        toast.hidden = false;
        setTimeout(function() { toast.hidden = true; }, 4000);
      }

      function submitBizForReview(id) {
        if (!confirm('Submit this listing for administrator review?')) return;
        fetch('<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1/businesses/' ) ) ); ?>' + id + '/submit', {
          method: 'POST',
          headers: { 'X-WP-Nonce': restNonce }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
          if (!data.success) throw new Error(data.error || 'Submission failed.');
          showLfaToast('Listing submitted for review!', false);
          setTimeout(function() { window.location.reload(); }, 1200);
        })
        .catch(function(err) { showLfaToast(err.message, true); });
      }

      function withdrawBiz(id) {
        if (!confirm('Withdraw this listing from the directory?')) return;
        fetch('<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1/businesses/' ) ) ); ?>' + id + '/withdraw', {
          method: 'POST',
          headers: { 'X-WP-Nonce': restNonce }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
          if (!data.success) throw new Error(data.error || 'Withdraw failed.');
          showLfaToast('Listing withdrawn.', false);
          setTimeout(function() { window.location.reload(); }, 1200);
        })
        .catch(function(err) { showLfaToast(err.message, true); });
      }
      </script>
    </section>

    <!-- View: Scholarships -->
    <section class="view" id="scholarships" data-view="scholarships" hidden>
      <div class="sub-intro">
        <span class="overline">ACADEMIC &amp; STUDENT EMPOWERMENT</span>
        <h1>Akpo Family Scholarship</h1>
        <p>Apply for and monitor your educational support applications, academic records, and committee reviews.</p>
      </div>

      <!-- Program Overview Card -->
      <div class="content-panel" style="margin-bottom:24px;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:16px;">
          <div>
            <h2 style="margin:0 0 6px 0;font-size:20px;color:#0F2942;">The Akpo Family Scholarship</h2>
            <p style="margin:0;color:#64748b;font-size:14px;">Sponsored by The Akpo Family &middot; Love Family Alumni (North America Zone)</p>
          </div>
          <div>
            <?php 
            $akpo_prog = null;
            foreach ($all_programs as $p) {
              if ($p->slug === 'the-akpo-family-scholarship') { $akpo_prog = $p; break; }
            }
            if (!$akpo_prog && !empty($all_programs)) { $akpo_prog = $all_programs[0]; }
            $is_open = $akpo_prog && class_exists('LFA_Scholarship') && LFA_Scholarship::is_application_open($akpo_prog);
            ?>
            <span class="small-pill" style="<?php echo $is_open ? 'background:#e6f4ea;color:#137333;font-weight:700;' : 'background:#fee2e2;color:#991b1b;font-weight:700;'; ?>">
              <?php echo $is_open ? 'APPLICATION WINDOW OPEN' : 'APPLICATIONS CLOSED'; ?>
            </span>
          </div>
        </div>

        <div style="margin-top:16px;padding:14px 18px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;font-size:13px;color:#475569;line-height:1.6;">
          <?php if ($is_open) : ?>
            <p style="margin:0 0 6px 0;font-weight:600;color:#15803d;">The application window is currently active. You may submit your complete application and supporting documents below.</p>
            <p style="margin:0;">Window: <strong><?php echo esc_html($akpo_prog->application_window_start); ?></strong> to <strong><?php echo esc_html($akpo_prog->application_window_end); ?></strong> (<?php echo esc_html($akpo_prog->timezone); ?>)</p>
          <?php else : ?>
            <p style="margin:0 0 6px 0;font-weight:600;color:#0F2942;">Applications are currently closed.</p>
            <p style="margin:0;">Eligibility criteria, award values, deadlines, and cycle dates are established exclusively by the Scholarship Committee. In accordance with policy, submissions remain closed until officially authorized and scheduled. You may prepare and save a draft application in the meantime.</p>
          <?php endif; ?>
        </div>

        <?php if ( ! $is_full_member ) : ?>
          <div style="margin-top:16px;background:#fef2f2;border:1px solid #fecaca;border-left:4px solid #dc2626;border-radius:8px;padding:14px 18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;align-items:center;gap:10px;">
              <span style="font-size:20px;">🔒</span>
              <span style="font-size:13px;color:#7f1d1d;font-weight:600;">Scholarship applications require an approved alumni account in good standing with settled annual membership dues ($100.00 USD).</span>
            </div>
            <button type="button" class="button-dark button-sm" data-go="dues" style="background:#991b1b;border-color:#991b1b;padding:4px 12px;font-size:12px;">Pay Dues &rarr;</button>
          </div>
        <?php endif; ?>

        <div style="margin-top:18px;display:flex;justify-content:flex-end;gap:10px;">
          <?php if ( $is_full_member ) : ?>
            <button type="button" class="button-dark" onclick="openNewScholarshipModal()">+ Start Scholarship Application</button>
          <?php else : ?>
            <button type="button" class="button-dark" style="opacity:0.6;cursor:not-allowed;" title="Requires active paid membership dues" onclick="alert('Scholarship applications are restricted to verified members in good standing. Please complete your annual membership dues.')">🔒 Start Scholarship Application (Locked)</button>
          <?php endif; ?>
        </div>
      </div>

      <!-- User Applications List -->
      <div class="content-panel">
        <div class="panel-heading" style="padding-bottom:12px;border-bottom:1px solid #f1f5f9;margin-bottom:16px;">
          <div>
            <div class="section-kicker">MY RECORDS</div>
            <h2 style="font-size:18px;margin:0;">Your Scholarship Applications</h2>
          </div>
          <span class="section-note"><?php echo count($my_scholarships); ?> Application(s) on file</span>
        </div>

        <?php if (!empty($my_scholarships)) : ?>
          <div style="display:flex;flex-direction:column;gap:16px;">
            <?php foreach ($my_scholarships as $app) : 
              $docs = class_exists('LFA_Scholarship') ? LFA_Scholarship::get_application_documents((int)$app->id) : [];
              $status_bg = match($app->status) {
                'submitted' => '#e0f2fe;color:#0369a1',
                'under_review' => '#f3e8ff;color:#7e22ce',
                'additional_info_requested' => '#fef3c7;color:#b45309',
                'shortlisted' => '#ccfbf1;color:#0f766e',
                'awarded' => '#dcfce7;color:#15803d',
                'declined' => '#fee2e2;color:#b91c1c',
                default => '#f1f5f9;color:#475569',
              };
            ?>
              <div style="border:1px solid #e2e8f0;border-radius:10px;padding:20px;background:#fff;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;margin-bottom:14px;">
                  <div>
                    <span style="font-family:monospace;font-size:13px;font-weight:700;color:#0F2942;background:#f1f5f9;padding:3px 8px;border-radius:4px;">
                      <?php echo esc_html($app->application_ref); ?>
                    </span>
                    <h3 style="margin:8px 0 2px 0;font-size:17px;color:#0F2942;"><?php echo esc_html($app->program_title); ?></h3>
                    <div style="font-size:13px;color:#64748b;">
                      Academic Level: <strong><?php echo esc_html(ucfirst(str_replace('_', ' ', $app->academic_level ?: 'Not specified'))); ?></strong>
                      &middot; Institution: <strong><?php echo esc_html($app->school_name ?: 'Pending'); ?></strong>
                      &middot; Major: <strong><?php echo esc_html($app->program_of_study ?: 'Pending'); ?></strong>
                    </div>
                  </div>
                  <div>
                    <span class="small-pill" style="background:<?php echo $status_bg; ?>;font-weight:700;">
                      <?php echo esc_html(strtoupper(str_replace('_', ' ', $app->status))); ?>
                    </span>
                  </div>
                </div>

                <!-- Committee Feedback if info requested -->
                <?php if ($app->status === 'additional_info_requested' && !empty($app->applicant_feedback_notes)) : ?>
                  <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:14px;margin-bottom:14px;font-size:13px;">
                    <strong style="color:#b45309;display:block;margin-bottom:4px;">Action Required — Feedback from Scholarship Review Committee:</strong>
                    <p style="margin:0 0 10px 0;color:#78350f;"><?php echo esc_html($app->applicant_feedback_notes); ?></p>
                    <button type="button" class="button-dark button-sm" onclick="openRespondModal(<?php echo (int)$app->id; ?>, '<?php echo esc_js($app->application_ref); ?>')">
                      Submit Requested Information &rarr;
                    </button>
                  </div>
                <?php endif; ?>

                <!-- Documents attached -->
                <div style="margin-bottom:14px;">
                  <span style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Supporting Documents (Secure Storage):</span>
                  <?php if (!empty($docs)) : ?>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                      <?php foreach ($docs as $d) : 
                        $dl_url = admin_url('admin-post.php?action=lfa_download_scholarship_doc&doc_ref=' . urlencode($d->document_ref));
                      ?>
                        <span style="display:inline-flex;align-items:center;gap:6px;background:#f8fafc;border:1px solid #cbd5e1;border-radius:6px;padding:4px 10px;font-size:12px;">
                          <span>📄</span>
                          <a href="<?php echo esc_url($dl_url); ?>" style="color:#1d4ed8;font-weight:600;text-decoration:none;" target="_blank"><?php echo esc_html($d->display_filename); ?></a>
                          <span style="color:#94a3b8;font-size:11px;">(<?php echo round($d->file_size / 1024); ?> KB)</span>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  <?php else : ?>
                    <span style="font-size:13px;color:#94a3b8;font-style:italic;">No documents attached yet.</span>
                  <?php endif; ?>
                </div>

                <!-- Action Controls -->
                <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;padding-top:12px;border-top:1px solid #f1f5f9;font-size:13px;">
                  <div style="color:#64748b;">
                    Created: <?php echo esc_html(date_i18n('M j, Y', strtotime($app->created_at))); ?>
                    <?php if ($app->submitted_at) : ?>
                      &middot; Submitted: <?php echo esc_html(date_i18n('M j, Y', strtotime($app->submitted_at))); ?>
                    <?php endif; ?>
                  </div>

                  <div style="display:flex;gap:8px;">
                    <button type="button" class="button-outline button-sm" onclick="openUploadDocModal(<?php echo (int)$app->id; ?>, '<?php echo esc_js($app->application_ref); ?>')">+ Attach Document</button>

                    <?php if ($app->status === 'draft') : ?>
                      <button type="button" class="button-outline button-sm" onclick='editScholarshipDraft(<?php echo json_encode($app); ?>)'>Edit Draft</button>
                      <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display:inline;" onsubmit="return confirm('Submit this application for committee review?');">
                        <input type="hidden" name="action" value="lfa_member_submit_scholarship">
                        <input type="hidden" name="application_id" value="<?php echo (int)$app->id; ?>">
                        <input type="hidden" name="program_id" value="<?php echo (int)$app->program_id; ?>">
                        <input type="hidden" name="applicant_name" value="<?php echo esc_attr($app->applicant_name); ?>">
                        <input type="hidden" name="applicant_email" value="<?php echo esc_attr($app->applicant_email); ?>">
                        <input type="hidden" name="school_name" value="<?php echo esc_attr($app->school_name); ?>">
                        <input type="hidden" name="program_of_study" value="<?php echo esc_attr($app->program_of_study); ?>">
                        <input type="hidden" name="academic_level" value="<?php echo esc_attr($app->academic_level); ?>">
                        <input type="hidden" name="personal_statement" value="<?php echo esc_attr($app->personal_statement); ?>">
                        <input type="hidden" name="idempotency_key" value="<?php echo esc_attr(wp_generate_uuid4()); ?>">
                        <?php wp_nonce_field('lfa_member_scholarship_action', 'lfa_scholarship_nonce'); ?>
                        <button type="submit" class="button-dark button-sm">Submit Application &rarr;</button>
                      </form>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
          <div style="text-align:center;padding:48px 20px;background:#f8fafc;border-radius:8px;border:1px dashed #cbd5e1;">
            <div style="font-size:40px;margin-bottom:12px;" aria-hidden="true">🎓</div>
            <h3 style="font-size:18px;color:#0F2942;margin:0 0 6px 0;">No Scholarship Applications Yet</h3>
            <p style="font-size:14px;color:#64748b;max-width:500px;margin:0 auto 18px auto;line-height:1.5;">
              Love Family Alumni provides scholarship and educational support to verified members and student alumni.
            </p>
            <button type="button" class="button-dark" onclick="openNewScholarshipModal()">+ Start Scholarship Application</button>
          </div>
        <?php endif; ?>
      </div>

      <!-- Application Draft Modal -->
      <div id="lfa-scholarship-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.7);z-index:999999;align-items:center;justify-content:center;padding:20px;" aria-modal="true" role="dialog">
        <div style="background:#fff;border-radius:12px;max-width:680px;width:100%;max-height:92vh;overflow-y:auto;padding:28px;position:relative;">
          <button type="button" onclick="closeScholarshipModal()" style="position:absolute;top:16px;right:16px;border:none;background:none;font-size:24px;cursor:pointer;color:#64748b;">&times;</button>
          
          <h2 id="sch-modal-title" style="margin:0 0 6px 0;font-size:20px;color:#0F2942;font-weight:700;">Scholarship Application</h2>
          <p style="margin:0 0 20px 0;font-size:13px;color:#64748b;">Complete your academic information and statement of purpose. You may save a draft at any time.</p>

          <form id="lfa-scholarship-form" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
            <input type="hidden" name="action" id="sch-form-action" value="lfa_member_save_scholarship_draft">
            <input type="hidden" name="application_id" id="sch-form-id" value="">
            <input type="hidden" name="program_id" id="sch-form-program-id" value="<?php echo !empty($akpo_prog) ? (int)$akpo_prog->id : 1; ?>">
            <input type="hidden" name="idempotency_key" value="<?php echo esc_attr(wp_generate_uuid4()); ?>">
            <?php wp_nonce_field('lfa_member_scholarship_action', 'lfa_scholarship_nonce'); ?>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
              <div>
                <label for="sch-applicant-name" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Full Legal Name *</label>
                <input type="text" name="applicant_name" id="sch-applicant-name" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" value="<?php echo esc_attr($display_name); ?>">
              </div>
              <div>
                <label for="sch-applicant-email" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Applicant Email *</label>
                <input type="email" name="applicant_email" id="sch-applicant-email" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" value="<?php echo esc_attr($user_email); ?>">
              </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
              <div>
                <label for="sch-school" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">School / Institution *</label>
                <input type="text" name="school_name" id="sch-school" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="e.g. University of Toronto">
              </div>
              <div>
                <label for="sch-major" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Program of Study / Major *</label>
                <input type="text" name="program_of_study" id="sch-major" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="e.g. Computer Science, Public Health">
              </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
              <div>
                <label for="sch-level" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Academic Level *</label>
                <select name="academic_level" id="sch-level" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;">
                  <option value="undergraduate">Undergraduate</option>
                  <option value="postgraduate">Postgraduate / Master's</option>
                  <option value="doctorate">Doctorate / PhD</option>
                  <option value="high_school_senior">High School Senior</option>
                  <option value="professional">Professional Degree</option>
                </select>
              </div>
              <div>
                <label for="sch-gpa" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Academic Standing / GPA</label>
                <input type="text" name="gpa_academic_details" id="sch-gpa" style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="e.g. 3.8 / 4.0 or First Class Honours">
              </div>
            </div>

            <div style="margin-bottom:14px;">
              <label for="sch-statement" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Personal Statement / Academic Purpose * (Min 50 characters)</label>
              <textarea name="personal_statement" id="sch-statement" rows="5" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="Describe your educational goals, academic achievements, alignment with Love Family values, and financial need..."></textarea>
            </div>

            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:14px;margin-bottom:16px;">
              <label for="sch-file" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Optional: Attach Transcript or Academic Record (PDF, JPG, PNG &middot; Max 5MB)</label>
              <input type="file" name="document_file" id="sch-file" accept="application/pdf,image/jpeg,image/png" style="font-size:13px;">
              <small style="display:block;margin-top:4px;color:#64748b;">Uploaded files are stored outside the public webroot and streamed only to authorized reviewers.</small>
            </div>

            <label style="display:flex;align-items:flex-start;gap:8px;font-size:12px;color:#334155;cursor:pointer;margin-bottom:18px;">
              <input type="checkbox" name="consent_agreed" value="1" required style="margin-top:2px;">
              <span>I certify that all information submitted is accurate and true. I understand documents will be securely reviewed by the Scholarship Committee in accordance with privacy policies.</span>
            </label>

            <div style="display:flex;justify-content:flex-end;gap:10px;">
              <button type="button" class="button-outline" onclick="closeScholarshipModal()">Cancel</button>
              <button type="submit" class="button-outline" onclick="document.getElementById('sch-form-action').value='lfa_member_save_scholarship_draft';">Save Draft</button>
              <button type="submit" class="button-dark" onclick="document.getElementById('sch-form-action').value='lfa_member_submit_scholarship';">Submit Application &rarr;</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Upload Document Modal -->
      <div id="lfa-doc-upload-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.7);z-index:999999;align-items:center;justify-content:center;padding:20px;" aria-modal="true" role="dialog">
        <div style="background:#fff;border-radius:12px;max-width:500px;width:100%;padding:24px;position:relative;">
          <button type="button" onclick="closeDocUploadModal()" style="position:absolute;top:16px;right:16px;border:none;background:none;font-size:24px;cursor:pointer;color:#64748b;">&times;</button>
          <h2 style="margin:0 0 6px 0;font-size:18px;color:#0F2942;">Upload Supporting Document</h2>
          <p id="doc-upload-subtitle" style="margin:0 0 16px 0;font-size:13px;color:#64748b;">Attach academic records or identity documents to your application.</p>

          <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
            <input type="hidden" name="action" value="lfa_member_upload_scholarship_doc">
            <input type="hidden" name="application_id" id="upload-doc-app-id" value="">
            <?php wp_nonce_field('lfa_member_scholarship_action', 'lfa_scholarship_nonce'); ?>

            <div style="margin-bottom:14px;">
              <label for="upload-doc-cat" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Document Category</label>
              <select name="document_category" id="upload-doc-cat" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;">
                <option value="transcript">Official / Unofficial Academic Transcript</option>
                <option value="enrollment_proof">Proof of Enrollment / Student ID</option>
                <option value="recommendation">Letter of Recommendation</option>
                <option value="financial_record">Financial Verification / Need Statement</option>
                <option value="supporting_doc">Other Supporting Document</option>
              </select>
            </div>

            <div style="margin-bottom:18px;">
              <label for="upload-doc-file" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Document File (PDF, JPG, PNG &middot; Max 5MB)</label>
              <input type="file" name="document_file" id="upload-doc-file" required accept="application/pdf,image/jpeg,image/png" style="font-size:13px;">
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;">
              <button type="button" class="button-outline" onclick="closeDocUploadModal()">Cancel</button>
              <button type="submit" class="button-dark">Upload to Secure Storage</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Committee Response Modal -->
      <div id="lfa-info-respond-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.7);z-index:999999;align-items:center;justify-content:center;padding:20px;" aria-modal="true" role="dialog">
        <div style="background:#fff;border-radius:12px;max-width:560px;width:100%;padding:24px;position:relative;">
          <button type="button" onclick="closeRespondModal()" style="position:absolute;top:16px;right:16px;border:none;background:none;font-size:24px;cursor:pointer;color:#64748b;">&times;</button>
          <h2 style="margin:0 0 6px 0;font-size:18px;color:#0F2942;">Submit Additional Information</h2>
          <p id="respond-subtitle" style="margin:0 0 16px 0;font-size:13px;color:#64748b;">Respond to the scholarship committee's feedback.</p>

          <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
            <input type="hidden" name="action" value="lfa_member_respond_info">
            <input type="hidden" name="application_id" id="respond-app-id" value="">
            <?php wp_nonce_field('lfa_member_scholarship_action', 'lfa_scholarship_nonce'); ?>

            <div style="margin-bottom:14px;">
              <label for="respond-text" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Your Response / Clarification *</label>
              <textarea name="applicant_response" id="respond-text" rows="4" required style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:6px;font-size:14px;" placeholder="Provide the details requested by the committee..."></textarea>
            </div>

            <div style="margin-bottom:18px;">
              <label for="respond-file" style="display:block;font-size:13px;font-weight:600;margin-bottom:4px;color:#334155;">Optional: Attach Document (PDF, JPG, PNG &middot; Max 5MB)</label>
              <input type="file" name="document_file" id="respond-file" accept="application/pdf,image/jpeg,image/png" style="font-size:13px;">
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;">
              <button type="button" class="button-outline" onclick="closeRespondModal()">Cancel</button>
              <button type="submit" class="button-dark">Submit to Committee &rarr;</button>
            </div>
          </form>
        </div>
      </div>

      <script>
      function openNewScholarshipModal() {
        document.getElementById('sch-form-id').value = '';
        document.getElementById('sch-modal-title').innerText = 'Start Scholarship Application';
        document.getElementById('sch-school').value = '';
        document.getElementById('sch-major').value = '';
        document.getElementById('sch-gpa').value = '';
        document.getElementById('sch-statement').value = '';
        document.getElementById('lfa-scholarship-modal').style.display = 'flex';
      }

      function editScholarshipDraft(app) {
        document.getElementById('sch-form-id').value = app.id;
        document.getElementById('sch-modal-title').innerText = 'Edit Draft: ' + app.application_ref;
        document.getElementById('sch-school').value = app.school_name || '';
        document.getElementById('sch-major').value = app.program_of_study || '';
        document.getElementById('sch-level').value = app.academic_level || 'undergraduate';
        document.getElementById('sch-gpa').value = app.gpa_academic_details || '';
        document.getElementById('sch-statement').value = app.personal_statement || '';
        document.getElementById('lfa-scholarship-modal').style.display = 'flex';
      }

      function closeScholarshipModal() {
        document.getElementById('lfa-scholarship-modal').style.display = 'none';
      }

      function openUploadDocModal(appId, ref) {
        document.getElementById('upload-doc-app-id').value = appId;
        document.getElementById('doc-upload-subtitle').innerText = 'Application ' + ref + ' (Secure Storage)';
        document.getElementById('lfa-doc-upload-modal').style.display = 'flex';
      }

      function closeDocUploadModal() {
        document.getElementById('lfa-doc-upload-modal').style.display = 'none';
      }

      function openRespondModal(appId, ref) {
        document.getElementById('respond-app-id').value = appId;
        document.getElementById('respond-subtitle').innerText = 'Application ' + ref;
        document.getElementById('lfa-info-respond-modal').style.display = 'flex';
      }

      function closeRespondModal() {
        document.getElementById('lfa-info-respond-modal').style.display = 'none';
      }
      </script>
    </section>

    <!-- View 8: Account Settings -->
    <section class="view" id="settings" data-view="settings" hidden>
      <div class="sub-intro">
        <span class="overline">YOUR PREFERENCES</span>
        <h1>Account settings</h1>
        <p>Manage your account settings, security session, and notifications.</p>
      </div>
      <div class="content-panel settings-panel">
        <h2>Session &amp; Security</h2>
        <div style="margin-bottom:20px;">
          <p>Signed in as: <strong><?php echo esc_html( $display_name ); ?></strong> (<?php echo esc_html( $user_email ); ?>)</p>
          <p>Alumni ID: <strong><?php echo esc_html( $alumni_id ); ?></strong></p>
          <a href="<?php echo esc_url( wp_logout_url( home_url( '/member-login/' ) ) ); ?>" class="button-dark" style="display:inline-block;margin-top:10px;">
            Sign Out of Member Portal
          </a>
        </div>
        <h2>Communication preferences</h2>
        <label class="setting-row">
          <div><strong>Community news</strong><p>News and alumni announcements</p></div>
          <input type="checkbox" checked aria-label="Community news notifications">
        </label>
        <label class="setting-row">
          <div><strong>Event updates</strong><p>Conference and reunion announcements</p></div>
          <input type="checkbox" checked aria-label="Event update notifications">
        </label>
        <label class="setting-row">
          <div><strong>Membership reminders</strong><p>Renewal and dues notices when connected</p></div>
          <input type="checkbox" checked aria-label="Membership reminders">
        </label>
      </div>
    </section>

    <!-- View: Member Notifications Center (Phase 10) -->
    <section class="view" id="notifications" data-view="notifications" hidden>
      <div class="sub-intro" style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:16px;">
        <div>
          <span class="overline">COMMUNICATION CENTER</span>
          <h1>Notifications</h1>
          <p>Important notices regarding your alumni standing, dues, conferences, and chapter updates.</p>
        </div>
        <?php if ( !empty( $my_notifications ) && $unread_notifications_count > 0 ) : ?>
          <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" style="margin:0;">
            <?php wp_nonce_field( 'lfa_notification_action', 'lfa_nonce' ); ?>
            <input type="hidden" name="action" value="lfa_mark_all_notifications_read">
            <button type="submit" class="button-outline" style="font-size:13px;padding:8px 14px;">Mark All as Read</button>
          </form>
        <?php endif; ?>
      </div>

      <div class="content-panel" style="padding:24px;">
        <?php if ( empty( $my_notifications ) ) : ?>
          <div style="text-align:center;padding:48px 20px;">
            <div style="font-size:36px;margin-bottom:12px;">🔔</div>
            <h3 style="margin:0 0 8px;font-size:1.1rem;color:#0A203A;">No Notifications Yet</h3>
            <p style="color:#64748B;font-size:14px;max-width:400px;margin:0 auto;">You are all caught up! Official updates and transaction notices will appear here.</p>
          </div>
        <?php else : ?>
          <div class="notifications-stream" style="display:flex;flex-direction:column;gap:14px;">
            <?php foreach ( $my_notifications as $notif ) : 
              $is_unread = empty($notif['is_read']);
            ?>
              <div class="notif-card" style="padding:16px 20px;border-radius:8px;border:1px solid <?php echo $is_unread ? '#C6933D' : '#E2E8F0'; ?>;background:<?php echo $is_unread ? 'rgba(198,147,61,0.04)' : '#FFFFFF'; ?>;display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;">
                <div style="flex:1;min-width:240px;">
                  <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                    <?php if ( $is_unread ) : ?>
                      <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#AB1640;" title="Unread"></span>
                    <?php endif; ?>
                    <strong style="font-size:15px;color:#0A203A;"><?php echo esc_html( $notif['title'] ); ?></strong>
                    <span style="font-size:12px;color:#94A3B8;"><?php echo esc_html( date('M j, Y g:ia', strtotime($notif['created_at'])) ); ?></span>
                  </div>
                  <div style="font-size:14px;color:#334155;line-height:1.5;">
                    <?php echo wp_kses_post( $notif['message'] ); ?>
                  </div>
                  <?php if ( !empty( $notif['action_url'] ) ) : ?>
                    <a href="<?php echo esc_url( $notif['action_url'] ); ?>" style="display:inline-block;margin-top:8px;font-size:13px;color:#AB1640;font-weight:600;text-decoration:none;">View Details &rarr;</a>
                  <?php endif; ?>
                </div>

                <?php if ( $is_unread ) : ?>
                  <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" style="margin:0;">
                    <?php wp_nonce_field( 'lfa_notification_action', 'lfa_nonce' ); ?>
                    <input type="hidden" name="action" value="lfa_mark_notification_read">
                    <input type="hidden" name="id" value="<?php echo (int) $notif['id']; ?>">
                    <button type="submit" class="button-outline" style="font-size:11px;padding:4px 10px;">Mark Read</button>
                  </form>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- View: Volunteer Opportunities (Phase 10) -->
    <section class="view" id="volunteers" data-view="volunteers" hidden>
      <div class="sub-intro">
        <span class="overline">SERVICE &amp; COMMUNITY ENGAGEMENT</span>
        <h1>Volunteer Opportunities</h1>
        <p>Give back to the Love Family alumni community through conference hospitality, archiving, and mentorship programs.</p>
      </div>

      <!-- My Applications -->
      <div class="content-panel" style="padding:24px;margin-bottom:30px;">
        <h2 style="font-size:1.15rem;margin:0 0 16px;color:#0A203A;">My Volunteer Applications</h2>
        <?php if ( empty( $my_volunteers ) ) : ?>
          <p style="color:#64748B;font-size:14px;margin:0;">You have not applied for any volunteer roles yet. Explore the open opportunities below to get involved!</p>
        <?php else : ?>
          <div style="overflow-x:auto;">
            <table class="data-table" style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="border-bottom:2px solid #E2E8F0;text-align:left;">
                  <th style="padding:10px;">Opportunity</th>
                  <th style="padding:10px;">Committee</th>
                  <th style="padding:10px;">Availability</th>
                  <th style="padding:10px;">Status</th>
                  <th style="padding:10px;">Date Applied</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( $my_volunteers as $v ) : 
                  $st_color = match($v['status']) {
                    'approved' => '#16A34A',
                    'shortlisted' => '#2563EB',
                    'declined' => '#DC2626',
                    'completed' => '#0A203A',
                    default => '#C6933D'
                  };
                ?>
                  <tr style="border-bottom:1px solid #E2E8F0;">
                    <td style="padding:12px 10px;"><strong><?php echo esc_html( $v['opp_title'] ); ?></strong></td>
                    <td style="padding:12px 10px;color:#64748B;"><?php echo esc_html( $v['opp_committee'] ); ?></td>
                    <td style="padding:12px 10px;"><?php echo esc_html( $v['availability'] ); ?></td>
                    <td style="padding:12px 10px;">
                      <span style="display:inline-block;padding:3px 9px;border-radius:12px;font-size:12px;font-weight:700;color:#fff;background:<?php echo esc_attr($st_color); ?>;">
                        <?php echo esc_html( ucfirst($v['status']) ); ?>
                      </span>
                    </td>
                    <td style="padding:12px 10px;color:#94A3B8;"><?php echo esc_html( date('M j, Y', strtotime($v['created_at'])) ); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>

      <!-- Available Opportunities -->
      <div class="content-panel" style="padding:24px;">
        <h2 style="font-size:1.15rem;margin:0 0 16px;color:#0A203A;">Open Volunteer Teams</h2>
        <?php if ( empty( $available_volunteers ) ) : ?>
          <p style="color:#64748B;font-size:14px;margin:0;">There are currently no open volunteer openings. Please check back before major conference periods.</p>
        <?php else : ?>
          <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(320px, 1fr));gap:20px;">
            <?php foreach ( $available_volunteers as $opp ) : 
              $has_applied = false;
              foreach ( $my_volunteers as $mv ) {
                if ( (int)$mv['opportunity_id'] === (int)$opp['id'] ) {
                  $has_applied = true;
                  break;
                }
              }
            ?>
              <div style="border:1px solid #E2E8F0;border-radius:10px;padding:20px;background:#F8FAFC;display:flex;flex-direction:column;justify-content:space-between;">
                <div>
                  <span style="font-size:11px;font-weight:700;letter-spacing:0.05em;color:#C6933D;text-transform:uppercase;"><?php echo esc_html( $opp['committee'] ?: 'North America Zone' ); ?></span>
                  <h3 style="font-size:1.05rem;margin:6px 0 10px;color:#0A203A;"><?php echo esc_html( $opp['title'] ); ?></h3>
                  <p style="font-size:13px;color:#475569;line-height:1.5;margin-bottom:14px;"><?php echo esc_html( $opp['purpose'] ); ?></p>
                  
                  <div style="font-size:12px;color:#64748B;margin-bottom:14px;display:flex;flex-direction:column;gap:4px;">
                    <div>📅 <strong>Timeframe:</strong> <?php echo esc_html( $opp['timeframe'] ); ?></div>
                    <div>📍 <strong>Location:</strong> <?php echo esc_html( ucfirst($opp['location_type']) . ($opp['location_details'] ? ' (' . $opp['location_details'] . ')' : '') ); ?></div>
                    <?php if ( !empty($opp['openings']) ) : ?>
                      <div>👥 <strong>Openings:</strong> <?php echo (int) $opp['openings']; ?> members</div>
                    <?php endif; ?>
                  </div>
                </div>

                <div>
                  <?php if ( $has_applied ) : ?>
                    <button type="button" class="button-outline" disabled style="width:100%;opacity:0.6;font-size:13px;">✓ Already Applied</button>
                  <?php else : ?>
                    <details style="background:#fff;border:1px solid #CBD5E1;border-radius:6px;padding:10px;">
                      <summary style="font-size:13px;font-weight:700;color:#0A203A;cursor:pointer;">Apply for this Team</summary>
                      <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" style="margin-top:12px;display:flex;flex-direction:column;gap:10px;">
                        <?php wp_nonce_field( 'lfa_apply_volunteer_action', 'lfa_nonce' ); ?>
                        <input type="hidden" name="action" value="lfa_apply_volunteer">
                        <input type="hidden" name="opportunity_id" value="<?php echo (int) $opp['id']; ?>">
                        
                        <div>
                          <label style="font-size:11px;font-weight:700;color:#475569;display:block;margin-bottom:4px;">Availability:</label>
                          <input type="text" name="availability" placeholder="e.g. Weekends, 4 hrs/week" required style="width:100%;font-size:13px;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;">
                        </div>

                        <div>
                          <label style="font-size:11px;font-weight:700;color:#475569;display:block;margin-bottom:4px;">Interests / Relevant Skills:</label>
                          <textarea name="interests" placeholder="Briefly describe your background or interest..." rows="2" style="width:100%;font-size:13px;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;"></textarea>
                        </div>

                        <label style="font-size:12px;color:#334155;display:flex;align-items:flex-start;gap:6px;cursor:pointer;">
                          <input type="checkbox" name="consent" required style="margin-top:2px;">
                          <span>I consent to share my contact details with the volunteer coordinator for this initiative.</span>
                        </label>

                        <button type="submit" class="button-dark" style="font-size:13px;padding:8px 12px;margin-top:4px;">Submit Volunteer Application</button>
                      </form>
                    </details>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  </main>
  <div class="toast" role="status" aria-live="polite" id="toast" hidden></div>
</div>
</div>

<style>
@keyframes lfa-spin { to { transform: rotate(360deg); } }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
  'use strict';

  var restNonce = '<?php echo esc_js( wp_create_nonce( 'wp_rest' ) ); ?>';
  var restBase  = '<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1' ) ) ); ?>'.replace(/\/+$/, '');

  // 1. Stripe Checkout for Membership Dues
  var stripeDuesBtn = document.getElementById('lfa-stripe-pay-btn');
  if (stripeDuesBtn) {
    stripeDuesBtn.addEventListener('click', function(e) {
      e.preventDefault();
      var invoiceId = stripeDuesBtn.getAttribute('data-invoice-id');
      var msgBox = document.getElementById('lfa-checkout-msg');
      stripeDuesBtn.disabled = true;
      stripeDuesBtn.textContent = 'Redirecting to Stripe Test Checkout...';

      if (msgBox) {
        msgBox.innerHTML = '<span style="color:#2563eb;font-weight:600;">Initiating secure Stripe Checkout Session...</span>';
        msgBox.hidden = false;
      }

      fetch(restBase + '/payments/create-session', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-WP-Nonce': restNonce
        },
        body: JSON.stringify({
          invoice_id: invoiceId,
          payable_type: 'membership_due',
          gateway: 'stripe'
        })
      })
      .then(function(res) { return res.json(); })
      .then(function(data) {
        var checkoutUrl = data.session_url || data.checkout_url;
        if (!data.success || !checkoutUrl) {
          throw new Error(data.message || 'Failed to initialize Stripe checkout.');
        }
        window.location.href = checkoutUrl;
      })
      .catch(function(err) {
        stripeDuesBtn.disabled = false;
        stripeDuesBtn.innerHTML = 'Pay with Stripe Test Checkout &rarr;';
        if (msgBox) {
          msgBox.innerHTML = '<span style="color:#dc2626;font-weight:600;">Error: ' + err.message + '</span>';
        }
      });
    });
  }

  // 2. Stripe Checkout for Conference Passes
  var confBtns = document.querySelectorAll('.lfa-conf-checkout-btn');
  confBtns.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var invoiceId = btn.getAttribute('data-invoice-id');
      var origText = btn.textContent;
      btn.disabled = true;
      btn.textContent = 'Connecting to Stripe...';

      fetch(restBase + '/payments/create-session', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-WP-Nonce': restNonce
        },
        body: JSON.stringify({
          invoice_id: invoiceId,
          payable_type: 'conference',
          gateway: 'stripe'
        })
      })
      .then(function(res) { return res.json(); })
      .then(function(data) {
        var checkoutUrl = data.session_url || data.checkout_url;
        if (!data.success || !checkoutUrl) {
          throw new Error(data.message || 'Failed to initialize conference checkout.');
        }
        window.location.href = checkoutUrl;
      })
      .catch(function(err) {
        btn.disabled = false;
        btn.textContent = origText;
        var existingErr = btn.parentElement.querySelector('.lfa-conf-inline-error');
        if (existingErr) existingErr.remove();
        btn.insertAdjacentHTML('afterend', '<span class="lfa-conf-inline-error" style="display:block;margin-top:6px;color:#dc2626;font-size:12px;font-weight:600;">' + (err.message || 'Payment initialization failed. Please retry.') + '</span>');
      });
    });
  });

  // 3. Automatic Reconcile on Return from Stripe
  var reconcileBanner = document.getElementById('lfa-reconcile-banner');
  if (reconcileBanner) {
    var sessionId = reconcileBanner.getAttribute('data-session-id');
    var statusEl = document.getElementById('lfa-reconcile-status');

    if (sessionId) {
      var isConfRoute = (window.location.hash.indexOf('conference') !== -1 || window.location.search.indexOf('conference') !== -1);
      fetch(restBase + '/payments/reconcile-session', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-WP-Nonce': restNonce
        },
        body: JSON.stringify({ 
          session_id: sessionId,
          payable_type: isConfRoute ? 'conference' : 'membership_due'
        })
      })
      .then(function(res) { return res.json(); })
      .then(function(data) {
        if (data.success || data.reconciled) {
          reconcileBanner.style.background = '#dcfce7';
          reconcileBanner.style.borderColor = '#16a34a';
          reconcileBanner.style.color = '#166534';
          var spin = reconcileBanner.querySelector('.lfa-reconcile-spinner');
          if (spin) spin.style.display = 'none';
          statusEl.innerHTML = '<strong>Payment Verified!</strong> ' + (data.message || 'Payment successfully reconciled with Stripe.') + ' Updating dashboard...';
          setTimeout(function() {
            var cleanUrl = window.location.pathname + window.location.hash;
            window.location.replace(cleanUrl);
          }, 1800);
        } else {
          reconcileBanner.style.background = '#fffbeb';
          reconcileBanner.style.borderColor = '#f59e0b';
          reconcileBanner.style.color = '#92400e';
          var spin = reconcileBanner.querySelector('.lfa-reconcile-spinner');
          if (spin) spin.style.display = 'none';
          statusEl.innerHTML = '<strong>Payment Status:</strong> ' + (data.message || 'Payment is awaiting provider confirmation.');
        }
      })
      .catch(function(err) {
        if (statusEl) {
          statusEl.innerHTML = '<strong>Notice:</strong> Payment confirmation in progress via background webhook.';
        }
      });
    }
  }
});
</script>

<?php if ( $paypal_ready && $invoice_val && $invoice_val['valid'] && !empty($paypal_client_id) ) : ?>
  <script src="https://www.paypal.com/sdk/js?client-id=<?php echo esc_attr( $paypal_client_id ); ?>&currency=USD&intent=capture&components=buttons"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var container = document.getElementById('lfa-paypal-button-container');
    if (!container || typeof paypal === 'undefined') return;

    var invoiceId = container.getAttribute('data-invoice-id');
    var restNonce = '<?php echo esc_js( wp_create_nonce( 'wp_rest' ) ); ?>';
    var restCreate = '<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1/payments/create-order' ) ) ); ?>';
    var restCapture = '<?php echo esc_js( esc_url_raw( rest_url( 'lfa/v1/payments/capture-order' ) ) ); ?>';

    paypal.Buttons({
      fundingSource: paypal.FUNDING.PAYPAL,
      style: {
        layout: 'vertical',
        color: 'gold',
        shape: 'rect',
        label: 'pay'
      },
      createOrder: function(data, actions) {
        return fetch(restCreate, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': restNonce
          },
          body: JSON.stringify({ invoice_id: invoiceId })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
          if (!data.success || !data.order_id) {
            throw new Error(data.message || 'Failed to create PayPal order.');
          }
          return data.order_id;
        });
      },
      onApprove: function(data, actions) {
        var msgBox = document.getElementById('lfa-paypal-msg');
        if (msgBox) {
          msgBox.innerHTML = '<span style="color:#2563eb;font-weight:600;">Verifying payment with server... Please wait.</span>';
          msgBox.hidden = false;
        }
        return fetch(restCapture, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': restNonce
          },
          body: JSON.stringify({ order_id: data.orderID, invoice_id: invoiceId })
        })
        .then(function(res) { return res.json(); })
        .then(function(res) {
          if (!res.success) {
            throw new Error(res.message || 'Payment capture could not be confirmed.');
          }
          if (msgBox) {
            msgBox.innerHTML = '<span style="color:#15803d;font-weight:700;">Payment Confirmed! Your membership is now Current.</span>';
          }
          setTimeout(function() { window.location.reload(); }, 1500);
        })
        .catch(function(err) {
          if (msgBox) {
            msgBox.innerHTML = '<span style="color:#dc2626;font-weight:600;">Error: ' + err.message + '</span>';
          }
        });
      },
      onCancel: function(data) {
        var msgBox = document.getElementById('lfa-paypal-msg');
        if (msgBox) {
          msgBox.innerHTML = '<span style="color:#64748b;">Payment was cancelled. Your invoice remains unpaid.</span>';
          msgBox.hidden = false;
        }
      },
      onError: function(err) {
        var msgBox = document.getElementById('lfa-paypal-msg');
        if (msgBox) {
          msgBox.innerHTML = '<span style="color:#dc2626;">Payment gateway error occurred. Please try again.</span>';
          msgBox.hidden = false;
        }
      }
    }).render('#lfa-paypal-button-container');
  });
  </script>
<?php endif; ?>
