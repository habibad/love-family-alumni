<?php
/**
 * Homepage Scholarships and Giving Paired Cards Section
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="scholarships-giving-section" aria-label="Scholarships and Giving">
	<div class="lfa-container">
		<div class="dual-feature-grid">
			<!-- Card 1: Scholarships -->
			<div class="feature-card feature-card-scholarships">
				<div class="feature-card-content">
					<div class="feature-header-group">
						<span class="feature-icon feature-icon-navy">
							<?php echo lfa_icon( 'graduation-cap' ); ?>
						</span>
						<div class="feature-title-wrap">
							<h3 class="feature-title">SCHOLARSHIPS</h3>
							<span class="feature-subtitle">Investing in Future Generations</span>
						</div>
					</div>
					<p class="feature-text">
						We support the educational dreams of deserving students from the Love Family through scholarships and academic support programs.
					</p>
					<div class="feature-btn-wrap">
						<a href="<?php echo esc_url( home_url( '/scholarships/' ) ); ?>" class="btn btn-crimson">
							Learn About Scholarships
						</a>
					</div>
				</div>
				<div class="feature-card-media">
					<img src="<?php echo esc_url( lfa_image_url( 'scholarship-cap.jpg' ) ); ?>" 
					     alt="Academic Scholarship Books and Mortarboard" 
					     loading="lazy" 
					     class="feature-img">
				</div>
			</div>

			<!-- Card 2: Giving -->
			<div class="feature-card feature-card-giving">
				<div class="feature-card-content">
					<div class="feature-header-group">
						<span class="feature-icon feature-icon-crimson">
							<?php echo lfa_icon( 'heart-hand' ); ?>
						</span>
						<div class="feature-title-wrap">
							<h3 class="feature-title">GIVING</h3>
							<span class="feature-subtitle">Make a Lasting Impact</span>
						</div>
					</div>
					<p class="feature-text">
						Your generous contributions help us support scholarships, community initiatives and programs that strengthen our family legacy.
					</p>
					<div class="feature-btn-wrap">
						<a href="<?php echo esc_url( home_url( '/give/' ) ); ?>" class="btn btn-crimson">
							Give Today
						</a>
					</div>
				</div>
				<div class="feature-card-media">
					<img src="<?php echo esc_url( lfa_image_url( 'giving-heart.jpg' ) ); ?>" 
					     alt="Giving Hands Holding Heart" 
					     loading="lazy" 
					     class="feature-img">
				</div>
			</div>
		</div>
	</div>
</section>
