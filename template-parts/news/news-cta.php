<?php
/**
 * News & Announcements — News CTA Section
 *
 * Placed immediately after Community Updates, directly preceding the shared site footer.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_url    = home_url( '/contact/' );
$membership_url = home_url( '/membership/' );
?>
<section class="lfa-news-task03-cta" id="news-cta" aria-labelledby="lfa-news-cta-title">
	<div class="lfa-container lfa-news-task03-container lfa-news-task03-cta__layout">
		<!-- Left Icon Symbol -->
		<div class="lfa-news-task03-cta__symbol" aria-hidden="true">
			<svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
				<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
				<polyline points="22,6 12,13 2,6"></polyline>
			</svg>
		</div>

		<!-- Center Copy -->
		<div class="lfa-news-task03-cta__copy">
			<span class="lfa-news-task03-eyebrow">SHARE YOUR STORY</span>
			<h2 id="lfa-news-cta-title" class="lfa-news-task03-cta__title">
				Every Story Strengthens Our Family.
			</h2>
			<p class="lfa-news-task03-cta__lead">
				Have community news or an achievement to share? Reach out to our team so updates can be reviewed before publication.
			</p>
		</div>

		<!-- Action Buttons -->
		<div class="lfa-news-task03-cta__buttons">
			<a class="lfa-news-btn lfa-news-btn--primary lfa-news-task03-btn--primary" href="<?php echo esc_url( $contact_url ); ?>">
				<span>Contact the Team</span>
			</a>
			<a class="lfa-news-btn lfa-news-btn--outline" href="<?php echo esc_url( $membership_url ); ?>">
				<span>Explore Membership</span>
			</a>
		</div>
	</div>
</section>
