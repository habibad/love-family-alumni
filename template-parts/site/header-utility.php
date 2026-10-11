<?php
/**
 * Site Header Utility Bar
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="site-utility-bar">
	<div class="lfa-container lfa-utility-inner">
		<div class="utility-left">
			<a href="mailto:lovefamilyalumni.na@gmail.com" class="utility-link" aria-label="Email Love Family Alumni">
				<span class="utility-icon icon-mail"><?php echo lfa_icon( 'mail' ); ?></span>
				<span>lovefamilyalumni.na@gmail.com</span>
			</a>
			<span class="utility-item">
				<span class="utility-icon icon-pin"><?php echo lfa_icon( 'map-pin' ); ?></span>
				<span>North America Zone</span>
			</span>
		</div>
		<div class="utility-right">
			<nav class="utility-nav" aria-label="Utility Navigation">
				<a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="utility-nav-link">News</a>
				<span class="utility-divider" aria-hidden="true">|</span>
				<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="utility-nav-link">Gallery</a>
				<span class="utility-divider" aria-hidden="true">|</span>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="utility-nav-link">Contact</a>
			</nav>
			<div class="utility-social">
				<a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="utility-social-link" aria-label="Facebook">
					<?php echo lfa_icon( 'facebook' ); ?>
				</a>
				<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="utility-social-link" aria-label="LinkedIn">
					<?php echo lfa_icon( 'linkedin' ); ?>
				</a>
				<a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="utility-social-link" aria-label="YouTube">
					<?php echo lfa_icon( 'youtube' ); ?>
				</a>
			</div>
			<div class="utility-search">
				<a href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" class="utility-search-link" aria-label="Search">
					<?php echo lfa_icon( 'search' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
