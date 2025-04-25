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
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?> <!--head-->
    <title>Historial</title>
</head>

<body>
    <?php include_once 'nav.php'; ?> <!--navbar y sidebar-->

    <div class="container-fluid"> <!--CONTENIDO AQUI-->
        <div class="col min-vh-100 p-4">
            <h1></h1>

            <div class="container my-4">
                <!-- Detalles del Producto -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Detalles del Producto</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Código:</strong> <?php echo $product->CODE; ?></p>
                                <p><strong>Nombre:</strong> <?php echo $product->NAME; ?></p>
                                <p><strong>Marca:</strong> <?php echo $product->BRAND; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Categoría:</strong> <?php echo $product->CATEGORY; ?></p>
                                <p><strong>Precio:</strong> $<?php echo $product->PRICE; ?></p>
                                <p><strong>Stock:</strong> <?php echo $product->STOCK; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Historial del Producto</h2>
                    <div>
                        <button class="btn btn-primary me-2" onclick="window.print()">Imprimir</button>
                        <a href="dashboard.php" class="btn btn-secondary">Volver a la lista de productos</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table">
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
                                    <td colspan="6" class="text-center">No hay historial para este producto.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="darkModeSwitch" checked>
            <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
        </div>
    </div>
</body>

</html>