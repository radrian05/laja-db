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
        echo "<p>Precio del dólar del día: Bs $exchangeRate</p>";
        echo '<button id="modify-exchange-rate">Modificar</button>';
        echo '<form id="exchange-rate-form" method="post" action="set_exchange_rate.php" style="display:none;">
                <label for="exchangeRate">Ingrese el precio del dólar del día:</label>
                <input type="number" id="exchangeRate" name="exchangeRate" min="0" step="0.01" value="' . $exchangeRate . '" required>
                <button type="submit">Guardar</button>
              </form>';
    } else {
        echo '<form method="post" action="set_exchange_rate.php">
                <label for="exchangeRate">Ingrese el precio del dólar del día:</label>
                <input type="number" id="exchangeRate" name="exchangeRate" min="0" step="0.01" required>
                <button type="submit">Guardar</button>
              </form>';
    }
}
?>