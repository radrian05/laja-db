document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.getElementById("toggle-currency");
    if (toggleButton) {
        toggleButton.addEventListener("click", function() {
            const prices = document.querySelectorAll(".price");

            // Tasa de cambio, esta puede ser actualizada según la tasa actual
            const exchangeRate = 56; // Ejemplo: 1 USD = 56 Bs

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
        });
    }
});