export default function initInlineSvg() {
	const images = document.querySelectorAll('img.editsvg[src$=".svg"]');

	images.forEach(async (image) => {
		const url = image.getAttribute('src');

		if (!url) {
			return;
		}

		try {
			const response = await fetch(url);

			if (!response.ok) {
				return;
			}
			const svgText = await response.text();
			const parser = new DOMParser();
			const documentSvg = parser.parseFromString(svgText, 'image/svg+xml');
			const svg = documentSvg.querySelector('svg');

			if (!svg || documentSvg.querySelector('parsererror')) {
				return;
			}

			if (image.id) {
				svg.id = image.id;
			}

			if (image.className) {
				svg.setAttribute(
					'class',
					`${image.className} replaced-svg`
				);
			}
			svg.removeAttribute('xmlns:a');
			svg.setAttribute('focusable', 'false');
			for (const attribute of image.attributes) {
				if (attribute.name.startsWith('aria-') || attribute.name === 'role') {
					svg.setAttribute(attribute.name, attribute.value);
				}
			}
			const alt = image.getAttribute('alt');
			const hasName = image.hasAttribute('aria-label') || image.hasAttribute('aria-labelledby');
			if (alt === '' && !hasName) {
				svg.setAttribute('aria-hidden', 'true');
			} else if (alt || hasName) {
				if (!image.hasAttribute('role')) svg.setAttribute('role', 'img');
				if (!hasName) svg.setAttribute('aria-label', alt);
			}
			image.replaceWith(svg);
		} catch {
			// Leave the original image in place.
		}
	});
}
