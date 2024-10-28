// import "jsvectormap/dist/css/jsvectormap.css";
// import "flatpickr/dist/flatpickr.min.css";
import "../css/satoshi.css";
import "../css/style.css";
import "./bootstrap";

import Alpine from "alpinejs";
// import persist from "@alpinejs/persist";
// import flatpickr from "flatpickr";
// import chart01 from "./components/chart-01";
// import chart02 from "./components/chart-02";
// import chart03 from "./components/chart-03";
// import chart04 from "./components/chart-04";
// import map01 from "./components/map-01";

Alpine.plugin(persist);
window.Alpine = Alpine;
Alpine.start();

// Init flatpickr
flatpickr(".datepicker", {
    mode: "range",
    static: true,
    monthSelectorType: "static",
    dateFormat: "M j, Y",
    defaultDate: [new Date().setDate(new Date().getDate() - 6), new Date()],
    prevArrow:
        '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
    nextArrow:
        '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
    onReady: (selectedDates, dateStr, instance) => {
        // eslint-disable-next-line no-param-reassign
        instance.element.value = dateStr.replace("to", "-");
        const customClass = instance.element.getAttribute("data-class");
        instance.calendarContainer.classList.add(customClass);
    },
    onChange: (selectedDates, dateStr, instance) => {
        // eslint-disable-next-line no-param-reassign
        instance.element.value = dateStr.replace("to", "-");
    },
});

flatpickr(".form-datepicker", {
    mode: "single",
    static: true,
    monthSelectorType: "static",
    dateFormat: "M j, Y",
    prevArrow:
        '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
    nextArrow:
        '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
});

// Document Loaded
document.addEventListener("DOMContentLoaded", () => {
    chart01();
    chart02();
    chart03();
    chart04();
    map01();
});
window.loadContent = async function (url) {
    try {
        // Show loading state
        const mainContent = document.getElementById("main-content");
        mainContent.innerHTML =
            '<div class="flex items-center justify-center h-full"><div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900"></div></div>';

        // Update URL without page refresh
        history.pushState({}, "", url);

        // Fetch new content
        const response = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "text/html",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });

        if (!response.ok) throw new Error("Network response was not ok");

        const html = await response.text();
        mainContent.innerHTML = html;

        // Re-initialize any JavaScript that needs to run on the new content
        initializeComponents();
    } catch (error) {
        console.error("Error loading content:", error);
        // Show error message to user
        mainContent.innerHTML =
            '<div class="text-red-500">Error loading content. Please try again.</div>';
    }
};

// Handle browser back/forward buttons
window.addEventListener("popstate", (event) => {
    loadContent(window.location.href);
});

// Function to reinitialize components after content load
function initializeComponents() {
    // Add any initialization code here for components that need it
    // For example, if you're using Alpine.js components:
    if (window.Alpine) {
        window.Alpine.initTree(document.getElementById("main-content"));
    }
}
