# ANTIGRAVITY — 2027 Conference Page (after Events approval)

**Implement ONLY `/conference/2027/` after the Events page has been approved.**

## Objective
Create a premium, distinctive institutional 2027 Conference landing page that feels like a flagship alumni gathering — more atmospheric than the Events directory yet consistent with the approved Homepage. The story is **“THY KINGDOM COME” — Matthew 6:10**. Do not invent official details.

## Before coding
1. Inspect approved Homepage, Membership, Events (when approved), Leadership, About and global UI in Chrome; preserve shared header/footer/design system.
2. Locate original client alumni reunion group photos, Love Family emblem and 2025 Omaha archival photographs. Do not use a 2026 speaker flyer or photograph to imply any **2027** speaker confirmation.
3. Verify/create WordPress pages for parent `/conference/` and child `/conference/2027/`, or existing equivalent routing. Use true WP page templates and published slugs. Ensure both homepage 2027 CTA and Events featured card route here.
4. Document missing: confirmed dates, venue/hotel, speakers, agenda, ticket plans, prices, sponsor levels, registration opening, gateway choice.

## Page design — top to bottom

### 01 — Cinematic Conference Hero
- Full-width deep burgundy + navy atmosphere with client alumni imagery under tasteful red/maroon gradients and a faint globe/crest motif; avoid copying the 2026 flyer as hero poster.
- On 1440px target a substantial ~550–660px section, refine from approved homepage proportions.
- Left: gold eyebrow `LOVE FAMILY ALUMNI · 2027 CONFERENCE`; very large editorial heading `THY KINGDOM COME`; reference `Matthew 6:10`.
- Subhead: `A gathering in fellowship, purpose and shared legacy.`
- Large CTA: `Conference Information` -> overview anchor; secondary `Registration Updates` -> registration/status anchor.
- Right: visually striking poster-style frame made of real HTML text / branded background, showing `2027`, `North America Zone`, `Dates & venue to be announced` (no fabricated date/speaker), not a flattened reference screenshot.
- Breadcrumb with Home / Conference / 2027.

### 02 — Event Facts Strip
- Four evenly aligned facts: Year `2027` / Theme `Thy Kingdom Come` / Date `To be announced` / Venue `To be announced`.
- Tiny iconography, gold dividers, contrast-aware accessible text.

### 03 — About the 2027 Conference
- Editorial 55/45 photo/text grid; eyebrow `ONE FAMILY. ONE PURPOSE.`, heading `Gathering in Faith. Growing in Community.`
- Use official mission-oriented copy, not unverified promises or dates.
- 3 small mission highlights: Fellowship, Service, Lasting Legacy.

### 04 — What to Expect
- 4 elegant cards: Fellowship & Reunion, Inspiring Conversations, Service & Community, Future Generations.
- These are descriptive themes/possibilities, not official confirmed sessions. Make labels clear.
- Unique editorial iconography and restrained hover effects.

### 05 — Program & Agenda
- Strong navy section with typographic rhythm and gold markers.
- Status badge `PROGRAM TO BE ANNOUNCED`.
- Responsive agenda layout skeleton showing categories `Opening & Welcome`, `Community Sessions`, `Fellowship`, `Closing & Next Steps` as **illustrative preview only**; no invented times or named speakers.
- If no verified program, render an attractive honest empty-state rather than fabricated schedule.

### 06 — Speakers & Guests
- Headline `Voices That Inspire Our Community`.
- Use clean reserved speaker card placeholders labeled `Speaker announcement coming soon`.
- DO NOT use Dr. Christian Oje Oarhe from the 2026 flyer as a 2027 speaker without confirmation, and do not fabricate people, headshots, social handles or titles.

### 07 — Conference Registration & Payment Preview
- Two-column: left purpose & what registration includes (only confirmed items); right polished form/ticket-panel layout.
- Include semantic preview fields (attendee name, email, member/guest selection, number of attendees) only if appropriate and clearly marked **FRONTEND PREVIEW — REGISTRATION NOT OPEN**.
- Pricing `To be announced`; no fake checkout or successful registration state. Disable submission until backend and approved event registration policy exist, with an accessible explanation.
- `PayPal`/`Pushpay` not selected; don't place active payment branding/buttons.
- All future integration hooks should use reusable classes/data structures, not build backend yet.

### 08 — Sponsorship & Giving
- Rich maroon/cream asymmetric feature section; message explaining partnership and supporting alumni programs.
- No invented sponsorship tiers or fundraising figures.
- `Inquire About Sponsorship` -> published Contact page or confirmed email link.

### 09 — Travel & Accommodation
- Clear two-column travel panel with iconography and a map-inspired graphical accent (do not invent map coordinates).
- `Venue and hotel details will be announced.`
- Do not show real hotel booking buttons, hotel names, addresses or travel distances without official info.

### 10 — Memories from Previous Gatherings
- Three-photo gallery using client-supplied 2025 reunion/other past events, explicitly labeled historical archives.
- Link to `/archives/` only if route exists; otherwise present a non-broken `More memories coming soon` line.

### 11 — Conference FAQ
- Accessible accordion: confirmed date? where held? registration open? member vs guest? payment? hotel? sponsorship?
- Answers clearly indicate details pending when not known; use no invented commitments.

### 12 — Final CTA + Shared Footer
- Full-width navy/crimson branded CTA `Be Part of Our Next Chapter.` with `Explore Events` -> `/events/` and `Contact the Organizers` -> contact page.
- Reuse existing global footer; no global redesign.

## WordPress build approach — adjust to actual project
```
page-conference.php / page-2027.php or a custom assigned page template
  (avoid duplicate content; support the real /conference/2027/ route)
templates/pages/page-conference-2027.php
template-parts/conference/hero.php
template-parts/conference/facts.php
template-parts/conference/overview.php
template-parts/conference/expectations.php
template-parts/conference/program.php
template-parts/conference/speakers.php
template-parts/conference/registration-preview.php
template-parts/conference/sponsorship.php
template-parts/conference/travel.php
template-parts/conference/memories.php
template-parts/conference/faq.php
template-parts/conference/cta.php
inc/data/conference-2027-demo.php
assets/css/conference-2027.css
assets/js/conference-2027.js
```
All conference style rules scoped `.lfa-conference`. Use PHP escaping and existing enqueue convention. Do not create WooCommerce products, member database records, payment endpoints, calendar bookings or live registration APIs in this phase.

## Stop gates
**C1** hero + facts + overview -> screenshot -> approval.
**C2** expectations + program + speaker placeholders -> screenshot -> approval.
**C3** registration preview + sponsors + travel -> browser QA + approval.
**C4** memories + FAQ + CTA + full page & mobile regression -> screenshot and handoff -> final page approval.

## Linkup
Header Conference nav -> `/conference/2027/` or existing main conference route (be consistent); Events featured event -> same; Homepage 2027 Conference -> same; event details link returns to Events.

**Stop after the Conference page. Do not start backend or any other page without user approval.**
