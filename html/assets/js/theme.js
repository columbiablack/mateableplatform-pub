const progressFill = document.getElementById('loading-progress-fill');
const progressText = document.getElementById('loading-percentage');
const progressBar = document.getElementById('loading-progress-bar');

let progress = 0;
let pageLoaded = false;
let minTimeElapsed = false;

function updateProgress(value) {
    progress = value;

    if (progressFill) {
        progressFill.style.width = `${value}%`;
    }

    if (progressText) {
        progressText.textContent = `${Math.round(value)}%`;
    }

    if (progressBar) {
        progressBar.setAttribute('aria-valuenow', Math.round(value));
    }
}

function hideLoadingScreen() {
    const screen = document.querySelector('.loading-screen');

    if (!screen) return;

    screen.classList.add('hidden');
    document.body.classList.add('is-loaded');

    screen.addEventListener('transitionend', (event) => {
        if (event.target === screen && event.propertyName === 'opacity') {
            screen.remove();
        }
    }, { once: true });
}

// Simulated progress: approach 90% while waiting.
const progressTimer = setInterval(() => {
    if (progress < 90 && !pageLoaded) {
        updateProgress(Math.min(90, progress + Math.max(1, (90 - progress) * 0.08)));
    }
}, 600);

// Actual page load completes the progress.
window.addEventListener('load', () => {
    pageLoaded = true;
    clearInterval(progressTimer);
    updateProgress(100);

    if (minTimeElapsed) {
        hideLoadingScreen();
    }
}, { once: true });

// Minimum display duration.
setTimeout(() => {
    minTimeElapsed = true;

    if (pageLoaded) {
        hideLoadingScreen();
    }
}, 500);


// Mega-Menu
document.querySelectorAll(".mega-menu").forEach(menu => {
    const categories = menu.querySelectorAll(".mega-category");
    const panels = menu.querySelectorAll(".mega-panel");
    const hoverRegion = menu.closest(".nav-item");
    let closeTimer = null;

    const clearSelection = () => {
        const activeCategory = menu.querySelector(".mega-category.active");
        if (activeCategory) {
            activeCategory.classList.remove("active");
        }
        panels.forEach(panel => panel.classList.remove("active"));
    };

    const cancelClose = () => {
        if (closeTimer) {
            clearTimeout(closeTimer);
            closeTimer = null;
        }
    };

    const closeMenu = () => {
        menu.classList.remove("show");
        const toggle = document.getElementById(menu.getAttribute("aria-labelledby"));
        toggle?.setAttribute("aria-expanded", "false");
        clearSelection();
        closeTimer = null;
    };

    const activateCategory = category => {
        cancelClose();
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

    hoverRegion?.addEventListener("mouseenter", cancelClose);
    hoverRegion?.addEventListener("mouseleave", () => {
        cancelClose();
        closeTimer = setTimeout(() => {
            closeMenu();
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

const tickerTrack = document.querySelector('[data-ticker-track]');
const tickerGroup = tickerTrack?.querySelector('.ticker-group');
const reduceTickerMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

if (tickerTrack && tickerGroup) {
    const tickerViewport = tickerTrack.parentElement;
    const updateTickerSpeed = () => {
        const overflow = tickerGroup.scrollWidth - tickerViewport.clientWidth;
        const distance = Math.min(0, -overflow);

        tickerTrack.style.setProperty('--ticker-distance', `${distance}px`);
        tickerTrack.style.setProperty('--ticker-duration', `${Math.max(16, Math.abs(distance) / 24)}s`);
        tickerTrack.classList.toggle('is-moving', distance < 0 && !reduceTickerMotion.matches);
    };

    const syncTickerMotion = () => {
        if (reduceTickerMotion.matches) {
            tickerTrack.classList.remove('is-moving');
            tickerViewport?.classList.add('ticker-static');
            return;
        }

        tickerViewport?.classList.remove('ticker-static');
        updateTickerSpeed();
    };

    syncTickerMotion();
    reduceTickerMotion.addEventListener('change', syncTickerMotion);
    window.addEventListener('resize', syncTickerMotion, { passive: true });
}

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

