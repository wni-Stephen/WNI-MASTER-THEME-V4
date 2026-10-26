# WebsiteNI Starter Theme V4

## Stack
- WordPress
- Tailwind CSS v4
- Vite
- ACF Pro / ACF Extended
- Vanilla JavaScript
- GSAP

## Requirements

## Getting Started

## Development Commands

## Theme Structure

## CSS Architecture

## JavaScript Architecture

Frontend modules use vanilla JavaScript. Navigation and search share `modules/overlay.js` for Tab containment, Escape, focus restoration and background `inert` state. Open overlays pause an active ScrollSmoother instance.

Smooth scrolling is disabled by default. Enable it per project in `functions.php`:

```php
add_filter('websiteni_smooth_scroll_enabled', '__return_true');
```

Reduced-motion preferences still disable smooth scrolling and entrance animations. GSAP entrance animations remain available independently.

`searchform.php` contains the reusable form. `components/search-overlay.php` renders the site overlay once through the footer. Use `get_search_form()` for additional standalone forms.

SVG replacement preserves image accessibility attributes and uses non-empty alt text as the accessible name. Empty-alt images are decorative unless explicitly named with ARIA.

## Flexible Content

## Reusable Components

## Starting a New Client Project

Theme activation leaves homepage settings untouched. To create or reuse a Home page and set it as the homepage, visit **Tools → Starter Setup** and select **Set up homepage**. Existing static homepage assignments are preserved. The action opens Reading Settings so you can verify the result.

After changes, test menu and search with Tab, Shift+Tab and Escape, focus restoration, nested submenus, standalone search forms, decorative and meaningful SVGs, and scrolling with reduced motion enabled.

## Build / Deployment

## Coding Standards
