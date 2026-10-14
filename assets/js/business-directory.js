/**
 * Business Directory — Frontend Interaction Script
 *
 * Handles client-side filter state, category tile synchronization,
 * and form reset logic for Task 01.
 *
 * @package Love_Family_Theme
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		const searchInput     = document.getElementById('lfa-biz-search-input');
		const searchBtn       = document.getElementById('lfa-biz-search-btn');
		const resetBtn        = document.getElementById('lfa-biz-reset-btn');
		const categorySelect  = document.getElementById('lfa-biz-filter-category');
		const countrySelect   = document.getElementById('lfa-biz-filter-country');
		const citySelect      = document.getElementById('lfa-biz-filter-city');
		const sortSelect      = document.getElementById('lfa-biz-filter-sort');
		const categoryCards   = document.querySelectorAll('.lfa-biz-cat-card');
		const viewAllCatsBtn  = document.getElementById('lfa-biz-view-all-cats');

		if (!searchInput && !categorySelect) {
			return;
		}

		// Sync category tile selection with dropdown
		function selectCategory(categoryName) {
			if (categorySelect) {
				categorySelect.value = categoryName || '';
			}

			categoryCards.forEach(function (card) {
				const cardCat = card.getAttribute('data-category');
				if (cardCat && cardCat === categoryName) {
					card.classList.add('is-active');
					card.setAttribute('aria-pressed', 'true');
				} else {
					card.classList.remove('is-active');
					card.setAttribute('aria-pressed', 'false');
				}
			});
		}

		// Category tile clicks
		categoryCards.forEach(function (card) {
			card.addEventListener('click', function () {
				const targetCat = this.getAttribute('data-category');
				const isCurrentlyActive = this.classList.contains('is-active');

				if (isCurrentlyActive) {
					selectCategory('');
				} else {
					selectCategory(targetCat);
				}
			});
		});

		// Category dropdown change syncs back to cards
		if (categorySelect) {
			categorySelect.addEventListener('change', function () {
				selectCategory(this.value);
			});
		}

		// View All Categories button resets category selection
		if (viewAllCatsBtn) {
			viewAllCatsBtn.addEventListener('click', function (e) {
				e.preventDefault();
				selectCategory('');
			});
		}

		// Reset Filters
		if (resetBtn) {
			resetBtn.addEventListener('click', function () {
				if (searchInput) searchInput.value = '';
				if (countrySelect) countrySelect.value = '';
				if (citySelect) citySelect.value = '';
				if (sortSelect) sortSelect.value = 'recent';
				selectCategory('');

				if (searchInput) {
					searchInput.focus();
				}
			});
		}

		// Search button and Enter key handling
		if (searchBtn) {
			searchBtn.addEventListener('click', function () {
				// State feedback for Task 01
				console.log('[Business Directory] Filter criteria:', {
					keyword: searchInput ? searchInput.value.trim() : '',
					category: categorySelect ? categorySelect.value : '',
					country: countrySelect ? countrySelect.value : '',
					city: citySelect ? citySelect.value : '',
					sort: sortSelect ? sortSelect.value : '',
				});
			});
		}

		if (searchInput) {
			searchInput.addEventListener('keydown', function (e) {
				if (e.key === 'Enter') {
					e.preventDefault();
					if (searchBtn) searchBtn.click();
				}
			});
		}
	});
})();
