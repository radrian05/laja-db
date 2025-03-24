document.addEventListener("DOMContentLoaded", function() {
    setupToggleCurrencyButton();
    setupEditButtons();
    setupAddProductButton();
    setupCloseAddProductButton();
    setupCancelButtons(); // Configurar los botones de cancelar
});

function setupToggleCurrencyButton() {
    const toggleButton = document.getElementById("toggle-currency");
    if (toggleButton) {
        toggleButton.addEventListener("click", function() {
            toggleCurrency(toggleButton);
        });
    }
}

function toggleCurrency(toggleButton) {
    const prices = document.querySelectorAll(".price");
    const exchangeRate = parseFloat(document.getElementById('exchangeRateValue').value);
    if (exchangeRate === 0) {
        return;
    }

    if (toggleButton.textContent === "Ver en Bolívares") {
        prices.forEach((price) => {
            const valueInDollars = parseFloat(price.textContent.replace('$', ''));
            const valueInBolivars = (valueInDollars * exchangeRate).toFixed(2);
            price.textContent = `Bs ${valueInBolivars}`;
        });
        toggleButton.textContent = "Ver en Dólares";
    } else {
        prices.forEach((price) => {
            const valueInBolivars = parseFloat(price.textContent.replace('Bs', ''));
            const valueInDollars = (valueInBolivars / exchangeRate).toFixed(2);
            price.textContent = `$${valueInDollars}`;
        });
        toggleButton.textContent = "Ver en Bolívares";
    }
}

function setupEditButtons() {
    const editButtons = document.querySelectorAll(".edit");
    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            openEditProductForm(button);
        });
    });
}

function openEditProductForm(button) {
    const row = button.closest("tr");
    const id = row.id;
    const code = row.querySelector("td:nth-child(1)").textContent;
    const name = row.querySelector("td:nth-child(2)").textContent;
    const brand = row.querySelector("td:nth-child(3)").textContent;
    const category = row.querySelector("td:nth-child(4)").textContent;
    const price = row.querySelector("td:nth-child(5)").textContent.replace('$', '');
    const stock = row.querySelector("td:nth-child(6)").textContent;

    const editForm = document.querySelector(".edit-product");
    editForm.querySelector("input[name='id']").value = id;
    editForm.querySelector("input[name='code']").value = code;
    editForm.querySelector("input[name='name']").value = name;
    editForm.querySelector("select[name='brand']").value = brand;
    editForm.querySelector("select[name='category']").value = category;
    editForm.querySelector("input[name='price']").value = price;
    editForm.querySelector("input[name='stock']").value = stock;

    editForm.classList.add("is-open");
    editForm.scrollIntoView({ behavior: 'smooth' });
}

function setupAddProductButton() {
    const addButton = document.querySelector(".add");
    const addForm = document.querySelector(".add-product");
    addButton.addEventListener('click', () => {
        addForm.classList.add("is-open");
        addForm.scrollIntoView({ behavior: "smooth" });
    });
}

function setupCloseAddProductButton() {
    const closeButton = document.querySelector(".addClose");
    const addForm = document.querySelector(".add-product");
    if (closeButton) {
        closeButton.addEventListener('click', () => {
            addForm.classList.remove("is-open");
        });
    }
}

function setupCancelButtons() {
    const cancelAddButton = document.querySelector(".cancelAdd"); // Botón para cancelar añadir producto
    const cancelEditButton = document.querySelector(".cancelEdit"); // Botón para cancelar editar producto

    const addForm = document.querySelector(".add-product"); // Formulario de añadir producto
    const editForm = document.querySelector(".edit-product"); // Formulario de editar producto

    if (cancelAddButton && addForm) {
        cancelAddButton.addEventListener("click", () => {
            addForm.classList.remove("is-open"); // Quitar la clase is-open del formulario de añadir producto
        });
    }

    if (cancelEditButton && editForm) {
        cancelEditButton.addEventListener("click", () => {
            editForm.classList.remove("is-open"); // Quitar la clase is-open del formulario de editar producto
        });
    }
}