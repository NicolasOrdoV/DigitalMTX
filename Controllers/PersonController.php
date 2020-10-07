<?php

require 'Models/Person.php';
/**
 * controlador personal
 */
class PersonController
{
	private $model;

	public function __construct()
	{
		$this->model = new Person;
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

	public function LoginIn()
	{
		$validateUser = $this->model->validateUser($_POST);
		if ($validateUser === true) {
			header('Location: ?controller=person&method=template');
		} else {
			$error = ['errorMessage' => $validateUser, 'email' => $_POST['Correo']];
			require 'Views/Person/login.php';
		}
	}
}
