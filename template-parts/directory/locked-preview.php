<?php
/**
 * Love Family Alumni — Premium Directory Membership Access Lock & Blurred Preview
 *
 * Renders a frosted-glass membership access notice with conditional CTA logic,
 * accompanied by a visually blurred synthetic placeholder grid that securely conceals
 * all real private alumni and business data at the server/database layer.
 *
 * @package Love_Family_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$type = $args['type'] ?? 'alumni'; // 'alumni' or 'business'
$user_id = get_current_user_id();

$access_state = class_exists('LFA_Payment_Entitlements')
    ? LFA_Payment_Entitlements::get_directory_access_state($user_id)
    : [
        'state'            => is_user_logged_in() ? 'approved_unpaid' : 'guest',
        'can_access'       => false,
        'user_id'          => $user_id,
        'is_guest'         => !is_user_logged_in(),
        'account_approved' => false,
        'dues_standing'    => 'unpaid',
        'is_paid'          => false,
        'invoice_id'       => 0,
    ];

$state = $access_state['state'] ?? 'guest';

// Dynamic contextual URLs
$current_url = home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
if (empty($current_url)) {
    $current_url = $type === 'business' ? home_url('/business-directory/') : home_url('/alumni-directory/');
}

$login_url    = home_url('/member-login/?redirect_to=' . urlencode($current_url));
$register_url = home_url('/member-register/');
$dash_url     = home_url('/member-dashboard/');
$dues_url     = home_url('/member-dashboard/#dues');

// Prompt-specified Copy
if ($type === 'business') {
    $heading     = 'Discover Our Alumni Business Network';
    $description = 'Explore alumni-owned businesses, professional services, and valuable community connections. Activate your annual membership to access the Business Directory.';
    $preview_sub = 'Sample Alumni Enterprises &mdash; Full Directory Access Reserved for Verified Members';
} else {
    $heading     = 'Unlock Our Alumni Network';
    $description = 'Connect with fellow Love Family Alumni, explore our member community, and discover professional connections. Complete your membership to access the Alumni Directory.';
    $preview_sub = 'Sample Alumni Profiles &mdash; Full Directory Records Reserved for Verified Members';
}
?>

<div class="lfa-directory-locked-container" id="lfa-directory-locked-preview" data-access-state="<?php echo esc_attr($state); ?>" aria-label="Restricted Directory Preview">
    
    <!-- Premium Frosted-Glass Membership Notice Card -->
    <div class="lfa-lock-banner">
        
        <!-- Subtle Gold Lock Icon Badge -->
        <div class="lfa-lock-icon-badge" aria-hidden="true">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
        </div>

        <h2 class="lfa-lock-heading"><?php echo esc_html($heading); ?></h2>
        
        <p class="lfa-lock-description"><?php echo esc_html($description); ?></p>

        <!-- Conditional CTA Buttons Based on Specific User Standing -->
        <div class="lfa-lock-cta-group">
            <?php if ($state === 'guest') : ?>
                <!-- State 1: Guest — Not Logged In -->
                <a href="<?php echo esc_url($login_url); ?>" class="lfa-btn-primary" id="lfa-btn-member-login">
                    <span>Member Login</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                </a>
                <a href="<?php echo esc_url($register_url); ?>" class="lfa-btn-secondary" id="lfa-btn-become-member">
                    <span>Become a Member</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>

            <?php elseif ($state === 'email_unverified') : ?>
                <!-- State 2: Registered but Email Unverified -->
                <div class="lfa-lock-status-pill lfa-pill-warning">
                    <span class="lfa-pill-dot"></span>
                    <strong>Email Verification Pending</strong>
                </div>
                <p class="lfa-lock-subtext">Please verify your email address to proceed with your alumni membership registration.</p>
                <div class="lfa-btn-subgroup">
                    <a href="<?php echo esc_url($dash_url); ?>" class="lfa-btn-secondary" id="lfa-btn-my-dashboard">
                        <span>Go to Member Dashboard &rarr;</span>
                    </a>
                </div>

            <?php elseif ($state === 'pending_approval') : ?>
                <!-- State 3: Email Verified but Awaiting Admin Approval -->
                <div class="lfa-lock-status-pill lfa-pill-amber">
                    <span class="lfa-pill-dot"></span>
                    <strong>Membership Approval Pending</strong>
                </div>
                <p class="lfa-lock-subtext">Your alumnus verification request is currently under review by our executive committee. You will be notified once approved.</p>
                <div class="lfa-btn-subgroup">
                    <a href="<?php echo esc_url($dash_url); ?>" class="lfa-btn-secondary" id="lfa-btn-my-dashboard">
                        <span>Go to Member Dashboard &rarr;</span>
                    </a>
                </div>

            <?php elseif ($state === 'expired') : ?>
                <!-- State 4: Expired Membership -->
                <div class="lfa-lock-status-pill lfa-pill-danger">
                    <span class="lfa-pill-dot"></span>
                    <strong>Membership Expired</strong>
                </div>
                <p class="lfa-lock-subtext">Your annual membership dues have lapsed. Renew your $100 annual membership to restore full directory access and community privileges.</p>
                <a href="<?php echo esc_url($dues_url); ?>" class="lfa-btn-primary" id="lfa-btn-renew-membership">
                    <span>Renew Membership ($100/yr)</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                </a>
                <a href="<?php echo esc_url($dash_url); ?>" class="lfa-btn-secondary" id="lfa-btn-my-dashboard">
                    <span>My Dashboard</span>
                </a>

            <?php else : ?>
                <!-- State 5: Logged In — Approved but Unpaid ($100 Annual Dues Required) -->
                <a href="<?php echo esc_url($dues_url); ?>" class="lfa-btn-primary" id="lfa-btn-pay-dues">
                    <span>Pay $100 Annual Dues</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                </a>
                <a href="<?php echo esc_url($dash_url); ?>" class="lfa-btn-secondary" id="lfa-btn-my-dashboard">
                    <span>My Dashboard</span>
                </a>
            <?php endif; ?>
        </div>

        <div class="lfa-lock-footer-note">
            <span class="lfa-lock-secure-text">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
                Secure Membership Verification &bull; Love Family Alumni &bull; North America Zone
            </span>
        </div>
    </div>

    <!-- Blurred Preview Grid Wrapper -->
    <div class="lfa-blurred-preview-wrapper" aria-hidden="true">
        
        <div class="lfa-preview-toolbar-badge">
            <span class="lfa-badge-dot"></span>
            <span class="lfa-badge-label"><?php echo esc_html($preview_sub); ?></span>
        </div>

        <?php if ($type === 'business') : ?>
            <!-- SYNTHETIC BUSINESS CARDS GRID (Pure Dummy Data — No Database Records Exposed) -->
            <div class="lfa-biz-grid lfa-synthetic-grid">
                <?php
                $dummy_businesses = [
                    [
                        'name'     => 'Apex Cloud Innovations',
                        'initial'  => 'AC',
                        'category' => 'Technology & IT',
                        'city'     => 'Dallas, TX',
                        'country'  => 'United States',
                        'desc'     => 'Enterprise multi-cloud architecture, DevOps automation, and specialized cyber-resilience infrastructure solutions for high-growth firms.',
                        'owner'    => 'Verified Alumnus',
                    ],
                    [
                        'name'     => 'Vanguard Health Partners',
                        'initial'  => 'VH',
                        'category' => 'Healthcare & Wellness',
                        'city'     => 'Atlanta, GA',
                        'country'  => 'United States',
                        'desc'     => 'Modern integrative healthcare practice offering comprehensive wellness consultations, preventive diagnostics, and family telehealth.',
                        'owner'    => 'Verified Alumnus',
                    ],
                    [
                        'name'     => 'Sterling & Trust Advisors',
                        'initial'  => 'ST',
                        'category' => 'Finance & Investment',
                        'city'     => 'New York, NY',
                        'country'  => 'United States',
                        'desc'     => 'Strategic wealth advisory, cross-border corporate tax optimization, and executive portfolio risk management for business leaders.',
                        'owner'    => 'Verified Alumnus',
                    ],
                    [
                        'name'     => 'Summit Legal Group LLC',
                        'initial'  => 'SL',
                        'category' => 'Consulting & Professional',
                        'city'     => 'Chicago, IL',
                        'country'  => 'United States',
                        'desc'     => 'Commercial transaction counsel, intellectual property protection, corporate restructuring, and international commercial litigation.',
                        'owner'    => 'Verified Alumnus',
                    ],
                    [
                        'name'     => 'Beacon Leadership Academy',
                        'initial'  => 'BL',
                        'category' => 'Education & Training',
                        'city'     => 'Toronto, ON',
                        'country'  => 'Canada',
                        'desc'     => 'Executive leadership mentorship, STEM career advancement academies, and continuous professional education certifications.',
                        'owner'    => 'Verified Alumnus',
                    ],
                    [
                        'name'     => 'Civic Crest Development',
                        'initial'  => 'CC',
                        'category' => 'Real Estate & Construction',
                        'city'     => 'Houston, TX',
                        'country'  => 'United States',
                        'desc'     => 'Commercial real estate syndication, sustainable infrastructure development, and premium multi-family residential construction.',
                        'owner'    => 'Verified Alumnus',
                    ],
                ];

                foreach ($dummy_businesses as $biz) :
                ?>
                <article class="lfa-biz-card lfa-synthetic-card">
                    <div style="display:flex;align-items:flex-start;gap:16px;margin-bottom:16px;">
                        <div style="width:56px;height:56px;border-radius:10px;background:linear-gradient(135deg,#0F2942 0%,#1a3d60 100%);color:#C6933D;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:20px;border:1px solid rgba(198,147,61,0.3);box-shadow:0 3px 8px rgba(0,0,0,0.08);">
                            <?php echo esc_html($biz['initial']); ?>
                        </div>
                        <div style="flex:1;">
                            <span class="small-pill" style="display:inline-block;padding:3px 10px;border-radius:4px;font-size:11px;font-weight:600;background:#eff6ff;color:#1d4ed8;margin-bottom:6px;">
                                <?php echo esc_html($biz['category']); ?>
                            </span>
                            <h3 style="font-size:17px;margin:0 0 4px 0;color:#0F2942;line-height:1.3;font-weight:700;">
                                <?php echo esc_html($biz['name']); ?>
                            </h3>
                            <p style="font-size:13px;color:#64748b;margin:0;">
                                &#128205; <?php echo esc_html($biz['city'] . ', ' . $biz['country']); ?>
                            </p>
                        </div>
                    </div>

                    <p style="font-size:14px;color:#475569;line-height:1.5;margin:0 0 16px 0;flex-grow:1;">
                        <?php echo esc_html($biz['desc']); ?>
                    </p>

                    <div style="padding-top:14px;border-top:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;font-size:13px;">
                        <span style="color:#64748b;">By <strong><?php echo esc_html($biz['owner']); ?></strong></span>
                        <div style="display:flex;gap:8px;">
                            <span class="button-outline button-sm" style="padding:4px 10px;font-size:12px;border-radius:4px;color:#64748b;border-color:#cbd5e1;">
                                Website &nearr;
                            </span>
                            <span class="button-dark button-sm" style="padding:4px 12px;font-size:12px;border-radius:4px;background:#0F2942;color:#fff;">
                                Details &#128274;
                            </span>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <!-- SYNTHETIC ALUMNI CARDS GRID (Pure Dummy Data — No Database Records Exposed) -->
            <div class="directory-profiles-grid lfa-synthetic-grid">
                <?php
                $dummy_alumni = [
                    [
                        'name'     => 'Alumnus Member',
                        'initial'  => 'AM',
                        'title'    => 'Senior Enterprise Architect',
                        'batch'    => '2016',
                        'location' => 'Toronto, ON, Canada',
                        'industry' => 'Cloud & Software Engineering',
                    ],
                    [
                        'name'     => 'Alumni Professional',
                        'initial'  => 'AP',
                        'title'    => 'Director of Financial Risk',
                        'batch'    => '2014',
                        'location' => 'New York, NY, United States',
                        'industry' => 'Investment Banking & Capital',
                    ],
                    [
                        'name'     => 'Alumni Leader',
                        'initial'  => 'AL',
                        'title'    => 'Clinical Operations Specialist',
                        'batch'    => '2018',
                        'location' => 'Atlanta, GA, United States',
                        'industry' => 'Healthcare Systems & Medicine',
                    ],
                    [
                        'name'     => 'Alumnus Member',
                        'initial'  => 'LF',
                        'title'    => 'Infrastructure Energy Lead',
                        'batch'    => '2012',
                        'location' => 'Houston, TX, United States',
                        'industry' => 'Renewables & Infrastructure',
                    ],
                    [
                        'name'     => 'Alumni Scholar',
                        'initial'  => 'AS',
                        'title'    => 'Associate Professor & Researcher',
                        'batch'    => '2015',
                        'location' => 'Boston, MA, United States',
                        'industry' => 'Higher Education & Robotics',
                    ],
                    [
                        'name'     => 'Alumnus Member',
                        'initial'  => 'AC',
                        'title'    => 'Corporate Compliance Counsel',
                        'batch'    => '2017',
                        'location' => 'Chicago, IL, United States',
                        'industry' => 'Corporate Legal & Governance',
                    ],
                    [
                        'name'     => 'Alumni Partner',
                        'initial'  => 'AP',
                        'title'    => 'Brand & Creative Strategist',
                        'batch'    => '2019',
                        'location' => 'Los Angeles, CA, United States',
                        'industry' => 'Global Media & Digital Design',
                    ],
                    [
                        'name'     => 'Alumnus Member',
                        'initial'  => 'LM',
                        'title'    => 'Global Supply Chain Director',
                        'batch'    => '2013',
                        'location' => 'Vancouver, BC, Canada',
                        'industry' => 'Logistics & Global Operations',
                    ],
                ];

                foreach ($dummy_alumni as $alum) :
                ?>
                <div class="directory-profile-card lfa-synthetic-card">
                    <div class="profile-media-wrapper">
                        <div class="profile-media-placeholder" style="background:linear-gradient(135deg, #0F2942 0%, #1e4265 100%);color:#C6933D;display:flex;align-items:center;justify-content:center;height:180px;border-radius:8px 8px 0 0;font-size:28px;font-weight:700;">
                            <span><?php echo esc_html($alum['initial']); ?></span>
                        </div>
                        <span class="profile-batch-badge">Class of <?php echo esc_html($alum['batch']); ?></span>
                    </div>

                    <div class="profile-card-body">
                        <h3 class="profile-name"><?php echo esc_html($alum['name']); ?></h3>
                        <p class="profile-title"><?php echo esc_html($alum['title']); ?></p>

                        <div class="profile-meta-list">
                            <div class="profile-meta-item">
                                <svg class="meta-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span class="meta-text"><?php echo esc_html($alum['location']); ?></span>
                            </div>

                            <div class="profile-meta-item">
                                <svg class="meta-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                <span class="meta-text"><?php echo esc_html($alum['industry']); ?></span>
                            </div>
                        </div>

                        <div class="profile-card-actions">
                            <span class="card-action-btn" title="Contact (Members Only)">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <span class="card-action-btn" title="LinkedIn Profile (Members Only)">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect x="2" y="9" width="4" height="12"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                            </span>
                            <span class="card-action-btn preview-action-btn" title="View Profile (Members Only)">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Frosted Glass Sheen Overlay -->
        <div class="lfa-preview-glass-overlay"></div>
    </div>
</div>
