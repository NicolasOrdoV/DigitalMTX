<?php

require 'Models/Bill.php';

class BillController
{
    private $model;

    public function __construct()
    {
        $this->model = new Bill;
    }

    public function index()
    {
        require 'Views/Layout.php';
        $bills = $this->model->getAll();
        require 'Views/Bills/list.php';
        require 'Views/Scripts.php';
    }

}
