<?php
include_once '../helpers/session_helper.php';
ensureLoggedIn();
require_once 'generate_categories.php';
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?> <!--head-->
    <title>Categorias</title>
    <script src="category.js"></script>
</head>

<body>
    <?php include_once 'nav.php'; ?> <!--navbar y sidebar-->

    <div class="container-fluid"> <!--CONTENIDO AQUI-->
        <div class="col min-vh-100 p-4">
            <h1>Categorias</h1>
            <div class="d-flex gap-2 mb-1">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal" aria-label="Añadir nueva categoría">Añadir Categoría</button>
            </div>
            <?php generateCategoryTable(); ?>
        </div>
    </div>

    <!-- Modal de Añadir Categoría -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="addCategoryModalLabel">Añadir Categoría</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/categories.php" method="post" aria-labelledby="addCategoryModalLabel">
                        <input type="hidden" name="type" value="addCategory">
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label">Nombre de la categoría</label>
                            <input type="text" id="nombre_categoria" name="nombre_categoria" class="form-control" placeholder="Nombre de la categoría" aria-label="Nombre de la categoría" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_categoria" class="form-label">Descripción de la categoría</label>
                            <input type="text" id="descripcion_categoria" name="descripcion_categoria" class="form-control" placeholder="Descripción de la categoría" aria-label="Descripción de la categoría" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Añadir</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar Categoría -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="editCategoryModalLabel">Editar Categoría</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/categories.php" method="post">
                        <input type="hidden" name="type" value="updateCategory">
                        <input type="hidden" name="id_categoria" id="edit-id_categoria" required>
                        <div class="mb-3">
                            <label for="edit-nombre_categoria" class="form-label">Nombre de la categoría</label>
                            <input type="text" id="edit-nombre_categoria" name="nombre_categoria" class="form-control" placeholder="Nombre de la categoría" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-descripcion_categoria" class="form-label">Descripción de la categoría</label>
                            <input type="text" id="edit-descripcion_categoria" name="descripcion_categoria" class="form-control" placeholder="Descripción de la categoría" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>