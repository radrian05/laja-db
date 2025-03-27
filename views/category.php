<?php
    include_once '../helpers/session_helper.php';
    ensureLoggedIn();
    require_once 'sidebar.php';
    require_once 'generate_categories.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Categorías</title>
        <link rel="stylesheet" href="dashboard.css" type="text/css">
    </head>

    <body>
        <main>
            <?php generateSidebar(basename($_SERVER['PHP_SELF'])); ?>
            <img class="logo" src="logo.jpeg">
            <h1 id="index-text">Bienvenido, <?php echo explode(" ", $_SESSION['userName'])[0]; ?> </h1>
            <section class="category-list">
                <h2>Lista de Categorías</h2>
                <?php flash('category_message'); ?>
                <div class="button-container">
                    <button class="add" aria-label="Añadir nueva categoría">+</button>
                </div>

                <table aria-label="Lista de categorías">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php generateCategoryTable()?>
                    </tbody>
                </table>
                <div class="add-category">
                    <h2>Añadir Categoría</h2>
                    <form action="../controllers/categories.php" method="post" aria-labelledby="addCategoryTitle">
                        <input type="hidden" name="type" value="addCategory">
                        <label for="nombre_categoria">Nombre de la categoría</label>
                        <input type="text" id="nombre_categoria" name="nombre_categoria" placeholder="Nombre de la categoría" aria-label="Nombre de la categoría" required>
                        <label for="descripcion_categoria">Descripción de la categoría</label>
                        <input type="text" id="descripcion_categoria" name="descripcion_categoria" placeholder="Descripción de la categoría" aria-label="Descripción de la categoría" required>
                        <button type="submit" aria-label="Añadir categoría">Añadir</button>
                        <button class="cancelAdd" aria-label="Cancelar añadir categoría">Cancelar</button>
                    </form>
                </div>

                <div class="edit-category">
                    <h2>Editar Categoría</h2>
                    <form action="../controllers/categories.php" method="post">
                        <input type="hidden" name="type" value="updateCategory">
                        <input type="hidden" name="id_categoria" value=" " required="">
                        <input type="text" name="nombre_categoria" placeholder="Nombre de la categoría" required>
                        <input type="text" name="descripcion_categoria" placeholder="Descripción de la categoría" required>
                        <button type="submit">Añadir</button>
                        <button type="button" class="cancelEdit">Cancelar</button>
                    </form>
                </div>
        </main>

        <footer>
            <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/radrian05/laja-db">LAJA DB</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/radrian05">Adrian Rojas, Alvaro Lara, Juan Jordan, Leizzy Goitia</a> is licensed under <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>
        </footer>

        <script src="sidebar.js"></script>
        <script src="category.js"></script>
        <script src="alert.js"></script>
    </body>
</html>

