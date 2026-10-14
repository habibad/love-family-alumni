<?php
/**
 * Scholarships — Programs Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$programs = isset( $args['programs'] ) && is_array( $args['programs'] ) ? $args['programs'] : [];
?>
<section id="scholarship-programs" class="lfa-scholarships__programs" aria-labelledby="lfa-programs-heading">
  <div class="lfa-scholarships__container">
    <div class="lfa-scholarships__programs-header">
      <div>
        <p class="lfa-scholarships__eyebrow">EXPLORE OPPORTUNITIES</p>
        <h2 id="lfa-programs-heading">Scholarship <em>Programs.</em></h2>
      </div>
      <p>Explore potential areas of student support. Official programs, requirements, amounts and application dates are awaiting organizational confirmation.</p>
    </div>
    <div class="lfa-scholarships__demo-note" role="note">
      <strong>Frontend preview:</strong> All three programs below are illustrative examples&mdash;not confirmed open scholarships.
    </div>
    <div class="lfa-scholarships__program-grid">
      <?php foreach ( $programs as $program ) : ?>
        <?php get_template_part( 'template-parts/scholarships/program-card', null, [ 'program' => $program ] ); ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
