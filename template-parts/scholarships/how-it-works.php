<?php
/**
 * Scholarships frontend task 02: illustrative process, not a confirmed organization policy.
 * Do not present these steps as official scholarship procedures.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$steps = [
	[
		'number'      => '01',
		'title'       => 'Explore potential programs',
		'description' => 'Review the example scholarship concepts above. Confirmed offerings and eligibility will be announced by the organization.',
	],
	[
		'number'      => '02',
		'title'       => 'Review official requirements',
		'description' => 'When opportunities are officially published, read their verified criteria, dates, and supporting-document guidance.',
	],
	[
		'number'      => '03',
		'title'       => 'Prepare your application',
		'description' => 'Use the non-submitting form preview below to see an illustrative application experience.',
	],
	[
		'number'      => '04',
		'title'       => 'Await future announcements',
		'description' => 'Actual submission, administrative review, and notifications will become available only after official launch.',
	],
];
?>
<section id="scholarship-process" class="lfa-scholarships__process" aria-labelledby="lfa-scholarships-process-heading">
	<div class="lfa-scholarships__container lfa-scholarships__process-layout">
		<div class="lfa-scholarships__process-intro">
			<p class="lfa-scholarships__eyebrow">A SIMPLE PATH TO OPPORTUNITY</p>
			<h2 id="lfa-scholarships-process-heading">How Scholarship <em>Support Works.</em></h2>
			<p class="lfa-scholarships__process-description">An illustrative overview of a future support experience, built around clear information, respectful review, and student opportunity.</p>
			<div class="lfa-scholarships__process-note" role="note"><span aria-hidden="true">&#9432;</span> <strong>Process preview.</strong> These steps are not confirmed application policies or currently available services.</div>
			<a class="lfa-scholarships__process-link" href="#scholarship-application-preview">Preview the future application <span aria-hidden="true">&nearr;</span></a>
		</div>
		<ol class="lfa-scholarships__steps" aria-label="Illustrative scholarship application process">
			<?php foreach ( $steps as $step ) : ?>
				<li class="lfa-scholarships__step">
					<div class="lfa-scholarships__step-number" aria-hidden="true"><?php echo esc_html( $step['number'] ); ?></div>
					<div class="lfa-scholarships__step-copy">
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['description'] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
