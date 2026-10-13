# Antigravity Master Handoff — Phase 02 Alumni Directory

Project: Love Family Alumni — North America Zone
Local URL: `http://localhost/evans-alop/alumni-directory/`

Status: Homepage, About Us, Leadership and Membership pages have been approved. We are in **frontend-only** page-by-page phase. Create the Alumni Directory page in the EXISTING WordPress custom PHP theme.

Before any coding:
- Inspect the current theme architecture, existing site design tokens, header, footer, Membership page and PHP enqueue mechanism.
- Open Chrome and inspect the approved homepage and membership pages.
- Inspect `references/ALUMNI_DIRECTORY_WEBSITE_VISUAL.png`. The complete collage's right-side implementation guide is NOT webpage content.
- Read `docs/DESIGN_SPEC.md` and `docs/STATIC_DATA_PRIVACY.md`.

Mandatory:
- Do not redesign or change approved pages.
- Do not use Elementor, Next.js or new framework.
- Use PHP templates, HTML/CSS and minimal vanilla JS.
- Create reusable scoped components and conditional CSS/JS enqueues.
- Static demo data only, visibly identified as demo, no actual member PII or fake real member profiles.
- Make demo search/filter/pagination genuinely interactive on supplied fixtures, with accessible keyboard controls and empty states.
- Properly link Directory navigation via existing WP menu, as a Directory dropdown containing `Alumni Directory` and `Business Directory` if both routes exist, otherwise link to existing route while preserving header geometry.
- Browser verification in Chrome; ask permission before browser access if required.
- Screenshot at 1440, 1280, 768, 390px. Check console, responsiveness and page regressions.

Sequence:
Task 01: Hero + search/filter shell. STOP and show screenshots.
Task 02: profile grid + demo data + filtering/sorting/pagination. STOP and show screenshots/tests.
Task 03: privacy notice + join CTA + navigation + shared footer. STOP and show screenshots.
Task 04: full page Chrome QA and responsive comparison. STOP, request page approval.

Do NOT start Business Directory, other pages or backend until explicit approval.
