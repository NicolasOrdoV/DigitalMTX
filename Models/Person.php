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
    
    public function validateUser($data){
        try {
             $strSql = "SELECT p.*,r.rol as rol from personal p INNER JOIN rol r on r.id = p.id_rol WHERE p.Correo = '{$data['Correo']}' AND p.Contrasena = '{$data['Contrasena']}'";
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




}