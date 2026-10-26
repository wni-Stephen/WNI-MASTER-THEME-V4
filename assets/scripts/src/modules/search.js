import $ from 'jquery';

export default function initSearch() {
	const $search = $('.search');

	if (!$search.length) {
		return;
	}

	let searchTrigger = null;

	$('.search-open').on(
		'click',
		function (event) {
			event.preventDefault();

			searchTrigger = this;

			$search.attr(
				'aria-hidden',
				'false'
			);

			$('body').addClass(
				'search-is-active'
			);

			setTimeout(function () {
				$('.search-input')
					.first()
					.trigger('focus');
			}, 100);
		}
	);

	function closeSearch() {
		$search.attr(
			'aria-hidden',
			'true'
		);

		$('body').removeClass(
			'search-is-active'
		);

		if (searchTrigger) {
			$(searchTrigger).trigger(
				'focus'
			);
		}
	}

	$('.search-close').on(
		'click',
		closeSearch
	);

	$(document).on('keydown', function (event) {
		if (
			event.key === 'Escape'
			&& $('body').hasClass(
				'search-is-active'
			)
		) {
			closeSearch();
		}
	});
}