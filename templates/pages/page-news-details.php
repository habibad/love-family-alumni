<?php
/**
 * Template Name: LFA — News Article Details
 * Description: Master template for Love Family Alumni single news article preview
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$raw   = isset( $_GET['story'] ) && is_string( $_GET['story'] ) ? wp_unslash( $_GET['story'] ) : '';
$slug  = sanitize_title( $raw );
$story = function_exists( 'lfa_news_task03_find' ) ? lfa_news_task03_find( $slug ) : null;

if ( ! $story && ! headers_sent() ) {
	status_header( 404 );
	nocache_headers();
}

get_header();
?>

<main id="main-content" class="lfa-news-details lfa-news" role="main" aria-label="News Article Details">
	<?php
	if ( $story ) :
		// Article Detail Hero & Body Layout
		get_template_part( 'template-parts/news/article-detail', null, [ 'story' => $story ] );

		// Up to 3 Related News Cards
		get_template_part( 'template-parts/news/related-stories', null, [ 'story' => $story ] );
	else :
		// Friendly Not Found State
		?>
		<section class="lfa-news-details__not-found" aria-labelledby="lfa-not-found-title">
			<div class="lfa-news-task03-container">
				<div class="lfa-news-details__not-found-card">
					<span class="lfa-news-task03-eyebrow">ARTICLE UNAVAILABLE</span>
					<h1 id="lfa-not-found-title">This demo story could not be found.</h1>
					<p>The requested article identifier does not match any current demo records. Try browsing verified updates on the News & Announcements page.</p>
					<div class="lfa-news-details__not-found-actions">
						<a class="lfa-news-task03-button" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">
							← Back to News & Announcements
						</a>
					</div>
				</div>
			</div>
		</section>
		<?php
	endif;
	?>
</main>

<?php
get_footer();
