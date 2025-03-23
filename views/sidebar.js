// Selección de elementos
const $toggle = document.querySelector(".toggle");
const $sidebar = document.querySelector(".sidebar");
const $closeSidebarButton = document.querySelector(".closeSidebarButton");
const $sidebarLinks = document.querySelectorAll(".sidebar ul li a");
const $allFocusableElements = document.querySelectorAll("a, button, input, select, textarea, [tabindex]");

// Función: Actualizar el tabindex de los elementos de la sidebar
function updateSidebarTabindex(isOpen) {
    $sidebarLinks.forEach(link => {
        if (isOpen) {
            link.setAttribute("tabindex", "0"); // Hacer accesibles los enlaces de la sidebar
        } else {
            link.setAttribute("tabindex", "-1"); // Excluir del flujo de tabulación
        }
    });
}

// Función: Actualizar el tabindex de todos los demás elementos fuera de la sidebar
function updatePageTabindex(isSidebarOpen) {
    $allFocusableElements.forEach(element => {
        if (!$sidebar.contains(element) && element !== $toggle) {
            if (isSidebarOpen) {
                element.setAttribute("tabindex", "-1"); // Excluir del flujo de tabulación
            } else {
                element.removeAttribute("tabindex"); // Restaurar el tabindex predeterminado
            }
        }
    });
}

// Función: Abrir la sidebar
function openSidebar() {
    $sidebar.classList.add("is-open");
    $toggle.classList.add("is-open");
    updateSidebarTabindex(true); // Hacer accesibles los elementos de la sidebar
    updatePageTabindex(true); // Excluir los elementos fuera de la sidebar
}

// Función: Cerrar la sidebar
function closeSidebar() {
    $sidebar.classList.remove("is-open");
    $toggle.classList.remove("is-open");
    updateSidebarTabindex(false); // Excluir los elementos de la sidebar
    updatePageTabindex(false); // Restaurar los elementos fuera de la sidebar
}

// Inicialización: Remover tabindex de los elementos de la sidebar al cargar la página
updateSidebarTabindex(false);

// Evento: Abrir/cerrar la sidebar al hacer clic en el botón toggle
$toggle.addEventListener("click", () => {
    if ($sidebar.classList.contains("is-open")) {
        closeSidebar();
    } else {
        openSidebar();
    }
});

// Evento: Cerrar la sidebar al hacer clic en el botón de cerrar
$closeSidebarButton.addEventListener("click", closeSidebar);