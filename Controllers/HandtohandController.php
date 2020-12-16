<?php

require 'Models/Bill.php';
require 'Models/Garanty.php';

/**
 * Controlador sellos
 */
class HandtohandController{
	
	private $bill;
	private $garanty;

	public function __construct()
	{
		$this->bill = new Bill;
		$this->garanty = new Garanty;
	}

	public function index()
	{
		if (isset($_SESSION['user'])) {
			require 'Views/Layout.php';
			require 'Views/Hands/change.php';
			require 'Views/Scripts.php';
		}else{
	      header('Location: ?controller=login');
	    }
	}

	public function findBill()
	{
		if (isset($_SESSION['user'])) {
			if (isset($_POST['NumFactura'])) {
				$Numero_Factura = $_POST['NumFactura'];
				$bills = $this->garanty->getChanges($Numero_Factura);
				require 'Views/Layout.php';
				require 'Views/Hands/change.php';
				require 'Views/Scripts.php'; 
			}
		}else{
	      header('Location: ?controller=login');
	    }	
	}

	public function saveStamp()
	{
		if (isset($_SESSION['user'])) {
			if ($_POST) {
				$this->bill->updateBill($_POST);
				header('Location: ?controller=handtohand');
			}
		}else{
	      header('Location: ?controller=login');
	    }
	}
}