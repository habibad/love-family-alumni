<?php
/**
 * Header template
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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">
	<?php esc_html_e( 'Skip to content', 'love-family-theme' ); ?>
</a>

<header class="site-header" role="banner">
	<?php get_template_part( 'template-parts/site/header-utility' ); ?>
	<?php get_template_part( 'template-parts/site/header-navigation' ); ?>
</header>

<main id="main-content" class="site-main">
