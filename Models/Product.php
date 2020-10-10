<?php

/**
 * 
 */
class Product
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
			$strSql = "SELECT * FROM productos";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function newProduct($data)
	{
    	try {
    		$this->pdo->insert('productos' , $data);
    	} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}