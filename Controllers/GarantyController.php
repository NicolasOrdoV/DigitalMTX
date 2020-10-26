<?php 

require 'Models/Garanty.php';
require 'Models/Client.php';
require 'Models/Product.php';
require 'Models/Provider.php';
require 'Models/Departament.php';
require 'Models/Municipality.php';


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
  private $client;
  private $product;
  private $provider;
  private $departament;
  private $municipality;

  public function __construct()
  {
    $this->model = new Garanty;
    $this->client = new Client;
    $this->product = new Product;
    $this->provider = new Provider;
    $this->departament = new Departament;
    $this->municipality = new Municipality;
  }

  public function listGaranty()
  {
    require 'Views/Layout.php';
    $garanties = $this->model->getAllDet();
    require 'Views/Garanty/listGaranty.php';
    require 'Views/Scripts.php';
  }
  public function new()
  {
    require 'Views/Layout.php';
    $data = $this->model->getAll();
    $total_data = count($data);
    $clients = $this->client->getAll();
    $products = $this->product->getAll();
    $providers = $this->provider->getAll();
    $departaments = $this->departament->getAll();
    $municipalities = $this->municipality->getAll();
    require 'Views/Garanty/garantia_empleado.php';
    require 'Views/Scripts.php';
  }

  public function findBill()
  {
    if (isset($_POST['NumFactura'])) {
      $bill = $_POST['NumFactura'];
      $bills = $this->model->getBill($bill);
      require 'Views/Layout.php';
      $data = $this->model->getAll();
      $total_data = count($data);
      $providers = $this->provider->getAll();
      $departaments = $this->departament->getAll();
      $municipalities = $this->municipality->getAll();
      require 'Views/Garanty/garantia_empleado.php';
      require 'Views/Scripts.php';
    }
  }

  public function save()
  {
      $data = [
        'No_Garantia' => $_POST['No_Garantia'],
        'Fecha_ingreso' => $_POST['Fecha_ingreso'],
        'Hora_ingreso' => $_POST['Hora_ingreso'],
        'Numero_Factura' => $_POST['Numero_Factura'],
        'Punto_Venta' => $_POST['Punto_Venta'],
        'Fecha_Compra' => $_POST['Fecha_Compra'],
        'Nombre_Cliente' => $_POST['Nombre_Cliente'],
        'Identificacion_Cliente' => $_POST['Identificacion_Cliente'],
        'Correo_Cliente' => $_POST['Correo_Cliente'],
        'Direccion_Cliente' => $_POST['Direccion_Cliente'],
        'Proveedor' => $_POST['Proveedor'],
        'Flete' => $_POST['Flete'],
        'Departamento' => $_POST['Departamento'],
        'Municipio' => $_POST['Municipio'],
        'Valor_Flete' => $_POST['Valor_Flete'],
        'No_Guia' => $_POST['No_Guia'],
        'Transportadora' => $_POST['Transportadora'],
        'Observacion_Empleado' => $_POST['Observacion_Empleado'],
        'Empleado' => $_POST['Empleado']
      ];
      
      $answerNewGaranty = $this->model->newGaranty($data);
      $lastId = $this->model->getLastId();

      $Codigo_Producto = ($_POST['Codigo_Producto']);
      $Descripcion_Producto = ($_POST['Descripcion_Producto']);
      $Marca_Producto = ($_POST['Marca_Producto']);
      $Sello_Producto = ($_POST['Sello_Producto']);
      $Referencia = ($_POST['Referencia']);
      $garanty = ($_POST['garanty']);
      $Observacion_Cliente = ($_POST['Observacion_Cliente']);
      $Aprobacion_Garantia = ($_POST['Aprobacion_Garantia']);
      $Aprobacion_GarantiaN = ($_POST['Aprobacion_GarantiaN']);
      $Estado = ($_POST['Estado']);

      while (true) {
        $item1 = current($Codigo_Producto);
        $item2 = current($Descripcion_Producto);
        $item3 = current($Marca_Producto);
        $item4 = current($Sello_Producto);
        $item5 = current($Referencia);
        $item6 = current($Observacion_Cliente);
        $item7 = current($Aprobacion_Garantia);
        $item8 = current($Aprobacion_GarantiaN);
        $item9 = current($Estado);

        $cp = (($item1 !== false) ? $item1 : ", &nbsp;");
        $dp = (($item2 !== false) ? $item2 : ", &nbsp;");
        $mp = (($item3 !== false) ? $item3 : ", &nbsp;");
        $sp = (($item4 !== false) ? $item4 : ", &nbsp;");
        $rp = (($item5 !== false) ? $item5 : ", &nbsp;");
        $op = (($item6 !== false) ? $item6 : ", &nbsp;");
        $ag = (($item7 !== false) ? $item7 : ", &nbsp;");
        $agN = (($item8 !== false) ? $item8 : ", &nbsp;");
        $es = (($item9 !== false) ? $item9 : ", &nbsp;");

        $detaills = [
          'Codigo_Producto' => $cp,
          'Descripcion_Producto' => $dp,
          'Marca_Producto' => $mp,
          'Sello_Producto' => $sp,
          'Referencia' => $rp,
          'Id_Garantia' => $lastId[0]->id,
          'Observacion_Cliente' => $op,
          'Aprobacion_Garantia' => $ag,
          'Estado' => $es
        ];
        if (isset($lastId[0]->id) && $answerNewGaranty == true && $ag == 'SI') {
          $answerNewDetaills = $this->model->saveDetail($detaills);
          if ($answerNewDetaills == true) {
            $dates = $this->model->getAlDetails();
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
              $mail->addAddress($data['Correo_Cliente']);     // Add a recipient

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
                              <p>Hola que tal: Su proceso de garantia fue: ' . $dates['Estado'] . '</p><br>
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
            } catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            // Up! Next Value
            $item1 = next($Codigo_Producto);
            $item2 = next($Descripcion_Producto);
            $item3 = next($Marca_Producto);
            $item4 = next($Sello_Producto);
            $item5 = next($Referencia);
            $item6 = next($Observacion_Cliente);
            $item7 = next($Aprobacion_Garantia);
            $item8 = next($Aprobacion_GarantiaN);
            $item9 = next($Estado);
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item7 === false && $item8 === false&& $item9 === false) break;
            header('Location: ?controller=garanty&method=sucessfull'); 
          }else{
            echo 'Hubo un error';
          }  
        }elseif(isset($lastId[0]->id) && $answerNewGaranty == true && $agN == 'NO'){
          $detaills['Estado'] = 'Cerrado';
          $detaills['Aprobacion_Garantia'] = $agN;
          $answerNewDetaills = $this->model->saveDetail($detaills);
          if ($answerNewDetaills == true) {
            $datesN = $this->model->getAll();
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
              $mail->addAddress($data['Correo_Cliente']);     // Add a recipient

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
                              <p>Hola que tal: Su proceso de garantia fue: ' . $datesN['Estado'] . '</p><br>
                              <p>Segun las observaciones de garantia: '.$data['Observacion_Empleado'].'.</p>
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
            } catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            // Up! Next Value
              $item1 = next($Codigo_Producto);
              $item2 = next($Descripcion_Producto);
              $item3 = next($Marca_Producto);
              $item4 = next($Sello_Producto);
              $item5 = next($Referencia);
              $item6 = next($Observacion_Cliente);
              $item7 = next($Aprobacion_Garantia);
              $item8 = next($Aprobacion_GarantiaN);
              $item9 = next($Estado); 
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item7 === false && $item8 === false&& $item9 === false) break;
            header('Location: ?controller=garanty&method=sucessfull'); 
          }
        }
      }
  }
   
  public function sucessfull(){
    require 'Views/Layout.php';
    require 'Views/Garanty/succesfull.php';
    require 'Views/Scripts.php';
  }

  public function consecutive()
  {
    if (isset($_REQUEST['id'])) {
      $mpdf = new \Mpdf\Mpdf();
      $id = $_REQUEST['id'];
      $data = $this->model->getById($id);

      /*foreach ($data as $product) {
        echo $product->Descripcion_Producto.'<br>';
      }*/
      //$productos = [];
      foreach ($data as $product) {
        $html = '
          <p>'.$data[0]->No_garantia.'</p><br>
          <p>'.$product->Descripcion_Producto.'</p><br>
          <p>'.$product->Codigo_Producto.'</p><br>
        '; 
        $mpdf->WriteHTML($html);
      }  
      $mpdf->Output();
    }
  }

  public function ticket()
  {
    if (isset($_REQUEST['id'])) {
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236] , 'orientation' => 'L']);
      $id = $_REQUEST['id'];
      $data = $this->model->getById($id);
      $html = '';
      /*foreach ($data as $product) {
        echo $data[0]->No_garantia.'<br>';
        echo $data[0]->Nombre_Cliente.'<br>';
        echo $product->Descripcion_Producto.'<br>';
        echo $data[0]->Fecha_ingreso.'<br>';
        echo '<hr>';
      }*/
      foreach ($data as $product) {
        $html = '';
        $html .= '<h1>' . $data[0]->No_garantia . '</h1>
                 <h1>' . $data[0]->Referencia . '</h1>
                 <h1>' . $data[0]->Codigo_Producto . '</h1>
                 <h1>' . $data[0]->Descripcion_Producto . '</h1>
                 <h1>' . $product->Observacion_Cliente . '</h1>';
                 $mpdf->AddPage('L');
                 $mpdf->WriteHTML($html);
      }
      
      $mpdf->Output();
    }
  }
}
