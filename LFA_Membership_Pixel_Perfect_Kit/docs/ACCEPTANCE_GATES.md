# Stage gates and no-regression rules

At each gate:
1. Verify Chrome actually opened the local WordPress page.
2. Capture screenshot for viewport 1440x900 at 100% zoom / DPR 1 where possible, full-page and section crops.
3. Check at 1280px, 768px and 390px, avoid overflow.
4. Compare the ACTUAL implemented section structure with the approved corresponding cropped reference.
5. Document objective mismatches and rework until major layout, crop and font problems are resolved.
6. Keep changes scoped to Membership page.
7. Confirm homepage, About and Leadership are still visually intact.
8. Stop if missing originals or inaccessible browser prevents a reliable match; ask user.
9. Do not give unsupported percentage similarity or absolute 'pixel-perfect' assertions.

Acceptance by section:
- Hero: five-person photo fills full hero; navy left gradient; left heading and 2 CTAs; stacked value words on right; no floating boxed photo/card.
- Benefits: six filled circle icons in ONE row under split heading on desktop.
- Plans: left editorial intro + two near-equal cards; no centered heading above, no invented fee or 'recommended' claim.
- Process: 4 numbered stages connected by a thin horizontal line; no rectangle cards.
- Dues: intro + pending dues box + feature list, three zones.
- Portal: white background; intro left and 8 COMPACT white cards arranged 4x2 on right.
- Gallery: three equal landscape cards in ONE row desktop.
- FAQ: intro left; six compact list rows on right.
- Membership CTA: crimson group/crowd banner; two buttons right.
- Footer: existing approved global footer unchanged.

Any missing client information should stay 'To be confirmed' or other clearly neutral frontend demo copy. No real checkout or registration completion this phase.