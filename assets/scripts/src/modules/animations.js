export default function initAnimations() {
	const gsap = window.gsap;
	const ScrollTrigger = window.ScrollTrigger;

	if (
		!gsap
		|| !ScrollTrigger
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

	/**
	 * Available animation presets.
	 */
	const animations = {
		'fade-up': {
			opacity: 0,
			y: 40,
		},

		'fade-in': {
			opacity: 0,
		},

		'fade-left': {
			opacity: 0,
			x: -40,
		},

		'fade-right': {
			opacity: 0,
			x: 40,
		},

		'scale-in': {
			opacity: 0,
			scale: 0.95,
		},
	};

	/**
	 * Build selector from animation classes.
	 */
	const selectors = Object.keys(animations)
		.map(function (animation) {
			return `.${animation}`;
		})
		.join(', ');

	/**
	 * Find which animation preset is applied
	 * to an element.
	 */
	function getAnimationName(element) {
		let animationName = null;

		Object.keys(animations).some(
			function (animation) {
				if (
					element.classList.contains(animation)
				) {
					animationName = animation;

					return true;
				}

				return false;
			}
		);

		return animationName;
	}

	gsap.registerPlugin(ScrollTrigger);

	/**
	 * Grouped stagger animations.
	 *
	 * Example:
	 *
	 * <div
	 *     class="animation-stagger"
	 *     data-animate-stagger="0.2"
	 * >
	 *     <div class="fade-up"></div>
	 *     <div class="fade-up"></div>
	 *     <div class="fade-up"></div>
	 * </div>
	 */
	const staggerGroups = document.querySelectorAll('.animation-stagger');

	const groupedElements = new Set();

	staggerGroups.forEach(function (group) {
		const elements = group.querySelectorAll(selectors);

		if (!elements.length) {
			return;
		}

		const stagger = parseFloat(group.dataset.animateStagger);

		const duration = parseFloat(group.dataset.animateDuration);

		const start = (
			group.dataset.animateStart
			|| 'top 85%'
		);

		const timeline = gsap.timeline({
			scrollTrigger: {
				trigger: group,
				start,
				once: true,
			},
		});

		elements.forEach(
			function (element, index) {
				const animationName = getAnimationName(element);

				if (!animationName) {
					return;
				}

				groupedElements.add(element);

				const elementDuration = parseFloat(element.dataset.animateDuration);

				timeline.from(
					element,
					{
						...animations[animationName],

						duration:
							Number.isFinite(elementDuration)
								? elementDuration
								: Number.isFinite(duration)
									? duration
									: 0.8,

						ease: 'power2.out',
					},
					index * (
						Number.isFinite(stagger)
							? stagger
							: 0.2
					)
				);
			}
		);
	});

	/**
	 * Individual animations.
	 */
	const elements = document.querySelectorAll(selectors);

	elements.forEach(function (element) {
		/**
		 * Elements inside a stagger group
		 * are already handled above.
		 */
		if (
			groupedElements.has(element)
		) {
			return;
		}

		const animationName = getAnimationName(element);

		if (!animationName) {
			return;
		}

		const animation = animations[
			animationName
		];

		const duration = parseFloat(element.dataset.animateDuration);

		const delay = parseFloat(element.dataset.animateDelay);

		const start = (
			element.dataset.animateStart
			|| 'top 85%'
		);

		gsap.from(
			element,
			{
				...animation,

				duration:
					Number.isFinite(duration)
						? duration
						: 0.8,

				delay:
					Number.isFinite(delay)
						? delay
						: 0,

				ease: 'power2.out',

				scrollTrigger: {
					trigger: element,
					start,
					once: true,
				},
			}
		);
	});
}
