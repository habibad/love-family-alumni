<?php
/**
 * Events Page — Single Event Detail View (EVE-004, EVE-015, EVE-016, EVE-017)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$event = $args['event'] ?? null;
if ( empty( $event ) ) {
	return;
}
?>

<div class="single-event-page-wrapper" aria-label="<?php echo esc_attr( $event['title'] ); ?>">
	
	<!-- Hero Section -->
	<section class="single-event-hero" style="background: #071d3e; color: #fff; padding: 70px 24px 50px; text-align: center;">
		<div class="lfa-container" style="max-width: 960px; margin: 0 auto;">
			
			<!-- Breadcrumb Navigation -->
			<nav class="single-event-breadcrumb" aria-label="Breadcrumb" style="margin-bottom: 24px; font-size: 14px;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #c6953d; text-decoration: none;">Home</a>
				<span style="color: #8892b0; margin: 0 8px;">/</span>
				<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" style="color: #c6953d; text-decoration: none;">Events</a>
				<span style="color: #8892b0; margin: 0 8px;">/</span>
				<span style="color: #e2e8f0;"><?php echo esc_html( $event['title'] ); ?></span>
			</nav>

			<div style="display: inline-block; background: rgba(198, 149, 61, 0.2); border: 1px solid #c6953d; color: #c6953d; padding: 4px 14px; border-radius: 999px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 16px;">
				<?php echo esc_html( $event['category_label'] ); ?>
			</div>

			<h1 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: #fff; margin: 0 0 16px; line-height: 1.2;">
				<?php echo esc_html( $event['title'] ); ?>
			</h1>

			<!-- Event Timing & Location Pills -->
			<div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 20px; font-size: 15px;">
				<div style="background: rgba(255,255,255,0.08); padding: 8px 18px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c6953d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
					<span><strong>Date:</strong> <?php echo esc_html( $event['date_label'] ); ?></span>
				</div>
				<div style="background: rgba(255,255,255,0.08); padding: 8px 18px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c6953d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
					<span><strong>Location:</strong> <?php echo esc_html( $event['location'] ); ?></span>
				</div>
			</div>

		</div>
	</section>

	<!-- Main Content Section -->
	<section class="single-event-body-section" style="padding: 60px 20px; background: #f8fafc;">
		<div class="lfa-container" style="max-width: 960px; margin: 0 auto;">
			<div style="background: #fff; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); overflow: hidden; border: 1px solid #e2e8f0;">
				
				<?php if ( ! empty( $event['image_url'] ) ) : ?>
					<div style="max-height: 440px; overflow: hidden; position: relative;">
						<img src="<?php echo esc_url( $event['image_url'] ); ?>" 
						     alt="<?php echo esc_attr( $event['image_alt'] ); ?>" 
						     style="width: 100%; height: 100%; object-fit: cover;">
					</div>
				<?php endif; ?>

				<div style="padding: 40px clamp(20px, 4vw, 50px);">
					
					<!-- Metadata Card Info -->
					<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; background: #f1f5f9; padding: 24px; border-radius: 12px; margin-bottom: 36px;">
						<div>
							<h4 style="margin: 0 0 6px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">Schedule &amp; Timezone</h4>
							<p style="margin: 0; font-size: 15px; font-weight: 600; color: #071d3e;">
								<?php echo esc_html( $event['date_label'] ); ?><br>
								<small style="color: #64748b; font-weight: 400;"><?php echo esc_html( $event['timezone'] ); ?></small>
							</p>
						</div>

						<div>
							<h4 style="margin: 0 0 6px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">Assembly Details</h4>
							<p style="margin: 0; font-size: 15px; font-weight: 600; color: #071d3e;">
								<?php echo esc_html( $event['location'] ); ?>
								<?php if ( ! empty( $event['venue_address'] ) ) : ?>
									<br><small style="color: #64748b; font-weight: 400;"><?php echo esc_html( $event['venue_address'] ); ?></small>
								<?php endif; ?>
							</p>
						</div>

						<?php if ( ! empty( $event['online_url'] ) ) : ?>
							<div>
								<h4 style="margin: 0 0 6px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">Virtual Access</h4>
								<p style="margin: 0; font-size: 15px;">
									<a href="<?php echo esc_url( $event['online_url'] ); ?>" target="_blank" rel="noopener noreferrer" style="color: #0073aa; font-weight: 600; text-decoration: underline;">
										Join Virtual Stream &rarr;
									</a>
								</p>
							</div>
						<?php endif; ?>
					</div>

					<!-- Narrative Content -->
					<div class="single-event-content" style="font-size: 1.1rem; line-height: 1.8; color: #334155;">
						<?php echo wp_kses_post( $event['content'] ?: '<p>' . esc_html( $event['summary'] ) . '</p>' ); ?>
					</div>

					<!-- Conference Cross-link or Action Button (EVE-018) -->
					<?php if ( ! empty( $event['action_url'] ) && $event['action_url'] !== $event['permalink'] ) : ?>
						<div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
							<div>
								<h4 style="margin: 0; color: #071d3e; font-size: 16px;">Continental Conference Portal</h4>
								<p style="margin: 4px 0 0; color: #64748b; font-size: 14px;">Registration, passes, and speaker keynote details are coordinated through the conference module.</p>
							</div>
							<a href="<?php echo esc_url( $event['action_url'] ); ?>" class="btn btn-primary" style="background: #8b1e23; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700;">
								<?php echo esc_html( $event['action_label'] ); ?> &rarr;
							</a>
						</div>
					<?php endif; ?>

					<div style="margin-top: 40px; display: flex; justify-content: flex-start;">
						<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #071d3e; font-weight: 600; text-decoration: none; font-size: 15px;">
							&larr; Back to All Events &amp; Gatherings
						</a>
					</div>

				</div>
			</div>
		</div>
	</section>

</div>
