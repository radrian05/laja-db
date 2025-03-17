document.addEventListener("DOMContentLoaded", function() {
    const alertBox = document.querySelector(".alert");
    if (alertBox) {
        setTimeout(() => {
            alertBox.classList.add("fade-out");
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 1000); // Espera a que termine la transición antes de ocultar el elemento
        }, 3000); // 3 segundos antes de empezar a desvanecer
    }
});