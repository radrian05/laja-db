<?php
include_once '../helpers/session_helper.php';
ensureLoggedIn();
require_once 'sidebar.php';
require_once 'set_exchange_rate.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="sidebar.css" type="text/css">
</head>

<?php generateSidebar(basename($_SERVER['PHP_SELF'])); ?>

<body>
    <main>
        <span class="toggle">&#9776;</span>
        <img class="logo" src="logo.jpeg">
        <h1 id="index-text">Bienvenido, <?php echo explode(" ", $_SESSION['userName'])[0]; ?> </h1>
        
        <?php generateExchangeRateField(); ?>
    </main>

    <footer>
        <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/radrian05/laja-db">LAJA DB</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/radrian05">Adrian Rojas, Alvaro Lara, Juan Jordan, Leizzy Goitia</a> is licensed under <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>
    </footer>

    <script src="sidebar.js"></script>
    <script src="dashboard.js"></script>
    <script src="alert.js"></script>
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

