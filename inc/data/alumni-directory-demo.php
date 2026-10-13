<?php
/**
 * Alumni Directory Demo Data & Filter Options (Phase 02 / Page 04)
 *
 * NOTE: All data herein is strictly static, synthetic demonstration data.
 * No real alumni member identities, contact information, or PII are stored or exposed.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get filter dropdown options for Alumni Directory.
 *
 * @return array
 */
function lfa_get_directory_filter_options(): array {
	return [
		'years' => [
			'' => 'All Years',
			'2024' => 'Class of 2024',
			'2023' => 'Class of 2023',
			'2022' => 'Class of 2022',
			'2021' => 'Class of 2021',
			'2020' => 'Class of 2020',
			'2019' => 'Class of 2019',
			'2018' => 'Class of 2018',
			'2017' => 'Class of 2017',
			'2016' => 'Class of 2016',
			'2015' => 'Class of 2015',
			'2014' => 'Class of 2014',
			'2013' => 'Class of 2013',
			'2012' => 'Class of 2012',
			'2011' => 'Class of 2011',
			'2010' => 'Class of 2010',
			'2008' => 'Class of 2008',
			'2005' => 'Class of 2005',
			'2003' => 'Class of 2003',
			'1998' => 'Class of 1998',
		],
		'professions' => [
			'' => 'All Professions',
			'Business Executive' => 'Business Executive',
			'Healthcare Professional' => 'Healthcare Professional',
			'Information Technology' => 'Information Technology',
			'Educator' => 'Educator',
			'Financial Analyst' => 'Financial Analyst',
			'Legal Professional' => 'Legal Professional',
			'Entrepreneur' => 'Entrepreneur',
			'Community Leader' => 'Community Leader',
			'Engineering' => 'Engineering',
		],
		'locations' => [
			'' => 'All Locations',
			'Houston, TX' => 'Houston, TX',
			'Toronto, ON' => 'Toronto, ON',
			'New York, NY' => 'New York, NY',
			'Chicago, IL' => 'Chicago, IL',
			'Atlanta, GA' => 'Atlanta, GA',
			'Washington, DC' => 'Washington, DC',
			'Dallas, TX' => 'Dallas, TX',
			'Los Angeles, CA' => 'Los Angeles, CA',
		],
		'countries' => [
			'' => 'All Countries',
			'United States' => 'United States',
			'Canada' => 'Canada',
			'United Kingdom' => 'United Kingdom',
			'Nigeria' => 'Nigeria',
			'Other' => 'Other Countries',
		],
		'sort_options' => [
			'recently_added' => 'Recently Added',
			'name_asc' => 'Name: A to Z',
			'name_desc' => 'Name: Z to A',
			'year_desc' => 'Class Year: Newest',
			'year_asc' => 'Class Year: Oldest',
		],
	];
}

/**
 * Get 8 static showcasing alumni profiles matching the design reference.
 *
 * @return array
 */
function lfa_get_demo_alumni_profiles(): array {
	return [
		[
			'id'          => 'alumni-01',
			'name'        => 'David Akpo',
			'batch'       => '2005',
			'title'       => 'Business Executive',
			'location'    => 'Houston, TX',
			'country'     => 'United States',
			'industry'    => 'Energy & Infrastructure',
			'avatar'      => 'alumni-01.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
		[
			'id'          => 'alumni-02',
			'name'        => 'Angela Okoro',
			'batch'       => '2010',
			'title'       => 'Healthcare Professional',
			'location'    => 'Toronto, ON',
			'country'     => 'Canada',
			'industry'    => 'Healthcare & Public Health',
			'avatar'      => 'alumni-02.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
		[
			'id'          => 'alumni-03',
			'name'        => 'Michael Imasuen',
			'batch'       => '2008',
			'title'       => 'Information Technology',
			'location'    => 'New York, NY',
			'country'     => 'United States',
			'industry'    => 'Technology & Innovation',
			'avatar'      => 'alumni-03.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
		[
			'id'          => 'alumni-04',
			'name'        => 'Victoria Omoregie',
			'batch'       => '2012',
			'title'       => 'Educator',
			'location'    => 'Chicago, IL',
			'country'     => 'United States',
			'industry'    => 'Education & Youth Development',
			'avatar'      => 'alumni-04.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
		[
			'id'          => 'alumni-05',
			'name'        => 'Stella Akpo',
			'batch'       => '2015',
			'title'       => 'Financial Analyst',
			'location'    => 'Atlanta, GA',
			'country'     => 'United States',
			'industry'    => 'Finance & Investment',
			'avatar'      => 'alumni-05.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
		[
			'id'          => 'alumni-06',
			'name'        => 'Charles Aigbe',
			'batch'       => '2003',
			'title'       => 'Legal Professional',
			'location'    => 'Washington, DC',
			'country'     => 'United States',
			'industry'    => 'Law & Policy',
			'avatar'      => 'alumni-06.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
		[
			'id'          => 'alumni-07',
			'name'        => 'Linda Igbinovia',
			'batch'       => '2011',
			'title'       => 'Entrepreneur',
			'location'    => 'Dallas, TX',
			'country'     => 'United States',
			'industry'    => 'Business & Entrepreneurship',
			'avatar'      => 'alumni-07.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
		[
			'id'          => 'alumni-08',
			'name'        => 'Matthew Aigbe',
			'batch'       => '1998',
			'title'       => 'Community Leader',
			'location'    => 'Los Angeles, CA',
			'country'     => 'United States',
			'industry'    => 'Nonprofit & Community Impact',
			'avatar'      => 'alumni-08.jpg',
			'email'       => 'mailto:info@lovefamilyalumni.org',
			'linkedin'    => 'https://linkedin.com',
			'profile_url' => '#',
		],
	];
}

