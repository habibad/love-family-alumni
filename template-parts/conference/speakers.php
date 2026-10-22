<?php
/**
 * Conference 2027 — Dynamic Speakers & Keynote Section
 *
 * Pulls authoritative confirmed speakers from wp_lfa_conference_speakers.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$speakers = class_exists( 'LFA_Conference' ) ? LFA_Conference::get_conference_speakers( 1, true ) : [];
$keynote = null;
$others = [];

foreach ( $speakers as $spk ) {
	if ( ! $keynote && $spk->role === 'keynote' ) {
		$keynote = $spk;
	} else {
		$others[] = $spk;
	}
}
?>
<section class="lfa-conf-speakers lfa-conf-section" id="conference-speakers" aria-labelledby="lfa-conf-speakers-title">
  <div class="lfa-conf-wrap">
    <div class="lfa-conf-section-head lfa-conf-section-head--split">
      <div>
        <p class="lfa-conf-label">VOICES &amp; INSPIRATION</p>
        <h2 id="lfa-conf-speakers-title">Conference Speakers &amp; Keynotes</h2>
      </div>
      <p>We look forward to sharing our confirmed speakers, keynote ministry, and program contributors for the 2027 Gathering.</p>
    </div>

    <div class="lfa-conf-speakers__grid">
      <?php if ( $keynote ) :
        $k_img_url = $keynote->image_id ? ( wp_get_attachment_image_url( $keynote->image_id, 'large' ) ?: wp_get_attachment_image_url( $keynote->image_id, 'medium' ) ) : '';
      ?>
        <article class="lfa-conf-speakers__card lfa-conf-speakers__card--keynote" style="border: 2px solid #C6933D; background: #FFFDF9; grid-column: span 2;">
          <div class="lfa-conf-speakers__avatar" aria-hidden="true" style="background: #0A203A; color: #E5C170; overflow:hidden;">
            <?php if ( $k_img_url ) : ?>
              <img src="<?php echo esc_url( $k_img_url ); ?>" alt="<?php echo esc_attr( $keynote->image_alt ?: $keynote->name ); ?>" style="width:100%; height:100%; object-fit:cover; object-position:center 15%; display:block;">
            <?php else : ?>
              <span>✦</span>
            <?php endif; ?>
          </div>
          <div class="lfa-conf-speakers__card-body">
            <span class="lfa-conf-speakers__pill" style="background: #0A203A; color: #E5C170; font-weight: 700;">CONFIRMED KEYNOTE</span>
            <h3 style="color: #0A203A; font-size: 1.35rem; font-weight: 800; margin-top: 6px;"><?php echo esc_html( $keynote->name ); ?></h3>
            <?php if ( ! empty( $keynote->organization ) || ! empty( $keynote->designation ) ) : ?>
              <p style="font-weight: 600; color: #AB1640; font-size: 0.85rem; margin-bottom: 6px;">
                <?php echo esc_html( implode( ' · ', array_filter( [ $keynote->designation, $keynote->organization ] ) ) ); ?>
              </p>
            <?php endif; ?>

            <?php if ( ! empty( $keynote->keynote_title ) ) : ?>
              <h4 style="color:#0a203a; font-size:1.05rem; margin:10px 0 4px 0; font-weight:700;">
                <?php echo esc_html( $keynote->keynote_title ); ?>
              </h4>
            <?php endif; ?>

            <p style="color:#334155; font-size:14px; line-height:1.6; margin-bottom:10px;">
              <?php echo nl2br( esc_html( $keynote->keynote_abstract ?: 'Keynote ministry address aligned with the 2027 Conference Theme: Thy Kingdom Come (Matthew 6:10).' ) ); ?>
            </p>

            <?php if ( ! empty( $keynote->biography ) ) : ?>
              <p style="color:#64748b; font-size:13px; line-height:1.5; font-style:italic;">
                <?php echo esc_html( $keynote->biography ); ?>
              </p>
            <?php endif; ?>
          </div>
        </article>
      <?php endif; ?>

      <?php if ( ! empty( $others ) ) : ?>
        <?php foreach ( $others as $spk ) :
          $s_img_url = $spk->image_id ? wp_get_attachment_image_url( $spk->image_id, 'thumbnail' ) : '';
        ?>
          <article class="lfa-conf-speakers__card">
            <div class="lfa-conf-speakers__avatar" aria-hidden="true" style="overflow:hidden;">
              <?php if ( $s_img_url ) : ?>
                <img src="<?php echo esc_url( $s_img_url ); ?>" alt="<?php echo esc_attr( $spk->image_alt ?: $spk->name ); ?>" style="width:100%; height:100%; object-fit:cover;">
              <?php else : ?>
                <span>✦</span>
              <?php endif; ?>
            </div>
            <div class="lfa-conf-speakers__card-body">
              <span class="lfa-conf-speakers__pill"><?php echo esc_html( strtoupper( $spk->role ) ); ?></span>
              <h3><?php echo esc_html( $spk->name ); ?></h3>
              <?php if ( ! empty( $spk->organization ) || ! empty( $spk->designation ) ) : ?>
                <p style="font-weight: 600; color: #0A203A; font-size: 0.85rem; margin-bottom: 6px;">
                  <?php echo esc_html( implode( ' · ', array_filter( [ $spk->designation, $spk->organization ] ) ) ); ?>
                </p>
              <?php endif; ?>
              <?php if ( ! empty( $spk->session_title ) ) : ?>
                <p><strong>Session:</strong> <?php echo esc_html( $spk->session_title ); ?></p>
              <?php endif; ?>
              <?php if ( ! empty( $spk->biography ) ) : ?>
                <p><?php echo esc_html( $spk->biography ); ?></p>
              <?php endif; ?>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else : ?>
        <article class="lfa-conf-speakers__card">
          <div class="lfa-conf-speakers__avatar" aria-hidden="true"><span>✦</span></div>
          <div class="lfa-conf-speakers__card-body">
            <span class="lfa-conf-speakers__pill">Executive Address</span>
            <h3>Love Family Alumni Leadership</h3>
            <p style="font-weight: 600; color: #0A203A; font-size: 0.85rem; margin-bottom: 6px;">North America Zone &amp; Global Secretariat</p>
            <p>Presidential opening charge, state of the fellowship address, and legacy commission.</p>
          </div>
        </article>

        <article class="lfa-conf-speakers__card">
          <div class="lfa-conf-speakers__avatar" aria-hidden="true"><span>✦</span></div>
          <div class="lfa-conf-speakers__card-body">
            <span class="lfa-conf-speakers__pill">Guest Contributors</span>
            <h3>Ministers &amp; Alumni Panelists</h3>
            <p style="font-weight: 600; color: #0A203A; font-size: 0.85rem; margin-bottom: 6px;">International Chapters</p>
            <p>Workshops on Christian professional leadership, family life, youth mentorship, and regional chapter growth.</p>
          </div>
        </article>
      <?php endif; ?>
    </div>

    <p class="lfa-conf-small-note">Confirmed Keynote: Dr. Uche Igbokwe (U.K.). Full detailed session timings and additional contributors will be published following committee confirmation.</p>
  </div>
</section>
