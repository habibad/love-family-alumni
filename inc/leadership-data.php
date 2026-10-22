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
	if ( class_exists( 'LFA_Leadership' ) ) {
		$filter = [];
		if ( 'executive' === $group ) {
			$filter['committee'] = 'Executive Council';
		} elseif ( 'board' === $group ) {
			$filter['committee'] = 'Board of Trustees';
		} elseif ( 'advisory' === $group ) {
			$filter['committee'] = 'Advisory Council';
		}
		$db_officers = LFA_Leadership::get_officers( $filter );
		if ( ! empty( $db_officers ) ) {
			$roster = [];
			foreach ( $db_officers as $officer ) {
				$name_parts = explode( ' ', trim( (string) $officer['name'] ) );
				$initials = '';
				foreach ( $name_parts as $part ) {
					if ( ! empty( $part ) && ctype_alpha( $part[0] ) ) {
						$initials .= strtoupper( $part[0] );
					}
				}
				$initials = substr( $initials, 0, 2 ) ?: 'LF';

				$term_label = (int) $officer['term_start_year'];
				if ( ! empty( $officer['term_end_year'] ) ) {
					$term_label .= '–' . (int) $officer['term_end_year'];
				} elseif ( ! empty( $officer['is_current'] ) ) {
					$term_label .= '–Present';
				}

				$roster[] = [
					'id'           => 'officer-' . $officer['id'],
					'name'         => $officer['name'],
					'position'     => $officer['title'],
					'status'       => ! empty( $officer['is_current'] ) ? 'active' : 'historical',
					'status_label' => $term_label,
					'initials'     => $initials,
					'email'        => 'mailto:lovefamilyalumni.na@gmail.com?subject=' . rawurlencode( 'Inquiry: ' . $officer['title'] ),
					'linkedin'     => 'https://www.linkedin.com',
					'photo'        => ! empty( $officer['photo_url'] ) ? $officer['photo_url'] : null,
				];
			}
			return $roster;
		}
	}

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
