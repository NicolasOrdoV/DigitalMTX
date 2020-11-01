<?php

require 'Models/Product.php';

/**
 * controlador productos
 */
class ProductController
{
	private $model;

	public function __construct()
	{
		$this->model = new Product;
	}

	public function list()
	{
		if (isset($_SESSION['user'])) {
			require 'Views/Layout.php';
	        $products = $this->model->getAll();
	        require 'Views/Products/list.php';
	        require 'Views/Scripts.php';
        }else{
			header('Location: ?controller=login');
		}
	}

	public function new()
	{
		if (isset($_SESSION['user'])) {
			require 'Views/Layout.php';
	        require 'Views/Products/new.php';
	        require 'Views/Scripts.php';
        }else{
			header('Location: ?controller=login');
		}
	}

	public function save()
	{
		if (isset($_SESSION['user'])) {
			$this->model->newProduct($_REQUEST);
			header('Location: ?controller=product&method=list');
		}else{
			header('Location: ?controller=login');
		}
	}
}