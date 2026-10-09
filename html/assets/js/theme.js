let pageLoaded = false;
let minTimeElapsed = false;

function hideLoadingScreen() {
    const loadingScreen = document.querySelector('.loading-screen');

    if (!loadingScreen) return;

    document.body.classList.add('is-loaded');
    loadingScreen.classList.add('hidden');

    loadingScreen.addEventListener(
        'transitionend',
        () => loadingScreen.remove(),
        { once: true }
    );
}

// Wait for the page to fully load
window.addEventListener('load', () => {
    pageLoaded = true;

    if (minTimeElapsed) {
        hideLoadingScreen();
    }
});

// Minimum 500ms display time
setTimeout(() => {
    minTimeElapsed = true;

    if (pageLoaded) {
        hideLoadingScreen();
    }
}, 500);

document.querySelectorAll(".mega-menu").forEach(menu => {
    const categories = menu.querySelectorAll(".mega-category");
    const panels = menu.querySelectorAll(".mega-panel");
    let closeTimer = null;

    const activateCategory = category => {
        if (closeTimer) {
            clearTimeout(closeTimer);
            closeTimer = null;
        }
        const target = menu.querySelector(`#${CSS.escape(category.dataset.target)}`);
        if (!target) {
            return;
        }

        categories.forEach(item => item.classList.remove("active"));
        panels.forEach(panel => panel.classList.remove("active"));
        category.classList.add("active");
        target.classList.add("active");
    };

    categories.forEach(category => {
        category.addEventListener("mouseenter", () => activateCategory(category));
        category.addEventListener("focus", () => activateCategory(category));
        category.addEventListener("click", event => {
            if (category.getAttribute("href") === "#") {
                event.preventDefault();
            }
            activateCategory(category);
        });
    });

    menu.addEventListener("mouseenter", () => {
        if (closeTimer) {
            clearTimeout(closeTimer);
            closeTimer = null;
        }
    });

    menu.addEventListener("mouseleave", () => {
        closeTimer = setTimeout(() => {
            const activeCategory = menu.querySelector(".mega-category.active");
            if (activeCategory) {
                activeCategory.classList.remove("active");
            }
            panels.forEach(panel => panel.classList.remove("active"));
            closeTimer = null;
        }, 180);
    });
});

const dropdownToggleSelector = '[data-bs-toggle="dropdown"]';
const dropdownToggles = document.querySelectorAll(dropdownToggleSelector);

dropdownToggles.forEach(toggle => {
    const menu = toggle.nextElementSibling;
    if (!menu || !menu.classList.contains('dropdown-menu')) {
        return;
    }

    toggle.addEventListener('click', event => {
        event.preventDefault();
        event.stopPropagation();

        const isOpen = menu.classList.contains('show');
        document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
            if (openMenu !== menu) openMenu.classList.remove('show');
        });

        menu.classList.toggle('show', !isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
    });

    toggle.addEventListener('mouseenter', () => {
        if (window.innerWidth < 992) {
            return;
        }
        document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
            if (openMenu !== menu) openMenu.classList.remove('show');
        });
        menu.classList.add('show');
        toggle.setAttribute('aria-expanded', 'true');
    });
});

document.addEventListener('click', event => {
    const target = event.target;
    if (!target.closest(dropdownToggleSelector) && !target.closest('.dropdown-menu')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => menu.classList.remove('show'));
        document.querySelectorAll(dropdownToggleSelector).forEach(toggle => toggle.setAttribute('aria-expanded', 'false'));
    }
});

window.addEventListener('keydown', event => {
    if (event.key === 'Escape') {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => menu.classList.remove('show'));
        document.querySelectorAll(dropdownToggleSelector).forEach(toggle => toggle.setAttribute('aria-expanded', 'false'));
    }
});

document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.modal');
        if (!modal) {
            return;
        }

        if (window.bootstrap && window.bootstrap.Modal) {
            const instance = window.bootstrap.Modal.getInstance(modal);
            if (instance) {
                instance.hide();
                return;
            }
        }

        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    });
});

const homePage = document.querySelector('.home-page');
if (homePage) {
    const revealItems = homePage.querySelectorAll(
        '.home-section-heading, .home-page > section .g-card, .home-page > section .news-card'
    );

    revealItems.forEach((item, index) => {
        item.classList.add('fade-up');
        item.style.setProperty('--reveal-delay', `${Math.min(index % 4, 3) * 90}ms`);
    });

    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('vis');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.12 });

        revealItems.forEach(item => revealObserver.observe(item));
    } else {
        revealItems.forEach(item => item.classList.add('vis'));
    }
}
/*
 * Copyright (c) 2026. Mateable LLC
 */

