<?php

require 'Models/Technical.php';
require 'Models/Garanty.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

/**
 * Controlador tecnico
 */
class TechnicalController
{
	private $model;
	private $garanty;

	public function __construct()
	{
		$this->model = new Technical;
		$this->garanty = new Garanty;
	}

	public function list()
	{
		if (isset($_SESSION['user'])) {
			require 'Views/Layout.php';
			$technicals = $this->model->getAll();
			require 'Views/Technicals/list.php';
			require 'Views/Scripts.php';
		}else{
			header('Location: ?controller=login');
		}
	}

	public function details()
	{
		if (isset($_SESSION['user'])) {
			if (isset($_REQUEST['name'])) {
				$name = $_REQUEST['name'];
				$id = $_REQUEST['id'];
				$data = $this->garanty->getByIdTec($name,$id);
				$consecutives = $this->model->consecutives($id);
				//$details = $this->garanty->getAlDetails($id);
			    require 'Views/Layout.php';
				require 'Views/Technicals/details.php';
				require 'Views/Scripts.php';
			}
		}else{
			header('Location: ?controller=login');
		}
	}

	public function save()
	{
		if (isset($_SESSION['user'])) {
			if (preg_match('/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ.,; ]+$/', $_POST['Observacion_tecnico'])) {
				$data = [
		           'Observacion_tecnico' => $_POST['Observacion_tecnico'],
		           'Fecha_anexo_Tecnico' => $_POST['Fecha_anexo_Tecnico'],
		           'Hora_Anexo_Tecnico' => $_POST['Hora_Anexo_Tecnico'],
		           'Id_Garantia' => $_POST['Id_Garantia'],
		           'Id_Empleado' => $_POST['Id_Empleado']
				];
				//$id = $_REQUEST['Id_Garantia'];
				$name = $_POST['nombre'];
				$this->model->newTechnical($data);
				$role = $this->model->getByIdDet($name);
				$dates = [];
				if ($role[0]->Estado == 'Tramite' || $role[0]->Estado == "Pendiente por servicio tecnico") {
					$dates = [
						'id' => $data['Id_Garantia'],
						'Estado' => $_POST['Estado_tecnico']
					];
				}else{
					$dates = [
						'id' => $data['Id_Garantia'],
						'Estado' => $_POST['Estado_tecnico']
					];
				}
				$this->model->editStatus($dates);
				$dataTec = $this->model->getByIdDetM($_POST['Id_Garantia']);
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
			      $mail->addAddress($dataTec[0]->Correo_Cliente);     // Add a recipient

			      // Content
			      $mail->isHTML(true);                                  // Set email format to HTML
			      $mail->Subject = 'Solicitud de garantia';
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
			                      <p>Hola que tal: Su proceso de garantia fue: ' . $dataTec[0]->Estado . '</p><br>
			                      <p>Por favor este pendiente de su correo para alguna novedad.</p>
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
			      header('Location: ?controller=technical&method=succesfull');
			    } catch (Exception $e) {
			      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			    }
			}else{
				header('Location: ?controller=technical&method=failed');
			}
	    }else{
			header('Location: ?controller=login');
		}	
	}

	public function failed()
	{
		if (isset($_SESSION['user'])){
        	require 'Views/Layout.php';
			require 'Views/Technicals/failed.php';
			require 'Views/Scripts.php'; 
		}else{
			header('Location: ?controller=login');
		}	
	}

	public function edit()
	{
		if (isset($_SESSION['user'])) {
			if ($_REQUEST['id']) {
				$id = $_REQUEST['id'];
				$data = $this->model->getByIdTec($id);
				require 'Views/Layout.php';
				require 'Views/Technicals/edit.php';
				require 'Views/Scripts.php';
			}
		}else{
			header('Location: ?controller=login');
		}
	}

	public function update()
	{
		if (isset($_SESSION['user'])) {
			if ($_POST) {
				$this->model->updateTechnical($_POST);
			    require 'Views/Layout.php';
				require 'Views/Technicals/editSuccesfull.php';
				require 'Views/Scripts.php';
			}
		}else{
			header('Location: ?controller=login');
		}
	}

	public function succesfull()
	{
		if (isset($_SESSION['user'])) {
			require 'Views/Layout.php';
			require 'Views/Technicals/editSuccesfull.php';
			require 'Views/Scripts.php';
		}else{
			header('Location: ?controller=login');
		}
	}
}