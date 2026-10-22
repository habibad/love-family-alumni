<?php
/**
 * The template for displaying all pages
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="page-hero-banner">
	<div class="lfa-container">
		<span class="page-eyebrow">The LOVE FAMILY ALUMNI • NORTH AMERICA</span>
		<h1 class="page-title"><?php the_title(); ?></h1>
	</div>
</div>

<div class="page-content-area">
	<div class="lfa-container">
		<div class="page-content-card">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					if ( get_the_content() ) :
						the_content();
					else :
						?>
						<div class="lfa-generic-page-card" style="text-align: center; padding: 48px 20px; max-width: 680px; margin: 0 auto;">
							<span class="lfa-pill" style="display: inline-block; padding: 6px 16px; background: rgba(198,147,61,0.15); color: #92400E; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; border-radius: 999px; margin-bottom: 16px;">
								Community Notice
							</span>
							<h2 style="font-family: 'Playfair Display', Georgia, serif; font-size: 2.2rem; color: #0A203A; margin: 0 0 14px; font-weight: 800;"><?php the_title(); ?></h2>
							<p style="color: #64748B; font-size: 1.05rem; line-height: 1.65; margin: 0 0 28px;">Official content for this section is being maintained by the Secretariat. You may explore our flagship 2027 Conference, upcoming events, or return to the homepage.</p>
							<div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
								<a href="<?php echo esc_url( home_url( '/conference/2027/' ) ); ?>" class="btn btn-crimson">View 2027 Conference</a>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn" style="background: #0A203A; color: #FFFFFF; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-weight: 600;">Return to Homepage</a>
							</div>
						</div>
						<?php
					endif;
				endwhile;
			endif;
			?>
		</div>
	</div>
</div>

<?php
get_footer();
