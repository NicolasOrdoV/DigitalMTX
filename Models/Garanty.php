<?php 

class Garanty {
 
    private $pdo ; 

    public function __construct()
    {
        try {
            $this->pdo = new Conexion;
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }
    
    

    public function getAll()
    {
        try {
            $strSql = "SELECT * FROM garantias";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newGaranty($data)
    {
        try {
            $this->pdo->insert('garantias' , $data);
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }
}