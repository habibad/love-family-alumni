<?php
/**
 * Template Name: LFA — Forgot Password
 * Description: Master template for the Love Family Alumni Password Recovery page (/forgot-password/)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="primary" class="lfa-member-auth lfa-forgot-screen" aria-label="Love Family Alumni Password Recovery">
	<div class="lfa-container lfa-auth-container">
		<?php get_template_part( 'template-parts/member-auth/forgot-password' ); ?>
	</div>
</div>

<?php
get_footer();
