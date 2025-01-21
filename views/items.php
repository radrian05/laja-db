<?php
function generateTable() {
    require_once '../controllers/items.php';

    
    $items = $ItemController->getItems();

    if ($items) {
        ?>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?php echo $item->CODE; ?></td>
                    <td><?php echo $item->NAME; ?></td>
                    <td><?php echo $item->BRAND; ?></td>
                    <td><?php echo $item->CATEGORY; ?></td>
                    <td class="price"><?php echo $item->PRICE; ?>$</td>
                    <td><?php echo $item->STOCK; ?></td>
                    <td>
                    <button onclick="window.location.href = 'edit.php?id=<?php echo $item->ID; ?>'">Editar</button>
                    <button class="delete" onclick="window.location.href = '../controllers/items.php?type=delete&id=<?php echo $item->ID; ?>'">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach;
    } else { ?>
        <tr>
            <td>No hay productos guardados</td>
        </tr>
        <?php
    }
}
?>


