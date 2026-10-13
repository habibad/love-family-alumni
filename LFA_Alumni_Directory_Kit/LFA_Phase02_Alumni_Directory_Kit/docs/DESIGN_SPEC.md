# Alumni Directory — Visual and UX specification

## Visual source priority
Client-approved current Homepage > approved inner page design system > `references/ALUMNI_DIRECTORY_WEBSITE_VISUAL.png` for new content placement and proportions. This reference is a concept, not an exact source screenshot; preserve its composition, not the fake names or numbers.

## Desktop (1440px target)
1. Global top bar + header — reuse without recreating.
2. Hero (~340–430px initial estimate) — navy overlay over ORIGINAL alumnus community photo, eyebrow `ALUMNI DIRECTORY`, serif heading `One Family. A Global Network.`, supporting copy, subtle breadcrumb `Home / Alumni Directory`. Left-align heading; keep image visible to the right. Full-bleed shell with the approved max content width.
3. Search & Filters — full-width white elevated container, ideally overlapping hero bottom by ~24–40px if consistent with screenshot. Top row: search input (name, class year, profession, location) + crimson Search button + Reset button. Second row: Year/Batch, Profession, City/State, Country, Sort by. Use compact labels, rounded input borders, sensible gaps. No actual private member records.
4. Results header — dynamic `Showing X of Y demo profiles` calculated from fixtures; grid/list view toggle optional if implemented functionally. Never hardcode fabricated global alumni statistics.
5. Profile grid — four columns on wide desktop, two tablet, one mobile. Card: neutral demo photo/monogram, demo marker, placeholder name `Alumni Profile Preview`, optional illustrative profession/category and region only if clearly synthetic; no social media link, contact info, unique ID or real member photo until supplied/authorized. `View Preview` can open an actual accessible demo modal; otherwise render as disabled / coming soon, not broken. Equal image ratio, radius 10–12px, subtle border and shadow.
6. Pagination — page-size 8 or 12 fixtures with previous, next and index. Must update both cards and counts. Keyboard accessible.
7. Safety/privacy strip — short privacy text: `Your profile visibility is controlled by your privacy settings. Verified member access may be required to view additional details.` This is proposed product behavior, not a deployed backend feature.
8. Join/update CTA — crimson full-width stripe over original group photo with gradient, white community icon, heading `Reconnect. Network. Make an Impact.`, subtitle, CTA `Join or Update Your Profile` (link to real route only if exists, else clearly label preview).
9. Global shared Footer — reuse as is.

## Visual tokens
Use CSS variables already defined by approved site; starting fallback values navy #071D3E, crimson #BA002C, gold #E5B343, white #FFFFFF, light #F7F9FB. Serif heading same as site; body same existing sans family. Avoid global CSS resets. Keep whitespace spacious but not oversized.

## UX
- User can search/filter only among mock demo fixtures on static frontend; no backend request.
- Filters can be combined; reset clears search, select values and pagination.
- Empty result state and loading-free feedback.
- Privacy-first member search model later. Do not display actual identifiable member data without consent and valid access rules.

## Suggested WordPress files
```
page-alumni-directory.php
  -> get_template_part('templates/pages/page','alumni-directory')
templates/pages/page-alumni-directory.php
  -> get_header() + wrapper + template parts + get_footer()
template-parts/directory/hero.php
template-parts/directory/search-filters.php
template-parts/directory/profile-grid.php
template-parts/directory/profile-card.php
template-parts/directory/privacy.php
template-parts/directory/join-cta.php
inc/data/alumni-directory-demo.php
assets/css/alumni-directory.css
assets/js/alumni-directory.js
```
Reuse theme actual naming and avoid duplicate header/footer if root page file includes master template; follow existing theme convention. Enqueue only on target page. Do not inject query data unsafely; escape all PHP output.
