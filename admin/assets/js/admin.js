

(function () {
    const INCLUDES_PATH = "/E-Commerce-Management-System/includes/";

    const includeFiles = {
        navbar: "navbar.php",
        sidebar: "sidebar.php",
        footer: "footer.php",
    };

    async function loadInclude(el) {
        const key = el.getAttribute("data-include");
        const file = includeFiles[key];

        if (!file) return;

        try {
            const res = await fetch(INCLUDES_PATH + file);
            const html = await res.text();
            el.outerHTML = html;
        } catch (err) {
            console.error("Could not load include:", key, err);
        }
    }

    function highlightActiveSidebarLink() {
        if (!window.PAGE_KEY) return;

        const links = document.querySelectorAll(".sidebar-link");
        links.forEach((link) => {
            if (link.getAttribute("data-page") === window.PAGE_KEY) {
                link.classList.add("active");
            }
        });
    }

    async function init() {
        const includeNodes = Array.from(document.querySelectorAll("[data-include]"));

        for (const node of includeNodes) {
            await loadInclude(node);
        }

        highlightActiveSidebarLink();
    }

    document.addEventListener("DOMContentLoaded", init);
})();
