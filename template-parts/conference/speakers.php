<?php
/** No confirmed 2027 speakers supplied. */
if (!defined('ABSPATH')) { exit; }
?>
<section class="lfa-conf-speakers lfa-conf-section" id="conference-speakers" aria-labelledby="lfa-conf-speakers-title">
  <div class="lfa-conf-wrap">
    <div class="lfa-conf-section-head lfa-conf-section-head--split">
      <div><p class="lfa-conf-label">VOICES & INSPIRATION</p><h2 id="lfa-conf-speakers-title">Conference Speakers</h2></div>
      <p>We look forward to sharing our confirmed speakers and program contributors once announcements are available.</p>
    </div>
    <div class="lfa-conf-speakers__grid">
      <?php for ($i = 1; $i <= 3; $i++) : ?>
      <article class="lfa-conf-speakers__card">
        <div class="lfa-conf-speakers__avatar" aria-hidden="true"><span>✦</span></div>
        <div class="lfa-conf-speakers__card-body"><span class="lfa-conf-speakers__pill">Announcement pending</span><h3>Speaker details to follow</h3><p>Official names and biographies will be added after confirmation.</p></div>
      </article>
      <?php endfor; ?>
    </div>
    <p class="lfa-conf-small-note">Images from previous conferences are not evidence of confirmed participation in 2027.</p>
  </div>
</section>
