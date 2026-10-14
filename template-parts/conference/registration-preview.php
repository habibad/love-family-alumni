<?php
/** Static registration UI PREVIEW. No form is submitted, no payment is collected. */
if (!defined('ABSPATH')) { exit; }
?>
<section class="lfa-conf-registration lfa-conf-section" id="conference-registration" aria-labelledby="lfa-conf-registration-title">
  <div class="lfa-conf-wrap lfa-conf-registration__grid">
    <div class="lfa-conf-registration__info">
      <p class="lfa-conf-label">REGISTRATION INFORMATION</p>
      <h2 id="lfa-conf-registration-title">Your Place in the <em>Family Gathering.</em></h2>
      <p>Registration is not open yet. Ticket options, fees, attendee requirements and payment instructions will be shared by the conference organizers.</p>
      <div class="lfa-conf-registration__steps">
        <div><strong>01</strong><span>Official registration announcement</span></div>
        <div><strong>02</strong><span>Attendee details and options</span></div>
        <div><strong>03</strong><span>Secure payment, if applicable</span></div>
        <div><strong>04</strong><span>Registration confirmation</span></div>
      </div>
    </div>
    <div class="lfa-conf-registration__panel" aria-label="Registration form preview — unavailable">
      <div class="lfa-conf-registration__panel-head"><span>2027 CONFERENCE</span><span class="lfa-conf-status">Not yet open</span></div>
      <h3>Registration Preview</h3>
      <p>This illustrates the information the final registration flow may collect. It is not an active form.</p>
      <fieldset disabled class="lfa-conf-registration__fieldset">
        <label>Full name<input type="text" placeholder="Your full name" autocomplete="off"></label>
        <label>Email address<input type="email" placeholder="Your email address" autocomplete="off"></label>
        <label>Attendance option<select><option>Options to be announced</option></select></label>
        <button type="button" disabled>Registration Not Yet Available</button>
      </fieldset>
      <p class="lfa-conf-small-note">No information is submitted, saved or sent from this preview.</p>
    </div>
  </div>
</section>
