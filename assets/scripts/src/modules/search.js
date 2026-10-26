export default function initSearch() {
	const search = document.querySelector('.search');
	const openButtons = document.querySelectorAll('.search-open');
	const closeButtons = document.querySelectorAll('.search-close');
	const input = document.querySelector('.search-input');

	if (!search) {
		return;
	}

	let searchTrigger = null;

	function openSearch(trigger) {
		searchTrigger = trigger;
		search.setAttribute('aria-hidden', 'false');

		document.body.classList.add('search-is-active');

		setTimeout(() => {
			input?.focus();
		}, 100);
	}

	function closeSearch() {
		search.setAttribute('aria-hidden', 'true');

		document.body.classList.remove('search-is-active');

		searchTrigger?.focus();
	}

	openButtons.forEach((button) => {
		button.addEventListener(
			'click',
			(event) => {
				event.preventDefault();

				openSearch(button);
			}
		);
	});

	closeButtons.forEach((button) => {
		button.addEventListener('click', closeSearch);
	});

	document.addEventListener(
		'keydown',
		(event) => {
			if (
				event.key === 'Escape'
				&& document.body.classList.contains('search-is-active')
			) {
				closeSearch();
			}
		}
	);
}
