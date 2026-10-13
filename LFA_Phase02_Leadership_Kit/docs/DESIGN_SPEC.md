# Leadership Page Design Specification

## Brand continuity
Use the site's ACTUAL approved CSS custom properties and typography, not a newly invented mini design system. Navy/crimson/gold/white must visually match the existing homepage. Shared header, full-width CTA and footer are reused exactly.

## Page route
`/leadership/` (WordPress Page). Use the existing theme's page-template conventions. Recommend `page-leadership.php` or existing routed template `templates/pages/page-leadership.php` registered appropriately. Do not register conflicting permalink routes.

## Section order
1. Inner hero: small gold label OUR LEADERSHIP; heading 'Servant Leadership. A Stronger Community.'; brief organization intro; optional Home / Leadership breadcrumb; original event group photograph with deep navy left-to-right overlay. Distinguish page as North America Zone.
2. President's introduction: two-column editorial white/off-white section with real client-provided president portrait; heading 'Leading with Purpose. Serving with Love.'; Dr. Evans Akpo; designation as shown in approved homepage; concise carefully authored introduction; Read Full Message to a real intended page only, or non-clickable draft state if not yet created. Not a duplicate of homepage dark president feature.
3. Organizational leadership structure: a restrained two-tier diagram / panels distinguishing overall Love Family Alumni from its North America Zone. DO NOT claim the North America Zone governs all global alumni chapters.
4. North America Executive Leadership: profile grid, slots for approved members; no invented identities; member cards with optional verified name/title/photo/tenure. Consider 4 cards per row desktop if sufficient photos; avoid empty pointless grid rows.
5. Board of Trustees and International Executive: separate section headings and content groups, conditional on verified organizational relationships. If role mapping is not verified, show editorial explanation or structurally styled placeholders, not inaccurate staff hierarchies.
6. Standing Committees: 3x2 or responsive card grid; initial generic committee model can be visually represented with 'Committee details pending' labels; only publish formally named committees after confirmation.
7. Zones & Chapters: short organizational network explainer and link to About page / members directory as appropriate; no fictional geographic coverage.
8. Reuse approved 'You Belong Here / Join the Love Family Alumni Today' CTA and footer, NOT a newly designed bottom section.

## Desktop layout metrics (starting points, not guarantees)
- Target viewport: 1440 x 900 desktop, then 1280; use 768 tablet, 390 mobile.
- Inner content max width: reuse homepage value; approx 1200–1280px only if existing theme has no shared token.
- Section horizontal padding: clamp(20px, 4.2vw, 64px); avoid double padding via nested containers.
- Hero height: 420–500px desktop, avoid fixed height on mobile; content left-center / lower-left aligned, not vertically tiny.
- Hero headline: clamp(40px, 4.5vw, 64px) serif, strong line-height 1.08–1.16.
- Sections vertical rhythm: approx 64–96px desktop and 40–56px mobile.
- President section: 42% image / 58% copy (or reverse, if closer to concept), portrait approx 410px high desktop and rounded 12–16px.
- Cards: 4 columns at >=1200 when enough data; 2 at tablet; 1 at narrow mobile. Equal image crop and card height.
- Icons: small red/gold details, no giant floating decorative icons or excessive shadows.
- Mobile: hero text fully legible; portrait before description; no 2px-small text; profile cards 1 column or 2 when cards remain readable.

## Card fields, frontend demo only
Leader: id, name (verified only), position (verified only), region, photo (client-approved), short_bio, term (if client supplied), order, visible, profile_url (optional). Default: data_status = pending. Render pending state with neutral avatar + 'Profile pending confirmation'. No invented social links.

## Interaction requirements
Breadcrumb navigation works; CTAs lead to a real WordPress page/route; profile card links only if destination exists. Hover states, keyboard focus, accessible labels; reduced motion support.

## Visual verification
Measure real rendered CSS geometry in Chrome and compare visually with `CLIENT_APPROVED_HOMEPAGE.png` for shared language and `LEADERSHIP_DESIGN_CONCEPT_ILLUSTRATIVE.png` for page composition (excluding illustrative identities). Visual consistency, not reproducing a screenshot as a CSS image, is the target.
