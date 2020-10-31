<?php 

require 'Models/Client.php';

class ClientController{
    private $model; 

    public function __construct()
    {
        $this-> model = new Client();
    }

    public function list()
    {
        if (isset($_SESSION['user'])) {
            require 'Views/Layout.php';
            $clients = $this->model->getAll();
            require 'Views/Clients/list.php';
            require 'Views/Scripts.php';
        }else{
            header('Location: ?controller=login');
        }
    }

    public function new()
    {
        if (isset($_SESSION['user'])) {
            require 'Views/Layout.php';
            require 'Views/Clients/new.php';
            require 'Views/Scripts.php';
        }else{
            header('Location: ?controller=login');
        }
    }

    public function save()
    {
        if (isset($_SESSION['user'])) {
            $this->model->newClient($_REQUEST);
            header('Location: ?controller=garanty&method=new');
        }else{
            header('Location: ?controller=login');
        }
    }
}