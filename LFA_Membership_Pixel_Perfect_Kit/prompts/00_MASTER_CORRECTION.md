# ANTIGRAVITY — PHASE 02 MEMBERSHIP PAGE: STRICT VISUAL MATCH

PROJECT: Love Family Alumni — North America Zone
PAGE: `/membership/` on the EXISTING local WordPress site.
STATUS: Homepage, About and Leadership are already approved. Membership mockup has CLIENT approval, but current implementation is visually wrong.

## Read first
- `references/APPROVED_MEMBERSHIP_FULL.png` [only visual source of truth]
- `references/CURRENT_MEMBERSHIP_FULL.png` [current wrong composition]
- `docs/MISMATCH_REPORT.md`
- `docs/SECTION_GEOMETRY.md`
- `docs/ASSET_MAPPING.md`
- `docs/ACCEPTANCE_GATES.md`
- all per-section approved/current reference crops.

## CRITICAL
This is NOT a creative design task. Restore the approved Membership composition, section-by-section. You are allowed to refactor Membership-only templates and styles, but not unrelated website pages. Respect existing custom WordPress theme architecture and reuse approved header/footer. Don't paste any design screenshot as webpage art.

## Procedure
1. Examine existing Membership PHP template parts, stylesheet(s), image paths, route and navbar active state. Make a list of files to change.
2. Open the live local WordPress Membership page in **GOOGLE CHROME**. If browser permission is needed, ASK the user before claiming verification.
3. Capture full page and section screenshots at 1440x900 desktop. Set 100% zoom; use the same viewport for every pass. Also check 1280, 768 and 390 widths.
4. Fix tasks one by one, in this order: (01) Hero+Benefits, (02) Plans+Timeline, (03) Dues+Portal+Gallery, (04) FAQ+CTA+final QA.
5. In each task, compare against that section's approved reference crop. Iterate until composition is closely matched. State remaining differences honestly.
6. Do NOT use current implementation as a style reference. If it disagrees with approved mockup, change it.
7. Do not proceed to the next task before sending comparison screenshots and requesting user approval.

## Scope
- WordPress/PHP theme, no Elementor/page builder/React/Next.js.
- Static/demo content only for this frontend phase.
- No backend auth, registration, dues payment, checkout or fake confirmation.
- No invented fees, statuses, statistics or alumni identities.
- Shared header/footer and other approved pages unchanged.

## Final required output per task
- Before/after screenshot at the same viewport width.
- Approved reference crop alongside rendered output.
- Clear 'corrected' and 'still mismatched' notes.
- Source filenames and changed PHP/CSS/JS list.
- Chrome browser verification evidence (URL, width, screenshot artifacts).
- Explicit stop for user approval.

START NOW WITH `prompts/01_HERO_AND_BENEFITS.md` ONLY.