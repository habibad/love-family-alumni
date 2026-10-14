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
				Discover and support businesses owned or managed by Love Family alumni. Let's build opportunities, create partnerships, and strengthen our global network.
			</p>
		</div>
	</div>
</section>
