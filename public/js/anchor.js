function getCurrentAnchor() {
    return window.location.hash.substring(1);
}

function updateActiveLink() {
    const links = document.querySelectorAll('a[href^="#"]');
    const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

    links.forEach(link => {
        const anchorId = link.getAttribute('href').substring(1);
        const anchor = document.getElementById(anchorId);

        if (anchor) {
            const anchorPosition = anchor.getBoundingClientRect().top + scrollPosition;
            const isInView = scrollPosition >= anchorPosition - 100 && scrollPosition < anchorPosition + anchor.offsetHeight - 100;

            link.classList.remove(
                'font-bold',
                'text-green-500',
                'font-medium',
                'text-gray-800',
                'dark:text-neutral-200'
            );

            if (isInView) {
                link.classList.add('font-bold', 'text-green-500');
            } else {
                link.classList.add('font-medium', 'text-gray-800', 'dark:text-neutral-200');
            }
        }
    });
}

window.addEventListener('load', updateActiveLink);
window.addEventListener('hashchange', updateActiveLink);
window.addEventListener('scroll', updateActiveLink);

// Gestionnaire d'événements pour les clics sur les liens d'ancre
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetElement = document.querySelector(this.getAttribute('href'));
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});