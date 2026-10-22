<?php
/**
 * Gallery & Archives — Interactive Chronological Timeline Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$timeline = [];

if ( class_exists( 'LFA_Archives' ) ) {
	$db_milestones = LFA_Archives::get_timeline_milestones();
	foreach ( $db_milestones as $m ) {
		$timeline[] = [
			'id'          => $m['id'],
			'year'        => (string) $m['year'],
			'badge'       => $m['badge'],
			'title'       => $m['title'],
			'desc'        => $m['description'],
			'location'    => 'North America Zone Archive',
			'source'      => $m['source'],
			'granularity' => $m['granularity'],
			'is_future'   => $m['is_future'],
		];
	}
}

if ( empty( $timeline ) ) {
	$gallery_data = isset( $args['data'] ) && is_array( $args['data'] ) ? $args['data'] : [];
	$timeline     = $gallery_data['timeline'] ?? [];
}

if ( empty( $timeline ) ) {
	return;
}
?>

<section id="historical-timeline" class="lfa-timeline-section" aria-labelledby="timeline-heading" style="padding: 80px 0; background: #FFFFFF; border-top: 1px solid #E2E8F0;">
	<div class="lfa-container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
		<div style="text-align: center; margin-bottom: 35px;">
			<span class="lfa-pill" style="display: inline-block; padding: 6px 14px; background: rgba(198,147,61,0.15); color: #C6933D; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; border-radius: 999px; margin-bottom: 12px;">
				Chronological Heritage
			</span>
			<h2 id="timeline-heading" style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 800; color: #0A203A; margin: 0 0 14px;">
				Interactive Historical Timeline
			</h2>
			<p style="color: #64748B; font-size: 1.05rem; max-width: 650px; margin: 0 auto;">
				Tracing the pivotal milestones, assemblies, and constitutional foundations that have shaped The Love Family Alumni across North America.
			</p>
		</div>

		<!-- Interactive Year Filter Buttons (ARC-027) -->
		<div class="lfa-timeline-filters" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 45px; flex-wrap: wrap;">
			<button type="button" class="lfa-tl-filter-btn is-active" data-year="all" style="padding: 8px 18px; border-radius: 999px; font-size: 0.85rem; font-weight: 700; border: 1px solid #0A203A; background: #0A203A; color: #FFF; cursor: pointer;">All Milestones</button>
			<?php
			$years = array_unique( array_column( $timeline, 'year' ) );
			sort( $years );
			foreach ( $years as $yr ) : ?>
				<button type="button" class="lfa-tl-filter-btn" data-year="<?php echo esc_attr( $yr ); ?>" style="padding: 8px 18px; border-radius: 999px; font-size: 0.85rem; font-weight: 700; border: 1px solid #CBD5E1; background: #FFF; color: #0A203A; cursor: pointer;"><?php echo esc_html( $yr ); ?></button>
			<?php endforeach; ?>
		</div>

		<!-- Chronological Flow -->
		<div class="timeline-stepper" style="position: relative; padding: 20px 0;">
			<div class="timeline-line" style="position: absolute; left: 50%; top: 0; bottom: 0; width: 2px; background: #E2E8F0; transform: translateX(-50%);" aria-hidden="true"></div>

			<?php foreach ( $timeline as $index => $item ) : 
				$is_even = ( 0 === $index % 2 );
			?>
			<div class="timeline-node" data-node-year="<?php echo esc_attr( $item['year'] ); ?>" style="display: flex; justify-content: <?php echo $is_even ? 'flex-start' : 'flex-end'; ?>; align-items: center; position: relative; margin-bottom: 40px; width: 100%;">
				<!-- Center Marker -->
				<div class="timeline-marker" style="position: absolute; left: 50%; top: 24px; transform: translate(-50%, -50%); width: 20px; height: 20px; border-radius: 50%; background: #0A203A; border: 4px solid #C6933D; z-index: 2;" aria-hidden="true"></div>

				<!-- Content Box -->
				<div class="timeline-content-card" style="width: 45%; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 24px; box-shadow: 0 2px 10px rgba(10,32,58,0.03); transition: transform 0.2s ease;">
					<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
						<span style="font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 800; color: #0A203A;">
							<?php echo esc_html( $item['year'] ); ?>
						</span>
						<span style="display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 700; background: <?php echo !empty($item['is_future']) ? 'rgba(198,147,61,0.2)' : 'rgba(171,22,64,0.1)'; ?>; color: <?php echo !empty($item['is_future']) ? '#854D0E' : '#AB1640'; ?>;">
							<?php echo esc_html( $item['badge'] ); ?>
						</span>
					</div>
					<h3 style="font-size: 1.1rem; font-weight: 700; color: #0A203A; margin: 0 0 8px;">
						<?php echo esc_html( $item['title'] ); ?>
					</h3>
					<div style="color: #475569; font-size: 0.9rem; line-height: 1.6; margin: 0 0 12px;">
						<?php echo wp_kses_post( wpautop( $item['desc'] ) ); ?>
					</div>
					<?php if ( ! empty( $item['source'] ) ) : ?>
						<div style="font-size: 0.75rem; color: #854D0E; background: #FEF3C7; padding: 4px 10px; border-radius: 4px; border: 1px solid #FDE68A; margin-bottom: 8px;">
							<strong>Source Reference:</strong> <?php echo esc_html( $item['source'] ); ?>
						</div>
					<?php endif; ?>
					<div style="font-size: 0.78rem; font-weight: 600; color: #64748B; border-top: 1px solid #EDF2F7; padding-top: 8px;">
						<span aria-hidden="true">&#9679;</span> <?php echo esc_html( $item['location'] ); ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<script>
(function() {
	const filterBtns = document.querySelectorAll('.lfa-tl-filter-btn');
	const nodes = document.querySelectorAll('.timeline-node');

	filterBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			filterBtns.forEach(b => {
				b.style.background = '#FFF';
				b.style.color = '#0A203A';
				b.style.borderColor = '#CBD5E1';
				b.classList.remove('is-active');
			});
			this.style.background = '#0A203A';
			this.style.color = '#FFF';
			this.style.borderColor = '#0A203A';
			this.classList.add('is-active');

			const selected = this.getAttribute('data-year');
			nodes.forEach(node => {
				const yr = node.getAttribute('data-node-year');
				if (selected === 'all' || selected === yr) {
					node.style.display = 'flex';
				} else {
					node.style.display = 'none';
				}
			});
		});
	});
})();
</script>

<style>
@media (max-width: 768px) {
	.timeline-line {
		left: 20px !important;
	}
	.timeline-node {
		justify-content: flex-start !important;
		padding-left: 50px !important;
	}
	.timeline-marker {
		left: 20px !important;
	}
	.timeline-content-card {
		width: 100% !important;
	}
}
</style>
