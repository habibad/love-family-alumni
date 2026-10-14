<?php
/**
 * Scholarships — Future Recipient Stories Placeholder (Task 03)
 * DO NOT suggest that any person in the archival photo received scholarship funding.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$photo_url = get_theme_file_uri( 'assets/images/scholarships/community-five.webp' );
?>
<section id="scholarship-stories" class="lfa-scholarships__stories" aria-labelledby="lfa-scholarships-stories-title">
	<div class="lfa-scholarships__container">
		<div class="lfa-scholarships__stories-topline">
			<span class="lfa-scholarships__eyebrow">THE PEOPLE BEHIND THE PURPOSE</span>
			<span class="lfa-scholarships__stories-status"><span aria-hidden="true"></span> STORIES TO COME</span>
		</div>
		<div class="lfa-scholarships__stories-shell">
			<div class="lfa-scholarships__stories-copy">
				<span class="lfa-scholarships__stories-index">01 / FUTURE IMPACT</span>
				<h2 id="lfa-scholarships-stories-title">Tomorrow's Stories.<br><em>Written Together.</em></h2>
				<p>Every generation brings new dreams, abilities and ambition. This space will eventually highlight authentic scholarship stories and achievements once the organization has verified them and received permission to publish.</p>
				<div class="lfa-scholarships__stories-empty" role="note">
					<span class="lfa-scholarships__stories-empty-icon" aria-hidden="true">&#10022;</span>
					<div>
						<strong>Recipient spotlights coming soon</strong>
						<span>No recipient biographies or award information have been supplied for publication.</span>
					</div>
				</div>
				<a href="#scholarship-programs" class="lfa-scholarships__stories-link">Explore sample programs <span aria-hidden="true">&nearr;</span></a>
			</div>
			<figure class="lfa-scholarships__stories-photo">
				<img src="<?php echo esc_url( $photo_url ); ?>" width="960" height="720" loading="lazy" decoding="async" alt="Love Family alumni at a community gathering" />
				<div class="lfa-scholarships__stories-photo-stamp" aria-hidden="true">
					<span>THE NEXT GENERATION</span>
					<strong>Possibility<br>with purpose.</strong>
				</div>
				<figcaption>Alumni community photograph for atmosphere only; people pictured are not identified as scholarship recipients.</figcaption>
			</figure>
		</div>
	</div>
</section>
