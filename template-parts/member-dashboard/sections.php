<?php
/**
 * Member Dashboard — Account Panels & Sub-Views Template Part
 *
 * Views included:
 * - Alumni ID (fictional preview & clipboard action)
 * - Membership (Individual & Couple context)
 * - My Profile (in-browser review & reset demo)
 * - Dues & Receipts (illustrative records, no payment gateway)
 * - 2027 Conference (theme, scripture, registration not connected)
 * - My Businesses (fictional sample directory listings)
 * - Account Settings (preview-only communication preferences)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$data = $args['data'];
$m    = $data['member'];
$d    = $data['dues'];
$c    = $data['conference'];
?>
<!-- View 2: Alumni ID -->
<section class="lfa-dashboard__view" id="alumni-id" data-view-panel="alumni-id" aria-labelledby="lfa-id-heading" hidden>
  <div class="lfa-dashboard__page-heading">
    <p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">MEMBER IDENTITY</p>
    <h1 id="lfa-id-heading">My Alumni ID</h1>
    <p>A preview of your official alumni membership identification.</p>
  </div>
  <div class="lfa-dashboard__two-col">
    <div class="lfa-dashboard__card">
      <h3>Digital Membership Card</h3>
      <div class="lfa-dashboard__id-card">
        <div class="lfa-dashboard__id-card-head">
          <span>LOVE FAMILY ALUMNI<small>NORTH AMERICA ZONE</small></span>
          <b>DEMO</b>
        </div>
        <div class="lfa-dashboard__id-card-middle">
          <span class="lfa-dashboard__id-avatar" aria-hidden="true"><?php echo esc_html( $m['initials'] ); ?></span>
          <div>
            <small>MEMBER NAME</small>
            <strong><?php echo esc_html( $m['name'] ); ?></strong>
            <small>ALUMNI ID</small>
            <strong><?php echo esc_html( $m['id'] ); ?></strong>
          </div>
        </div>
        <div class="lfa-dashboard__id-card-foot">
          <span>ONE FAMILY. ACROSS BORDERS.</span>
          <span>PREVIEW ONLY</span>
        </div>
      </div>
      <button type="button" class="lfa-dashboard__btn lfa-dashboard__btn--outline" data-copy-id="<?php echo esc_attr( $m['id'] ); ?>">Copy Demo ID</button>
    </div>
    <div class="lfa-dashboard__card">
      <h3>About Your Alumni ID</h3>
      <p class="lfa-dashboard__muted">Every verified member can be associated with a unique alumni identifier. The ID shown here is a fictional example and is not valid proof of membership.</p>
      <div class="lfa-dashboard__info-row">
        <span>Identifier</span>
        <strong><?php echo esc_html( $m['id'] ); ?></strong>
      </div>
      <div class="lfa-dashboard__info-row">
        <span>Account status</span>
        <strong>Preview only</strong>
      </div>
      <div class="lfa-dashboard__info-row">
        <span>Verification</span>
        <strong>Not available in frontend</strong>
      </div>
      <button type="button" class="lfa-dashboard__text-action" data-go="membership">View Membership →</button>
    </div>
  </div>
</section>

<!-- View 3: Membership -->
<section class="lfa-dashboard__view" id="membership" data-view-panel="membership" aria-labelledby="lfa-membership-heading" hidden>
  <div class="lfa-dashboard__page-heading">
    <p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">MY MEMBERSHIP</p>
    <h1 id="lfa-membership-heading">Membership Overview</h1>
    <p>Your membership type and account information in one place.</p>
  </div>
  <div class="lfa-dashboard__three-stat">
    <div class="lfa-dashboard__stat">
      <span class="lfa-dashboard__stat-label">MEMBERSHIP TYPE</span>
      <strong><?php echo esc_html( $m['membership_type'] ); ?></strong>
    </div>
    <div class="lfa-dashboard__stat">
      <span class="lfa-dashboard__stat-label">STATUS</span>
      <strong>Active (demo)</strong>
    </div>
    <div class="lfa-dashboard__stat">
      <span class="lfa-dashboard__stat-label">RENEWAL DATE</span>
      <strong>To be confirmed</strong>
    </div>
  </div>
  <div class="lfa-dashboard__card">
    <h3>Individual & Couple Memberships</h3>
    <p class="lfa-dashboard__muted">This preview shows an illustrative Individual membership. Couple membership support is included in the future membership management requirements; spouse/partner records and pricing must follow approved policies.</p>
    <div class="lfa-dashboard__preview-note">Membership verification, renewals and changes require backend integration. This UI does not create or modify membership records.</div>
    <button type="button" class="lfa-dashboard__btn lfa-dashboard__btn--red" data-go="dues">View Dues & Receipts →</button>
  </div>
</section>

<!-- View 4: My Profile -->
<section class="lfa-dashboard__view" id="profile" data-view-panel="profile" aria-labelledby="lfa-profile-heading" hidden>
  <div class="lfa-dashboard__page-heading">
    <p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">PERSONAL DETAILS</p>
    <h1 id="lfa-profile-heading">My Profile</h1>
    <p>Explore how members will maintain their profile and alumni information.</p>
  </div>
  <form class="lfa-dashboard__card lfa-dashboard__profile-form" data-profile-form novalidate>
    <div class="lfa-dashboard__profile-banner">
      <span class="lfa-dashboard__profile-avatar" aria-hidden="true"><?php echo esc_html( $m['initials'] ); ?></span>
      <div>
        <h3>Profile Details</h3>
        <p>Changes are shown in this browser only and are never saved.</p>
      </div>
    </div>
    <div class="lfa-dashboard__field-grid">
      <label>Full Name 
        <input name="full_name" type="text" value="<?php echo esc_attr( $m['name'] ); ?>" required maxlength="90">
      </label>
      <label>Email Address 
        <input name="email" type="email" value="<?php echo esc_attr( $m['email'] ); ?>" required>
      </label>
      <label>Location 
        <input name="location" type="text" value="<?php echo esc_attr( $m['city'] ); ?>">
      </label>
      <label>Profession 
        <input name="profession" type="text" value="<?php echo esc_attr( $m['profession'] ); ?>">
      </label>
      <label class="lfa-dashboard__field-wide">Alumni Connection 
        <input name="affiliation" type="text" value="<?php echo esc_attr( $m['affiliation'] ); ?>">
      </label>
      <label class="lfa-dashboard__field-wide">Profile Visibility 
        <select name="visibility">
          <option>Public (preview)</option>
          <option selected>Members Only (preview)</option>
          <option>Private (preview)</option>
        </select>
      </label>
    </div>
    <div class="lfa-dashboard__preview-note">Directory privacy settings will require real access control before launch. This selector does not change who can view any information.</div>
    <div class="lfa-dashboard__form-actions">
      <button type="submit" class="lfa-dashboard__btn lfa-dashboard__btn--red">Review Changes (Demo)</button>
      <button type="reset" class="lfa-dashboard__btn lfa-dashboard__btn--outline">Reset</button>
    </div>
    <div class="lfa-dashboard__review" data-profile-review hidden aria-live="polite"></div>
  </form>
</section>

<!-- View 5: Dues & Receipts -->
<section class="lfa-dashboard__view" id="dues" data-view-panel="dues" aria-labelledby="lfa-dues-heading" hidden>
  <div class="lfa-dashboard__page-heading">
    <p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">PAYMENTS & RECORDS</p>
    <h1 id="lfa-dues-heading">Dues & Receipts</h1>
    <p>A frontend preview of membership dues, statements and payment history.</p>
  </div>
  <div class="lfa-dashboard__three-stat">
    <div class="lfa-dashboard__stat">
      <span class="lfa-dashboard__stat-label">ANNUAL MEMBERSHIP DUES</span>
      <strong>Amount TBC</strong>
    </div>
    <div class="lfa-dashboard__stat">
      <span class="lfa-dashboard__stat-label">NEXT DUE DATE</span>
      <strong>To be confirmed</strong>
    </div>
    <div class="lfa-dashboard__stat">
      <span class="lfa-dashboard__stat-label">PAYMENT GATEWAY</span>
      <strong>Not connected</strong>
    </div>
  </div>
  <div class="lfa-dashboard__card">
    <div class="lfa-dashboard__card-heading">
      <div>
        <h3>Transaction History</h3>
        <p class="lfa-dashboard__muted">Illustrative rows only. These are not completed transactions or real receipts.</p>
      </div>
      <span class="lfa-dashboard__sample-tag">DEMO</span>
    </div>
    <div class="lfa-dashboard__table-scroll">
      <table class="lfa-dashboard__table">
        <thead>
          <tr>
            <th scope="col">Reference</th>
            <th scope="col">Description</th>
            <th scope="col">Date</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $d['history'] as $row ) : ?>
          <tr>
            <td><?php echo esc_html( $row['reference'] ); ?></td>
            <td><?php echo esc_html( $row['description'] ); ?></td>
            <td><?php echo esc_html( $row['date'] ); ?></td>
            <td><?php echo esc_html( $row['amount'] ); ?></td>
            <td><span class="lfa-dashboard__table-demo"><?php echo esc_html( $row['status'] ); ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="lfa-dashboard__preview-note">Membership dues and donations are separate payment types. No receipt downloads, transactions or payment requests are enabled.</div>
    <a class="lfa-dashboard__text-action" href="<?php echo esc_url( home_url( '/membership/' ) ); ?>">Read Membership Information →</a>
  </div>
</section>

<!-- View 6: 2027 Conference -->
<section class="lfa-dashboard__view" id="conference" data-view-panel="conference" aria-labelledby="lfa-conference-heading" hidden>
  <div class="lfa-dashboard__page-heading">
    <p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">EVENT PARTICIPATION</p>
    <h1 id="lfa-conference-heading">2027 Conference</h1>
    <p>Conference information and your registration overview.</p>
  </div>
  <div class="lfa-dashboard__conference-banner">
    <p>LOVE FAMILY ALUMNI · NORTH AMERICA ZONE</p>
    <h2>THY KINGDOM COME</h2>
    <strong>MATTHEW 6:10</strong>
    <span>2027 CONFERENCE</span>
  </div>
  <div class="lfa-dashboard__two-col">
    <div class="lfa-dashboard__card">
      <h3>Conference Details</h3>
      <div class="lfa-dashboard__info-row">
        <span>Year</span>
        <strong>2027</strong>
      </div>
      <div class="lfa-dashboard__info-row">
        <span>Date</span>
        <strong>To be announced</strong>
      </div>
      <div class="lfa-dashboard__info-row">
        <span>Venue</span>
        <strong>To be announced</strong>
      </div>
      <a class="lfa-dashboard__btn lfa-dashboard__btn--red" href="<?php echo esc_url( home_url( '/conference/2027/' ) ); ?>">Conference Information ↗</a>
    </div>
    <div class="lfa-dashboard__card">
      <h3>My Registration</h3>
      <span class="lfa-dashboard__sample-tag">NOT CONNECTED</span>
      <p class="lfa-dashboard__muted">Conference registration and associated payments will be functional during the later backend phase. No booking or seat is reserved by this preview.</p>
      <div class="lfa-dashboard__preview-note">Status: Registration not submitted.</div>
    </div>
  </div>
</section>

<!-- View 7: My Businesses -->
<section class="lfa-dashboard__view" id="businesses" data-view-panel="businesses" aria-labelledby="lfa-businesses-heading" hidden>
  <div class="lfa-dashboard__page-heading">
    <p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">ALUMNI ENTREPRENEURS</p>
    <h1 id="lfa-businesses-heading">My Businesses</h1>
    <p>Preview the dashboard area for member-owned business listings.</p>
  </div>
  <div class="lfa-dashboard__card">
    <div class="lfa-dashboard__card-heading">
      <div>
        <h3>Business Listings</h3>
        <p class="lfa-dashboard__muted">These sample companies are fictional and are not listed publicly.</p>
      </div>
      <span class="lfa-dashboard__sample-tag">2 DEMO LISTINGS</span>
    </div>
    <div class="lfa-dashboard__business-grid">
      <?php foreach ( $data['businesses'] as $idx => $business ) : ?>
      <div class="lfa-dashboard__business">
        <span class="lfa-dashboard__business-icon" aria-hidden="true">▥</span>
        <div>
          <strong><?php echo esc_html( $business['title'] ); ?></strong>
          <span><?php echo esc_html( $business['category'] ); ?></span>
          <small><?php echo esc_html( $business['status'] ); ?></small>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <button type="button" class="lfa-dashboard__btn lfa-dashboard__btn--red" data-unavailable="Business submission is a frontend preview. No company has been submitted.">Add Business (Preview) <span aria-hidden="true">＋</span></button>
    <div class="lfa-dashboard__preview-note">Member-owned business submission, ownership verification and administrator approval will be added during backend development.</div>
  </div>
</section>

<!-- View 8: Account Settings -->
<section class="lfa-dashboard__view" id="settings" data-view-panel="settings" aria-labelledby="lfa-settings-heading" hidden>
  <div class="lfa-dashboard__page-heading">
    <p class="lfa-dashboard__eyebrow lfa-dashboard__eyebrow--red">MY ACCOUNT</p>
    <h1 id="lfa-settings-heading">Account Settings</h1>
    <p>Preview of account preferences and directory privacy options.</p>
  </div>
  <div class="lfa-dashboard__card lfa-dashboard__settings-card">
    <h3>Communication Preferences</h3>
    <p class="lfa-dashboard__muted">These toggles only update a local preview. Nothing is saved or sent.</p>
    <label class="lfa-dashboard__setting">
      <span>
        <strong>Community announcements</strong>
        <small>Updates about community news and milestones</small>
      </span>
      <input type="checkbox" checked data-setting="announcements">
    </label>
    <label class="lfa-dashboard__setting">
      <span>
        <strong>Event notifications</strong>
        <small>News about events and conferences</small>
      </span>
      <input type="checkbox" data-setting="events">
    </label>
    <label class="lfa-dashboard__setting">
      <span>
        <strong>Membership reminders</strong>
        <small>Upcoming dues and renewal notifications</small>
      </span>
      <input type="checkbox" checked data-setting="reminders">
    </label>
    <div class="lfa-dashboard__preview-note" data-settings-preview>Preview settings only. Your selections will not persist.</div>
  </div>
  <div class="lfa-dashboard__card lfa-dashboard__settings-card">
    <h3>Security & Privacy</h3>
    <div class="lfa-dashboard__info-row">
      <span>Password management</span>
      <strong>Backend required</strong>
    </div>
    <div class="lfa-dashboard__info-row">
      <span>Directory access controls</span>
      <strong>Backend required</strong>
    </div>
    <button type="button" class="lfa-dashboard__btn lfa-dashboard__btn--outline" data-unavailable="Password management is not available in this static preview.">Change Password (Preview)</button>
  </div>
</section>
