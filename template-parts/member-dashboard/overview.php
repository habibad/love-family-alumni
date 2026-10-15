<?php
/**
 * Member Dashboard — Overview Section Template Part
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$data = $args['data'];
$m    = $data['member'];
?>
<section class="lfa-dashboard__view" id="overview" data-view-panel="overview" aria-labelledby="lfa-overview-heading">
  <div class="lfa-dashboard__welcome">
    <div class="lfa-dashboard__welcome-text">
      <span class="lfa-dashboard__gold-label">✦ YOUR ALUMNI COMMUNITY, ALL IN ONE PLACE</span>
      <h1 id="lfa-overview-heading">Welcome back,<br><em><?php echo esc_html( $m['first_name'] ); ?>.</em></h1>
      <p>Stay connected to your alumni family, explore upcoming opportunities, and keep your membership information in one place.</p>
      <div class="lfa-dashboard__welcome-actions"><button class="lfa-dashboard__btn lfa-dashboard__btn--coral" type="button" data-go="profile">View My Profile <span aria-hidden="true">→</span></button><a class="lfa-dashboard__link-light" href="<?php echo esc_url( home_url( '/events/' ) ); ?>">Explore Alumni Events ↗</a></div>
    </div>
    <div class="lfa-dashboard__welcome-art" aria-hidden="true"><span class="lfa-dashboard__welcome-arc arc-one"></span><span class="lfa-dashboard__welcome-arc arc-two"></span><div class="lfa-dashboard__seal"><div class="lfa-dashboard__seal-inner">LFA<span>TOGETHER WE RISE</span></div></div></div>
  </div>
  <div class="lfa-dashboard__section-header"><div><p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">AT A GLANCE</p><h2>Your Member Overview</h2></div><span class="lfa-dashboard__section-note">Illustrative member information</span></div>
  <div class="lfa-dashboard__stat-grid">
    <article class="lfa-dashboard__stat"><span class="lfa-dashboard__stat-icon">▤</span><span class="lfa-dashboard__stat-label">ALUMNI ID</span><strong><?php echo esc_html( $m['id'] ); ?></strong><span class="lfa-dashboard__stat-foot">Sample identifier</span></article>
    <article class="lfa-dashboard__stat"><span class="lfa-dashboard__stat-icon">◇</span><span class="lfa-dashboard__stat-label">MEMBERSHIP</span><strong>Individual</strong><span class="lfa-dashboard__stat-foot"><i class="lfa-dashboard__tiny-dot"></i> Active — Demo status</span></article>
    <article class="lfa-dashboard__stat"><span class="lfa-dashboard__stat-icon">▣</span><span class="lfa-dashboard__stat-label">MEMBERSHIP DUES</span><strong>Not connected</strong><span class="lfa-dashboard__stat-foot">Payment functionality later</span></article>
    <article class="lfa-dashboard__stat"><span class="lfa-dashboard__stat-icon">▧</span><span class="lfa-dashboard__stat-label">NEXT CONFERENCE</span><strong>2027</strong><span class="lfa-dashboard__stat-foot">Date & venue: TBA</span></article>
  </div>
  <div class="lfa-dashboard__two-col">
    <section class="lfa-dashboard__card lfa-dashboard__member-card">
      <div class="lfa-dashboard__card-heading"><div><p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">MEMBERSHIP</p><h3>My Membership Card</h3></div><button type="button" class="lfa-dashboard__text-action" data-go="alumni-id">View details →</button></div>
      <div class="lfa-dashboard__id-card"><div class="lfa-dashboard__id-card-head"><span>LOVE FAMILY ALUMNI <small>NORTH AMERICA ZONE</small></span><b>DEMO</b></div><div class="lfa-dashboard__id-card-middle"><span class="lfa-dashboard__id-avatar" aria-hidden="true"><?php echo esc_html( $m['initials'] ); ?></span><div><small>MEMBER NAME</small><strong><?php echo esc_html( $m['name'] ); ?></strong><small>MEMBER IDENTIFIER</small><strong><?php echo esc_html( $m['id'] ); ?></strong></div></div><div class="lfa-dashboard__id-card-foot"><span>ONE FAMILY. ACROSS BORDERS.</span><span>2027 · PREVIEW</span></div></div>
      <p class="lfa-dashboard__muted">Your official alumni card and unique ID will be issued after account verification and backend integration.</p>
    </section>
    <section class="lfa-dashboard__card lfa-dashboard__quick-card">
      <div class="lfa-dashboard__card-heading"><div><p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">SHORTCUTS</p><h3>Quick Actions</h3></div></div>
      <div class="lfa-dashboard__quick-grid">
        <button type="button" data-go="profile"><span class="lfa-dashboard__quick-icon">♙</span><strong>Edit Profile</strong><small>Personal information</small></button>
        <button type="button" data-go="dues"><span class="lfa-dashboard__quick-icon">▣</span><strong>Review Dues</strong><small>Demo payment records</small></button>
        <button type="button" data-go="conference"><span class="lfa-dashboard__quick-icon">▧</span><strong>2027 Conference</strong><small>Information & preview</small></button>
        <button type="button" data-go="businesses"><span class="lfa-dashboard__quick-icon">▥</span><strong>My Businesses</strong><small>Sample listings</small></button>
      </div>
    </section>
  </div>
  <div class="lfa-dashboard__two-col lfa-dashboard__two-col--bottom">
    <section class="lfa-dashboard__card"><div class="lfa-dashboard__card-heading"><div><p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">COMMUNITY</p><h3>Latest Member Activity</h3></div><span class="lfa-dashboard__sample-tag">DEMO</span></div><div class="lfa-dashboard__activity-list">
      <?php foreach ( $data['activity'] as $item ) : ?><div class="lfa-dashboard__activity"><span class="lfa-dashboard__activity-icon" aria-hidden="true">◆</span><div><strong><?php echo esc_html( $item['title'] ); ?></strong><small><?php echo esc_html( $item['detail'] ); ?></small></div><span aria-hidden="true" class="lfa-dashboard__activity-arrow">›</span></div><?php endforeach; ?>
    </div></section>
    <section class="lfa-dashboard__conference-note"><p class="lfa-dashboard__eyebrow">2027 ALUMNI CONFERENCE</p><h3>“Thy Kingdom Come”</h3><p>Matthew 6:10</p><div class="lfa-dashboard__conference-rule"></div><p>Reconnect with the family. Find event information, announcements, and upcoming registration details.</p><button type="button" class="lfa-dashboard__btn lfa-dashboard__btn--white" data-go="conference">Explore Conference <span aria-hidden="true">→</span></button></section>
  </div>
</section>
