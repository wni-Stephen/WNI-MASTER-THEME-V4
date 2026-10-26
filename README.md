# WebsiteNI Starter Theme V4

## Stack
- WordPress
- Tailwind CSS v4
- Vite
- ACF Pro
- Vanilla JavaScript
- GSAP

## Requirements

- A working WordPress installation with a compatible PHP/database environment.
- ACF Pro for Flexible Content, Clone fields and theme options. ACF Extended is not required.
- Node.js matching `package.json`: `>=20.19.0 <21 || >=22.12.0`, plus npm, on the development/build machine.
- Composer and PHP CLI if running the PHP coding-standards check. Node and Composer are not needed on the production server when deploying compiled assets.

## Getting Started

1. Put the theme in `wp-content/themes/WNI-MASTER-THEME-V4`.
2. Run `npm ci` and `npm run build` from the theme directory.
3. Install and activate your licensed copy of ACF Pro, then activate the theme.
4. In ACF, sync the bundled Local JSON groups when offered. Check that Page Content and Component: Layout Options are available.
5. Assign the primary/mobile and secondary/desktop navigation locations and set the site logo.
6. Configure fonts in `app/assets.php` and colours/spacing in `assets/styles/theme.css`.
7. Optionally use **Tools → Starter Setup** to configure a static homepage, then add page layouts.

## Development Commands

```sh
npm ci
npm run dev
npm run build
npm run lint:js
npm run lint:css
```

`dev` and `watch` both rebuild files on change; they do not start WordPress or a separate preview server. Refresh the WordPress page to view changes.

For PHP standards tooling, run `composer install`, then `npm run lint:php`. `npm run lint` runs all three linters. PHP standards currently report outstanding issues; this pass does not change their configuration.

## Theme Structure

- `app/`: theme setup, assets, ACF, admin tools and helpers.
- `acf-json/`: version-controlled ACF field definitions.
- `components/`: shared templates; `components/layouts/` contains the six page-builder layouts.
- `assets/styles/`: Tailwind entry point, tokens, base styles and components.
- `assets/scripts/src/`: frontend entry point and vanilla JavaScript modules.
- `assets/dist/`: compiled `style.css` and `script.js` enqueued by WordPress.
- Root PHP files: WordPress template hierarchy, header and footer.

## CSS Architecture

`app.css` contains imports only. Edit tokens in `theme.css`, global elements in `base.css` and feature styles in `components/`. Reduced-motion overrides disable CSS smooth scrolling and reduce animations/transitions.

### Fonts

Configure project fonts only in `websiteni_get_font_config()` in `app/assets.php`:

- `google_fonts_enabled`: enables the Google Fonts stylesheet and preconnect hints.
- `google_fonts_url`: specifies the font families and weights to load.
- `body_stack` and `heading_stack`: define the complete CSS font stacks, including fallbacks.

The default is Open Sans for both body text and headings. PHP outputs `--wni-font-body` and `--wni-font-heading` alongside the main stylesheet. Base styles use these variables directly; `theme.css` maps Tailwind's `font-body` and `font-heading` utilities to them without defining separate stacks.

To use system fonts, disable Google Fonts and update both stacks here. Disabling Google Fonts does not change the stacks automatically. Font configuration changes in PHP do not require a Vite rebuild; CSS changes do.

## JavaScript Architecture

Frontend modules use vanilla JavaScript. The document starts with `no-js`; successful menu/search initialisation switches it to `js`, hiding the fixed native menu/search fallback and revealing interactive controls. The fallback stays outside document flow, and hidden interactive controls retain their space to avoid shifting the header during startup. Navigation and search share `modules/overlay.js` for Tab containment, Escape, focus restoration and background `inert` state. Open overlays pause an active ScrollSmoother instance.

Smooth scrolling is disabled by default. Enable it per project in `functions.php`:

```php
add_filter('websiteni_smooth_scroll_enabled', '__return_true');
```

Reduced-motion preferences still disable smooth scrolling and entrance animations. GSAP entrance animations remain available independently.

`searchform.php` contains the reusable form. `components/search-overlay.php` renders the site overlay once through the footer. Use `get_search_form()` for additional standalone forms.

SVG replacement preserves image accessibility attributes and uses non-empty alt text as the accessible name. Empty-alt images are decorative unless explicitly named with ARIA.

## Flexible Content

ACF Pro is required for the page builder. ACF Extended is not a default dependency or recommendation.

Every bundled layout includes a standard `layout_options` Clone field referencing **Component: Layout Options** (`group_wni_layout_options`). It uses Group display, Block layout and prefixed field names. Edit the shared group to change the Section ID, Background, Padding Top and Padding Bottom controls across all layouts. PHP reads the options with `get_sub_field('layout_options')`.

On an existing installation, sync **Page Content** from the theme's Local JSON in ACF before editing pages. Add a layout, save it and reload to check that its options persist with ACF Extended disabled. Existing values saved through the old settings modal are not automatically migrated into the new prefixed fields; transfer those values before removing ACF Extended from an existing project. No live database changes are performed by this theme update.

## Reusable Components

Use `get_template_part()` with an arguments array for shared buttons, images and section headings. See each component's defaults and `COMPONENT-STANDARDS.md` for conventions.

```php
get_template_part('components/button', null, array(
    'url' => home_url('/contact/'),
    'text' => 'Contact us',
    'style' => 'outline',
));
```

Button styles are `primary`, `secondary`, `outline` and `white`. Keep complete Tailwind class names in PHP maps so the build can discover them.

## Starting a New Client Project

Theme activation leaves homepage settings untouched. To create or reuse a Home page and set it as the homepage, visit **Tools → Starter Setup** and select **Set up homepage**. Existing static homepage assignments are preserved. The action opens Reading Settings so you can verify the result.

After changes, test menu and search with Tab, Shift+Tab and Escape, focus restoration, nested submenus, standalone search forms, decorative and meaningful SVGs, and scrolling with reduced motion enabled.

## Build / Deployment

1. Run `npm ci`, `npm run build`, `npm run lint:js` and `npm run lint:css`.
2. Deploy the theme PHP files, root `style.css`, `screenshot.png`, `modules/`, `acf-json/`, `assets/images/` and both compiled files in `assets/dist/`. Retain source/configuration files in version control for future builds.
3. Do not deploy `node_modules/`, development `vendor/`, `.git/` or local credentials.
4. Sync updated ACF groups deliberately on the destination after reviewing existing fields/content. JSON deployment does not migrate content values.
5. Clear site/CDN caches and test the frontend, search, menus and page-builder output. Asset URLs use file modification times for cache versioning.

### ACF Pro verification

On a test site with ACF Extended disabled, add each of Content, Hero, Image Content, Cards, CTA and Accordion to a draft page. Fill representative content and set a unique section ID, background and top/bottom padding for each. Save, reload the editor and confirm every option persists. Preview the page and inspect its IDs, colours and spacing. Repeat with two instances of the same layout to check that their settings remain independent. Test adding, reordering and removing rows.

Static JSON/PHP checks do not replace this WordPress round-trip test.

### Frontend verification

Check all button variants in default, hover and keyboard-focus states. On mobile, expand nested submenus and scroll a menu taller than the viewport. Verify Tab/Shift+Tab containment, Escape and focus restoration. Repeat scrolling with the optional GSAP smoother enabled. Disable JavaScript and confirm the fallback menu, nested links and search form work. Enable reduced motion and check anchors and animations.

## Coding Standards

Use compact, readable PHP, HTML, CSS and JavaScript; add blank lines between logical sections. Escape output for its context. Use descriptive hyphen-separated frontend class names. Preserve existing behaviour when tidying code and avoid unnecessary helpers. Keep project-specific configuration documented in its source file.

### Image loading overrides

`components/image.php` uses `websiteni_get_image()` for attachment resolution and responsive markup. Leave `loading` and `fetchpriority` unset (or null) for WordPress defaults. No eager loading is forced.

```php
get_template_part('components/image', null, array(
    'image' => $image,
    'size' => 'large',
    'loading' => 'eager',
    'fetchpriority' => 'high',
));
```

Use that override only for an important above-the-fold image. Supported values are `lazy`/`eager` for loading and `high`/`low`/`auto` for fetch priority. Invalid values fall back to WordPress defaults. If `lazy` and `high` are combined, the helper drops high priority. The same attributes work in the third argument to `websiteni_get_image()`.

Omit `alt` to use the attachment's alternative text; explicitly pass an empty string for a decorative image.
