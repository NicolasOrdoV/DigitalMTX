<?php

require 'Models/Client.php';

/**
 * Controlador clientes
 */
class ClientController
{
    private $model;	

	public function __construct()
	{
		$this->model = new Client;
	}

	public function index()
	{
		require 'Views/Layout.php';
		$clients = $this->model->getAll();
		require 'Views/Clients/list.php';
		require 'Views/Scripts.php';
	}
}