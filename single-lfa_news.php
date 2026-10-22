<?php
/**
 * Single News Article Template for Love Family Alumni
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = get_the_ID();
$story   = null;

if ( class_exists( 'LFA_News' ) ) {
	$post = get_post( $post_id );
	if ( $post && ( $post->post_status === 'publish' || current_user_can( 'edit_post', $post_id ) ) ) {
		if ( method_exists( 'LFA_News', 'format_news_item' ) ) {
			$story = LFA_News::format_news_item( $post );
		} elseif ( method_exists( 'LFA_News', 'format_story' ) ) {
			$story = LFA_News::format_story( $post );
		}
	}
}

if ( ! $story ) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
	get_template_part( '404' );
	exit;
}

get_header();
?>
<main id="main-content" class="lfa-news-details lfa-news" role="main" aria-label="News Article Details">
	<?php
	get_template_part( 'template-parts/news/article-detail', null, [ 'story' => $story ] );
	get_template_part( 'template-parts/news/related-stories', null, [ 'story' => $story ] );
	?>
</main>
<?php
get_footer();
