<?php
include_once '../helpers/session_helper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['exchangeRate'])) {
    $_SESSION['exchangeRate'] = $_POST['exchangeRate'];
    header('Location: home.php');
    exit();
}

function generateExchangeRateField() {
    if (isset($_SESSION['exchangeRate'])) {
        $exchangeRate = $_SESSION['exchangeRate'];
        echo '<div class="d-flex justify-content-center align-items-center">';
        echo '<div class="card p-4 shadow" style="max-width: 400px;">'; // Usar una tarjeta con ancho máximo
        echo "<p class='fs-4 text-center'>Precio del dólar del día: <strong>Bs $exchangeRate</strong></p>";
        echo '<button id="modify-exchange-rate" class="btn btn-primary w-100">Modificar</button>';
        echo '<form id="exchange-rate-form" method="post" action="set_exchange_rate.php" class="mt-3" style="display:none;" aria-labelledby="exchangeRateFormTitle">
                <h2 id="exchangeRateFormTitle" class="fs-5 text-center">Actualizar Tipo de Cambio</h2>
                <div class="mb-3">
                    <label for="exchangeRate" class="form-label">Ingrese el precio del dólar del día:</label>
                    <input type="number" id="exchangeRate" name="exchangeRate" min="1" step="0.01" value="' . $exchangeRate . '" class="form-control" aria-label="Precio del dólar" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" aria-label="Guardar tipo de cambio">Guardar</button>
              </form>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="d-flex justify-content-center align-items-center">';
        echo '<div class="card p-4 shadow" style="max-width: 400px;">'; // Usar una tarjeta con ancho máximo
        echo '<form method="post" action="set_exchange_rate.php" aria-labelledby="exchangeRateFormTitle">
                <h2 id="exchangeRateFormTitle" class="fs-5 text-center">Ingrese el precio del dólar del día</h2>
                <div class="mb-3">
                    <label for="exchangeRate" class="form-label">Precio del dólar:</label>
                    <input type="number" id="exchangeRate" name="exchangeRate" min="1" step="0.01" class="form-control" aria-label="Precio del dólar" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" aria-label="Guardar tipo de cambio">Guardar</button>
              </form>';
        echo '</div>';
        echo '</div>';
    }
}
?>