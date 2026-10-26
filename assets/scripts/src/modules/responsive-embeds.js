export default function initResponsiveEmbeds() {
	const embeds = document.querySelectorAll('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]');

	embeds.forEach((iframe) => {
		if (
			iframe.parentElement?.classList.contains('responsive-embed')
		) {
			return;
		}
		const width = parseFloat(
			iframe.getAttribute('width')
		);
		const height = parseFloat(
			iframe.getAttribute('height')
		);
		const isWidescreen = (
			!height
			|| (width / height) > 1.5
		);
		const wrapper = document.createElement('div');
		wrapper.classList.add('responsive-embed');

		if (isWidescreen) {
			wrapper.classList.add('widescreen');
		}

		iframe.parentNode.insertBefore(wrapper, iframe);
		wrapper.appendChild(iframe);
	});
}
