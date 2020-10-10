<?php 

require 'Models/Client.php';

class ClientController{
    private $model; 

    public function __construct()
    {
        $this-> model = new Client();
    }

    public function new(){
        require 'Views/Persons/Layout.php';
        require 'Views/Clients/new.php';
        require 'Views/Persons/Scripts.php';
    }

    public function save(){
        $this->model->newClient($_REQUEST);
        header('Location: ?controller=garanty&method=new');
    }

    public function list()
    {
        require 'Views/Persons/Layout.php';
        $clients = $this->model->getAll4000();
        require 'Views/Clients/list.php';
        require 'Views/Persons/Scripts.php';
    }
}