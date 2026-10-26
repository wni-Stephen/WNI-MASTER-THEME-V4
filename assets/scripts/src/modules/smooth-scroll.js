export default function initSmoothScroll() {
	if (!document.body.classList.contains('smooth-scroll')) return;
	const gsap = window.gsap;
	const ScrollTrigger = window.ScrollTrigger;
	const ScrollSmoother = window.ScrollSmoother;

	if (
		!gsap
		|| !ScrollTrigger
		|| !ScrollSmoother
	) {
		return;
	}

	/**
	 * Respect reduced-motion preferences.
	 */
	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	if (prefersReducedMotion) {
		return;
	}

	gsap.registerPlugin(
		ScrollTrigger,
		ScrollSmoother
	);

	const smoother = ScrollSmoother.create({
		wrapper: '#smooth-wrapper',
		content: '#smooth-content',
		smooth: 1.3,
		effects: true,
		normalizeScroll: true,
	});

	/**
	 * Smooth anchor links.
	 *
	 * Usage:
	 * <a href="#section" data-smooth-scroll>
	 */
	document.querySelectorAll('a[data-smooth-scroll][href^="#"]').forEach(function (link) {
		link.addEventListener(
			'click',
			function (event) {
				const href = link.getAttribute('href');

				if (
					!href
					|| href === '#'
				) {
					return;
				}

				const target = document.getElementById(href.substring(1));

				if (!target) {
					return;
				}

				event.preventDefault();

				smoother.scrollTo(
					target,
					true,
					'top top'
				);

				history.pushState(
					null,
					'',
					href
				);
			}
		);
	});
}
