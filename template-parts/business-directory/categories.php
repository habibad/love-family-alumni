<?php
/**
 * Business Directory — Browse by Category Strip
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = [
	[
		'name'  => 'Technology & IT',
		'slug'  => 'Technology & IT',
		'color' => '#1A56DB', // Royal Blue
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>',
	],
	[
		'name'  => 'Healthcare & Wellness',
		'slug'  => 'Healthcare & Wellness',
		'color' => '#E02424', // Crimson Red
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 7.65l.77.78L12 20.66l7.65-7.65.77-.78a5.4 5.4 0 0 0 0-7.65z"></path><path d="M7 11h2l1-2 2 4 1-2h4"></path></svg>',
	],
	[
		'name'  => 'Education & Training',
		'slug'  => 'Education & Training',
		'color' => '#D97706', // Gold/Amber
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>',
	],
	[
		'name'  => 'Real Estate & Construction',
		'slug'  => 'Real Estate & Construction',
		'color' => '#0E7490', // Cyan/Navy
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01M16 6h.01M8 10h.01M16 10h.01M8 14h.01M16 14h.01"></path></svg>',
	],
	[
		'name'  => 'Finance & Investment',
		'slug'  => 'Finance & Investment',
		'color' => '#059669', // Emerald Green
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>',
	],
	[
		'name'  => 'Consulting & Professional',
		'slug'  => 'Consulting & Professional',
		'color' => '#7C3AED', // Violet
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
	],
	[
		'name'  => 'Retail & E-commerce',
		'slug'  => 'Retail & E-commerce',
		'color' => '#DC2626', // Crimson
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>',
	],
	[
		'name'  => 'Travel & Hospitality',
		'slug'  => 'Travel & Hospitality',
		'color' => '#0891B2', // Teal/Cyan
		'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.8 19.2L16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.3c.4-.2.6-.6.5-1.1z"></path></svg>',
	],
];
?>
<section class="lfa-biz-categories-section" aria-labelledby="lfa-biz-cat-title">
	<div class="lfa-container">
		<div class="lfa-biz-categories-header">
			<h2 id="lfa-biz-cat-title" class="lfa-biz-categories-title">Browse by Category</h2>
			<button type="button" id="lfa-biz-view-all-cats" class="lfa-biz-view-all-btn">
				View All Categories <span aria-hidden="true">→</span>
			</button>
		</div>

		<div class="lfa-biz-categories-grid" role="list">
			<?php foreach ( $categories as $cat ) : ?>
				<button type="button" 
				        class="lfa-biz-cat-card" 
				        data-category="<?php echo esc_attr( $cat['slug'] ); ?>"
				        style="--cat-color: <?php echo esc_attr( $cat['color'] ); ?>;"
				        role="listitem">
					<div class="lfa-biz-cat-icon" aria-hidden="true">
						<?php echo $cat['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<span class="lfa-biz-cat-name"><?php echo esc_html( $cat['name'] ); ?></span>
				</button>
			<?php endforeach; ?>
		</div>
	</div>
</section>
