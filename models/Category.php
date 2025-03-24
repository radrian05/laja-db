<?php
require_once '../lib/db.php';

class Category {
    private $db;

    public function __construct() {
        $this->db = new DB;
    }

    // Obtener todas las categorías
    public function getCategories() {
        $this->db->query('SELECT * FROM categorias ORDER BY date_added DESC');
        return $this->db->resultSet();
    }

    // Añadir una nueva categoría
    public function addCategory($data) {
        $this->db->query('INSERT INTO categorias (nombre_categoria, descripcion_categoria) VALUES (:nombre, :descripcion)');
        $this->db->bind(':nombre', $data['nombre_categoria']);
        $this->db->bind(':descripcion', $data['descripcion_categoria']);
        return $this->db->execute();
    }

    // Actualizar una categoría existente
    public function updateCategory($data) {
        $this->db->query('UPDATE categorias SET nombre_categoria = :nombre, descripcion_categoria = :descripcion WHERE id_categoria = :id');
        $this->db->bind(':nombre', $data['nombre_categoria']);
        $this->db->bind(':descripcion', $data['descripcion_categoria']);
        $this->db->bind(':id', $data['id_categoria']);
        return $this->db->execute();
    }

    // Eliminar una categoría
    public function deleteCategory($id) {
        $this->db->query('DELETE FROM categorias WHERE id_categoria = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>
