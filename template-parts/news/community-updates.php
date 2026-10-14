<?php
/**
 * News & Announcements — Community Updates Section
 *
 * Placed immediately after News cards & pagination on /news/.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = [
	[
		'name'  => 'Announcements',
		'slug'  => 'Announcements',
		'icon'  => '✦',
		'desc'  => 'Official updates, executive notices, chapter reports, and vital information from across the North America Zone.',
	],
	[
		'name'  => 'Achievements & Awards',
		'slug'  => 'Achievements & Awards',
		'icon'  => '★',
		'desc'  => 'Celebrating verified academic accomplishments, research grants, career milestones, and community leadership awards.',
	],
	[
		'name'  => 'Celebrations',
		'slug'  => 'Community Celebrations',
		'icon'  => '♡',
		'desc'  => 'Honoring regional alumni gatherings, fellowship reunions, and special community occasions shared with consent.',
	],
	[
		'name'  => 'Memorial Notices',
		'slug'  => 'Memorial Notices',
		'icon'  => '✿',
		'desc'  => 'Respectfully commemorating departed alumni and standing together with families in prayer and loving remembrance.',
	],
];
?>
<section class="lfa-news-task03-community" id="community-updates" aria-labelledby="lfa-community-updates-title">
	<div class="lfa-container lfa-news-task03-container">
		<div class="lfa-news-task03-community__heading">
			<div class="lfa-news-task03-community__title-group">
				<span class="lfa-news-kicker">OUR COMMUNITY</span>
				<h2 id="lfa-community-updates-title" class="lfa-news-section-title">
					The Moments We Share.
				</h2>
			</div>
			<p class="lfa-news-task03-community__lead">
				From meaningful announcements to shared milestones, our newsroom brings the Love Family closer together across North America.
			</p>
		</div>

		<div class="lfa-news-task03-community__grid">
			<?php foreach ( $categories as $cat ) : ?>
				<?php
				$cat_url = add_query_arg( 'category', urlencode( $cat['slug'] ), home_url( '/news/#news-explorer' ) );
				?>
				<article class="lfa-news-task03-community__card">
					<div class="lfa-news-task03-community__icon-wrap" aria-hidden="true">
						<span class="lfa-news-task03-community__icon"><?php echo esc_html( $cat['icon'] ); ?></span>
					</div>
					<h3 class="lfa-news-task03-community__card-title">
						<a href="<?php echo esc_url( $cat_url ); ?>">
							<?php echo esc_html( $cat['name'] ); ?>
						</a>
					</h3>
					<p class="lfa-news-task03-community__card-text">
						<?php echo esc_html( $cat['desc'] ); ?>
					</p>
					<a href="<?php echo esc_url( $cat_url ); ?>" class="lfa-news-task03-community__card-link">
						<span>Explore <?php echo esc_html( $cat['name'] ); ?></span>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</a>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="lfa-news-task03-community__footer-note">
			<span class="lfa-news-demo-pill">DEMO CONTENT</span>
			<p>Sample categories only. Real personal announcements and community milestones require editorial authorization and member consent prior to publication.</p>
		</div>
	</div>
</section>
