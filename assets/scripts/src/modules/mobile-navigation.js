import $ from 'jquery';

export default function initMobileNavigation() {
	const $navigation = $('.navigation-overlay');
	const $hamburger = $('.hamburger');

	if (!$navigation.length || !$hamburger.length) {
		return;
	}

	function closeNavigation() {
		$navigation
			.removeClass('is-active')
			.attr('aria-hidden', 'true');

		$hamburger
			.removeClass('is-active')
			.attr({
				'aria-expanded': 'false',
				'aria-label': 'Open menu',
			});

		$('.wrapper').removeClass(
			'hamburger-is-active'
		);

		$('body').removeClass(
			'mobile-nav-is-active'
		);

		$('.submenu-toggle').attr(
			'aria-expanded',
			'false'
		);

		$navigation
			.find('.sub-menu')
			.removeClass('sub-menu-is-active')
			.attr('aria-hidden', 'true');

		$hamburger.first().trigger('focus');
	}

	$hamburger.on('click', function () {
		const $button = $(this);

		const isOpen = !$button.hasClass(
			'is-active'
		);

		$button
			.toggleClass('is-active', isOpen)
			.attr({
				'aria-expanded': isOpen
					? 'true'
					: 'false',
				'aria-label': isOpen
					? 'Close menu'
					: 'Open menu',
			});

		$navigation
			.toggleClass('is-active', isOpen)
			.attr(
				'aria-hidden',
				isOpen ? 'false' : 'true'
			);

		$('.wrapper').toggleClass(
			'hamburger-is-active',
			isOpen
		);

		$('body').toggleClass(
			'mobile-nav-is-active',
			isOpen
		);

		if (isOpen) {
			$navigation
				.find('.close')
				.first()
				.trigger('focus');
		}
	});

	$navigation
		.find('.close')
		.on('click', function (event) {
			event.preventDefault();
			closeNavigation();
		});

	$navigation
		.find('li.menu-item-has-children')
		.each(function (index) {
			const $item = $(this);
			const $link = $item.children('a').first();
			const $submenu = $item
				.children('.sub-menu')
				.first();

			if (!$submenu.length) {
				return;
			}

			const submenuId = `mobile-submenu-${index}`;

			$submenu
				.attr('id', submenuId)
				.attr('aria-hidden', 'true');

			const $toggle = $('<button>', {
				type: 'button',
				class: 'submenu-toggle',
				'aria-expanded': 'false',
				'aria-controls': submenuId,
				'aria-label':
					`Toggle submenu for ${$.trim($link.text())}`,
			});

			$link.after($toggle);
		});

	$navigation.on(
		'click',
		'.submenu-toggle',
		function () {
			const $button = $(this);
			const $submenu = $button
				.siblings('.sub-menu')
				.first();

			const isOpen = (
				$button.attr('aria-expanded')
				=== 'true'
			);

			$button.attr(
				'aria-expanded',
				isOpen ? 'false' : 'true'
			);

			$submenu
				.toggleClass(
					'sub-menu-is-active',
					!isOpen
				)
				.attr(
					'aria-hidden',
					isOpen ? 'true' : 'false'
				);
		}
	);

	$(document).on('keydown', function (event) {
		if (
			event.key === 'Escape'
			&& $navigation.hasClass('is-active')
		) {
			closeNavigation();
		}
	});
}