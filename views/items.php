<?php
function generateTable()
{
    require_once '../controllers/items.php';

    $items = $ItemController->getItems();

?>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
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
                <?php if ($items) : ?>
                    <?php foreach ($items as $item) : ?>
                        <tr id='<?php echo $item->ID; ?>'>
                            <td><?php echo $item->CODE; ?></td>
                            <td class="itemname">
                                <a href="itemHistory.php?id=<?php echo $item->ID; ?>" class="link-body-emphasis"><?php echo $item->NAME; ?></a>
                            </td>
                            <td><?php echo $item->name_brand; ?></td>
                            <td><?php echo $item->category_name; ?></td>
                            <td class="price"><?php echo $item->PRICE; ?>$</td>
                            <td><?php echo $item->STOCK; ?></td>
                            <td class="d-flex gap-2 actions">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#increaseStockModal">
                                    <i class="bi bi-arrow-up"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#decreaseStockModal">
                                    <i class="bi bi-arrow-down"></i>
                                </button>
                                <button type="button" class=" btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="if(confirm('¿Estás seguro de que deseas eliminar este elemento?')) { window.location.href = '../controllers/items.php?type=delete&id=<?php echo $item->ID; ?>'; }">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">No hay productos guardados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php
}
?>