import $ from 'jquery';

export default function initInlineSvg() {
	$('img.editsvg[src$=".svg"]').each(
		function () {
			const $img = $(this);
			const imgID = $img.attr('id');
			const imgClass = $img.attr('class');
			const imgURL = $img.attr('src');

			$.get(
				imgURL,
				function (data) {
					const $svg = $(data)
						.find('svg');

					if (imgID) {
						$svg.attr(
							'id',
							imgID
						);
					}

					if (imgClass) {
						$svg.attr(
							'class',
							`${imgClass} replaced-svg`
						);
					}

					$svg.removeAttr('xmlns:a');

					$img.replaceWith($svg);
				},
				'xml'
			);
		}
	);
}