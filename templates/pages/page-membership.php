<?php
/**
 * Template Name: Membership Page
 * Description: Master template for the Love Family Alumni Membership page (Phase 02 / Page 03)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="membership-page-wrapper lfa-membership">
	<?php
	// Section 01: Hero Section
	get_template_part( 'template-parts/membership/hero' );

	// Section 02: Membership Benefits
	get_template_part( 'template-parts/membership/benefits' );

	// Section 03: Membership Plans
	get_template_part( 'template-parts/membership/plans' );

	// Section 04: How Membership Works (Registration Workflow)
	get_template_part( 'template-parts/membership/how-it-works' );

	// Section 05: Dues & Renewals Information
	get_template_part( 'template-parts/membership/dues-renewal' );

	// Section 06: Member Portal Preview
	get_template_part( 'template-parts/membership/portal-preview' );

	// Section 07: Alumni Community Gallery
	get_template_part( 'template-parts/membership/community' );

	// Section 08: Frequently Asked Questions
	get_template_part( 'template-parts/membership/faq' );

	// Section 09: Approved Final CTA
	get_template_part( 'template-parts/home/join-cta' );
	?>
</div>

<?php
get_footer();
