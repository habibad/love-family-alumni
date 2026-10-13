# ANTIGRAVITY — Events Page (Phase 02, Page 05/06 depending on directory progress)

**Implement ONLY the Events page. Stop for review before touching the Conference page.**

## Objective
Build `/events/` as a refined institutional community events destination — **not** a generic calendar plugin listing. Show gatherings, reunions, conferences, community service and historical event memories while keeping unconfirmed events explicitly pending. Client-approved website design language remains unchanged.

## Before coding
1. Open the approved Homepage, About, Leadership, Membership and current Directory in Chrome; inspect container, text scale, header/footer, responsive breakpoints and CTA styling. Do NOT alter these pages.
2. Inventory available original event photos: group reunion, 2025 Omaha reunion presenter, alumni community portraits, official organization emblem. Identify actual media paths. No generic substitutions where originals work.
3. Verify the published `/events/` WordPress page and menu link exist; create/reuse page routing without duplicate templates.

## Visual page blueprint (top to bottom)

### 01 — Events Hero (full bleed)
- Approximately 460–540px high on a large desktop, adjust to approved site's proportions rather than lock a pixel height.
- Photographic background showing a real client-provided alumni gathering, tasteful navy gradient 90% left to transparent towards right.
- Breadcrumb `Home / Events`; small gold eyebrow `COMMUNITY & CONNECTION`.
- Two-line editorial serif hero headline: **“The Moments That Bring Us Together.”**
- Intro: “From alumni reunions and conferences to community initiatives, stay connected through the moments that strengthen the Love Family.”
- Anchored action `Explore Events` scrolls to listings; secondary `2027 Conference` links to the confirmed Conference page URL.
- Optional small line-art crest watermark; no huge overlay cards; full bleed, readable, cinematic but restrained.

### 02 — Featured Event / Next Gathering
- Distinct off-white section, asymmetrical editorial grid (image 47%, text 53%) with rounded media corner and an overlapping modest gold label `FEATURED EVENT`.
- Feature the **2027 Conference** only with the confirmed theme `THY KINGDOM COME · Matthew 6:10`.
- Date `To be announced`; venue `To be announced`. Do not assert a July date or a speaker.
- `View Conference Details` goes to `/conference/2027/`.
- Show no invented countdown or seats-left indicator.

### 03 — Browse Events (working static interactions)
- Eyebrow `EXPLORE EVENTS`, headline `Gather. Celebrate. Make an Impact.`
- Horizontal category chips: All / Conferences / Reunions / Community / Service / Virtual (the categories are filter types, not confirmed scheduled events).
- Search input (event title/location), period toggle `Upcoming` / `Past`, sort selector, and Reset.
- Client-side JavaScript operating over a single centralized fixture array with **only verified historical facts and clearly labeled DEMO placeholders**. Avoid fake public upcoming announcements.
- Empty-state message (especially Upcoming with no confirmed date): `New events will be announced soon.`
- Changing search/category/period updates event cards, result count and pagination accurately. URL query parameter sync is optional, not mandatory.

### 04 — Event Listing Grid
- Three columns desktop / two tablet / one mobile; visually consistent cards with image area 16:10, date/status badge, category, title, location/status, summary, and `View Event` where a route exists.
- For 2027 Conference, use status `Date pending` rather than an invented calendar date.
- For client-provided photos, `Omaha 2025 Conference / Reunion` may appear as **past event** if archive copy is explicitly approved; keep historical photos clearly labeled as archives.
- No invented ticket prices, recurring dates, speaker credentials, attendances or RSVPs.
- Pagination works over real fixture length (don't hardcode '245 events').

### 05 — Events Calendar & Upcoming Notice
- Clean two-column section: left compact calendar preview; right a navy notice panel for official event announcements.
- Calendar controls (previous/next month) actually update the calendar dates; only mark an event day when a validated event date exists.
- With no upcoming scheduled date, show `Upcoming dates will be published once confirmed.`
- No fake calendar dots. Don't confuse the 2027 conference year with an exact date.

### 06 — Past Event Highlights / Gallery
- Curated three-tile editorial grid using original client reunion photos, with date/location labels only where verified.
- Include a clear `2025 Omaha Reunion` archival label if aligned with supplied material. Use descriptive alt text, not fabricated participant names.
- CTA `Explore Our Archives` should point to a published archive route, otherwise offer a truthful temporary non-link text state.

### 07 — Community CTA + Shared Footer
- Crimson or navy page-specific CTA compatible with approved design: eyebrow `BE PART OF THE MOMENT`, headline `Every Gathering Strengthens Our Family.`, copy encouraging community participation.
- Buttons `Explore Membership` -> `/membership/`, `Contact Us` -> valid contact route.
- Then reuse global shared footer as-is (no duplication/rewrite).

## Implementation structure — adapt to existing theme
```
page-events.php                      (only if needed as WP loader)
templates/pages/page-events.php
template-parts/events/hero.php
template-parts/events/featured.php
template-parts/events/filters.php
template-parts/events/event-card.php
template-parts/events/event-grid.php
template-parts/events/calendar.php
template-parts/events/highlights.php
template-parts/events/cta.php
inc/data/events-demo.php
assets/css/events.css
assets/js/events.js
```
- Reuse shared card/button tokens and WP `get_template_part`; never duplicate `get_header` or `get_footer`.
- Demo JS must do functional search, chips, period filter, sort, pagination, calendar month navigation and reset. Events without exact date must not be inserted as fake dates in the calendar.
- Use accessible, keyboard-operable controls.

## Work order / stop gates
**E1** hero and featured event -> Chrome screenshot -> stop for user approval.
**E2** listing, filters, cards, JS & pagination -> demonstrate working cases, screenshot -> stop for approval.
**E3** calendar, archive, CTA, navigation -> screenshots -> stop for approval.
**E4** full regression/QA at 1440/1280/768/390, zero overflow and console errors -> stop and request page approval.

**Never start the Conference page unless the user explicitly approves the Events page.**
