import $ from 'jquery';

export default function initResponsiveEmbeds() {
	$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(
		function () {
			const $iframe = $(this);

			if ($iframe.parent().hasClass('responsive-embed')) {
				return;
			}

			const width = parseFloat(
				$iframe.attr('width')
			);

			const height = parseFloat(
				$iframe.attr('height')
			);

			const isWidescreen = (
				!height
				|| (width / height) > 1.5
			);

			$iframe.wrap(
				`<div class="${
					isWidescreen ? 'widescreen ' : ''
				}responsive-embed"></div>`
			);
		}
	);
}