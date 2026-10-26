import createOverlay from './overlay.js';

export default function initMobileNavigation() {
	const navigation = document.querySelector('.navigation-overlay');
	const hamburger = document.querySelector('.hamburger');
	if (!navigation || !hamburger) return;

	const closeButton = navigation.querySelector('.close');
	const wrapper = document.querySelector('.wrapper');
	const overlay = createOverlay(navigation, closeNavigation);
	function closeNavigation() {
		navigation.classList.remove('is-active');
		hamburger.classList.remove('is-active');
		hamburger.setAttribute('aria-expanded', 'false');
		hamburger.setAttribute('aria-label', 'Open menu');
		document.body.classList.remove('mobile-nav-is-active');
		wrapper?.classList.remove('hamburger-is-active');
		navigation.querySelectorAll('.submenu-toggle').forEach((button) => {
			button.setAttribute('aria-expanded', 'false');
		});
		navigation.querySelectorAll('.sub-menu').forEach((submenu) => {
			submenu.classList.remove('sub-menu-is-active');
			submenu.setAttribute('aria-hidden', 'true');
		});
		overlay.close();
	}

	hamburger.addEventListener('click', () => {
		const isOpen = !hamburger.classList.contains('is-active');
		if (!isOpen) {
			closeNavigation();
			return;
		}
		hamburger.classList.toggle('is-active', isOpen);
		hamburger.setAttribute('aria-expanded', String(isOpen));
		hamburger.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
		navigation.classList.toggle('is-active', isOpen);
		navigation.setAttribute('aria-hidden', String(!isOpen));
		document.body.classList.toggle('mobile-nav-is-active', isOpen);
		wrapper?.classList.toggle('hamburger-is-active', isOpen);
		overlay.open(hamburger, closeButton);
	});
	navigation.querySelectorAll('.close').forEach((button) => {
		button.addEventListener('click', (event) => {
			event.preventDefault();
			closeNavigation();
		});
	});

	navigation.querySelectorAll('li.menu-item-has-children').forEach((item, index) => {
		const link = item.querySelector(':scope > a');
		const submenu = item.querySelector(':scope > .sub-menu');
		if (!link || !submenu) return;

		const submenuId = `mobile-submenu-${index}`;
		submenu.id = submenuId;
		submenu.setAttribute('aria-hidden', 'true');
		const toggle = document.createElement('button');
		toggle.type = 'button';
		toggle.className = 'submenu-toggle';
		toggle.setAttribute('aria-expanded', 'false');
		toggle.setAttribute('aria-controls', submenuId);
		toggle.setAttribute('aria-label', `Toggle submenu for ${link.textContent.trim()}`);
		link.insertAdjacentElement('afterend', toggle);
	});
	navigation.addEventListener('click', (event) => {
		const toggle = event.target.closest('.submenu-toggle');
		if (!toggle || !navigation.contains(toggle)) return;

		const submenu = toggle.parentElement.querySelector(':scope > .sub-menu');
		if (!submenu) return;
		const isOpen = toggle.getAttribute('aria-expanded') === 'true';
		toggle.setAttribute('aria-expanded', String(!isOpen));
		submenu.classList.toggle('sub-menu-is-active', !isOpen);
		submenu.setAttribute('aria-hidden', String(isOpen));
	});

}
