(() => {
    "use strict";

    /* =========================================================
       BASIC HELPERS
    ========================================================= */

    const $ = (selector, parent = document) =>
        parent.querySelector(selector);

    const $$ = (selector, parent = document) =>
        [...parent.querySelectorAll(selector)];

    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;


    /* =========================================================
       SVG CONTOUR BACKGROUND
    ========================================================= */

    const hashNoise = (x, y, seed) => {
        let h = (
            x * 374761393 +
            y * 668265263 +
            seed * 2147483647
        ) | 0;

        h = ((h ^ (h >>> 13)) * 1274126177) | 0;

        return ((h ^ (h >>> 16)) >>> 0) / 4294967295;
    };

    const noise = (x, y, seed) => {
        const xi = Math.floor(x);
        const yi = Math.floor(y);
        const xf = x - xi;
        const yf = y - yi;

        const u = xf * xf * (3 - 2 * xf);
        const v = yf * yf * (3 - 2 * yf);

        const a = hashNoise(xi, yi, seed);
        const b = hashNoise(xi + 1, yi, seed);
        const c = hashNoise(xi, yi + 1, seed);
        const d = hashNoise(xi + 1, yi + 1, seed);

        return (
            a +
            (b - a) * u +
            (c - a) * v +
            (a - b - c + d) * u * v
        );
    };

    const height = (x, y, seed) => (
        0.55 * noise(x * 0.09, y * 0.09, seed) +
        0.30 * noise(x * 0.20, y * 0.20, seed + 7) +
        0.15 * noise(x * 0.40, y * 0.40, seed + 13)
    );

    const SEG = [
        [],
        [[3, 2]],
        [[2, 1]],
        [[3, 1]],
        [[0, 1]],
        [[0, 1], [3, 2]],
        [[0, 2]],
        [[3, 0]],
        [[3, 0]],
        [[0, 2]],
        [[3, 0], [1, 2]],
        [[0, 1]],
        [[3, 1]],
        [[2, 1]],
        [[3, 2]],
        []
    ];

    function contour(svg, { bump = false } = {}) {
        if (!svg) return;

        const W = Number(svg.dataset.w) || 1200;
        const H = Number(svg.dataset.h) || 600;
        const seed = Number(svg.dataset.seed) || 1;
        const cell = Number(svg.dataset.cell) || 16;

        const cols = Math.ceil(W / cell) + 1;
        const rows = Math.ceil(H / cell) + 1;
        const base = new Float32Array(cols * rows);

        for (let j = 0; j < rows; j++) {
            for (let i = 0; i < cols; i++) {
                base[j * cols + i] = height(i, j, seed);
            }
        }

        svg.setAttribute("viewBox", `0 0 ${W} ${H}`);
        svg.setAttribute("preserveAspectRatio", "xMidYMid slice");

        const levels = Array.from(
            { length: 13 },
            (_, k) => 0.26 + k * 0.05
        );

        const paths = levels.map((_, k) => {
            const path = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "path"
            );

            if (k % 4 === 0) {
                path.setAttribute("class", "ix");
            }

            svg.appendChild(path);
            return path;
        });

        const values = new Float32Array(base.length);

        function draw(bumpX = -10000, bumpY = -10000) {
            const sigma = Math.max(W, H) * 0.14;

            for (let j = 0; j < rows; j++) {
                for (let i = 0; i < cols; i++) {
                    const dx = i * cell - bumpX;
                    const dy = j * cell - bumpY;

                    values[j * cols + i] =
                        base[j * cols + i] +
                        0.3 * Math.exp(
                            -(dx * dx + dy * dy) /
                            (2 * sigma * sigma)
                        );
                }
            }

            levels.forEach((threshold, levelIndex) => {
                let pathData = "";

                for (let j = 0; j < rows - 1; j++) {
                    for (let i = 0; i < cols - 1; i++) {
                        const topLeft = values[j * cols + i];
                        const topRight = values[j * cols + i + 1];
                        const bottomRight =
                            values[(j + 1) * cols + i + 1];
                        const bottomLeft =
                            values[(j + 1) * cols + i];

                        const index =
                            (topLeft > threshold) * 8 +
                            (topRight > threshold) * 4 +
                            (bottomRight > threshold) * 2 +
                            (bottomLeft > threshold);

                        if (index === 0 || index === 15) continue;

                        const x0 = i * cell;
                        const y0 = j * cell;

                        const point = edge => {
                            if (edge === 0) {
                                const den = topRight - topLeft;
                                const t = den
                                    ? (threshold - topLeft) / den
                                    : 0;
                                return [x0 + cell * t, y0];
                            }

                            if (edge === 1) {
                                const den = bottomRight - topRight;
                                const t = den
                                    ? (threshold - topRight) / den
                                    : 0;
                                return [x0 + cell, y0 + cell * t];
                            }

                            if (edge === 2) {
                                const den = bottomRight - bottomLeft;
                                const t = den
                                    ? (threshold - bottomLeft) / den
                                    : 0;
                                return [x0 + cell * t, y0 + cell];
                            }

                            const den = bottomLeft - topLeft;
                            const t = den
                                ? (threshold - topLeft) / den
                                : 0;
                            return [x0, y0 + cell * t];
                        };

                        for (const [a, b] of SEG[index]) {
                            const p = point(a);
                            const q = point(b);

                            pathData +=
                                `M${p[0].toFixed(1)} ${p[1].toFixed(1)}` +
                                `L${q[0].toFixed(1)} ${q[1].toFixed(1)}`;
                        }
                    }
                }

                paths[levelIndex].setAttribute("d", pathData);
            });
        }

        draw();

        if (bump && !reduceMotion) {
            let frame = 0;
            let pointerEvent = null;
            const host = svg.parentElement;

            if (!host) return;

            host.addEventListener("pointermove", event => {
                pointerEvent = event;
                if (frame) return;

                frame = requestAnimationFrame(() => {
                    frame = 0;
                    if (!pointerEvent) return;

                    const matrix = svg.getScreenCTM();
                    if (!matrix) return;

                    const point = new DOMPoint(
                        pointerEvent.clientX,
                        pointerEvent.clientY
                    ).matrixTransform(matrix.inverse());

                    draw(point.x, point.y);
                });
            });

            host.addEventListener("pointerleave", () => {
                pointerEvent = null;
                draw();
            });
        }
    }

    function initializeContours() {
        $$("svg.ct").forEach(svg => {
            const bump =
                svg.dataset.bump === "true" ||
                !!svg.closest(".hero[data-contour-bump='true']");

            contour(svg, { bump });
        });
    }


    /* =========================================================
       MOBILE NAVIGATION
    ========================================================= */

    function initializeNavigation() {
        const header = $(".site-header");
        const button = $(".menu-toggle");
        const nav = $(".main-navigation");
        const navLinks = $(".nav-links");

        if (!header || !button || !nav || !navLinks) return;

        function closeMenu() {
            header.classList.remove("nav-open");
            navLinks.classList.remove("is-open");
            button.setAttribute("aria-expanded", "false");
        }

        button.addEventListener("click", () => {
            const isOpen = header.classList.toggle("nav-open");

            navLinks.classList.toggle("is-open", isOpen);
            button.setAttribute("aria-expanded", String(isOpen));
        });

        $$("a", navLinks).forEach(link => {
            link.addEventListener("click", closeMenu);
        });

        window.addEventListener("resize", () => {
            if (window.innerWidth > 900) closeMenu();
        });
    }


    /* =========================================================
       BLOG CATEGORY FILTER
    ========================================================= */

    function initializeBlogFilter() {
        const filter = $("[data-blog-filter]");
        if (!filter) return;

        const buttons = $$("[data-category]", filter);
        const posts = $$("[data-post-category]");

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const category = button.dataset.category || "all";

                buttons.forEach(item => {
                    item.setAttribute(
                        "aria-pressed",
                        String(item === button)
                    );
                });

                posts.forEach(post => {
                    const postCategory =
                        post.dataset.postCategory || "";

                    post.hidden = !(
                        category === "all" ||
                        category === postCategory
                    );
                });
            });
        });
    }


    /* =========================================================
       FAQ / ACCORDION
    ========================================================= */

    function initializeDetails() {
        $$("details").forEach(item => {
            item.addEventListener("toggle", () => {
                const accordion = item.closest("[data-accordion]");

                if (!accordion || !item.open) return;

                $$("details", accordion).forEach(other => {
                    if (other !== item) other.open = false;
                });
            });
        });
    }


    /* =========================================================
       SCROLL TO TARGET
       Handles #service-section and #service-1 to #service-6
    ========================================================= */

    function scrollToTarget(target) {
        if (!target) return;

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                const header = $(".site-header");

                const headerHeight = header
                    ? header.getBoundingClientRect().height
                    : 0;

                const top =
                    target.getBoundingClientRect().top +
                    window.scrollY -
                    headerHeight -
                    20;

                window.scrollTo({
                    top: Math.max(0, top),
                    behavior: reduceMotion ? "auto" : "smooth"
                });
            });
        });
    }

    function handleServiceHash() {
        const hashValue = window.location.hash;

        // Whole Services section
        if (hashValue === "#service-section") {
            const section = document.getElementById("service-section");

            if (section) {
                scrollToTarget(section);
            }

            return;
        }

        // Individual service accordion
        if (!/^#service-[1-6]$/.test(hashValue)) return;

        const service = document.getElementById(
            hashValue.substring(1)
        );

        if (!service || !service.matches("details.service-item")) {
            return;
        }

        service.open = true;
        scrollToTarget(service);
    }

    function initializeServiceLinks() {
        window.addEventListener("hashchange", handleServiceHash);
        window.addEventListener("load", handleServiceHash);

        // Also run when the script loads after the page is ready.
        handleServiceHash();
    }


    /* =========================================================
       GENERAL SMOOTH SCROLL
    ========================================================= */

    function initializeSmoothScroll() {
        $$('a[href^="#"]').forEach(link => {
            link.addEventListener("click", event => {
                const href = link.getAttribute("href");

                if (!href || href === "#") return;

                // These anchors are handled separately above.
                if (
                    href === "#service-section" ||
                    /^#service-[1-6]$/.test(href)
                ) {
                    return;
                }

                const target = $(href);
                if (!target) return;

                if (reduceMotion) return;

                event.preventDefault();
                scrollToTarget(target);
                history.pushState(null, "", href);
            });
        });
    }


    /* =========================================================
       CONTACT FORM UI
    ========================================================= */

    function initializeContactForm() {
        const form = $("#contact-form");
        if (!form) return;

        form.addEventListener("submit", () => {
            form.classList.add("is-submitting");
        });
    }


    /* =========================================================
       CURRENT WORDPRESS PAGE
    ========================================================= */

    function initializeCurrentPage() {
        const page = document.body.dataset.page;
        if (page) {
            document.body.classList.add(`page-${page}`);
        }
    }


    /* =========================================================
       INITIALIZE
    ========================================================= */

    function initialize() {
        initializeContours();
        initializeNavigation();
        initializeBlogFilter();
        initializeDetails();
        initializeServiceLinks();
        initializeSmoothScroll();
        initializeContactForm();
        initializeCurrentPage();
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initialize);
    } else {
        initialize();
    }

})();