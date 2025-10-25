import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

        plugins: [
        forms,
        daisyui,
    ],
    
    daisyui: {
        themes: [
            {
                // Tema Forest exacto del Theme Generator de DaisyUI
                "forest": {
                    "primary": "#1eb854",
                    "primary-content": "#000e04",
                    "secondary": "#1fd65f",
                    "secondary-content": "#001203",
                    "accent": "#1db584",
                    "accent-content": "#000c06",
                    "neutral": "#19362d",
                    "neutral-content": "#cdd2d0",
                    "base-100": "#2a3f37",
                    "base-200": "#24352d",
                    "base-300": "#1e2b23",
                    "base-content": "#d5dbd8",
                    "info": "#2563eb",
                    "info-content": "#d1e7ff",
                    "success": "#16a34a",
                    "success-content": "#000702",
                    "warning": "#d97706",
                    "warning-content": "#110400",
                    "error": "#dc2626",
                    "error-content": "#ffd9d4",
                }
            }
        ],
        darkTheme: "forest", // Establecer forest como tema oscuro por defecto
        base: true,
        styled: true,
        utils: true,
        prefix: "",
        logs: true,
        themeRoot: ":root",
    },
};
