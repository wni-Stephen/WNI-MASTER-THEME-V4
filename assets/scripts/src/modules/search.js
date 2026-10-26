import createOverlay from './overlay.js';

export default function initSearch() {
	const search = document.getElementById('site-search');
	if (!search) return;
	const buttons = document.querySelectorAll('.search-open');
	const overlay = createOverlay(search, closeSearch);

	function closeSearch() {
		document.body.classList.remove('search-is-active');
		buttons.forEach((button) => button.setAttribute('aria-expanded', 'false'));
		overlay.close();
	}

	buttons.forEach((button) => {
		button.setAttribute('aria-controls', 'site-search');
		button.setAttribute('aria-expanded', 'false');
		button.addEventListener('click', () => {
			document.body.classList.add('search-is-active');
			overlay.open(button, search.querySelector('.search-input'));
			button.setAttribute('aria-expanded', 'true');
		});
	});
	search.querySelectorAll('.search-close').forEach((button) => {
		button.addEventListener('click', closeSearch);
	});
}
