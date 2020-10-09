<?php

require 'Models/Person.php';
require 'Models/Client.php';
require 'Models/Garanty.php';
require 'Models/Rol.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
/**
 * controlador personal
 */
class PersonController
{
	private $model;
	private $rol;
	private $client;
	private $garanty;

	public function __construct()
	{
		$this->model = new Person;
		$this->rol = new Rol;
		$this->client = new Client;
		$this->garanty = new Garanty;
	}
	public function login()
	{
		require 'Views/Persons/login.php';
	}

	public function template()
	{
		require 'Views/Persons/Layout.php';
		$dataClients = $this->client->getAll();
		$limitClients = $this->client->getAllFive();
		$totalClients = count($dataClients);
		$dataGaranties = $this->garanty->getAll();
		$limitGaranties = $this->garanty->getAllFive();
		$totalGaranties = count($dataGaranties);
		$dataPersons = $this->model->getAll();
		$limitPersons = $this->model->getAllFive();
		$totalPersons = count($dataPersons);
		require 'Views/Persons/Home.php';
		require 'Views/Persons/Scripts.php';
	}

	public function loginIn()
	{
		$validateUser = $this->model->validateUser($_POST);
		if ($validateUser === true) {
			header('Location: ?controller=person&method=template');
		} else {
			$error = [
				'errorMessage' => $validateUser, 
				'email' => $_POST['Correo']
			];
			require 'Views/Persons/login.php';
		}
	}

	public function logout()
    {
        if($_SESSION['user']) {
            session_destroy();
            header('Location: ?controller=home');
        } else {
            header('Location: ?controller=home');              
        }
    }

    public function new()
    {
    	require 'Views/Persons/Layout.php';
    	$roles = $this->rol->getAll();
		require 'Views/Persons/new.php';
		require 'Views/Persons/Scripts.php';
    }

    public function list()
    {
    	require 'Views/Persons/Layout.php';
    	$persons = $this->model->getAll();
		require 'Views/Persons/list.php';
		require 'Views/Persons/Scripts.php';
    }

    public function save()
    {
        $this->model->newPerson($_REQUEST);
        $mail = new PHPMailer(true);

	    try {
	      //Server settings
	      $mail->SMTPDebug = 0;                      // Enable verbose debug output
	      $mail->isSMTP();                                            // Send using SMTP
	      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	      $mail->Username   = 'nikomegathet666@gmail.com';                     // SMTP username
	      $mail->Password   = '1000464327bat';                               // SMTP password
	      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	      $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	      //Recipients
	      $mail->setFrom('nikomegathet666@gmail.com');
	      $mail->addAddress($_POST['Correo']);     // Add a recipient

	      // Content
	      $mail->isHTML(true);                                  // Set email format to HTML
	      $mail->Subject = 'Confirmacion de cuenta';
	      $mail->Body    = '<!DOCTYPE html>
	            <html lang="en" >
	            <head>
	              <meta charset="UTF-8">
	              <title>CodePen - Avisado Prototipo</title>
	              <link rel="stylesheet" href="./style.css">
	            
	            </head>
	            <body>
	            <!-- partial:index.partial.html -->
	            <html>
	              <head>
	                <meta charset="utf-8" />
	                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	                <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,700italic,400italic|Sigmar+One|Pacifico|Architects+Daughter" rel="styleshee" type="text/css">
	                <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
	                <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	              </head>
	              <body>
	                <header>
	                  <div class="container">
	                    <section class="banner_row">
	                      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                          <figure class="animated fadeInLeft">
	                            <a href="index.html">
	                              <img src="http://imgfz.com/i/I1qms2R.png" class="responsive-image" alt="responsive-image" height="128" width="120"/>
	                            </a>
	                          </figure>
	                      </div>
	                      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                        <h1 class="animated fadeInLeft">>>AVISADO!</h1>
	                      </div>
	                    </section>
	                  </div>
	                </header>
	                <section class="formulario-princ">
	                  <div class="container">
	                    <form class="form-inline">
	                      <div class="form-group">
	                        <img src="http://imgfz.com/i/I1qms2R.png" alt="" />
	                      </div>
	                      <div class="form-group">
	                      <p>Hola que tal: su usuario esta completado, con su usuario y contraseña podra ingresar, por favor tener en cuenta los siguientes items </p><br>
	                      <h3>Correo</h3><br>
	                      <p>'.$_POST['Correo'].'</p><br>
	                      <h3>Contraseña</h3><br>
	                      <p>'.$_POST['Contrasena'].'</p><br>
	                      </div>
	                    </form>
	                  </div>
	                </section>
	                </div>
	                <br />
	                <br />
	                <div class="footer-container">
	                <footer class="wrapper">
	                  <div class="container">
	                    <h3>Trabajamos para ti, ¡Espéranos!</h3>
	                    <p>Para más información, <strong>puedes escribirnos a:</strong> 
	                      <a href="mailto:contacto@avisado.co.ve">contacto@avisado.co.ve</a>
	                    </p>
	                  </div>
	                </footer>
	                </div>
	              </body>
	            </html>
	            <!-- partial -->
	              
	            </body>
	            </html>
	            ';

	      $mail->send();
          header('Location: ?controller=person&method=list');
	    } catch (Exception $e) {
	      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	    }  
	}

	public function profile(){
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$data = $this->model->getById($id);
			require 'Views/Persons/Layout.php';
			require 'Views/Persons/Profile.php';
			require 'Views/Persons/Scripts.php';
		}
	}
}
