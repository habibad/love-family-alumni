<?php
/**
 * Business Directory — Listings Grid Component
 *
 * @package Love_Family_Theme
 */

if (!defined('ABSPATH')) { exit; }

$viewer_id = get_current_user_id();
$access_state = class_exists( 'LFA_Payment_Entitlements' ) 
	? LFA_Payment_Entitlements::get_directory_access_state( $viewer_id ) 
	: [ 'can_access' => false, 'state' => 'guest' ];

if ( ! $access_state['can_access'] ) :
?>
<section class="lfa-biz-grid-section" id="business-listings" aria-label="Alumni Businesses">
    <div class="lfa-container">
        <?php get_template_part( 'template-parts/directory/locked-preview', null, [ 'type' => 'business' ] ); ?>
    </div>
</section>
<?php
    return;
endif;

$paged = max(1, get_query_var('paged', 1));
$category_filter = isset($_GET['category']) ? sanitize_text_field(wp_unslash($_GET['category'])) : '';
$country_filter  = isset($_GET['country']) ? sanitize_text_field(wp_unslash($_GET['country'])) : '';
$city_filter     = isset($_GET['city']) ? sanitize_text_field(wp_unslash($_GET['city'])) : '';
$search_query    = isset($_GET['s']) ? sanitize_text_field(wp_unslash($_GET['s'])) : '';
$sort_order      = isset($_GET['sort']) ? sanitize_key($_GET['sort']) : 'recent';

$query_args = [
    'viewer_id' => $viewer_id,
    'page'      => $paged,
    'per_page'  => 12,
    'keyword'   => $search_query,
    'category'  => $category_filter,
    'country'   => $country_filter,
    'city'      => $city_filter,
    'sort'      => $sort_order,
];

$results = class_exists('LFA_Business') ? LFA_Business::query_public_businesses($query_args) : ['total' => 0, 'businesses' => []];
$total_count = $results['total'];
$businesses  = $results['businesses'];
?>

<section class="lfa-biz-grid-section" id="business-listings" aria-label="Alumni Businesses">
    <div class="lfa-container">
        
        <!-- Results Toolbar: Counter & Sorting -->
        <div class="lfa-biz-toolbar" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:16px;">
            <div class="lfa-biz-count-wrapper">
                <span class="lfa-biz-count-text" style="font-size:15px;color:#475569;">
                    Showing <strong id="lfa-biz-showing-count"><?php echo count($businesses); ?></strong> of <strong id="lfa-biz-total-count"><?php echo esc_html($total_count); ?></strong> approved businesses
                </span>
            </div>

            <div class="lfa-biz-sort-wrapper" style="display:flex;align-items:center;gap:10px;">
                <label for="lfa-biz-filter-sort" style="font-size:14px;color:#64748b;font-weight:500;">Sort By:</label>
                <select id="lfa-biz-filter-sort" class="lfa-biz-select" style="padding:6px 32px 6px 12px;border-radius:6px;border:1px solid #cbd5e1;font-size:14px;background:#fff;">
                    <option value="recent" <?php selected($sort_order, 'recent'); ?>>Recently Added</option>
                    <option value="name_asc" <?php selected($sort_order, 'name_asc'); ?>>Business Name (A–Z)</option>
                    <option value="name_desc" <?php selected($sort_order, 'name_desc'); ?>>Business Name (Z–A)</option>
                </select>
            </div>
        </div>

        <!-- 3-Column Businesses Grid -->
        <div class="lfa-biz-grid" id="lfa-biz-grid" style="display:grid;grid-template-columns:repeat(auto-fill, minmax(320px, 1fr));gap:24px;">
            <?php if (!empty($businesses)) : ?>
                <?php foreach ($businesses as $biz) :
                    $has_consent = (bool)$biz->contact_consent;
                    $owner = get_userdata((int)$biz->owner_user_id);
                    $owner_name = $owner ? $owner->display_name : 'Verified Alumnus';
                    $logo_url = !empty($biz->logo_file) ? LFA_Business::get_logo_url((int)$biz->id) : '';
                    $social = json_decode($biz->social_links_json ?? '{}', true);
                ?>
                    <article class="lfa-biz-card" 
                             data-id="<?php echo esc_attr($biz->id); ?>"
                             data-biz-id="<?php echo esc_attr($biz->id); ?>"
                             data-name="<?php echo esc_attr($biz->name); ?>"
                             data-category="<?php echo esc_attr($biz->category); ?>"
                             data-country="<?php echo esc_attr($biz->country); ?>"
                             data-city="<?php echo esc_attr($biz->city); ?>"
                             data-website="<?php echo esc_url($biz->website_url ?? ''); ?>"
                             data-desc="<?php echo esc_attr($biz->description); ?>"
                             data-owner="<?php echo esc_attr($owner_name); ?>"
                             data-logo="<?php echo esc_url($logo_url); ?>"
                             data-email="<?php echo $has_consent ? esc_attr($biz->public_email) : ''; ?>"
                             data-phone="<?php echo $has_consent ? esc_attr($biz->public_phone) : ''; ?>"
                             style="background:#fff;border-radius:12px;border:1px solid #e2e8f0;padding:24px;display:flex;flex-direction:column;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:transform 0.2s, box-shadow 0.2s;">
                        
                        <div style="display:flex;align-items:flex-start;gap:16px;margin-bottom:16px;">
                            <?php if ($logo_url) : ?>
                                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($biz->name); ?> logo" style="width:56px;height:56px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                            <?php else : ?>
                                <div style="width:56px;height:56px;border-radius:8px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:20px;color:#0F2942;border:1px solid #e2e8f0;">
                                    <?php echo esc_html(strtoupper(substr($biz->name, 0, 1))); ?>
                                </div>
                            <?php endif; ?>
                            <div style="flex:1;">
                                <span class="small-pill" style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600;background:#eff6ff;color:#1d4ed8;margin-bottom:6px;">
                                    <?php echo esc_html($biz->category); ?>
                                </span>
                                <h3 style="font-size:18px;margin:0 0 4px 0;color:#0F2942;line-height:1.3;font-weight:700;">
                                    <?php echo esc_html($biz->name); ?>
                                </h3>
                                <p style="font-size:13px;color:#64748b;margin:0;">
                                    📍 <?php echo esc_html($biz->city . ', ' . $biz->country); ?>
                                </p>
                            </div>
                        </div>

                        <p style="font-size:14px;color:#475569;line-height:1.5;margin:0 0 16px 0;flex-grow:1;">
                            <?php echo esc_html(wp_trim_words($biz->description, 22, '...')); ?>
                        </p>

                        <div style="padding-top:14px;border-top:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;font-size:13px;">
                            <span style="color:#64748b;">By <strong><?php echo esc_html($owner_name); ?></strong></span>
                            
                            <div style="display:flex;gap:8px;">
                                <?php if (!empty($biz->website_url)) : ?>
                                    <a href="<?php echo esc_url($biz->website_url); ?>" target="_blank" rel="noopener noreferrer" class="button-outline button-sm" style="padding:4px 10px;font-size:12px;border-radius:4px;" title="Visit Website">
                                        Website ↗
                                    </a>
                                <?php endif; ?>
                                <button type="button" class="button-dark button-sm lfa-biz-view-btn lfa-biz-preview-btn" style="padding:4px 10px;font-size:12px;border-radius:4px;">
                                    Details
                                </button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Honest Empty State -->
        <div class="lfa-biz-empty-state" id="lfa-biz-empty-state" style="<?php echo empty($businesses) ? 'display:block;' : 'display:none;'; ?>text-align:center;padding:56px 20px;background:#f8fafc;border-radius:12px;border:1px dashed #cbd5e1;margin-top:20px;">
            <div style="font-size:48px;margin-bottom:12px;" aria-hidden="true">🏢</div>
            <h3 style="font-size:20px;color:#0F2942;margin:0 0 8px 0;font-weight:700;">No Approved Business Listings Found</h3>
            <p style="font-size:15px;color:#64748b;max-width:540px;margin:0 auto 20px auto;line-height:1.5;">
                There are currently no approved businesses matching your search criteria. All listings undergo administrative verification before publication.
            </p>
            <?php if (is_user_logged_in() && class_exists('LFA_Core') && LFA_Core::is_approved(get_current_user_id())) : ?>
                <a href="<?php echo esc_url(home_url('/member-dashboard/#businesses')); ?>" class="button-dark" style="display:inline-block;">
                    Submit Your Business for Review &rarr;
                </a>
            <?php else : ?>
                <button type="button" id="lfa-biz-empty-reset" class="button-outline">
                    Reset All Filters
                </button>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_count > 12) : ?>
            <div class="lfa-biz-pagination-wrap" style="margin-top:36px;text-align:center;">
                <?php
                echo paginate_links([
                    'total'   => ceil($total_count / 12),
                    'current' => $paged,
                    'type'    => 'list',
                ]);
                ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Business Detail Modal -->
    <div id="lfa-biz-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.7);z-index:999999;align-items:center;justify-content:center;padding:20px;" aria-modal="true" role="dialog" aria-hidden="true">
        <div style="background:#fff;border-radius:14px;max-width:580px;width:100%;max-height:90vh;overflow-y:auto;padding:32px;position:relative;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);">
            <button type="button" id="lfa-biz-modal-close" style="position:absolute;top:16px;right:16px;border:none;background:none;font-size:24px;cursor:pointer;color:#64748b;" aria-label="Close details">&times;</button>
            
            <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                <div id="modal-biz-logo-wrap"></div>
                <div>
                    <span id="modal-biz-category" class="small-pill" style="background:#eff6ff;color:#1d4ed8;font-size:12px;font-weight:600;padding:2px 8px;border-radius:4px;"></span>
                    <h2 id="modal-biz-name" style="margin:4px 0;font-size:22px;color:#0F2942;font-weight:700;"></h2>
                    <span id="modal-biz-location" style="font-size:13px;color:#64748b;"></span>
                </div>
            </div>

            <div style="margin-bottom:20px;">
                <h4 style="margin:0 0 6px 0;font-size:13px;text-transform:uppercase;color:#94a3b8;letter-spacing:0.05em;">About the Business</h4>
                <p id="modal-biz-description" style="font-size:14px;color:#334155;line-height:1.6;margin:0;"></p>
            </div>

            <div style="margin-bottom:20px;padding:16px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
                <h4 style="margin:0 0 8px 0;font-size:13px;text-transform:uppercase;color:#94a3b8;letter-spacing:0.05em;">Verified Ownership &amp; Contact</h4>
                <p style="margin:0 0 6px 0;font-size:14px;"><strong>Owner:</strong> <span id="modal-biz-owner"></span> (Verified Alumnus)</p>
                <div id="modal-biz-contact-info" style="font-size:14px;color:#334155;"></div>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;padding-top:16px;border-top:1px solid #e2e8f0;">
                <a id="modal-biz-website-link" href="#" target="_blank" rel="noopener noreferrer" class="button-dark" style="display:none;">Visit Official Website &rarr;</a>
                <div id="modal-biz-socials" style="display:flex;gap:10px;"></div>
            </div>
        </div>
    </div>
</section>
