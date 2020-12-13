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
        date_default_timezone_set('America/Bogota');
        require 'Views/Layout.php';
        $bills = $this->model->getAll();
        $day_now = date('d');
        $month_now = date('m');
        if ($day_now == 01 && $month_now == 01) {
            echo 'Cumple';
            $this->model->deletebills();
        }else{
            echo 'No cumple';
        }
        require 'Views/Bills/list.php';
        require 'Views/Scripts.php';
    }

}
