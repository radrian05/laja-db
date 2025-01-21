<?php
    include_once '../helpers/session_helper.php';
    ensureLoggedIn();
    include_once 'items.php'
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Login System</title>
        <link rel="stylesheet" href="dashstyle.css" type="text/css">
    </head>

    <body>
        <nav>
            <img src="logo.jpeg" height="60px" alt="logo">
            <ul>
                <a href="../controllers/Users.php?q=logout"><li>Cerrar Sesión</li></a>
            </ul>
        </nav>
        
        <main>
            <?php flash('add_item') ?>
            <?php flash('delete_item') ?>
            <h1 id="index-text">Bienvenido, <?php echo explode(" ", $_SESSION['userName'])[0]; ?> </h1>
            <section id="product-list">
                <h2>Lista de Productos</h2>
                <button id="toggle-currency">Ver en Bolívares</button>
                <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php generateTable(); ?>
                </tbody>
            </table>
            </section>

            <section id="add-product">
                <h2>Añadir Nuevo Producto</h2>
                <form action="../controllers/items.php" method="post">
                    <input type="hidden" name="type" value="addItem">

                    <label for="code">Código del Producto:</label>
                    <input type="text" id="code" name="code" required>

                    <label for="name">Nombre del Producto:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="brand">Marca:</label>
                    <select id="brand" name="brand" required>
                        <option value="Kia">Kia</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Misc">Misceláneos</option>
                    </select>

                    <label for="category">Categoría:</label>
                    <select id="category" name="category" required>
                        <option value="Categoria1">Categoria1</option>
                        <option value="Categoria2">Categoria2</option>
                        <option value="Categoria3">Categoria3</option>
                        <option value="Accesorios">Accesorios</option>
                    </select>

                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" step="0.01" required>

                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" required>

                    <button type="submit">Añadir Producto</button>
                </form>
            </section>
        </main>
        <footer>
            <p>&copy; LAJA-DB <?php echo date("Y"); ?></p>
        </footer>

        <script src="dashboard.js"></script>
    </body>
</html>