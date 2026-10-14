<?php
/**
 * Scholarships — Hero Section (Task 01)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="lfa-scholarships__hero" aria-labelledby="lfa-scholarships-hero-heading">
  <div class="lfa-scholarships__hero-media" role="img" aria-label="Love Family Alumni at a community gathering"></div>
  <div class="lfa-scholarships__container lfa-scholarships__hero-inner">
    <div class="lfa-scholarships__hero-content">
      <nav class="lfa-scholarships__breadcrumbs" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span aria-hidden="true">/</span><span>Scholarships</span>
      </nav>
      <div class="lfa-scholarships__eyebrow lfa-scholarships__eyebrow--gold">SCHOLARSHIPS &amp; STUDENT SUPPORT</div>
      <h1 id="lfa-scholarships-hero-heading">Investing in Potential.<br><em>Building Tomorrow.</em></h1>
      <p>Supporting future generations through education, opportunity, and a shared commitment to the Love Family legacy.</p>
      <div class="lfa-scholarships__hero-actions">
        <a class="lfa-scholarships__btn lfa-scholarships__btn--primary" href="#scholarship-programs">Explore Programs <span aria-hidden="true">&rarr;</span></a>
        <a class="lfa-scholarships__btn lfa-scholarships__btn--outline" href="#scholarship-mission">Our Mission</a>
      </div>
    </div>
    <div class="lfa-scholarships__hero-quote" aria-hidden="true"><span>EDUCATION</span><strong>Opportunity for the next generation.</strong></div>
  </div>
</section>
