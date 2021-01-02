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
			$strSql = "SELECT g.*,d.id as idDetalle ,d.Codigo_Producto as idProducto,d.Descripcion_Producto as DescripcionP ,d.Marca_Producto as Marca ,d.Sello_Producto as Serie ,d.Referencia as ReferenciaProducto , d.Id_Garantia as N_garantia , d.Observacion_Cliente as ObsCliente , d.Aprobacion_Garantia as Aprobo, d.Estado as EstadoG   FROM  mg_garantia g 
			INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia 
			WHERE d.Estado = 'Tramite' 
			OR d.Estado = 'Pendiente por servicio tecnico' AND d.Aprobacion_Garantia = 'SI'";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getAllTechnicals()
	{
		try {
			$strSql = "SELECT g.*,d.id as idDetalle ,d.Codigo_Producto as idProducto,d.Descripcion_Producto as DescripcionP ,d.Marca_Producto as Marca ,d.Sello_Producto as Serie ,d.Referencia as ReferenciaProducto , d.Id_Garantia as N_garantia , d.Observacion_Cliente as ObsCliente , d.Aprobacion_Garantia as Aprobo, d.Estado as EstadoG   FROM  mg_garantia g 
			INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function consecutives($id)
	{
		try {
			$strSql = "SELECT t.*,d.* FROM mg_servicio_tecnico t
			INNER JOIN mg_detalle_garantia d ON d.id = t.Id_Garantia 
			WHERE  t.Id_Garantia = :id AND d.Aprobacion_Garantia = 'SI'";
			$array = ['id' => $id];
			$query = $this->pdo->select($strSql, $array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$strSql = "SELECT * FROM mg_detalle_garantia WHERE id = :id";
			$array = ['id' => $id];
			$query = $this->pdo->select($strSql, $array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getByIdDet($name)
	{
		try {
			$strSql = "SELECT * FROM  mg_detalle_garantia  WHERE Descripcion_Producto = :Descripcion_Producto";
			$array = ['Descripcion_Producto' => $name];
			$query = $this->pdo->select($strSql, $array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getByIdDetM($id)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM  mg_garantia g 
            INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia 
            WHERE d.id = :id";
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
			$strSql = "SELECT g.*,t.Observacion_Tecnico as Observacion, t.id as idtec FROM mg_servicio_tecnico t
			INNER JOIN  mg_garantia g ON g.id = t.Id_Garantia WHERE g.id = :id";
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
			$strWhere = "id=". $data['id'];
			$this->pdo->update('mg_detalle_garantia' , $data , $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function newTechnical($data)
	{
		try {
			$this->pdo->insert('mg_servicio_tecnico' , $data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function updateTechnical($data)
	{
     	try {
     		$strWhere = "id=" .$data['id'];
     		$this->pdo->update('mg_servicio_tecnico' , $data, $strWhere);
     	} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}