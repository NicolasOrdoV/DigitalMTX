<?php

require 'Models/Client.php';
require 'Models/Garanty.php';

/**
 * Controlador clientes
 */
class ClientController
{
    private $model;
    private $garanty;	

	public function __construct()
	{
		$this->model = new Client;
		$this->garanty = new Garanty;
	}

	public function index()
	{
		require 'Views/Layout.php';
		$clients = $this->model->getAll();
		require 'Views/Clients/list.php';
		require 'Views/Scripts.php';
	}

	public function list()
	{
		require 'Views/FindGaranties.php';
	}

	public function show()
	{
		if ($_REQUEST['bill']) {
			$bill = $_REQUEST['bill'];
			$data = $this->garanty->getShowStatusGaranty($bill);
			require 'Views/FindGaranties.php';
		}
	}
}