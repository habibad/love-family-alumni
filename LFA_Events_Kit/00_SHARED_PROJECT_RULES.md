# Shared project rules — mandatory for BOTH pages

- Project: Love Family Alumni — North America Zone.
- Local URL: `http://localhost/evans-alop/`.
- Work inside the EXISTING custom WordPress PHP theme. Do not start a new project or use Elementor/page builders, headless Next.js, React, or Laravel.
- Frontend phase only: static fixtures, no membership database writes, no real payments, no fake registration success, no fake event attendance counts.
- Reuse the EXISTING approved site header/navigation, final common footer, logo, fonts, colors and button styles. Do not rebuild them or modify existing approved pages.
- Maintain a light institutional visual language: deep navy, crimson, restrained gold, white/off-white, editorial serif headlines and readable sans-serif body.
- Use original approved media where available. Do not use photos of actual people as new event speakers or officers without verified details. **The 2026 speaker promotion is NOT proof of a 2027 speaker.** Omaha 2025 material is PAST event imagery only.
- Confirmed 2027 facts from briefing: event year 2027; conference theme “THY KINGDOM COME” (Matthew 6:10). **Exact date, city, venue, ticket categories/amount, hotel details, confirmed speakers, and schedule are pending client input.** Do not invent or imply confirmation of these.
- Do not assume payment provider has been chosen or configured. PayPal/Pushpay mentioned as options; no live checkout in this phase.
- Keep sample fixtures centralized, separated from display templates and clearly flagged as example/test data. No invented actual alumni profiles, sponsors, speakers, awards, birthdays or weddings.
- Semantic HTML, keyboard navigation, labels, focus-visible indicators, accessible contrast, properly attributed alt text, `prefers-reduced-motion`, server-safe escaping (`esc_html`, `esc_attr`, `esc_url`) wherever PHP outputs user-adjustable values.
- Scope page CSS to `.lfa-events` or `.lfa-conference` and load it conditionally using existing theme enqueue pattern. Avoid global selectors overriding approved pages.
- Confirm WordPress page is actually published and routed. Navigation must link Events to `/events/`, Conference to `/conference/2027/`, and feature cross-links; no hard-coded localhost in PHP links (`home_url()` / `get_permalink()`).
- Browser verification is mandatory: open in **Google Chrome** at 1440, 1280, 768 and 390 CSS px, zoom 100%, capture entire page and key sections, test UI interactions and check console. If browser access needs permission, ask the user; do not claim verification that did not happen.
- Each milestone deliverable: screenshots, exact changed files, interactions tested, visual differences, missing official content, regression check and STOP for approval.
