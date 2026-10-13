<?php
/**
 * Leadership Page — Section 04: Board of Trustees / Board Members
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$board_roster = lfa_get_leadership_roster( 'board' );
?>

<section class="leadership-roster-section leadership-board-section" id="board-members" aria-label="Board of Trustees">
	<div class="lfa-container leadership-section-container">
		<!-- Section Header -->
		<div class="leadership-section-header">
			<div class="leadership-section-eyebrow-wrap">
				<span class="leadership-section-eyebrow">BOARD MEMBERS</span>
			</div>
			<h2 class="leadership-section-title">Working Together for a Brighter Future.</h2>
			<p class="leadership-section-desc">
				Our board members provide guidance, oversight and strategic support to ensure the long-term success of our alumni community.
			</p>
		</div>

		<!-- 6-Column Grid -->
		<div class="leadership-roster-grid grid-cols-6" role="list">
			<?php foreach ( $board_roster as $leader ) : ?>
				<div class="leadership-roster-item" role="listitem">
					<?php get_template_part( 'template-parts/leadership/leader-card', null, array_merge( $leader, [ 'variant' => 'compact' ] ) ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
