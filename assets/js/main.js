/**
 * Love Family Theme - Main JavaScript
 * Handles mobile navigation, keyboard accessibility, and UI interactions
 */

document.addEventListener('DOMContentLoaded', () => {
	initMobileNavigation();
	initKeyboardAccessibility();
});

/**
 * Mobile Navigation Toggle & Drawer
 */
function initMobileNavigation() {
	const toggleBtn = document.querySelector('.mobile-nav-toggle');
	const navWrapper = document.getElementById('primary-navigation');

	if (!toggleBtn || !navWrapper) {
		return;
	}

	toggleBtn.addEventListener('click', () => {
		const isOpen = navWrapper.classList.contains('is-open');

		if (isOpen) {
			navWrapper.classList.remove('is-open');
			toggleBtn.setAttribute('aria-expanded', 'false');
			toggleBtn.focus();
		} else {
			navWrapper.classList.add('is-open');
			toggleBtn.setAttribute('aria-expanded', 'true');
			const firstLink = navWrapper.querySelector('a');
			if (firstLink) {
				firstLink.focus();
			}
		}
	});

	// Close on Escape key press
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && navWrapper.classList.contains('is-open')) {
			navWrapper.classList.remove('is-open');
			toggleBtn.setAttribute('aria-expanded', 'false');
			toggleBtn.focus();
		}
	});

	// Close when clicking outside
	document.addEventListener('click', (e) => {
		if (
			navWrapper.classList.contains('is-open') &&
			!navWrapper.contains(e.target) &&
			!toggleBtn.contains(e.target)
		) {
			navWrapper.classList.remove('is-open');
			toggleBtn.setAttribute('aria-expanded', 'false');
		}
	});
}

/**
 * Keyboard Navigation Accessibility
 */
function initKeyboardAccessibility() {
	// Add focus-visible style helper if needed
	document.body.addEventListener('keydown', (e) => {
		if (e.key === 'Tab') {
			document.body.classList.add('user-is-tabbing');
		}
	});

	document.body.addEventListener('mousedown', () => {
		document.body.classList.remove('user-is-tabbing');
	});
}
