<?php
/**
 * Member Dashboard — Master Layout Template Part
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$source = get_theme_file_path( 'inc/data/demo-member-dashboard.php' );
$data   = file_exists( $source ) ? require $source : [];
if ( ! $data ) {
	echo '<p>Dashboard demo data unavailable.</p>';
	return;
}

$views = [
	'overview'   => [ 'Overview', 'layout-dashboard' ],
	'alumni-id'  => [ 'Alumni ID', 'id-card' ],
	'membership' => [ 'Membership', 'shield-check' ],
	'profile'    => [ 'My Profile', 'user-round' ],
	'dues'       => [ 'Dues & Receipts', 'wallet' ],
	'conference' => [ '2027 Conference', 'calendar-days' ],
	'businesses' => [ 'My Businesses', 'briefcase-business' ],
	'settings'   => [ 'Account Settings', 'settings' ],
];
?>
<div class="lfa-dashboard" data-lfa-dashboard role="region" aria-label="Member Dashboard">
  <div class="lfa-dashboard__notice" role="note"><span class="lfa-dashboard__notice-dot"></span> MEMBER PORTAL DESIGN PREVIEW <span class="lfa-dashboard__notice-sub">Dummy data only · No login, payments or data saved</span></div>
  <div class="lfa-dashboard__layout">
    <?php get_template_part( 'template-parts/member-dashboard/sidebar', null, [ 'data' => $data, 'views' => $views ] ); ?>
    <div class="lfa-dashboard__main">
      <div class="lfa-dashboard__topbar">
        <div class="lfa-dashboard__topbar-left">
          <button class="lfa-dashboard__mobile-toggle" type="button" aria-label="Open dashboard navigation" aria-controls="lfa-dashboard-sidebar" aria-expanded="false" data-mobile-toggle>☰</button>
          <div><p class="lfa-dashboard__eyebrow" data-view-eyebrow>MEMBER AREA / OVERVIEW</p><p class="lfa-dashboard__topbar-title">Love Family Alumni <span class="lfa-dashboard__topbar-sep">/</span> Member Portal</p></div>
        </div>
        <div class="lfa-dashboard__topbar-right">
          <span class="lfa-dashboard__environment">● Demo environment</span>
          <span class="lfa-dashboard__top-avatar" aria-hidden="true"><?php echo esc_html( $data['member']['initials'] ); ?></span>
        </div>
      </div>
      <div class="lfa-dashboard__content">
        <?php get_template_part( 'template-parts/member-dashboard/overview', null, [ 'data' => $data ] ); ?>
        <?php get_template_part( 'template-parts/member-dashboard/sections', null, [ 'data' => $data ] ); ?>
      </div>
    </div>
  </div>
  <div class="lfa-dashboard__mobile-backdrop" data-mobile-backdrop hidden></div>
  <div class="lfa-dashboard__toast" role="status" aria-live="polite" data-toast hidden></div>
</div>
