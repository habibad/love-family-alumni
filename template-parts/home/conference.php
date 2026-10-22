<?php
/**
 * Homepage 2027 Conference Featured Event Section
 *
 * Fully dynamic integration with the authoritative LFA Conference subsystem.
 * Resolves the published featured conference ("2027 North America Zone Conference")
 * and dynamically displays its confirmed keynote speaker, dates, location, and action links.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$conf = null;
if ( class_exists( 'LFA_Conference' ) ) {
	// 1. Authoritative resolution: Published 2027 Biennial Conference or primary published conference
	$conf = LFA_Conference::get_conference( '2027-biennial-conference' );
	if ( ! $conf || $conf->published_status !== 'published' ) {
		$conf = LFA_Conference::get_conference_by_id( 1 );
	}
	if ( ! $conf || $conf->published_status !== 'published' ) {
		$published = LFA_Conference::get_published_conferences();
		$conf = ! empty( $published ) ? $published[0] : null;
	}
}

// Dynamic Conference Details
$conf_title    = ( $conf && ! empty( $conf->title ) ) ? $conf->title : '2027 North America Zone Conference';
$conf_theme    = ( $conf && ! empty( $conf->theme ) ) ? $conf->theme : 'Thy Kingdom Come';
$conf_location = ( $conf && ! empty( $conf->location_summary ) ) ? $conf->location_summary : 'North America Zone (Host City TBA)';
$conf_url      = ( $conf && class_exists( 'LFA_Conference' ) ) ? LFA_Conference::get_conference_url( $conf ) : home_url( '/conference/2027/' );
$reg_url       = $conf_url . '#conference-registration';

// Dynamic Dates
if ( $conf && ! empty( $conf->starts_at ) ) {
	$start_ts   = strtotime( $conf->starts_at );
	$end_ts     = ! empty( $conf->ends_at ) ? strtotime( $conf->ends_at ) : $start_ts;
	$date_month = strtoupper( date_i18n( 'F Y', $start_ts ) );
	if ( date( 'F Y', $start_ts ) === date( 'F Y', $end_ts ) ) {
		$date_range = date_i18n( 'F j', $start_ts ) . '–' . date_i18n( 'j, Y', $end_ts );
	} else {
		$date_range = date_i18n( 'M j', $start_ts ) . ' – ' . date_i18n( 'M j, Y', $end_ts );
	}
} else {
	$date_month = 'SEPTEMBER 2027';
	$date_range = 'September 16–19, 2027';
}

// Dynamic Speaker Resolution (Keynote speaker under the conference)
$speaker         = null;
$speaker_img_url = '';
$speaker_alt     = '';
$speaker_name    = '';

if ( $conf && class_exists( 'LFA_Conference' ) ) {
	$speakers = LFA_Conference::get_conference_speakers( (int) $conf->id, true );
	if ( ! empty( $speakers ) ) {
		foreach ( $speakers as $spk ) {
			if ( $spk->role === 'keynote' ) {
				$speaker = $spk;
				break;
			}
		}
		if ( ! $speaker ) {
			$speaker = $speakers[0];
		}
	}
}

if ( $speaker ) {
	$speaker_name = $speaker->name;
	if ( ! empty( $speaker->image_id ) ) {
		$speaker_img_url = wp_get_attachment_image_url( (int) $speaker->image_id, 'full' );
	}
	$speaker_alt = ! empty( $speaker->image_alt ) ? $speaker->image_alt : ( $speaker_name . ' — ' . $conf_title );
}

// Fallback to static asset if no speaker image found
if ( empty( $speaker_img_url ) ) {
	$speaker_img_url = lfa_image_url( 'speaker-fedora-master.png' );
	$speaker_alt     = ! empty( $speaker_name ) ? ( $speaker_name . ' — ' . $conf_title ) : '2027 Conference Speaker';
}

// Dynamic Blurb from details_json if available
$conf_details = ( $conf && ! empty( $conf->details_json ) ) ? json_decode( $conf->details_json, true ) : [];
$conf_blurb   = ! empty( $conf_details['blurb'] ) ? $conf_details['blurb'] : ( ! empty( $conf_details['program_info'] ) && strlen( $conf_details['program_info'] ) < 180 ? $conf_details['program_info'] : '' );
?>
<section class="conference-section lfa-featured-conference" id="conference-featured" aria-label="Featured Event: 2027 Conference">
	<!-- Background layers: cinematic crowd, lighting & globe -->
	<div class="conference-bg-layer" aria-hidden="true">
		<img src="<?php echo esc_url( lfa_image_url( 'conference-cinematic-bg.jpg' ) ); ?>" 
		     alt="" 
		     class="conference-bg-img">
		<div class="conference-bg-overlay"></div>
	</div>

	<div class="conference-container">
		<div class="conference-banner">
			<!-- Zone 1 (Left): Speaker Cutout -->
			<div class="conference-leader-col">
				<div class="conference-leader-wrap">
					<img src="<?php echo esc_url( $speaker_img_url ); ?>" 
					     alt="<?php echo esc_attr( $speaker_alt ); ?>" 
					     loading="eager" 
					     decoding="async" 
					     class="conference-leader-img"
					     <?php if ( $speaker && ! empty( $speaker->image_id ) ) : ?>style="object-position: center top;"<?php endif; ?>>
				</div>
			</div>

			<!-- Zone 2 (Center): Conference Editorial Details -->
			<div class="conference-info-col">
				<div class="conference-badge">FEATURED EVENT</div>
				<h2 class="conference-title"><?php echo esc_html( strtoupper( $conf_title ) ); ?></h2>
				<div class="conference-theme">
					<span class="theme-label">THEME:</span> 
					<span class="theme-name"><?php echo esc_html( strtoupper( $conf_theme ) ); ?></span>
				</div>

				<div class="conference-gold-line" aria-hidden="true"></div>

				<div class="conference-meta-row">
					<div class="conference-meta-item">
						<span class="meta-icon" aria-hidden="true">
							<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
								<rect x="3" y="4" width="18" height="18" rx="3" ry="3"></rect>
								<line x1="8" y1="2" x2="8" y2="5"></line>
								<line x1="16" y1="2" x2="16" y2="5"></line>
								<line x1="3" y1="9" x2="21" y2="9"></line>
								<path d="M7 13h3.5v5H7z" stroke-width="1.6" fill="rgba(229,168,59,0.3)"></path>
								<path d="M13.5 13H17v5h-3.5z" stroke-width="1.6" fill="rgba(229,168,59,0.3)"></path>
							</svg>
						</span>
						<div class="meta-text">
							<span class="meta-primary"><?php echo esc_html( $date_month ); ?></span>
							<span class="meta-sub"><?php echo esc_html( $date_range ); ?></span>
						</div>
					</div>

					<div class="conference-meta-divider" aria-hidden="true"></div>

					<div class="conference-meta-item">
						<span class="meta-icon" aria-hidden="true">
							<svg width="38" height="44" viewBox="0 0 24 28" fill="currentColor">
								<path d="M12 1C5.93 1 1 5.93 1 12c0 7.8 11 15 11 15s11-7.2 11-15c0-6.07-4.93-11-11-11zm0 16a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
							</svg>
						</span>
						<div class="meta-text">
							<span class="meta-primary">Host Region</span>
							<span class="meta-sub"><?php echo esc_html( $conf_location ); ?></span>
						</div>
					</div>
				</div>
			</div>

			<!-- Vertical Gold Separator -->
			<div class="conference-vertical-divider" aria-hidden="true"></div>

			<!-- Zone 3 (Right): Copy & Actions -->
			<div class="conference-action-col">
				<?php if ( ! empty( $conf_blurb ) ) : ?>
					<p class="conference-blurb">
						<?php echo nl2br( esc_html( $conf_blurb ) ); ?>
					</p>
				<?php else : ?>
					<p class="conference-blurb">
						A time of reunion, renewal and<br class="conf-desk-br">
						greater impact. Join us for inspiring<br class="conf-desk-br">
						sessions, fellowship and a shared<br class="conf-desk-br">
						vision for the future.
					</p>
				<?php endif; ?>
				<div class="conference-btn-row">
					<a href="<?php echo esc_url( $reg_url ); ?>" class="btn btn-conference btn-conference-register">
						Register Now
					</a>
					<a href="<?php echo esc_url( $conf_url ); ?>" class="btn btn-conference btn-conference-details">
						View Details
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
