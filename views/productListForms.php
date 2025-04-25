<?php
require_once '../controllers/categories.php';
require_once '../controllers/brands.php';

function addProductForm()
{
    global $categoryController;
    global $brandController;
?>
    <!-- Modal de Añadir Nuevo Producto -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addProductModalLabel">Añadir Nuevo Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/items.php" method="post" aria-labelledby="addProductModalLabel">
                        <input type="hidden" name="type" value="addItem">

                        <div class="mb-3">
                            <label for="code" class="form-label">Código del Producto:</label>
                            <input type="text" id="code" name="code" class="form-control" aria-label="Código del Producto" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Producto:</label>
                            <input type="text" id="name" name="name" class="form-control" aria-label="Nombre del Producto" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Marca:</label>
                            <select id="brand" name="brand" class="form-select" aria-label="Marca" required>
                                <?php
                                $brands = $brandController->getBrands();
                                foreach ($brands as $brand) {
                                    echo "<option value='{$brand->id_brand}'>{$brand->name_brand}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Categoría:</label>
                            <select id="category" name="category" class="form-select" aria-label="Categoría" required>
                                <?php
                                $categories = $categoryController->getCategories();
                                foreach ($categories as $category) {
                                    echo "<option value='{$category->id_categoria}'>{$category->nombre_categoria}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Precio:</label>
                            <input type="number" id="price" name="price" step="0.01" class="form-control" aria-label="Precio" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock:</label>
                            <input type="number" id="stock" name="stock" class="form-control" aria-label="Stock" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" aria-label="Añadir producto">Añadir Producto</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Cancelar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

function editProductForm()
{
    global $categoryController;
    global $brandController;
?>
    <!-- Modal de Editar Producto -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="editProductModalLabel">Editar Producto</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/items.php" method="post">
                        <input type="hidden" name="type" value="editItem">
                        <input type="hidden" name="id" value="" required>

                        <div class="mb-3">
                            <label for="code" class="form-label">Código del Producto:</label>
                            <input type="text" id="code" name="code" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Producto:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Marca:</label>
                            <select id="brand" name="brand" class="form-select" aria-label="Marca" required>
                                <?php
                                $brands = $brandController->getBrands();
                                foreach ($brands as $brand) {
                                    echo "<option value='{$brand->id_brand}'>{$brand->name_brand}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Categoría:</label>
                            <select id="category" name="category" class="form-select" required>
                                <?php
                                $categories = $categoryController->getCategories();
                                foreach ($categories as $category) {
                                    echo "<option value='{$category->id_categoria}'>{$category->nombre_categoria}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="priceEdit" class="form-label">Precio:</label>
                            <input type="number" id="priceEdit" name="price" step="0.01" class="form-control" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

function increaseStockForm()
{
?>
    <!-- Modal de Aumentar Stock -->
    <div class="modal fade" id="increaseStockModal" tabindex="-1" aria-labelledby="increaseStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="increaseStockModalLabel">Aumentar Stock</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../controllers/items.php">
                        <input type="hidden" name="type" value="increaseStock">
                        <input type="hidden" name="id" id="increase-stock-id">
                        <div class="mb-3">
                            <label for="increase-quantity" class="form-label">Cantidad:</label>
                            <input type="number" name="quantity" id="increase-quantity" class="form-control" min="1" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

function decreaseStockForm()
{
?>
    <!-- Modal de Disminuir Stock -->
    <div class="modal fade" id="decreaseStockModal" tabindex="-1" aria-labelledby="decreaseStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="decreaseStockModalLabel">Disminuir Stock</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../controllers/items.php">
                        <input type="hidden" name="type" value="decreaseStock">
                        <input type="hidden" name="id" id="decrease-stock-id">
                        <div class="mb-3">
                            <label for="decrease-quantity" class="form-label">Cantidad:</label>
                            <input type="number" name="quantity" id="decrease-quantity" class="form-control" min="1" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>