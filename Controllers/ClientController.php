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
        require 'Views/Layout.php';
        $clients = $this->model->getAll();
        require 'Views/Clients/list.php';
        require 'Views/Scripts.php';
    }

    public function new(){
        require 'Views/Layout.php';
        require 'Views/Clients/new.php';
        require 'Views/Scripts.php';
    }

    public function save(){
        $this->model->newClient($_REQUEST);
        header('Location: ?controller=garanty&method=new');
    }
}