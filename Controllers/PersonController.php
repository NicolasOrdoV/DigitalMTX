<?php

require 'Models/Person.php';
require 'Models/Client.php';
require 'Models/Garanty.php';
require 'Models/Rol.php';
/**
 * controlador personal
 */
class PersonController
{
	private $model;
	private $rol;
	private $client;
	private $garanty;

	public function __construct()
	{
		$this->model = new Person;
		$this->rol = new Rol;
		$this->client = new Client;
		$this->garanty = new Garanty;
	}
	public function login()
	{
		require 'Views/Persons/login.php';
	}

	public function template()
	{
		require 'Views/Persons/Layout.php';
		$dataClients = $this->client->getAll();
		$limitClients = $this->client->getAllFive();
		$totalClients = count($dataClients);
		$dataGaranties = $this->garanty->getAll();
		$limitGaranties = $this->garanty->getAllFive();
		$totalGaranties = count($dataGaranties);
		$dataPersons = $this->model->getAll();
		$limitPersons = $this->model->getAllFive();
		$totalPersons = count($dataPersons);
		require 'Views/Persons/Home.php';
		require 'Views/Persons/Scripts.php';
	}

	public function loginIn()
	{
		$validateUser = $this->model->validateUser($_POST);
		if ($validateUser === true) {
			header('Location: ?controller=person&method=template');
		} else {
			$error = [
				'errorMessage' => $validateUser, 
				'email' => $_POST['Correo']
			];
			require 'Views/Persons/login.php';
		}
	}

	public function logout()
    {
        if($_SESSION['user']) {
            session_destroy();
            header('Location: ?controller=home');
        } else {
            header('Location: ?controller=home');              
        }
    }

    public function new()
    {
    	require 'Views/Persons/Layout.php';
    	$roles = $this->rol->getAll();
		require 'Views/Persons/new.php';
		require 'Views/Persons/Scripts.php';
    }

    public function list()
    {
    	require 'Views/Persons/Layout.php';
    	$persons = $this->model->getAll();
		require 'Views/Persons/list.php';
		require 'Views/Persons/Scripts.php';
    }

    public function save()
    {
        $this->model->newPerson($_REQUEST);
        header('Location: ?controller=person&method=list');
	}
	
   

}
