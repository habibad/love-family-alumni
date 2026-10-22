<?php
/**
 * Give / Donations — Ways to Give Categories (Phase 08 Dynamic Giving)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = $args['data']['categories'] ?? [];

// Dynamically populate from database if LFA_Donation is active
if ( class_exists( 'LFA_Donation' ) ) {
	$db_funds = LFA_Donation::get_published_funds();
	if ( ! empty( $db_funds ) ) {
		$categories = [];
		$i = 1;
		foreach ( $db_funds as $f ) {
			$categories[] = [
				'id'                   => $f->slug,
				'db_id'                => (int) $f->id,
				'number'               => sprintf( '0%d', $i ),
				'title'                => $f->title,
				'description'          => $f->description,
				'icon'                 => $f->icon,
				'is_active'            => ( 1 === $i ),
				'min_dollars'          => (int) round( $f->min_amount_cents / 100 ),
				'max_dollars'          => (int) round( $f->max_amount_cents / 100 ),
				'guest_giving_enabled' => ( (int) $f->guest_giving_enabled === 1 ),
			];
			$i++;
		}
	}
}
?>

<section id="give-categories" class="lfa-give__categories" aria-labelledby="lfa-give-categories-heading">
	<div class="lfa-give__container">
		<!-- Section Header -->
		<div class="lfa-give__section-header">
			<div class="lfa-give__header-top">
				<div class="lfa-give__eyebrow lfa-give__eyebrow--crimson">WAYS TO MAKE A DIFFERENCE</div>
				<div class="lfa-give__status-pill">OFFICIAL FUNDS</div>
			</div>
			<h2 id="lfa-give-categories-heading" class="lfa-give__section-heading">
				Choose a Cause <span class="text-crimson">Close to You.</span>
			</h2>
			<p class="lfa-give__section-subtitle">
				Explore verified alumni giving categories and partner with Love Family Alumni across North America.
			</p>
		</div>

		<!-- 4 Cards Grid -->
		<div class="lfa-give__categories-grid" role="group" aria-label="Donation Cause Selection">
			<?php foreach ( $categories as $cat ) :
				$is_active = ! empty( $cat['is_active'] );
			?>
				<div class="lfa-give__card <?php echo $is_active ? 'is-active' : ''; ?>"
				     id="cause-card-<?php echo esc_attr( $cat['id'] ); ?>"
				     data-cause-id="<?php echo esc_attr( $cat['id'] ); ?>"
				     data-cause-db-id="<?php echo esc_attr( $cat['db_id'] ?? '' ); ?>"
				     data-cause-title="<?php echo esc_attr( $cat['title'] ); ?>"
				     data-min="<?php echo esc_attr( $cat['min_dollars'] ?? 1 ); ?>"
				     data-max="<?php echo esc_attr( $cat['max_dollars'] ?? 10000 ); ?>"
				     data-guest="<?php echo ! empty( $cat['guest_giving_enabled'] ) ? '1' : '0'; ?>"
				     tabindex="0"
				     role="button"
				     aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>">
					
					<div class="lfa-give__card-top">
						<!-- Icon Circle -->
						<div class="lfa-give__card-icon-wrap" aria-hidden="true">
							<?php if ( 'scholarship' === $cat['icon'] ) : ?>
								<svg class="cause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
									<path d="M6 12v5c3 3 9 3 12 0v-5"></path>
								</svg>
							<?php elseif ( 'users' === $cat['icon'] ) : ?>
								<svg class="cause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
									<circle cx="9" cy="7" r="4"></circle>
									<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
									<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
								</svg>
							<?php elseif ( 'book' === $cat['icon'] || 'archives' === $cat['icon'] ) : ?>
								<svg class="cause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
									<path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
								</svg>
							<?php elseif ( 'globe' === $cat['icon'] ) : ?>
								<svg class="cause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<circle cx="12" cy="12" r="10"></circle>
									<line x1="2" y1="12" x2="22" y2="12"></line>
									<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
								</svg>
							<?php else : ?>
								<svg class="cause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
								</svg>
							<?php endif; ?>
						</div>

						<span class="lfa-give__card-num"><?php echo esc_html( $cat['number'] ); ?></span>
					</div>

					<!-- Title & Body -->
					<h3 class="lfa-give__card-title"><?php echo esc_html( $cat['title'] ); ?></h3>
					<p class="lfa-give__card-desc"><?php echo esc_html( $cat['description'] ); ?></p>

					<hr class="lfa-give__card-divider">

					<!-- Action Label / Button -->
					<div class="lfa-give__card-action">
						<span class="action-text"><?php echo $is_active ? 'Selected Cause' : 'Select Cause'; ?></span>
						<svg class="action-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="7" y1="17" x2="17" y2="7"></line>
							<polyline points="7 7 17 7 17 17"></polyline>
						</svg>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
