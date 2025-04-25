document.addEventListener("DOMContentLoaded", function () {
    setupEditButtons();
    setupStockButtons();
    setupExchangeRateSwitch(); // Configurar el switch de tipo de cambio
});

function setupEditButtons() {
    const editButtons = document.querySelectorAll("[data-bs-target='#editProductModal']"); // Seleccionar los botones que abren el modal de edición
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            openEditProductModal(button);
        });
    });
}

function openEditProductModal(button) {
    const row = button.closest("tr"); // Obtener la fila más cercana al botón
    const id = row.id; // Obtener el ID de la fila
    const code = row.querySelector("td:nth-child(1)").textContent.trim(); // Código del producto
    const name = row.querySelector("td:nth-child(2)").textContent.trim(); // Nombre del producto
    const brand = row.querySelector("td:nth-child(3)").textContent.trim(); // Marca del producto
    const category = row.querySelector("td:nth-child(4)").textContent.trim(); // Categoría del producto
    const price = row.querySelector("td:nth-child(5)").textContent.replace('$', '').trim(); // Precio del producto

    // Seleccionar el formulario dentro del modal
    const editForm = document.querySelector("#editProductModal");

    // Asignar los valores al formulario
    editForm.querySelector("input[name='id']").value = id; // Asignar el ID al campo oculto
    editForm.querySelector("input[name='code']").value = code; // Asignar el código
    editForm.querySelector("input[name='name']").value = name; // Asignar el nombre
    editForm.querySelector("select[name='brand']").value = brand; // Asignar la marca
    editForm.querySelector("select[name='category']").value = category; // Asignar la categoría
    editForm.querySelector("input[name='price']").value = price; // Asignar el precio
}

function setupStockButtons() {
    // Configurar botones para aumentar stock
    const increaseButtons = document.querySelectorAll("[data-bs-target='#increaseStockModal']");
    increaseButtons.forEach(button => {
        button.addEventListener("click", function () {
            openIncreaseStockModal(button);
        });
    });

    // Configurar botones para disminuir stock
    const decreaseButtons = document.querySelectorAll("[data-bs-target='#decreaseStockModal']");
    decreaseButtons.forEach(button => {
        button.addEventListener("click", function () {
            openDecreaseStockModal(button);
        });
    });
}

function openIncreaseStockModal(button) {
    const row = button.closest("tr"); // Obtener la fila más cercana al botón
    const id = row.id; // Obtener el ID de la fila
    const name = row.querySelector("td:nth-child(2)").textContent.trim(); // Nombre del producto
    const stock = row.querySelector("td:nth-child(6)").textContent.trim(); // Stock actual del producto

    // Seleccionar el formulario dentro del modal
    const increaseForm = document.querySelector("#increaseStockModal");

    // Asignar los valores al formulario
    increaseForm.querySelector("input[name='id']").value = id; // Asignar el ID al campo oculto
    increaseForm.querySelector("#increase-quantity").value = ""; // Limpiar el campo de cantidad
    increaseForm.querySelector(".modal-title").textContent = `Aumentar Stock: ${name} (Stock actual: ${stock})`; // Actualizar el título del modal
}

function openDecreaseStockModal(button) {
    const row = button.closest("tr"); // Obtener la fila más cercana al botón
    const id = row.id; // Obtener el ID de la fila
    const name = row.querySelector("td:nth-child(2)").textContent.trim(); // Nombre del producto
    const stock = row.querySelector("td:nth-child(6)").textContent.trim(); // Stock actual del producto

    // Seleccionar el formulario dentro del modal
    const decreaseForm = document.querySelector("#decreaseStockModal");

    // Asignar los valores al formulario
    decreaseForm.querySelector("input[name='id']").value = id; // Asignar el ID al campo oculto
    decreaseForm.querySelector("#decrease-quantity").value = ""; // Limpiar el campo de cantidad
    decreaseForm.querySelector(".modal-title").textContent = `Disminuir Stock: ${name} (Stock actual: ${stock})`; // Actualizar el título del modal
}

// Configurar el switch de tipo de cambio
function setupExchangeRateSwitch() {
    const exchangeRateSwitch = document.getElementById("exchangeRateSwitch");
    const exchangeRate = parseFloat(exchangeRateSwitch.getAttribute("data-exchange-rate"));
    const prices = document.querySelectorAll(".price");

    exchangeRateSwitch.addEventListener("change", function () {
        if (this.checked) {
            // Convertir precios a Bolívares
            prices.forEach(price => {
                const valueInDollars = parseFloat(price.textContent.replace('$', '').trim());
                const valueInBolivars = (valueInDollars * exchangeRate).toFixed(2);
                price.textContent = `${valueInBolivars}Bs`;
            });
        } else {
            // Convertir precios a Dólares
            prices.forEach(price => {
                const valueInBolivars = parseFloat(price.textContent.replace('Bs', '').trim());
                const valueInDollars = (valueInBolivars / exchangeRate).toFixed(2);
                price.textContent = `${valueInDollars}$`; // Asegurar que el símbolo de dólar esté a la derecha
            });
        }
    });
}