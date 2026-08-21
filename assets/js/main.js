import '../scss/main.scss';

import initStickyHeader from './modules/sticky-header';
import initMobileMenu from './modules/mobile-menu';
import initScrollAnimations from './modules/animations';

document.addEventListener('DOMContentLoaded', () => {
	initStickyHeader();
	initMobileMenu();
	initScrollAnimations();
});