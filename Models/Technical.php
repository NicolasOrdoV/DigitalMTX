<?php

/**
 * Modelo tecnico
 */
class Technical
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
			$strSql = "SELECT * FROM garantias WHERE ESTADO = 'PENDIENTE' OR ESTADO = 'en revisión'";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$strSql = "SELECT * FROM garantias WHERE id = :id";
			$array = ['id' => $id];
			$query = $this->pdo->select($strSql, $array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function editStatus($data)
	{
		try {
			$strWhere = "id=" . $data['id'];
			$this->pdo->update('garantias' , $data , $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}