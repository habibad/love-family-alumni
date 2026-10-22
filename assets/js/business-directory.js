/**
 * Business Directory — Frontend Real-Time Filter & Modal Interaction
 *
 * Handles client-side filtering, category synchronization, empty state toggling,
 * and accessible detailed preview modal for approved business listings.
 *
 * @package Love_Family_Theme
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		const searchInput     = document.getElementById('lfa-biz-search-input');
		const searchBtn       = document.getElementById('lfa-biz-search-btn');
		const resetBtn        = document.getElementById('lfa-biz-reset-btn');
		const emptyResetBtn   = document.getElementById('lfa-biz-empty-reset');
		const categorySelect  = document.getElementById('lfa-biz-filter-category');
		const countrySelect   = document.getElementById('lfa-biz-filter-country');
		const citySelect      = document.getElementById('lfa-biz-filter-city');
		const sortSelect      = document.getElementById('lfa-biz-filter-sort');
		const categoryCards   = document.querySelectorAll('.lfa-biz-cat-card');
		const viewAllCatsBtn  = document.getElementById('lfa-biz-view-all-cats');

		const gridContainer   = document.getElementById('lfa-biz-grid');
		const emptyState      = document.getElementById('lfa-biz-empty-state');
		const showingCount    = document.getElementById('lfa-biz-showing-count');
		const totalCount      = document.getElementById('lfa-biz-total-count');

		// Modal elements
		const modal           = document.getElementById('lfa-biz-modal');
		const modalClose      = document.getElementById('lfa-biz-modal-close');
		const modalName       = document.getElementById('modal-biz-name');
		const modalCat        = document.getElementById('modal-biz-category');
		const modalLoc        = document.getElementById('modal-biz-location');
		const modalDesc       = document.getElementById('modal-biz-description');
		const modalOwner      = document.getElementById('modal-biz-owner');
		const modalContact    = document.getElementById('modal-biz-contact-info');
		const modalWebsite    = document.getElementById('modal-biz-website-link');
		const modalLogoWrap   = document.getElementById('modal-biz-logo-wrap');

		if (document.querySelector('.lfa-directory-locked-container')) {
			return;
		}

		if (!gridContainer && !searchInput) {
			return;
		}

		const cards = gridContainer ? Array.from(gridContainer.querySelectorAll('.lfa-biz-card')) : [];

		function filterCards() {
			if (!gridContainer) return;

			const kw = searchInput ? searchInput.value.trim().toLowerCase() : '';
			const cat = categorySelect ? categorySelect.value.trim().toLowerCase() : '';
			const country = countrySelect ? countrySelect.value.trim().toLowerCase() : '';
			const city = citySelect ? citySelect.value.trim().toLowerCase() : '';
			const sort = sortSelect ? sortSelect.value : 'recent';

			let visibleCount = 0;
			let matchingCards = [];

			cards.forEach(function (card) {
				const cardName = (card.getAttribute('data-name') || '').toLowerCase();
				const cardCat = (card.getAttribute('data-category') || '').toLowerCase();
				const cardCountry = (card.getAttribute('data-country') || '').toLowerCase();
				const cardCity = (card.getAttribute('data-city') || '').toLowerCase();
				const cardDesc = (card.getAttribute('data-desc') || '').toLowerCase();
				const cardOwner = (card.getAttribute('data-owner') || '').toLowerCase();

				let matches = true;

				// Keyword search
				if (kw) {
					const haystack = `${cardName} ${cardCat} ${cardCountry} ${cardCity} ${cardDesc} ${cardOwner}`;
					if (!haystack.includes(kw)) {
						matches = false;
					}
				}

				// Category filter
				if (cat && cardCat !== cat) {
					matches = false;
				}

				// Country filter
				if (country && cardCountry !== country) {
					matches = false;
				}

				// City filter
				if (city && cardCity !== city) {
					matches = false;
				}

				if (matches) {
					card.style.display = 'flex';
					visibleCount++;
					matchingCards.push(card);
				} else {
					card.style.display = 'none';
				}
			});

			// Sort matching cards
			if (sort === 'name_asc') {
				matchingCards.sort((a, b) => (a.getAttribute('data-name') || '').localeCompare(b.getAttribute('data-name') || ''));
			} else if (sort === 'name_desc') {
				matchingCards.sort((a, b) => (b.getAttribute('data-name') || '').localeCompare(a.getAttribute('data-name') || ''));
			}
			matchingCards.forEach(c => gridContainer.appendChild(c));

			if (showingCount) showingCount.textContent = visibleCount.toString();

			if (emptyState) {
				emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
			}
		}

		// Category Tile Sync
		function selectCategory(categoryName) {
			if (categorySelect) {
				categorySelect.value = categoryName || '';
			}

			categoryCards.forEach(function (card) {
				const cardCat = card.getAttribute('data-category');
				if (cardCat && cardCat.toLowerCase() === (categoryName || '').toLowerCase()) {
					card.classList.add('is-active');
					card.setAttribute('aria-pressed', 'true');
				} else {
					card.classList.remove('is-active');
					card.setAttribute('aria-pressed', 'false');
				}
			});

			filterCards();
		}

		// Category Tile clicks
		categoryCards.forEach(function (card) {
			card.addEventListener('click', function () {
				const targetCat = this.getAttribute('data-category');
				const isCurrentlyActive = this.classList.contains('is-active');
				selectCategory(isCurrentlyActive ? '' : targetCat);
			});
		});

		if (categorySelect) categorySelect.addEventListener('change', () => selectCategory(categorySelect.value));
		if (countrySelect) countrySelect.addEventListener('change', filterCards);
		if (citySelect) citySelect.addEventListener('change', filterCards);
		if (sortSelect) sortSelect.addEventListener('change', filterCards);

		if (searchInput) {
			searchInput.addEventListener('input', filterCards);
			searchInput.addEventListener('keydown', function (e) {
				if (e.key === 'Enter') {
					e.preventDefault();
					filterCards();
				}
			});
		}

		if (searchBtn) searchBtn.addEventListener('click', filterCards);

		function resetAll() {
			if (searchInput) searchInput.value = '';
			if (countrySelect) countrySelect.value = '';
			if (citySelect) citySelect.value = '';
			if (sortSelect) sortSelect.value = 'recent';
			selectCategory('');
			filterCards();
		}

		if (resetBtn) resetBtn.addEventListener('click', resetAll);
		if (emptyResetBtn) emptyResetBtn.addEventListener('click', resetAll);
		if (viewAllCatsBtn) viewAllCatsBtn.addEventListener('click', function (e) { e.preventDefault(); selectCategory(''); });

		// Modal Triggers
		cards.forEach(function (card) {
			const detailBtn = card.querySelector('.lfa-biz-preview-btn');
			if (!detailBtn) return;

			detailBtn.addEventListener('click', function () {
				const name = card.getAttribute('data-name');
				const cat = card.getAttribute('data-category');
				const country = card.getAttribute('data-country');
				const city = card.getAttribute('data-city');
				const desc = card.getAttribute('data-desc');
				const owner = card.getAttribute('data-owner');
				const website = card.getAttribute('data-website');
				const logo = card.getAttribute('data-logo');
				const email = card.getAttribute('data-email');
				const phone = card.getAttribute('data-phone');

				if (modalName) modalName.textContent = name;
				if (modalCat) modalCat.textContent = cat;
				if (modalLoc) modalLoc.textContent = '📍 ' + city + ', ' + country;
				if (modalDesc) modalDesc.textContent = desc;
				if (modalOwner) modalOwner.textContent = owner;

				if (modalLogoWrap) {
					if (logo) {
						modalLogoWrap.innerHTML = `<img src="${logo}" alt="${name}" style="width:64px;height:64px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0;">`;
					} else {
						modalLogoWrap.innerHTML = `<div style="width:64px;height:64px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:24px;color:#0F2942;border:1px solid #e2e8f0;">${name.charAt(0).toUpperCase()}</div>`;
					}
				}

				if (modalContact) {
					let contactHtml = '';
					if (email) contactHtml += `<p style="margin:2px 0;"><strong>Email:</strong> <a href="mailto:${email}" style="color:#1d4ed8;">${email}</a></p>`;
					if (phone) contactHtml += `<p style="margin:2px 0;"><strong>Phone:</strong> <a href="tel:${phone}" style="color:#1d4ed8;">${phone}</a></p>`;
					if (!email && !phone) contactHtml = '<p style="margin:0;color:#64748b;font-style:italic;">No direct company phone/email published by request of the owner.</p>';
					modalContact.innerHTML = contactHtml;
				}

				if (modalWebsite) {
					if (website) {
						modalWebsite.href = website;
						modalWebsite.style.display = 'inline-block';
					} else {
						modalWebsite.style.display = 'none';
					}
				}

				if (modal) {
					modal.style.display = 'flex';
					modal.setAttribute('aria-hidden', 'false');
				}
			});
		});

		function closeModal() {
			if (modal) {
				modal.style.display = 'none';
				modal.setAttribute('aria-hidden', 'true');
			}
		}

		if (modalClose) modalClose.addEventListener('click', closeModal);
		if (modal) {
			modal.addEventListener('click', function (e) {
				if (e.target === modal) closeModal();
			});
		}
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') closeModal();
		});
	});
})();
