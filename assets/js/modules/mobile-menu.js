export default function initMobileMenu() {
	const menuToggle = document.querySelector('.menu-toggle');
	const navigation = document.querySelector('.header-navigation');

	if (!menuToggle || !navigation) {
		return;
	}

	const mobileMenuQuery = window.matchMedia('(max-width: 991px)');

	const closeMenu = ({ restoreFocus = false } = {}) => {
		navigation.classList.remove('is-open');
		navigation.setAttribute('aria-hidden', 'true');
		menuToggle.setAttribute('aria-expanded', 'false');
		menuToggle.setAttribute('aria-label', 'Open navigation');

		if (restoreFocus) {
			menuToggle.focus();
		}
	};

	const syncForViewport = (isMobile) => {
		if (isMobile) {
			closeMenu();
		} else {
			navigation.classList.remove('is-open');
			navigation.removeAttribute('aria-hidden');
			menuToggle.setAttribute('aria-expanded', 'false');
			menuToggle.setAttribute('aria-label', 'Open navigation');
		}
	};

	menuToggle.addEventListener('click', () => {
		const isOpen = navigation.classList.toggle('is-open');

		menuToggle.setAttribute('aria-expanded', String(isOpen));
		menuToggle.setAttribute(
			'aria-label',
			isOpen ? 'Close navigation' : 'Open navigation'
		);
		navigation.setAttribute('aria-hidden', String(!isOpen));
	});

	navigation.addEventListener('click', (event) => {
		if (mobileMenuQuery.matches && event.target.closest('a')) {
			closeMenu();
		}
	});

	document.addEventListener('keydown', (event) => {
		if (
			event.key === 'Escape'
			&& mobileMenuQuery.matches
			&& navigation.classList.contains('is-open')
		) {
			closeMenu({ restoreFocus: true });
		}
	});

	mobileMenuQuery.addEventListener('change', (event) => {
		syncForViewport(event.matches);
	});

	syncForViewport(mobileMenuQuery.matches);
}