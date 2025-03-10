<?php
class DB {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'lajadb';

    //PDO
    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        //información necesaria para establecer la conexión a la base de datos.
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        }catch(PDOException $e){
            $this->error = $e ->getMessage();
            echo $this->error;
        }

    }

    //preparar query para consulta
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Vincula un valor a un parámetro en la consulta para evitar inyecciones SQL.
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //ejecuta la consulta preparada
    public function execute(){
        return $this->stmt->execute();
    }

    //devuelve múltiples resultados de la consulta ejecutada.
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchALL(PDO::FETCH_OBJ);
    }

    //devuelve un único resultado de la consulta ejecutada.
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //devuelve el número de filas afectadas por la última consulta.
    public function rowCount(){
        return $this->stmt->rowCount();
    }
    
}



?>