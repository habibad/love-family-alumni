<?php
/**
 * Business Directory — Search and Filters Card
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="lfa-biz-search-section" aria-label="Business Search and Filters">
	<div class="lfa-container">
		<div class="lfa-biz-search-card">
			<form id="lfa-biz-filter-form" class="lfa-biz-search-form" onsubmit="return false;">
				<!-- Top Row: Keyword Search + Buttons -->
				<div class="lfa-biz-search-row lfa-biz-search-row--top">
					<div class="lfa-biz-search-input-wrap">
						<span class="lfa-biz-search-icon" aria-hidden="true">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="11" cy="11" r="8"></circle>
								<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
							</svg>
						</span>
						<input type="text" 
						       id="lfa-biz-search-input" 
						       class="lfa-biz-search-input" 
						       placeholder="Search business name, category, service or location..." 
						       aria-label="Search business name, category, service or location"
						       autocomplete="off">
					</div>
					<div class="lfa-biz-search-actions">
						<button type="button" id="lfa-biz-search-btn" class="lfa-biz-btn lfa-biz-btn--search">
							Search
						</button>
						<button type="button" id="lfa-biz-reset-btn" class="lfa-biz-btn lfa-biz-btn--reset">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<polyline points="23 4 23 10 17 10"></polyline>
								<polyline points="1 20 1 14 7 14"></polyline>
								<path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
							</svg>
							<span>Reset Filters</span>
						</button>
					</div>
				</div>

				<!-- Bottom Row: Filter Dropdowns -->
				<div class="lfa-biz-search-row lfa-biz-search-row--filters">
					<!-- Filter 1: Category -->
					<div class="lfa-biz-filter-group">
						<label for="lfa-biz-filter-category" class="lfa-biz-filter-label">Business Category</label>
						<div class="lfa-biz-select-wrap">
							<select id="lfa-biz-filter-category" class="lfa-biz-select">
								<option value="">All Categories</option>
								<option value="Technology & IT">Technology & IT</option>
								<option value="Healthcare & Wellness">Healthcare & Wellness</option>
								<option value="Education & Training">Education & Training</option>
								<option value="Real Estate & Construction">Real Estate & Construction</option>
								<option value="Finance & Investment">Finance & Investment</option>
								<option value="Consulting & Professional">Consulting & Professional</option>
								<option value="Retail & E-commerce">Retail & E-commerce</option>
								<option value="Travel & Hospitality">Travel & Hospitality</option>
							</select>
							<span class="lfa-biz-select-arrow" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
							</span>
						</div>
					</div>

					<!-- Filter 2: Country -->
					<div class="lfa-biz-filter-group">
						<label for="lfa-biz-filter-country" class="lfa-biz-filter-label">Country</label>
						<div class="lfa-biz-select-wrap">
							<select id="lfa-biz-filter-country" class="lfa-biz-select">
								<option value="">All Countries</option>
								<option value="United States">United States</option>
								<option value="Canada">Canada</option>
							</select>
							<span class="lfa-biz-select-arrow" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
							</span>
						</div>
					</div>

					<!-- Filter 3: City / State -->
					<div class="lfa-biz-filter-group">
						<label for="lfa-biz-filter-city" class="lfa-biz-filter-label">City / State</label>
						<div class="lfa-biz-select-wrap">
							<select id="lfa-biz-filter-city" class="lfa-biz-select">
								<option value="">All Locations</option>
								<option value="Atlanta">Atlanta</option>
								<option value="Chicago">Chicago</option>
								<option value="Dallas">Dallas</option>
								<option value="Houston">Houston</option>
								<option value="Los Angeles">Los Angeles</option>
								<option value="Miami">Miami</option>
								<option value="New York">New York</option>
								<option value="Toronto">Toronto</option>
								<option value="Vancouver">Vancouver</option>
							</select>
							<span class="lfa-biz-select-arrow" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
							</span>
						</div>
					</div>

					<!-- Filter 4: Sort By -->
					<div class="lfa-biz-filter-group">
						<label for="lfa-biz-filter-sort" class="lfa-biz-filter-label">Sort By</label>
						<div class="lfa-biz-select-wrap">
							<select id="lfa-biz-filter-sort" class="lfa-biz-select">
								<option value="recent">Recently Added</option>
								<option value="az">Name: A to Z</option>
								<option value="za">Name: Z to A</option>
							</select>
							<span class="lfa-biz-select-arrow" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
							</span>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
