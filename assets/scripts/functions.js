/**
 * WebsiteNI frontend behaviour.
 */

(function ($) {
	$(document).ready(function () {
		initResponsiveEmbeds();
		initMobileNavigation();
		initSearch();
		initInlineSvg();
		initSmoothScroll();
		initAnimations();
	});

	function initResponsiveEmbeds() {
		$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function () {
			if ($(this).parent().hasClass('responsive-embed')) {
				return;
			}

			const wrapperClass = $(this).innerWidth() / $(this).innerHeight() > 1.5
				? 'widescreen responsive-embed'
				: 'responsive-embed';

			$(this).wrap('<div class="' + wrapperClass + '"></div>');
		});
	}

	function initMobileNavigation() {
		const $navigation = $('.navigation-overlay');
		const $hamburger = $('.hamburger');

		$hamburger.on('click', function () {
			const $button = $(this);
			const isOpen = !$button.hasClass('is-active');

			$button
				.toggleClass('is-active', isOpen)
				.attr({
					'aria-expanded': isOpen ? 'true' : 'false',
					'aria-label': isOpen ? 'Close menu' : 'Open menu',
				});

			$navigation
				.toggleClass('is-active', isOpen)
				.attr('aria-hidden', isOpen ? 'false' : 'true');

			$('.wrapper').toggleClass('hamburger-is-active', isOpen);
			$('body').toggleClass('mobile-nav-is-active', isOpen);

			if (isOpen) {
				$navigation.find('.close').first().trigger('focus');
			}
		});

		$('.navigation-overlay .close').on('click', function (event) {
			event.preventDefault();
			closeMobileNavigation();
		});

		$(document).on('keydown', function (event) {
			if (event.key === 'Escape' && $navigation.hasClass('is-active')) {
				closeMobileNavigation();
			}
		});

		$navigation.find('li.menu-item-has-children').each(function (index) {
			const $item = $(this);
			const $link = $item.children('a').first();
			const $submenu = $item.children('.sub-menu').first();

			if (!$submenu.length) {
				return;
			}

			const submenuId = 'mobile-submenu-' + index;
			const linkText = $.trim($link.text());

			$submenu
				.attr('id', submenuId)
				.attr('aria-hidden', 'true');

			$link.after($('<button>', {
				type: 'button',
				class: 'submenu-toggle',
				'aria-expanded': 'false',
				'aria-controls': submenuId,
				'aria-label': 'Toggle submenu for ' + linkText,
			}));
		});

		$navigation.on('click', '.submenu-toggle', function () {
			const $button = $(this);
			const $submenu = $button.siblings('.sub-menu').first();
			const isOpen = $button.attr('aria-expanded') === 'true';

			$button.attr('aria-expanded', isOpen ? 'false' : 'true');
			$submenu
				.toggleClass('sub-menu-is-active', !isOpen)
				.attr('aria-hidden', isOpen ? 'true' : 'false');
		});

		function closeMobileNavigation() {
			$navigation
				.removeClass('is-active')
				.attr('aria-hidden', 'true');

			$('.wrapper').removeClass('hamburger-is-active');
			$('body').removeClass('mobile-nav-is-active');

			$hamburger
				.removeClass('is-active')
				.attr({
					'aria-expanded': 'false',
					'aria-label': 'Open menu',
				});

			$('.submenu-toggle').attr('aria-expanded', 'false');
			$navigation.find('.sub-menu')
				.removeClass('sub-menu-is-active')
				.attr('aria-hidden', 'true');

			$hamburger.first().trigger('focus');
		}
	}

	function initSearch() {
		let searchTrigger = null;

		$('.search-open').on('click', function (event) {
			event.preventDefault();
			searchTrigger = this;
			$('.search').attr('aria-hidden', 'false');
			$('body').addClass('search-is-active');
			setTimeout(function () {
				$('.search-input').first().trigger('focus');
			}, 100);
		});

		$('.search-close').on('click', function () {
			$('.search').attr('aria-hidden', 'true');
			$('body').removeClass('search-is-active');

			if (searchTrigger) {
				$(searchTrigger).trigger('focus');
			}
		});

		$(document).on('keydown', function (event) {
			if (event.key === 'Escape' && $('body').hasClass('search-is-active')) {
				$('.search-close').trigger('click');
			}
		});
	}

	function initInlineSvg() {
		$('img.editsvg[src$=".svg"]').each(function () {
			const $img = $(this);
			const imgID = $img.attr('id');
			const imgClass = $img.attr('class');
			const imgURL = $img.attr('src');

			$.get(imgURL, function (data) {
				const $svg = $(data).find('svg');

				if (typeof imgID !== 'undefined') {
					$svg.attr('id', imgID);
				}

				if (typeof imgClass !== 'undefined') {
					$svg.attr('class', imgClass + ' replaced-svg');
				}

				$svg.removeAttr('xmlns:a');
				$img.replaceWith($svg);
			}, 'xml');
		});
	}

	function initSmoothScroll() {
		const gsap = window.gsap;
		const ScrollTrigger = window.ScrollTrigger;
		const ScrollSmoother = window.ScrollSmoother;

		if (!gsap || !ScrollTrigger || !ScrollSmoother) {
			return;
		}

		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			return;
		}

		const smoother = ScrollSmoother.create({
			wrapper: '#smooth-wrapper',
			content: '#smooth-content',
			smooth: 1.3,
			effects: true,
			normalizeScroll: true,
		});

		document.querySelectorAll('a[data-smooth-scroll][href^="#"]').forEach(function (link) {
			link.addEventListener('click', function (event) {
				const href = link.getAttribute('href');
				if (!href || href === '#') return;

				const target = document.getElementById(href.substring(1));
				if (!target) return;

				event.preventDefault();
				smoother.scrollTo(target, true, 'top top');
				history.pushState(null, '', href);
			});
		});
	}

	function initAnimations() {
		const gsap = window.gsap;
		const ScrollTrigger = window.ScrollTrigger;

		if (!gsap || !ScrollTrigger) return;
		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

		const animations = {
			'fade-up': { opacity: 0, y: 40 },
			'fade-in': { opacity: 0 },
			'fade-left': { opacity: 0, x: -40 },
			'fade-right': { opacity: 0, x: 40 },
			'scale-in': { opacity: 0, scale: 0.95 },
		};

		const selectors = Object.keys(animations).map((animation) => '.' + animation).join(', ');

		document.querySelectorAll(selectors).forEach(function (element) {
			const name = Object.keys(animations).find((animation) => element.classList.contains(animation));
			if (!name) return;

			const duration = parseFloat(element.dataset.animateDuration);
			const delay = parseFloat(element.dataset.animateDelay);

			gsap.from(element, {
				...animations[name],
				duration: Number.isFinite(duration) ? duration : 0.8,
				delay: Number.isFinite(delay) ? delay : 0,
				ease: 'power2.out',
				scrollTrigger: {
					trigger: element,
					start: element.dataset.animateStart || 'top 85%',
					once: true,
				},
			});
		});
	}
})(jQuery);
