<?php
/**
 * Template Name: LFA Premium Member Portal (Frontend Preview)
 * Description: Master standalone template for the Love Family Alumni Member Dashboard (/member-dashboard/).
 * Intentionally bypasses the public website header, utility navigation, and footer.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'lfa-premium-portal-page' ); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/member-dashboard-premium/shell' ); ?>
<?php wp_footer(); ?>
</body>
</html>
