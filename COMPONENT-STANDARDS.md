# WebsiteNI V4 Component Standards

This document defines the standard approach for building components and Flexible Content layouts in the WebsiteNI V4 WordPress starter theme.

## 1. Core Principles

V4 uses:

- WordPress
- ACF Pro
- Tailwind CSS v4
- Vite
- PHP template components
- Reusable design tokens
- Mobile-first responsive development

Use Tailwind utilities for layout and one-off presentation.

Use custom CSS only for reusable components, global behaviour, WordPress-generated content, or functionality that is clearer as a semantic component.

---

# 2. Stylesheet Structure

```text
assets/styles/
├── app.css
├── theme.css
├── base.css
├── layout.css
└── components/
    ├── buttons.css
    ├── content.css
    ├── forms.css
    └── navigation.css
```

## app.css

Main stylesheet entry point.

Its job is to import Tailwind and the WebsiteNI stylesheets.

Do not place general project styling directly in this file.

## theme.css

Contains project design tokens.

This should be one of the first files edited when starting a new client project.

Examples:

```css
--color-primary
--color-secondary

--font-body
--font-heading

--container-site

--text-h1
--text-h2

--spacing-section-sm
--spacing-section-md
--spacing-section-lg
```

Avoid hard-coded values in templates when an appropriate design token exists.

## base.css

Contains global element defaults.

Examples:

```css
body
h1
h2
h3
a
img
button
input
```

Only place styling here when it should apply automatically across the site.

## layout.css

Contains reusable structural utilities.

Examples:

```text
site-container
responsive-embed
```

Layout-specific Tailwind utilities should normally remain directly in PHP templates.

## components/*.css

Contains reusable visual or behavioural components.

Examples:

```text
.button
.navigation-overlay
.post-card
.accordion-item
```

Do not create custom classes for layouts that Tailwind can express clearly.

---

# 3. Standard Section Structure

Flexible Content layouts should normally use:

```php
<section class="...">

	<div class="site-container">

		<div class="grid grid-cols-12 gap-x-5 sm:gap-x-[30px]">

			<div class="col-span-12">
				...
			</div>

		</div>

	</div>

</section>
```

Standard hierarchy:

```text
section
└── site-container
    └── Tailwind grid
        └── component content
```

---

# 4. Shared Layout Options

Flexible Content sections use the shared layout options system.

Supported options include:

- Section ID
- Background
- Padding Top
- Padding Bottom

Spacing should generate Tailwind token classes such as:

```text
pt-section-sm
pt-section-md
pt-section-lg

pb-section-sm
pb-section-md
pb-section-lg
```

Background classes include:

```text
bg-primary
bg-secondary
bg-tertiary
bg-quaternary
bg-quinary
bg-senary
bg-white
bg-black
```

---

# 5. ACF Field Naming

Use consistent field names across components.

| Purpose | Field Name |
|---|---|
| Eyebrow / small heading | `eyebrow` |
| Main heading | `heading` |
| Main content | `content` |
| Main image | `image` |
| Primary button | `button` |
| Secondary button | `secondary_button` |
| Repeater | `items` |
| Link | `link` |
| Video | `video` |

Inside repeaters, prefer the same conventions:

```text
heading
content
image
link
```

Avoid unnecessary variations such as:

```text
title
section_title
main_heading
headline
```

when `heading` would work.

---

# 6. Tailwind vs Custom CSS

## Use Tailwind for

Layout:

```html
grid
grid-cols-1
lg:grid-cols-2
gap-10
items-center
```

Spacing:

```html
mt-8
mb-5
gap-6
py-section-lg
```

Responsive behaviour:

```html
hidden
lg:block
sm:grid-cols-2
lg:grid-cols-4
```

One-off styling:

```html
aspect-[4/3]
object-cover
absolute
inset-0
```

## Use custom CSS for

Reusable components:

```text
.button
.post-card
.navigation-overlay
.accordion-item
```

WordPress-generated content:

```text
single-entry-content
content-block__content
```

Complex reusable behaviour that is clearer as a named component.

---

# 7. Avoid Arbitrary Values Where Possible

Prefer:

```html
bg-primary
text-h2
py-section-lg
```

instead of:

```html
bg-[#0060dd]
text-[56px]
py-[85px]
```

Project-wide values should normally live in `theme.css`.

---

# 8. Static Tailwind Classes

Tailwind classes used in PHP must be statically detectable.

Do not build classes like:

```php
$class = 'bg-' . $background;
```

Instead use complete class mappings:

```php
$backgrounds = array(
	'primary'   => 'bg-primary',
	'secondary' => 'bg-secondary',
	'white'     => 'bg-white',
	'black'     => 'bg-black',
);
```

This ensures Tailwind includes the classes in the compiled stylesheet.

---

# 9. Breakpoints

V4 uses:

```text
Default     < 640px
sm          640px
md          768px
lg          1024px
xl          1200px
2xl         1440px
3xl         1740px
```

Build mobile-first.

Example:

```html
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
```

means:

```text
Mobile      1 column
640px+      2 columns
1024px+     4 columns
```

---

# 10. Buttons

Standard button:

```html
<a class="button" href="#">
	Learn More
</a>
```

Variants:

```html
<a class="button button-secondary" href="#">
	Learn More
</a>
```

```html
<a class="button button-outline" href="#">
	Learn More
</a>
```

```html
<a class="button button-white" href="#">
	Learn More
</a>
```

Where possible, reusable PHP should use:

```text
components/button.php
```

rather than repeating button markup.

---

# 11. Images

Use WordPress attachment IDs and `wp_get_attachment_image()` where possible.

Prefer this over manually outputting image URLs because WordPress can provide:

- responsive `srcset`
- image sizes
- width and height
- better optimisation compatibility

Use the reusable:

```text
components/image.php
```

when appropriate.

Tailwind should control presentation:

```html
aspect-[4/3] w-full object-cover
```

---

# 12. Headings

Use semantic HTML heading levels first.

Do not choose heading elements based purely on visual size.

For example:

```html
<h2 class="text-h1">
```

is acceptable when the semantic heading level is `h2` but the design requires the visual H1 size.

Reusable section headings should use:

```text
components/section-heading.php
```

where practical.

---

# 13. Content

WYSIWYG content should normally sit inside a recognised content container:

```html
<div class="content-block__content">
```

or:

```html
<div class="single-entry-content">
```

These containers provide styling for WordPress-generated:

- paragraphs
- lists
- headings
- links
- blockquotes
- tables

Do not require editors to add Tailwind classes to WYSIWYG content.

---

# 14. Component Naming

Component PHP files use lowercase kebab-case:

```text
section-heading.php
image-content.php
call-to-action.php
```

CSS component classes should also be descriptive:

```text
post-card
accordion-item
navigation-overlay
```

Avoid vague names such as:

```text
box
block2
section-left
blue-area
```

---

# 15. Flexible Content Layouts

Flexible Content templates live in:

```text
components/layouts/
```

Current starter layouts include:

```text
content.php
hero.php
image-content.php
cards.php
cta.php
accordion.php
```

The ACF layout name must match the PHP filename.

Example:

```text
ACF layout name:
image-content

Template:
components/layouts/image-content.php
```

---

# 16. Component PHP

Reusable PHP components live directly inside:

```text
components/
```

Examples:

```text
button.php
image.php
card.php
breadcrumbs.php
section-heading.php
```

These should contain small reusable pieces of UI rather than complete page sections.

---

# 17. Accessibility

All components should consider:

- semantic HTML
- correct heading hierarchy
- keyboard navigation
- visible focus states
- meaningful image alt text
- `aria-expanded` where appropriate
- `aria-controls` where appropriate
- accessible labels for icon-only buttons
- reduced-motion preferences for animation

Accessibility should be built into the component rather than added later.

---

# 18. JavaScript

JavaScript should progressively enhance components.

The underlying HTML should remain as useful as reasonably possible without JavaScript.

Avoid inline scripts inside PHP templates.

Reusable frontend behaviour belongs under:

```text
assets/scripts/
```

As V4 develops, larger features should be split into dedicated modules rather than continuously expanding `functions.js`.

---

# 19. Animation

GSAP is available for animation.

Use animation deliberately.

Prefer reusable animation hooks such as:

```text
fade-up
fade-in
fade-left
fade-right
scale-in
animation-stagger
```

Respect:

```css
prefers-reduced-motion
```

Do not add motion purely because GSAP is available.

---

# 20. Starting a New WebsiteNI Project

Recommended order:

1. Clone the V4 starter theme.
2. Update theme metadata.
3. Update `theme.css`.
4. Set client colours.
5. Add client fonts.
6. Adjust typography tokens.
7. Adjust section spacing if required.
8. Configure global site options.
9. Build from existing Flexible Content layouts.
10. Create new layouts only where the design requires them.
11. Reuse existing PHP components wherever possible.
12. Run the build and lint checks before deployment.

---

# 21. Core Rule

The V4 approach is:

> Design tokens control the system. Tailwind controls layout. PHP components provide reusable structure. Custom CSS is reserved for reusable appearance and behaviour.

When adding something new, first ask:

1. Can an existing component handle this?
2. Can Tailwind express the layout cleanly?
3. Does this value belong in `theme.css`?
4. Is custom CSS genuinely reusable?
5. Will another developer or AI understand this implementation later?