/**
 * News & Announcements — Frontend Interaction Script (Task 02)
 *
 * Handles live client-side search, category filtering, chronological sorting,
 * dynamic pagination (6 items/page), and friendly empty states.
 *
 * Scope: Encapsulated strictly under .lfa-news
 *
 * @package Love_Family_Theme
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		// 1. Smooth scroll for anchor navigation (Task 01)
		var anchorLinks = document.querySelectorAll('.lfa-news a[href^="#"]');
		anchorLinks.forEach(function (link) {
			link.addEventListener('click', function (e) {
				var targetId = this.getAttribute('href');
				if (targetId && targetId.length > 1) {
					var targetEl = document.querySelector(targetId);
					if (targetEl) {
						e.preventDefault();
						targetEl.scrollIntoView({
							behavior: 'smooth',
							block: 'start'
						});
					}
				}
			});
		});

		// 2. Filter & Grid Elements (Task 02)
		var searchInput      = document.getElementById('lfa-news-search-input');
		var categorySelect   = document.getElementById('lfa-news-category-select');
		var sortSelect       = document.getElementById('lfa-news-sort-select');
		var searchBtn        = document.getElementById('lfa-news-search-btn');
		var resetBtn         = document.getElementById('lfa-news-reset-btn');
		var emptyResetBtn    = document.getElementById('lfa-news-empty-reset-btn');
		var gridContainer    = document.getElementById('lfa-news-cards-grid');
		var emptyState       = document.getElementById('lfa-news-empty-state');
		var paginationWrap   = document.getElementById('lfa-news-pagination-wrap');
		var prevPageBtn      = document.getElementById('lfa-news-page-prev');
		var nextPageBtn      = document.getElementById('lfa-news-page-next');
		var pageNumbersWrap  = document.getElementById('lfa-news-page-numbers');
		var currentCountEl   = document.getElementById('lfa-news-current-count');
		var totalCountEl     = document.getElementById('lfa-news-total-count');
		var activeTagsWrap   = document.getElementById('lfa-news-active-tags');

		if (!gridContainer) {
			return;
		}

		// Cache all news cards originally rendered by PHP
		var allCards = Array.from(gridContainer.querySelectorAll('.lfa-news-card'));
		var itemsPerPage = 6;
		var currentPage  = 1;
		var filteredCards = [].concat(allCards);

		/**
		 * Apply current filter & sorting criteria
		 */
		function applyFilters() {
			var query = searchInput ? searchInput.value.trim().toLowerCase() : '';
			var category = categorySelect ? categorySelect.value.trim() : '';
			var sortBy = sortSelect ? sortSelect.value : 'newest';

			// Filter cards
			filteredCards = allCards.filter(function (card) {
				var cardTitle    = card.getAttribute('data-title') || '';
				var cardExcerpt  = card.getAttribute('data-excerpt') || '';
				var cardKeywords = card.getAttribute('data-keywords') || '';
				var cardCategory = card.getAttribute('data-category') || '';

				// Keyword search
				var matchesQuery = true;
				if (query.length > 0) {
					matchesQuery = cardTitle.indexOf(query) !== -1 ||
					               cardExcerpt.indexOf(query) !== -1 ||
					               cardKeywords.indexOf(query) !== -1;
				}

				// Category filter
				var matchesCategory = true;
				if (category.length > 0) {
					matchesCategory = (cardCategory.toLowerCase() === category.toLowerCase());
				}

				return matchesQuery && matchesCategory;
			});

			// Sort matching cards
			filteredCards.sort(function (a, b) {
				var dateA = a.getAttribute('data-date') || '';
				var dateB = b.getAttribute('data-date') || '';

				if (sortBy === 'oldest') {
					return dateA.localeCompare(dateB);
				}
				// Default: newest first
				return dateB.localeCompare(dateA);
			});

			// Update DOM ordering based on sort
			filteredCards.forEach(function (card) {
				gridContainer.appendChild(card);
			});

			// Reset to first page whenever filter changes
			currentPage = 1;
			updateActiveFilterTags(query, category);
			renderPage();
		}

		/**
		 * Render the active page slice and update pagination UI
		 */
		function renderPage() {
			var total = filteredCards.length;
			var totalPages = Math.max(1, Math.ceil(total / itemsPerPage));

			if (currentPage > totalPages) {
				currentPage = 1;
			}

			// Handle zero results state
			if (total === 0) {
				allCards.forEach(function (card) {
					card.style.display = 'none';
				});
				if (emptyState) {
					emptyState.style.display = 'block';
				}
				if (paginationWrap) {
					paginationWrap.style.display = 'none';
				}
				if (currentCountEl) {
					currentCountEl.textContent = '0';
				}
				if (totalCountEl) {
					totalCountEl.textContent = '0';
				}
				return;
			}

			// Results exist: hide empty state
			if (emptyState) {
				emptyState.style.display = 'none';
			}

			// Determine current page bounds
			var startIndex = (currentPage - 1) * itemsPerPage;
			var endIndex   = startIndex + itemsPerPage;

			// Hide all cards first
			allCards.forEach(function (card) {
				card.style.display = 'none';
			});

			// Show only the slice for current page
			var pageSlice = filteredCards.slice(startIndex, endIndex);
			pageSlice.forEach(function (card) {
				card.style.display = '';
			});

			// Update count feedback
			var displayEnd = Math.min(endIndex, total);
			if (currentCountEl) {
				currentCountEl.textContent = (startIndex + 1) + '–' + displayEnd;
			}
			if (totalCountEl) {
				totalCountEl.textContent = total.toString();
			}

			// Manage pagination visibility
			if (paginationWrap) {
				paginationWrap.style.display = totalPages > 1 ? 'flex' : 'none';
			}

			// Build dynamic page numbers
			if (pageNumbersWrap) {
				pageNumbersWrap.innerHTML = '';
				for (var p = 1; p <= totalPages; p++) {
					var numBtn = document.createElement('button');
					numBtn.type = 'button';
					numBtn.className = 'lfa-news-page-num' + (p === currentPage ? ' is-active' : '');
					numBtn.setAttribute('data-page', p);
					numBtn.textContent = p;
					if (p === currentPage) {
						numBtn.setAttribute('aria-current', 'page');
					}
					numBtn.addEventListener('click', function () {
						var targetPage = parseInt(this.getAttribute('data-page'), 10);
						if (targetPage !== currentPage) {
							currentPage = targetPage;
							renderPage();
							scrollToGrid();
						}
					});
					pageNumbersWrap.appendChild(numBtn);
				}
			}

			// Previous / Next button states
			if (prevPageBtn) {
				prevPageBtn.disabled = (currentPage === 1);
			}
			if (nextPageBtn) {
				nextPageBtn.disabled = (currentPage === totalPages);
			}
		}

		/**
		 * Display active filter tags in status row
		 */
		function updateActiveFilterTags(query, category) {
			if (!activeTagsWrap) return;
			activeTagsWrap.innerHTML = '';

			var hasActive = false;

			if (query.length > 0) {
				hasActive = true;
				var queryTag = document.createElement('span');
				queryTag.className = 'lfa-news-active-pill';
				queryTag.innerHTML = 'Keyword: "' + query + '" <button type="button" aria-label="Remove keyword filter">&times;</button>';
				queryTag.querySelector('button').addEventListener('click', function () {
					if (searchInput) searchInput.value = '';
					applyFilters();
				});
				activeTagsWrap.appendChild(queryTag);
			}

			if (category.length > 0) {
				hasActive = true;
				var catTag = document.createElement('span');
				catTag.className = 'lfa-news-active-pill';
				catTag.innerHTML = 'Category: ' + category + ' <button type="button" aria-label="Remove category filter">&times;</button>';
				catTag.querySelector('button').addEventListener('click', function () {
					if (categorySelect) categorySelect.value = '';
					applyFilters();
				});
				activeTagsWrap.appendChild(catTag);
			}

			activeTagsWrap.style.display = hasActive ? 'flex' : 'none';
		}

		/**
		 * Smooth scroll to top of grid when page changes
		 */
		function scrollToGrid() {
			var gridEl = document.getElementById('news-grid-section');
			if (gridEl) {
				var rect = gridEl.getBoundingClientRect();
				if (rect.top < 0) {
					gridEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
				}
			}
		}

		/**
		 * Reset all search & filter values
		 */
		function resetAllFilters() {
			if (searchInput) searchInput.value = '';
			if (categorySelect) categorySelect.value = '';
			if (sortSelect) sortSelect.value = 'newest';
			applyFilters();
			if (searchInput) {
				searchInput.focus();
			}
		}

		// Event Bindings
		if (searchInput) {
			// Instant live search as user types
			searchInput.addEventListener('input', function () {
				applyFilters();
			});
			searchInput.addEventListener('keydown', function (e) {
				if (e.key === 'Enter') {
					e.preventDefault();
					applyFilters();
				}
			});
		}

		if (categorySelect) {
			categorySelect.addEventListener('change', function () {
				applyFilters();
			});
		}

		if (sortSelect) {
			sortSelect.addEventListener('change', function () {
				applyFilters();
			});
		}

		if (searchBtn) {
			searchBtn.addEventListener('click', function () {
				applyFilters();
			});
		}

		if (resetBtn) {
			resetBtn.addEventListener('click', function () {
				resetAllFilters();
			});
		}

		if (emptyResetBtn) {
			emptyResetBtn.addEventListener('click', function () {
				resetAllFilters();
			});
		}

		if (prevPageBtn) {
			prevPageBtn.addEventListener('click', function () {
				if (currentPage > 1) {
					currentPage--;
					renderPage();
					scrollToGrid();
				}
			});
		}

		if (nextPageBtn) {
			nextPageBtn.addEventListener('click', function () {
				var totalPages = Math.ceil(filteredCards.length / itemsPerPage);
				if (currentPage < totalPages) {
					currentPage++;
					renderPage();
					scrollToGrid();
				}
			});
		}

		// Initial render
		applyFilters();

		if (window.console && console.log) {
			console.log('LFA Newsroom Task 02 initialized: 12 demo items loaded across 2 pages.');
		}
	});
})();
