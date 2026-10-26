# WebsiteNI V4 Tailwind migration patch

This ZIP contains the files that should replace their matching files in `WNI-MASTER-THEME-V4`.

## What changed

- Foundation layout classes replaced with Tailwind utilities in the shared/root templates.
- Foundation JS initialisation and `what-input` dependency removed from the frontend entry point.
- `show-for-sr` replaced with Tailwind `sr-only`.
- WebsiteNI 1740px container retained as the `site-container` Tailwind utility.
- V3 grid gutters retained: 20px by default and 30px from 640px upward.
- Tailwind v4 design tokens and baseline component styles added to `assets/styles/app.css`.
- Duplicate mobile-navigation event handlers removed from `assets/scripts/functions.js`.
- Responsive embeds retained without Foundation.
- Stylelint changed from the SCSS-specific preset to plain CSS linting.

## Files/folders to remove after replacing these files

Once the new build is working, remove the legacy SCSS tree:

`assets/styles/scss/`

Do not remove it until you are happy that any project-specific styles you still want have been migrated.

## Dependencies that should no longer exist

- `foundation-sites`
- `what-input`
- `sass`
- `stylelint-config-recommended-scss`
- `autoprefixer` (not needed for this Tailwind v4 Vite setup)
- `postcss` (unless another project-specific tool needs it)

## After copying the patch

Run:

```bash
npm install
npm run build
npm run lint
```

The build should continue to output:

- `assets/dist/style.css`
- `assets/dist/script.js`

## Important

The ZIP intentionally contains the files that change for the migration rather than duplicate unchanged images, ACF JSON, app modules, PHP libraries, and other V4 files. Copy it over the V4 theme root and keep all unchanged V4 files in place.
