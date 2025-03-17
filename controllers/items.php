<?php
require_once "../models/Item.php";
require_once "../helpers/session_helper.php";
class ItemController {
    private $itemModel;

    public function __construct() {
        $this->itemModel = new Item;
    }

    public function getItems() {
        $items = $this->itemModel->getItems();
        return $items;
    }

    public function getItemById($id) {
        $item = $this->itemModel->getItemById($id);
        return $item;
    }

    public function addItem() {
        // Sanitizar POST data
        $_POST['code'] = htmlspecialchars(trim($_POST['code']));
        $_POST['name'] = htmlspecialchars(trim($_POST['name']));
        $_POST['brand'] = htmlspecialchars(trim($_POST['brand']));
        $_POST['category'] = htmlspecialchars(trim($_POST['category']));
        $_POST['price'] = htmlspecialchars(trim($_POST['price']));
        $_POST['stock'] = htmlspecialchars(trim($_POST['stock']));

        // Validar data
        if (empty($_POST['code']) || empty($_POST['name']) || empty($_POST['brand']) || empty($_POST['category']) || empty($_POST['price']) || empty($_POST['stock'])) {
            flash('add_item', 'Por favor, complete todos los campos');
            redirect('dashboard.php');
        }

        // Preparar data
        $data = [
            'code' => $_POST['code'],
            'name' => $_POST['name'],
            'brand' => $_POST['brand'],
            'category' => $_POST['category'],
            'price' => $_POST['price'],
            'stock' => $_POST['stock']
        ];

        // Añadir item
        $result = $this->itemModel->addItem($data);

        if (isset($result) && is_array($result) && array_key_exists('success', $result)) {
            if ($result['success']) {
                flash('add_item', 'Item añadido correctamente');
                redirect('../views/dashboard.php#add-product');
            } else {
                flash('add_item', 'Error al añadir el item');
                redirect('../views/dashboard.php');
            }
        } else {
            flash('add_item', 'Error al procesar la solicitud');
            redirect('../views/dashboard.php');
        }
    }

    public function updateItem($data) {
        $result = $this->itemModel->updateItem($data);
        if (isset($result) && is_array($result) && array_key_exists('success', $result)) {
            if ($result['success']) {
                flash('edit_item', 'Item modificado correctamente');
                redirect('../views/dashboard.php#add-product');
            } else {
                flash('edit_item', 'Error al modificar el item');
                redirect('../views/dashboard.php');
            }
        } else {
            flash('edit_item', 'Error al procesar la solicitud');
            redirect('../views/dashboard.php');
        }
    }

    public function deleteItem($id) {
        $result = $this->itemModel->deleteItem($id);
        return $result;
    }
}
$ItemController = new ItemController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['type']){
        case 'addItem':
            $ItemController->addItem();
            break;
        case 'editItem':
            $ItemController->updateItem($_POST);
            break;
        default:
            //redirect("../views/dashboard.php");
            echo "error";
    }
}else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'delete':
            if (isset($_GET['id'])) {
                $ItemController->deleteItem($_GET['id']);
                flash('delete_item', 'Item eliminado correctamente');
                redirect('../views/dashboard.php');
            } else {
                flash('delete_item', 'ID de item no proporcionado');
                redirect('../views/dashboard.php');
            }
            break;
        default:
            redirect('../views/dashboard.php');
    }
    }
?>