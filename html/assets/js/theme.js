document.querySelectorAll(".mega-category").forEach(item => {
    item.addEventListener("mouseenter", function () {
        // Remove active from all
        document.querySelectorAll(".mega-category").forEach(i => i.classList.remove("active"));
        document.querySelectorAll(".mega-panel").forEach(p => p.classList.remove("active"));

        // Activate current
        this.classList.add("active");
        document.getElementById(this.dataset.target).classList.add("active");
    });
});/*
 * Copyright (c) 2026. Mateable LLC
 */

