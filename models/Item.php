<?php
require_once '../lib/db.php';

class Item {
    private $db;

    public function __construct() {
        $this->db = new DB;
    }

    public function getItems() {
        $this->db->query('
            SELECT items.*, 
                   categorias.nombre_categoria AS category_name, 
                   brand.name_brand AS name_brand
            FROM items
            JOIN categorias ON items.CATEGORY = categorias.id_categoria
            JOIN brand ON items.BRAND = brand.id_brand
        ');
        return $this->db->resultSet();
    }
    
    public function getItemById($id) {
        $this->db->query('
            SELECT items.*, categorias.nombre_categoria AS category_name
            FROM items
            JOIN categorias ON items.CATEGORY = categorias.id_categoria
            WHERE items.ID = :id
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addItem($data) {
        $this->db->query('INSERT INTO items (CODE, NAME, BRAND, CATEGORY, PRICE, STOCK) VALUES (:code, :name, :brand, :category, :price, :stock)');
        $this->db->bind(':code', $data['code']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
        if ($this->db->execute()) {
            return $this->db->lastInsertId(); // Devuelve el ID del producto recién agregado
        } else {
            return false;
        }
    }

    public function addToHistory($data) {
        $this->db->query('INSERT INTO historial (id_producto, user_name, nota, referencia, stock_up, stock_down) VALUES (:id_producto, :user_id, :nota, :referencia, :stock_up, :stock_down)');
        $this->db->bind(':id_producto', $data['id_producto']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':nota', $data['nota']);
        $this->db->bind(':referencia', $data['referencia']);
        $this->db->bind(':stock_up', isset($data['stock_up']) ? $data['stock_up'] : null);
        $this->db->bind(':stock_down', isset($data['stock_down']) ? $data['stock_down'] : null);
        return $this->db->execute();
    }

    public function updateItem($data) {
        $this->db->query('UPDATE items SET CODE = :code, NAME = :name, BRAND = :brand, CATEGORY = :category, PRICE = :price WHERE ID = :id');
        $this->db->bind(':code', $data['code']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':id', $data['id']);
        if ($this->db->execute()) {
            return ['success' => true, 'message' => 'Item modificado correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al modificar el item'];
        }
    }

    public function deleteItem($id) {
        $this->db->query('DELETE FROM items WHERE ID = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getProductHistory($productId) {
        $this->db->query('SELECT * FROM historial WHERE id_producto = :id_producto ORDER BY fecha DESC');
        $this->db->bind(':id_producto', $productId);
        return $this->db->resultSet();
    }

    public function increaseStock($id, $quantity) {
        $this->db->query('UPDATE items SET STOCK = STOCK + :quantity WHERE ID = :id');
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function decreaseStock($id, $quantity) {
        $this->db->query('UPDATE items SET STOCK = STOCK - :quantity WHERE ID = :id AND STOCK >= :quantity');
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>