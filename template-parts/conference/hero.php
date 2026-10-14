<?php
/**
 * Conference 2027 — Cinematic Hero Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_image = lfa_image_url( 'original-alumni-group.jpg' );
$emblem     = lfa_image_url( 'original-love-family-logo.jpg' );
?>

<section class="lfa-conf-hero" aria-labelledby="lfa-conf-title" style="--lfa-conf-photo: url('<?php echo esc_url( $hero_image ); ?>');">
	<div class="lfa-conf-hero__shading" aria-hidden="true"></div>
	
	<div class="lfa-container lfa-conf-hero__container">
		<div class="lfa-conf-hero__inner">
			
			<!-- Left: Hero Content -->
			<div class="lfa-conf-hero__content">
				<p class="lfa-conf-hero__eyebrow">LOVE FAMILY ALUMNI <span class="sep">&mdash;</span> NORTH AMERICA ZONE</p>
				<p class="lfa-conf-hero__year">2027 CONFERENCE</p>
				<h1 id="lfa-conf-title" class="lfa-conf-hero__title">THY KINGDOM <em>COME</em></h1>
				<p class="lfa-conf-hero__verse">Matthew 6:10</p>
				<div class="lfa-conf-hero__rule" aria-hidden="true"></div>
				<p class="lfa-conf-hero__description">
					A gathering in fellowship, purpose and shared legacy. Bringing our alumni family together to connect, serve, and grow.
				</p>
				
				<div class="lfa-conf-hero__actions">
					<a class="lfa-conf-btn lfa-conf-btn--crimson" href="#conference-details">
						<span>Explore Conference</span>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</a>
					<span class="lfa-conf-hero__coming">Registration details to be announced</span>
				</div>
			</div>

			<!-- Right: Circular Emblem Identity Crest -->
			<aside class="lfa-conf-hero__mark" aria-label="2027 conference identity">
				<div class="lfa-conf-hero__mark-emblem-wrap">
					<img src="<?php echo esc_url( $emblem ); ?>" alt="Love Family Alumni emblem" width="82" height="82" class="lfa-conf-hero__mark-img" loading="eager">
				</div>
				<span class="lfa-conf-hero__mark-year">2027</span>
				<span class="lfa-conf-hero__mark-name">NORTH AMERICA ZONE</span>
				<span class="lfa-conf-hero__mark-verse">THY KINGDOM COME</span>
			</aside>

		</div>
	</div>
</section>
