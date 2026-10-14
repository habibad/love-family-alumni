<?php
/** Existing images are from previous gatherings; no future event imagery. */
if (!defined('ABSPATH')) { exit; }
$memories = [
 ['src'=>'history-alumni-group.jpg','alt'=>'Alumni posing together at a previous gathering','title'=>'Together in Community','meta'=>'Historical alumni gathering'],
 ['src'=>'history-community-women.jpg','alt'=>'Members of the alumni community standing together at a reunion','title'=>'Friendship Across Generations','meta'=>'Community moments'],
 ['src'=>'history-omaha-2025.jpg','alt'=>'Presenter at the Omaha 2025 alumni conference and reunion','title'=>'Remembering Omaha 2025','meta'=>'2025 Conference / Reunion'],
];
?>
<section class="lfa-conf-memories lfa-conf-section" id="conference-memories" aria-labelledby="lfa-conf-memories-title">
  <div class="lfa-conf-wrap">
    <div class="lfa-conf-section-head lfa-conf-section-head--split">
      <div><p class="lfa-conf-label">OUR SHARED HISTORY</p><h2 id="lfa-conf-memories-title">Moments That Stay With Us.</h2></div>
      <p>Photographs from previous alumni gatherings remind us why coming together matters.</p>
    </div>
    <div class="lfa-conf-memories__grid">
    <?php foreach($memories as $memory): ?>
      <figure class="lfa-conf-memories__item">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/conference/'.$memory['src'])); ?>" alt="<?php echo esc_attr($memory['alt']); ?>" loading="lazy" width="900" height="680">
        <figcaption><span><?php echo esc_html($memory['meta']); ?></span><strong><?php echo esc_html($memory['title']); ?></strong></figcaption>
      </figure>
    <?php endforeach; ?>
    </div>
  </div>
</section>
