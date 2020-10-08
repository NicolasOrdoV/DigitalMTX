<?php

require 'Models/Garanty.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/**
 * controlador personal
 */
class GarantyController
{
	private $model;
	

	public function __construct()
	{
		$this->model = new Garanty;
	}


    public function save()
    {
        $this->model->newGaranty($_REQUEST);
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
		    $mail->addAddress($_POST['Correo_Cliente']);     // Add a recipient

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Solicitud de garantia';
		    $mail->Body    = '<p>Hola que tal: Su proceso de garantia fue: '.$_POST['Estado'].'</p><br>
		                      <p>Por favor este pendiente de su correo para alguna novedad.</p>';

		    $mail->send();
		    $succesfull = "Garantia exitosa, correo enviado al cliente";
		    require 'Views/Persons/Layout.php';
			require 'Views/Garanty/garantia_empleado.php';
			require 'Views/Persons/Footer.php';
			require 'Views/Persons/Scripts.php';
			return $succesfull;
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

	}
	

	public function listGaranty(){
        require 'Views/Persons/Layout.php';
        $garanties = $this->model->getAll();
		require 'Views/Garanty/listGaranty.php';
		require 'Views/Persons/Footer.php';
		require 'Views/Persons/Scripts.php';
	}
	public function new(){
		require 'Views/Persons/Layout.php';
		require 'Views/Garanty/garantia_empleado.php';
		require 'Views/Persons/Footer.php';
		require 'Views/Persons/Scripts.php';
	}


}
