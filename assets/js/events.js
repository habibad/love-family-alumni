/**
 * Love Family Alumni - Events Page JavaScript
 * Handles client-side filtering, searching, sorting, and calendar navigation
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initEventsFilter();
		initEventsCalendar();
	});

	/**
	 * Events Filtering, Searching & Sorting Engine
	 */
	function initEventsFilter() {
		const filterForm = document.getElementById('events-filter-form');
		const searchInput = document.getElementById('events-search-input');
		const periodSelect = document.getElementById('events-period-select');
		const sortSelect = document.getElementById('events-sort-select');
		const resetBtn = document.getElementById('events-reset-btn');
		const chipBtns = document.querySelectorAll('.category-chip-btn');
		const cardsGrid = document.getElementById('events-cards-grid');
		const emptyState = document.getElementById('events-empty-state');
		const countDisplay = document.querySelector('.events-current-count');
		const resetTriggers = document.querySelectorAll('.events-reset-trigger');

		if (!cardsGrid) {
			return;
		}

		const eventCards = Array.from(cardsGrid.querySelectorAll('.event-card'));
		let activeCategory = 'all';

		// Handle category chip selection
		chipBtns.forEach(function (btn) {
			btn.addEventListener('click', function () {
				chipBtns.forEach(function (b) {
					b.classList.remove('active');
					b.setAttribute('aria-selected', 'false');
				});
				btn.classList.add('active');
				btn.setAttribute('aria-selected', 'true');
				activeCategory = btn.getAttribute('data-category') || 'all';
				applyFilters();
			});
		});

		// Handle search input
		if (searchInput) {
			searchInput.addEventListener('input', debounce(function () {
				applyFilters();
			}, 200));
		}

		// Handle period change
		if (periodSelect) {
			periodSelect.addEventListener('change', function () {
				applyFilters();
			});
		}

		// Handle sort change
		if (sortSelect) {
			sortSelect.addEventListener('change', function () {
				applyFilters();
			});
		}

		// Handle reset button
		function resetAllFilters() {
			if (searchInput) searchInput.value = '';
			if (periodSelect) periodSelect.value = 'all';
			if (sortSelect) sortSelect.value = 'default';

			chipBtns.forEach(function (b) {
				const isAll = (b.getAttribute('data-category') === 'all');
				b.classList.toggle('active', isAll);
				b.setAttribute('aria-selected', isAll ? 'true' : 'false');
			});
			activeCategory = 'all';
			applyFilters();
		}

		if (resetBtn) {
			resetBtn.addEventListener('click', resetAllFilters);
		}

		resetTriggers.forEach(function (trigger) {
			trigger.addEventListener('click', resetAllFilters);
		});

		// Filter and sort evaluation
		function applyFilters() {
			const query = (searchInput ? searchInput.value.trim().toLowerCase() : '');
			const selectedPeriod = (periodSelect ? periodSelect.value : 'all');
			const selectedSort = (sortSelect ? sortSelect.value : 'default');

			let visibleCount = 0;
			const matchingCards = [];

			eventCards.forEach(function (card) {
				const cardCategory = card.getAttribute('data-category') || '';
				const cardPeriod = card.getAttribute('data-period') || '';
				const cardText = card.textContent.toLowerCase();

				const matchesCategory = (activeCategory === 'all' || cardCategory === activeCategory);
				const matchesPeriod = (selectedPeriod === 'all' || cardPeriod === selectedPeriod);
				const matchesQuery = (!query || cardText.indexOf(query) !== -1);

				if (matchesCategory && matchesPeriod && matchesQuery) {
					card.style.display = '';
					visibleCount++;
					matchingCards.push(card);
				} else {
					card.style.display = 'none';
				}
			});

			// Apply sorting if needed
			if (selectedSort !== 'default' && matchingCards.length > 1) {
				matchingCards.sort(function (a, b) {
					const titleA = (a.getAttribute('data-title') || '').toLowerCase();
					const titleB = (b.getAttribute('data-title') || '').toLowerCase();

					if (selectedSort === 'title_asc') {
						return titleA.localeCompare(titleB);
					} else if (selectedSort === 'title_desc') {
						return titleB.localeCompare(titleA);
					}
					return 0;
				});

				matchingCards.forEach(function (card) {
					cardsGrid.appendChild(card);
				});
			}

			// Update counter
			if (countDisplay) {
				countDisplay.textContent = visibleCount;
			}

			// Empty state toggle
			if (emptyState) {
				if (visibleCount === 0) {
					emptyState.style.display = 'block';
					cardsGrid.style.display = 'none';
				} else {
					emptyState.style.display = 'none';
					cardsGrid.style.display = 'grid';
				}
			}
		}

		// Initial run to respect any default state
		applyFilters();
	}

	/**
	 * Interactive Events Calendar Component
	 */
	function initEventsCalendar() {
		const prevBtn = document.getElementById('cal-prev-btn');
		const nextBtn = document.getElementById('cal-next-btn');
		const monthTitle = document.getElementById('cal-month-title');
		const daysGrid = document.getElementById('cal-days-grid');

		if (!daysGrid || !monthTitle) {
			return;
		}

		// Month Names
		const monthNames = [
			'January', 'February', 'March', 'April', 'May', 'June',
			'July', 'August', 'September', 'October', 'November', 'December'
		];

		// Start at current date
		const now = new Date();
		let currentYear = now.getFullYear();
		let currentMonth = now.getMonth();

		// Official validated event dates map: 'YYYY-MM-DD' => 'Event Title'
		// Note: Rule states no fake calendar dots! Only validated official dates are mapped.
		const verifiedEventDates = {};

		function renderCalendar(year, month) {
			// Update header
			monthTitle.innerHTML = '<span class="cal-month-name">' + monthNames[month] + '</span> <span class="cal-year-num">' + year + '</span>';

			// First day of month and total days
			const firstDayIndex = new Date(year, month, 1).getDay();
			const totalDays = new Date(year, month + 1, 0).getDate();

			daysGrid.innerHTML = '';

			// Empty cells before start of month
			for (let i = 0; i < firstDayIndex; i++) {
				const emptyCell = document.createElement('div');
				emptyCell.className = 'cal-day-cell empty';
				daysGrid.appendChild(emptyCell);
			}

			// Day cells
			for (let d = 1; d <= totalDays; d++) {
				const dayCell = document.createElement('div');
				dayCell.className = 'cal-day-cell';
				dayCell.textContent = d;

				const dateKey = year + '-' + String(month + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');

				// Check if today
				if (
					year === now.getFullYear() &&
					month === now.getMonth() &&
					d === now.getDate()
				) {
					dayCell.classList.add('today');
					dayCell.setAttribute('title', 'Today');
				}

				// Check if verified event date
				if (verifiedEventDates[dateKey]) {
					dayCell.classList.add('has-event');
					dayCell.setAttribute('title', verifiedEventDates[dateKey]);
				}

				daysGrid.appendChild(dayCell);
			}
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				currentMonth--;
				if (currentMonth < 0) {
					currentMonth = 11;
					currentYear--;
				}
				renderCalendar(currentYear, currentMonth);
			});
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				currentMonth++;
				if (currentMonth > 11) {
					currentMonth = 0;
					currentYear++;
				}
				renderCalendar(currentYear, currentMonth);
			});
		}

		// Initial render
		renderCalendar(currentYear, currentMonth);
	}

	/**
	 * Debounce utility
	 */
	function debounce(func, wait) {
		let timeout;
		return function () {
			const context = this;
			const args = arguments;
			clearTimeout(timeout);
			timeout = setTimeout(function () {
				func.apply(context, args);
			}, wait);
		};
	}
})();
