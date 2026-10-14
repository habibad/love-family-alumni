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
    <span class="lfa-scholarships__demo-badge">DEMO ONLY</span>
  </div>
  <p class="lfa-scholarships__program-category"><?php echo esc_html( $program['label'] ); ?></p>
  <h3><?php echo esc_html( $program['title'] ); ?></h3>
  <p class="lfa-scholarships__program-description"><?php echo esc_html( $program['description'] ); ?></p>
  <div class="lfa-scholarships__program-status"><span aria-hidden="true">&bull;</span> <?php echo esc_html( $program['status'] ); ?></div>
  <details class="lfa-scholarships__program-details">
    <summary>View Program Details <span aria-hidden="true">&rarr;</span></summary>
    <div class="lfa-scholarships__program-details-content">
       <p><?php echo esc_html( $program['eligibility'] ); ?></p>
       <p><?php echo esc_html( $program['deadline'] ); ?></p>
       <p><strong>Applications are not open.</strong> This is a design preview only.</p>
    </div>
  </details>
</article>
