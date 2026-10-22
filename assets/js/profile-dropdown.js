/**
 * Love Family Alumni — Public Header Profile Dropdown Component (Phase 07)
 * Accessible, keyboard friendly, desktop hover + click toggle, mobile touch support.
 */
(function () {
    'use strict';

    function initProfileMenus() {
        const hasDesktopHover = () => window.matchMedia('(hover:hover) and (pointer:fine)').matches;

        document.querySelectorAll('[data-lfa-profile-menu]').forEach((root) => {
            if (root.dataset.lfaInitialized === 'true') {
                return;
            }
            root.dataset.lfaInitialized = 'true';

            const trigger = root.querySelector('[data-lfa-profile-trigger]');
            const popover = root.querySelector('[data-lfa-profile-popover]');
            if (!trigger || !popover) {
                return;
            }

            let leaveTimer = null;

            const setOpen = (open, returnFocus = false) => {
                clearTimeout(leaveTimer);
                trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
                popover.hidden = !open;
                if (!open && returnFocus) {
                    trigger.focus();
                }
            };

            // Click / Tap toggle
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = trigger.getAttribute('aria-expanded') === 'true';
                setOpen(!isOpen);
            });

            // Desktop Hover with safe buffer
            root.addEventListener('pointerenter', () => {
                if (hasDesktopHover()) {
                    clearTimeout(leaveTimer);
                    setOpen(true);
                }
            });

            root.addEventListener('pointerleave', () => {
                if (hasDesktopHover()) {
                    clearTimeout(leaveTimer);
                    leaveTimer = setTimeout(() => {
                        setOpen(false);
                    }, 180);
                }
            });

            // Focus management
            root.addEventListener('focusin', () => {
                clearTimeout(leaveTimer);
            });

            root.addEventListener('focusout', (e) => {
                if (!root.contains(e.relatedTarget)) {
                    clearTimeout(leaveTimer);
                    leaveTimer = setTimeout(() => {
                        setOpen(false);
                    }, 100);
                }
            });

            // Keyboard navigation
            root.addEventListener('keydown', (e) => {
                const isOpen = trigger.getAttribute('aria-expanded') === 'true';

                if (e.key === 'Escape' && isOpen) {
                    e.preventDefault();
                    setOpen(false, true);
                    return;
                }

                if (e.key === 'ArrowDown' && document.activeElement === trigger && isOpen) {
                    e.preventDefault();
                    const firstLink = popover.querySelector('a');
                    if (firstLink) {
                        firstLink.focus();
                    }
                    return;
                }
            });

            // Click outside to close
            document.addEventListener('pointerdown', (e) => {
                if (!root.contains(e.target)) {
                    setOpen(false);
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProfileMenus);
    } else {
        initProfileMenus();
    }
})();
