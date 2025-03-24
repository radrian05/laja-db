<?php
require_once '../helpers/session_helper.php';
require_once '../models/Category.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category;
    }

    // Mostrar todas las categorías
    public function getCategories() {
        return $this->categoryModel->getCategories();
    }

    // Añadir una nueva categoría
    public function addCategory() {
        $_POST['nombre_categoria'] = htmlspecialchars(trim($_POST['nombre_categoria']));
        $_POST['descripcion_categoria'] = htmlspecialchars(trim($_POST['descripcion_categoria']));
        if (empty($_POST['nombre_categoria']) || empty($_POST['descripcion_categoria'])) {
            flash('category_message', 'Por favor, complete todos los campos');
            redirect('../views/category.php');
        }

        $data = [
            'nombre_categoria' => $_POST['nombre_categoria'],
            'descripcion_categoria' => $_POST['descripcion_categoria']
        ];

        if ($this->categoryModel->addCategory($data)) {
            flash('category_message', 'Categoría añadida correctamente');
        } else {
            flash('category_message', 'Error al añadir la categoría');
        }
        redirect('../views/category.php');
    }

    // Actualizar una categoría
    public function updateCategory() {
        $_POST['nombre_categoria'] = htmlspecialchars(trim($_POST['nombre_categoria']));
        $_POST['descripcion_categoria'] = htmlspecialchars(trim($_POST['descripcion_categoria']));
        $_POST['id_categoria'] = htmlspecialchars(trim($_POST['id_categoria']));

        if (empty($_POST['nombre_categoria']) || empty($_POST['descripcion_categoria']) || empty($_POST['id_categoria'])) {
            flash('category_message', 'Por favor, complete todos los campos');
            redirect('../views/category.php');
        }

        $data = [
            'id_categoria' => $_POST['id_categoria'],
            'nombre_categoria' => $_POST['nombre_categoria'],
            'descripcion_categoria' => $_POST['descripcion_categoria']
        ];

        if ($this->categoryModel->updateCategory($data)) {
            flash('category_message', 'Categoría actualizada correctamente');
        } else {
            flash('category_message', 'Error al actualizar la categoría');
        }
        redirect('../views/category.php');
    }

    // Eliminar una categoría
    public function deleteCategory($id) {
        if ($this->categoryModel->deleteCategory($id)) {
            flash('category_message', 'Categoría eliminada correctamente');
        } else {
            flash('category_message', 'Error al eliminar la categoría');
        }
        redirect('../views/category.php');
    }
}

$categoryController = new CategoryController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'addCategory':
            $categoryController->addCategory();
            break;
        case 'updateCategory':
            $categoryController->updateCategory();
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['type'])) {
    if ($_GET['type'] == 'delete' && isset($_GET['id'])) {
        $categoryController->deleteCategory($_GET['id']);
    }
}
?>