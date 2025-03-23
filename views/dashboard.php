<?php
    include_once '../helpers/session_helper.php';
    ensureLoggedIn();
    include_once 'items.php';
    require_once 'sidebar.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Productos</title>
        <link rel="stylesheet" href="dashboard.css" type="text/css">
    </head>

    <body>
        <main>
            <?php flash('add_item') ?> 
            <?php flash('delete_item') ?>

            <?php generateSidebar(basename($_SERVER['PHP_SELF'])); ?>

            <img class="logo" src="logo.jpeg">
            <h1 id="index-text">Bienvenido, <?php echo explode(" ", $_SESSION['userName'])[0]; ?> </h1>
            <section class="product-list">
                <h2>Lista de Productos</h2>
                <div class="button-container">
                    <button id="toggle-currency">Ver en Bolívares</button>
                    <button class="add">+</button>
                </div>
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

            <section class="add-product">
                <h1>Añadir Nuevo Producto</h1>
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
                        <option value="Aceites">Aceites</option>
                        <option value="Amortiguadores">Amortiguadores</option>
                        <option value="Filtros ">Filtros</option>
                        <option value="Accesorios">Accesorios</option>
                    </select>

                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" step="0.01" required>

                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" required>

                    <button type="submit">Añadir Producto</button>
                    <button type="button" class="addClose">Cancelar</button>
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
                        <option value="Categoria1">Categoria1</option>
                        <option value="Categoria2">Categoria2</option>
                        <option value="Categoria3">Categoria3</option>
                        <option value="Accesorios">Accesorios</option>
                    </select>

                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" step="0.01" required>

                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" required>

                    <button type="submit">Confirmar</button>
                    <button>Cancelar</button>
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