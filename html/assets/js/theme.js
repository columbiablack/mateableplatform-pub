document.querySelectorAll(".mega-menu").forEach(menu => {
    const categories = menu.querySelectorAll(".mega-category");
    const panels = menu.querySelectorAll(".mega-panel");

    const activateCategory = category => {
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
        category.addEventListener("click", event => {
            if (category.getAttribute("href") === "#") {
                event.preventDefault();
            }
            activateCategory(category);
        });
    });
});
/*
 * Copyright (c) 2026. Mateable LLC
 */

