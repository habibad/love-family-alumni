<?php
/**
 * Leadership Page — Section 05: Advisory Council
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$advisory_roster = lfa_get_leadership_roster( 'advisory' );
?>

<section class="leadership-roster-section leadership-advisory-section" id="advisory-council" aria-label="Advisory Council">
	<div class="lfa-container leadership-section-container">
		<!-- Section Header -->
		<div class="leadership-section-header">
			<div class="leadership-section-eyebrow-wrap">
				<span class="leadership-section-eyebrow">ADVISORY COUNCIL</span>
			</div>
			<h2 class="leadership-section-title">Wisdom. Experience. Lasting Guidance.</h2>
			<p class="leadership-section-desc">
				Our advisory council comprises distinguished alumni who provide valuable counsel, mentorship and strategic guidance to our leadership team.
			</p>
		</div>

		<!-- 5-Column Grid -->
		<div class="leadership-roster-grid grid-cols-5" role="list">
			<?php foreach ( $advisory_roster as $leader ) : ?>
				<div class="leadership-roster-item" role="listitem">
					<?php get_template_part( 'template-parts/leadership/leader-card', null, $leader ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
