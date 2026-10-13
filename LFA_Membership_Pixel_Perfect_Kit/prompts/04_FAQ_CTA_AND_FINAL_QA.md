# TASK 04 — FAQ + FINAL MEMBERSHIP CTA + SHARED FOOTER + FULL PAGE QA

## FAQ
Reference: `references/approved_sections/08_faq.png`
- White background and TWO columns: left ~33% intro, right ~67% accordion.
- Left: FAQ eyebrow, navy heading 'Membership FAQs', short description and red underline.
- Right: six tight, pale-gray horizontal accordion rows, plus icon right. Avoid giant blank margins and remove current extra contact prompt not in approved composition.
- Accordion must work via accessible button semantics, `aria-expanded`, keyboard navigation; avoid broken interactions.

## CTA
Reference: `references/approved_sections/09_final_cta.png`
- MUST be crimson/burgundy with subtle group/crowd background (refer to client-supplied event photos), not the global homepage's navy skyline banner.
- Left white group icon; thin divider; gold eyebrow JOIN OUR ALUMNI FAMILY; bold serif 'Be Part of Something Greater.' and short copy.
- Right two buttons: red Become a Member, outlined Contact Us. Keep all content on same row desktop.
- Build a Membership-specific CTA instance; do not modify globally shared CTA used on homepage/About/Leadership.
- On mobile, stack icon/text/buttons cleanly.

## Footer
Reference: `references/approved_sections/10_footer.png`
- Reuse already-approved global footer. Do NOT recreate or change its global CSS. Ensure no extra margins or member styles bleed into it.

## Mandatory full-page verification
1. Open Chrome on `/membership/`. Request browser permission if required; never claim verification without it.
2. Capture 1440x900 full-page screenshot at 100% zoom (and 1280, 768, 390 checks).
3. Side by side compare EVERY section against all 11 approved reference crops.
4. Check typography, grid columns, approximate proportional section heights, images, heading wraps, buttons, padding, nav and responsive.
5. Verify URL routing and no broken/static fake-success CTAs.
6. Regression: homepage, About, Leadership unchanged.
7. Deliver screenshot, section-specific mismatch table, changed files, remaining issues and scope proof. STOP for user approval. Do not begin next page/backend.