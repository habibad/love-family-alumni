<?php
/**
 * Leadership Page — Section 03: Executive Team
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$executive_roster = lfa_get_leadership_roster( 'executive' );
?>

<section class="leadership-roster-section leadership-executive-section" id="executive-team" aria-label="Executive Leadership Team">
	<div class="lfa-container leadership-section-container">
		<!-- Section Header -->
		<div class="leadership-section-header">
			<div class="leadership-section-eyebrow-wrap">
				<span class="leadership-section-eyebrow">EXECUTIVE TEAM</span>
			</div>
			<h2 class="leadership-section-title">Dedicated Leaders. Greater Impact.</h2>
			<p class="leadership-section-desc">
				Our executive team works together to advance our mission, support our members and create opportunities for a stronger, more connected alumni community.
			</p>
		</div>

		<!-- 5-Column Grid -->
		<div class="leadership-roster-grid grid-cols-5" role="list">
			<?php foreach ( $executive_roster as $leader ) : ?>
				<div class="leadership-roster-item" role="listitem">
					<?php get_template_part( 'template-parts/leadership/leader-card', null, $leader ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
