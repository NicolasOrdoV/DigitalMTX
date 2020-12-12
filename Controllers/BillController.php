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
        $date_now = date('Y-m-d');
        //$date_after = date('Y-m-d', strtotime($date_now.'+ 1 YEAR'));
        $date_now1 = explode('-',$date_now);
        $year_after = $date_now1[0]+1;
        $year_before = $date_now1[0]-2;
        $date_after = date($year_after.'-01-01');
        $date_before = date($year_before.'-01-01');
        $dn = strtotime($date_now);
        $da = strtotime($date_after);
        $db = strtotime($date_before);
            if ($dn >= $db && $dn <= $da) {
                $this->model->Deletebills();
                header('Location: ?controller=bill');
            }  
        require 'Views/Bills/list.php';
        require 'Views/Scripts.php';
    }

}
