<?php
/**
 * Helper template functions and SVG icons
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get theme asset URL
 */
function lfa_asset_url( string $path ): string {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

/**
 * Get theme image URL
 */
function lfa_image_url( string $filename ): string {
	return get_template_directory_uri() . '/assets/images/' . ltrim( $filename, '/' );
}

/**
 * Return crisp inline SVG icons matching design
 */
function lfa_icon( string $name, string $class = '' ): string {
	$class_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';

	switch ( $name ) {
		case 'mail':
			return '<svg' . $class_attr . ' width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>';

		case 'map-pin':
			return '<svg' . $class_attr . ' width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>';

		case 'search':
			return '<svg' . $class_attr . ' width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7.5"/><line x1="21" x2="16.5" y1="21" y2="16.5"/></svg>';

		case 'facebook':
			return '<svg' . $class_attr . ' width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>';

		case 'linkedin':
			return '<svg' . $class_attr . ' width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37h2.79V10.9H6.46M7.86 6.54a1.63 1.63 0 0 0-1.63 1.63c0 .9.73 1.63 1.63 1.63.9 0 1.63-.73 1.63-1.63 0-.9-.73-1.63-1.63-1.63z"/></svg>';

		case 'youtube':
			return '<svg' . $class_attr . ' width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.582 6.186a2.506 2.506 0 0 0-1.768-1.782C18.251 4 12 4 12 4s-6.251 0-7.814.404a2.506 2.506 0 0 0-1.768 1.782A26.31 26.31 0 0 0 2 12a26.31 26.31 0 0 0 .418 5.814 2.506 2.506 0 0 0 1.768 1.782C5.749 20 12 20 12 20s6.251 0 7.814-.404a2.506 2.506 0 0 0 1.768-1.782A26.31 26.31 0 0 0 22 12a26.31 26.31 0 0 0-.418-5.814zM9.9 15.46V8.54L15.9 12l-6 3.46z"/></svg>';

		case 'users':
			return '<svg' . $class_attr . ' width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>';

		case 'credit-card':
			return '<svg' . $class_attr . ' width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>';

		case 'calendar':
			return '<svg' . $class_attr . ' width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5z"/></svg>';

		case 'user':
			return '<svg' . $class_attr . ' width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>';

		case 'connect':
			return '<svg' . $class_attr . ' width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>';

		case 'collaborate':
			return '<svg' . $class_attr . ' width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/><path d="M19 19H5V8h2V6H3v15h18v-4h-2z"/></svg>';

		case 'impact':
			return '<svg' . $class_attr . ' width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';

		case 'represent':
			return '<svg' . $class_attr . ' width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>';

		case 'briefcase':
			return '<svg' . $class_attr . ' width="32" height="32" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>';

		case 'id-card':
			return '<svg' . $class_attr . ' width="32" height="32" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-9 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 11H5v-.8c0-1.67 3.33-2.5 5-2.5s5 .83 5 2.5v.8zm4 0h-3v-2h3v2zm0-4h-3v-2h3v2zm0-4h-3V7h3v2z"/></svg>';

		case 'graduation-cap':
			return '<svg' . $class_attr . ' width="30" height="30" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>';

		case 'heart-hand':
			return '<svg' . $class_attr . ' width="30" height="30" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';

		case 'bell':
			return '<svg' . $class_attr . ' width="30" height="30" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg>';

		case 'menu':
			return '<svg' . $class_attr . ' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>';

		case 'watermark':
			return '<svg' . $class_attr . ' width="260" height="260" viewBox="0 0 100 100" fill="none" stroke="#FFFFFF" stroke-width="2" opacity="0.14" aria-hidden="true"><path d="M50 15 L85 45 L85 85 L15 85 L15 45 Z"/><path d="M50 40 C45 32 35 32 30 38 C23 46 23 55 50 72 C77 55 77 46 70 38 C65 32 55 32 50 40 Z" fill="#FFFFFF" fill-opacity="0.3"/></svg>';

		default:
			return '';
	}
}

/**
 * Handle /alumni-directory/ redirect to /directory/ to prevent 404
 */
function lfa_handle_directory_route_alias(): void {
	if ( ! is_admin() ) {
		$request_uri = $_SERVER['REQUEST_URI'] ?? '';
		if ( strpos( $request_uri, '/evans-alop/' ) === 0 ) {
			wp_safe_redirect( str_replace( '/evans-alop/', '/evans_alop/', $request_uri ), 301 );
			exit;
		}
		if ( is_404() ) {
			$clean_uri = trim( $request_uri, '/' );
			if ( preg_match( '#(^|/)alumni-directory/?$#i', $clean_uri ) ) {
				wp_safe_redirect( home_url( '/directory/' ), 301 );
				exit;
			}
		}
	}
}
add_action( 'template_redirect', 'lfa_handle_directory_route_alias' );

/**
 * Register rewrite rule for Conference 2027
 */
function lfa_conference_rewrite_rules(): void {
	add_rewrite_rule( '^conference/2027/?$', 'index.php?pagename=conference/2027', 'top' );
}
add_action( 'init', 'lfa_conference_rewrite_rules' );

