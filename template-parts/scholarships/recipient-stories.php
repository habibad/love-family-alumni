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

$published_recipients = [];
if ( class_exists( 'LFA_Scholarship' ) ) {
	$akpo_prog = LFA_Scholarship::get_program_by_slug( 'the-akpo-family-scholarship' );
	if ( $akpo_prog ) {
		$published_recipients = LFA_Scholarship::get_published_recipients( (int) $akpo_prog->id );
	}
}
?>
<section id="scholarship-stories" class="lfa-scholarships__stories" aria-labelledby="lfa-scholarships-stories-title">
	<div class="lfa-scholarships__container">
		<div class="lfa-scholarships__stories-topline">
			<span class="lfa-scholarships__eyebrow">THE PEOPLE BEHIND THE PURPOSE</span>
			<span class="lfa-scholarships__stories-status"><span aria-hidden="true"></span> <?php echo !empty($published_recipients) ? 'HONORED RECIPIENTS' : 'STORIES TO COME'; ?></span>
		</div>
		<div class="lfa-scholarships__stories-shell">
			<div class="lfa-scholarships__stories-copy">
				<span class="lfa-scholarships__stories-index">01 / <?php echo !empty($published_recipients) ? 'RECIPIENT IMPACT' : 'FUTURE IMPACT'; ?></span>
				<h2 id="lfa-scholarships-stories-title">Tomorrow's Stories.<br><em>Written Together.</em></h2>
				<p>Every generation brings new dreams, abilities and ambition. This space highlights authentic scholarship stories and achievements published exclusively with verified recipient consent and committee authorization.</p>
				
				<?php if (!empty($published_recipients)) : ?>
					<div style="display:flex;flex-direction:column;gap:12px;margin:20px 0;">
						<?php foreach ($published_recipients as $rec) : ?>
							<div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:14px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
								<strong style="color:#0F2942;font-size:15px;display:block;"><?php echo esc_html($rec->public_name); ?></strong>
								<span style="font-size:13px;color:#64748b;display:block;"><?php echo esc_html($rec->institution); ?> &middot; <?php echo esc_html($rec->academic_year); ?></span>
								<?php if (!empty($rec->award_details)) : ?>
									<p style="margin:6px 0 0 0;font-size:13px;color:#334155;"><?php echo esc_html($rec->award_details); ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="lfa-scholarships__stories-empty" role="note">
						<span class="lfa-scholarships__stories-empty-icon" aria-hidden="true">&#10022;</span>
						<div>
							<strong>Recipient spotlights coming soon</strong>
							<span>No recipient biographies or award information have been supplied for publication.</span>
						</div>
					</div>
				<?php endif; ?>

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
