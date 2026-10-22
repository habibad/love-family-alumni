/**
 * Love Family Alumni — Give / Donations Page Script (Phase 08 Real Backend Integration)
 *
 * Handles:
 * - Cause selection synchronized with database giving funds
 * - Dynamic guest policy validation
 * - Amount preset selection & custom amount validation
 * - REST API intent dispatch (/wp-json/lfa/v1/give/intent)
 * - Confirmation modal with authoritative database record reference
 * - Accessible error handling
 */

document.addEventListener( 'DOMContentLoaded', function () {
	'use strict';

	// State
	let selectedFundId = 1;
	let selectedFundSlug = 'general-fund';
	let selectedCause = 'General Love Family Alumni Fund';
	let selectedAmount = 50;
	let minAmount = 1;
	let maxAmount = 10000;
	let guestGivingEnabled = 0;
	let activeDonationIntent = null;

	// Elements
	const causeCards = document.querySelectorAll( '.lfa-give__card' );
	const previewCauseDisplay = document.getElementById( 'preview-cause-display' );
	const amountBtns = document.querySelectorAll( '.lfa-give__amount-btn' );
	const customInput = document.getElementById( 'give-custom-amount' );
	const donorNameInput = document.getElementById( 'give-donor-name' );
	const donorEmailInput = document.getElementById( 'give-donor-email' );
	const anonymousCheck = document.getElementById( 'give-is-anonymous' );
	const reviewBtn = document.getElementById( 'give-review-btn' );
	const btnText = document.getElementById( 'give-btn-text' );
	const errorBox = document.getElementById( 'give-error-box' );
	const guestPolicyNotice = document.getElementById( 'give-guest-policy-notice' );

	const hiddenFundId = document.getElementById( 'give-fund-id' );
	const hiddenFundSlug = document.getElementById( 'give-fund-slug' );
	const hiddenGuestOk = document.getElementById( 'give-fund-guest-enabled' );
	const hiddenIsLoggedIn = document.getElementById( 'give-is-logged-in' );
	const isLoggedIn = hiddenIsLoggedIn ? ( hiddenIsLoggedIn.value === '1' ) : false;

	// Modal Elements
	const reviewModal = document.getElementById( 'give-review-modal' );
	const modalBackdrop = document.getElementById( 'give-modal-backdrop' );
	const modalCloseX = document.getElementById( 'give-modal-close-x' );
	const modalCloseBtn = document.getElementById( 'give-modal-close-btn' );
	const modalRef = document.getElementById( 'modal-summary-ref' );
	const modalCause = document.getElementById( 'modal-summary-cause' );
	const modalAmount = document.getElementById( 'modal-summary-amount' );
	const modalDonor = document.getElementById( 'modal-summary-donor' );
	const modalStatus = document.getElementById( 'modal-summary-status' );

	// Initialize from active card or default
	const initialActiveCard = document.querySelector( '.lfa-give__card.is-active' );
	if ( initialActiveCard ) {
		updateStateFromCard( initialActiveCard );
	}

	function updateStateFromCard( card ) {
		if ( ! card ) return;
		selectedCause = card.getAttribute( 'data-cause-title' ) || selectedCause;
		selectedFundSlug = card.getAttribute( 'data-cause-id' ) || selectedFundSlug;
		selectedFundId = parseInt( card.getAttribute( 'data-cause-db-id' ) || '1', 10 );
		minAmount = parseFloat( card.getAttribute( 'data-min' ) || '1' );
		maxAmount = parseFloat( card.getAttribute( 'data-max' ) || '10000' );
		guestGivingEnabled = parseInt( card.getAttribute( 'data-guest' ) || '0', 10 );

		if ( previewCauseDisplay ) {
			previewCauseDisplay.textContent = selectedCause;
		}
		if ( hiddenFundId ) hiddenFundId.value = selectedFundId;
		if ( hiddenFundSlug ) hiddenFundSlug.value = selectedFundSlug;
		if ( hiddenGuestOk ) hiddenGuestOk.value = guestGivingEnabled;

		// Guest policy enforcement (GIV-020)
		if ( ! isLoggedIn && ! guestGivingEnabled ) {
			if ( guestPolicyNotice ) guestPolicyNotice.style.display = 'block';
			if ( reviewBtn ) {
				reviewBtn.setAttribute( 'disabled', 'disabled' );
				reviewBtn.style.opacity = '0.6';
				reviewBtn.style.cursor = 'not-allowed';
			}
		} else {
			if ( guestPolicyNotice ) guestPolicyNotice.style.display = 'none';
			if ( reviewBtn ) {
				reviewBtn.removeAttribute( 'disabled' );
				reviewBtn.style.opacity = '1';
				reviewBtn.style.cursor = 'pointer';
			}
		}
	}

	// 1. Cause Selection
	function setCause( card ) {
		if ( ! card ) return;
		causeCards.forEach( function ( c ) {
			c.classList.remove( 'is-active' );
			c.setAttribute( 'aria-pressed', 'false' );
			const act = c.querySelector( '.action-text' );
			if ( act ) act.textContent = 'Select Cause';
		} );
		card.classList.add( 'is-active' );
		card.setAttribute( 'aria-pressed', 'true' );
		const activeAct = card.querySelector( '.action-text' );
		if ( activeAct ) activeAct.textContent = 'Selected Cause';

		updateStateFromCard( card );
		clearError();
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

			selectedAmount = parseFloat( btn.getAttribute( 'data-amount' ) ) || 50;
			clearError();
		} );
	} );

	// 3. Custom Amount Input
	if ( customInput ) {
		customInput.addEventListener( 'input', function () {
			const val = parseFloat( customInput.value );
			if ( ! isNaN( val ) && val > 0 ) {
				amountBtns.forEach( function ( b ) {
					b.classList.remove( 'is-active' );
					b.setAttribute( 'aria-checked', 'false' );
				} );
				selectedAmount = val;
			} else {
				const activeBtn = document.querySelector( '.lfa-give__amount-btn.is-active' );
				selectedAmount = activeBtn ? ( parseFloat( activeBtn.getAttribute( 'data-amount' ) ) || 50 ) : 50;
			}
			clearError();
		} );
	}

	function showError( msg ) {
		if ( errorBox ) {
			errorBox.textContent = msg;
			errorBox.style.display = 'block';
		}
	}

	function clearError() {
		if ( errorBox ) {
			errorBox.textContent = '';
			errorBox.style.display = 'none';
		}
	}

	function formatCurrency( amount ) {
		return '$' + Number( amount ).toLocaleString( 'en-US', {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2,
		} ) + ' USD';
	}

	// 4. Submit Intent to REST API
	async function handleSubmitIntent() {
		clearError();

		// Client-side validations
		if ( ! isLoggedIn && ! guestGivingEnabled ) {
			showError( 'Guest giving is not permitted for this fund by administrative policy. Please sign in to donate.' );
			return;
		}

		if ( isNaN( selectedAmount ) || selectedAmount <= 0 ) {
			showError( 'Please specify a valid gift amount greater than $0.' );
			return;
		}

		if ( selectedAmount < minAmount ) {
			showError( 'The minimum donation amount for ' + selectedCause + ' is $' + minAmount + ' USD.' );
			return;
		}

		if ( selectedAmount > maxAmount ) {
			showError( 'The maximum online donation amount for ' + selectedCause + ' is $' + maxAmount + ' USD.' );
			return;
		}

		const donorName = donorNameInput ? donorNameInput.value.trim() : '';
		const donorEmail = donorEmailInput ? donorEmailInput.value.trim() : '';

		if ( ! donorName ) {
			showError( 'Please enter a donor display name.' );
			if ( donorNameInput ) donorNameInput.focus();
			return;
		}

		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		if ( ! donorEmail || ! emailRegex.test( donorEmail ) ) {
			showError( 'Please enter a valid donor email address for official receipt delivery.' );
			if ( donorEmailInput ) donorEmailInput.focus();
			return;
		}

		// Disable button during submission
		if ( reviewBtn ) reviewBtn.setAttribute( 'disabled', 'disabled' );
		if ( btnText ) btnText.textContent = 'Registering Intent...';

		const isAnon = anonymousCheck && anonymousCheck.checked ? 1 : 0;

		// Prevent duplicate intents: reuse active registered intent if input parameters are identical
		if ( activeDonationIntent &&
		     activeDonationIntent.fund_id === selectedFundId &&
		     activeDonationIntent.amount_dollars === selectedAmount &&
		     activeDonationIntent.donor_display_name === donorName &&
		     activeDonationIntent.donor_email === donorEmail &&
		     activeDonationIntent.is_anonymous === isAnon ) {
			populateModalWithIntent( activeDonationIntent );
			openModal();
			if ( reviewBtn ) reviewBtn.removeAttribute( 'disabled' );
			if ( btnText ) btnText.textContent = 'Submit Giving Intent';
			return;
		}

		const payload = {
			fund_id: selectedFundId,
			fund_slug: selectedFundSlug,
			amount_dollars: selectedAmount,
			donor_display_name: donorName,
			donor_email: donorEmail,
			is_anonymous: isAnon,
		};

		try {
			const restBase = ( window.lfaCore && window.lfaCore.restUrl ) ? window.lfaCore.restUrl : ( window.location.origin + '/evans-alop/wp-json/' );
			const response = await fetch( restBase + 'lfa/v1/give/intent', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce': ( window.lfaCore && window.lfaCore.nonce ) ? window.lfaCore.nonce : '',
				},
				body: JSON.stringify( payload ),
			} );

			const result = await response.json();

			if ( ! response.ok || ! result.success ) {
				const errMsg = result.message || result.error || 'Failed to record donation intent.';
				showError( errMsg );
				if ( reviewBtn ) reviewBtn.removeAttribute( 'disabled' );
				if ( btnText ) btnText.textContent = 'Submit Giving Intent';
				return;
			}

			// Intent recorded successfully — cache in state for retry idempotency
			activeDonationIntent = {
				donation_id: result.donation_id,
				donation_ref: result.donation_ref,
				purpose: result.purpose || selectedCause,
				amount_dollars: result.amount_dollars || selectedAmount,
				fund_id: selectedFundId,
				donor_display_name: donorName,
				donor_email: donorEmail,
				is_anonymous: payload.is_anonymous,
				stripe_test_enabled: result.stripe_test_enabled,
			};

			populateModalWithIntent( activeDonationIntent );
			openModal();

		} catch ( err ) {
			showError( 'Network error while contacting the giving server. Please try again.' );
		} finally {
			if ( reviewBtn ) reviewBtn.removeAttribute( 'disabled' );
			if ( btnText ) btnText.textContent = 'Submit Giving Intent';
		}
	}

	function populateModalWithIntent( intent ) {
		if ( modalRef ) modalRef.textContent = intent.donation_ref || 'DON-2026';
		if ( modalCause ) modalCause.textContent = intent.purpose || selectedCause;
		if ( modalAmount ) modalAmount.textContent = formatCurrency( intent.amount_dollars || selectedAmount );
		if ( modalDonor ) {
			modalDonor.textContent = ( intent.is_anonymous === 1 ) ? 'Anonymous Donor' : intent.donor_display_name;
		}
		if ( modalStatus ) {
			modalStatus.textContent = intent.stripe_test_enabled ? 'Ready for Stripe Test Checkout' : 'Pending Payment (Gateway Pending)';
		}

		const stripeGiveBtn = document.getElementById( 'give-modal-stripe-btn' );
		if ( stripeGiveBtn && intent.donation_id ) {
			stripeGiveBtn.setAttribute( 'data-donation-id', intent.donation_id );
			stripeGiveBtn.textContent = 'Pay $' + ( intent.amount_dollars || selectedAmount ) + ' with Stripe Test Checkout \u2192';
			stripeGiveBtn.style.display = 'inline-block';
			stripeGiveBtn.removeAttribute( 'disabled' );
		}
		hideModalError();
	}

	function hideModalError() {
		const modalErrorBox = document.getElementById( 'give-modal-error-box' );
		if ( modalErrorBox ) modalErrorBox.style.display = 'none';
	}

	function showModalError( msg ) {
		const modalErrorBox = document.getElementById( 'give-modal-error-box' );
		const modalErrorMsg = document.getElementById( 'give-modal-error-msg' );
		if ( modalErrorBox && modalErrorMsg ) {
			modalErrorMsg.textContent = msg;
			modalErrorBox.style.display = 'block';
		}
	}

	// Stripe Test Checkout Action
	const stripeGiveBtn = document.getElementById( 'give-modal-stripe-btn' );
	if ( stripeGiveBtn ) {
		stripeGiveBtn.addEventListener( 'click', async function () {
			const donationId = stripeGiveBtn.getAttribute( 'data-donation-id' );
			if ( ! donationId ) return;

			hideModalError();
			stripeGiveBtn.setAttribute( 'disabled', 'disabled' );
			stripeGiveBtn.textContent = 'Redirecting to Stripe...';

			try {
				const restBase = ( window.lfaCore && window.lfaCore.restUrl ) ? window.lfaCore.restUrl : ( window.location.origin + '/evans-alop/wp-json/' );
				const response = await fetch( restBase + 'lfa/v1/payments/create-session', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-WP-Nonce': ( window.lfaCore && window.lfaCore.nonce ) ? window.lfaCore.nonce : '',
					},
					body: JSON.stringify({
						invoice_id: parseInt( donationId, 10 ),
						payable_type: 'donation',
						gateway: 'stripe'
					})
				});
				const data = await response.json();
				const checkoutUrl = data.session_url || data.checkout_url;

				if ( ! response.ok || ! data.success || ! checkoutUrl ) {
					throw new Error( data.message || 'Failed to initialize Stripe checkout.' );
				}
				window.location.href = checkoutUrl;
			} catch ( err ) {
				stripeGiveBtn.removeAttribute( 'disabled' );
				const displayAmt = activeDonationIntent ? activeDonationIntent.amount_dollars : selectedAmount;
				stripeGiveBtn.textContent = 'Pay $' + displayAmt + ' with Stripe Test Checkout \u2192';
				showModalError( err.message || 'Failed to initialize Stripe checkout. Please try again.' );
			}
		});
	}

	// Retry & Dismiss handlers for inline modal error
	const modalRetryBtn = document.getElementById( 'give-modal-retry-btn' );
	if ( modalRetryBtn ) {
		modalRetryBtn.addEventListener( 'click', function () {
			hideModalError();
			if ( stripeGiveBtn ) {
				stripeGiveBtn.click();
			}
		} );
	}
	const modalDismissBtn = document.getElementById( 'give-modal-dismiss-error-btn' );
	if ( modalDismissBtn ) {
		modalDismissBtn.addEventListener( 'click', hideModalError );
	}

	// Automatic Reconcile on Return from Stripe
	const giveReconcileBanner = document.getElementById( 'lfa-give-reconcile-banner' );
	if ( giveReconcileBanner ) {
		const sessionId = giveReconcileBanner.getAttribute( 'data-session-id' );
		const statusEl = document.getElementById( 'lfa-give-reconcile-status' );
		if ( sessionId ) {
			const restBase = ( window.lfaCore && window.lfaCore.restUrl ) ? window.lfaCore.restUrl : ( window.location.origin + '/evans-alop/wp-json/' );
			fetch( restBase + 'lfa/v1/payments/reconcile-session', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce': ( window.lfaCore && window.lfaCore.nonce ) ? window.lfaCore.nonce : '',
				},
				body: JSON.stringify({
					session_id: sessionId,
					payable_type: 'donation'
				})
			})
			.then( function( res ) { return res.json(); } )
			.then( function( data ) {
				if ( data.success && data.reconciled ) {
					giveReconcileBanner.style.background = '#dcfce7';
					giveReconcileBanner.style.borderColor = '#16a34a';
					giveReconcileBanner.style.color = '#166534';
					const spin = giveReconcileBanner.querySelector( '.lfa-reconcile-spinner' );
					if ( spin ) spin.style.display = 'none';
					statusEl.innerHTML = '<strong>Test Donation Verified!</strong> Thank you for your generous gift. Receipt #' + ( data.receipt_number || data.payment_id ) + ' has been recorded in the ledger.';
				} else {
					giveReconcileBanner.style.background = '#fffbeb';
					giveReconcileBanner.style.borderColor = '#f59e0b';
					giveReconcileBanner.style.color = '#92400e';
					const spin = giveReconcileBanner.querySelector( '.lfa-reconcile-spinner' );
					if ( spin ) spin.style.display = 'none';
					statusEl.innerHTML = '<strong>Donation Status:</strong> ' + ( data.message || 'Awaiting Stripe payment confirmation.' );
				}
			})
			.catch( function( err ) {
				if ( statusEl ) {
					statusEl.innerHTML = '<strong>Notice:</strong> Donation verification in progress via background webhook.';
				}
			});
		}
	}

	function openModal() {
		if ( ! reviewModal ) return;
		hideModalError();
		reviewModal.removeAttribute( 'hidden' );
		document.body.style.overflow = 'hidden';
		if ( modalCloseBtn ) modalCloseBtn.focus();
	}

	function closeModal() {
		if ( ! reviewModal ) return;
		reviewModal.setAttribute( 'hidden', '' );
		document.body.style.overflow = '';
		if ( reviewBtn ) reviewBtn.focus();
	}

	if ( reviewBtn ) {
		reviewBtn.addEventListener( 'click', handleSubmitIntent );
	}

	if ( modalCloseX ) modalCloseX.addEventListener( 'click', closeModal );
	if ( modalCloseBtn ) modalCloseBtn.addEventListener( 'click', closeModal );
	if ( modalBackdrop ) modalBackdrop.addEventListener( 'click', closeModal );

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && reviewModal && ! reviewModal.hasAttribute( 'hidden' ) ) {
			closeModal();
		}
	} );
} );
