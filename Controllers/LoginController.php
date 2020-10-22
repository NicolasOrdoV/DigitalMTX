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
		require 'Views/login.php';
    }
    
    public function loginIn()
	{
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