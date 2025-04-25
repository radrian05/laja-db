<?php
include_once '../helpers/session_helper.php';
ensureLoggedIn();
require_once '../controllers/brands.php';
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?> <!--head-->
    <title>Marcas</title>
    <script src="brand.js"></script>
</head>

<body>
    <?php include_once 'nav.php'; ?> <!--navbar y sidebar-->

    <div class="container-fluid"> <!--CONTENIDO AQUI-->
        <div class="col min-vh-100 p-4">
            <h1>Marcas</h1>
            <div class="d-flex gap-2 mb-1">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal" aria-label="Añadir nueva marca">Añadir Marca</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $brands = $brandController->getBrands();
                        foreach ($brands as $brand) {
                            echo "<tr id='{$brand->id_brand}'>";
                            echo "<td>" . htmlspecialchars($brand->name_brand) . "</td>";
                            echo "<td>" . htmlspecialchars($brand->description_brand) . "</td>";
                            echo "<td>" . htmlspecialchars($brand->date_added) . "</td>";
                            echo "<td class='d-flex gap-2 actions'>";
                            echo "<button class='btn btn-warning btn-sm edit' data-bs-toggle='modal' data-bs-target='#editBrandModal' data-id='{$brand->id_brand}' data-name='" . htmlspecialchars($brand->name_brand) . "' data-description='" . htmlspecialchars($brand->description_brand) . "'><i class='bi bi-pencil-square'></i></button>";
                            echo "<button class='btn btn-danger btn-sm delete' onclick=\"if(confirm('¿Estás seguro de que deseas eliminar esta marca?')) { window.location.href = '../controllers/brands.php?type=delete&id={$brand->id_brand}'; }\"><i class='bi bi-trash'></i></button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Añadir Marca -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="addBrandModalLabel">Añadir Marca</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/brands.php" method="post" aria-labelledby="addBrandModalLabel">
                        <input type="hidden" name="type" value="addBrand">
                        <div class="mb-3">
                            <label for="name_brand" class="form-label">Nombre de la marca</label>
                            <input type="text" id="name_brand" name="name_brand" class="form-control" placeholder="Nombre de la marca" aria-label="Nombre de la marca" required>
                        </div>
                        <div class="mb-3">
                            <label for="description_brand" class="form-label">Descripción de la marca</label>
                            <input type="text" id="description_brand" name="description_brand" class="form-control" placeholder="Descripción de la marca" aria-label="Descripción de la marca" required>
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

    <!-- Modal de Editar Marca -->
    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="editBrandModalLabel">Editar Marca</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/brands.php" method="post">
                        <input type="hidden" name="type" value="editBrand">
                        <input type="hidden" name="id_brand" id="edit-id_brand" required>
                        <div class="mb-3">
                            <label for="edit-name_brand" class="form-label">Nombre de la marca</label>
                            <input type="text" id="edit-name_brand" name="name_brand" class="form-control" placeholder="Nombre de la marca" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-description_brand" class="form-label">Descripción de la marca</label>
                            <input type="text" id="edit-description_brand" name="description_brand" class="form-control" placeholder="Descripción de la marca" required>
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

    <script>
        const editBrandModal = document.getElementById('editBrandModal');
        editBrandModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');

            document.getElementById('edit-id_brand').value = id;
            document.getElementById('edit-name_brand').value = name;
            document.getElementById('edit-description_brand').value = description;
        });
    </script>
</body>

</html>