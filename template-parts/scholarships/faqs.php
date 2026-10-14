<?php
/**
 * Scholarships — Frequently Asked Questions (Task 03)
 * Native details: keyboard accessible without JavaScript.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$task03 = isset( $args['data'] ) && is_array( $args['data'] ) ? $args['data'] : [];
$faqs   = isset( $task03['faqs'] ) && is_array( $task03['faqs'] ) ? $task03['faqs'] : [];
?>
<section id="scholarship-faq" class="lfa-scholarships__faq" aria-labelledby="lfa-scholarships-faq-title">
	<div class="lfa-scholarships__container lfa-scholarships__faq-layout">
		<div class="lfa-scholarships__faq-intro">
			<p class="lfa-scholarships__eyebrow">HELPFUL INFORMATION</p>
			<h2 id="lfa-scholarships-faq-title">Frequently Asked <em>Questions.</em></h2>
			<p>Find clarity about the current status of future scholarship opportunities. Official rules, dates and processes will be shared only when confirmed.</p>
			<span class="lfa-scholarships__faq-note">Information status: <strong>Not yet announced</strong></span>
		</div>
		<div class="lfa-scholarships__faq-items">
			<?php foreach ( $faqs as $i => $faq ) : ?>
				<details class="lfa-scholarships__faq-item"<?php echo $i === 0 ? ' open' : ''; ?>>
					<summary>
						<span class="lfa-scholarships__faq-number"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<span class="lfa-scholarships__faq-question"><?php echo esc_html( $faq['question'] ); ?></span>
						<span class="lfa-scholarships__faq-plus" aria-hidden="true"></span>
					</summary>
					<div class="lfa-scholarships__faq-answer">
						<p><?php echo esc_html( $faq['answer'] ); ?></p>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
