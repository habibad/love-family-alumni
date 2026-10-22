<?php
/**
 * Conference 2027 — Overview Section (Task 01 confirmed facts only)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$conf = class_exists( 'LFA_Conference' ) ? LFA_Conference::get_conference_by_id( 1 ) : null;
$year  = '2027';
$theme = 'Thy Kingdom Come';
$dates = 'September 16–19, 2027';
$venue = 'North America Zone (Host City TBA)';

if ( $conf ) {
	$theme = $conf->theme ?: $theme;
	$venue = $conf->location_summary ?: $venue;
	if ( ! empty( $conf->starts_at ) ) {
		$start_ts = strtotime( $conf->starts_at );
		$end_ts   = ! empty( $conf->ends_at ) ? strtotime( $conf->ends_at ) : $start_ts;
		$year     = date( 'Y', $start_ts );
		$dates    = date_i18n( 'F j', $start_ts ) . '–' . date_i18n( 'j, Y', $end_ts );
	}
}
?>

<section id="conference-details" class="lfa-conf-overview" aria-labelledby="lfa-conf-overview-title">
	<div class="lfa-container lfa-conf-overview__container">
		<div class="lfa-conf-overview__inner">
			
			<div class="lfa-conf-overview__intro">
				<p class="lfa-conf-section-label">CONFERENCE AT A GLANCE</p>
				<h2 id="lfa-conf-overview-title" class="lfa-conf-overview__title">One Family. One Purpose.</h2>
			</div>

			<div class="lfa-conf-overview__facts">
				<div class="lfa-conf-fact">
					<div class="lfa-conf-fact__icon" aria-hidden="true">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
							<line x1="16" y1="2" x2="16" y2="6"></line>
							<line x1="8" y1="2" x2="8" y2="6"></line>
							<line x1="3" y1="10" x2="21" y2="10"></line>
						</svg>
					</div>
					<span class="lfa-conf-fact__label">Year</span>
					<strong class="lfa-conf-fact__val"><?php echo esc_html( $year ); ?></strong>
				</div>

				<div class="lfa-conf-fact">
					<div class="lfa-conf-fact__icon" aria-hidden="true">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
						</svg>
					</div>
					<span class="lfa-conf-fact__label">Theme</span>
					<strong class="lfa-conf-fact__val"><?php echo esc_html( $theme ); ?></strong>
				</div>

				<div class="lfa-conf-fact">
					<div class="lfa-conf-fact__icon" aria-hidden="true">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="12" cy="12" r="10"></circle>
							<polyline points="12 6 12 12 16 14"></polyline>
						</svg>
					</div>
					<span class="lfa-conf-fact__label">Date</span>
					<strong class="lfa-conf-fact__val"><?php echo esc_html( $dates ); ?></strong>
				</div>

				<div class="lfa-conf-fact">
					<div class="lfa-conf-fact__icon" aria-hidden="true">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
							<circle cx="12" cy="10" r="3"></circle>
						</svg>
					</div>
					<span class="lfa-conf-fact__label">Venue</span>
					<strong class="lfa-conf-fact__val"><?php echo esc_html( $venue ); ?></strong>
				</div>
			</div>

			<p class="lfa-conf-overview__note">
				Official program, speakers, registration details and accommodation information will be added once confirmed by the organizers.
			</p>

		</div>
	</div>
</section>
