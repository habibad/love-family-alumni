/**
 * LFA scholarships task 02: local-only form preview.
 * No network calls, localStorage, sessionStorage, cookies, upload or submission.
 */
(() => {
  'use strict';
  const forms = document.querySelectorAll('#lfa-scholarships-demo-form');
  forms.forEach((form) => {
    if (form.dataset.lfaInitialized === 'true') return;
    form.dataset.lfaInitialized = 'true';
    const review = form.querySelector('[data-lfa-scholarships-preview-trigger]');
    const panel = form.querySelector('#lfa-scholarships-preview-panel');
    const close = form.querySelector('[data-lfa-scholarships-close-preview]');
    const statement = form.querySelector('#lfa-scholarships-statement');
    const counter = form.querySelector('#lfa-scholarships-statement-count');
    const fields = ['applicant_name', 'email', 'education_level', 'program', 'field_of_study', 'statement'];

    if (!review || !panel || !statement || !counter) return;

    // Absolutely forbid native form submission, including the Enter key.
    form.addEventListener('submit', (event) => event.preventDefault());
    const hidePreview = () => { panel.hidden = true; };
    const updateCounter = () => { counter.textContent = `${statement.value.length} / 600 characters`; };
    form.addEventListener('input', () => { updateCounter(); hidePreview(); });
    form.addEventListener('change', hidePreview);
    form.addEventListener('reset', () => { hidePreview(); requestAnimationFrame(updateCounter); });

    review.addEventListener('click', () => {
      // Native browser validation; the form is not submitted even if all fields are valid.
      if (!form.reportValidity()) return;
      fields.forEach((name) => {
        const source = form.elements.namedItem(name);
        const target = panel.querySelector(`[data-lfa-scholarships-review="${name}"]`);
        if (!source || !target) return;
        const selected = source instanceof HTMLSelectElement ? source.selectedOptions[0] : null;
        target.textContent = selected ? selected.textContent.trim() : source.value.trim();
      });
      panel.hidden = false;
      panel.focus({ preventScroll: true });
      panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    if (close) close.addEventListener('click', () => { hidePreview(); review.focus(); });
    updateCounter();
  });
})();
