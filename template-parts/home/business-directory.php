<?php
/**
 * Homepage Alumni Business Directory Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$business_categories = [
	[
		'title'    => 'Professional Services',
		'subtitle' => 'Legal, Finance, Consulting',
		'image'    => 'biz-prof-services.jpg',
	],
	[
		'title'    => 'Technology',
		'subtitle' => 'IT, Software, Digital Services',
		'image'    => 'biz-technology.jpg',
	],
	[
		'title'    => 'Healthcare',
		'subtitle' => 'Medical, Wellness, Care',
		'image'    => 'biz-healthcare.jpg',
	],
	[
		'title'    => 'Real Estate',
		'subtitle' => 'Realtors, Property Services',
		'image'    => 'biz-real-estate.jpg',
	],
	[
		'title'    => 'Small Business',
		'subtitle' => 'Retail, Food, Apparel & More',
		'image'    => 'biz-small-biz.jpg',
	],
];
?>
<section class="biz-directory-section" aria-label="Alumni Business Directory">
	<div class="lfa-container">
		<div class="biz-header-row">
			<div class="biz-header-left">
				<span class="section-eyebrow eyebrow-crimson">ALUMNI BUSINESS DIRECTORY</span>
				<h2 class="section-heading biz-heading">Support. Connect. Grow Together.</h2>
			</div>
			<div class="biz-header-right">
				<p class="biz-header-blurb">
					Discover and support alumni-owned businesses across North America. Let's uplift our own and create opportunities together.
				</p>
				<a href="<?php echo esc_url( home_url( '/business-directory/' ) ); ?>" class="btn btn-outline-navy btn-biz-dir">
					View Full Directory
				</a>
			</div>
		</div>

		<div class="biz-grid">
			<?php foreach ( $business_categories as $cat ) : ?>
				<a href="<?php echo esc_url( home_url( '/business-directory/' ) ); ?>" class="biz-card">
					<div class="biz-card-thumb">
						<img src="<?php echo esc_url( lfa_image_url( $cat['image'] ) ); ?>" 
						     alt="<?php echo esc_attr( $cat['title'] ); ?>" 
						     loading="lazy" 
						     class="biz-thumb-img">
					</div>
					<div class="biz-card-body">
						<h3 class="biz-card-title"><?php echo esc_html( $cat['title'] ); ?></h3>
						<p class="biz-card-sub"><?php echo esc_html( $cat['subtitle'] ); ?></p>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
