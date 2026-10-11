<?php
/**
 * The template for displaying the front page
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php get_template_part( 'template-parts/home/hero' ); ?>

<?php get_template_part( 'template-parts/home/pillars' ); ?>

<?php get_template_part( 'template-parts/home/about' ); ?>

<?php get_template_part( 'template-parts/home/president' ); ?>

<?php get_template_part( 'template-parts/home/gallery' ); ?>

<?php get_template_part( 'template-parts/home/conference' ); ?>

<?php get_template_part( 'template-parts/home/benefits' ); ?>

<?php get_template_part( 'template-parts/home/scholarships-giving' ); ?>

<?php get_template_part( 'template-parts/home/business-directory' ); ?>

<?php get_template_part( 'template-parts/home/join-cta' ); ?>

<?php
get_footer();
