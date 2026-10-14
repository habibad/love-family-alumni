<?php
/**
 * Give / Donations — Mission Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mission_data = $args['data']['mission'] ?? [];
?>

<section id="give-mission" class="lfa-give__mission" aria-labelledby="lfa-give-mission-heading">
	<div class="lfa-give__container">
		<div class="lfa-give__mission-grid">
			<!-- Left Column: Editorial Heading -->
			<div class="lfa-give__mission-left">
				<div class="lfa-give__eyebrow lfa-give__eyebrow--crimson">
					<?php echo esc_html( $mission_data['eyebrow'] ?? 'WHY WE GIVE' ); ?>
				</div>
				<h2 id="lfa-give-mission-heading" class="lfa-give__mission-heading">
					<?php echo esc_html( $mission_data['heading_1'] ?? 'More Than Giving.' ); ?><br>
					<span class="text-crimson"><?php echo esc_html( $mission_data['heading_2'] ?? 'Growing Together.' ); ?></span>
				</h2>
			</div>

			<!-- Right Column: Narrative Copy & Strategic Pillars -->
			<div class="lfa-give__mission-right">
				<p class="lfa-give__mission-lead">
					<?php echo esc_html( $mission_data['description'] ?? 'Love Family Alumni brings people together around connection, service and a shared sense of purpose. This giving page will help members understand future opportunities to contribute once official programs are confirmed.' ); ?>
				</p>

				<hr class="lfa-give__mission-divider">

				<div class="lfa-give__mission-pillars">
					<?php foreach ( ( $mission_data['pillars'] ?? [] ) as $pillar ) : ?>
						<div class="lfa-give__pillar-item">
							<span class="pillar-num"><?php echo esc_html( $pillar['number'] ); ?></span>
							<span class="pillar-title"><?php echo esc_html( $pillar['title'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
