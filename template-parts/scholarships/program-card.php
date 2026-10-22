<?php
/**
 * Scholarships — Single Program Card (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$program = $args['program'] ?? null;
if ( ! is_array( $program ) ) {
	return;
}

$id   = sanitize_html_class( $program['id'] );
$tone = in_array( $program['tone'], [ 'navy', 'crimson', 'gold' ], true ) ? $program['tone'] : 'navy';
?>
<article class="lfa-scholarships__program lfa-scholarships__program--<?php echo esc_attr( $tone ); ?>">
  <div class="lfa-scholarships__program-top">
    <span class="lfa-scholarships__program-number" aria-hidden="true"><?php echo esc_html( $program['number'] ); ?></span>
    <?php if ( ! empty( $program['is_flagship'] ) ) : ?>
      <span class="lfa-scholarships__demo-badge" style="background:#0A203A;color:#E5C170;border-color:#C6933D;">FLAGSHIP ENDOWMENT</span>
    <?php else : ?>
      <span class="lfa-scholarships__demo-badge" style="background:#eff6ff;color:#1e40af;border-color:#bfdbfe;">ACTIVE PROGRAM</span>
    <?php endif; ?>
  </div>
  <p class="lfa-scholarships__program-category"><?php echo esc_html( $program['label'] ); ?></p>
  <h3><?php echo esc_html( $program['title'] ); ?></h3>
  <p class="lfa-scholarships__program-description"><?php echo esc_html( $program['description'] ); ?></p>
  <div class="lfa-scholarships__program-status"><span aria-hidden="true">&bull;</span> <?php echo esc_html( $program['status'] ); ?></div>
  <details class="lfa-scholarships__program-details">
    <summary>View Program Details &amp; Eligibility <span aria-hidden="true">&rarr;</span></summary>
    <div class="lfa-scholarships__program-details-content" style="padding: 12px 0; font-size: 0.88rem; line-height: 1.6;">
       <p style="margin-bottom: 8px;"><strong>Eligibility:</strong> <?php echo esc_html( $program['eligibility'] ); ?></p>
       <p style="margin-bottom: 8px;"><strong>Application Timeline:</strong> <?php echo esc_html( $program['deadline'] ); ?></p>
       <?php if ( ! empty( $program['award_type'] ) ) : ?>
         <p style="margin-bottom: 8px;"><strong>Award Scope:</strong> <?php echo esc_html( $program['award_type'] ); ?></p>
       <?php endif; ?>
       <p style="font-size: 0.8rem; color: #64748B; margin-top: 10px;"><strong>Notice:</strong> Complete application statement and supporting transcripts can be previewed in the interactive form below.</p>
    </div>
  </details>
</article>
