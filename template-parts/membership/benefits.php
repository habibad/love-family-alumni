<?php
/**
 * Membership Page — Section 02: Benefits Section (Approved Reference)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$benefits = function_exists( 'lfa_get_membership_benefits' ) ? lfa_get_membership_benefits() : [];
?>

<section class="membership-benefits-section" id="membership-benefits" aria-label="Membership Benefits">
	<div class="lfa-container">
		<!-- Section Header: Left Title + Right Supporting Intro -->
		<div class="membership-benefits-header">
			<div class="benefits-header-left">
				<span class="benefits-eyebrow">MEMBERSHIP BENEFITS</span>
				<h2 class="benefits-section-title">More Than Alumni. We're Family.</h2>
			</div>
			<div class="benefits-header-right">
				<p class="benefits-header-lead">
					As a member, you gain access to a supportive network, meaningful opportunities, and resources that help you stay connected and make a difference across North America and beyond.
				</p>
			</div>
		</div>

		<!-- Single Row of 6 Benefit Cards -->
		<div class="membership-benefits-row">
			<?php foreach ( $benefits as $benefit ) : 
				$color_class = ( 'crimson' === $benefit['color'] ) ? 'icon-crimson' : 'icon-navy';
			?>
				<article class="membership-benefit-item" id="benefit-<?php echo esc_attr( $benefit['id'] ); ?>">
					<div class="benefit-circle-icon <?php echo esc_attr( $color_class ); ?>" aria-hidden="true">
						<?php
						switch ( $benefit['icon'] ) {
							case 'users':
								echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>';
								break;
							case 'chart':
								echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>';
								break;
							case 'calendar':
								echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5z"/></svg>';
								break;
							case 'heart':
								echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
								break;
							case 'book':
								echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>';
								break;
							case 'fellowship':
								echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>';
								break;
							default:
								echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>';
								break;
						}
						?>
					</div>

					<h3 class="benefit-item-title"><?php echo esc_html( $benefit['title'] ); ?></h3>
					<p class="benefit-item-desc"><?php echo esc_html( $benefit['desc'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
