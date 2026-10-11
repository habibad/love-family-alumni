<?php
/**
 * The main template file
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_front_page() ) {
	get_template_part( 'front-page' );
	return;
}

get_header();
?>

<div class="page-hero-banner">
	<div class="lfa-container">
		<span class="page-eyebrow">LOVE FAMILY ALUMNI • NORTH AMERICA</span>
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</div>
</div>

<div class="page-content-area">
	<div class="lfa-container">
		<div class="page-content-card">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			else :
				?>
				<p>No content found.</p>
				<?php
			endif;
			?>
		</div>
	</div>
</div>

<?php
get_footer();
