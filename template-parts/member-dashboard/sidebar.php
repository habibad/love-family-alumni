<?php
/**
 * Member Dashboard — Sidebar Navigation Template Part
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$data     = $args['data'];
$views    = $args['views'];
$m        = $data['member'];
$logo_url = function_exists( 'lfa_image_url' ) ? lfa_image_url( 'brand-logo-source.jpg' ) : get_template_directory_uri() . '/assets/images/brand-logo-source.jpg';
?>
<aside class="lfa-dashboard__sidebar" id="lfa-dashboard-sidebar" aria-label="Member portal navigation">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lfa-dashboard__brand">
    <span class="lfa-dashboard__brand-icon" aria-hidden="true">
      <img src="<?php echo esc_url( $logo_url ); ?>" alt="Love Family Alumni Emblem" width="43" height="43">
    </span>
    <span><strong>LOVE FAMILY ALUMNI</strong><small>NORTH AMERICA ZONE</small></span>
  </a>
  <div class="lfa-dashboard__mini-profile">
    <div class="lfa-dashboard__profile-avatar" aria-hidden="true"><?php echo esc_html( $m['initials'] ); ?></div>
    <div><strong><?php echo esc_html( $m['name'] ); ?></strong><span><?php echo esc_html( $m['id'] ); ?></span></div>
    <span class="lfa-dashboard__mini-tag">DEMO</span>
  </div>
  <p class="lfa-dashboard__nav-heading">MY DASHBOARD</p>
  <nav class="lfa-dashboard__nav" aria-label="Member account sections">
  <?php foreach ( $views as $key => $view ) : ?>
    <a href="#<?php echo esc_attr( $key ); ?>" data-view-link="<?php echo esc_attr( $key ); ?>" class="lfa-dashboard__nav-item<?php echo $key === 'overview' ? ' is-active' : ''; ?>" <?php echo $key === 'overview' ? 'aria-current="page"' : ''; ?>>
      <span class="lfa-dashboard__nav-symbol" aria-hidden="true"><?php echo esc_html( [ 'overview' => '▦', 'alumni-id' => '▤', 'membership' => '◇', 'profile' => '♙', 'dues' => '▣', 'conference' => '▧', 'businesses' => '▥', 'settings' => '⚙' ][ $key ] ); ?></span>
      <span><?php echo esc_html( $view[0] ); ?></span><span class="lfa-dashboard__nav-chevron" aria-hidden="true">›</span>
    </a>
  <?php endforeach; ?>
  </nav>
  <div class="lfa-dashboard__sidebar-bottom">
    <div class="lfa-dashboard__sidebar-help"><span class="lfa-dashboard__help-icon" aria-hidden="true">?</span><strong>Need assistance?</strong><p>Reach out to the North America Zone team.</p><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact support →</a></div>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lfa-dashboard__return-link">← Back to website</a>
  </div>
</aside>
