<?php
/**
 * Scholarships — Supporters & Giving Back Section (Task 03)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$task03  = isset( $args['data'] ) && is_array( $args['data'] ) ? $args['data'] : [];
$options = isset( $task03['support_options'] ) && is_array( $task03['support_options'] ) ? $task03['support_options'] : [];
$icons   = [
	'mentorship'  => '<path d="M6 19v-2c0-2 3-3 6-3s6 1 6 3v2"/><circle cx="12" cy="7" r="4"/><path d="M20 8v6m-3-3h6"/>',
	'opportunity' => '<rect x="4" y="6" width="16" height="14" rx="2"/><path d="M8 6V4h8v2M4 11h16m-9-3v6h2V8"/>',
	'support'     => '<path d="m12 20-7-7a4 4 0 0 1 6-5l1 1 1-1a4 4 0 0 1 6 5l-7 7Z"/><path d="M12 4v2"/>',
];
?>
<section id="scholarship-support" class="lfa-scholarships__support" aria-labelledby="lfa-scholarships-support-title">
	<div class="lfa-scholarships__container">
		<div class="lfa-scholarships__support-heading">
			<div>
				<p class="lfa-scholarships__eyebrow">A COMMUNITY THAT LIFTS OTHERS</p>
				<h2 id="lfa-scholarships-support-title">Opportunities to <em>Give Back.</em></h2>
			</div>
			<p>Our strength is the experience and generosity within our alumni community. These are possible ways people might contribute once official programs are established.</p>
		</div>
		<div class="lfa-scholarships__support-notice" role="note">
			<span aria-hidden="true">&#9432;</span> <strong>Illustrative concepts only:</strong> The options below are not confirmed services or active fundraising campaigns.
		</div>
		<div class="lfa-scholarships__support-grid">
			<?php foreach ( $options as $option ) : ?>
				<article class="lfa-scholarships__support-card">
					<div class="lfa-scholarships__support-card-head">
						<span class="lfa-scholarships__support-icon" aria-hidden="true">
							<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" stroke-linecap="round" stroke-linejoin="round">
								<?php echo isset( $icons[ $option['icon'] ] ) ? $icons[ $option['icon'] ] : $icons['support']; ?>
							</svg>
						</span>
						<span class="lfa-scholarships__support-number"><?php echo esc_html( $option['number'] ); ?></span>
					</div>
					<span class="lfa-scholarships__support-category"><?php echo esc_html( $option['eyebrow'] ); ?></span>
					<h3><?php echo esc_html( $option['title'] ); ?></h3>
					<p><?php echo esc_html( $option['description'] ); ?></p>
					<div class="lfa-scholarships__support-card-footer">
						<span>Illustrative concept</span>
						<span aria-hidden="true">&bull;</span>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="lfa-scholarships__partners-pending">
			<div class="lfa-scholarships__partners-icon" aria-hidden="true">&#10035;</div>
			<div>
				<h3>Partner acknowledgments</h3>
				<p>Verified sponsors and partner organizations will be displayed here after confirmation and approval to publish.</p>
			</div>
			<span class="lfa-scholarships__partners-badge">AWAITING VERIFICATION</span>
		</div>
	</div>
</section>
