import 'hamburgers/dist/hamburgers.css';
import '../../styles/app.css';

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';

import initResponsiveEmbeds from './modules/responsive-embeds.js';
import initMobileNavigation from './modules/mobile-navigation.js';
import initSearch from './modules/search.js';
import initInlineSvg from './modules/inline-svg.js';
import initSmoothScroll from './modules/smooth-scroll.js';
import initAnimations from './modules/animations.js';

gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.ScrollSmoother = ScrollSmoother;

document.addEventListener(
	'DOMContentLoaded',
	() => {
		initResponsiveEmbeds();
		initMobileNavigation();
		initSearch();
		document.documentElement.classList.replace('no-js', 'js');
		initInlineSvg();
		initSmoothScroll();
		initAnimations();
	}
);
