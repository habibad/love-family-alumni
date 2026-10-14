/**
 * News & Announcements — Task 03 JavaScript Enhancements
 *
 * Handles URL parameter category hydration (e.g. /news/?category=Announcements)
 * connecting Community Updates cards to Task 02 filters.
 *
 * @package Love_Family_Theme
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		// Category URL parameter hydration for /news/?category=...
		var categoryParam = new URLSearchParams(window.location.search).get('category');
		if (categoryParam) {
			var categorySelect = document.getElementById('lfa-news-category-select');
			if (categorySelect) {
				var targetVal = decodeURIComponent(categoryParam).trim().toLowerCase();
				for (var i = 0; i < categorySelect.options.length; i++) {
					var opt = categorySelect.options[i];
					if (opt.value && opt.value.toLowerCase() === targetVal) {
						categorySelect.value = opt.value;
						categorySelect.dispatchEvent(new Event('change', { bubbles: true }));
						break;
					}
				}
			}
		}

		if (window.console && console.log) {
			console.log('LFA Newsroom Task 03 initialized (Single Article, Community Updates & News CTA).');
		}
	});
})();
