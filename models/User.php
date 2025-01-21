<?php
require_once "../lib/db.php";

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

    //Registro del usuario enla base de datos
    public function register($data){
        $this->db->query('INSERT INTO users (userName, userUid, userPwd) VALUES (:name, :Uid, :password)');
        
        //bind
        $this->db->bind(':name', $data['userName']);
        $this->db->bind(':Uid', $data['userUid']);
        $this->db->bind(':password', $data['userPwd']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
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
}
?>
