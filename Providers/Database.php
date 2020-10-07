<?php

require 'config.php';

/**
 * conexion a base de datos
 */
class Conexion extends PDO
{
    	
	public function __construct()
	{
		try {
			parent::__construct(DRIVER.':host='.HOST.';dbname='.DB_NAME.';charset='.CHARSET,USER,PASSWORD);
			$this->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}