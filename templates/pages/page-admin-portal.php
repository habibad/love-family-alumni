<?php
/**
 * Template Name: LFA — Admin Portal (Standalone App Shell)
 * Description: Master standalone administrative dashboard application shell for The Love Family Alumni (North America Zone)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title><?php wp_title( '|', true, 'right' ); ?> Admin Portal &mdash; The Love Family Alumni</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'lfa-admin-portal-app' ); ?>>
<?php wp_body_open(); ?>

<?php
// Load complete standalone Admin Portal UI shell
get_template_part( 'template-parts/admin-portal/shell' );
?>

<?php wp_footer(); ?>
</body>
</html>
