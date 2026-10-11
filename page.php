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
		<span class="page-eyebrow">LOVE FAMILY ALUMNI • NORTH AMERICA</span>
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
						<div class="placeholder-notice">
							<div class="notice-badge">Phase 01 Frontend Scaffold</div>
							<h2><?php the_title(); ?> — Scheduled for Phase 02</h2>
							<p>This page route is registered and ready. Full mock UI and interactive components for this screen will be implemented during Phase 02 (All Public Pages Static UI) in accordance with the project roadmap.</p>
							<div class="notice-actions">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-crimson">Return to Homepage</a>
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
