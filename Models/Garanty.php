<?php

class Garanty
{

    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new Conexion;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $strSql = "SELECT * FROM mg_garantia";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAlDetails($id)
    {
        try {
            $strSql = "SELECT * FROM mg_detalle_garantia WHERE Id_Garantia = $id";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newGaranty($data)
    {
        try {
            $this->pdo->insert('mg_garantia', $data);
            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getLastId()
    {
        try {
            $strSql = 'SELECT MAX(id) as id FROM mg_garantia';
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllDet()
    {
        try {
            $strSql = "SELECT g.*,d.* FROM  mg_garantia g INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function saveDetail($data)
    {
        try {
            $this->pdo->insert('mg_detalle_garantia',$data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function getById($id)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM  mg_garantia g 
            INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia 
            WHERE g.id = :id AND d.Estado = 'Tramite'";
            $array = ['id' => $id];
            $query = $this->pdo->select($strSql, $array);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getByIdTec($name)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM  mg_garantia g 
            INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia 
            WHERE d.Descripcion_Producto = :Descripcion_Producto OR d.Estado = 'Tramite' OR d.Estado = 'Pendiente por servicio tecnico' ";
            $array = ['Descripcion_Producto' => $name];
            $query = $this->pdo->select($strSql, $array);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllFive()
    {
        try {
            $strSql = "SELECT * from mg_garantia LIMIT 5";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getBill($bill)
    {
        try {
            $strSql = "SELECT * FROM mg_facturas WHERE Numero_Factura LIKE '%$bill%'";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllF($bill)
    {
        try {
            $strSql = "SELECT g.*,f.Numero_Factura as factura FROM mg_garantia g, mg_facturas f
            WHERE f.Numero_Factura LIKE '%$bill%'";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function showNum($bill)
    {
        try {
            $strSql = "SELECT * FROM mg_garantia WHERE Numero_Factura = :Numero_Factura";
            $array = ['Numero_Factura' => $bill];
            $query = $this->pdo->select($strSql, $array);
            return $query; 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
