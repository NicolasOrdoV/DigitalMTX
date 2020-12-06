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

    public function getTotal()
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
            $strSql = "SELECT g.*,d.* FROM mg_garantia g 
                        INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia
                        WHERE d.Aprobacion_Garantia = 'SI' GROUP BY g.No_garantia ORDER BY d.Id_Garantia ASC";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllSolution()
    {
        try {
            $strSql = "SELECT g.*,d.* FROM mg_garantia g INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia  ORDER BY d.Id_Garantia ASC , d.Estado ASC";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function saveDetail($data)
    {
        try {
            $this->pdo->insert('mg_detalle_garantia', $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function getById($id)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM  mg_garantia g 
            INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia 
            WHERE d.Estado = 'Tramite' OR d.Estado='Pendiente por servicio tecnico' OR d.Estado ='Solucionado por servicio tecnico' OR d.Estado='Pendiente para Nota Credito' OR d.Estado = 'Pendiente para cambio de producto' OR d.Estado = 'Pendiente para Devolucion de Dinero'  AND  g.id = :id";
            $array = ['id' => $id];
            $query = $this->pdo->select($strSql, $array);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getByIdG($id)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM mg_garantia g INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia WHERE g.id = :id AND d.Aprobacion_Garantia = 'SI'";
            $array = ['id' => $id];
            $query = $this->pdo->select($strSql, $array);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function getByIdEnd($id)
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

    public function getByIdTec($name, $id)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM  mg_garantia g 
            INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia 
            WHERE d.Descripcion_Producto = '$name' AND d.id = $id";
            /*  $array = ['Descripcion_Producto' => $name,
                      'Id_Garantia' => $id]; */
            $query = $this->pdo->select($strSql); 
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getShowStatusGaranty($bill)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM  mg_garantia g 
            INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia 
            WHERE g.No_garantia = '".$bill."'";
            $query = $this->pdo->select($strSql); 
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
            $strSql = "SELECT f.*,p.*,c.IDENTIFICACION as Identificacion_Cliente, c.NOMBRE as Nombre_Cliente,c.DIRECCION as Direccion_Cliente, c.CORREO_ELECTRONICO as Correo_Cliente, cc.Centro_costo as centro FROM mg_facturas f 
            INNER JOIN mg_clientes c ON c.IDENTIFICACION = f.nit 
            INNER JOIN dtm_productos p ON p.codigo = f.Referencia
            INNER JOIN mg_centro_costos cc ON cc.id = f.Centro_costo 
            WHERE f.Numero_Factura lIKE '%$bill' OR f.Descripcion_Comentarios LIKE '%$bill%'";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getByNumBill($numFac)
    {
        try {
            $strSql = "SELECT f.*,p.*,c.IDENTIFICACION as Identificacion_Cliente, c.NOMBRE as Nombre_Cliente,c.DIRECCION as Direccion_Cliente, c.CORREO_ELECTRONICO as Correo_Cliente, cc.Centro_costo as centro FROM mg_facturas f 
            INNER JOIN mg_clientes c ON c.IDENTIFICACION = f.nit 
            INNER JOIN dtm_productos p ON p.codigo = f.Referencia
            INNER JOIN mg_centro_costos cc ON cc.id = f.Centro_costo 
            WHERE f.Numero_Factura = '".$numFac."'";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllF($bill)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM mg_garantia g INNER JOIN mg_detalle_garantia d on d.Id_Garantia = g.id   WHERE g.Numero_Factura LIKE '%$bill' AND d.Estado = 'Tramite' OR d.Estado = 'Pendiente por servicio tecnico' OR d.Estado = 'Solucionado por servicio tecnico'";
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

    public function saveGarantyEnd($data)
    {
        try {
            $strWhere = "id =".$data['id'];
            $this->pdo->update('mg_detalle_garantia', $data, $strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getOptions($id)
    {
        try {
            $strSql = "SELECT t.Observacion_tecnico as Observacion_tecnico, t.Id_Garantia as idg ,d.*,g.* FROM mg_detalle_garantia d INNER JOIN mg_servicio_tecnico t ON d.id = t.Id_Garantia INNER JOIN mg_garantia g ON g.id = d.Id_Garantia WHERE d.id = $id ORDER BY t.id DESC LIMIT 1";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getGaranty($bill)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM mg_garantia g INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia WHERE g.Numero_Factura LIKE '%$bill' OR d.Sello_Producto = '$bill' ";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllSolutionPre()
    {
        try {
            $strSql = "SELECT g.*,d.* FROM mg_garantia g INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia";
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }

    public function getFinalyStatus($id)
    {
        try {
            $strSql = "SELECT g.*,d.* FROM mg_garantia g INNER JOIN mg_detalle_garantia d ON g.id = d.Id_Garantia WHERE d.id = :id";
            $array = ['id' => $id];
            $query = $this->pdo->select($strSql , $array);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }   
    }
}
