/**
 * Love Family Alumni - Alumni Directory Client Script (Phase 02 / Page 04)
 * Scoped strictly under .lfa-directory
 */

document.addEventListener('DOMContentLoaded', function () {
	const directoryWrapper = document.querySelector('.lfa-directory');
	if (!directoryWrapper) return;

	// Filter Form Controls
	const filterForm    = document.getElementById('alumni-directory-filter-form');
	const searchInput   = document.getElementById('directory-search-input');
	const searchBtn     = document.getElementById('directory-search-btn');
	const resetBtn      = document.getElementById('directory-reset-btn');
	const yearSelect    = document.getElementById('filter-class-year');
	const profSelect    = document.getElementById('filter-profession');
	const locSelect     = document.getElementById('filter-location');
	const countrySelect = document.getElementById('filter-country');
	const sortSelect    = document.getElementById('filter-sort');

	// Results & Grid Controls
	const gridContainer   = document.getElementById('directory-profiles-grid');
	const emptyState      = document.getElementById('directory-empty-state');
	const currentRange    = document.querySelector('.results-current-range');
	const totalCountLabel = document.querySelector('.results-total-count');
	const viewToggles     = document.querySelectorAll('.view-toggle-btn');
	const emptyResetBtn   = document.querySelector('.empty-reset-trigger');
	const paginationNav   = document.querySelector('.directory-pagination');
	const paginationWrap  = document.querySelector('.directory-pagination-wrapper');

	// Modal Controls
	const modalBackdrop   = document.getElementById('directory-profile-modal');
	const modalCloseBtn   = document.getElementById('modal-close-btn');
	const modalAvatarImg  = document.getElementById('modal-profile-avatar');
	const modalAvatarFall = document.getElementById('modal-profile-fallback');
	const modalInitial    = document.getElementById('modal-profile-initial');
	const modalBatch      = document.getElementById('modal-profile-batch');
	const modalName       = document.getElementById('modal-profile-name');
	const modalTitle      = document.getElementById('modal-profile-title');
	const modalCompany    = document.getElementById('modal-profile-company');
	const modalLocation   = document.getElementById('modal-profile-location');
	const modalIndustry   = document.getElementById('modal-profile-industry');
	const modalBio        = document.getElementById('modal-profile-bio');
	const modalEmailBtn   = document.getElementById('modal-profile-email');
	const modalLinkedInBtn= document.getElementById('modal-profile-linkedin');

	if (!gridContainer) return;

	const cardElements = Array.from(gridContainer.querySelectorAll('.directory-profile-card'));
	const itemsPerPage = 8;
	let currentPage    = 1;
	let matchingCards  = [...cardElements];

	/**
	 * Render client-side pagination UI and display matching slice of cards
	 */
	function renderPagination() {
		const totalMatches = matchingCards.length;
		const totalPages   = Math.max(1, Math.ceil(totalMatches / itemsPerPage));

		if (currentPage > totalPages) {
			currentPage = 1;
		}

		// Show/hide pagination container
		if (paginationWrap) {
			paginationWrap.style.display = totalMatches <= itemsPerPage ? 'none' : 'flex';
		}

		// Update card visibility based on page slice
		const startIndex = (currentPage - 1) * itemsPerPage;
		const endIndex   = startIndex + itemsPerPage;

		cardElements.forEach(card => {
			card.style.display = 'none';
		});

		const currentSlice = matchingCards.slice(startIndex, endIndex);
		currentSlice.forEach(card => {
			card.style.display = '';
		});

		// Update toolbar range text
		if (currentRange) {
			if (totalMatches === 0) {
				currentRange.textContent = '0';
			} else {
				const displayEnd = Math.min(endIndex, totalMatches);
				currentRange.textContent = `${startIndex + 1} \u2013 ${displayEnd}`;
			}
		}

		if (totalCountLabel) {
			totalCountLabel.textContent = totalMatches.toString();
		}

		// Build Pagination Buttons
		if (paginationNav) {
			paginationNav.innerHTML = '';

			// Prev Arrow
			const prevBtn = document.createElement('button');
			prevBtn.type = 'button';
			prevBtn.className = `pagination-arrow pagination-prev ${currentPage === 1 ? 'disabled' : ''}`;
			prevBtn.setAttribute('aria-label', 'Previous page');
			prevBtn.disabled = (currentPage === 1);
			prevBtn.innerHTML = `
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<polyline points="15 18 9 12 15 6"></polyline>
				</svg>
			`;
			prevBtn.addEventListener('click', () => {
				if (currentPage > 1) {
					currentPage--;
					renderPagination();
					scrollToGrid();
				}
			});
			paginationNav.appendChild(prevBtn);

			// Page Numbers
			for (let i = 1; i <= totalPages; i++) {
				const pageBtn = document.createElement('button');
				pageBtn.type = 'button';
				pageBtn.className = `pagination-item ${i === currentPage ? 'pagination-active' : ''}`;
				pageBtn.textContent = i.toString();
				if (i === currentPage) {
					pageBtn.setAttribute('aria-current', 'page');
				}
				pageBtn.addEventListener('click', () => {
					currentPage = i;
					renderPagination();
					scrollToGrid();
				});
				paginationNav.appendChild(pageBtn);
			}

			// Next Arrow
			const nextBtn = document.createElement('button');
			nextBtn.type = 'button';
			nextBtn.className = `pagination-arrow pagination-next ${currentPage === totalPages ? 'disabled' : ''}`;
			nextBtn.setAttribute('aria-label', 'Next page');
			nextBtn.disabled = (currentPage === totalPages);
			nextBtn.innerHTML = `
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<polyline points="9 18 15 12 9 6"></polyline>
				</svg>
			`;
			nextBtn.addEventListener('click', () => {
				if (currentPage < totalPages) {
					currentPage++;
					renderPagination();
					scrollToGrid();
				}
			});
			paginationNav.appendChild(nextBtn);
		}
	}

	function scrollToGrid() {
		const target = document.getElementById('directory-profiles');
		if (target) {
			target.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	}

	/**
	 * Filter and Sort Function
	 */
	function applyFilters(resetPage = true) {
		const keyword    = (searchInput ? searchInput.value.trim().toLowerCase() : '');
		const yearVal    = (yearSelect ? yearSelect.value.trim().toLowerCase() : '');
		const profVal    = (profSelect ? profSelect.value.trim().toLowerCase() : '');
		const locVal     = (locSelect ? locSelect.value.trim().toLowerCase() : '');
		const countryVal = (countrySelect ? countrySelect.value.trim().toLowerCase() : '');
		const sortVal    = (sortSelect ? sortSelect.value : 'recently_added');

		matchingCards = cardElements.filter(card => {
			const cardName     = (card.dataset.name || card.querySelector('.profile-name')?.textContent || '').toLowerCase();
			const cardTitle    = (card.dataset.profession || card.querySelector('.profile-title')?.textContent || '').toLowerCase();
			const cardYear     = (card.dataset.year || '').toLowerCase();
			const cardLocation = (card.dataset.location || '').toLowerCase();
			const cardCountry  = (card.dataset.country || '').toLowerCase();
			const cardCompany  = (card.dataset.company || '').toLowerCase();
			const cardIndustry = (card.dataset.industry || '').toLowerCase();
			const cardBio      = (card.dataset.bio || '').toLowerCase();

			let matchesKeyword = true;
			if (keyword) {
				matchesKeyword = cardName.includes(keyword) || 
				                 cardTitle.includes(keyword) || 
				                 cardYear.includes(keyword) || 
				                 cardLocation.includes(keyword) ||
				                 cardCompany.includes(keyword) ||
				                 cardIndustry.includes(keyword) ||
				                 cardBio.includes(keyword);
			}

			let matchesYear = true;
			if (yearVal) {
				matchesYear = (cardYear === yearVal);
			}

			let matchesProf = true;
			if (profVal) {
				matchesProf = cardTitle.includes(profVal);
			}

			let matchesLoc = true;
			if (locVal) {
				matchesLoc = cardLocation.includes(locVal);
			}

			let matchesCountry = true;
			if (countryVal) {
				if (countryVal === 'other') {
					matchesCountry = (cardCountry !== 'united states' && cardCountry !== 'canada' && cardCountry !== 'united kingdom' && cardCountry !== 'nigeria');
				} else {
					matchesCountry = cardCountry.includes(countryVal);
				}
			}

			return matchesKeyword && matchesYear && matchesProf && matchesLoc && matchesCountry;
		});

		// Sort matching cards
		if (sortVal && sortVal !== 'recently_added') {
			matchingCards.sort((a, b) => {
				const nameA = (a.dataset.name || a.querySelector('.profile-name')?.textContent || '').toLowerCase();
				const nameB = (b.dataset.name || b.querySelector('.profile-name')?.textContent || '').toLowerCase();
				const yearA = parseInt(a.dataset.year || '0', 10);
				const yearB = parseInt(b.dataset.year || '0', 10);

				if (sortVal === 'name_asc') return nameA.localeCompare(nameB);
				if (sortVal === 'name_desc') return nameB.localeCompare(nameA);
				if (sortVal === 'year_desc') return yearB - yearA;
				if (sortVal === 'year_asc') return yearA - yearB;
				return 0;
			});

			matchingCards.forEach(c => gridContainer.appendChild(c));
		}

		if (resetPage) {
			currentPage = 1;
		}

		// Empty State toggle
		if (emptyState) {
			emptyState.style.display = matchingCards.length === 0 ? 'block' : 'none';
		}

		renderPagination();
	}

	/**
	 * Reset All Filters
	 */
	function resetFilters() {
		if (searchInput) searchInput.value = '';
		if (yearSelect) yearSelect.selectedIndex = 0;
		if (profSelect) profSelect.selectedIndex = 0;
		if (locSelect) locSelect.selectedIndex = 0;
		if (countrySelect) countrySelect.selectedIndex = 0;
		if (sortSelect) sortSelect.selectedIndex = 0;

		matchingCards = [...cardElements];
		currentPage = 1;

		if (emptyState) {
			emptyState.style.display = 'none';
		}

		renderPagination();
	}

	// Profile Modal Open / Close Handlers
	function openProfileModal(card) {
		if (!modalBackdrop) return;

		const name     = card.dataset.name || card.querySelector('.profile-name')?.textContent || 'Alumni Member';
		const title    = card.dataset.profession || card.querySelector('.profile-title')?.textContent || '';
		const company  = card.dataset.company || '';
		const year     = card.dataset.year || '';
		const location = card.dataset.location || '';
		const industry = card.dataset.industry || '';
		const bio      = card.dataset.bio || 'Active participant and alumni community contributor.';
		const avatar   = card.dataset.avatar || '';
		const email    = card.dataset.email || 'mailto:info@lovefamilyalumni.org';
		const linkedin = card.dataset.linkedin || 'https://linkedin.com';

		if (modalName) modalName.textContent = name;
		if (modalTitle) modalTitle.textContent = title;
		if (modalCompany) modalCompany.textContent = company ? company : 'Love Family Alumni Network';
		if (modalBatch) modalBatch.textContent = year ? `Class of ${year}` : 'Alumni Member';
		if (modalLocation) modalLocation.textContent = location || 'North America Zone';
		if (modalIndustry) modalIndustry.textContent = industry || 'General';
		if (modalBio) modalBio.textContent = bio;

		if (avatar && modalAvatarImg) {
			modalAvatarImg.src = avatar;
			modalAvatarImg.alt = name;
			modalAvatarImg.style.display = 'block';
			if (modalAvatarFall) modalAvatarFall.style.display = 'none';
		} else {
			if (modalAvatarImg) modalAvatarImg.style.display = 'none';
			if (modalAvatarFall) {
				modalAvatarFall.style.display = 'flex';
				if (modalInitial) modalInitial.textContent = name.charAt(0).toUpperCase();
			}
		}

		if (modalEmailBtn) {
			modalEmailBtn.href = email;
		}
		if (modalLinkedInBtn) {
			modalLinkedInBtn.href = linkedin;
		}

		modalBackdrop.classList.add('is-open');
		modalBackdrop.setAttribute('aria-hidden', 'false');
		document.body.style.overflow = 'hidden';

		if (modalCloseBtn) {
			modalCloseBtn.focus();
		}
	}

	function closeProfileModal() {
		if (!modalBackdrop) return;
		modalBackdrop.classList.remove('is-open');
		modalBackdrop.setAttribute('aria-hidden', 'true');
		document.body.style.overflow = '';
	}

	// Delegate card click for modal preview
	gridContainer.addEventListener('click', function (e) {
		const trigger = e.target.closest('.preview-action-btn');
		if (trigger) {
			e.preventDefault();
			const card = trigger.closest('.directory-profile-card');
			if (card) {
				openProfileModal(card);
			}
		}
	});

	if (modalCloseBtn) {
		modalCloseBtn.addEventListener('click', closeProfileModal);
	}

	if (modalBackdrop) {
		modalBackdrop.addEventListener('click', function (e) {
			if (e.target === modalBackdrop) {
				closeProfileModal();
			}
		});
	}

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && modalBackdrop && modalBackdrop.classList.contains('is-open')) {
			closeProfileModal();
		}
	});

	// Form & Filter Events
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

	let searchDebounceTimer = null;
	if (searchInput) {
		searchInput.addEventListener('input', function () {
			clearTimeout(searchDebounceTimer);
			searchDebounceTimer = setTimeout(() => {
				applyFilters(true);
			}, 250);
		});
	}

	if (searchBtn) {
		searchBtn.addEventListener('click', function (e) {
			e.preventDefault();
			applyFilters(true);
		});
	}

	if (filterForm) {
		filterForm.addEventListener('submit', function (e) {
			e.preventDefault();
			applyFilters(true);
		});
	}

	[yearSelect, profSelect, locSelect, countrySelect, sortSelect].forEach(sel => {
		if (sel) {
			sel.addEventListener('change', () => applyFilters(true));
		}
	});

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

	// Initial render
	renderPagination();
});
