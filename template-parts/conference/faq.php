<?php
/** Native details/summary accordion with factual answers. */
if (!defined('ABSPATH')) { exit; }
$faq = [
 ['q'=>'When will the 2027 Conference take place?','a'=>'The official date has not yet been announced. The organizers will share it once confirmed.'],
 ['q'=>'Where will the conference be held?','a'=>'The confirmed venue and host location will be published when available.'],
 ['q'=>'How can I register?','a'=>'Registration is not yet open. Once available, the registration process and any applicable fees will be explained on this page.'],
 ['q'=>'Who will be speaking?','a'=>'The official speakers and conference program have not yet been announced.'],
 ['q'=>'Will accommodation recommendations be provided?','a'=>'Hotel and travel information will be provided when confirmed by the organizers.'],
 ['q'=>'Can I ask about sponsorship?','a'=>'You can contact the organization to express interest. Sponsorship opportunities and terms are not yet confirmed.'],
];
?>
<section class="lfa-conf-faq lfa-conf-section" id="conference-faq" aria-labelledby="lfa-conf-faq-title">
  <div class="lfa-conf-wrap lfa-conf-faq__grid">
    <div class="lfa-conf-faq__intro"><p class="lfa-conf-label">GOOD TO KNOW</p><h2 id="lfa-conf-faq-title">Frequently Asked <em>Questions.</em></h2><p>Answers to common questions as we prepare for the next Love Family Alumni gathering.</p></div>
    <div class="lfa-conf-faq__list">
      <?php foreach($faq as $i=>$item): ?>
      <details class="lfa-conf-faq__item" <?php echo $i===0?'open':''; ?>><summary><?php echo esc_html($item['q']); ?><span aria-hidden="true" class="lfa-conf-faq__plus">+</span></summary><p><?php echo esc_html($item['a']); ?></p></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
