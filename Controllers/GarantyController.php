<?php

require 'Models/Garanty.php';

/**
 * controlador personal
 */
class GarantyController
{
	private $model;
	

	public function __construct()
	{
		$this->model = new Garanty;
	}


    public function save()
    {
        $this->model->newGaranty($_REQUEST);
        header('Location: ?controller=garanty&method=listGaranty');
	}
	

	public function listGaranty(){
        require 'Views/Persons/Layout.php';
        $garanties = $this->model->getAll();
		require 'Views/Garanty/listGaranty.php';
		require 'Views/Persons/Footer.php';
		require 'Views/Persons/Scripts.php';
	}
	public function new(){
		require 'Views/Persons/Layout.php';
		require 'Views/Garanty/garantia_empleado.php';
		require 'Views/Persons/Footer.php';
		require 'Views/Persons/Scripts.php';
	}


}
