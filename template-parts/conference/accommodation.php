<?php
/** Venue and hotel: unconfirmed. */
if (!defined('ABSPATH')) { exit; }
$items = [
  ['symbol'=>'⌖','title'=>'Conference Venue','desc'=>'Official venue and host city details will be announced.'],
  ['symbol'=>'⌂','title'=>'Hotels & Accommodation','desc'=>'Hotel recommendations and accommodation arrangements are pending.'],
  ['symbol'=>'↗','title'=>'Travel Information','desc'=>'Travel and arrival guidance will be available with the official event information.'],
];
?>
<section class="lfa-conf-accommodation lfa-conf-section" id="conference-travel" aria-labelledby="lfa-conf-accom-title">
  <div class="lfa-conf-wrap">
    <div class="lfa-conf-section-head lfa-conf-section-head--center">
      <p class="lfa-conf-label">PLAN YOUR VISIT</p>
      <h2 id="lfa-conf-accom-title">Venue & Accommodation</h2>
      <p>Important travel and hospitality details will be shared once confirmed.</p>
    </div>
    <div class="lfa-conf-accommodation__grid">
      <?php foreach($items as $item): ?>
      <article class="lfa-conf-accommodation__card"><span aria-hidden="true"><?php echo esc_html($item['symbol']); ?></span><h3><?php echo esc_html($item['title']); ?></h3><p><?php echo esc_html($item['desc']); ?></p><small>Details to be announced</small></article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
