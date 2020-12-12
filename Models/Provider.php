<?php

/**
 * Modelo proveedores
 */
class Provider
{
	private $pdo;

	public function __construct()
	{
		try {
			$this->pdo = new Conexion;
		} catch (PDOException $e) {
			die($e->getMessage);
		}
	}

	public function getAll()
	{
		try {
			$strSql = "SELECT * FROM mg_proveedores";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage);
		}
	}

	
}