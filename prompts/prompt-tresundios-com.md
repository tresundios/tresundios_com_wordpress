# Prompt for Claude Code — tresundios.com (global site, USD)

Copy everything below the line into Claude in VS Code, with the tresundios.com WordPress project open.

---

## Context

You are working on the source code of **tresundios.com**, the global website of Tresundios Software Products and Services Pvt. Ltd. (Chennai, India; CIN U62099TN2024PTC174739; DPIIT-recognised). It is a **WordPress site using a block theme (Full Site Editing)**. Prices on this site are in **USD**. Its audience is international clients for digital marketing, graphic design, event management, websites & apps, product photography, and **DevOps & Cloud**.

The India sister site is **tresundios.in** (INR). Both sites have nearly the same content, which is why we are adding regional SEO signals.

Tresundios is the **exclusive licensee of DentalPin for India** and runs **https://www.dentalpin.in**. On this global site, **DentalPin is NOT sold**. The licence covers India only. Here it's a **case study that shows our engineering, localisation, and DevOps skills**. Never say or imply that Tresundios can license, sell, or support DentalPin outside India. The original DentalPin project is at https://dentalpin.com.

Facts you may use in the case study (use only these; do not invent results, client numbers, uptime figures, or metrics):
- DentalPin is dental practice management software; its core is source-available under BSL 1.1. The stack is **FastAPI + Nuxt + PostgreSQL**.
- Tresundios maintains an India fork and built the India edition: a **Razorpay payment gateway module** (mark as `[[STATUS: live / in development]]`), **GST billing**, **WhatsApp reminders**, an **interface in 7 Indian languages**, and an **AI assistant** (`[[CONFIRM: which of these Tresundios built vs. upstream]]`).
- Deployment: **Docker + Coolify on AWS EC2 in ap-south-1 (Mumbai)**, built from source on the server, with a public demo at dentalpin.in that resets every night.
- Wherever a number would help (load time, cost, clinics onboarded), add `<!-- TODO: add real metric -->` instead of a figure.

Brand identity (use the theme.json presets; do not hard-code new values if presets exist):
- Primary: terracotta `#C84734`
- Headings: Space Grotesk · Body: Inter · Code/tech labels: JetBrains Mono

## Step 0 — Inspect before changing anything

Do not edit files until you have reported back on:
1. The theme folder (`wp-content/themes/<theme>/`): `theme.json`, `templates/`, `parts/`, `patterns/`, `functions.php`, `inc/`.
2. **How the "Work" section and any case studies are built.** Is it a custom post type, posts in a category, a Query Loop, or static patterns? The new case study must follow the same system, so it shows up wherever existing work items appear.
3. How the header navigation is built: inline `core/navigation-link` blocks in `parts/header.html`, or a `core/navigation` `ref` to a database `wp_navigation` post.
4. Whether an SEO plugin (Yoast, Rank Math, SEOPress, AIOSEO) is active and what it already outputs (canonical, hreflang, JSON-LD). **No duplicate tags.**
5. The current canonical tag (the live site outputs `https://tresundios.com/`, without www). Tell me whether the site URL is the www or non-www version and whether redirects are consistent. **Don't change the domain setting.** Just report it, because hreflang URLs must match the canonical host exactly.
6. Whether `wp-content/mu-plugins/` exists.

Then give me a short plan listing every file you'll create or change, and wait for my OK.

## Tasks

### 1. Case study: "DentalPin India: localising and deploying open-source clinic software for India"
- Create it **in the same system as the existing Work items** (see Step 0.2). Suggested slug: `/work/dentalpin-india/`.
- If work items are patterns, create `patterns/case-study-dentalpin.php` (category `tresundios`). If they're posts or a CPT, give me the block markup to paste and a WP-CLI command to create it as a **draft**.
- Sections:
  1. **Hero:** H1, a one-line summary, tags in JetBrains Mono (`FastAPI · Nuxt · PostgreSQL · Docker · Coolify · AWS Mumbai · Razorpay`), and a hero image placeholder.
  2. **The brief:** Indian dental clinics need software that works with GST, WhatsApp, regional languages, and Indian payment rails. Tresundios secured the exclusive India licence.
  3. **What we built:** a localisation layer, the Razorpay gateway module, GST billing, and multi-language UI (subject to the `[[CONFIRM]]` above).
  4. **How we run it (DevOps):** a simple architecture diagram built as an inline SVG or a list-style flow (User → Nuxt frontend → FastAPI → PostgreSQL, containerised with Docker, orchestrated by Coolify on EC2 in Mumbai, nightly demo reset). Keep it **CSS/SVG only, no image dependency**, and accessible with `role="img"` + `aria-label`.
  5. **Results:** `<!-- TODO -->` placeholders only.
  6. **Services used:** link to the Websites & Apps, Custom Software & APIs, and DevOps & Cloud sections on this site.
  7. **CTA band:** "Need software localised or deployed for a new market?" → **Book a free call** (reuse the existing Google Calendar booking link). Secondary text link: "See DentalPin India live (for clinics in India) → dentalpin.in".
  8. **Small note at the bottom:** "Tresundios is the exclusive licensee of DentalPin for India. Outside India, see dentalpin.com."
- Copy: confident, specific, technical enough to persuade a CTO, readable by a founder. No superlatives, no invented outcomes.

### 2. Make it visible
- Add the case study to the homepage **Work** section and the Work listing (it should appear automatically if Step 0.2 is a query; if it isn't, add it manually).
- Add a short **"Products we build and run"** strip on the About page (or under Process; suggest the best place). It holds one card, DentalPin India, with the line "Our India product" linking to the case study, not directly to dentalpin.in. Build it as `patterns/products-strip.php`.
- **Do not** add "Products" to the main navigation on this site, and do not create a sales or pricing page for DentalPin here.

### 3. Hreflang + canonical (only if no SEO plugin already handles it)
- Create `wp-content/mu-plugins/tresundios-hreflang.php`, which **must be the same file** used on tresundios.in. It detects the current site from `home_url()` and outputs on every page:
  - `hreflang="en"` → tresundios.com URL
  - `hreflang="en-IN"` → tresundios.in URL
  - `hreflang="x-default"` → tresundios.com URL
- Use a filterable path map (`apply_filters( 'tresundios_hreflang_map', [...] )`), defaulting to the same path on both sites. Pages that exist on only one site (for example `/work/dentalpin-india/` here and `/products/dentalpin/` on .in) are either mapped deliberately or left out of the alternate set. Tell me which you chose.
- The hosts in hreflang must exactly match each site's canonical host (www vs non-www, see Step 0.5).
- Each page keeps one self-referencing canonical.
- If an SEO plugin is active, don't write code. Give me the exact plugin settings to change instead.

### 4. Structured data (JSON-LD)
- Sitewide **Organization**: name, legalName, url, logo, address (Chennai 600083, Tamil Nadu, IN), email navis@tresundios.com, `sameAs` → tresundios.in, `brand` → DentalPin India (url https://www.dentalpin.in). Use a stable `@id` (`https://<canonical-host>/#organization`).
- On the case study, add **Article** schema (or CreativeWork) with headline, datePublished, author/publisher = the Organization `@id`, and `about` → a SoftwareApplication node for DentalPin India (url dentalpin.in, `areaServed: "IN"`).
- **Do not** add Offer/price schema for DentalPin on this site.
- Output each schema block once and validate it.

### 5. Links to dentalpin.in
- Use followed links with descriptive anchors. Include the case-study link and the small note at the end. Don't add a sitewide footer link to dentalpin.in on this site. The footer can link to the case study under "Company → Work" if that pattern already exists.

## Constraints
- Use theme.json presets (`var(--wp--preset--…)`). Add new presets only if you have to, and tell me.
- All new blocks must be valid core block markup that opens in the Site Editor with no invalid-block warnings.
- Make it responsive (375 / 768 / 1280px) and accessible (one H1, logical headings, alt text, AA contrast, visible focus states).
- Escape output in PHP patterns (`esc_html__`, `esc_url`) with the theme text domain.
- No new third-party plugins without approval. Don't touch existing USD prices.
- Keep the licence wording exact: **"exclusive licensee of DentalPin for India."**

## Deliverables
1. The Step 0 report and plan (wait for approval).
2. The code changes.
3. A **"Do in WP Admin"** checklist for anything stored in the database (creating the case study as a draft, featured image, category or CPT assignment, menu changes), with WP-CLI equivalents.
4. A test checklist: View Source shows one canonical, three hreflang tags whose hosts match the canonical, and valid JSON-LD (validator.schema.org + Google Rich Results Test); the case study appears in the Work listing; the Site Editor shows no invalid blocks; the diagram is readable on mobile.
5. A list of every `[[PLACEHOLDER]]`, `[[CONFIRM]]`, and `TODO` left for me.
