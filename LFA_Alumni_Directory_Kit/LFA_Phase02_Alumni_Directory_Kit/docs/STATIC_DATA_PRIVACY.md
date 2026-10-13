# Critical data and privacy rules

1. The illustrative concept has fake alumni names, people images, class years, places, social/contact buttons and count. None of it is verified. Do not publish those values as real identities.
2. Frontend fixtures should be explicitly marked `DEMO DATA` and use neutral avatar initials or silhouette, fabricated category values clearly marked sample. Do not mix actual client people photos into fictional member profile cards.
3. There is no confirmed directory visibility policy yet. Proposed secure future design: authenticated approved members may access opted-in member fields; public visitors see explanation and join/login CTA; contact info is private by default.
4. In future backend, filtering, pagination and access rules are enforced server-side. Frontend hiding and JS filtering are NOT privacy controls.
5. GDPR/privacy needs client policy and counsel; implement user consent and withdrawal only in backend phase. No unverified legal claims.
6. No live personal data from legacy alumni databases should be bundled in frontend JavaScript or public assets.
7. Do not invent social URLs, member emails, testimonials, professional affiliations, directory counts or alumni IDs.
8. If a CTA target page is not implemented, show a meaningful static preview button or available route rather than a 404 link.
