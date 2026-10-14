/**
 * Love Family Alumni — Give / Donations Page Interactions (Task 01)
 *
 * Frontend Demonstration Only:
 * - Cause category selection & preview synchronization
 * - Preset & custom amount selection
 * - Review demo summary modal
 * - Smooth anchor navigation
 * - No payment gateway integration or data transmission
 */

document.addEventListener( 'DOMContentLoaded', function () {
	'use strict';

	// State
	let selectedCause = 'Community Outreach';
	let selectedAmount = 50;

	// Elements
	const causeCards = document.querySelectorAll( '.lfa-give__card' );
	const previewCauseDisplay = document.getElementById( 'preview-cause-display' );
	const amountBtns = document.querySelectorAll( '.lfa-give__amount-btn' );
	const customInput = document.getElementById( 'give-custom-amount' );
	const reviewBtn = document.getElementById( 'give-review-btn' );

	// Modal Elements
	const reviewModal = document.getElementById( 'give-review-modal' );
	const modalBackdrop = document.getElementById( 'give-modal-backdrop' );
	const modalCloseX = document.getElementById( 'give-modal-close-x' );
	const modalCloseBtn = document.getElementById( 'give-modal-close-btn' );
	const modalCause = document.getElementById( 'modal-summary-cause' );
	const modalAmount = document.getElementById( 'modal-summary-amount' );

	// Initialize default cause from active card if present
	const initialActiveCard = document.querySelector( '.lfa-give__card.is-active' );
	if ( initialActiveCard ) {
		selectedCause = initialActiveCard.getAttribute( 'data-cause-title' ) || selectedCause;
		if ( previewCauseDisplay ) {
			previewCauseDisplay.textContent = selectedCause;
		}
	}

	// 1. Cause Selection
	function setCause( card ) {
		if ( ! card ) return;
		causeCards.forEach( function ( c ) {
			c.classList.remove( 'is-active' );
			c.setAttribute( 'aria-pressed', 'false' );
		} );
		card.classList.add( 'is-active' );
		card.setAttribute( 'aria-pressed', 'true' );

		const title = card.getAttribute( 'data-cause-title' ) || 'Community Outreach';
		selectedCause = title;

		if ( previewCauseDisplay ) {
			previewCauseDisplay.textContent = selectedCause;
		}
	}

	causeCards.forEach( function ( card ) {
		card.addEventListener( 'click', function () {
			setCause( card );
		} );

		card.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Enter' || e.key === ' ' ) {
				e.preventDefault();
				setCause( card );
			}
		} );
	} );

	// 2. Preset Amount Selection
	amountBtns.forEach( function ( btn ) {
		btn.addEventListener( 'click', function () {
			amountBtns.forEach( function ( b ) {
				b.classList.remove( 'is-active' );
				b.setAttribute( 'aria-checked', 'false' );
			} );
			btn.classList.add( 'is-active' );
			btn.setAttribute( 'aria-checked', 'true' );

			if ( customInput ) {
				customInput.value = '';
			}

			const amt = parseFloat( btn.getAttribute( 'data-amount' ) ) || 50;
			selectedAmount = amt;
		} );
	} );

	// 3. Custom Amount Input
	if ( customInput ) {
		customInput.addEventListener( 'input', function () {
			const val = parseFloat( customInput.value );
			if ( ! isNaN( val ) && val > 0 ) {
				// Deselect preset buttons
				amountBtns.forEach( function ( b ) {
					b.classList.remove( 'is-active' );
					b.setAttribute( 'aria-checked', 'false' );
				} );
				selectedAmount = val;
			} else {
				// Fallback to active preset or default 50
				const activeBtn = document.querySelector( '.lfa-give__amount-btn.is-active' );
				if ( activeBtn ) {
					selectedAmount = parseFloat( activeBtn.getAttribute( 'data-amount' ) ) || 50;
				} else {
					selectedAmount = 50;
				}
			}
		} );
	}

	// 4. Review Demo Modal Logic
	function formatCurrency( amount ) {
		return '$' + Number( amount ).toLocaleString( 'en-US', {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2,
		} ) + ' USD';
	}

	function openModal() {
		if ( ! reviewModal ) return;
		if ( modalCause ) {
			modalCause.textContent = selectedCause;
		}
		if ( modalAmount ) {
			modalAmount.textContent = formatCurrency( selectedAmount );
		}
		reviewModal.removeAttribute( 'hidden' );
		document.body.style.overflow = 'hidden';
		if ( modalCloseBtn ) {
			modalCloseBtn.focus();
		}
	}

	function closeModal() {
		if ( ! reviewModal ) return;
		reviewModal.setAttribute( 'hidden', '' );
		document.body.style.overflow = '';
		if ( reviewBtn ) {
			reviewBtn.focus();
		}
	}

	if ( reviewBtn ) {
		reviewBtn.addEventListener( 'click', openModal );
	}

	if ( modalCloseX ) {
		modalCloseX.addEventListener( 'click', closeModal );
	}

	if ( modalCloseBtn ) {
		modalCloseBtn.addEventListener( 'click', closeModal );
	}

	if ( modalBackdrop ) {
		modalBackdrop.addEventListener( 'click', closeModal );
	}

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && reviewModal && ! reviewModal.hasAttribute( 'hidden' ) ) {
			closeModal();
		}
	} );

	// 5. Smooth Anchor Scrolling for On-page Links
	const anchorLinks = document.querySelectorAll( 'a[href^="#"]' );
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
