<?php
/**
 * Enqueue scripts and styles
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lfa_enqueue_assets(): void {
	// Google Fonts: Playfair Display (Serif display), Inter (Sans-serif UI), Caveat (Script)
	wp_enqueue_style(
		'lfa-google-fonts',
		'https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Inter:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&display=swap',
		[],
		null
	);

	// Main stylesheet
	wp_enqueue_style(
		'lfa-main-style',
		get_template_directory_uri() . '/assets/css/main.css',
		[ 'lfa-google-fonts' ],
		filemtime( get_template_directory() . '/assets/css/main.css' )
	);

	// Theme style.css for metadata/fallbacks
	wp_enqueue_style(
		'lfa-theme-style',
		get_stylesheet_uri(),
		[ 'lfa-main-style' ],
		filemtime( get_template_directory() . '/style.css' )
	);

	// Public Header Profile Dropdown (Phase 07)
	wp_enqueue_style(
		'lfa-profile-dropdown-style',
		get_template_directory_uri() . '/assets/css/profile-dropdown.css',
		[ 'lfa-main-style' ],
		file_exists( get_template_directory() . '/assets/css/profile-dropdown.css' ) ? filemtime( get_template_directory() . '/assets/css/profile-dropdown.css' ) : '1.0.0'
	);
	wp_enqueue_script(
		'lfa-profile-dropdown-js',
		get_template_directory_uri() . '/assets/js/profile-dropdown.js',
		[],
		file_exists( get_template_directory() . '/assets/js/profile-dropdown.js' ) ? filemtime( get_template_directory() . '/assets/js/profile-dropdown.js' ) : '1.0.0',
		true
	);


	// About Us Page Scoped Stylesheet (Phase 02)
	if ( is_page( 'about' ) || is_page_template( 'templates/pages/page-about.php' ) || is_page_template( 'page-about.php' ) ) {
		wp_enqueue_style(
			'lfa-about-style',
			get_template_directory_uri() . '/assets/css/about.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/about.css' ) ? filemtime( get_template_directory() . '/assets/css/about.css' ) : '1.0.0'
		);
	}

	// Leadership Page Scoped Stylesheet (Phase 02 / Page 02)
	if ( is_page( 'leadership' ) || is_page_template( 'templates/pages/page-leadership.php' ) || is_page_template( 'page-leadership.php' ) ) {
		wp_enqueue_style(
			'lfa-leadership-style',
			get_template_directory_uri() . '/assets/css/leadership.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/leadership.css' ) ? filemtime( get_template_directory() . '/assets/css/leadership.css' ) : '1.0.0'
		);
	}

	// Membership Page Scoped Stylesheet (Phase 02 / Page 03)
	if ( is_page( 'membership' ) || is_page_template( 'templates/pages/page-membership.php' ) || is_page_template( 'page-membership.php' ) ) {
		wp_enqueue_style(
			'lfa-membership-style',
			get_template_directory_uri() . '/assets/css/membership.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/membership.css' ) ? filemtime( get_template_directory() . '/assets/css/membership.css' ) : '1.0.0'
		);
	}

	// Alumni Directory Page Scoped Stylesheet & Script (Phase 02 / Page 04)
	if ( is_page( 'alumni-directory' ) || is_page( 'directory' ) || is_page_template( 'templates/pages/page-alumni-directory.php' ) || is_page_template( 'page-alumni-directory.php' ) || is_page_template( 'page-directory.php' ) ) {
		wp_enqueue_style(
			'lfa-directory-style',
			get_template_directory_uri() . '/assets/css/alumni-directory.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/alumni-directory.css' ) ? filemtime( get_template_directory() . '/assets/css/alumni-directory.css' ) : '1.0.0'
		);
		wp_enqueue_script(
			'lfa-directory-js',
			get_template_directory_uri() . '/assets/js/alumni-directory.js',
			[ 'lfa-main-js' ],
			file_exists( get_template_directory() . '/assets/js/alumni-directory.js' ) ? filemtime( get_template_directory() . '/assets/js/alumni-directory.js' ) : '1.0.0',
			true
		);
	}

	// Events Page Scoped Stylesheet & Script (Phase 02 / Page 05)
	if ( is_page( 'events' ) || is_page_template( 'templates/pages/page-events.php' ) || is_page_template( 'page-events.php' ) ) {
		wp_enqueue_style(
			'lfa-events-style',
			get_template_directory_uri() . '/assets/css/events.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/events.css' ) ? filemtime( get_template_directory() . '/assets/css/events.css' ) : '1.0.0'
		);
		wp_enqueue_script(
			'lfa-events-js',
			get_template_directory_uri() . '/assets/js/events.js',
			[ 'lfa-main-js' ],
			file_exists( get_template_directory() . '/assets/js/events.js' ) ? filemtime( get_template_directory() . '/assets/js/events.js' ) : '1.0.0',
			true
		);
	}

	// Conference 2027 Page Scoped Stylesheet (Task 01 & Complete Frontend)
	if ( is_page( '2027' ) || is_page( 'conference' ) || is_page_template( 'templates/pages/page-conference-2027.php' ) || is_page_template( 'page-conference-2027.php' ) || is_page_template( 'page-conference.php' ) || is_page_template( 'templates/page-lfa-conference-2027.php' ) ) {
		wp_enqueue_style(
			'lfa-conference-2027-style',
			get_template_directory_uri() . '/assets/css/conference-2027.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/conference-2027.css' ) ? filemtime( get_template_directory() . '/assets/css/conference-2027.css' ) : '1.0.0'
		);
		if ( file_exists( get_template_directory() . '/assets/css/conference-2027-phase2.css' ) ) {
			wp_enqueue_style(
				'lfa-conference-2027-phase2-style',
				get_template_directory_uri() . '/assets/css/conference-2027-phase2.css',
				[ 'lfa-conference-2027-style' ],
				filemtime( get_template_directory() . '/assets/css/conference-2027-phase2.css' )
			);
		}
	}

	// Business Directory Page Scoped Stylesheet & Script
	if ( is_page( 'business-directory' ) || is_page_template( 'templates/pages/page-business-directory.php' ) || is_page_template( 'page-business-directory.php' ) ) {
		wp_enqueue_style(
			'lfa-business-directory-style',
			get_template_directory_uri() . '/assets/css/business-directory.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/business-directory.css' ) ? filemtime( get_template_directory() . '/assets/css/business-directory.css' ) : '1.0.0'
		);
		wp_enqueue_script(
			'lfa-business-directory-js',
			get_template_directory_uri() . '/assets/js/business-directory.js',
			[ 'lfa-main-js' ],
			file_exists( get_template_directory() . '/assets/js/business-directory.js' ) ? filemtime( get_template_directory() . '/assets/js/business-directory.js' ) : '1.0.0',
			true
		);
	}

	// News & Announcements Page Scoped Stylesheet & Script
	if ( is_page( 'news' ) || is_page( 'news-details' ) || is_page_template( 'templates/pages/page-news.php' ) || is_page_template( 'page-news.php' ) || is_page_template( 'templates/pages/page-news-details.php' ) || is_page_template( 'page-news-details.php' ) ) {
		wp_enqueue_style(
			'lfa-news-style',
			get_template_directory_uri() . '/assets/css/news.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/news.css' ) ? filemtime( get_template_directory() . '/assets/css/news.css' ) : '1.0.0'
		);
		if ( file_exists( get_template_directory() . '/assets/css/news-task03.css' ) ) {
			wp_enqueue_style(
				'lfa-news-task03-style',
				get_template_directory_uri() . '/assets/css/news-task03.css',
				[ 'lfa-news-style' ],
				filemtime( get_template_directory() . '/assets/css/news-task03.css' )
			);
		}
		wp_enqueue_script(
			'lfa-news-js',
			get_template_directory_uri() . '/assets/js/news.js',
			[ 'lfa-main-js' ],
			file_exists( get_template_directory() . '/assets/js/news.js' ) ? filemtime( get_template_directory() . '/assets/js/news.js' ) : '1.0.0',
			true
		);
		if ( file_exists( get_template_directory() . '/assets/js/news-task03.js' ) ) {
			wp_enqueue_script(
				'lfa-news-task03-js',
				get_template_directory_uri() . '/assets/js/news-task03.js',
				[ 'lfa-news-js' ],
				filemtime( get_template_directory() . '/assets/js/news-task03.js' ),
				true
			);
		}
	}

	// Scholarships Page Scoped Stylesheet & Script (Phase 02 / Task 01 & Task 02)
	if ( is_page( 'scholarships' ) || is_page_template( 'templates/pages/page-scholarships.php' ) || is_page_template( 'page-scholarships.php' ) ) {
		wp_enqueue_style(
			'lfa-scholarships-style',
			get_template_directory_uri() . '/assets/css/scholarships.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/scholarships.css' ) ? filemtime( get_template_directory() . '/assets/css/scholarships.css' ) : '1.0.0'
		);
		if ( file_exists( get_template_directory() . '/assets/css/scholarships-task02.css' ) ) {
			wp_enqueue_style(
				'lfa-scholarships-task02-style',
				get_template_directory_uri() . '/assets/css/scholarships-task02.css',
				[ 'lfa-scholarships-style' ],
				filemtime( get_template_directory() . '/assets/css/scholarships-task02.css' )
			);
		}
		if ( file_exists( get_template_directory() . '/assets/css/scholarships-task03.css' ) ) {
			wp_enqueue_style(
				'lfa-scholarships-task03-style',
				get_template_directory_uri() . '/assets/css/scholarships-task03.css',
				[ 'lfa-scholarships-style', 'lfa-scholarships-task02-style' ],
				filemtime( get_template_directory() . '/assets/css/scholarships-task03.css' )
			);
		}
		if ( file_exists( get_template_directory() . '/assets/js/scholarships-task02.js' ) ) {
			wp_enqueue_script(
				'lfa-scholarships-task02-js',
				get_template_directory_uri() . '/assets/js/scholarships-task02.js',
				[ 'lfa-main-js' ],
				filemtime( get_template_directory() . '/assets/js/scholarships-task02.js' ),
				true
			);
		}
	}

	// Give / Donations Page Scoped Stylesheet & Script (Task 01)
	if ( is_page( 'give' ) || is_page_template( 'templates/pages/page-give.php' ) || is_page_template( 'page-give.php' ) ) {
		wp_enqueue_style(
			'lfa-give-style',
			get_template_directory_uri() . '/assets/css/give.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/give.css' ) ? filemtime( get_template_directory() . '/assets/css/give.css' ) : '1.0.0'
		);
		wp_enqueue_script(
			'lfa-give-js',
			get_template_directory_uri() . '/assets/js/give.js',
			[ 'lfa-main-js' ],
			file_exists( get_template_directory() . '/assets/js/give.js' ) ? filemtime( get_template_directory() . '/assets/js/give.js' ) : '1.0.0',
			true
		);
		wp_localize_script(
			'lfa-give-js',
			'lfaCore',
			[
				'restUrl' => esc_url_raw( rest_url() ),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
				'homeUrl' => esc_url_raw( home_url( '/' ) ),
			]
		);
	}

	// Archives & Gallery Page Scoped Stylesheet & Script (Task 01)
	if ( is_page( 'gallery' ) || is_page_template( 'templates/pages/page-gallery.php' ) || is_page_template( 'page-gallery.php' ) ) {
		wp_enqueue_style(
			'lfa-gallery-style',
			get_template_directory_uri() . '/assets/css/gallery.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/gallery.css' ) ? filemtime( get_template_directory() . '/assets/css/gallery.css' ) : '1.0.0'
		);
		if ( file_exists( get_template_directory() . '/assets/js/gallery.js' ) ) {
			wp_enqueue_script(
				'lfa-gallery-js',
				get_template_directory_uri() . '/assets/js/gallery.js',
				[ 'lfa-main-js' ],
				filemtime( get_template_directory() . '/assets/js/gallery.js' ),
				true
			);
		}
	}

	// Contact Us Page Scoped Stylesheet & Script
	if ( is_page( 'contact' ) || is_page_template( 'templates/pages/page-contact.php' ) || is_page_template( 'page-contact.php' ) ) {
		wp_enqueue_style(
			'lfa-contact-style',
			get_template_directory_uri() . '/assets/css/contact.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/contact.css' ) ? filemtime( get_template_directory() . '/assets/css/contact.css' ) : '1.0.0'
		);
		if ( file_exists( get_template_directory() . '/assets/js/contact.js' ) ) {
			wp_enqueue_script(
				'lfa-contact-js',
				get_template_directory_uri() . '/assets/js/contact.js',
				[ 'lfa-main-js' ],
				filemtime( get_template_directory() . '/assets/js/contact.js' ),
				true
			);
			wp_localize_script(
				'lfa-contact-js',
				'lfaContactData',
				[
					'ajaxUrl' => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
					'nonce'   => wp_create_nonce( 'lfa_contact_submit' ),
				]
			);
		}
	}

	// Legal & Governance Pages (Privacy Policy, Terms of Use, Accessibility Statement)
	if ( is_page( [ 'privacy-policy', 'terms-of-use', 'accessibility' ] ) || is_page_template( 'templates/pages/page-privacy-policy.php' ) || is_page_template( 'templates/pages/page-terms-of-use.php' ) || is_page_template( 'templates/pages/page-accessibility.php' ) ) {
		wp_enqueue_style(
			'lfa-legal-style',
			get_template_directory_uri() . '/assets/css/legal.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/legal.css' ) ? filemtime( get_template_directory() . '/assets/css/legal.css' ) : '1.0.0'
		);
	}

	// Member Portal & Authentication (Phase 02 · Task 01: Login, Registration, Forgot Password)
	$req_path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
	$path_segments = explode( '/', $req_path );
	$current_slug = end( $path_segments );

	$is_auth_screen = is_page( 'member-login' ) || is_page( 'member-register' ) || is_page( 'forgot-password' ) || is_page( 'login' ) || is_page_template( 'templates/pages/page-member-login.php' ) || is_page_template( 'page-member-login.php' ) || is_page_template( 'templates/pages/page-member-register.php' ) || is_page_template( 'page-member-register.php' ) || is_page_template( 'templates/pages/page-forgot-password.php' ) || is_page_template( 'page-forgot-password.php' ) || is_page_template( 'page-login.php' ) || in_array( $current_slug, [ 'member-login', 'member-register', 'forgot-password', 'login' ], true );

	if ( $is_auth_screen ) {
		wp_enqueue_style(
			'lfa-member-auth-style',
			get_template_directory_uri() . '/assets/css/member-auth.css',
			[ 'lfa-main-style' ],
			file_exists( get_template_directory() . '/assets/css/member-auth.css' ) ? filemtime( get_template_directory() . '/assets/css/member-auth.css' ) : '1.0.0'
		);
		if ( file_exists( get_template_directory() . '/assets/js/member-auth.js' ) ) {
			wp_enqueue_script(
				'lfa-member-auth-js',
				get_template_directory_uri() . '/assets/js/member-auth.js',
				[ 'lfa-main-js' ],
				filemtime( get_template_directory() . '/assets/js/member-auth.js' ),
				true
			);
		}
	}

	// Member Dashboard (Premium Redesign: Dedicated Application Shell)
	$is_dashboard_screen = is_page( 'member-dashboard' ) || is_page_template( 'templates/pages/page-member-dashboard.php' ) || is_page_template( 'page-member-dashboard.php' ) || 'member-dashboard' === $current_slug;

	if ( $is_dashboard_screen ) {
		// Dequeue public chrome styles and former dashboard assets to guarantee isolated standalone app shell
		wp_dequeue_style( 'lfa-member-dashboard-style' );
		wp_dequeue_script( 'lfa-member-dashboard-js' );
		wp_dequeue_style( 'lfa-main-style' );
		wp_dequeue_style( 'lfa-theme-style' );

		// Enqueue Premium Portal Styles & Script
		wp_enqueue_style(
			'lfa-dashboard-premium',
			get_template_directory_uri() . '/assets/css/member-dashboard-premium.css',
			[],
			file_exists( get_template_directory() . '/assets/css/member-dashboard-premium.css' ) ? filemtime( get_template_directory() . '/assets/css/member-dashboard-premium.css' ) : '2.0.0'
		);
		wp_enqueue_script(
			'lfa-dashboard-premium',
			get_template_directory_uri() . '/assets/js/member-dashboard-premium.js',
			[],
			file_exists( get_template_directory() . '/assets/js/member-dashboard-premium.js' ) ? filemtime( get_template_directory() . '/assets/js/member-dashboard-premium.js' ) : '2.0.0',
			true
		);
		return;
	}

	// Admin Portal (Standalone Application Shell)
	$is_admin_screen = is_page( 'admin-portal' ) || is_page_template( 'templates/pages/page-admin-portal.php' ) || is_page_template( 'page-admin-portal.php' ) || 'admin-portal' === $current_slug;

	if ( $is_admin_screen ) {
		wp_dequeue_style( 'lfa-main-style' );
		wp_dequeue_style( 'lfa-theme-style' );

		wp_enqueue_style(
			'lfa-admin-portal',
			get_template_directory_uri() . '/assets/css/admin-portal.css',
			[],
			file_exists( get_template_directory() . '/assets/css/admin-portal.css' ) ? filemtime( get_template_directory() . '/assets/css/admin-portal.css' ) : '1.0.0'
		);
		wp_enqueue_script(
			'lfa-admin-portal',
			get_template_directory_uri() . '/assets/js/admin-portal.js',
			[],
			file_exists( get_template_directory() . '/assets/js/admin-portal.js' ) ? filemtime( get_template_directory() . '/assets/js/admin-portal.js' ) : '1.0.0',
			true
		);
		return;
	}

	// Main frontend JavaScript (Public website only)
	wp_enqueue_script(
		'lfa-main-js',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		filemtime( get_template_directory() . '/assets/js/main.js' ),
		true
	);

	// Localize script data if needed
	wp_localize_script(
		'lfa-main-js',
		'lfaData',
		[
			'homeUrl' => home_url( '/' ),
			'themeUrl' => get_template_directory_uri(),
		]
	);
}
add_action( 'wp_enqueue_scripts', 'lfa_enqueue_assets' );
