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
			image.replaceWith(svg);
		} catch {
			// Leave the original image in place.
		}
	});
}
