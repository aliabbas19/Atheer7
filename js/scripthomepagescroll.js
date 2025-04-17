document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('main, .volunteer-section, .connect-section, .testimonial-section, .signup-section');

    function checkVisibility() {
        sections.forEach(section => {
            if (isElementInViewport(section)) {
                section.classList.add('section-visible');
            }
        });
    }

    function isElementInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); // Check on initial load
});
