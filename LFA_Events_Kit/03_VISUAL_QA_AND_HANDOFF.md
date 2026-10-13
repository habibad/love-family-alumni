# Events & Conference — Browser QA / Delivery requirements

## Browser evidence
Open in Google Chrome (ask user permission if necessary), zoom 100%, use fixed viewports:
- 1440×900 desktop
- 1280×900 desktop
- 768×1024 tablet
- 390×844 mobile

For each page, provide **full-height screenshots**, plus crops for Hero, key grids, registration/filters, CTA and footer. Check no horizontal overflow, clipping, missing media, console errors or inaccessible controls. Perform side-by-side visual comparisons with the approved site's design system. Never claim pixel-perfect verification without screenshots.

## Interaction tests — Events
- Keyword search filters sample fixtures (case-insensitive) correctly.
- Category, period and sort controls combine predictably.
- Reset clears state and restores result count.
- Pagination never shows nonexistent pages or fake totals.
- No-results state explains lack of official upcoming dates.
- Calendar prev/next month navigates; no dot without a verified event date.
- Featured 2027 CTA routes to Conference, and valid archive links work.

## Interaction tests — Conference
- Anchor buttons navigate to valid sections.
- FAQ accordion opens/closes by keyboard and click.
- Registration preview clearly says not open; form cannot complete fake payment or registration.
- No invented speaker, venue, date, ticket fee or sponsor tiers.
- All links either work or are appropriately disabled with honest explanatory text.
- Events/Conference/homepage cross-links work in desktop and mobile navigation.

## Regression checklist
- Existing Homepage, About, Leadership, Membership, Alumni Directory unchanged visually and functionally.
- Existing shared header/footer unchanged; no duplicated navigation.
- Page-specific styles don't bleed outside `.lfa-events` or `.lfa-conference`.

## Required completion report per page
1. Actual live localhost URL and whether verified in Chrome.
2. Changed PHP/CSS/JS and fixture files.
3. Screenshot paths and viewport dimensions.
4. Each page section: DONE / NEEDS REFINEMENT / WAITING CLIENT CONTENT.
5. Functional controls test results.
6. Missing official assets/content and uncertain claims.
7. Regression result for approved pages.
8. Statement of scope: did NOT start other pages or backend.
9. Stop for explicit user approval.
