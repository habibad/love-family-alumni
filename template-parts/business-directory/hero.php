<?php
/**
 * Business Directory — Hero Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_bg = get_theme_file_uri( '/assets/images/business-hero-bg.jpg' );
?>
<section class="lfa-biz-hero" aria-labelledby="lfa-biz-hero-title">
	<div class="lfa-biz-hero__bg" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');"></div>
	<div class="lfa-biz-hero__overlay" aria-hidden="true"></div>
	<div class="lfa-container lfa-biz-hero__container">
		<div class="lfa-biz-hero__content">
			<span class="lfa-biz-hero__eyebrow">BUSINESS DIRECTORY</span>
			<h1 id="lfa-biz-hero-title" class="lfa-biz-hero__title">
				Alumni Businesses.<br>
				<span class="lfa-biz-hero__title-accent">Stronger Together.</span>
			</h1>
			<p class="lfa-biz-hero__lead">
				Discover and support businesses owned or managed by The Love Family alumni. Let's build opportunities, create partnerships, and strengthen our global network.
			</p>
			<div class="lfa-biz-hero__cta" style="margin-top: 24px;">
				<a href="<?php echo esc_url( is_user_logged_in() ? home_url( '/member-dashboard/#businesses' ) : home_url( '/member-login/?redirect_to=' . urlencode( home_url( '/member-dashboard/#businesses' ) ) ) ); ?>" class="btn" style="display:inline-flex;align-items:center;gap:8px;padding:12px 26px;border-radius:6px;font-weight:700;background:#C6933D;color:#071D3E;text-decoration:none;box-shadow:0 4px 14px rgba(198,147,61,0.4);">
					<span><?php echo is_user_logged_in() ? 'List or Manage Your Business' : 'List Your Business'; ?></span>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
				</a>
			</div>
		</div>
	</div>
</section>
