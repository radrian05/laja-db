<?php
require_once '../helpers/session_helper.php';
require_once '../models/Brand.php';

class BrandController {
    private $brandModel;

    public function __construct() {
        $this->brandModel = new Brand;
    }

    // Obtener todas las marcas
    public function getBrands() {
        return $this->brandModel->getBrands();
    }

    // Añadir una nueva marca
    public function addBrand() {
        $_POST['name_brand'] = htmlspecialchars(trim($_POST['name_brand']));
        $_POST['description_brand'] = htmlspecialchars(trim($_POST['description_brand']));

        if (empty($_POST['name_brand']) || empty($_POST['description_brand'])) {
            flash('brand_message', 'Por favor, complete todos los campos');
            redirect('../views/brand.php');
        }

        $data = [
            'name_brand' => $_POST['name_brand'],
            'description_brand' => $_POST['description_brand']
        ];

        if ($this->brandModel->addBrand($data)) {
            flash('brand_message', 'Marca añadida correctamente');
        } else {
            flash('brand_message', 'Error al añadir la marca');
        }
        redirect('../views/brand.php');
    }

    // Actualizar una marca existente
    public function updateBrand() {
        $_POST['id_brand'] = htmlspecialchars(trim($_POST['id_brand']));
        $_POST['name_brand'] = htmlspecialchars(trim($_POST['name_brand']));
        $_POST['description_brand'] = htmlspecialchars(trim($_POST['description_brand']));

        if (empty($_POST['id_brand']) || empty($_POST['name_brand']) || empty($_POST['description_brand'])) {
            flash('brand_message', 'Por favor, complete todos los campos');
            redirect('../views/brand.php');
        }

        $data = [
            'id_brand' => $_POST['id_brand'],
            'name_brand' => $_POST['name_brand'],
            'description_brand' => $_POST['description_brand']
        ];

        if ($this->brandModel->updateBrand($data)) {
            flash('brand_message', 'Marca actualizada correctamente');
        } else {
            flash('brand_message', 'Error al actualizar la marca');
        }
        redirect('../views/brand.php');
    }

    // Eliminar una marca
    public function deleteBrand($id) {
        if ($this->brandModel->deleteBrand($id)) {
            flash('brand_message', 'Marca eliminada correctamente');
        } else {
            flash('brand_message', 'Error al eliminar la marca');
        }
        redirect('../views/brand.php');
    }
}

$brandController = new BrandController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['type']) {
        case 'addBrand':
            $brandController->addBrand();
            break;
        case 'editBrand':
            $brandController->updateBrand();
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['type'])) {
    if ($_GET['type'] === 'delete' && isset($_GET['id'])) {
        $brandController->deleteBrand($_GET['id']);
    }
}
?>