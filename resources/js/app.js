import "./bootstrap";

import Alpine from "alpinejs";
/* import "cally"; */
window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => {
    Alpine.start();
});

window.addEventListener("load", function () {
    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );

        // Change the icons inside the button based on previous settings

        if (

            localStorage.getItem("color-theme") === "forest" ||

            (!("color-theme" in localStorage) &&

                window.matchMedia("(prefers-color-scheme: dark)").matches)

        ) {

            document.documentElement.setAttribute("data-theme", "forest");

            if (themeToggleLightIcon)

                themeToggleLightIcon.classList.remove("hidden");

        } else {

            document.documentElement.setAttribute("data-theme", "cupcake");

            if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove("hidden");

        }

    

        const themeToggle = document.getElementById("theme-toggle");

    

        if (themeToggle) {

            themeToggle.addEventListener("click", function () {

                // toggle icons inside button

                if (themeToggleDarkIcon)

                    themeToggleDarkIcon.classList.toggle("hidden");

                if (themeToggleLightIcon)

                    themeToggleLightIcon.classList.toggle("hidden");

    

                // if set via local storage previously

                if (localStorage.getItem("color-theme")) {

                    if (localStorage.getItem("color-theme") === "cupcake") {

                        document.documentElement.setAttribute("data-theme", "forest");

                        localStorage.setItem("color-theme", "forest");

                    } else {

                        document.documentElement.setAttribute(

                            "data-theme",

                            "cupcake"

                        );

                        localStorage.setItem("color-theme", "cupcake");

                    }

    

                    // if NOT set via local storage previously

                } else {

                    if (

                        document.documentElement.getAttribute("data-theme") ===

                        "forest"

                    ) {

                        document.documentElement.setAttribute(

                            "data-theme",

                            "cupcake"

                        );

                        localStorage.setItem("color-theme", "cupcake");

                    } else {

                        document.documentElement.setAttribute("data-theme", "forest");

                        localStorage.setItem("color-theme", "forest");

                    }

                }

            });
    }
});
