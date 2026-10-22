<?php
/**
 * Conference 2027 — Dynamic Registration Section
 *
 * Connects the approved frontend registration UI to authoritative WordPress data.
 * Safe default: displays "Not yet open" notice until registration is opened and ticket fees configured.
 *
 * @package Love_Family_Theme
 */

if (!defined('ABSPATH')) { exit; }

$conf = $args['conference'] ?? (class_exists('LFA_Conference') ? LFA_Conference::get_conference() : null);
$is_open = $conf && $conf->registration_status === 'open';
$tickets = ($conf && class_exists('LFA_Conference')) ? LFA_Conference::get_ticket_types((int)$conf->id, true) : [];
$has_tickets = !empty($tickets);

$is_logged_in = is_user_logged_in();
$current_uid  = get_current_user_id();
$is_approved  = $is_logged_in && class_exists('LFA_Core') && LFA_Core::is_approved($current_uid);
$guest_allowed = $conf && (int)$conf->guest_registration_enabled === 1;
$detail_url = $conf ? LFA_Conference::get_conference_url($conf) : home_url('/conference/2027/');

$user = $is_logged_in ? wp_get_current_user() : null;
$default_name  = $user ? $user->display_name : '';
$default_email = $user ? $user->user_email : '';
$default_phone = $is_logged_in ? (string)get_user_meta($current_uid, 'lfa_phone', true) : '';
$default_chap  = $is_logged_in ? (string)get_user_meta($current_uid, 'lfa_city', true) : '';

$gateway_enabled = class_exists('LFA_PayPal_Settings') && LFA_PayPal_Settings::is_payments_enabled();
?>
<section class="lfa-conf-registration lfa-conf-section" id="conference-registration" aria-labelledby="lfa-conf-registration-title">
  <div class="lfa-conf-wrap lfa-conf-registration__grid">
    <div class="lfa-conf-registration__info">
      <p class="lfa-conf-label">REGISTRATION INFORMATION</p>
      <h2 id="lfa-conf-registration-title">Your Place in the <em>Family Gathering.</em></h2>
      
      <?php if ($is_open && $has_tickets) : ?>
        <p>Registration for the 2027 Love Family Alumni Biennial Conference is now active. Please select your attendance category and complete your registration details below.</p>
      <?php else : ?>
        <p>Registration is not open yet. Ticket options, fees, attendee requirements and payment instructions will be shared once finalized by the conference organizers.</p>
      <?php endif; ?>

      <div class="lfa-conf-registration__steps">
        <div><strong>01</strong><span>Official registration announcement</span></div>
        <div><strong>02</strong><span>Attendee details and options</span></div>
        <div><strong>03</strong><span>Secure payment, if applicable</span></div>
        <div><strong>04</strong><span>Registration confirmation</span></div>
      </div>
    </div>

    <div class="lfa-conf-registration__panel" aria-label="Conference Registration Panel">
      <div class="lfa-conf-registration__panel-head">
        <span>2027 CONFERENCE</span>
        <?php if ($is_open && $has_tickets) : ?>
          <span class="lfa-conf-status" style="background:#dcfce7;color:#166534;padding:4px 10px;border-radius:4px;font-weight:700;">Registration Open</span>
        <?php else : ?>
          <span class="lfa-conf-status">Not yet open</span>
        <?php endif; ?>
      </div>

      <?php if ($is_open && $has_tickets) : 
        $eligibility = class_exists('LFA_Payment_Entitlements') 
            ? LFA_Payment_Entitlements::get_conference_eligibility_state($current_uid)
            : ['eligible' => false, 'state' => 'guest', 'title' => 'Membership Required', 'message' => 'Conference registration is available exclusively to active Love Family Alumni members.', 'primary_cta' => ['label' => 'Member Login', 'url' => home_url('/member-login/')], 'secondary_cta' => ['label' => 'Become a Member', 'url' => home_url('/membership/')]];
      ?>
        <?php if (empty($eligibility['eligible'])) : ?>
          <h3><?php echo esc_html($eligibility['title']); ?></h3>
          <p style="color:#475569;font-size:15px;line-height:1.6;margin-top:8px;"><?php echo esc_html($eligibility['message']); ?></p>
          <div style="margin-top:24px;display:flex;flex-wrap:wrap;gap:12px;align-items:center;">
            <?php if (!empty($eligibility['primary_cta'])) : ?>
              <a href="<?php echo esc_url($eligibility['primary_cta']['url']); ?>" class="lfa-conf-btn lfa-conf-btn--crimson" style="display:inline-flex;padding:12px 24px;border-radius:6px;font-weight:700;text-decoration:none;background:#ab1640;color:#fff;">
                <?php echo esc_html($eligibility['primary_cta']['label']); ?> &rarr;
              </a>
            <?php endif; ?>
            <?php if (!empty($eligibility['secondary_cta'])) : ?>
              <a href="<?php echo esc_url($eligibility['secondary_cta']['url']); ?>" style="display:inline-flex;padding:12px 24px;border-radius:6px;font-weight:700;text-decoration:none;background:#f8fafc;color:#0f2942;border:1px solid #cbd5e1;">
                <?php echo esc_html($eligibility['secondary_cta']['label']); ?>
              </a>
            <?php endif; ?>
          </div>
        <?php else : ?>
          <h3>Register for <?php echo esc_html($conf->title); ?></h3>
          <p>Reserve your pass for the gathering. Review attendance details before submitting.</p>

          <form id="lfa-conf-reg-form" style="display:grid;gap:16px;">
            <input type="hidden" name="conference_id" value="<?php echo (int)$conf->id; ?>">
            <div id="lfa-conf-reg-alert" style="display:none;padding:12px;border-radius:6px;font-size:13px;"></div>

            <label style="color:#0a203a;font-weight:700;font-size:13px;display:grid;gap:6px;">
              Ticket Category *
              <select name="ticket_type_id" id="lfa-reg-ticket-select" required style="border:1px solid #dae0e8;background:#fff;border-radius:6px;min-height:44px;padding:8px 12px;color:#0a203a;font-weight:600;">
                <option value="">-- Select an Approved Category --</option>
                <?php foreach ($tickets as $t) : ?>
                  <option value="<?php echo esc_attr($t->id); ?>">
                    <?php echo esc_html($t->name); ?> &mdash; $<?php echo esc_html(number_format($t->amount_cents / 100, 2)); ?> USD
                  </option>
                <?php endforeach; ?>
              </select>
            </label>

            <label style="color:#0a203a;font-weight:700;font-size:13px;display:grid;gap:6px;">
              Primary Attendee Full Name *
              <input type="text" name="full_name" value="<?php echo esc_attr($default_name); ?>" required placeholder="Your full name" style="border:1px solid #dae0e8;background:#fff;border-radius:6px;min-height:44px;padding:8px 12px;color:#0a203a;">
            </label>

            <label style="color:#0a203a;font-weight:700;font-size:13px;display:grid;gap:6px;">
              Email Address *
              <input type="email" name="email" value="<?php echo esc_attr($default_email); ?>" required placeholder="Your email address" style="border:1px solid #dae0e8;background:#fff;border-radius:6px;min-height:44px;padding:8px 12px;color:#0a203a;">
            </label>

            <label style="color:#0a203a;font-weight:700;font-size:13px;display:grid;gap:6px;">
              Phone Number
              <input type="tel" name="phone" value="<?php echo esc_attr($default_phone); ?>" placeholder="Your telephone number" style="border:1px solid #dae0e8;background:#fff;border-radius:6px;min-height:44px;padding:8px 12px;color:#0a203a;">
            </label>

            <label style="color:#0a203a;font-weight:700;font-size:13px;display:grid;gap:6px;">
              Regional Chapter / State
              <input type="text" name="chapter" value="<?php echo esc_attr($default_chap); ?>" placeholder="e.g. Texas Chapter, Ontario, etc." style="border:1px solid #dae0e8;background:#fff;border-radius:6px;min-height:44px;padding:8px 12px;color:#0a203a;">
            </label>

            <label style="color:#0a203a;font-weight:700;font-size:13px;display:grid;gap:6px;">
              Dietary or Accessibility Needs
              <textarea name="dietary" rows="2" placeholder="None, vegetarian, wheelchair access, etc." style="border:1px solid #dae0e8;background:#fff;border-radius:6px;padding:8px 12px;color:#0a203a;resize:vertical;"></textarea>
            </label>

            <label style="color:#0a203a;font-weight:700;font-size:13px;display:grid;gap:6px;">
              Emergency Contact Name &amp; Phone
              <input type="text" name="emergency_contact" placeholder="Name and emergency phone number" style="border:1px solid #dae0e8;background:#fff;border-radius:6px;min-height:44px;padding:8px 12px;color:#0a203a;">
            </label>

            <label style="display:flex;align-items:flex-start;gap:10px;font-size:13px;color:#334155;margin-top:6px;cursor:pointer;">
              <input type="checkbox" name="consent_agreed" value="1" required style="margin-top:3px;">
              <span>I confirm attendance details and agree to Love Family Alumni conference policies and code of conduct.</span>
            </label>

            <button type="submit" id="lfa-conf-submit-btn" style="background:#ab1640;color:#fff;border:none;border-radius:6px;font-weight:750;padding:14px;font-size:15px;cursor:pointer;margin-top:8px;">
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

              fetch('<?php echo esc_url(rest_url("lfa/v1/conference/register")); ?>', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-WP-Nonce': '<?php echo wp_create_nonce("wp_rest"); ?>'
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
                    + '<a href="<?php echo esc_url(home_url("/member-dashboard/#conference")); ?>" style="display:inline-block;background:#0f2942;color:#fff;padding:8px 16px;border-radius:4px;text-decoration:none;font-weight:700;">View in Member Dashboard &rarr;</a>';
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
        <!-- Default Safe Preview / Not Open -->
        <h3>Registration Preview</h3>
        <p>This illustrates the information the final registration flow will collect once registration is officially announced. It is not currently accepting entries.</p>
        <fieldset disabled class="lfa-conf-registration__fieldset">
          <label>Full name<input type="text" placeholder="Your full name" autocomplete="off"></label>
          <label>Email address<input type="email" placeholder="Your email address" autocomplete="off"></label>
          <label>Attendance option<select><option>Options to be announced (Pending Committee Confirmation)</option></select></label>
          <button type="button" disabled>Registration Not Yet Available</button>
        </fieldset>
        <p class="lfa-conf-small-note">No information is submitted, saved or sent from this preview while policies are pending.</p>
      <?php endif; ?>
    </div>
  </div>
</section>
