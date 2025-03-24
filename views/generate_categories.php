<?php
function generateCategoryTable(){
    require_once '../controllers/categories.php';

    $categories = $categoryController->getCategories();

    foreach ($categories as $category): ?>
        <tr id='<?php echo $category->id_categoria; ?>'>
            <td><?php echo $category->nombre_categoria; ?></td>
            <td><?php echo $category->descripcion_categoria; ?></td>
            <td><?php echo $category->date_added; ?></td>
            <td class="actions">
                <button class="edit">Editar</button>
                <button class="delete" onclick="window.location.href = '../controllers/categories.php?type=delete&id=<?php echo $category->id_categoria; ?>'">Eliminar</button>
            </td>
        </tr>
    <?php endforeach;
}
?>