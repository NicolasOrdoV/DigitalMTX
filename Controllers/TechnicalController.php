<?php

require 'Models/Technical.php';
require 'Models/Garanty.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

/**
 * Controlador tecnico
 */
class TechnicalController
{
	private $model;
	private $garanty;

	public function __construct()
	{
		$this->model = new Technical;
		$this->garanty = new Garanty;
	}

	public function list()
	{
		require 'Views/Persons/Layout.php';
		$technicals = $this->model->getAll();
		require 'Views/Technicals/list.php';
		require 'Views/Persons/Scripts.php';
	}

	public function details()
	{
		if (isset($_REQUEST['id'])) {
			$id = $_REQUEST['id'];
			$data = $this->garanty->getById($id);
		    require 'Views/Persons/Layout.php';
			require 'Views/Technicals/details.php';
			require 'Views/Persons/Scripts.php';
		}
	}
}