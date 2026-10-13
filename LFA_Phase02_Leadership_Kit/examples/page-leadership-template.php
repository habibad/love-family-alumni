<?php
/**
 * Example only. Antigravity should adapt to EXISTING theme conventions.
 * WordPress recognizes page-leadership.php as the template for slug 'leadership'.
 */
get_header();
?>
<main id="primary" class="lfa-leadership" role="main">
  <?php get_template_part('template-parts/leadership/hero'); ?>
  <?php get_template_part('template-parts/leadership/president'); ?>
  <?php get_template_part('template-parts/leadership/organization'); ?>
  <?php get_template_part('template-parts/leadership/executive'); ?>
  <?php get_template_part('template-parts/leadership/board'); ?>
  <?php get_template_part('template-parts/leadership/committees'); ?>
  <?php get_template_part('template-parts/leadership/network'); ?>
  <?php // Reuse current theme's exact existing shared CTA here. ?>
</main>
<?php get_footer(); ?>
