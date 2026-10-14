/**
 * Love Family Alumni — Archives & Gallery Interactions (Task 01)
 *
 * Frontend functionality:
 * - Smooth anchor scrolling for gallery navigation
 * - Keyboard accessibility for interactive album links
 */

document.addEventListener( 'DOMContentLoaded', function () {
	'use strict';

	// Smooth Anchor Scrolling for On-page Links (#featured-collections, #gallery-heritage)
	const anchorLinks = document.querySelectorAll( '.lfa-gallery a[href^="#"]' );
	anchorLinks.forEach( function ( link ) {
		link.addEventListener( 'click', function ( e ) {
			const targetId = link.getAttribute( 'href' );
			if ( targetId && targetId !== '#' ) {
				const targetEl = document.querySelector( targetId );
				if ( targetEl ) {
					e.preventDefault();
					targetEl.scrollIntoView( {
						behavior: 'smooth',
						block: 'start',
					} );
					targetEl.setAttribute( 'tabindex', '-1' );
					targetEl.focus();
				}
			}
		} );
	} );
} );
