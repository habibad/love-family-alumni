<?php
/**
 * Static Leadership Data Fixtures (Phase 02 Frontend)
 *
 * Provides centralized data for Executive Team, Board of Trustees, and Advisory Council.
 * Designed for straightforward migration to WordPress Custom Post Types / ACF in backend phase.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve leadership roster members by group
 *
 * @param string $group 'executive' | 'board' | 'advisory'
 * @return array<int, array<string, mixed>>
 */
function lfa_get_leadership_roster( string $group ): array {
	switch ( $group ) {
		case 'executive':
			return [
				[
					'id'           => 'exec-vp',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Vice President',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'VP',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Vice%20President',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'exec-sec',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Secretary General',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'SG',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Secretary%20General',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'exec-tres',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Treasurer',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'TR',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Treasurer',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'exec-fin',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Financial Secretary',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'FS',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Financial%20Secretary',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'exec-pro',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Public Relations Officer',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'PRO',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Public%20Relations%20Officer',
					'linkedin'     => 'https://www.linkedin.com',
				],
			];

		case 'board':
			return [
				[
					'id'           => 'board-01',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Board Member (Governance)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'BM',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Board%20Member',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'board-02',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Board Member (Legal Affairs)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'BM',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Board%20Member',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'board-03',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Board Member (Diaspora Relations)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'BM',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Board%20Member',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'board-04',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Board Member (Strategic Planning)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'BM',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Board%20Member',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'board-05',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Board Member (Audit & Finance)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'BM',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Board%20Member',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'board-06',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Board Member (Alumni Welfare)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'BM',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Board%20Member',
					'linkedin'     => 'https://www.linkedin.com',
				],
			];

		case 'advisory':
			return [
				[
					'id'           => 'adv-01',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Senior Advisor (Strategy)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'SA',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Senior%20Advisor',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'adv-02',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Senior Advisor (Stewardship)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'SA',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Senior%20Advisor',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'adv-03',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Senior Advisor (Heritage)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'SA',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Senior%20Advisor',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'adv-04',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Senior Advisor (Mentorship)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'SA',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Senior%20Advisor',
					'linkedin'     => 'https://www.linkedin.com',
				],
				[
					'id'           => 'adv-05',
					'name'         => 'Profile Pending Confirmation',
					'position'     => 'Senior Advisor (Philanthropy)',
					'status'       => 'pending',
					'status_label' => 'Record Pending',
					'initials'     => 'SA',
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=Inquiry:%20Senior%20Advisor',
					'linkedin'     => 'https://www.linkedin.com',
				],
			];

		default:
			return [];
	}
}
