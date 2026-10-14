<?php
/**
 * Contact Us — Main Contact Form Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form_data     = $args['data']['form_section'] ?? [];
$info_panel    = $form_data['info_panel'] ?? [];
$inquiry_types = $form_data['inquiry_types'] ?? [];
?>

<section id="contact-form" class="lfa-contact__form-section" aria-labelledby="lfa-contact-form-heading">
	<div class="lfa-contact__container">
		
		<!-- Section Header -->
		<div class="lfa-contact__section-header text-center">
			<div class="lfa-contact__eyebrow lfa-contact__eyebrow--crimson">START A CONVERSATION</div>
			<h2 id="lfa-contact-form-heading" class="lfa-contact__section-heading">
				<?php echo esc_html( $form_data['heading'] ?? 'Start a Conversation With Us.' ); ?>
			</h2>
			<p class="lfa-contact__section-lead">
				<?php echo esc_html( $form_data['description'] ?? "Whether you're reconnecting with the alumni family, asking about membership, or exploring ways to contribute, we'd love to hear from you." ); ?>
			</p>
		</div>

		<!-- Two-column Asymmetrical Form Composition -->
		<div class="lfa-contact__form-grid">
			
			<!-- Left Panel: Dark Navy Information & Emblem Card -->
			<div class="lfa-contact__form-info-panel">
				<div class="panel-eyebrow lfa-gold">
					<?php echo esc_html( $info_panel['eyebrow'] ?? 'GET IN TOUCH' ); ?>
				</div>
				<h3 class="panel-heading">
					<?php echo esc_html( $info_panel['heading'] ?? "Let's Keep the Conversation Going." ); ?>
				</h3>
				<p class="panel-lead">
					<?php echo esc_html( $info_panel['body'] ?? "We welcome your inquiries, feedback, and stories. Reach out to our team and we'll ensure your message is directed to the right alumni representative." ); ?>
				</p>

				<hr class="panel-divider">

				<!-- Direct Communication Points -->
				<div class="panel-details-list">
					<div class="detail-item">
						<span class="detail-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
						</span>
						<div class="detail-text">
							<span class="detail-label">Official Inquiries</span>
							<a href="mailto:<?php echo esc_attr( $info_panel['email'] ); ?>" class="detail-link">
								<?php echo esc_html( $info_panel['email'] ); ?>
							</a>
						</div>
					</div>

					<div class="detail-item">
						<span class="detail-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="12" cy="12" r="10"></circle>
								<line x1="2" y1="12" x2="22" y2="12"></line>
								<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
							</svg>
						</span>
						<div class="detail-text">
							<span class="detail-label">Service Region</span>
							<span class="detail-val"><?php echo esc_html( $info_panel['region'] ); ?></span>
						</div>
					</div>
				</div>

				<!-- Decorative Motto Block -->
				<div class="panel-motto-box">
					<div class="motto-crest" aria-hidden="true">
						<img src="<?php echo esc_url( lfa_image_url( 'brand-logo-source.jpg' ) ); ?>" alt="" width="36" height="36" class="motto-crest-img">
					</div>
					<div class="motto-quote">
						&ldquo;<?php echo esc_html( $info_panel['motto'] ?? 'One Family. Across Borders. Impacting Generations.' ); ?>&rdquo;
					</div>
				</div>
			</div>

			<!-- Right Panel: Clean White Form Surface -->
			<div class="lfa-contact__form-card">
				<form id="lfa-contact-form" class="lfa-contact__form" novalidate aria-label="Alumni Contact Form">
					
					<!-- Form Header Notice -->
					<div class="lfa-contact__form-notice" role="note">
						<svg class="notice-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<circle cx="12" cy="12" r="10"></circle>
							<line x1="12" y1="16" x2="12" y2="12"></line>
							<line x1="12" y1="8" x2="12.01" y2="8"></line>
						</svg>
						<span class="notice-text">
							<?php echo esc_html( $form_data['notice'] ?? 'This is a frontend preview. Messages are not being sent yet.' ); ?>
						</span>
					</div>

					<div class="form-row form-row--two-col">
						<!-- Full Name -->
						<div class="form-group" id="group-name">
							<label for="contact-name" class="form-label">
								Full Name <span class="required" aria-hidden="true">*</span>
							</label>
							<input type="text" 
							       id="contact-name" 
							       name="fullName" 
							       class="form-control" 
							       placeholder="e.g. Samuel Adebayo" 
							       required 
							       aria-required="true"
							       aria-describedby="error-name">
							<span class="field-error" id="error-name" role="alert" aria-live="polite"></span>
						</div>

						<!-- Email Address -->
						<div class="form-group" id="group-email">
							<label for="contact-email" class="form-label">
								Email Address <span class="required" aria-hidden="true">*</span>
							</label>
							<input type="email" 
							       id="contact-email" 
							       name="emailAddress" 
							       class="form-control" 
							       placeholder="e.g. samuel@example.com" 
							       required 
							       aria-required="true"
							       aria-describedby="error-email">
							<span class="field-error" id="error-email" role="alert" aria-live="polite"></span>
						</div>
					</div>

					<div class="form-row form-row--two-col">
						<!-- Phone Number (Optional) -->
						<div class="form-group" id="group-phone">
							<label for="contact-phone" class="form-label">
								Phone Number <span class="optional">(Optional)</span>
							</label>
							<input type="tel" 
							       id="contact-phone" 
							       name="phoneNumber" 
							       class="form-control" 
							       placeholder="e.g. +1 (555) 019-2834"
							       aria-describedby="error-phone">
							<span class="field-error" id="error-phone" role="alert" aria-live="polite"></span>
						</div>

						<!-- Inquiry Type -->
						<div class="form-group" id="group-inquiry">
							<label for="contact-inquiry" class="form-label">
								Inquiry Type <span class="required" aria-hidden="true">*</span>
							</label>
							<div class="select-wrapper">
								<select id="contact-inquiry" 
								        name="inquiryType" 
								        class="form-control" 
								        required 
								        aria-required="true"
								        aria-describedby="error-inquiry">
									<option value="" disabled selected>Please select an inquiry type...</option>
									<?php foreach ( $inquiry_types as $type ) : ?>
										<option value="<?php echo esc_attr( $type ); ?>"><?php echo esc_html( $type ); ?></option>
									<?php endforeach; ?>
								</select>
								<svg class="select-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
							</div>
							<span class="field-error" id="error-inquiry" role="alert" aria-live="polite"></span>
						</div>
					</div>

					<!-- Subject -->
					<div class="form-group" id="group-subject">
						<label for="contact-subject" class="form-label">
							Subject <span class="required" aria-hidden="true">*</span>
						</label>
						<input type="text" 
						       id="contact-subject" 
						       name="subject" 
						       class="form-control" 
						       placeholder="Brief summary of your inquiry" 
						       required 
						       aria-required="true"
						       aria-describedby="error-subject">
						<span class="field-error" id="error-subject" role="alert" aria-live="polite"></span>
					</div>

					<!-- Message Textarea -->
					<div class="form-group" id="group-message">
						<div class="form-label-row">
							<label for="contact-message" class="form-label">
								Message <span class="required" aria-hidden="true">*</span>
							</label>
							<span class="char-counter" aria-live="polite" aria-atomic="true">
								<span id="char-current">0</span> / 1000 characters
							</span>
						</div>
						<textarea id="contact-message" 
						          name="message" 
						          class="form-control" 
						          rows="5" 
						          maxlength="1000" 
						          placeholder="Please write your message here..." 
						          required 
						          aria-required="true"
						          aria-describedby="error-message"></textarea>
						<span class="field-error" id="error-message" role="alert" aria-live="polite"></span>
					</div>

					<!-- Form Actions -->
					<div class="form-actions-row">
						<button type="submit" id="contact-submit-btn" class="btn btn-crimson lfa-contact__btn-submit">
							<span>Review Message (Preview)</span>
							<svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						</button>

						<button type="button" id="contact-reset-btn" class="btn btn-outline-dark lfa-contact__btn-reset">
							<span>Clear Form</span>
						</button>
					</div>

				</form>
			</div>

		</div>

	</div>

	<!-- Browser-based Small Review Modal / Panel (Frontend Only) -->
	<div id="contact-review-modal" class="lfa-contact__modal" role="dialog" aria-modal="true" aria-labelledby="modal-contact-title" hidden>
		<div class="lfa-contact__modal-backdrop" id="contact-modal-backdrop"></div>
		<div class="lfa-contact__modal-content">
			<button type="button" class="lfa-contact__modal-close" id="contact-modal-close-x" aria-label="Close message preview">&times;</button>
			
			<div class="lfa-contact__modal-header">
				<span class="badge-preview-tag">FRONTEND PREVIEW ONLY</span>
				<h3 id="modal-contact-title" class="lfa-contact__modal-title">Review Message Details</h3>
				<p class="lfa-contact__modal-lead">Review your message before simulated submission. Zero data has been sent.</p>
			</div>

			<div class="lfa-contact__modal-body">
				<div class="preview-field-row">
					<span class="preview-label">Full Name:</span>
					<strong class="preview-value" id="modal-val-name">—</strong>
				</div>
				<div class="preview-field-row">
					<span class="preview-label">Email Address:</span>
					<strong class="preview-value" id="modal-val-email">—</strong>
				</div>
				<div class="preview-field-row">
					<span class="preview-label">Phone Number:</span>
					<span class="preview-value" id="modal-val-phone">—</span>
				</div>
				<div class="preview-field-row">
					<span class="preview-label">Inquiry Type:</span>
					<strong class="preview-value text-crimson" id="modal-val-inquiry">—</strong>
				</div>
				<div class="preview-field-row">
					<span class="preview-label">Subject:</span>
					<strong class="preview-value" id="modal-val-subject">—</strong>
				</div>
				<div class="preview-field-row preview-field-row--block">
					<span class="preview-label">Message Content:</span>
					<div class="preview-message-box" id="modal-val-message">—</div>
				</div>

				<div class="lfa-contact__modal-notice">
					<p><strong>Notice:</strong> This is a static frontend demonstration. No email has been sent, no server connection was initiated, and no database records were saved. Official messaging will be activated in the next development phase.</p>
				</div>
			</div>

			<div class="lfa-contact__modal-footer">
				<button type="button" class="btn btn-outline-dark" id="contact-modal-edit-btn">
					&larr; Edit Details
				</button>
				<button type="button" class="btn btn-crimson" id="contact-modal-done-btn">
					Close Preview
				</button>
			</div>
		</div>
	</div>

</section>
