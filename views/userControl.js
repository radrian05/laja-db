document.addEventListener("DOMContentLoaded", function () {
    setupAddUserButton(); // Configurar el botón para abrir el formulario de añadir usuario
    setupChangePasswordButton(); // Configurar el botón para abrir el formulario de cambiar contraseña
    setupCancelButtons(); // Configurar los botones de cancelar
});

function setupAddUserButton() {
    const addButton = document.querySelector(".add"); // Botón para abrir el formulario de añadir usuario
    const addForm = document.querySelector(".add-user"); // Formulario de añadir usuario
    if (addButton && addForm) {
        addButton.addEventListener("click", () => {
            addForm.classList.add("is-open"); // Añadir la clase is-open para mostrar el formulario
            addForm.scrollIntoView({ behavior: "smooth" }); // Desplazar la vista hacia el formulario
        });
    }
}

function setupChangePasswordButton() {
    const changePasswordButtons = document.querySelectorAll(".changePassword"); // Botones para abrir el formulario de cambiar contraseña
    const changePasswordForm = document.querySelector(".change-password"); // Formulario de cambiar contraseña
    const userIdField = changePasswordForm.querySelector("input[name='userId']"); // Campo oculto userId

    if (changePasswordButtons && changePasswordForm && userIdField) {
        changePasswordButtons.forEach(button => {
            button.addEventListener("click", () => {
                const row = button.closest("tr"); // Obtener la fila más cercana al botón
                const userId = row.id; // Obtener la id de la fila (userId)
                userIdField.value = userId; // Asignar el userId al campo oculto del formulario

                changePasswordForm.classList.add("is-open"); // Añadir la clase is-open para mostrar el formulario
                changePasswordForm.scrollIntoView({ behavior: "smooth" }); // Desplazar la vista hacia el formulario
            });
        });
    }
}

function setupCancelButtons() {
    const cancelAddButton = document.querySelector(".cancelAdd"); // Botón para cerrar el formulario de añadir usuario
    const cancelChangeButton = document.querySelector(".cancelChange"); // Botón para cerrar el formulario de cambiar contraseña

    const addForm = document.querySelector(".add-user"); // Formulario de añadir usuario
    const changePasswordForm = document.querySelector(".change-password"); // Formulario de cambiar contraseña

    if (cancelAddButton && addForm) {
        cancelAddButton.addEventListener("click", () => {
            addForm.classList.remove("is-open"); // Quitar la clase is-open para ocultar el formulario
        });
    }

    if (cancelChangeButton && changePasswordForm) {
        cancelChangeButton.addEventListener("click", () => {
            changePasswordForm.classList.remove("is-open"); // Quitar la clase is-open para ocultar el formulario
        });
    }
}e