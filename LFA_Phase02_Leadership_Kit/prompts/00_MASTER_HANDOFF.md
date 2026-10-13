# Antigravity MASTER HANDOFF — Phase 02 / Leadership Page

The user has formally approved the homepage and About Us page. Begin only `/leadership/` as frontend-only static WordPress implementation.

## Mandatory constraints
1. Existing client-approved homepage and About must remain unchanged. Before editing, inspect Git diff and save current baseline; do not overwrite shared tokens/globals casually.
2. Reuse the actual custom WordPress PHP theme, current header/footer, assets loading, breakpoints, typography, container utilities and existing CTA markup.
3. DO NOT use Elementor, Next.js, headless architecture, a page builder, separate demo React app, or the concept image as a flattened background.
4. Read `docs/DESIGN_SPEC.md`, `docs/CONTENT_AND_ASSETS.md`, concept image, and the client-approved homepage screenshot.
5. The concept image has fictional faces/names in its cards. They are NOT client data. Use explicit placeholders and a real portrait ONLY for Dr. Evans Akpo.
6. Scope CSS to `.lfa-leadership`. No selectors that inadvertently restyle the homepage and About page.
7. Static array or WP theme temporary fixtures are fine; do NOT implement registration, payments or backend admin CRUD yet.
8. Complete one sub-task at a time and STOP for developer approval after each.
9. For each task use GOOGLE CHROME to inspect the actual WordPress site. Ask user to grant required browser permissions. Never say Chrome verification occurred without actually using it.
10. On completion output: screenshots at 1440px desktop and 390px mobile; changed file list; measured geometry; remaining differences; confirmation other approved pages unchanged.

## Recommended file structure
Within the existing theme, following its conventions:
```
page-leadership.php                 # WP recognized slug template, only if not already present
assets/css/pages/leadership.css    # or existing build-system equivalent
template-parts/leadership/hero.php
template-parts/leadership/president.php
template-parts/leadership/organization.php
template-parts/leadership/executive.php
template-parts/leadership/board.php
template-parts/leadership/committees.php
template-parts/leadership/network.php
```
Never create a second root WordPress site. Keep all changes in the current project.

## Work order
Task 01 Hero + President -> screenshot -> approval.
Task 02 Structure + Executives + Trustees -> screenshot -> approval.
Task 03 Committees + Chapters + existing CTA and footer -> screenshot -> approval.
Task 04 Full page responsive Chrome QA -> final approval gate.
