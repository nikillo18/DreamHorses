
// Este script maneja la lógica para cambiar y persistir el tema (claro/oscuro) de la aplicación.

// Define los nombres de los temas para evitar errores tipográficos.
const THEME_LIGHT = 'cupcake';
const THEME_DARK = 'forest';

// Elementos del DOM que se utilizarán para cambiar los iconos del botón de tema.
const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
const themeToggleButton = document.getElementById('theme-toggle');

/**
 * Obtiene el tema preferido del usuario desde el localStorage.
 * Si no hay un tema guardado, utiliza el tema oscuro como predeterminado.
 * @returns {string} El tema preferido ('cupcake' o 'forest').
 */
function getPreferredTheme() {
    return localStorage.getItem('theme') || THEME_DARK;
}

/**
 * Aplica el tema guardado en el localStorage al elemento <html>.
 * Este script se ejecuta de forma síncrona en el <head> para evitar el "flash" (FOUC).
 */
function applyTheme() {
    const theme = getPreferredTheme();
    document.documentElement.setAttribute('data-theme', theme);
}

/**
 * Actualiza la visibilidad de los iconos del botón de cambio de tema.
 * Muestra el icono correspondiente al tema ACTIVO.
 */
function updateThemeIcons() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    if (currentTheme === THEME_DARK) {
        themeToggleDarkIcon?.classList.remove('hidden');
        themeToggleLightIcon?.classList.add('hidden');
    } else {
        themeToggleDarkIcon?.classList.add('hidden');
        themeToggleLightIcon?.classList.remove('hidden');
    }
}

/**
 * Cambia el tema actual al opuesto (claro a oscuro o viceversa),
 * lo guarda en el localStorage y actualiza los iconos.
 */
function toggleTheme() {
    const oldTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = oldTheme === THEME_DARK ? THEME_LIGHT : THEME_DARK;

    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcons();
}

// Aplica el tema inmediatamente al cargar el script.
applyTheme();

// Asegúrate de que el DOM esté completamente cargado antes de añadir event listeners.
document.addEventListener('DOMContentLoaded', () => {
    // Actualiza los iconos del tema tan pronto como el DOM esté listo.
    updateThemeIcons();

    // Añade el listener al botón para cambiar el tema al hacer clic.
    if (themeToggleButton) {
        themeToggleButton.addEventListener('click', toggleTheme);
    }
});
