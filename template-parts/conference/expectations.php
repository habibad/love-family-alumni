<?php
/** Values / expected experience; these are themes, not a confirmed program. */
if (!defined('ABSPATH')) { exit; }
$features = [
  ['no'=>'01','icon'=>'✦','title'=>'Fellowship & Reunion','copy'=>'Reconnect with fellow alumni and strengthen the relationships that bring our community together.'],
  ['no'=>'02','icon'=>'◈','title'=>'Purposeful Conversations','copy'=>'Share perspectives and reflect on the values that guide our collective journey.'],
  ['no'=>'03','icon'=>'♡','title'=>'Service & Community','copy'=>'Celebrate ways alumni support one another and contribute to their communities.'],
  ['no'=>'04','icon'=>'↗','title'=>'Future Generations','copy'=>'Inspire continued friendship, mentoring and a lasting Love Family legacy.'],
];
?>
<section class="lfa-conf-expect lfa-conf-section" id="conference-experience" aria-labelledby="lfa-conf-expect-title">
  <div class="lfa-conf-wrap">
    <div class="lfa-conf-section-head lfa-conf-section-head--center">
      <p class="lfa-conf-label">THE CONFERENCE EXPERIENCE</p>
      <h2 id="lfa-conf-expect-title">More Than a Gathering.<br><em>A Shared Purpose.</em></h2>
      <p>Community values that inspire the spirit of the conference. The official program will be published by the organizers.</p>
    </div>
    <div class="lfa-conf-expect__grid">
      <?php foreach ($features as $feature) : ?>
      <article class="lfa-conf-expect__card">
        <span class="lfa-conf-expect__number"><?php echo esc_html($feature['no']); ?></span>
        <span class="lfa-conf-expect__symbol" aria-hidden="true"><?php echo esc_html($feature['icon']); ?></span>
        <h3><?php echo esc_html($feature['title']); ?></h3>
        <p><?php echo esc_html($feature['copy']); ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
