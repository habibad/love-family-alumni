<?php
/**
 * Homepage Value Pillars Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pillars = [
	[
		'icon'        => 'connect',
		'badge_color' => 'crimson',
		'title'       => 'CONNECT',
		'description' => 'Build lasting relationships with fellow alumni across North America.',
	],
	[
		'icon'        => 'collaborate',
		'badge_color' => 'navy',
		'title'       => 'COLLABORATE',
		'description' => 'Share ideas, resources and opportunities to grow together.',
	],
	[
		'icon'        => 'impact',
		'badge_color' => 'crimson',
		'title'       => 'IMPACT',
		'description' => 'Make a difference in our communities and beyond.',
	],
	[
		'icon'        => 'represent',
		'badge_color' => 'navy',
		'title'       => 'REPRESENT',
		'description' => 'Be a proud ambassador of the Love Family everywhere you are.',
	],
];
?>
<section class="pillars-section" aria-label="Core Pillars">
	<div class="lfa-container">
		<div class="pillars-grid">
			<?php foreach ( $pillars as $index => $pillar ) : ?>
				<div class="pillar-item <?php echo $index < 3 ? 'has-divider' : ''; ?>">
					<div class="pillar-icon-badge badge-<?php echo esc_attr( $pillar['badge_color'] ); ?>">
						<?php echo lfa_icon( $pillar['icon'] ); ?>
					</div>
					<h3 class="pillar-title"><?php echo esc_html( $pillar['title'] ); ?></h3>
					<p class="pillar-desc"><?php echo esc_html( $pillar['description'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
