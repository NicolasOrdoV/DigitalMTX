<?php

require 'Models/Person.php';
require 'Models/Rol.php';
/**
 * controlador personal
 */
class PersonController
{
	private $model;
	private $rol;

	public function __construct()
	{
		$this->model = new Person;
		$this->rol = new Rol;
	}
	public function login()
	{
		require 'Views/Persons/login.php';
	}

	public function template()
	{
		require 'Views/Persons/Layout.php';
		require 'Views/Persons/Home.php';
		require 'Views/Persons/Scripts.php';
		require 'Views/Persons/Footer.php';
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
		require 'Views/Persons/Footer.php';
    }

    public function list()
    {
    	require 'Views/Persons/Layout.php';
    	$persons = $this->model->getAll();
		require 'Views/Persons/list.php';
		require 'Views/Persons/Scripts.php';
		require 'Views/Persons/Footer.php';
    }

    public function save()
    {
        $this->model->newPerson($_REQUEST);
        header('Location: ?controller=person&method=list');
	}
	


}
