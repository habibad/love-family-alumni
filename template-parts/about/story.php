<?php
/**
 * About Page Section 02 — Our Story
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="about-story-section" id="our-story" aria-label="Our Story and Heritage">
	<div class="lfa-container about-story-container">
		<!-- Section Header -->
		<div class="about-section-header">
			<span class="section-eyebrow eyebrow-crimson">OUR STORY & HERITAGE</span>
			<h2 class="about-section-title">Rooted in Faith. Flourishing Across Continents.</h2>
			<div class="about-header-gold-line" aria-hidden="true"></div>
		</div>

		<!-- Two-Column Editorial Layout -->
		<div class="about-story-grid">
			<!-- Col 1: Narrative & Context -->
			<div class="about-story-text-col">
				<div class="about-story-lead-box">
					<p class="story-lead-paragraph">
						The Love Family began as a divine covenant of fellowship, prayer, and unconditional love among young Christian students at the University of Benin (UNIBEN) in Edo State, Nigeria. 
					</p>
				</div>

				<div class="story-prose">
					<h3 class="story-subheading">A Campus Covenant of Brotherhood & Sisterhood</h3>
					<p>
						In an academic environment defined by rigorous study and demanding life challenges, the Love Family fellowship was a haven of spiritual warmth, academic accountability, and genuine brotherhood. Members did not merely attend university lectures together; they shared meals, prayed for one another's families, tutored each other through challenging courses, and laid the groundwork for relationships that would span a lifetime.
					</p>

					<p>
						As alumni graduated and embarked on careers across engineering, medicine, public governance, technology, corporate finance, and ministry, that foundational culture of family never faded. Instead, it grew stronger, traversing international borders as graduates dispersed across the globe.
					</p>

					<div class="story-callout-card">
						<div class="story-callout-crest">
							<img src="<?php echo esc_url( lfa_image_url( 'brand-logo-source.jpg' ) ); ?>" 
							     alt="Love Family Emblem" 
							     width="64" 
							     height="64" 
							     class="story-callout-crest-img">
						</div>
						<div class="story-callout-text">
							<h4 class="callout-title">The Global Fraternity vs. The North America Zone</h4>
							<p>
								<strong>The Love Family Alumni (Global)</strong> represents the overarching worldwide alumni movement encompassing all graduating classes from the University of Benin and associated global chapters.
							</p>
							<p>
								The <strong>North America Zone</strong> operates as a chartered regional entity specifically established to serve alumni residing across the United States and Canada—addressing the unique professional, personal, and cultural needs of our diaspora community while actively supporting the global mission.
							</p>
						</div>
					</div>

					<p>
						Today, whether an alumnus is establishing a medical practice in Texas, leading research in Ontario, managing tech enterprises in Silicon Valley, or launching community initiatives in New York, the North America Zone ensures no member ever walks alone.
					</p>
				</div>
			</div>

			<!-- Col 2: Visual & Archival Imagery -->
			<div class="about-story-visual-col">
				<div class="story-photo-card card-primary">
					<img src="<?php echo esc_url( lfa_image_url( 'alumni-small-group.jpg' ) ); ?>" 
					     alt="Alumni gathered in shared fellowship" 
					     class="story-photo-img" 
					     loading="lazy">
					<div class="story-photo-caption">
						<span class="caption-tag">COMMUNITY TIES</span>
						<p class="caption-text">Generations of alumni reconnecting in fellowship and mutual encouragement.</p>
					</div>
				</div>

				<!-- Supporting Pullquote Card -->
				<div class="story-quote-card">
					<div class="quote-mark" aria-hidden="true">“</div>
					<blockquote class="quote-body">
						We were not just classmates on a campus; we were nurtured in a sacred culture of family that has defied distance, oceans, and time.
					</blockquote>
					<div class="quote-author">
						<span class="author-name">The Love Family Alumni Heritage</span>
						<span class="author-sub">University of Benin Alumni Tradition</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
