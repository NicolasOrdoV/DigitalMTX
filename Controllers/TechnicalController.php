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
			if (preg_match('/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST['Observacion_tecnico'])) {
				$data = [
		           'Observacion_tecnico' => $_POST['Observacion_tecnico'],
		           'Fecha_anexo_Tecnico' => $_POST['Fecha_anexo_Tecnico'],
		           'Hora_Anexo_Tecnico' => $_POST['Hora_Anexo_Tecnico'],
		           'Id_Garantia' => $_POST['Id_Garantia'],
		           'Id_Empleado' => $_POST['Id_Empleado']
				];
				date_default_timezone_set('America/Bogota');
                $hora_actual = date("h:i a");
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
					$this->model->editStatus($dates);
					echo '<pre>';
					var_dump($dates);
					echo '</pre>';

				}else{
					$dates = [
						'id' => $data['Id_Garantia'],
						'Estado' => $_POST['Estado_tecnico']
					];
					$this->model->editStatus($dates);
					echo '<pre>';
					var_dump($role);
					echo '</pre>';
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
			      $mail->Password   = 'batman1000464327';                               // SMTP password
			      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			      $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			      //Recipients
			      $mail->setFrom('nikomegathet666@gmail.com');
			      $mail->addAddress($dataTec[0]->Correo_Cliente);     // Add a recipient

			      // Content
			      $mail->isHTML(true);                                  // Set email format to HTML
			      $mail->Subject = 'Solicitud de garantia';
			      $mail->Body    = '
				  <!DOCTYPE html>
				  <html lang="en" >
				  <head>
					<meta charset="UTF-8">
					<title>Digital MTX Garantias</title>
					<style type="text/css">
				  @media only screen and (max-width: 600px) {
					  .main {
						  width: 320px !important;
					  }
					  .top-image {
						  width: 100% !important;
					  }
					  .inside-footer {
						  width: 320px !important;
					  }
					  table[class="contenttable"] {
						  width: 320px !important;
						  text-align: left !important;
					  }
					  td[class="force-col"] {
						  display: block !important;
					  }
					  td[class="rm-col"] {
						  display: none !important;
					  }
					  .mt {
						  margin-top: 15px !important;
					  }
					  *[class].width300 {
						  width: 255px !important;
					  }
					  *[class].block {
						  display: block !important;
					  }
					  *[class].blockcol {
						  display: none !important;
					  }
					  .emailButton {
						  width: 100% !important;
					  }
					  .emailButton a {
						  display: block !important;
						  font-size: 18px !important;
					  }
				  }
				  </style>
				  
				  </head>
				  <body>
				  <!-- partial:index.partial.html -->
				  <body link="#00a5b5" vlink="#00a5b5" alink="#00a5b5">
				  
				  <table class=" main contenttable" align="center" style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;width: 600px;">
					  <tr>
						<td class="border" style="border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
						  <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
							<tr>
							  <td colspan="4" valign="top" class="image-section" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff;border-bottom: 4px solid  #F44336">
								<a href="https://www.digitalmtx.com/"><img class="top-image" src="http://imgfz.com/i/I1qms2R.png" style="line-height:100;width: 100px;" alt="Digital MTX"></a>
								<p style="float: right;">Hora modificado: '.$hora_actual.'</p>
							  </td>
							</tr>
							<tr>
							  <td valign="top" class="side title" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
								<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
								  <tr>
									<td class="head-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 28px;line-height: 34px;font-weight: bold; text-align: center;">
									  <div class="mktEditable" id="main_title">
										Proceso de la Garantia:'.$dataTec[0]->No_garantia.'
									  </div>
									</td>
								  </tr>
								  <tr>
									<td class="sub-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 18px;line-height: 29px;font-weight: bold;text-align: center;">
									<div class="mktEditable" id="intro_title">
									  Estimado Usuario
									</div></td>
								  </tr>
								  <tr>
									<td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"></td>
								  </tr>
								  
								  <tr>
									<td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;">
									  <hr size="1" color="#eeeff0">
									</td>
								  </tr>
								  <tr>
									<td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
									<div class="mktEditable" id="main_text">
					
				  
									  Su actual estado de la garantia se encuentra en '.$dataTec[0]->Estado .'<br><br>
									  
									</div>
									</td>
								  </tr>
								  <tr>
									<td style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
									 &nbsp;<br>
									</td>
								  </tr>
								  
				  
								</table>
							  </td>
							</tr>
						
												
							<tr bgcolor="#fff" style="border-top: 4px solid  #F44336;">
							  <td valign="top" class="footer" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background: #fff;text-align: center;">
								<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
								  <tr>
									<td class="inside-footer" align="center" valign="middle" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 12px;line-height: 16px;vertical-align: middle;text-align: center;width: 580px;">
				  <div id="address" class="mktEditable">
			        <b>Digital MTX</b><br>
	                    2020<br> 
				    Para mas informacion consulte <a style="color: #F44336;" href="http://localhost/Digitalmtx/?controller=client&method=list">aqui</a> su estado de garantia
				  </div>
									</td>
								  </tr>
								</table>
							  </td>
							</tr>
						  </table>
						</td>
					  </tr>
					</table>
					</body>
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

	public function storyTechnical()
	{
		if (isset($_SESSION['user'])) {
			require 'Views/Layout.php';
			$technicals = $this->model->getAllTechnicals();
			require 'Views/Technicals/storyTechnical.php';
			require 'Views/Scripts.php';
		}else{
			header('Location: ?controller=login');
		}
	}
}