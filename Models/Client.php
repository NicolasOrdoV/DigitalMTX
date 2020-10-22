<?php

class Client
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new conexion;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $strSql = "SELECT * FROM dtm_user";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAll4000()
    {
        try {
            $strSql = "SELECT * FROM dtm_user LIMIT 4000";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllFive()
    {
        try {
            $strSql = "SELECT * from dtm_user LIMIT 5";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newClient($data){
        try {
            $this->pdo->insert('dtm_user',$data);
        } catch ( PDOException $e) {
            die($e->getMessage());
        }
    }
}