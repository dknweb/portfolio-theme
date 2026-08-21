export default function initStickyHeader() {
	const header = document.querySelector('.site-header');

	if (!header) {
		return;
	}

	let ticking = false;

	const updateHeader = () => {
		header.classList.toggle('is-sticky', window.scrollY > 10);
		ticking = false;
	};

	window.addEventListener(
		'scroll',
		() => {
			if (!ticking) {
				window.requestAnimationFrame(updateHeader);
				ticking = true;
			}
		},
		{ passive: true }
	);

	updateHeader();
}