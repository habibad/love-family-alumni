<?php
/** About Conference — static content until official details arrive. */
if (!defined('ABSPATH')) { exit; }
$photo = get_theme_file_uri('/assets/images/conference/history-alumni-group.jpg');
?>
<section class="lfa-conf-about lfa-conf-section" id="conference-about" aria-labelledby="lfa-conf-about-title">
  <div class="lfa-conf-wrap lfa-conf-about__grid">
    <div class="lfa-conf-about__copy">
      <p class="lfa-conf-label">THE PURPOSE OF OUR GATHERING</p>
      <h2 id="lfa-conf-about-title">Gathering in Faith.<br><em>Growing in Community.</em></h2>
      <p class="lfa-conf-lead">One family, brought together by a shared legacy of fellowship, service and connection.</p>
      <p>The 2027 Love Family Alumni Conference is an opportunity for our community to reconnect, celebrate its shared heritage and look ahead with renewed purpose. The North America Zone looks forward to welcoming alumni and friends as official plans are announced.</p>
      <div class="lfa-conf-about__values" aria-label="Conference values"><span>Fellowship</span><span>Service</span><span>Legacy</span></div>
    </div>
    <figure class="lfa-conf-about__image">
      <img src="<?php echo esc_url($photo); ?>" alt="Love Family alumni pictured together at a previous community gathering" loading="lazy" width="1439" height="774">
      <figcaption>Moments from our alumni community — historical photograph</figcaption>
    </figure>
  </div>
</section>
