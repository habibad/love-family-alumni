<?php
/**
 * Alumni Directory — Section 02: Search & Filter Shell
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$filter_options = lfa_get_directory_filter_options();
$viewer_id = get_current_user_id();
$access_state = class_exists( 'LFA_Payment_Entitlements' ) 
	? LFA_Payment_Entitlements::get_directory_access_state( $viewer_id ) 
	: [ 'can_access' => false ];
$is_locked = ! $access_state['can_access'];
?>

<section class="directory-filters-section" id="directory-search-filters" aria-label="Search and Filter Directory">
	<div class="lfa-container">
		<div class="directory-filter-card">
			<form id="alumni-directory-filter-form" class="directory-filter-form <?php echo $is_locked ? 'lfa-filters-disabled' : ''; ?>" role="search" onsubmit="return false;" <?php echo $is_locked ? 'aria-disabled="true"' : ''; ?>>
				
				<!-- Row 1: Primary Search Input & Action Buttons -->
				<div class="filter-primary-row">
					<div class="search-input-group">
						<span class="search-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="11" cy="11" r="8"></circle>
								<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
							</svg>
						</span>
						<label for="directory-search-input" class="screen-reader-text">Search by name, class year, profession, city or company</label>
						<input type="search" 
						       id="directory-search-input" 
						       name="keyword" 
						       class="form-control directory-search-control" 
						       placeholder="<?php echo $is_locked ? 'Search unlocked for active, paid alumni members...' : 'Search by name, class year, profession, city or company...'; ?>" 
						       autocomplete="off"
						       <?php echo $is_locked ? 'disabled title="Search unlocked for active paid members"' : ''; ?>>
					</div>

					<div class="filter-actions-group">
						<button type="submit" id="directory-search-btn" class="btn btn-crimson directory-search-btn" <?php echo $is_locked ? 'disabled' : ''; ?>>
							Search
						</button>
						<button type="button" id="directory-reset-btn" class="btn btn-outline-neutral directory-reset-btn" <?php echo $is_locked ? 'disabled' : ''; ?>>
							<svg class="reset-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
							</svg>
							<span>Reset Filters</span>
						</button>
					</div>
				</div>

				<!-- Row 2: Secondary Dropdown Filters -->
				<div class="filter-dropdowns-grid">
					
					<!-- 1. Class Year -->
					<div class="filter-field-group">
						<label for="filter-class-year" class="filter-field-label">Class Year</label>
						<div class="select-wrapper">
							<select id="filter-class-year" name="year" class="form-select directory-select" <?php echo $is_locked ? 'disabled' : ''; ?>>
								<?php foreach ( $filter_options['years'] as $val => $label ) : ?>
									<option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
								<?php endforeach; ?>
							</select>
							<span class="select-chevron" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</div>
					</div>

					<!-- 2. Profession -->
					<div class="filter-field-group">
						<label for="filter-profession" class="filter-field-label">Profession</label>
						<div class="select-wrapper">
							<select id="filter-profession" name="profession" class="form-select directory-select" <?php echo $is_locked ? 'disabled' : ''; ?>>
								<?php foreach ( $filter_options['professions'] as $val => $label ) : ?>
									<option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
								<?php endforeach; ?>
							</select>
							<span class="select-chevron" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</div>
					</div>

					<!-- 3. City / State -->
					<div class="filter-field-group">
						<label for="filter-location" class="filter-field-label">City / State</label>
						<div class="select-wrapper">
							<select id="filter-location" name="location" class="form-select directory-select" <?php echo $is_locked ? 'disabled' : ''; ?>>
								<?php foreach ( $filter_options['locations'] as $val => $label ) : ?>
									<option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
								<?php endforeach; ?>
							</select>
							<span class="select-chevron" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</div>
					</div>

					<!-- 4. Country -->
					<div class="filter-field-group">
						<label for="filter-country" class="filter-field-label">Country</label>
						<div class="select-wrapper">
							<select id="filter-country" name="country" class="form-select directory-select" <?php echo $is_locked ? 'disabled' : ''; ?>>
								<?php foreach ( $filter_options['countries'] as $val => $label ) : ?>
									<option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
								<?php endforeach; ?>
							</select>
							<span class="select-chevron" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</div>
					</div>

					<!-- 5. Sort By -->
					<div class="filter-field-group">
						<label for="filter-sort" class="filter-field-label">Sort By</label>
						<div class="select-wrapper">
							<select id="filter-sort" name="sort" class="form-select directory-select" <?php echo $is_locked ? 'disabled' : ''; ?>>
								<?php foreach ( $filter_options['sort_options'] as $val => $label ) : ?>
									<option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
								<?php endforeach; ?>
							</select>
							<span class="select-chevron" aria-hidden="true">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</span>
						</div>
					</div>

				</div>

				<!-- Privacy Disclaimer Strip -->
				<div class="directory-filter-footnote">
					<span class="footnote-badge" style="background:#0F2942;color:#E5C170;">DIRECTORY NOTICE</span>
					<span class="footnote-text">Verified alumni profiles only &mdash; personal contact information is protected according to individual member privacy settings.</span>
				</div>

			</form>
		</div>
	</div>
</section>
