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

	public function getByIdTec($id)
	{
		try {
			$strSql = "SELECT g.*,t.Observacion_Tecnico as Observacion, t.id as idtec FROM tecnico t
			INNER JOIN  garantias g ON g.id = t.id_garantia WHERE g.id = :id";
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

	public function newTechnical($data)
	{
		try {
			$this->pdo->insert('tecnico' , $data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function updateTechnical($data)
	{
     	try {
     		$strWhere = "id=" .$data['id'];
     		$this->pdo->update('tecnico' , $data, $strWhere);
     	} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}