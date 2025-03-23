<?php
require_once '../lib/db.php';

class Item {
    private $db;

    public function __construct() {
        $this->db = new DB;
    }

    public function getItems() {
        $this->db->query('SELECT * FROM items');
        return $this->db->resultSet();
    }

    public function getItemById($id) {
        $this->db->query('SELECT * FROM items WHERE ID = :id');
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
        $this->db->query('INSERT INTO historial (id_producto, user_id, nota, referencia, cantidad) VALUES (:id_producto, :user_id, :nota, :referencia, :cantidad)');
        $this->db->bind(':id_producto', $data['id_producto']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':nota', $data['nota']);
        $this->db->bind(':referencia', $data['referencia']);
        $this->db->bind(':cantidad', $data['cantidad']);
        return $this->db->execute();
    }

    public function updateItem($data) {
        $this->db->query('UPDATE items SET CODE = :code, NAME = :name, BRAND = :brand, CATEGORY = :category, PRICE = :price, STOCK = :stock WHERE ID = :id');
        $this->db->bind(':code', $data['code']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
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
}
?>