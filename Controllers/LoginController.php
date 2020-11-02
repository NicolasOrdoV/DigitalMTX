<?php

require 'Models/Login.php';

class LoginController
{
    private $model;

    public function __construct()
	{
		$this->model = new Login;
    }
    
    public function index()
	{
		if (!isset($_SESSION['user'])) {
			require 'Views/login.php';
		}else{
			header('Location: ?controller=person&method=template');
		}
    }
    
    public function loginIn()
	{    
		if (filter_var($_POST['correo'],FILTER_VALIDATE_EMAIL)) {

			$validateUserEmp = $this->model->validateUserEmp($_POST);
			$validateAdmin = $this->model->validateAdmin($_POST);
			if ($validateUserEmp === true || $validateAdmin === true) {
				header('Location: ?controller=person&method=template');
		    }else {
				$error = [
					'errorMessage' => $validateUserEmp,
					'email' => $_POST['correo']
				];
				require 'Views/login.php';
			}
		} else {
			$errorFailed = [
					'errorEmail' => 'Correo no tiene formato correcto',
					'email' => $_POST['correo'],
					'password' => $_POST['password']
				];
			require 'Views/login.php';
		}
			
	}

	public function logout()
	{
		if ($_SESSION['user']) {
			session_destroy();
			header('Location: ?controller=login');
		} else {
			header('Location: ?controller=login');
		}
	}
}