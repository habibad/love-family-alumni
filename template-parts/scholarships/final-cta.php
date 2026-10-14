<?php
/**
 * Scholarships — Final Call to Action Section (Task 03)
 * NO application form or live donation/payment link.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_page    = get_page_by_path( 'contact' );
$membership_page = get_page_by_path( 'membership' );
$has_contact     = $contact_page && get_post_status( $contact_page ) === 'publish';
$has_membership  = $membership_page && get_post_status( $membership_page ) === 'publish';

$secondary_url   = $has_contact ? get_permalink( $contact_page ) : ( $has_membership ? get_permalink( $membership_page ) : home_url( '/' ) );
$secondary_label = $has_contact ? 'Contact the Team' : ( $has_membership ? 'Explore Membership' : 'Back to Homepage' );
?>
<section id="scholarship-next-step" class="lfa-scholarships__final-cta" aria-labelledby="lfa-scholarships-cta-title">
	<div class="lfa-scholarships__container lfa-scholarships__cta-shell">
		<div class="lfa-scholarships__cta-art" aria-hidden="true">
			<div class="lfa-scholarships__cta-ring">
				<svg width="86" height="86" viewBox="0 0 100 100" fill="none">
					<path d="m50 10 12 24 26 4-19 19 4 27-23-13-23 13 4-27-19-19 26-4 12-24Z" stroke="currentColor" stroke-width="1.5"/>
					<circle cx="50" cy="49" r="16" stroke="currentColor" stroke-width="1.5"/>
					<path d="M42 49h16M50 41v16" stroke="currentColor" stroke-width="1.5"/>
				</svg>
			</div>
		</div>
		<div class="lfa-scholarships__cta-content">
			<span class="lfa-scholarships__cta-eyebrow">TOGETHER, WE CREATE OPPORTUNITY</span>
			<h2 id="lfa-scholarships-cta-title">The Future Is Something<br><em>We Build Together.</em></h2>
			<p>Discover the vision behind student support and stay connected as confirmed scholarship opportunities become available.</p>
			<span class="lfa-scholarships__cta-disclaimer">Scholarship applications and donation processing are not active on this page.</span>
		</div>
		<div class="lfa-scholarships__cta-actions">
			<a class="lfa-scholarships__cta-btn lfa-scholarships__cta-btn--white" href="#scholarship-programs">Explore Programs <span aria-hidden="true">&nearr;</span></a>
			<a class="lfa-scholarships__cta-btn lfa-scholarships__cta-btn--ghost" href="<?php echo esc_url( $secondary_url ); ?>"><?php echo esc_html( $secondary_label ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
	</div>
</section>
