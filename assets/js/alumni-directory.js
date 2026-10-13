/**
 * Love Family Alumni - Alumni Directory Client Script (Phase 02 / Page 04)
 * Scoped under .lfa-directory
 */

document.addEventListener('DOMContentLoaded', function () {
	const directoryWrapper = document.querySelector('.lfa-directory');
	if (!directoryWrapper) return;

	const filterForm   = document.getElementById('alumni-directory-filter-form');
	const searchInput  = document.getElementById('directory-search-input');
	const searchBtn    = document.getElementById('directory-search-btn');
	const resetBtn     = document.getElementById('directory-reset-btn');
	const yearSelect   = document.getElementById('filter-class-year');
	const profSelect   = document.getElementById('filter-profession');
	const locSelect    = document.getElementById('filter-location');
	const countrySelect= document.getElementById('filter-country');
	const sortSelect   = document.getElementById('filter-sort');

	const gridContainer = document.getElementById('directory-profiles-grid');
	const emptyState    = document.getElementById('directory-empty-state');
	const currentRange  = document.querySelector('.results-current-range');
	const viewToggles   = document.querySelectorAll('.view-toggle-btn');
	const emptyResetBtn = document.querySelector('.empty-reset-trigger');

	if (!gridContainer) return;

	const cardElements = Array.from(gridContainer.querySelectorAll('.directory-profile-card'));

	// Filter and Sort function
	function applyFilters() {
		const keyword = (searchInput ? searchInput.value.trim().toLowerCase() : '');
		const yearVal = (yearSelect ? yearSelect.value : '');
		const profVal = (profSelect ? profSelect.value.toLowerCase() : '');
		const locVal  = (locSelect ? locSelect.value.toLowerCase() : '');
		const countryVal = (countrySelect ? countrySelect.value.toLowerCase() : '');
		const sortVal = (sortSelect ? sortSelect.value : 'recently_added');

		let visibleCount = 0;

		cardElements.forEach(card => {
			const cardName = (card.querySelector('.profile-name')?.textContent || '').toLowerCase();
			const cardTitle = (card.querySelector('.profile-title')?.textContent || '').toLowerCase();
			const cardYear = (card.dataset.year || '').toLowerCase();
			const cardLocation = (card.dataset.location || '').toLowerCase();
			const cardCountry = (card.dataset.country || '').toLowerCase();
			const cardProfession = (card.dataset.profession || '').toLowerCase();

			let matchesKeyword = true;
			if (keyword) {
				matchesKeyword = cardName.includes(keyword) || 
				                 cardTitle.includes(keyword) || 
				                 cardYear.includes(keyword) || 
				                 cardLocation.includes(keyword) ||
				                 cardProfession.includes(keyword);
			}

			let matchesYear = true;
			if (yearVal) {
				matchesYear = (cardYear === yearVal.toLowerCase());
			}

			let matchesProf = true;
			if (profVal) {
				matchesProf = cardProfession.includes(profVal) || cardTitle.includes(profVal);
			}

			let matchesLoc = true;
			if (locVal) {
				matchesLoc = cardLocation.includes(locVal);
			}

			let matchesCountry = true;
			if (countryVal) {
				matchesCountry = cardCountry.includes(countryVal);
			}

			if (matchesKeyword && matchesYear && matchesProf && matchesLoc && matchesCountry) {
				card.style.display = '';
				visibleCount++;
			} else {
				card.style.display = 'none';
			}
		});

		// Sort visible cards
		if (sortVal && sortVal !== 'recently_added') {
			const visibleCards = cardElements.filter(c => c.style.display !== 'none');
			visibleCards.sort((a, b) => {
				const nameA = (a.querySelector('.profile-name')?.textContent || '').toLowerCase();
				const nameB = (b.querySelector('.profile-name')?.textContent || '').toLowerCase();
				const yearA = parseInt(a.dataset.year || '0', 10);
				const yearB = parseInt(b.dataset.year || '0', 10);

				if (sortVal === 'name_asc') return nameA.localeCompare(nameB);
				if (sortVal === 'name_desc') return nameB.localeCompare(nameA);
				if (sortVal === 'year_desc') return yearB - yearA;
				if (sortVal === 'year_asc') return yearA - yearB;
				return 0;
			});

			visibleCards.forEach(c => gridContainer.appendChild(c));
		}

		// Update Results Count
		if (currentRange) {
			currentRange.textContent = visibleCount > 0 ? `1 \u2013 ${visibleCount}` : '0';
		}

		// Show/Hide Empty State
		if (emptyState) {
			emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
		}
	}

	// Reset All
	function resetFilters() {
		if (searchInput) searchInput.value = '';
		if (yearSelect) yearSelect.selectedIndex = 0;
		if (profSelect) profSelect.selectedIndex = 0;
		if (locSelect) locSelect.selectedIndex = 0;
		if (countrySelect) countrySelect.selectedIndex = 0;
		if (sortSelect) sortSelect.selectedIndex = 0;

		cardElements.forEach(card => card.style.display = '');

		if (currentRange) {
			currentRange.textContent = `1 \u2013 ${cardElements.length}`;
		}
		if (emptyState) {
			emptyState.style.display = 'none';
		}
	}

	// Event Listeners
	if (resetBtn) {
		resetBtn.addEventListener('click', function (e) {
			e.preventDefault();
			resetFilters();
		});
	}

	if (emptyResetBtn) {
		emptyResetBtn.addEventListener('click', function (e) {
			e.preventDefault();
			resetFilters();
		});
	}

	if (searchInput) {
		searchInput.addEventListener('input', applyFilters);
	}

	if (searchBtn) {
		searchBtn.addEventListener('click', function (e) {
			e.preventDefault();
			applyFilters();
		});
	}

	[yearSelect, profSelect, locSelect, countrySelect, sortSelect].forEach(sel => {
		if (sel) {
			sel.addEventListener('change', applyFilters);
		}
	});

	if (filterForm) {
		filterForm.addEventListener('submit', function (e) {
			e.preventDefault();
			applyFilters();
		});
	}

	// View Toggle Buttons (Grid vs List)
	viewToggles.forEach(btn => {
		btn.addEventListener('click', function () {
			viewToggles.forEach(b => b.classList.remove('active'));
			this.classList.add('active');
			const viewMode = this.dataset.view;
			if (viewMode === 'list') {
				gridContainer.classList.add('directory-list-view');
			} else {
				gridContainer.classList.remove('directory-list-view');
			}
		});
	});
});
