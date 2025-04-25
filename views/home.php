<?php
include_once '../helpers/session_helper.php';
ensureLoggedIn();
require_once 'set_exchange_rate.php';

?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?> <!--head-->
    <title>Inicio</title>
</head>

<body>
    <?php include_once 'nav.php'; ?> <!--navbar y sidebar-->

    <div class="container-fluid"> <!--CONTENIDO AQUI-->
        <div class="col min-vh-100 p-4">
            <h1>Bienvenido</h1>
            <?php generateExchangeRateField(); ?>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modifyButton = document.getElementById("modify-exchange-rate");
            const exchangeRateForm = document.getElementById("exchange-rate-form");

            if (modifyButton) {
                modifyButton.addEventListener("click", function() {
                    exchangeRateForm.style.display = "block";
                    modifyButton.style.display = "none";
                });
            }
        });
    </script>
</body>

</html>