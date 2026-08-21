const animationSelector = '.animate-fade-up, .animate-fade-in';

export default function initScrollAnimations() {
    const animatedElements = document.querySelectorAll(animationSelector);

    if (!animatedElements.length) {
        return;
    }

    if (
        !('IntersectionObserver' in window)
        || window.matchMedia('(prefers-reduced-motion: reduce)').matches
    ) {
        animatedElements.forEach((element) => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -48px',
    });

    animatedElements.forEach((element) => observer.observe(element));
}