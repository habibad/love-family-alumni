<?php
/**
 * Site Header Navigation Bar
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_url = home_url( add_query_arg( [], $GLOBALS['wp']->request ) );
$is_home     = is_front_page();
?>
<div class="site-nav-bar">
	<div class="lfa-container lfa-nav-inner">
		<!-- Brand Logo & Identity -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-brand" rel="home">
			<div class="brand-crest">
				<img src="<?php echo esc_url( lfa_image_url( 'brand-logo-source.jpg' ) ); ?>" 
				     alt="Love Family Alumni Emblem" 
				     width="58" 
				     height="58" 
				     class="brand-crest-img">
			</div>
			<div class="brand-text-group">
				<span class="brand-title">LOVE FAMILY ALUMNI</span>
				<span class="brand-zone">NORTH AMERICA ZONE</span>
				<span class="brand-tagline">ONE FAMILY. ACROSS BORDERS. IMPACTING GENERATIONS.</span>
			</div>
		</a>

		<!-- Mobile Navigation Toggle -->
		<button type="button" class="mobile-nav-toggle" aria-controls="primary-navigation" aria-expanded="false" aria-label="Toggle navigation menu">
			<span class="hamburger-icon" aria-hidden="true">
				<span></span>
				<span></span>
				<span></span>
			</span>
		</button>

		<!-- Primary Navigation Links & Actions -->
		<nav id="primary-navigation" class="primary-nav-wrapper" aria-label="Primary Navigation">
			<ul class="nav-menu">
				<li class="menu-item <?php echo $is_home ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">Home</a>
				</li>
				<li class="menu-item <?php echo ( is_page( 'about' ) || is_page_template( 'templates/pages/page-about.php' ) || is_page_template( 'page-about.php' ) ) ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="nav-link">About</a>
				</li>
				<li class="menu-item">
					<a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="nav-link">Membership</a>
				</li>
				<li class="menu-item">
					<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="nav-link">Events</a>
				</li>
				<li class="menu-item">
					<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="nav-link">Conference</a>
				</li>
				<li class="menu-item">
					<a href="<?php echo esc_url( home_url( '/directory/' ) ); ?>" class="nav-link">Directory</a>
				</li>
				<li class="menu-item">
					<a href="<?php echo esc_url( home_url( '/scholarships/' ) ); ?>" class="nav-link">Scholarships</a>
				</li>
				<li class="menu-item">
					<a href="<?php echo esc_url( home_url( '/give/' ) ); ?>" class="nav-link">Give</a>
				</li>
			</ul>

			<div class="nav-actions">
				<a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="btn btn-crimson btn-login">
					Login
				</a>
			</div>
		</nav>
	</div>
</div>
