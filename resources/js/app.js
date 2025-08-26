import "./bootstrap";

import Alpine from "alpinejs";
import "cally";
window.Alpine = Alpine;

Alpine.start();

window.addEventListener("load", function () {
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.setAttribute("data-theme", "dark");
        if(themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
    } else {
        document.documentElement.setAttribute("data-theme", "light");
        if(themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
    }

    const themeToggle = document.getElementById('theme-toggle');

    if(themeToggle) {
        themeToggle.addEventListener('click', function() {

            // toggle icons inside button
            if(themeToggleDarkIcon) themeToggleDarkIcon.classList.toggle('hidden');
            if(themeToggleLightIcon) themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('color-theme', 'light');
                }

            // if NOT set via local storage previously
            } else {
                if (document.documentElement.getAttribute("data-theme") === 'dark') {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
            
        });
    }
});
