<?php
/**
 * Site Header Navigation Bar
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_home              = is_front_page();
$is_about_active      = is_page( 'about' ) || is_page_template( 'templates/pages/page-about.php' ) || is_page_template( 'page-about.php' );
$is_leadership_active = is_page( 'leadership' ) || is_page_template( 'templates/pages/page-leadership.php' ) || is_page_template( 'page-leadership.php' );
$is_membership_active = is_page( 'membership' ) || is_page_template( 'templates/pages/page-membership.php' ) || is_page_template( 'page-membership.php' );
$is_directory_active  = is_page( 'alumni-directory' ) || is_page( 'directory' ) || is_page( 'business-directory' ) || is_page_template( 'templates/pages/page-alumni-directory.php' ) || is_page_template( 'page-alumni-directory.php' ) || is_page_template( 'page-directory.php' ) || is_page_template( 'templates/pages/page-business-directory.php' ) || is_page_template( 'page-business-directory.php' );
$is_events_active     = is_page( 'events' ) || is_page_template( 'templates/pages/page-events.php' ) || is_page_template( 'page-events.php' );
$is_conference_active  = is_page( '2027' ) || is_page( 'conference' ) || is_page_template( 'templates/pages/page-conference-2027.php' ) || is_page_template( 'page-conference-2027.php' ) || is_page_template( 'templates/page-lfa-conference-2027.php' );
$is_scholarships_active = is_page( 'scholarships' ) || is_page_template( 'templates/pages/page-scholarships.php' ) || is_page_template( 'page-scholarships.php' );
$is_give_active         = is_page( 'give' ) || is_page_template( 'templates/pages/page-give.php' ) || is_page_template( 'page-give.php' );
$history_page          = get_page_by_path( 'history' ) ? get_page_by_path( 'history' ) : get_page_by_path( 'our-history' );
$is_history_active    = $history_page && ( is_page( 'history' ) || is_page( 'our-history' ) );
$is_about_parent      = $is_about_active || $is_leadership_active || $is_history_active;
?>
<div class="site-nav-bar">
	<div class="lfa-container lfa-nav-inner">
		<!-- Brand Logo & Identity -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-brand" rel="home">
			<div class="brand-crest">
				<img src="<?php echo esc_url( lfa_image_url( 'brand-logo-source.jpg' ) ); ?>" 
				     alt="The Love Family Alumni Emblem" 
				     width="58" 
				     height="58" 
				     class="brand-crest-img">
			</div>
			<div class="brand-text-group">
				<span class="brand-title">THE LOVE FAMILY ALUMNI</span>
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
				<li class="menu-item menu-item-has-children <?php echo $is_about_parent ? 'current-menu-item current-menu-ancestor' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="nav-link nav-dropdown-toggle" aria-haspopup="true" aria-expanded="false">
						<span>About</span>
						<svg class="dropdown-chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
					</a>
					<ul class="sub-menu" aria-label="About Submenu">
						<li class="menu-item sub-menu-item <?php echo $is_about_active ? 'current-menu-item' : ''; ?>">
							<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="sub-nav-link">About Us</a>
						</li>
						<?php if ( $history_page ) : ?>
							<li class="menu-item sub-menu-item <?php echo $is_history_active ? 'current-menu-item' : ''; ?>">
								<a href="<?php echo esc_url( get_permalink( $history_page ) ); ?>" class="sub-nav-link">Our History</a>
							</li>
						<?php endif; ?>
						<li class="menu-item sub-menu-item <?php echo $is_leadership_active ? 'current-menu-item' : ''; ?>">
							<a href="<?php echo esc_url( home_url( '/leadership/' ) ); ?>" class="sub-nav-link">Leadership</a>
						</li>
					</ul>
				</li>
				<li class="menu-item <?php echo $is_membership_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="nav-link">Membership</a>
				</li>
				<li class="menu-item <?php echo $is_events_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="nav-link">Events</a>
				</li>
				<li class="menu-item <?php echo $is_conference_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/conference/' ) ); ?>" class="nav-link">Conference</a>
				</li>
				<li class="menu-item menu-item-has-children <?php echo $is_directory_active ? 'current-menu-item current-menu-ancestor' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/alumni-directory/' ) ); ?>" class="nav-link nav-dropdown-toggle" aria-haspopup="true" aria-expanded="false">
						<span>Directory</span>
						<svg class="dropdown-chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
					</a>
					<ul class="sub-menu" aria-label="Directory Submenu">
						<li class="menu-item sub-menu-item">
							<a href="<?php echo esc_url( home_url( '/alumni-directory/' ) ); ?>" class="sub-nav-link">Alumni Directory</a>
						</li>
						<li class="menu-item sub-menu-item">
							<a href="<?php echo esc_url( home_url( '/business-directory/' ) ); ?>" class="sub-nav-link">Business Directory</a>
						</li>
					</ul>
				</li>
				<li class="menu-item <?php echo $is_scholarships_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/scholarships/' ) ); ?>" class="nav-link">Scholarships</a>
				</li>
				<li class="menu-item <?php echo $is_give_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/give/' ) ); ?>" class="nav-link">Give</a>
				</li>
			</ul>

			<?php get_template_part( 'template-parts/site/header-account-nav' ); ?>
		</nav>

	</div>
</div>
