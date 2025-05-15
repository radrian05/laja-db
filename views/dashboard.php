<?php
include_once '../helpers/session_helper.php';
ensureLoggedIn();
include_once 'items.php';
include_once 'productListForms.php';

$exchangeRate = isset($_SESSION['exchangeRate']) ? $_SESSION['exchangeRate'] : 1;
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?> <!--head-->
    <title>Lista de Inventario</title>
    <script src="newdash.js"></script>
    <style>
        @media print {
            body {
                background-color: white !important;
                color: black !important;
            }

            .table {
                color: black !important;
            }

            .btn,
            .form-check-input,
            .form-check-label {
                display: none !important;
            }

            .navbar,
            .sidebar {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <?php include_once 'nav.php'; ?> <!--navbar y sidebar-->
    <?php flash('add_item') ?>
    <?php flash('edit_item')?>
    <?php flash('delete_item')?>
    <?php flash('stock_message')?>

    <div class="container-fluid"> <!--CONTENIDO AQUI-->
        <div class="col min-vh-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Lista de Productos</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-lg"></i>Añadir producto
                </button>
            </div>
            <div class="d-flex gap-2 mb-1">
                <div class="d-flex justify-content-between w-100">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="exchangeRateSwitch" data-exchange-rate="<?php echo $exchangeRate; ?>">
                        <label class="form-check-label" for="exchangeRateSwitch">
                            Ver en Bolivares
                        </label>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="window.print()">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>
            </div>

            <?php generateTable(); ?>

        </div>
    </div>

    <?php addProductForm(); ?>
    <?php editProductForm(); ?>
    <?php increaseStockForm(); ?>
    <?php decreaseStockForm(); ?>


</body>

</html>