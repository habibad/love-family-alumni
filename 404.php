<?php
/**
 * The template for displaying 404 pages (not found)
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
		<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'love-family-theme' ); ?></h1>
	</div>
</div>

<div class="page-content-area">
	<div class="lfa-container">
		<div class="page-content-card" style="text-align: center; padding: 60px 20px;">
			<div style="max-width: 580px; margin: 0 auto;">
				<span style="font-size: 72px; font-weight: 800; color: #9B1B30; line-height: 1; display: block; margin-bottom: 16px;">404</span>
				<h2 style="font-size: 28px; margin-bottom: 16px; color: #0B192C;"><?php esc_html_e( 'The page you are looking for cannot be found.', 'love-family-theme' ); ?></h2>
				<p style="color: #64748B; font-size: 16px; line-height: 1.6; margin-bottom: 32px;">
					<?php esc_html_e( 'The link you followed may be broken, or the page may have been moved. You can return to our homepage or explore our alumni portal.', 'love-family-theme' ); ?>
				</p>
				<div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-crimson">
						<?php esc_html_e( 'Return to Homepage', 'love-family-theme' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/member-dashboard/' ) ); ?>" class="btn btn-outline-navy">
						<?php esc_html_e( 'Member Dashboard', 'love-family-theme' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline-navy">
						<?php esc_html_e( 'Contact Support', 'love-family-theme' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
