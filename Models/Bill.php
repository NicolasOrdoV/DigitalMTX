<?php


class Bill
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
            $strSql = "SELECT * FROM mg_facturas";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newBill($data)
    {
        try {
            $this->pdo->insert('mg_facturas' , $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getByNum($data)
    {
        try {
            $strSql = "SELECT * FROM mg_facturas WHERE Numero_Factura = '.$data[0].'";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function updateBill($data)
    {
        try {
            $strWhere = 'Numero_Factura='.$data[0];
            $this->pdo->update('mg_facturas', $data , $strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
