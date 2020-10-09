<?php 

class Person {
 
    private $pdo ; 

    public function __construct()
    {
        try {
            $this->pdo = new Conexion;
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function validateUser($data)
    {
        try {
            $strSql = "SELECT p.*,r.rol as rol from personal p 
            INNER JOIN rol r on r.id = p.id_rol 
            WHERE p.Correo = '{$data['Correo']}' AND p.Contrasena = '{$data['Contrasena']}'";
            $query = $this->pdo->select($strSql);
            if (isset($query[0]->id)) {
                $_SESSION['user'] = $query[0];
                return true;
            } else {
                return 'Correo y Contraseña incorrectas';
            }
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $strSql = "SELECT p.*,r.rol as rol from personal p 
            INNER JOIN rol r on r.id = p.id_rol WHERE p.id_rol = 1 OR p.id_rol = 2 ";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newPerson($data)
    {
        try {
            $this->pdo->insert('personal' , $data);
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }


    public function getAllFive()
    {
        try {
            $strSql = "SELECT * from personal LIMIT 5";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getById($id){
        try { 
            $strSql = 'SELECT * FROM personal WHERE id = :id';
            $array = ['id' => $id];
            $query = $this->pdo->select($strSql,$array);
            return $query;
            
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }
    
}