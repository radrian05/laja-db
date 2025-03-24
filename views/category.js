document.addEventListener("DOMContentLoaded", function () {
    setupEditButton(); // Configurar los botones de edición al cargar la página
    setupAddCategoryButton(); // Configurar el botón para abrir el formulario de añadir categoría
    setupCloseAddCategoryButton(); // Configurar el botón para cerrar el formulario de añadir categoría
    setupCancelButtons(); // Configurar los botones de cancelar
});

function setupEditButton() {
    const editButtons = document.querySelectorAll(".edit"); // Seleccionar todos los botones de edición
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            openEditCategoryForm(button); // Pasar el botón clicado como argumento
        });
    });
}


function openEditCategoryForm(button) {
    const row = button.closest("tr"); // Obtener la fila más cercana al botón
    const id = row.id; // ID de la categoría
    const name = row.querySelector("td:nth-child(1)").textContent; // Nombre de la categoría
    const description = row.querySelector("td:nth-child(2)").textContent; // Descripción de la categoría

    const editForm = document.querySelector(".edit-category"); // Seleccionar el formulario de edición
    editForm.querySelector("input[name='id_categoria']").value = id; // Asignar el ID al formulario
    editForm.querySelector("input[name='nombre_categoria']").value = name; // Asignar el nombre al formulario
    editForm.querySelector("input[name='descripcion_categoria']").value = description; // Asignar la descripción al formulario

    editForm.classList.add("is-open"); // Mostrar el formulario de edición
    editForm.scrollIntoView({ behavior: "smooth" }); // Desplazar la vista hacia el formulario
}

function setupAddCategoryButton() {
    const addButton = document.querySelector(".add"); // Seleccionar el botón de añadir categoría
    const addForm = document.querySelector(".add-category"); // Seleccionar el formulario de añadir categoría
    if (addButton && addForm) {
        addButton.addEventListener("click", () => {
            addForm.classList.add("is-open"); // Añadir la clase is-open para mostrar el formulario
            addForm.scrollIntoView({ behavior: "smooth" }); // Desplazar la vista hacia el formulario
        });
    }
}

function setupCloseAddCategoryButton() {
    const closeButton = document.querySelector(".addClose"); // Seleccionar el botón de cerrar
    const addForm = document.querySelector(".add-category"); // Seleccionar el formulario de añadir categoría
    if (closeButton && addForm) {
        closeButton.addEventListener("click", () => {
            addForm.classList.remove("is-open"); // Quitar la clase is-open para ocultar el formulario
        });
    }
}

function setupCancelButtons() {
    const cancelAddButton = document.querySelector(".cancelAdd"); // Botón para cancelar añadir categoría
    const cancelEditButton = document.querySelector(".cancelEdit"); // Botón para cancelar editar categoría

    const addForm = document.querySelector(".add-category"); // Formulario de añadir categoría
    const editForm = document.querySelector(".edit-category"); // Formulario de editar categoría

    if (cancelAddButton && addForm) {
        cancelAddButton.addEventListener("click", () => {
            addForm.classList.remove("is-open"); // Quitar la clase is-open del formulario de añadir categoría
        });
    }

    if (cancelEditButton && editForm) {
        cancelEditButton.addEventListener("click", () => {
            editForm.classList.remove("is-open"); // Quitar la clase is-open del formulario de editar categoría
        });
    }
}
