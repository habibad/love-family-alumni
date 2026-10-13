/**
 * Love Family Theme - Main JavaScript
 * Handles mobile navigation, keyboard accessibility, and UI interactions
 */

document.addEventListener('DOMContentLoaded', () => {
	initMobileNavigation();
	initDropdownNavigation();
	initKeyboardAccessibility();
	initFaqAccordion();
	initSmoothScroll();
});

/**
 * Dropdown Navigation Accessibility & Interactions
 */
function initDropdownNavigation() {
	const dropdownItems = document.querySelectorAll('.menu-item-has-children');

	dropdownItems.forEach((item) => {
		const toggle = item.querySelector('.nav-dropdown-toggle');
		const subMenu = item.querySelector('.sub-menu');

		if (!toggle || !subMenu) {
			return;
		}

		item.addEventListener('mouseenter', () => {
			toggle.setAttribute('aria-expanded', 'true');
		});

		item.addEventListener('mouseleave', () => {
			toggle.setAttribute('aria-expanded', 'false');
		});

		toggle.addEventListener('focus', () => {
			toggle.setAttribute('aria-expanded', 'true');
		});

		toggle.addEventListener('keydown', (e) => {
			if (e.key === 'ArrowDown' || e.key === 'Enter') {
				e.preventDefault();
				toggle.setAttribute('aria-expanded', 'true');
				item.classList.add('is-open');
				const firstSubLink = subMenu.querySelector('a');
				if (firstSubLink) {
					firstSubLink.focus();
				}
			}
		});

		subMenu.addEventListener('keydown', (e) => {
			if (e.key === 'Escape') {
				toggle.setAttribute('aria-expanded', 'false');
				item.classList.remove('is-open');
				toggle.focus();
			}
		});

		// Close dropdown when focus moves out of the submenu
		item.addEventListener('focusout', (e) => {
			if (!item.contains(e.relatedTarget)) {
				toggle.setAttribute('aria-expanded', 'false');
				item.classList.remove('is-open');
			}
		});
	});
}

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

/**
 * Accessible FAQ Accordion
 */
function initFaqAccordion() {
	const triggers = document.querySelectorAll('.faq-accordion-trigger');
	if (!triggers.length) return;

	triggers.forEach((trigger, index) => {
		const panelId = trigger.getAttribute('aria-controls');
		const panel = panelId ? document.getElementById(panelId) : null;
		const item = trigger.closest('.faq-accordion-item');

		trigger.addEventListener('click', () => {
			const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

			// Close all other items in the accordion
			triggers.forEach((otherTrigger) => {
				if (otherTrigger !== trigger) {
					otherTrigger.setAttribute('aria-expanded', 'false');
					const otherItem = otherTrigger.closest('.faq-accordion-item');
					if (otherItem) otherItem.classList.remove('is-active');
					const otherPanelId = otherTrigger.getAttribute('aria-controls');
					const otherPanel = otherPanelId ? document.getElementById(otherPanelId) : null;
					if (otherPanel) otherPanel.setAttribute('hidden', '');
				}
			});

			if (isExpanded) {
				trigger.setAttribute('aria-expanded', 'false');
				if (item) item.classList.remove('is-active');
				if (panel) panel.setAttribute('hidden', '');
			} else {
				trigger.setAttribute('aria-expanded', 'true');
				if (item) item.classList.add('is-active');
				if (panel) panel.removeAttribute('hidden');
			}
		});

		// Keyboard accessibility
		trigger.addEventListener('keydown', (e) => {
			if (e.key === 'ArrowDown') {
				e.preventDefault();
				const nextTrigger = triggers[(index + 1) % triggers.length];
				if (nextTrigger) nextTrigger.focus();
			} else if (e.key === 'ArrowUp') {
				e.preventDefault();
				const prevTrigger = triggers[(index - 1 + triggers.length) % triggers.length];
				if (prevTrigger) prevTrigger.focus();
			} else if (e.key === 'Home') {
				e.preventDefault();
				triggers[0].focus();
			} else if (e.key === 'End') {
				e.preventDefault();
				triggers[triggers.length - 1].focus();
			}
		});
	});
}

/**
 * Smooth scrolling for in-page anchors
 */
function initSmoothScroll() {
	const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
	anchorLinks.forEach((link) => {
		link.addEventListener('click', (e) => {
			const targetId = link.getAttribute('href');
			if (!targetId || targetId === '#') return;
			const targetEl = document.querySelector(targetId);
			if (targetEl) {
				e.preventDefault();
				const headerOffset = 110;
				const elementPosition = targetEl.getBoundingClientRect().top;
				const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

				window.scrollTo({
					top: offsetPosition,
					behavior: 'smooth'
				});
			}
		});
	});
}
