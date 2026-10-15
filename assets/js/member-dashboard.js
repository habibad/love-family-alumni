/* LFA member dashboard: interactive frontend demonstration. No network requests or persistence. */
(function () {
  'use strict';
  const root = document.querySelector('[data-lfa-dashboard]');
  if (!root) return;
  const links = Array.from(root.querySelectorAll('[data-view-link]'));
  const panels = Array.from(root.querySelectorAll('[data-view-panel]'));
  const tabs = new Set(panels.map(p => p.dataset.viewPanel));
  const mobileToggle = root.querySelector('[data-mobile-toggle]');
  const backdrop = root.querySelector('[data-mobile-backdrop]');
  const eyebrow = root.querySelector('[data-view-eyebrow]');
  const toast = root.querySelector('[data-toast]');
  let toastTimeout;

  function showToast(message) {
    if (!toast) return;
    clearTimeout(toastTimeout);
    toast.textContent = message;
    toast.hidden = false;
    toastTimeout = setTimeout(() => { toast.hidden = true; }, 4000);
  }
  function setMobileOpen(open) {
    root.classList.toggle('is-nav-open', open);
    if (mobileToggle) mobileToggle.setAttribute('aria-expanded', String(open));
    if (backdrop) backdrop.hidden = !open;
  }
  function navigate(name, updateHash) {
    const safe = tabs.has(name) ? name : 'overview';
    panels.forEach(panel => { panel.hidden = panel.dataset.viewPanel !== safe; });
    links.forEach(link => {
      const active = link.dataset.viewLink === safe;
      link.classList.toggle('is-active', active);
      if (active) link.setAttribute('aria-current', 'page'); else link.removeAttribute('aria-current');
    });
    const activeLink = links.find(link => link.dataset.viewLink === safe);
    if (eyebrow) eyebrow.textContent = 'MEMBER AREA / ' + (activeLink ? activeLink.textContent.trim() : safe).toUpperCase();
    setMobileOpen(false);
    if (updateHash && window.location.hash !== '#' + safe) history.replaceState(null, '', '#' + safe);
    // In-page navigation should not jump to hidden content; focus heading for screen readers.
    const panel = panels.find(p => p.dataset.viewPanel === safe);
    const h = panel && panel.querySelector('h1');
    if (h) { h.setAttribute('tabindex', '-1'); h.focus({preventScroll: true}); }
    if (updateHash) {
      root.scrollIntoView({behavior: 'auto', block: 'start'});
    } else if (window.location.hash) {
      window.scrollTo(0, 0);
    }
  }
  links.forEach(link => link.addEventListener('click', event => {
    event.preventDefault();
    navigate(link.dataset.viewLink, true);
  }));
  root.querySelectorAll('[data-go]').forEach(button => button.addEventListener('click', () => navigate(button.dataset.go, true)));
  root.querySelectorAll('[data-unavailable]').forEach(button => button.addEventListener('click', () => showToast(button.dataset.unavailable)));
  if (mobileToggle) mobileToggle.addEventListener('click', () => setMobileOpen(!root.classList.contains('is-nav-open')));
  if (backdrop) backdrop.addEventListener('click', () => setMobileOpen(false));
  document.addEventListener('keydown', event => { if (event.key === 'Escape') setMobileOpen(false); });
  window.addEventListener('hashchange', () => navigate(location.hash.slice(1), false));
  navigate(location.hash.slice(1), false);
  if (window.location.search.includes('nav=open')) {
    setMobileOpen(true);
  }

  root.querySelectorAll('[data-copy-id]').forEach(button => button.addEventListener('click', async () => {
    const value = button.dataset.copyId;
    if (!navigator.clipboard || !navigator.clipboard.writeText) {
      showToast('Demo ID: ' + value + ' (select to copy)'); return;
    }
    try { await navigator.clipboard.writeText(value); showToast('Demo alumni ID copied. Not a verified membership ID.'); }
    catch (_) { showToast('Demo ID: ' + value); }
  }));
  const form = root.querySelector('[data-profile-form]');
  const review = root.querySelector('[data-profile-review]');
  if (form && review) {
    form.addEventListener('submit', event => {
      event.preventDefault();
      if (!form.checkValidity()) { form.reportValidity(); return; }
      const values = new FormData(form);
      review.textContent = 'PROFILE PREVIEW ONLY — NOT SAVED\n\nName: ' + values.get('full_name') + '\nEmail: ' + values.get('email') + '\nLocation: ' + values.get('location') + '\nProfession: ' + values.get('profession') + '\nDirectory visibility: ' + values.get('visibility');
      review.hidden = false;
      showToast('Preview generated locally. No changes were saved.');
    });
    form.addEventListener('reset', () => { review.hidden = true; showToast('Form reset to example data.'); });
  }
  root.querySelectorAll('[data-setting]').forEach(toggle => toggle.addEventListener('change', () => {
    const preview = root.querySelector('[data-settings-preview]');
    if (preview) preview.textContent = 'Settings adjusted in this preview. No account changes were saved.';
  }));
})();
