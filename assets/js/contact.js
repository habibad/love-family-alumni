/**
 * Love Family Alumni — Contact Us Page Frontend Interactions
 *
 * Frontend Demonstration Only:
 * - Client-side form validation (Required, Email, Optional Phone, Inquiry, Subject, Message)
 * - Live character counter for Message textarea
 * - Local-only Review Modal Dialog (Zero data transmission or storage)
 * - Form reset / clear actions
 * - Accessible keyboard and screen-reader status updates
 * - Smooth anchor scrolling
 */

document.addEventListener( 'DOMContentLoaded', function () {
	'use strict';

	// Elements
	const form = document.getElementById( 'lfa-contact-form' );
	if ( ! form ) return;

	const inputName = document.getElementById( 'contact-name' );
	const inputEmail = document.getElementById( 'contact-email' );
	const inputPhone = document.getElementById( 'contact-phone' );
	const selectInquiry = document.getElementById( 'contact-inquiry' );
	const inputSubject = document.getElementById( 'contact-subject' );
	const textareaMessage = document.getElementById( 'contact-message' );
	const charCurrent = document.getElementById( 'char-current' );
	const resetBtn = document.getElementById( 'contact-reset-btn' );

	// Modal Elements
	const modal = document.getElementById( 'contact-review-modal' );
	const modalBackdrop = document.getElementById( 'contact-modal-backdrop' );
	const modalCloseX = document.getElementById( 'contact-modal-close-x' );
	const modalDoneBtn = document.getElementById( 'contact-modal-done-btn' );
	const modalEditBtn = document.getElementById( 'contact-modal-edit-btn' );

	// Modal Value Display Elements
	const modalValName = document.getElementById( 'modal-val-name' );
	const modalValEmail = document.getElementById( 'modal-val-email' );
	const modalValPhone = document.getElementById( 'modal-val-phone' );
	const modalValInquiry = document.getElementById( 'modal-val-inquiry' );
	const modalValSubject = document.getElementById( 'modal-val-subject' );
	const modalValMessage = document.getElementById( 'modal-val-message' );

	// 1. Character Counter
	if ( textareaMessage && charCurrent ) {
		textareaMessage.addEventListener( 'input', function () {
			charCurrent.textContent = textareaMessage.value.length;
		} );
	}

	// 2. Validation Helper Functions
	function setError( input, errorId, message ) {
		input.classList.add( 'is-invalid' );
		input.setAttribute( 'aria-invalid', 'true' );
		const errEl = document.getElementById( errorId );
		if ( errEl ) {
			errEl.textContent = message;
			errEl.classList.add( 'is-visible' );
		}
	}

	function clearError( input, errorId ) {
		input.classList.remove( 'is-invalid' );
		input.removeAttribute( 'aria-invalid' );
		const errEl = document.getElementById( errorId );
		if ( errEl ) {
			errEl.textContent = '';
			errEl.classList.remove( 'is-visible' );
		}
	}

	function validateEmail( email ) {
		const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return re.test( String( email ).trim().toLowerCase() );
	}

	function validatePhone( phone ) {
		if ( ! phone || phone.trim() === '' ) return true;
		const clean = phone.replace( /[\s\-\(\)\+\.]/g, '' );
		return clean.length >= 7 && /^\d+$/.test( clean );
	}

	// Real-time error clearing on input
	if ( inputName ) inputName.addEventListener( 'input', () => clearError( inputName, 'error-name' ) );
	if ( inputEmail ) inputEmail.addEventListener( 'input', () => clearError( inputEmail, 'error-email' ) );
	if ( inputPhone ) inputPhone.addEventListener( 'input', () => clearError( inputPhone, 'error-phone' ) );
	if ( selectInquiry ) selectInquiry.addEventListener( 'change', () => clearError( selectInquiry, 'error-inquiry' ) );
	if ( inputSubject ) inputSubject.addEventListener( 'input', () => clearError( inputSubject, 'error-subject' ) );
	if ( textareaMessage ) textareaMessage.addEventListener( 'input', () => clearError( textareaMessage, 'error-message' ) );

	// 3. Form Submission (Preview Only)
	form.addEventListener( 'submit', function ( e ) {
		e.preventDefault();

		let isValid = true;
		let firstInvalidField = null;

		// Validate Full Name
		const nameVal = inputName.value.trim();
		if ( nameVal.length < 2 ) {
			setError( inputName, 'error-name', 'Please enter your full name (minimum 2 characters).' );
			isValid = false;
			if ( ! firstInvalidField ) firstInvalidField = inputName;
		} else {
			clearError( inputName, 'error-name' );
		}

		// Validate Email
		const emailVal = inputEmail.value.trim();
		if ( ! emailVal ) {
			setError( inputEmail, 'error-email', 'Email address is required.' );
			isValid = false;
			if ( ! firstInvalidField ) firstInvalidField = inputEmail;
		} else if ( ! validateEmail( emailVal ) ) {
			setError( inputEmail, 'error-email', 'Please enter a valid email address (e.g. name@domain.com).' );
			isValid = false;
			if ( ! firstInvalidField ) firstInvalidField = inputEmail;
		} else {
			clearError( inputEmail, 'error-email' );
		}

		// Validate Phone (Optional)
		const phoneVal = inputPhone.value.trim();
		if ( phoneVal && ! validatePhone( phoneVal ) ) {
			setError( inputPhone, 'error-phone', 'Please enter a valid phone number or leave this field empty.' );
			isValid = false;
			if ( ! firstInvalidField ) firstInvalidField = inputPhone;
		} else {
			clearError( inputPhone, 'error-phone' );
		}

		// Validate Inquiry Type
		const inquiryVal = selectInquiry.value;
		if ( ! inquiryVal ) {
			setError( selectInquiry, 'error-inquiry', 'Please select an inquiry type from the options.' );
			isValid = false;
			if ( ! firstInvalidField ) firstInvalidField = selectInquiry;
		} else {
			clearError( selectInquiry, 'error-inquiry' );
		}

		// Validate Subject
		const subjectVal = inputSubject.value.trim();
		if ( subjectVal.length < 3 ) {
			setError( inputSubject, 'error-subject', 'Please provide a subject line (minimum 3 characters).' );
			isValid = false;
			if ( ! firstInvalidField ) firstInvalidField = inputSubject;
		} else {
			clearError( inputSubject, 'error-subject' );
		}

		// Validate Message
		const messageVal = textareaMessage.value.trim();
		if ( messageVal.length < 10 ) {
			setError( textareaMessage, 'error-message', 'Please write your message (minimum 10 characters).' );
			isValid = false;
			if ( ! firstInvalidField ) firstInvalidField = textareaMessage;
		} else {
			clearError( textareaMessage, 'error-message' );
		}

		// Focus first error if invalid
		if ( ! isValid ) {
			if ( firstInvalidField ) firstInvalidField.focus();
			return;
		}

		// Populate Modal with Preview Data
		if ( modalValName ) modalValName.textContent = nameVal;
		if ( modalValEmail ) modalValEmail.textContent = emailVal;
		if ( modalValPhone ) modalValPhone.textContent = phoneVal ? phoneVal : 'Not provided';
		if ( modalValInquiry ) modalValInquiry.textContent = inquiryVal;
		if ( modalValSubject ) modalValSubject.textContent = subjectVal;
		if ( modalValMessage ) modalValMessage.textContent = messageVal;

		// Open Modal
		openModal();
	} );

	// 4. Modal Open/Close Controls
	function openModal() {
		if ( ! modal ) return;
		modal.removeAttribute( 'hidden' );
		document.body.style.overflow = 'hidden';
		if ( modalDoneBtn ) modalDoneBtn.focus();
	}

	function closeModal() {
		if ( ! modal ) return;
		modal.setAttribute( 'hidden', '' );
		document.body.style.overflow = '';
	}

	if ( modalCloseX ) modalCloseX.addEventListener( 'click', closeModal );
	if ( modalDoneBtn ) modalDoneBtn.addEventListener( 'click', closeModal );
	if ( modalBackdrop ) modalBackdrop.addEventListener( 'click', closeModal );

	if ( modalEditBtn ) {
		modalEditBtn.addEventListener( 'click', function () {
			closeModal();
			if ( inputName ) inputName.focus();
		} );
	}

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && modal && ! modal.hasAttribute( 'hidden' ) ) {
			closeModal();
		}
	} );

	// 5. Reset / Clear Form
	if ( resetBtn ) {
		resetBtn.addEventListener( 'click', function () {
			form.reset();
			if ( charCurrent ) charCurrent.textContent = '0';
			clearError( inputName, 'error-name' );
			clearError( inputEmail, 'error-email' );
			clearError( inputPhone, 'error-phone' );
			clearError( selectInquiry, 'error-inquiry' );
			clearError( inputSubject, 'error-subject' );
			clearError( textareaMessage, 'error-message' );
			inputName.focus();
		} );
	}

	// 6. Smooth Scrolling for Page Anchors (#contact-form)
	const anchorLinks = document.querySelectorAll( '.lfa-contact a[href^="#"]' );
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
