<?php
/**
 * Static Membership Page Data (Phase 02 Frontend)
 *
 * Centralized data source for benefits, plans, workflow, portal preview, and FAQs.
 * Prepared for clean transition to WordPress CPTs / custom options in the backend phase.
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get membership benefits list
 *
 * @return array<int, array<string, string>>
 */
function lfa_get_membership_benefits(): array {
	return [
		[
			'id'    => 'connections',
			'title' => 'Lifelong Connections',
			'desc'  => 'Build lasting relationships with fellow alumni across North America and globally.',
			'icon'  => 'users',
			'color' => 'crimson',
		],
		[
			'id'    => 'networking',
			'title' => 'Professional Networking',
			'desc'  => 'Access career opportunities, mentorship and business collaborations.',
			'icon'  => 'chart',
			'color' => 'navy',
		],
		[
			'id'    => 'events',
			'title' => 'Community Events',
			'desc'  => 'Participate in reunions, conferences and local gatherings.',
			'icon'  => 'calendar',
			'color' => 'crimson',
		],
		[
			'id'    => 'service',
			'title' => 'Service & Impact',
			'desc'  => 'Be part of meaningful initiatives that strengthen communities.',
			'icon'  => 'heart',
			'color' => 'navy',
		],
		[
			'id'    => 'directory',
			'title' => 'Alumni Directory Access',
			'desc'  => 'Connect with alumni through our exclusive directory.',
			'icon'  => 'book',
			'color' => 'crimson',
		],
		[
			'id'    => 'fellowship',
			'title' => 'Fellowship & Support',
			'desc'  => 'Find encouragement, support and a true sense of family.',
			'icon'  => 'fellowship',
			'color' => 'navy',
		],
	];
}

/**
 * Get membership plans
 *
 * @return array<int, array<string, mixed>>
 */
function lfa_get_membership_plans(): array {
	$price = '$100.00 USD';

	if ( class_exists( 'LFA_Membership' ) ) {
		$policy = LFA_Membership::get_policy();
		if ( ! empty( $policy['individual_base_cents'] ) ) {
			$price = '$' . number_format( (float) $policy['individual_base_cents'] / 100, 2 ) . ' USD';
		}
	}

	return [
		[
			'id'          => 'membership',
			'name'        => 'Annual Membership',
			'badge'       => 'Official Membership',
			'target'      => 'For verified Love Family / UNIBEN alumni residing across North America.',
			'price'       => $price,
			'cycle'       => 'Annual Contribution / One Year Validity ($100/yr)',
			'features'    => [
				'Full access to the verified North America Zone Alumni Directory',
				'Exclusive access to the North America Business Directory',
				'Eligibility for North America Zonal Conference registration',
				'Direct inclusion in diaspora welfare, benevolence, and prayer chains',
				'Voting participation in Zonal assembly meetings and committee elections',
				'Personalized digital Alumni Credential & verification badge',
			],
			'cta_text'    => is_user_logged_in() ? 'View Membership Standing' : 'Join as Member',
			'is_featured' => true,
		],
	];
}

/**
 * Get how membership works steps
 *
 * @return array<int, array<string, string>>
 */
function lfa_get_membership_steps(): array {
	return [
		[
			'step'  => '01',
			'title' => 'Complete Registration',
			'desc'  => 'Submit your verified personal profile, graduation class, and current North American residential region.',
			'icon'  => 'id-card',
		],
		[
			'step'  => '02',
			'title' => 'Verify Email',
			'desc'  => 'Authenticate your email address via a secure one-time verification link sent directly to your inbox.',
			'icon'  => 'mail',
		],
		[
			'step'  => '03',
			'title' => 'Membership Review',
			'desc'  => 'The Zonal Secretariat cross-references alumni records to confirm authentic alma mater fellowship standing.',
			'icon'  => 'user',
		],
		[
			'step'  => '04',
			'title' => 'Activate & Manage',
			'desc'  => 'Unlock full member portal access, connect with local regional chapters, and download your digital alumni credential.',
			'icon'  => 'graduation-cap',
		],
	];
}

/**
 * Get portal preview features
 *
 * @return array<int, array<string, string>>
 */
function lfa_get_portal_preview_features(): array {
	return [
		[
			'id'    => 'profile',
			'title' => 'My Profile',
			'desc'  => 'Manage contact details, family milestones, and privacy preferences.',
			'icon'  => 'user',
		],
		[
			'id'    => 'alumni-id',
			'title' => 'Alumni ID',
			'desc'  => 'Digital verified credential with QR verification for zonal gatherings.',
			'icon'  => 'id-card',
		],
		[
			'id'    => 'status',
			'title' => 'Membership Status',
			'desc'  => 'Real-time accreditation status, active chapter, and term validity.',
			'icon'  => 'bell',
		],
		[
			'id'    => 'pay-dues',
			'title' => 'Pay Dues',
			'desc'  => 'Streamlined gateway for annual individual or couple dues contributions.',
			'icon'  => 'credit-card',
		],
		[
			'id'    => 'history',
			'title' => 'Payment History',
			'desc'  => 'Instant digital receipts, statement downloads, and contribution ledgers.',
			'icon'  => 'calendar',
		],
		[
			'id'    => 'conference',
			'title' => 'Conference Registration',
			'desc'  => 'Early-bird access, banquet passes, and hotel group reservations.',
			'icon'  => 'connect',
		],
		[
			'id'    => 'businesses',
			'title' => 'My Businesses',
			'desc'  => 'Showcase alumni-owned ventures in the continental business registry.',
			'icon'  => 'briefcase',
		],
		[
			'id'    => 'donations',
			'title' => 'Donations & Giving',
			'desc'  => 'Direct support for scholarship funds and emergency member welfare.',
			'icon'  => 'heart-hand',
		],
	];
}

/**
 * Get membership FAQ list
 *
 * @return array<int, array<string, string>>
 */
function lfa_get_membership_faqs(): array {
	return [
		[
			'q' => 'How do I become a member?',
			'a' => 'You begin by completing the initial registration form with your graduation background and current North American residence. The Zonal Secretariat verifies alumni records before accreditation is completed.',
		],
		[
			'q' => 'What is the membership dues structure and validity?',
			'a' => 'Love Family Alumni offers a single, unified annual membership at $100.00 USD per year. Full membership access is valid for exactly one calendar year starting from the moment your annual dues payment is verified, and automatically expires after one year until renewed.',
		],
		[
			'q' => 'How can I pay membership dues?',
			'a' => 'During this initial frontend rollout, official payment gateway integration (via PayPal or Pushpay) is being finalized. Specific contribution amounts and secure online payment options will be officially announced by the Zonal Executive Council.',
		],
		[
			'q' => 'Can existing alumni update their records?',
			'a' => 'Yes. Once the member portal launches, registered alumni can sign in to update their contact details, current chapter location, vocational achievements, and directory privacy preferences.',
		],
		[
			'q' => 'How do I access the Alumni Directory?',
			'a' => 'The verified Alumni Directory will be accessible exclusively to authenticated, active members through the member portal to protect member privacy and support authentic professional networking.',
		],
		[
			'q' => 'How are my profile details protected?',
			'a' => 'We take member confidentiality seriously. Personal contact records are secured behind encrypted authentication and will never be sold, commercialized, or shared with third-party marketers.',
		],
		[
			'q' => 'What happens when membership dues become due again?',
			'a' => 'Membership dues follow an annual calendar term. Members will receive advance digital notifications via email and their portal dashboard before the renewal period begins.',
		],
	];
}
