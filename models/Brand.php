<?php
require_once '../lib/db.php';

class Brand {
    private $db;

    public function __construct() {
        $this->db = new DB;
    }

    // Obtener todas las marcas
    public function getBrands() {
        $this->db->query('SELECT * FROM brand ORDER BY date_added DESC');
        return $this->db->resultSet();
    }

    // Añadir una nueva marca
    public function addBrand($data) {
        $this->db->query('INSERT INTO brand (name_brand, description_brand, date_added) VALUES (:name, :description, :date)');
        $this->db->bind(':name', $data['name_brand']);
        $this->db->bind(':description', $data['description_brand']);
        $this->db->bind(':date', date('Y-m-d H:i:s'));
        return $this->db->execute();
    }

    // Actualizar una marca existente
    public function updateBrand($data) {
        $this->db->query('UPDATE brand SET name_brand = :name, description_brand = :description WHERE id_brand = :id');
        $this->db->bind(':name', $data['name_brand']);
        $this->db->bind(':description', $data['description_brand']);
        $this->db->bind(':id', $data['id_brand']);
        return $this->db->execute();
    }

    // Eliminar una marca
    public function deleteBrand($id) {
        $this->db->query('DELETE FROM brand WHERE id_brand = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>