<?php
/**
 * Template Name: LFA — Member Login
 * Description: Master template for the Love Family Alumni Member Login page (/member-login/)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="primary" class="lfa-member-auth lfa-login-screen" aria-label="Love Family Alumni Member Login">
	<div class="lfa-container lfa-auth-container">
		<?php get_template_part( 'template-parts/member-auth/login-form' ); ?>
	</div>
</div>

<?php
get_footer();
