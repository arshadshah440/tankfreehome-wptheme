# Tank Free Home

A clean, modern WordPress theme built for tankless water heater installation, repair, and maintenance businesses. Every section of every page is field-driven through [Secure Custom Fields](https://www.wpacf.com/) (or ACF Pro, which uses the same API) so the whole site can be edited from wp-admin without touching code, while always falling back to sensible placeholder content when a field is left empty.

## Requirements

- WordPress 6.0+
- PHP 7.4+
- [Secure Custom Fields](https://wordpress.org/plugins/secure-custom-fields/) (or ACF Pro) — required to edit content through wp-admin. Without it, every page still renders using the fallback content defined in `inc/defaults.php`.

## Installation

1. Copy this theme into `wp-content/themes/tank-free-home`.
2. Install and activate **Secure Custom Fields** (or ACF Pro).
3. Activate the theme from **Appearance → Themes**.
4. Under **Settings → Reading**, set "Your homepage displays" to a static page, and assign that page the **Homepage** template (see below).
5. Configure the site under **Theme Settings** in the wp-admin sidebar (Header, Footer, Brand & Contact, Site Sections).

## Page templates

Create a Page in wp-admin and assign one of these under **Page Attributes → Template**:

| Template | File | Purpose |
|---|---|---|
| Homepage | `page-homepage.php` | Hero, About, Expertise, Services, Why Choose Us, Projects, Testimonials |
| About Us | `page-about.php` | Our Story, trust stats, values, credentials, plus the shared Services/Testimonials sections |
| Service Listing | `page-services.php` | Paginated grid of every Service, "Our Process," and Why Choose Us |
| Contact Us | `page-contact.php` | Quick contact info cards + a working contact form (see below) |
| FAQ | `page-faq.php` | Categorized, jump-linked accordion of questions |
| Privacy Policy | `page-privacy.php` | Numbered legal sections with an auto-generated table of contents |
| Location | `page-location.php` | Reusable per service area (e.g. one page per state) — local stats, local insight, service-area cities, local FAQ |

Individual **Service** posts automatically use `single-tfh_service.php` — no template selection needed.

The blog (Settings → Reading → "Posts page") uses `home.php` for the listing and `single.php` for individual posts.

## Custom post types

- **Services** (`tfh_service`, `/services/`) — powers the homepage/Service Listing cards and each service's own detail page.
- **Projects** (`tfh_project`, `/projects/`) — the homepage's project gallery.
- **Testimonials** (`tfh_testimonial`) — customer quotes shown across the homepage, About Us, Service Listing, and single Service pages.

## Site Sections (Theme Settings)

A handful of sections — **Why Choose Us**, **Our Process**, and **Testimonials** — appear on more than one template. Rather than duplicating their content per page, they're edited once under **Theme Settings → Site Sections** and reused everywhere they appear.

## Contact form

`page-contact.php` includes a self-contained contact form (no third-party plugin required). Submissions post to `admin-post.php`, are checked against a nonce and a honeypot field, then emailed via `wp_mail()` to the address set under **Theme Settings → Brand & Contact**. See `inc/contact-form.php`.

## Front-end architecture

- `assets/css/tokens.css` — design tokens (colors, type scale, spacing, radii)
- `assets/css/base.css` — reset, typography, layout helpers, WordPress core classes
- `assets/css/header.css` / `footer.css` — global chrome, loaded on every page
- `assets/css/home.css` — shared section components (cards, grids, the page-header banner) reused across most templates
- One additional stylesheet per template family (`about.css`, `contact.css`, `faq.css`, `privacy.css`, `services.css`, `service.css`, `location.css`, `blog.css`) — loaded only where it's needed, per `inc/enqueue.php`

Reusable markup lives in `template-parts/`, with homepage-style sections grouped under `template-parts/sections/`.

## License

GPL v2 or later, in keeping with the WordPress theme directory guidelines.
