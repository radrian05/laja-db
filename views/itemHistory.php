<?php
require_once '../helpers/session_helper.php';
require_once '../controllers/items.php';
ensureLoggedIn();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    flash('product_message', 'ID de producto no proporcionado');
    redirect('dashboard.php');
}

$productId = htmlspecialchars(trim($_GET['id']));
$product = $ItemController->getItemById($productId);
if (!$product) {
    flash('product_message', 'Producto no encontrado');
    redirect('dashboard.php');
}

$history = $ItemController->getProductHistory($productId);
require_once 'sidebar.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalles del Producto</title>
        <link rel="stylesheet" href="dashboard.css" type="text/css">
    </head>
    <body>
        <main>
            <?php flash('product_message'); ?>
            <?php generateSidebar(basename($_SERVER['PHP_SELF'])); ?>

            <img class="logo" src="logo.jpeg">
            <h1 id="index-text">Detalles del Producto</h1>

            <section class="product-details">
                <p><strong>Código:</strong> <?php echo $product->CODE; ?></p>
                <p><strong>Nombre:</strong> <?php echo $product->NAME; ?></p>
                <p><strong>Marca:</strong> <?php echo $product->BRAND; ?></p>
                <p><strong>Categoría:</strong> <?php echo $product->CATEGORY; ?></p>
                <p><strong>Precio:</strong> $<?php echo $product->PRICE; ?></p>
                <p><strong>Stock:</strong> <?php echo $product->STOCK; ?></p>
            </section>

            <section class="product-history">
                <h2>Historial del Producto</h2>
                <div class="button-container">
                    <button onclick="window.print()">Imprimir</button>
                    <button onclick="window.location.href='dashboard.php'">Volver a la lista de productos</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Nota</th>
                            <th>Referencia</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($history): ?>
                            <?php foreach ($history as $entry): ?>
                                <tr>
                                    <td><?php echo $entry->fecha; ?></td>
                                    <td><?php echo $entry->user_name; ?></td>
                                    <td><?php echo $entry->nota; ?></td>
                                    <td><?php echo $entry->referencia; ?></td>
                                    <td><?php echo $entry->stock_up; ?></td>
                                    <td><?php echo $entry->stock_down; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No hay historial para este producto.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

        </main>

        <script src="sidebar.js"></script>
        <script src="alert.js"></script>
    </body>
</html>