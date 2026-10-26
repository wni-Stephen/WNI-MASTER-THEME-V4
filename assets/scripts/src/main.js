import 'hamburgers/dist/hamburgers.css';
import '../../styles/app.css';

import $ from 'jquery';

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';

window.$ = $;
window.jQuery = $;

gsap.registerPlugin(
	ScrollTrigger,
	ScrollSmoother
);

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.ScrollSmoother = ScrollSmoother;

import '../functions.js';
