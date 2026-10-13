# Geometry & proportion guide

The **approved design reference** is a 778 × 2022 screenshot. The **current running capture** is 396 × 2048. These are not equivalent Chrome captures. Ratios below are approximate, for proportional reconstruction ONLY.

Target section bands in approved screenshot:

| Section | Reference y | Reference height (px) | Height / screenshot width | Approx height at 1440px if proportionally scaled |
|---|---:|---:|---:|---:|
| Shared Header | 0–65 | 65 | 0.084 | 120 |
| Hero | 65–343 | 278 | 0.357 | 515 |
| Benefits | 343–561 | 218 | 0.280 | 403 |
| Membership Plans | 561–839 | 278 | 0.357 | 515 |
| How It Works | 839–1054 | 215 | 0.276 | 398 |
| Dues | 1054–1247 | 193 | 0.248 | 357 |
| Member Portal | 1247–1413 | 166 | 0.213 | 307 |
| Gallery | 1413–1575 | 162 | 0.208 | 300 |
| FAQ | 1575–1725 | 150 | 0.193 | 278 |
| Membership CTA | 1725–1819 | 94 | 0.121 | 174 |
| Shared footer | 1819–2022 | 203 | 0.261 | 376 |

At a 1440px Chrome viewport, use these numbers to establish section proportions. They are guidance, NOT inflexible pixel heights; use content-driven min-heights, so no cropping/overflow on smaller screens.

General layout:
- Desktop container: match approved global theme, approximately 1200–1280px max.
- Approved content starts ~50px from left in 778px reference (~6.4% of width). Do not adopt screenshot pixel offset directly.
- Hero: photo fills entire hero; text anchored left inside container; image subjects mostly in right half.
- Benefits: 6 columns on desktop, 3 columns tablet, 1–2 columns mobile based on legibility.
- Plans: 3 columns `[intro, individual, couple]` desktop, stack on narrow screens.
- Process: 4 connected steps desktop; stack with left connector mobile.
- Dues: 3 editorial columns desktop; stack with logical reading order mobile.
- Portal: left intro roughly 28%, right grid roughly 72%; 4 columns x 2 rows desktop.
- Gallery: 3 equal horizontal image frames desktop; stacked mobile.
- FAQ: left intro approx 32%, right list approx 68%; stacked mobile.

Use section-scoped CSS under `.lfa-membership`. DO NOT alter shared header, footer or global container tokens to compensate for page-specific geometry.

Reference mockup typography will not match standard browser rasterization exactly; visually prioritize type scale, hierarchy, line wrapping, alignment, contrast and whitespace. Do not report 'zero visual difference' unless actually supported by browser comparison.