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
		require 'Views/Persons/Layout.php';
        $products = $this->model->getAll();
        require 'Views/Products/list.php';
        require 'Views/Persons/Scripts.php';
	}
}