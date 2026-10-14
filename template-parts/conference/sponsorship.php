<?php
/** Sponsorship availability and tiers are not yet confirmed. */
if (!defined('ABSPATH')) { exit; }
$contact_page = get_page_by_path('contact');
$contact_url = $contact_page ? get_permalink($contact_page) : 'mailto:lovefamilyalumni.na@gmail.com';
?>
<section class="lfa-conf-sponsor lfa-conf-section" id="conference-sponsorship" aria-labelledby="lfa-conf-sponsor-title">
  <div class="lfa-conf-wrap lfa-conf-sponsor__grid">
    <div class="lfa-conf-sponsor__art" aria-hidden="true"><span class="lfa-conf-sponsor__small">ONE FAMILY</span><span class="lfa-conf-sponsor__heart">♡</span><span class="lfa-conf-sponsor__year">2027</span><span class="lfa-conf-sponsor__foot">SERVICE · LEGACY · IMPACT</span></div>
    <div class="lfa-conf-sponsor__content">
      <p class="lfa-conf-label">SUPPORT OUR COMMUNITY</p>
      <h2 id="lfa-conf-sponsor-title">Make an Impact. <em>Together.</em></h2>
      <p>Interested in supporting a future Love Family Alumni gathering? Connect with the organizers to learn whether conference sponsorship opportunities are available.</p>
      <p class="lfa-conf-small-note">Sponsorship packages, benefits and pricing have not yet been announced.</p>
      <a class="lfa-conf-action lfa-conf-action--crimson" href="<?php echo esc_url($contact_url); ?>">Contact the Organizers <span aria-hidden="true">↗</span></a>
    </div>
  </div>
</section>
