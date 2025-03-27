<?php
require_once __DIR__ . '/../lib/db.php'; //constante _DIR_ para arreglar un error con dbsetup.php

class User {
    private $db;
    
    public function __construct()
    {
        $this->db = new DB;
    }

    //Encontrar usuario por nombre de usuario
    public function findUserByUsername($username){
        $this->db->query('SELECT * FROM users WHERE userUid = :username');
        $this->db->bind(':username', $username);


        //ejecuta el query
        $row = $this->db->single();

        //revisar fila
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    
    }

    public function getUsers() {
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }

    public function getInactiveUsers(){
        $this->db->query('SELECT * FROM users WHERE IS_ACTIVE = 0'); 
        return $this->db->resultSet();
    }

    //Registro del usuario en la base de datos
    public function register($data) {
        $this->db->query('INSERT INTO users (userName, userUid, userPwd, IS_ADMIN, secretWord) VALUES (:name, :Uid, :password, :is_admin, :secretWord)');
        
        // Bind
        $this->db->bind(':name', $data['userName']);
        $this->db->bind(':Uid', $data['userUid']);
        $this->db->bind(':password', $data['userPwd']);
        $this->db->bind(':is_admin', $data['IS_ADMIN']);
        $this->db->bind(':secretWord', $data['secretWord']);
        
        // Ejecutar
        return $this->db->execute();
    }

    //login
    public function login($name, $password){
        $row = $this->findUserByUsername($name);

        if($row == false) return false; //si no existe, se termina la función

        $hashedPassword = $row->userPwd;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    public function updatePassword($userId, $newPassword) {
        $this->db->query('UPDATE users SET userPwd = :password WHERE userId = :userId');
        
        // Hashear la nueva contraseña
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Vincular parámetros
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':userId', $userId);

        // Ejecutar la consulta
        return $this->db->execute();
    }

    public function disableUser($userId) {
        $this->db->query('UPDATE users SET IS_ACTIVE = 0 WHERE userId = :userId');
        $this->db->bind(':userId', $userId);
        return $this->db->execute();
    }
    
    public function enableUser($userId) {
        $this->db->query('UPDATE users SET IS_ACTIVE = 1 WHERE userId = :userId');
        $this->db->bind(':userId', $userId);
        return $this->db->execute();
    }

    // Verificar la palabra secreta
    public function verifySecretWord($userId, $secretWord) {
        $this->db->query('SELECT secretWord FROM users WHERE userId = :userId');
        $this->db->bind(':userId', $userId);
        $row = $this->db->single();

        if ($row && $row->secretWord === $secretWord) {
            return true;
        }
        return false;
    }
        
}
?>
