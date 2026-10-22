<?php
/**
 * Template Name: LFA — Accessibility Statement
 * Description: Official Accessibility Statement for The Love Family Alumni (North America Zone)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main lfa-legal-page" aria-label="Accessibility Statement">
	<!-- Hero / Banner -->
	<header class="lfa-legal-hero">
		<div class="lfa-container">
			<span class="lfa-pill">Inclusivity &amp; Access</span>
			<h1 class="lfa-legal-title">Accessibility Statement</h1>
			<p class="lfa-legal-subtitle">
				The Love Family Alumni is committed to providing a welcoming, accessible digital experience for all alumni, guests, and community members.
			</p>
			<p class="lfa-legal-effective">
				Standard: WCAG 2.1 Level AA Guidelines &nbsp;|&nbsp; <em>September 2026</em>
			</p>
		</div>
	</header>

	<!-- Content Body -->
	<div class="lfa-legal-container">
		<article class="lfa-legal-card">
			<h2>1. Our Commitment</h2>
			<p>The Love Family Alumni — North America Zone believes that our digital platforms should be accessible to everyone, including individuals with visual, auditory, cognitive, or motor impairments. We continually strive to align our web experience with the World Wide Web Consortium's (W3C) Web Content Accessibility Guidelines (WCAG) 2.1 at Level AA.</p>

			<h2>2. Accessibility Features on This Website</h2>
			<ul>
				<li><strong>Keyboard Operability:</strong> All navigation menus, dropdowns, modal windows, drawer toggles, and form controls are fully navigable using standard keyboard commands (Tab, Shift+Tab, Enter, Escape).</li>
				<li><strong>Skip to Content Links:</strong> A native skip link is provided at the very top of each page to bypass repetitive navigation directly to primary content.</li>
				<li><strong>Color Contrast:</strong> Colors comply with WCAG contrast ratios, utilizing our curated palette of deep navy (#0A203A), crimson (#AB1640), and warm gold (#C6933D) on high-contrast backgrounds.</li>
				<li><strong>Screen Reader Semantic Structure:</strong> Clear heading hierarchies (h1–h4), ARIA roles, descriptive alt text for images, and explicit form field labels.</li>
				<li><strong>Reduced Motion:</strong> Animations and transitions automatically respect the user's operating system preferences (`prefers-reduced-motion`).</li>
			</ul>

			<h2>3. Ongoing Improvements &amp; Feedback</h2>
			<p>We actively test and refine our application shells, directory filters, and member portals. If you encounter any barriers or accessibility challenges, please let our team know:</p>
			
			<div class="lfa-legal-contact-box">
				<strong>The Love Family Alumni — North America Zone</strong><br>
				Accessibility &amp; Technical Support Team<br>
				Email: <a href="mailto:lovefamilyalumni.na@gmail.com">lovefamilyalumni.na@gmail.com</a>
			</div>
		</article>
	</div>
</main>

<?php
get_footer();
