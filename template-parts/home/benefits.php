<?php
/**
 * Homepage Membership Benefits Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$benefits = [
	[
		'icon'       => 'briefcase',
		'color'      => 'crimson',
		'title'      => 'Professional<br>Networking',
	],
	[
		'icon'       => 'calendar',
		'color'      => 'navy',
		'title'      => 'Exclusive<br>Events',
	],
	[
		'icon'       => 'id-card',
		'color'      => 'crimson',
		'title'      => 'Alumni<br>Directory Access',
	],
	[
		'icon'       => 'users',
		'color'      => 'navy',
		'title'      => 'Mentorship<br>&amp; Support',
	],
	[
		'icon'       => 'heart-hand',
		'color'      => 'crimson',
		'title'      => 'Community<br>Service Opportunities',
	],
	[
		'icon'       => 'bell',
		'color'      => 'navy',
		'title'      => 'Latest News<br>&amp; Updates',
	],
];
?>
<section class="benefits-section" aria-label="Membership Benefits">
	<div class="lfa-container">
		<div class="benefits-header-row">
			<div class="benefits-header-left">
				<span class="section-eyebrow eyebrow-crimson">MEMBERSHIP BENEFITS</span>
				<h2 class="section-heading benefits-heading">More Than Alumni, We Are Family.</h2>
			</div>
			<div class="benefits-header-right">
				<p class="benefits-subtitle">
					Join a supportive network that helps you stay connected, grow, and make across North America.
				</p>
			</div>
		</div>

		<div class="benefits-strip-row">
			<?php foreach ( $benefits as $index => $benefit ) : ?>
				<div class="benefit-strip-item <?php echo $index < 5 ? 'has-divider' : ''; ?>">
					<div class="benefit-icon-wrap icon-color-<?php echo esc_attr( $benefit['color'] ); ?>">
						<?php echo lfa_icon( $benefit['icon'] ); ?>
					</div>
					<h3 class="benefit-strip-title"><?php echo wp_kses_post( $benefit['title'] ); ?></h3>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
