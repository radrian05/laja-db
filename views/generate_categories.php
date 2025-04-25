<?php
function generateCategoryTable() {
    require_once '../controllers/categories.php';

    $categories = $categoryController->getCategories();

    echo '<div class="table-responsive">'; // Contenedor responsivo de Bootstrap
    echo '<table class="table table-bordered align-middle">'; // Tabla con clases de Bootstrap
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Nombre</th>';
    echo '<th scope="col">Descripción</th>';
    echo '<th scope="col">Fecha</th>';
    echo '<th scope="col">Acciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($categories as $category) {
        echo '<tr id="' . $category->id_categoria . '">';
        echo '<td>' . htmlspecialchars($category->nombre_categoria) . '</td>';
        echo '<td>' . htmlspecialchars($category->descripcion_categoria) . '</td>';
        echo '<td>' . htmlspecialchars($category->date_added) . '</td>';
        echo '<td class="d-flex gap-2 actions">';
        echo '<button class="btn btn-warning btn-sm edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-id="' . $category->id_categoria . '" data-nombre="' . htmlspecialchars($category->nombre_categoria) . '" data-descripcion="' . htmlspecialchars($category->descripcion_categoria) . '"><i class="bi bi-pencil-square"></i></button>';
        echo '<button class="btn btn-danger btn-sm delete" onclick="if(confirm(\'¿Estás seguro de que deseas eliminar esta categoría?\')) { window.location.href = \'../controllers/categories.php?type=delete&id=' . $category->id_categoria . '\'; }"><i class="bi bi-trash"></i></button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>