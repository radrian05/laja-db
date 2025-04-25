document.addEventListener("DOMContentLoaded", function () {
    setupEditButtons(); // Configurar los botones de edición al cargar la página
});

function setupEditButtons() {
    // Seleccionar todos los botones de edición generados dinámicamente
    const editButtons = document.querySelectorAll(".edit");
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            openEditCategoryModal(button); // Pasar el botón clicado como argumento
        });
    });
}

function openEditCategoryModal(button) {
    // Obtener los datos de los atributos data-* del botón
    const id = button.getAttribute("data-id");
    const nombre = button.getAttribute("data-nombre");
    const descripcion = button.getAttribute("data-descripcion");

    // Seleccionar el modal de edición
    const editModal = document.querySelector("#editCategoryModal");

    // Asignar los valores a los campos del formulario dentro del modal
    editModal.querySelector("#edit-id_categoria").value = id;
    editModal.querySelector("#edit-nombre_categoria").value = nombre;
    editModal.querySelector("#edit-descripcion_categoria").value = descripcion;
}

