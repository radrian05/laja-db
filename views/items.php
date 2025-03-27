<?php
function generateTable() {
    require_once '../controllers/items.php';

    $items = $ItemController->getItems();

    if ($items) {
        ?>
        <?php foreach ($items as $item) : ?>
            <tr id='<?php echo $item->ID; ?>'>
                <td><?php echo $item->CODE; ?></td>
                <td class="itemname">
                    <a href="itemHistory.php?id=<?php echo $item->ID; ?>"><?php echo $item->NAME; ?></a>
                </td>
                <td><?php echo $item->BRAND; ?></td>
                <td><?php echo $item->category_name; ?></td> <!-- Mostrar el nombre de la categoría -->
                <td class="price"><?php echo $item->PRICE; ?>$</td>
                <td><?php echo $item->STOCK; ?></td>
                <td class="actions">
                    <button class="increase-button">&#8593</button>
                    <button class="decrease-button">&#8595</button>
                    <button class="edit">Editar</button>
                    <button class="delete" onclick="if(confirm('¿Estás seguro de que deseas eliminar este elemento?')) { window.location.href = '../controllers/items.php?type=delete&id=<?php echo $item->ID; ?>'; }">Eliminar</button>
                </td>
            </tr>
        <?php endforeach;
    } else { ?>
        <tr>
            <td colspan="7">No hay productos guardados</td>
        </tr>
    <?php
    }
}
?>


