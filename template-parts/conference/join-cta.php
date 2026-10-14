<?php
/** Final conference CTA, then reuse approved get_footer(). */
if (!defined('ABSPATH')) { exit; }
$events = get_page_by_path('events');
$contact = get_page_by_path('contact');
$events_url = $events ? get_permalink($events) : home_url('/');
$contact_url = $contact ? get_permalink($contact) : 'mailto:lovefamilyalumni.na@gmail.com';
?>
<section class="lfa-conf-final-cta" aria-labelledby="lfa-conf-final-cta-title">
  <div class="lfa-conf-wrap lfa-conf-final-cta__inner">
    <div class="lfa-conf-final-cta__text"><p class="lfa-conf-label lfa-conf-label--gold">ONE FAMILY. ONE PURPOSE.</p><h2 id="lfa-conf-final-cta-title">Be Part of Our <em>Next Chapter.</em></h2><p>Stay connected as we prepare to gather in fellowship and purpose.</p></div>
    <div class="lfa-conf-final-cta__actions"><a class="lfa-conf-action lfa-conf-action--crimson" href="<?php echo esc_url($events_url); ?>">Explore Events</a><a class="lfa-conf-action lfa-conf-action--outline" href="<?php echo esc_url($contact_url); ?>">Contact Us</a></div>
  </div>
</section>
