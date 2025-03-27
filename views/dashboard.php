<?php
    include_once '../helpers/session_helper.php';
    ensureLoggedIn();
    include_once 'items.php';
    require_once 'sidebar.php';
    require_once '../controllers/categories.php'; // Incluir el controlador de categorías
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Inventario</title>
        <link rel="stylesheet" href="dashboard.css" type="text/css">
    </head>

    <body>
        <main>
            <?php flash('add_item') ?> 
            <?php flash('delete_item') ?>
            <?php flash('product_message') ?>

            <?php generateSidebar(basename($_SERVER['PHP_SELF'])); ?>

            <img class="logo" src="logo.jpeg">
            <h1 id="index-text">Bienvenido, <?php echo explode(" ", $_SESSION['userName'])[0]; ?> </h1>
            <section class="product-list">
                <h2>Lista de Productos</h2>
                <div class="button-container">
                    <button id="toggle-currency">Ver en Bolívares</button>
                    <button onclick="window.print()">Imprimir</button>
                    <button class="add">+</button>   
                </div>
                <table aria-label="Lista de productos">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php generateTable(); ?>
                    </tbody>
                </table>
            </section>

            <section class="add-product">
                <h1 id="addProductTitle">Añadir Nuevo Producto</h1>
                <form action="../controllers/items.php" method="post" aria-labelledby="addProductTitle">
                    <input type="hidden" name="type" value="addItem">

                    <label for="code">Código del Producto:</label>
                    <input type="text" id="code" name="code" aria-label="Código del Producto" required>

                    <label for="name">Nombre del Producto:</label>
                    <input type="text" id="name" name="name" aria-label="Nombre del Producto" required>

                    <label for="brand">Marca:</label>
                    <select id="brand" name="brand" aria-label="Marca" required>
                        <option value="Kia">Kia</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Misc">Misceláneos</option>
                    </select>

                    <label for="category">Categoría:</label>
                    <select id="category" name="category" aria-label="Categoría" required>
                        <?php
                        $categories = $categoryController->getCategories(); // Obtener las categorías
                        foreach ($categories as $category) {
                            echo "<option value='{$category->id_categoria}'>{$category->nombre_categoria}</option>";
                        }
                        ?>
                    </select>

                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" step="0.01" aria-label="Precio" required>

                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" aria-label="Stock" required>

                    <button type="submit" aria-label="Añadir producto">Añadir Producto</button>
                    <button type="button" class="cancelAdd" aria-label="Cancelar añadir producto">Cancelar</button>
                </form>
            </section>

            <div class="edit-product">
                <h2>Editar Producto</h2>
                <form action="../controllers/items.php" method="post">
                    <input type="hidden" name="type" value="editItem">
                    <input type="hidden" name="id" value="" required>
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
                        <?php
                            $categories = $categoryController->getCategories(); // Obtener las categorías
                            foreach ($categories as $category) {
                                echo "<option value='{$category->id_categoria}'>{$category->nombre_categoria}</option>";
                            }
                        ?>
                    </select>

                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" step="0.01" required>

                    <button type="submit">Confirmar</button>
                    <button type="button" class="cancelEdit">Cancelar</button>
                </form>
            </div>
 
            <div class="increase-stock">
                <form method="post" action="../controllers/items.php">
                    <h2>Aumentar Stock</h2>
                    <input type="hidden" name="type" value="increaseStock">
                    <input type="hidden" name="id" id="increase-stock-id">
                    <label for="increase-quantity">Cantidad:</label>
                    <input type="number" name="quantity" id="increase-quantity" min="1" required>
                    <button type="submit">Confirmar</button>
                    <button type="button" class="close-modal">Cancelar</button>
                </form>
            </div>

            <div class="decrease-stock">
                <form method="post" action="../controllers/items.php">
                    <h2>Disminuir Stock</h2>
                    <input type="hidden" name="type" value="decreaseStock">
                    <input type="hidden" name="id" id="decrease-stock-id">
                    <label for="decrease-quantity">Cantidad:</label>
                    <input type="number" name="quantity" id="decrease-quantity" min="1" required>
                    <button type="submit">Confirmar</button>
                    <button type="button" class="close-modal">Cancelar</button>
                </form>
            </div>
        </main>

        <!--<footer>
            <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/radrian05/laja-db">LAJA DB</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/radrian05">Adrian Rojas, Alvaro Lara, Juan Jordan, Leizzy Goitia</a> is licensed under <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>
        </footer>-->

        <input type="hidden" id="exchangeRateValue" value="<?php echo isset($_SESSION['exchangeRate']) ? $_SESSION['exchangeRate'] : 00; ?>">

        <script src="sidebar.js"></script>
        <script src="dashboard.js"></script>
        <script src="alert.js"></script>
    </body>
</html>