<?php
/**
 * Template Name: LFA Member Dashboard (Frontend Demo)
 * Description: Master template for the Love Family Alumni Member Dashboard (/member-dashboard/). Static frontend preview.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/member-dashboard/dashboard' );

get_footer();
