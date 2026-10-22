<?php
/**
 * Template Name: LFA — Conference Index & Dynamic Multi-Conference Router
 * Description: Dynamic conference directory listing all published conferences,
 * while routing specific conference detail requests (including legacy 2027 and dynamic events).
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Check if a specific event is requested
$req_slug  = get_query_var( 'lfa_conf_slug' );
$req_event = sanitize_title( ! empty( $req_slug ) ? $req_slug : ( $_GET['event'] ?? '' ) );
$current_page_slug = get_post_field( 'post_name', get_post() );

// If viewing the child 2027 page, or event=2027 requested, render the dedicated 2027 conference view
if ( $current_page_slug === '2027' || $req_event === '2027' || $req_event === '2027-biennial-conference' ) {
	require get_template_directory() . '/templates/pages/page-conference-2027.php';
	return;
}

// If another specific event slug requested, render dynamic conference detail
if ( ! empty( $req_event ) ) {
	$conf = class_exists( 'LFA_Conference' ) ? LFA_Conference::get_conference( $req_event ) : null;
	if ( ! $conf ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( '404' );
		exit;
	}

	// Draft privacy check: guests cannot view draft conferences
	if ( $conf->published_status !== 'published' && ! current_user_can( 'lfa_manage_conferences' ) ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( '404' );
		exit;
	}

	$details  = json_decode( $conf->details_json ?: '{}', true ) ?: [];
	$tickets  = class_exists( 'LFA_Conference' ) ? LFA_Conference::get_ticket_types( (int) $conf->id, true ) : [];
	$speakers = class_exists( 'LFA_Conference' ) ? LFA_Conference::get_conference_speakers( (int) $conf->id, true ) : [];

	$keynote = null;
	$other_speakers = [];
	foreach ( $speakers as $spk ) {
		if ( ! $keynote && $spk->role === 'keynote' ) {
			$keynote = $spk;
		} else {
			$other_speakers[] = $spk;
		}
	}

	$is_logged_in  = is_user_logged_in();
	$current_uid   = get_current_user_id();
	$is_approved   = $is_logged_in && class_exists( 'LFA_Core' ) && LFA_Core::is_approved( $current_uid );
	$guest_allowed = (int) $conf->guest_registration_enabled === 1;

	$user = $is_logged_in ? wp_get_current_user() : null;
	$default_name  = $user ? $user->display_name : '';
	$default_email = $user ? $user->user_email : '';
	$default_phone = $is_logged_in ? (string) get_user_meta( $current_uid, 'lfa_phone', true ) : '';
	$default_chap  = $is_logged_in ? (string) get_user_meta( $current_uid, 'lfa_city', true ) : '';

	$detail_url = LFA_Conference::get_conference_url( $conf );

	get_header();
	?>
	<div class="conference-page-wrapper lfa-conference" aria-label="<?php echo esc_attr( $conf->title ); ?>">
		<section class="conference-hero-section" style="background:#071d3e; color:#fff; padding:90px 24px; text-align:center;">
			<div class="lfa-container" style="max-width:960px; margin:0 auto;">
				<?php if ( $conf->published_status === 'draft' ) : ?>
					<div style="background:#ffb900; color:#071d3e; display:inline-block; padding:6px 16px; border-radius:999px; font-weight:700; margin-bottom:20px; font-size:13px;">
						STAFF PREVIEW &mdash; DRAFT CONFERENCE
					</div>
				<?php endif; ?>
				<p class="hero-eyebrow" style="color:#c6953d; font-weight:700; letter-spacing:0.1em; text-transform:uppercase;">LOVE FAMILY ALUMNI &middot; NORTH AMERICA ZONE</p>
				<h1 style="font-size:clamp(2rem, 5vw, 3.5rem); margin:12px 0; color:#fff;"><?php echo esc_html( $conf->title ); ?></h1>
				<?php if ( ! empty( $conf->theme ) ) : ?>
					<p class="hero-theme" style="font-size:1.4rem; font-style:italic; color:#e2e8f0; margin-bottom:8px;">
						&ldquo;<?php echo esc_html( $conf->theme ); ?>&rdquo;
						<?php if ( ! empty( $conf->verse ) ) : ?>
							<span style="font-size:1.1rem; font-style:normal; font-weight:600; color:#c6953d;">&mdash; <?php echo esc_html( $conf->verse ); ?></span>
						<?php endif; ?>
					</p>
				<?php endif; ?>
				<div class="hero-meta" style="margin-top:24px; display:flex; justify-content:center; gap:24px; flex-wrap:wrap; font-size:1.05rem;">
					<span><strong>Dates:</strong> <?php echo esc_html( date( 'F j, Y', strtotime( $conf->starts_at ) ) . ' &ndash; ' . date( 'F j, Y', strtotime( $conf->ends_at ) ) ); ?></span>
					<span><strong>Location:</strong> <?php echo esc_html( $conf->location_summary ?: 'North America Zone TBA' ); ?></span>
				</div>
			</div>
		</section>

		<div class="lfa-container" style="max-width:1120px; margin:60px auto; padding:0 20px;">
			<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:36px; align-items:start;">
				<!-- Left Column: Details, Speakers & Program -->
				<div>
					<!-- About Card -->
					<div style="background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:32px; box-shadow:0 4px 12px rgba(7,29,62,0.04); margin-bottom:32px;">
						<h2 style="color:#071d3e; margin-top:0;">About This Gathering</h2>
						<p style="line-height:1.7; color:#475569;">
							Welcome to the official conference portal for the <strong><?php echo esc_html( $conf->title ); ?></strong>. Organized by the Love Family Alumni North America Zone for fellowship, connection, and spiritual enrichment.
						</p>

						<?php if ( ! empty( $details['venue_name'] ) ) : ?>
							<h3 style="color:#071d3e; margin-top:24px;">Venue &amp; Location</h3>
							<p style="color:#475569; line-height:1.6;"><?php echo esc_html( $details['venue_name'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $details['program_info'] ) ) : ?>
							<h3 style="color:#071d3e; margin-top:24px;">Program &amp; Schedule</h3>
							<p style="color:#475569; line-height:1.6;"><?php echo nl2br( esc_html( $details['program_info'] ) ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $details['hotel_info'] ) ) : ?>
							<h3 style="color:#071d3e; margin-top:24px;">Accommodation &amp; Hotel Details</h3>
							<p style="color:#475569; line-height:1.6;"><?php echo nl2br( esc_html( $details['hotel_info'] ) ); ?></p>
						<?php endif; ?>
					</div>

					<!-- Speakers & Keynote Section -->
					<div style="background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:32px; box-shadow:0 4px 12px rgba(7,29,62,0.04); margin-bottom:32px;">
						<div style="margin-bottom:24px;">
							<span style="font-size:12px; font-weight:700; color:#c6953d; text-transform:uppercase; letter-spacing:0.1em;">VOICES &amp; INSPIRATION</span>
							<h2 style="color:#071d3e; margin:6px 0 0 0;">Conference Speakers &amp; Keynotes</h2>
						</div>

						<?php if ( $keynote ) :
							$k_img = $keynote->image_id ? wp_get_attachment_image( $keynote->image_id, 'medium', false, [ 'style' => 'width:110px; height:110px; border-radius:50%; object-fit:cover; border:3px solid #c6953d;', 'alt' => esc_attr( $keynote->image_alt ?: $keynote->name ) ] ) : '';
						?>
							<!-- Featured Keynote Card -->
							<div class="keynote-featured-card" style="background:#fcfbf7; border:2px solid #c6953d; border-radius:14px; padding:24px; margin-bottom:28px;">
								<div style="display:flex; gap:20px; align-items:flex-start; flex-wrap:wrap;">
									<div>
										<?php if ( $k_img ) : ?>
											<?php echo $k_img; ?>
										<?php else : ?>
											<div style="width:100px; height:100px; border-radius:50%; background:#0a203a; color:#e5c170; display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:700;">
												✦
											</div>
										<?php endif; ?>
									</div>
									<div style="flex:1; min-width:260px;">
										<span style="background:#0a203a; color:#e5c170; font-size:11px; font-weight:700; padding:4px 10px; border-radius:999px; text-transform:uppercase; letter-spacing:0.05em;">CONFIRMED KEYNOTE</span>
										<h3 style="color:#071d3e; font-size:1.4rem; margin:8px 0 4px 0;"><?php echo esc_html( $keynote->name ); ?></h3>
										<?php if ( ! empty( $keynote->designation ) || ! empty( $keynote->organization ) ) : ?>
											<p style="color:#ab1640; font-weight:600; font-size:14px; margin:0 0 12px 0;">
												<?php echo esc_html( implode( ' &middot; ', array_filter( [ $keynote->designation, $keynote->organization ] ) ) ); ?>
											</p>
										<?php endif; ?>

										<h4 style="color:#071d3e; font-size:1.1rem; margin:14px 0 6px 0;">
											<?php echo esc_html( $keynote->keynote_title ?: 'Details to be announced' ); ?>
										</h4>
										<p style="color:#475569; font-size:14px; line-height:1.6; margin:0 0 10px 0;">
											<?php echo nl2br( esc_html( $keynote->keynote_abstract ?: 'Keynote ministry address and schedule details to be announced by the planning committee.' ) ); ?>
										</p>
										<?php if ( ! empty( $keynote->biography ) ) : ?>
											<p style="color:#64748b; font-size:13px; line-height:1.5; font-style:italic; margin:8px 0 0 0;">
												<?php echo esc_html( $keynote->biography ); ?>
											</p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<!-- Additional Speakers Grid -->
						<?php if ( ! empty( $other_speakers ) ) : ?>
							<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:20px; margin-top:20px;">
								<?php foreach ( $other_speakers as $s ) :
									$s_img = $s->image_id ? wp_get_attachment_image( $s->image_id, 'thumbnail', false, [ 'style' => 'width:64px; height:64px; border-radius:50%; object-fit:cover;', 'alt' => esc_attr( $s->image_alt ?: $s->name ) ] ) : '';
								?>
									<div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:18px; display:flex; gap:14px; align-items:flex-start;">
										<div>
											<?php if ( $s_img ) : ?>
												<?php echo $s_img; ?>
											<?php else : ?>
												<div style="width:56px; height:56px; border-radius:50%; background:#0a203a; color:#c6953d; display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700;">
													✦
												</div>
											<?php endif; ?>
										</div>
										<div style="flex:1;">
											<span style="font-size:10px; font-weight:700; background:#e2e8f0; color:#334155; padding:2px 8px; border-radius:4px; text-transform:uppercase;">
												<?php echo esc_html( strtoupper( $s->role ) ); ?>
											</span>
											<h4 style="margin:6px 0 2px 0; color:#071d3e; font-size:15px;"><?php echo esc_html( $s->name ); ?></h4>
											<small style="color:#64748b; display:block; margin-bottom:6px;"><?php echo esc_html( implode( ', ', array_filter( [ $s->designation, $s->organization ] ) ) ); ?></small>
											<?php if ( ! empty( $s->session_title ) ) : ?>
												<p style="font-size:12px; color:#475569; margin:4px 0 0 0;"><strong>Session:</strong> <?php echo esc_html( $s->session_title ); ?></p>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php elseif ( ! $keynote ) : ?>
							<p style="color:#64748b; font-size:14px; font-style:italic;">
								Confirmed keynote speakers, ministers, and program contributors will be announced following committee confirmation.
							</p>
						<?php endif; ?>
					</div>
				</div>

				<!-- Right Column: Registration Card -->
				<div>
					<div style="background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:32px; box-shadow:0 4px 12px rgba(7,29,62,0.04); position:sticky; top:100px;">
						<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
							<span style="font-size:12px; font-weight:700; color:#071d3e; text-transform:uppercase; letter-spacing:0.05em;">REGISTRATION</span>
							<?php if ( $conf->registration_status === 'open' && ! empty( $tickets ) ) : ?>
								<span style="background:#dcfce7; color:#166534; padding:4px 10px; border-radius:4px; font-weight:700; font-size:12px;">Registration Open</span>
							<?php else : ?>
								<span style="background:#f1f5f9; color:#64748b; padding:4px 10px; border-radius:4px; font-weight:700; font-size:12px;">Not yet open</span>
							<?php endif; ?>
						</div>

						<h3 style="color:#071d3e; margin-top:0; font-size:1.3rem;">Your Place in the Gathering</h3>

						<?php if ( $conf->registration_status === 'open' && ! empty( $tickets ) ) : ?>
							<?php if ( ! $is_logged_in && ! $guest_allowed ) :
								$login_redirect = add_query_arg( 'redirect_to', urlencode( $detail_url ), home_url( '/member-login/' ) );
							?>
								<p style="color:#475569; font-size:14px; line-height:1.6;">
									Registration for this conference is reserved for verified and approved alumni members. Please sign in to enroll.
								</p>
								<div style="margin-top:20px;">
									<a href="<?php echo esc_url( $login_redirect ); ?>" class="btn btn-crimson" style="display:block; text-align:center; padding:12px; border-radius:8px; font-weight:700; text-decoration:none; background:#ab1640; color:#fff;">
										Sign In to Register &rarr;
									</a>
								</div>
							<?php elseif ( $is_logged_in && ! $is_approved ) : ?>
								<div style="background:#fffbeb; border:1px solid #fde68a; padding:16px; border-radius:8px; margin:16px 0;">
									<strong style="color:#92400e; display:block; margin-bottom:6px;">Account Verification Required</strong>
									<p style="color:#78350f; font-size:13px; margin:0; line-height:1.5;">
										Your alumni membership application is currently undergoing administrator verification. You will be able to register once your account is approved.
									</p>
								</div>
								<a href="<?php echo esc_url( home_url( '/member-dashboard/' ) ); ?>" style="display:block; text-align:center; color:#071d3e; font-weight:600; text-decoration:none; font-size:14px; margin-top:10px;">Return to Dashboard &rarr;</a>
							<?php else : ?>
								<p style="color:#475569; font-size:14px; line-height:1.6;">
									Reserve your pass for the <strong><?php echo esc_html( $conf->title ); ?></strong>. Select your ticket tier and complete attendee details below.
								</p>

								<form id="lfa-conf-reg-form" style="display:grid; gap:16px; margin-top:20px;">
									<input type="hidden" name="conference_id" value="<?php echo (int) $conf->id; ?>">
									<div id="lfa-conf-reg-alert" style="display:none; padding:12px; border-radius:6px; font-size:13px;"></div>

									<label style="color:#0a203a; font-weight:700; font-size:13px; display:grid; gap:6px;">
										Ticket Category *
										<select name="ticket_type_id" id="lfa-reg-ticket-select" required style="border:1px solid #dae0e8; background:#fff; border-radius:6px; min-height:44px; padding:8px 12px; color:#0a203a; font-weight:600;">
											<option value="">-- Select an Approved Category --</option>
											<?php foreach ( $tickets as $t ) : ?>
												<option value="<?php echo esc_attr( $t->id ); ?>">
													<?php echo esc_html( $t->name ); ?> &mdash; $<?php echo esc_html( number_format( $t->amount_cents / 100, 2 ) ); ?> USD
												</option>
											<?php endforeach; ?>
										</select>
									</label>

									<label style="color:#0a203a; font-weight:700; font-size:13px; display:grid; gap:6px;">
										Primary Attendee Full Name *
										<input type="text" name="full_name" value="<?php echo esc_attr( $default_name ); ?>" required placeholder="Your full name" style="border:1px solid #dae0e8; background:#fff; border-radius:6px; min-height:44px; padding:8px 12px; color:#0a203a;">
									</label>

									<label style="color:#0a203a; font-weight:700; font-size:13px; display:grid; gap:6px;">
										Email Address *
										<input type="email" name="email" value="<?php echo esc_attr( $default_email ); ?>" required placeholder="Your email address" style="border:1px solid #dae0e8; background:#fff; border-radius:6px; min-height:44px; padding:8px 12px; color:#0a203a;">
									</label>

									<label style="color:#0a203a; font-weight:700; font-size:13px; display:grid; gap:6px;">
										Phone Number
										<input type="tel" name="phone" value="<?php echo esc_attr( $default_phone ); ?>" placeholder="Your telephone number" style="border:1px solid #dae0e8; background:#fff; border-radius:6px; min-height:44px; padding:8px 12px; color:#0a203a;">
									</label>

									<label style="color:#0a203a; font-weight:700; font-size:13px; display:grid; gap:6px;">
										Regional Chapter / State
										<input type="text" name="chapter" value="<?php echo esc_attr( $default_chap ); ?>" placeholder="e.g. Texas Chapter, Ontario, etc." style="border:1px solid #dae0e8; background:#fff; border-radius:6px; min-height:44px; padding:8px 12px; color:#0a203a;">
									</label>

									<label style="color:#0a203a; font-weight:700; font-size:13px; display:grid; gap:6px;">
										Dietary or Accessibility Needs
										<textarea name="dietary" rows="2" placeholder="None, vegetarian, wheelchair access, etc." style="border:1px solid #dae0e8; background:#fff; border-radius:6px; padding:8px 12px; color:#0a203a; resize:vertical;"></textarea>
									</label>

									<label style="color:#0a203a; font-weight:700; font-size:13px; display:grid; gap:6px;">
										Emergency Contact Name &amp; Phone
										<input type="text" name="emergency_contact" placeholder="Name and emergency phone number" style="border:1px solid #dae0e8; background:#fff; border-radius:6px; min-height:44px; padding:8px 12px; color:#0a203a;">
									</label>

									<label style="display:flex; align-items:flex-start; gap:10px; font-size:13px; color:#334155; margin-top:6px; cursor:pointer;">
										<input type="checkbox" name="consent_agreed" value="1" required style="margin-top:3px;">
										<span>I confirm attendance details and agree to Love Family Alumni conference policies and code of conduct.</span>
									</label>

									<button type="submit" id="lfa-conf-submit-btn" style="background:#ab1640; color:#fff; border:none; border-radius:6px; font-weight:750; padding:14px; font-size:15px; cursor:pointer; margin-top:8px;">
										Submit Conference Registration &rarr;
									</button>
								</form>

								<script>
								document.addEventListener('DOMContentLoaded', function() {
									var form = document.getElementById('lfa-conf-reg-form');
									if (!form) return;
									form.addEventListener('submit', function(e) {
										e.preventDefault();
										var btn = document.getElementById('lfa-conf-submit-btn');
										var alertBox = document.getElementById('lfa-conf-reg-alert');
										btn.disabled = true;
										btn.textContent = 'Processing Registration...';
										alertBox.style.display = 'none';

										var ticketId = parseInt(form.ticket_type_id.value, 10);
										var confId = parseInt(form.conference_id.value, 10);
										var payload = {
											conference_id: confId,
											ticket_type_id: ticketId,
											attendees: [{
												full_name: form.full_name.value.trim(),
												email: form.email.value.trim(),
												phone: form.phone.value.trim(),
												chapter: form.chapter.value.trim(),
												dietary_accessibility: form.dietary.value.trim(),
												emergency_contact: form.emergency_contact.value.trim(),
												consent_agreed: form.consent_agreed.checked ? 1 : 0
											}]
										};

										fetch('<?php echo esc_url( rest_url( 'lfa/v1/conference/register' ) ); ?>', {
											method: 'POST',
											headers: {
												'Content-Type': 'application/json',
												'X-WP-Nonce': '<?php echo wp_create_nonce( 'wp_rest' ); ?>'
											},
											body: JSON.stringify(payload)
										})
										.then(function(res) { return res.json(); })
										.then(function(data) {
											if (data.success) {
												form.style.display = 'none';
												alertBox.style.display = 'block';
												alertBox.style.background = '#dcfce7';
												alertBox.style.color = '#166534';
												alertBox.style.border = '1px solid #bbf7d0';
												alertBox.innerHTML = '<strong>Registration Created: #' + data.registration_number + '</strong><br>'
													+ 'Status: <em>Awaiting Payment</em> &middot; Invoice Amount: $' + data.amount_dollars + ' USD.<br><br>'
													+ '<a href="<?php echo esc_url( home_url( '/member-dashboard/#conference' ) ); ?>" style="display:inline-block; background:#0f2942; color:#fff; padding:8px 16px; border-radius:4px; text-decoration:none; font-weight:700;">View in Member Dashboard &rarr;</a>';
											} else {
												btn.disabled = false;
												btn.textContent = 'Submit Conference Registration \u2192';
												alertBox.style.display = 'block';
												alertBox.style.background = '#fee2e2';
												alertBox.style.color = '#991b1b';
												alertBox.style.border = '1px solid #fecaca';
												alertBox.textContent = data.message || 'Registration error occurred.';
											}
										})
										.catch(function(err) {
											btn.disabled = false;
											btn.textContent = 'Submit Conference Registration \u2192';
											alertBox.style.display = 'block';
											alertBox.style.background = '#fee2e2';
											alertBox.style.color = '#991b1b';
											alertBox.textContent = 'Network error submitting registration. Please try again.';
										});
									});
								});
								</script>
							<?php endif; ?>

						<?php else : ?>
							<!-- Registration Closed / Pending Notice -->
							<p style="color:#64748b; font-size:14px; line-height:1.6;">
								Official delegate registration, pricing packages, and attendee policies are currently pending planning committee confirmation. Please check back soon or monitor alumni newsletters.
							</p>

							<h4 style="margin-top:20px; color:#071d3e; font-size:14px;">Ticket Categories</h4>
							<?php if ( empty( $tickets ) ) : ?>
								<p style="color:#64748b; font-size:13px; font-style:italic;">Ticket categories and delegate fees are currently pending committee announcement.</p>
							<?php else : ?>
								<ul style="list-style:none; padding:0; margin:0 0 20px 0;">
									<?php foreach ( $tickets as $t ) : ?>
										<li style="border-bottom:1px solid #f1f5f9; padding:8px 0; display:flex; justify-content:space-between; font-size:13px;">
											<span><strong><?php echo esc_html( $t->name ); ?></strong></span>
											<span style="font-weight:700; color:#071d3e;">
												<?php echo is_null( $t->amount_cents ) ? 'TBA' : '$' . number_format( $t->amount_cents / 100, 2 ); ?>
											</span>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

							<fieldset disabled style="border:none; padding:0; margin:20px 0 0 0; opacity:0.6;">
								<button type="button" disabled style="width:100%; padding:12px; background:#e2e8f0; color:#64748b; border:none; border-radius:6px; font-weight:700; cursor:not-allowed;">
									Registration Not Yet Available
								</button>
							</fieldset>
						<?php endif; ?>

						<hr style="border:none; border-top:1px solid #f1f5f9; margin:24px 0;">

						<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" style="display:block; text-align:center; padding:8px; color:#071d3e; font-weight:600; text-decoration:none; font-size:14px;">
							&larr; View All Conferences
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	get_footer();
	return;
}

// 2. Default View: Public Dynamic Conference Index Listing
get_header();

$published_conferences = class_exists( 'LFA_Conference' ) ? LFA_Conference::get_all_conferences( true ) : [];
?>

<div class="conference-index-page lfa-conference-index" aria-label="Conferences Index">
	<!-- Hero Section -->
	<section class="conference-index-hero" style="background:#071d3e; color:#fff; padding:80px 24px; text-align:center;">
		<div class="lfa-container" style="max-width:880px; margin:0 auto;">
			<p style="color:#c6953d; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; font-size:13px; margin-bottom:12px;">LOVE FAMILY ALUMNI &middot; NORTH AMERICA ZONE</p>
			<h1 style="font-size:clamp(2.2rem, 5vw, 3.8rem); margin:0 0 16px 0; color:#fff; font-family:'Playfair Display', serif;">Conferences &amp; <em>Gatherings.</em></h1>
			<p style="font-size:1.15rem; color:#cbd5e1; line-height:1.7; max-width:680px; margin:0 auto;">
				Connecting our alumni family across borders through fellowship, inspiring keynote addresses, leadership development, and celebration of our shared UNIBEN roots.
			</p>
		</div>
	</section>

	<!-- Conferences Listing Section -->
	<section class="conference-index-list" style="padding:70px 20px; background:#f8fafc;">
		<div class="lfa-container" style="max-width:1100px; margin:0 auto;">
			<div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px; flex-wrap:wrap; gap:16px;">
				<div>
					<span style="font-size:12px; font-weight:700; color:#c6953d; text-transform:uppercase; letter-spacing:0.1em;">OUR CONFERENCES</span>
					<h2 style="font-size:2rem; color:#071d3e; margin:6px 0 0 0; font-family:'Playfair Display', serif;">Upcoming &amp; Official Events</h2>
				</div>
				<p style="color:#64748b; font-size:14px; margin:0;">Explore conference details, keynote speakers, and schedules.</p>
			</div>

			<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:32px;">
				<?php if ( empty( $published_conferences ) ) : ?>
					<div style="grid-column:1/-1; background:#fff; padding:40px; border-radius:16px; border:1px solid #e2e8f0; text-align:center;">
						<p style="color:#64748b; font-size:16px;">No published conferences found. Please check back soon.</p>
					</div>
				<?php else : foreach ( $published_conferences as $conf ) :
					$details = json_decode( $conf->details_json ?: '{}', true ) ?: [];
					$detail_url = LFA_Conference::get_conference_url( $conf );
				?>
					<article class="conference-card" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:18px; padding:32px; box-shadow:0 8px 24px rgba(7,29,62,0.05); display:flex; flex-direction:column; justify-content:space-between; transition:transform 0.2s ease, box-shadow 0.2s ease;">
						<div>
							<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
								<span style="background:rgba(198,149,61,0.12); color:#996c1b; font-size:11px; font-weight:700; text-transform:uppercase; padding:4px 10px; border-radius:999px;">
									<?php echo esc_html( substr( $conf->starts_at, 0, 4 ) ); ?> CONFERENCE
								</span>
								<span style="font-size:12px; font-weight:600; color:<?php echo $conf->registration_status === 'open' ? '#167a4a' : '#64748b'; ?>;">
									&bull; <?php echo $conf->registration_status === 'open' ? 'Registration Open' : 'Registration Closed'; ?>
								</span>
							</div>

							<h3 style="font-size:1.5rem; color:#071d3e; margin:0 0 10px 0; font-family:'Playfair Display', serif;">
								<a href="<?php echo esc_url( $detail_url ); ?>" style="color:inherit; text-decoration:none;">
									<?php echo esc_html( $conf->title ); ?>
								</a>
							</h3>

							<?php if ( ! empty( $conf->theme ) ) : ?>
								<p style="font-size:1.1rem; color:#c6953d; font-style:italic; font-weight:600; margin:0 0 14px 0;">
									&ldquo;<?php echo esc_html( $conf->theme ); ?>&rdquo;
									<?php if ( ! empty( $conf->verse ) ) : ?>
										<span style="font-size:0.95rem; font-style:normal; color:#64748b;">(<?php echo esc_html( $conf->verse ); ?>)</span>
									<?php endif; ?>
								</p>
							<?php endif; ?>

							<div style="margin:16px 0; font-size:14px; color:#475569; display:flex; flex-direction:column; gap:8px;">
								<div style="display:flex; align-items:center; gap:8px;">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c6953d" stroke-width="2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
									<span><strong>Dates:</strong> <?php echo esc_html( date( 'M j, Y', strtotime( $conf->starts_at ) ) . ' &ndash; ' . date( 'M j, Y', strtotime( $conf->ends_at ) ) ); ?></span>
								</div>
								<div style="display:flex; align-items:center; gap:8px;">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c6953d" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
									<span><strong>Venue:</strong> <?php echo esc_html( $conf->location_summary ?: 'North America Zone TBA' ); ?></span>
								</div>
								<?php if ( ! empty( $details['keynote_speaker'] ) ) : ?>
									<div style="display:flex; align-items:center; gap:8px;">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c6953d" stroke-width="2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
										<span><strong>Keynote:</strong> <?php echo esc_html( $details['keynote_speaker'] ); ?></span>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<div style="margin-top:24px; padding-top:20px; border-top:1px solid #f1f5f9;">
							<a href="<?php echo esc_url( $detail_url ); ?>" class="btn btn-crimson" style="display:block; text-align:center; padding:12px 20px; font-weight:600; text-decoration:none; border-radius:8px;">
								View Details &amp; Program &rarr;
							</a>
						</div>
					</article>
				<?php endforeach; endif; ?>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();
