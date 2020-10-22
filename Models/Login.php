<?php

class Login
{
    private $pdo;

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
            $strSql = "SELECT * from dtm_empleados
            WHERE correo = '{$data['correo']}' AND password = '{$data['password']}'";
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