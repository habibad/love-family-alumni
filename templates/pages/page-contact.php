<?php
/**
 * Template Name: LFA — Contact Us
 * Description: Master template for Love Family Alumni Contact Us Page
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Centralized static data repository
$contact_data = require get_theme_file_path( 'inc/data/demo-contact.php' );
?>

<div id="primary" class="lfa-contact" aria-label="Love Family Alumni Contact Us">
	<?php
	// Section 01: Hero Section
	get_template_part( 'template-parts/contact/hero', null, [ 'data' => $contact_data ] );

	// Section 02: Quick Contact Information Cards
	get_template_part( 'template-parts/contact/contact-info', null, [ 'data' => $contact_data ] );

	// Section 03: Main Contact Form (with Asymmetric Info Panel & Review Preview)
	get_template_part( 'template-parts/contact/contact-form', null, [ 'data' => $contact_data ] );

	// Section 04: Connect With Your Alumni Community (3 Pathways)
	get_template_part( 'template-parts/contact/community-links', null, [ 'data' => $contact_data ] );

	// Section 05: Contact FAQs (Accessible Native Accordions)
	get_template_part( 'template-parts/contact/faq', null, [ 'data' => $contact_data ] );

	// Section 06: Final Contact Call to Action
	get_template_part( 'template-parts/contact/final-cta', null, [ 'data' => $contact_data ] );
	?>
</div>

<?php
get_footer();
