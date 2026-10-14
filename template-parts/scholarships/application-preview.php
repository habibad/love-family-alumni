<?php
/**
 * Frontend-only, no submission. The program list reuses Task 01 demo data.
 * This form intentionally has no action and cannot transmit or store data.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$programs = isset( $args['programs'] ) && is_array( $args['programs'] ) ? $args['programs'] : [];
?>
<section id="scholarship-application-preview" class="lfa-scholarships__application" aria-labelledby="lfa-scholarships-application-heading">
	<div class="lfa-scholarships__container">
		<div class="lfa-scholarships__application-header">
			<div>
				<p class="lfa-scholarships__eyebrow">EXPLORE THE EXPERIENCE</p>
				<h2 id="lfa-scholarships-application-heading">Application <em>Preview.</em></h2>
			</div>
			<span class="lfa-scholarships__application-status"><span aria-hidden="true">&bull;</span> APPLICATIONS NOT OPEN</span>
		</div>
		<div class="lfa-scholarships__application-shell">
			<aside class="lfa-scholarships__application-aside" aria-label="Scholarship application preview guidance">
				<span class="lfa-scholarships__application-aside-kicker">THE NEXT GENERATION</span>
				<h3>Every opportunity begins with a possibility.</h3>
				<p>This interactive form demonstrates how a future scholarship application could feel. All programs and fields are illustrative.</p>
				<div class="lfa-scholarships__application-aside-divider"></div>
				<div class="lfa-scholarships__application-aside-point"><span>01</span> Personal information</div>
				<div class="lfa-scholarships__application-aside-point"><span>02</span> Education and program</div>
				<div class="lfa-scholarships__application-aside-point"><span>03</span> Personal statement preview</div>
				<div class="lfa-scholarships__application-aside-warning" role="note">
					<strong>Preview only.</strong> Applications have not opened. Please use fictional details for testing. Nothing is submitted, saved, emailed, or uploaded.
				</div>
			</aside>
			<div class="lfa-scholarships__application-body">
				<div class="lfa-scholarships__application-form-title">
					<div>
						<span class="lfa-scholarships__application-tag">INTERACTIVE DEMO FORM</span>
						<h3>Tell us about your goals</h3>
						<p>Sample fields for frontend review. This is not a real scholarship application.</p>
					</div>
				</div>
				<form class="lfa-scholarships__application-form" id="lfa-scholarships-demo-form" novalidate>
					<fieldset class="lfa-scholarships__field-group">
						<legend>01 <span>Basic Information</span></legend>
						<div class="lfa-scholarships__form-grid">
							<div class="lfa-scholarships__field">
								<label for="lfa-scholarships-applicant-name">Full name <span aria-hidden="true">*</span></label>
								<input id="lfa-scholarships-applicant-name" name="applicant_name" type="text" autocomplete="off" placeholder="Demo Applicant" minlength="2" maxlength="100" required>
								<span class="lfa-scholarships__field-hint">Use a fictional name for testing.</span>
							</div>
							<div class="lfa-scholarships__field">
								<label for="lfa-scholarships-email">Email address <span aria-hidden="true">*</span></label>
								<input id="lfa-scholarships-email" name="email" type="email" autocomplete="off" placeholder="demo@example.com" maxlength="160" required>
								<span class="lfa-scholarships__field-hint">No email will be sent.</span>
							</div>
						</div>
					</fieldset>
					<fieldset class="lfa-scholarships__field-group">
						<legend>02 <span>Education &amp; Program</span></legend>
						<div class="lfa-scholarships__form-grid">
							<div class="lfa-scholarships__field">
								<label for="lfa-scholarships-level">Current education level <span aria-hidden="true">*</span></label>
								<select id="lfa-scholarships-level" name="education_level" required>
									<option value="">Choose a level</option>
									<option value="Secondary / High school">Secondary / High school</option>
									<option value="Undergraduate">Undergraduate</option>
									<option value="Postgraduate">Postgraduate</option>
									<option value="Other / Prefer not to say">Other / Prefer not to say</option>
								</select>
							</div>
							<div class="lfa-scholarships__field">
								<label for="lfa-scholarships-program">Demo program of interest <span aria-hidden="true">*</span></label>
								<select id="lfa-scholarships-program" name="program" required>
									<option value="">Select a demo program</option>
									<?php foreach ( $programs as $program ) : ?>
										<option value="<?php echo esc_attr( $program['id'] ); ?>"><?php echo esc_html( $program['title'] ); ?> (Demo)</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="lfa-scholarships__field lfa-scholarships__field--wide">
								<label for="lfa-scholarships-field-of-study">Area of study <span aria-hidden="true">*</span></label>
								<input id="lfa-scholarships-field-of-study" name="field_of_study" type="text" placeholder="e.g. Computer Science (sample)" autocomplete="off" maxlength="120" required>
							</div>
						</div>
					</fieldset>
					<fieldset class="lfa-scholarships__field-group lfa-scholarships__field-group--last">
						<legend>03 <span>Your Statement</span></legend>
						<div class="lfa-scholarships__field">
							<label for="lfa-scholarships-statement">Why does this opportunity interest you? <span aria-hidden="true">*</span></label>
							<textarea id="lfa-scholarships-statement" name="statement" rows="4" minlength="30" maxlength="600" required placeholder="Write a fictional example statement (at least 30 characters)..."></textarea>
							<span class="lfa-scholarships__statement-count" id="lfa-scholarships-statement-count" aria-live="polite">0 / 600 characters</span>
						</div>
						<div class="lfa-scholarships__upload-placeholder" role="group" aria-label="Document upload not available">
							<span class="lfa-scholarships__upload-icon" aria-hidden="true">&#8679;</span>
							<div>
								<strong>Supporting documents</strong>
								<p>Upload functionality will be added when applications officially open.</p>
							</div>
							<span class="lfa-scholarships__upload-disabled">UNAVAILABLE</span>
						</div>
					</fieldset>
					<div class="lfa-scholarships__form-footer">
						<p><strong>Nothing will be submitted.</strong> Review shows a temporary on-screen preview only.</p>
						<div class="lfa-scholarships__form-actions">
							<button class="lfa-scholarships__form-reset" type="reset">Clear Fields</button>
							<button class="lfa-scholarships__form-review" type="button" data-lfa-scholarships-preview-trigger>Review Demo Details <span aria-hidden="true">&rarr;</span></button>
						</div>
					</div>
					<div id="lfa-scholarships-preview-panel" class="lfa-scholarships__review-panel" aria-live="polite" tabindex="-1" hidden>
						<div class="lfa-scholarships__review-heading">
							<div>
								<span>LOCAL PREVIEW ONLY</span>
								<h4>Example details for review</h4>
							</div>
							<button type="button" data-lfa-scholarships-close-preview aria-label="Close review panel">&times;</button>
						</div>
						<p class="lfa-scholarships__review-disclaimer">This information is displayed only in your current browser view. It has not been sent, saved, or submitted.</p>
						<dl class="lfa-scholarships__review-grid">
							<div>
								<dt>Name</dt>
								<dd data-lfa-scholarships-review="applicant_name"></dd>
							</div>
							<div>
								<dt>Email</dt>
								<dd data-lfa-scholarships-review="email"></dd>
							</div>
							<div>
								<dt>Education level</dt>
								<dd data-lfa-scholarships-review="education_level"></dd>
							</div>
							<div>
								<dt>Demo program</dt>
								<dd data-lfa-scholarships-review="program"></dd>
							</div>
							<div>
								<dt>Area of study</dt>
								<dd data-lfa-scholarships-review="field_of_study"></dd>
							</div>
							<div class="lfa-scholarships__review-full">
								<dt>Statement</dt>
								<dd data-lfa-scholarships-review="statement"></dd>
							</div>
						</dl>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
