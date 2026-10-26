let activeOverlay = null;

export default function createOverlay(element, onClose) {
	let previousFocus = null;
	let background = [];
	let smoother = null;
	let wasPaused = false;
	const focusable = () => [...element.querySelectorAll('a[href], button, input, select, textarea, [tabindex]')]
		.filter((item) => !item.disabled && item.tabIndex >= 0 && !item.closest('[inert]') && item.getClientRects().length);

	function keydown(event) {
		if (event.key === 'Escape') {
			event.preventDefault();
			onClose();
		}
		if (event.key !== 'Tab') return;
		const items = focusable();
		const first = items[0] || element;
		const last = items[items.length - 1] || element;
		if (!items.length || document.activeElement === element || !element.contains(document.activeElement) || (event.shiftKey && document.activeElement === first) || (!event.shiftKey && document.activeElement === last)) {
			event.preventDefault();
			(event.shiftKey ? last : first).focus();
		}
	}

	return {
		open(trigger, focusTarget) {
			if (activeOverlay === onClose) return;
			if (activeOverlay) activeOverlay();
			previousFocus = trigger || document.activeElement;
			activeOverlay = onClose;
			background = [...document.body.children].filter((item) => item !== element && !item.contains(element));
			background = background.map((item) => [item, item.inert]);
			background.forEach(([item]) => { item.inert = true; });
			smoother = window.ScrollSmoother?.get();
			wasPaused = smoother?.paused();
			smoother?.paused(true);
			element.setAttribute('aria-hidden', 'false');
			document.addEventListener('keydown', keydown);
			(focusTarget || focusable()[0] || element).focus();
		},
		close() {
			document.removeEventListener('keydown', keydown);
			background.forEach(([item, inert]) => { item.inert = inert; });
			background = [];
			smoother?.paused(wasPaused);
			activeOverlay = null;
			if (previousFocus?.isConnected) previousFocus.focus();
			element.setAttribute('aria-hidden', 'true');
		},
	};
}
