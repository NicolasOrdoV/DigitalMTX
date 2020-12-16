<?php

require 'Models/Garanty.php'; 
require 'Models/Client.php';
require 'Models/Product.php';
require 'Models/Provider.php';
require 'Models/Departament.php';
require 'Models/Municipality.php';
require 'Models/Technical.php';
require 'Models/Bill.php';


use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
require 'Assets/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea

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
  private $technical;
  private $bill;

  public function __construct()
  {
    $this->model = new Garanty;
    $this->client = new Client;
    $this->product = new Product;
    $this->provider = new Provider;
    $this->departament = new Departament;
    $this->municipality = new Municipality;
    $this->technical = new Technical;
    $this->bill = new Bill;
  }

  public function listGaranty()
  {
    if (isset($_SESSION['user'])) {
      require 'Views/Layout.php';
      $garanties = $this->model->getAllDet();
      require 'Views/Garanty/listGaranty.php';
      require 'Views/Scripts.php';
    }else{
      header('Location: ?controller=login');
    }
  }
  
  public function new()
  {
    if (isset($_SESSION['user'])) {
      require 'Views/Layout.php';
      $data = $this->model->getTotal();
      $total_data = count($data);
      $clients = $this->client->getAll();
      $products = $this->product->getAll();
      $providers = $this->provider->getAll();
      $departaments = $this->departament->getAll();
      $municipalities = $this->municipality->getAll();
      require 'Views/Garanty/garantia_empleado.php';
      require 'Views/Scripts.php';
    }else{
      header('Location: ?controller=login');
    }
  }

  public function findBill() 
  {
    if (isset($_SESSION['user'])) {
      if (isset($_POST['NumFactura'])) {
        if (preg_match('/^[0-9a-zA-Z-]+$/', $_POST['NumFactura'])) {
          $bill = $_POST['NumFactura'];
          $search = $this->model->getBill($bill);
          $bills = $this->model->getByNumBill($search[0]->Numero_Factura);
          $dataF = $this->model->getAllF($bill);
          $fac1 = isset($dataF[0]->Numero_Factura) ? $dataF[0]->Numero_Factura : 'null';
          $fac2 = $bills[0]->Numero_Factura;

          $date_now = date('d-m-Y');
          $date_bill = $bills[0]->fecha_factura;
          $date_month = date('Y-m-d',strtotime($bills[0]->fecha_factura."+ 6 months"));
          $date_now = strtotime($date_now)."<br>";
          $date_bill = strtotime($date_bill)."<br>";
          $date_month = strtotime($date_month);

          if ($bills == null) {
            header('Location: ?controller=garanty&method=failed');
          }elseif ($fac1 === $fac2) {
            header('Location: ?controller=garanty&method=failed');
          }elseif($fac1 !== $fac2){
            if ($bills[0]->garantia == "1 año freidora - 6 meses en panel táctil " || $bills[0]->garantia == '1 año telefono - 6 meses de batería y cargador' ) {
              if ($date_now >= $date_bill && $date_now >= $date_month) {
                $billFailed = [
                  'error' => 'El tiempo de garantia de algunos de los productos esta vencida'
                ];
                $details = $this->model->getGaranty($bill);
                require 'Views/Layout.php';
                $data = $this->model->getAll();
                $total_data = count($data);
                $providers = $this->provider->getAll();
                $departaments = $this->departament->getAll();
                $municipalities = $this->municipality->getAll();
                require 'Views/Garanty/garantia_empleado.php';
                require 'Views/Scripts.php';
              }else{
                $details = $this->model->getGaranty($bill);
                require 'Views/Layout.php';
                $data = $this->model->getAll();
                $total_data = count($data);
                $providers = $this->provider->getAll();
                $departaments = $this->departament->getAll();
                $municipalities = $this->municipality->getAll();
                require 'Views/Garanty/garantia_empleado.php';
                require 'Views/Scripts.php';
              }
            }elseif($bills[0]->garantia == "Probado" || $bills[0]->garantia == "0" || $bills[0]->garantia == "0 meses"){
              $billFailed = [
                  'error' => 'El producto no lleva garantia'
                ];
              $details = $this->model->getGaranty($bill);
              require 'Views/Layout.php';
              $data = $this->model->getAll();
              $total_data = count($data);
              $providers = $this->provider->getAll();
              $departaments = $this->departament->getAll();
              $municipalities = $this->municipality->getAll();
              require 'Views/Garanty/garantia_empleado.php';
              require 'Views/Scripts.php';
            }else{
              $details = $this->model->getGaranty($bill);
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
        }else{
            require 'Views/Layout.php';
            $data = $this->model->getTotal();
            $total_data = count($data);
            $clients = $this->client->getAll();
            $products = $this->product->getAll();
            $providers = $this->provider->getAll();
            $departaments = $this->departament->getAll();
            $municipalities = $this->municipality->getAll();
            $error = [
              'error' => 'El formato de factura no es correcto, vuelvalo a intentar'
            ];
            require 'Views/Garanty/garantia_empleado.php';
            require 'Views/Scripts.php';
          }
      }
    }else{
      header('Location: ?controller=login');
    }
  }

  public function failed()
  {
    if (isset($_SESSION['user'])) {
      require 'Views/Layout.php';
      require 'Views/Garanty/failed.php';
      require 'Views/Scripts.php';
    }else{
      header('Location: ?controller=login');
    }
  }

  public function save()
  {
    if (isset($_SESSION['user'])) {
      if (filter_var($_POST['Correo_Cliente'],FILTER_VALIDATE_EMAIL)) {
        //-------------------------//
        $fecha_factura = $_POST['fecha_factura'];
        $fecha_factura = date('Y-m-d' , strtotime($fecha_factura));
        $parts = explode("-", $fecha_factura);
        //var_dump($parts);
        echo "Fecha de la factura: ".$fecha_factura.'<br>';
        $fecha_actual = $_POST['Fecha_ingreso'];
        $fecha1 = explode("/", $fecha_actual);
        $fecha2 = implode("-", $fecha1);
        $fecha2 = date('Y-m-d', strtotime($fecha2));
        echo "Fecha del dia de hoy: ".$fecha2.'<br>';

        $fecha_proxima = null;
        $date_before = null;
        $date_now = strtotime($fecha2);
        //echo $date_now.'<br>';
        $date_bill = strtotime($fecha_factura);
        //echo $date_bill.'<br>';
        //-------------------------//
        $fecha_compra = $_POST['Fecha_Compra'];
        $data = [
          'No_garantia' => $_POST['No_garantia'],
          'Fecha_ingreso' => $fecha2,
          'Hora_ingreso' => $_POST['Hora_ingreso'],
          'Numero_Factura' => $_POST['Numero_Factura'],
          'Punto_Venta' => $_POST['Punto_Venta'],
          'Fecha_Compra' => $fecha_compra,
          'Nombre_Cliente' => $_POST['Nombre_Cliente'],
          'Identificacion_Cliente' => $_POST['Identificacion_Cliente'],
          'Correo_Cliente' => $_POST['Correo_Cliente'],
          'Direccion_Cliente' => $_POST['Direccion_Cliente'],
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

        $Codigo_Producto = $_POST['Codigo_Producto'];
        $Descripcion_Producto = $_POST['Descripcion_Producto'];
        $Marca_Producto = $_POST['Marca_Producto'];
        $Sello_Producto = $_POST['Sello_Producto'];
        $Cantidad_Producto = $_POST['Cantidad_Producto'];
        $Codigo_Proveedor = $_POST['Codigo_Proveedor'];
        $Referencia = $_POST['Referencia'];
        $Observacion_Cliente = ($_POST['Observacion_Cliente']);
        $Aprobacion_Garantia = ($_POST['Aprobacion_Garantia']);
        $Estado = ($_POST['Estado']);
        $garantia = ($_POST['time']);
        $dateProvider = ($_POST['Fecha_Proveedor']);

        while (true) {
          $item1 = current($Codigo_Producto);
          $item2 = current($Descripcion_Producto);
          $item3 = current($Marca_Producto);
          $item4 = current($Sello_Producto);
          $item5 = current($Codigo_Proveedor);
          $item6 = current($Cantidad_Producto);
          $item7 = current($Referencia);
          $item8 = current($Observacion_Cliente);
          $item9 = current($Aprobacion_Garantia);
          $item10 = current($Estado);
          $item11 = current($garantia);
          $item12 = current($dateProvider);

          $cp = (($item1 !== false) ? $item1 : '');
          $dp = (($item2 !== false) ? $item2 : '');
          $mp = (($item3 !== false) ? $item3 : '');
          $sp = (($item4 !== false) ? $item4 : '');
          $cpro = (($item5 !== false) ? $item5 : '');
          $canPro = (($item6 !== false) ? $item6 : '');
          $rp = (($item7 !== false) ? $item7: '');
          $op = (($item8 !== false) ? $item8 : '');
          
            $ag = (($item9 !== false) ? $item9 : '');
          
          $es = (($item10 !== false) ? $item10 : '');
          $g = (($item11 !== false) ? $item11 : '');
          $dP = (($item12 !== false) ? $item12 : '');

          
          $detaills = [
            'Codigo_Producto' => $cp,
            'Descripcion_Producto' => $dp,
            'Marca_Producto' => $mp,
            'Sello_Producto' => $sp,
            'Referencia' => $rp,
            'Cantidad_Producto' => $canPro,
            'Codigo_Proveedor' => $cpro,
            'Fecha_Proveedor' => $dP,
            'Id_Garantia' => $lastId[0]->id,
            'Observacion_Cliente' => $op,
            'Estado' => $es,
            'Aprobacion_Garantia' => $ag
          ];
          
          //var_dump($detaillsN);
          //$detaills['Aprobacion_Garantia'] = $agN;
          //echo '<hr>';
          //var_dump($detaills);
          if ($ag == 'SI') {
            echo "Garantia: ".$g.'<br>';
            if ($g == '1 Año' || $g =='1 año') {
              $year = date($parts[0]);
              $afterYear = $year+1;
              $fecha_proxima = date($afterYear.'-'.$parts[1].'-'.$parts[2]);
              $date_before = strtotime($fecha_proxima);
              //echo $fecha_proxima;
            }elseif($g == '2 Años'){
                $year = date($parts[0]);
                $afterYear = $year+1;
                $fecha_proxima = date($afterYear.'-'.$parts[1].'-'.$parts[2]);
                $date_before = strtotime($fecha_proxima);
                //echo $fecha_proxima;    
            }elseif($g == '6 Meses'){
                $fecha_proxima = date("Y-m-d",strtotime($fecha_factura."+ 6 months"));
                $date_before = strtotime($fecha_proxima);
                //echo $fecha_proxima;   
            }elseif($g == '3 meses'){
                $fecha_proxima = date("Y-m-d",strtotime($fecha_factura."+ 3 months"));
                $date_before = strtotime($fecha_proxima);
                //echo $fecha_proxima;    
            }elseif($g == '1 mes' || $g == '1 meses'){
                $fecha_proxima = date("Y-m-d",strtotime($fecha_factura."+ 1 month"));
                $date_before = strtotime($fecha_proxima);
                //echo $fecha_proxima;
            }elseif($g == "1 año freidora - 6 meses en panel táctil " || $g == '1 año telefono - 6 meses de batería y cargador'){
              $year = date($parts[0]);
              $afterYear = $year+1;
              $fecha_proxima = date($afterYear.'-'.$parts[1].'-'.$parts[2]);

              $date_before = strtotime($fecha_proxima);
              $fecha_proxima_mes =  date("Y-m-d", strtotime($fecha_factura.'+ 6 months'));
              $date_month = strtotime($fecha_proxima_mes);

              echo "Fecha estimada para 6 meses despues de la fecha de factura: ".$fecha_proxima_mes.'<br>';
              echo "Fecha estimada para un año despues de la fecha de factura: ".$fecha_proxima."<br>";

              if ($date_now >= $date_bill && $date_now <= $date_month){
                echo "<script>alert('Esta a tiempo de aplicar garantia a uno de los productos');</script>";
              }else{
                echo '<script>alert("El tiempo de garantia de uno de los productos esta vencida");</script>';
              }
            }else{
              echo '<script>alert("No tiene garantia");</script>';
            }
          }

          //----Aqui va la validacion de rango de fechas
          if ($date_now >= $date_bill && $date_now <= $date_before) {
            if (isset($lastId[0]->id) && $answerNewGaranty == true) {
              if ($ag == 'NO') {
                $detaills['Estado'] = "Cerrado";
                $this->model->saveDetail($detaills);
              }
              if ($ag == 'SI') {
                $detaills['Aprobacion_Garantia'] = $ag;
                $this->model->saveDetail($detaills);
              }  
            }
          }else{
            // echo 'La fecha de garantia expiro';
            echo '<script>
                    alert("La fecha de garantia expiro");
                    window.location = "?controller=garanty&method=listGaranty";
                  </script>';
          }
          //---Aqui termina el proceso de rango de fechas

          // Up! Next Value
          $item1 = next($Codigo_Producto);
          $item2 = next($Descripcion_Producto);
          $item3 = next($Marca_Producto);
          $item4 = next($Sello_Producto);
          $item5 = next($Codigo_Proveedor);
          $item6 = next($Cantidad_Producto);
          $item7 = next($Referencia);
          $item8 = next($Observacion_Cliente);
          $item9 = next($Aprobacion_Garantia);
          $item10 = next($Estado);
          $item11 = next($garantia);
          $item12 = next($dateProvider);
          // Check terminator
          if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false && $item8 === false && $item10 === false && $item11 === false && $item12 === false) break;
        }

        $dates = $this->model->getAlDetails($lastId[0]->id);
        if ($dates[0]->Estado == 'Tramite') {
          $datas = $this->model->getAlDetails($lastId[0]->id);
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
            $mail->addAddress($data['Correo_Cliente']);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Solicitud de garantia';
            $html = '<!DOCTYPE html>
            <html lang="en" >
            <head>
              <meta charset="UTF-8">
              <title>CodePen - PDF Factura</title>
              

            </head>
            <body>
            <!-- partial:index.partial.html -->
            <center>
              <div style="width: 580px;">
                <table CELLSPACING=1 CELLPADDING=4 style="border-collapse: collapse; font-size: 8px; line-height: .75; font-family: sans-serif; position: relative;">
                  <tr>
                    <td VALIGN="TOP" COLSPAN=4 HEIGHT=20>
                      <img src="http://imgfz.com/i/I1qms2R.png" alt="" width="70px">
                      <div style="display: inline-block; margin-left: 320px;">
                        <p style="font-weight: bold;">Digital MTX</p>
                        <p>Fecha de impresion: '.$data['Fecha_ingreso'].'</p>
                      </div>
                      <hr>
                      <p style="font-size:12px; text-align: center; margin-top: 20px;"><b>Comprobante de Garantia:'.$data['No_garantia'].'</b></p>
                    </td>
                  </tr>
                  <tr>
                    <td WIDTH="45%" VALIGN="TOP" HEIGHT=36>
                      <p><b>Nombre</b>'.$data['Nombre_Cliente'].'</p>
                      <p><b>Identificacion</b> '.$data['Identificacion_Cliente'].'</p>
                      <p><b>Correo:</b> '.$data['Correo_Cliente'].'</p>
                      <p><b>Direccion:</b> '.$data['Direccion_Cliente'].'</p>
                      
                    </td>
                    <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                      <P><b>Numero Factura:</b>'.$data['Numero_Factura'].'</p>
                      <p><b>Punto Venta</b>'.$data['Punto_Venta'].'</p>
                      <p><b>Valor_Flete:</b> '.$data['Valor_Flete'].'</p>
                      <p><b>Transportadora:</b> '.$data['Transportadora'].'</p>
                      <p><b>Numero Guia</b> '.$data['No_Guia'].'</p>
                    </td>
                  </tr>
                </table>

                <p style="font-size: 12px; text-align: left;"><b><i><u>Productos</u></i></b></p>
                <table border style="border: 1px solid black; font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px;">
                  <tr>
                    <th>Referencia</th>
                    <th>Descripcion</th>
                    <th>Marca</th>
                  </tr>';
                  foreach ($datas as $product) {
                  $html .= '<tr>
                  <td>'.$product->Referencia.'</td>
                    <td>'.$product->Descripcion_Producto.'</td>
                    <td>'.$product->Marca_Producto.'</td>
                  </tr>';
                }
                $html .= '</table><br>
                <div style="display: flex; justify-content: space-between; text-align: left; font-size: 10px;">
                  <div>
                    <div style="display:table; margin:auto; text-align:left;">
                      <p><b>Observacion Garantia:</b> '.$data['Observacion_Empleado'].'</p>
                    </div>
                   
              </div>
            </center>
            <!-- partial -->
              
            </body>
            </html>
            ';
            $mail->Body = $html;

            $mail->send();
            header('Location: ?controller=garanty&method=sucessfull');
          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
        } elseif ($dates[0]->Estado == 'Cerrado') {
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
                              <p>Hola que tal: Su proceso de garantia fue: ' . $dates[0]->Estado . '</p><br>
                              <p>Segun las observaciones de garantia: ' . $data['Observacion_Empleado'] . '.</p>
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
            header('Location: ?controller=garanty&method=sucessfull');
          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
        }
      }else{
        $failedError = [
          'error' => 'Hay campos que no son validos, por favor verificar que esten correctos todos los campos'
        ];
        $details = $this->model->getGaranty($bill);
        require 'Views/Layout.php';
        $data = $this->model->getAll();
        $total_data = count($data);
        $providers = $this->provider->getAll();
        $departaments = $this->departament->getAll();
        $municipalities = $this->municipality->getAll();
        require 'Views/Garanty/garantia_empleado.php';
        require 'Views/Scripts.php';
      }
    }else{
      header('Location: ?controller=login');
    }  
  }

  public function sucessfull()
  {
    if (isset($_SESSION['user'])) {
      require 'Views/Layout.php';
      require 'Views/Garanty/succesfull.php';
      require 'Views/Scripts.php';
    }else{
      header('Location: ?controller=login');
    } 
  }

  public function consecutive() 
  {
    if (isset($_SESSION['user'])) {
      if (isset($_REQUEST['id'])) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $id = $_REQUEST['id'];
        $dates = $this->model->getByIdG($id);
        date_default_timezone_set('America/Bogota');
        $hora_actual = date("h:i a");
        /*foreach ($dates as $product) {
          echo $product->Descripcion_Producto.'<br>';
        }*/
        //$productos = [];
        // foreach ($dates as $producte) {
          $html = '<!DOCTYPE html>
          <html lang="en" >
          <head>
            <meta charset="UTF-8">
            <title>Consecutivo</title>
            <script src="https://kit.fontawesome.com/a076d05399.js"></script>

          </head>
          <body>
          <!-- partial:index.partial.html -->
          <center>
            <div style="width: 880px;">
              <table CELLSPACING=1 CELLPADDING=4 style="border-collapse: collapse; font-size: 8px; line-height: .75; font-family: sans-serif; position: relative;">
                <tr>
                  <td VALIGN="TOP" COLSPAN=4 HEIGHT=20>
                    <img src="http://imgfz.com/i/I1qms2R.png" alt="" width="70px">
                    <div style="display: inline-block; margin-left: 320px;">
                      <p>Fecha de impresion: '.$dates[0]->Fecha_ingreso.'  Hora impresion: '.$hora_actual.'</p>
                    </div>
                    <hr>
                    <p style="font-size:12px; text-align: center; margin-top: 20px;"><b>Comprobante de Garantia:'.$dates[0]->No_garantia.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36>
                    <P><b>Numero Factura:</b>'.$dates[0]->Numero_Factura.'</p><br>
                    <p><b>Punto Venta:</b>'.$dates[0]->Punto_Venta.'</p><br>
                    <p><b>Nombre:</b>'.$dates[0]->Nombre_Cliente.'</p><br>
                    <p><b>Identificación:</b> '.$dates[0]->Identificacion_Cliente.'</p><br>
                    
                    <p><b>Direccion:</b> '.$dates[0]->Direccion_Cliente.'</p><br>
                    <p><b>Correo:</b> '.$dates[0]->Correo_Cliente.'</p><br>
                  </td>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                    <p><b>Departamento:</b> '.$dates[0]->Departamento.'</p><br>
                    <p><b>Municipio:</b> '.$dates[0]->Municipio.'</p><br>
                    <p><b>Numero Guia:</b> '.$dates[0]->No_Guia.'</p><br>
                    <p><b>Valor del flete:</b> '.$dates[0]->Valor_Flete.'</p><br>
                    <p><b>Transportadora:</b> '.$dates[0]->Transportadora.'</p><br>
                  </td>
                </tr>
              </table>
              
              <p style="font-size: 12px; text-align: left;"><b><i><u>Productos</u></i></b></p>
              <table border style="border: 1px solid black; font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px;">
                <tr>
                <th>Referencia</th>
                <th>Cantidad</th>
                  <th>Descripcion</th>
                  <th>Marca</th>
                  <th>Sello</th>
                </tr>';
                foreach ($dates as $producte){ 
               $html .= '<tr>
                          <td>'.$producte->Referencia.'</td><br>
                          <td>'.$producte->Cantidad.'</td><br>
                          <td>'.$producte->Descripcion_Producto.'</td><br>
                          <td>'.$producte->Marca_Producto.'</td><br>
                          <td>'.$producte->Sello_Producto.'</td><br>
                        </tr>';
                }
              $html .= '</table><br>


            

              <div style="display: flex; justify-content: space-between; text-align: left; font-size: 10px;">
                <div>
                  <div style="display:table; margin:auto; text-align:left;">
                    <p><b>Observacion Garantia:</b> '.$dates[0]->Observacion_Empleado.'</p><br>
                  </div>
               <small style="font-size: 6px; justify-content: center;">"Garantía: El horario de atención es de lunes a viernes de 09:00 a 13:00 en la calle 77 # 16A – 38 Oficina 303¤2)Para el ingreso del producto a garantía el cliente deberá entregar el documento de compra y el producto completo con sus empaques, accesorios, manuales, sin daños físicos que invaliden la garantía. 3)El periodo para dar¤solución a la garantía es de (8) ocho días hábiles, a partir de la fecha de radicado. 4)La Garantía no cubre en los siguientes casos: • Cuando el producto presenta daño físico, por mal uso, mala manipulación, transporte o¤descuido. • Cuando los sellos de garantía se encuentren removidos o sobre etiquetados remarcados. • Daños causados por descargas eléctricas o uso de voltaje incorrecto. • Daños generados por¤presencia de elementos nocivos que no forman parte del producto. • Si el cliente ha cambiado el software original de fábrica. 5)Toda garantía que no¤se reclame en (1) mes a partir de la fecha de ingreso, se hará un cobro de bodegaje, transcurrido los (6) meses será declarada en abandono y se procederá a su destrucción. 6)Si el cliente no presenta el documento de compra del¤producto, deberá presentar un documento relacionando el producto, NIT, fecha de compra, la copia del documento de compra se entregara en un plazo de (5) días hábiles. 7)Para la entrega de la garantía, el cliente presentara el¤formato de garantía original, no se entregara el producto con fotocopia del formato o sin el formato de garantía. 8)El periodo de garantía que cubre Digital MTX a los clientes en los productos son: cargadores de caja roja (2)años, cargadores para Mac y universal (1)año, baterías para portátil (1)año, pantallas para computador (6)meses, teclados (6)meses, baterías para celular (3)meses, pantallas para celular (3)meses. Importante: Al firmar y/o recibir el documento de compra que certifique el despacho correspondiente queda entendido que el cliente acepta incondicionalmente la¤presente política y condiciones de garantía, renuncia a cualquier tipo de reclamo que no esté considerado en el presente documento. Más información de políticas de garantías en nuestro sitio web https://www.digitalmtx.com o realice sus consultas y/o reclamos en el correo electrónico centrodeservicio@digitalmtx.com"</small> <br><br><br><br>
               <p style="text-align:center;">Original</p>  
            <img src="http://imgfz.com/i/pCPXAou.jpeg" width="10"> __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __
          <!-- partial -->
          <br><br>
          <div style="width: 880px;">
          <table CELLSPACING=1 CELLPADDING=4 style="border-collapse: collapse; font-size: 8px; line-height: .75; font-family: sans-serif; position: relative;">
                <tr>
                  <td VALIGN="TOP" COLSPAN=4 HEIGHT=20>
                    <img src="http://imgfz.com/i/I1qms2R.png" alt="" width="70px">
                    <div style="display: inline-block; margin-left: 320px;">
                      <p>Fecha de impresion: '.$dates[0]->Fecha_ingreso.'  Hora impresion: '.$hora_actual.'</p>
                    </div>
                    <hr>
                    <p style="font-size:12px; text-align: center; margin-top: 20px;"><b>Comprobante de Garantia:'.$dates[0]->No_garantia.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36>
                    <P><b>Numero Factura:</b>'.$dates[0]->Numero_Factura.'</p><br>
                    <p><b>Punto Venta:</b>'.$dates[0]->Punto_Venta.'</p><br>
                    <p><b>Nombre:</b>'.$dates[0]->Nombre_Cliente.'</p><br>
                    <p><b>Identificación:</b> '.$dates[0]->Identificacion_Cliente.'</p><br>
                    
                    <p><b>Direccion:</b> '.$dates[0]->Direccion_Cliente.'</p><br>
                    <p><b>Correo:</b> '.$dates[0]->Correo_Cliente.'</p><br>
                  </td>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                    <p><b>Departamento:</b> '.$dates[0]->Departamento.'</p><br>
                    <p><b>Municipio:</b> '.$dates[0]->Municipio.'</p><br>
                    <p><b>Numero Guia:</b> '.$dates[0]->No_Guia.'</p><br>
                    <p><b>Valor del flete:</b> '.$dates[0]->Valor_Flete.'</p><br>
                    <p><b>Transportadora:</b> '.$dates[0]->Transportadora.'</p><br>
                  </td>
                </tr>
              </table>
              
              <p style="font-size: 12px; text-align: left;"><b><i><u>Productos</u></i></b></p>
              <table border style="border: 1px solid black; font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px;">
                <tr>
                <th>Referencia</th>
                <th>Cantidad</th>
                  <th>Descripcion</th>
                  <th>Marca</th>
                  <th>Sello</th>
                </tr>';
                foreach ($dates as $producte){ 
               $html .= '<tr>
                          <td>'.$producte->Referencia.'</td><br>
                          <td>'.$producte->Cantidad.'</td><br>
                          <td>'.$producte->Descripcion_Producto.'</td><br>
                          <td>'.$producte->Marca_Producto.'</td><br>
                          <td>'.$producte->Sello_Producto.'</td><br>
                        </tr>';
                }
              $html .= '</table><br>
              <div style="display: flex; justify-content: space-between; text-align: left; font-size: 10px;">
                <div>
                  <div style="display:table; margin:auto; text-align:left;">
                    <p><b>Observacion Garantia:</b> '.$dates[0]->Observacion_Empleado.'</p><br>
                  </div>
               <small style="font-size: 6px; justify-content: center;">"Garantía: El horario de atención es de lunes a viernes de 09:00 a 13:00 en la calle 77 # 16A – 38 Oficina 303¤2)Para el ingreso del producto a garantía el cliente deberá entregar el documento de compra y el producto completo con sus empaques, accesorios, manuales, sin daños físicos que invaliden la garantía. 3)El periodo para dar¤solución a la garantía es de (8) ocho días hábiles, a partir de la fecha de radicado. 4)La Garantía no cubre en los siguientes casos: • Cuando el producto presenta daño físico, por mal uso, mala manipulación, transporte o¤descuido. • Cuando los sellos de garantía se encuentren removidos o sobre etiquetados remarcados. • Daños causados por descargas eléctricas o uso de voltaje incorrecto. • Daños generados por¤presencia de elementos nocivos que no forman parte del producto. • Si el cliente ha cambiado el software original de fábrica. 5)Toda garantía que no¤se reclame en (1) mes a partir de la fecha de ingreso, se hará un cobro de bodegaje, transcurrido los (6) meses será declarada en abandono y se procederá a su destrucción. 6)Si el cliente no presenta el documento de compra del¤producto, deberá presentar un documento relacionando el producto, NIT, fecha de compra, la copia del documento de compra se entregara en un plazo de (5) días hábiles. 7)Para la entrega de la garantía, el cliente presentara el¤formato de garantía original, no se entregara el producto con fotocopia del formato o sin el formato de garantía. 8)El periodo de garantía que cubre Digital MTX a los clientes en los productos son: cargadores de caja roja (2)años, cargadores para Mac y universal (1)año, baterías para portátil (1)año, pantallas para computador (6)meses, teclados (6)meses, baterías para celular (3)meses, pantallas para celular (3)meses. Importante: Al firmar y/o recibir el documento de compra que certifique el despacho correspondiente queda entendido que el cliente acepta incondicionalmente la¤presente política y condiciones de garantía, renuncia a cualquier tipo de reclamo que no esté considerado en el presente documento. Más información de políticas de garantías en nuestro sitio web https://www.digitalmtx.com o realice sus consultas y/o reclamos en el correo electrónico centrodeservicio@digitalmtx.com"</small> <br><br><br><br>
               <p style="text-align:center;">Copia</p>

                   
          </body>
          </html>
          ';
          $mpdf->WriteHTML($html);
        // }
        $mpdf->Output();
      }
    }else{
      header('Location: ?controller=login');
    } 
  }

  public function ticket()
  {
    if (isset($_SESSION['user'])) {
      if (isset($_REQUEST['id'])) {
        // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8' , 'format' => [44, 60]]);
        $id = $_REQUEST['id'];
        $data = $this->model->getByIdG($id);

        $nombre_impresora = "POS"; 
        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector);
        #Mando un numero de respuesta para saber que se conecto correctamente.
        echo 1;
        /*
          Ahora vamos a imprimir un encabezado
        */
          $html = '';
        foreach ($data as $product) {
          $html = '';
          $html .= '<!DOCTYPE html>
          <html lang="es">
          <head>
            <title>Ticket</title>
            <style>
              div.a {
                line-height: normal;
              }
            </style>
          </head>
          <body>
            <div class="a">
              <p style="font-size: 12px; font-weight: bold;">'.$product->No_garantia.'</p>  
              <p style="font-size: 4px;">'.$product->Fecha_ingreso.'&nbsp;&nbsp;&nbsp;'.$product->Referencia.'</p>
            </div>    
          </body>
          </html>
          ';
          $printer->text($html);
           /*Alimentamos el papel 3 veces*/
          $printer->feed(3);

          /*
            Cortamos el papel. Si nuestra impresora
            no tiene soporte para ello, no generará
            ningún error
          */
          $printer->cut();

          /*
            Por medio de la impresora mandamos un pulso.
            Esto es útil cuando la tenemos conectada
            por ejemplo a un cajón
          */
          $printer->pulse();
        }

        /*
          Para imprimir realmente, tenemos que "cerrar"
          la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
        */
        $printer->close();
        // $html = '';
        // foreach ($data as $product) {
        //   $html = '';
        //   $html .= '<!DOCTYPE html>
        //   <html lang="es">
        //   <head>
        //     <title>Ticket</title>
        //     <style>
        //       div.a {
        //         line-height: normal;
        //       }
        //     </style>
        //   </head>
        //   <body>
        //     <div class="a">
        //       <p style="font-size: 12px; font-weight: bold;">'.$product->No_garantia.'</p>  
        //       <p style="font-size: 4px;">'.$product->Fecha_ingreso.'&nbsp;&nbsp;&nbsp;'.$product->Referencia.'</p>
        //     </div>    
        //   </body>
        //   </html>
        //   ';
        //   $mpdf->AddPage('L');
        //   $mpdf->WriteHTML($html);
        // }
        // $mpdf->Output();
      }
    }else{
      header('Location: ?controller=login');
    }
  }

  public function options()
  {
    if (isset($_SESSION['user'])) {
      if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $data = $this->model->getOptions($id);
        require 'Views/Layout.php';
        require 'Views/Garanty/options.php';
        require 'Views/Scripts.php';
      }
    }else{
      header('Location: ?controller=login');
    }
  }

  public function solutionPre()
  {
    if (isset($_SESSION['user'])) {
      require 'Views/Layout.php';
      $garanties = $this->model->getAllSolutionPre();
      require 'Views/Garanty/solutionPre.php';
      require 'Views/Scripts.php';
    }else{
      header('Location: ?controller=login');
    }
  }

  public function optionsEnds() 
  {
    if (isset($_SESSION['user'])) {
      if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $data = $this->model->getFinalyStatus($id);
         require 'Views/Layout.php';
         require 'Views/Garanty/solutionEndNew.php';
         require 'Views/Scripts.php';
      }
    }else{
      header('Location: ?controller=login');
    }
  }

  public function solutionTechnical() 
  {
    if (isset($_SESSION['user'])) {
      require 'Views/Layout.php';
      $garanties = $this->model->getAllSolution(); 
      require 'Views/Garanty/solution.php';
      require 'Views/Scripts.php'; 
    }else{
      header('Location: ?controller=login');
    }
  }

  public function saveEndDelivery()
  {
    if (isset($_SESSION['user'])) {
      if ($_POST) {
        date_default_timezone_set('America/Bogota');
        $hora_actual = date("h:i a");
        if ($_POST['Estado'] == 'Entregado para cambio de producto') {
          $dataS = [
            'id' => $_POST['id'],
            'Estado' => $_POST['Estado'],
            'Sello_Producto' => $_POST['Sello_Producto']
          ];
        }elseif($_POST['Estado'] == 'Entregado para nota credito'){
          $dataS = [
            'id' => $_POST['id'],
            'Estado' => $_POST['Estado'],
            'Observacion_Final' => $_POST['Observacion_Final']
          ];
        }else{
          $dataS = [
          'id' => $_POST['id'],
          'Estado' => $_POST['Estado']
          ];
        }
        $this->technical->editStatus($dataS);

        $data = $this->model->getByIdEnd($_POST['id']);
        $consultId = $this->bill->getBill($data[0]->Numero_Factura);
        
        if ($_POST['Estado'] == 'Entregado para cambio de producto') {
          $dateUpdate = [
            'id' => $consultId[0]->id,
            'fecha_factura' => $_POST['fecha_factura'],
            'Descripcion_Comentarios' => $_POST['Sello_Producto']
          ];
          $this->bill->updateBill($dateUpdate);
        }
        $mail = new PHPMailer(true);
        try 
        {
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
          $mail->addAddress($data[0]->Correo_Cliente);     // Add a recipient

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
                    Proceso de la Garantia 
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
          
          
                    Su actual estado de la garantia se encuentra en '.$data[0]->Estado .'<br><br>
                    
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
          header('Location: ?controller=garanty&method=solutionPre');
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }
    }else{
      header('Location: ?controller=login');
    }
  }

  public function saveEndGaranty()
  {
    if (isset($_SESSION['user'])) {
      if (isset($_POST)) {
        if (preg_match('/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ.,; ]+$/', $_POST['Observacion_Final'])) {

          $this->model->saveGarantyEnd($_POST);
          $data = $this->model->getByIdEnd($_POST['id']);
          $mail = new PHPMailer(true);
          try 
          {
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
            $mail->addAddress($data[0]->Correo_Cliente);     // Add a recipient

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
                            <p>Hola que tal: Su proceso de garantia fue: ' . $data[0]->Estado . '</p><br>
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
            header('Location: ?controller=garanty&method=solutionTechnical');
          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
        }else{
          header('Location: ?controller=garanty&method=failed');
        }
      }else {
        echo "No se realizo la modificacion";
      }
    }else{
      header('Location: ?controller=login');
    }
  }

  public function excelComplete()
  {          
    $timestamp = time();
    $filename = 'Garantias_' . $timestamp . '.xls';
    
    header("Pragma: public");
    header("Expires: 0");
    header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    
    $isPrintHeader = false;
    $productResult = $this->model->getComplete();
    
      if ( !$isPrintHeader ) {
        $html = '<table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>No_Garantia</th>
                        <th>Fecha_ingreso</th>
                        <th>Hora_ingreso</th>
                        <th>Numero_Factura</th>
                        <th>Punto_Venta</th>
                        <th>Fecha_Compra</th>
                        <th>Nombre_Cliente</th>
                        <th>Identificacion_Cliente</th>
                        <th>Correo_Cliente</th>
                        <th>Direccion_Cliente</th>
                        <th>Flete</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th>Valor_Flete</th>
                        <th>No_Guia</th>
                        <th>Transportadora</th>
                        <th>Observacion_Empleado</th>
                        <th>Empleado</th>
                        <th>Codigo_Producto</th>
                        <th>Descripcion_Producto</th>
                        <th>Marca_Producto</th>
                        <th>Sello_Producto</th>
                        <th>Referencia</th>
                        <th>Cantidad_Producto</th>
                        <th>Codigo_Proveedor</th>
                        <th>Nombre del proveedor</th>
                        <th>Observacion_Cliente</th>
                        <th>Estado</th>
                        <th>Observacion_Final</th>
                        <th>Aprobacion_Garantia</th>
                        <th>Observacion_Tecnico</th>
                        <th>Fecha_anexo_Tecnico</th>
                        <th>Hora_Anexo_Tecnico</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($productResult as $garanty) {
                  $html .= '<tr>
                    <td>'.$garanty->id.'</td>
                    <td>'.$garanty->No_garantia.'</td>
                    <td>'.$garanty->Fecha_ingreso.'</td>
                    <td>'.$garanty->Hora_ingreso.'</td>
                    <td>'.$garanty->Numero_Factura.'</td>
                    <td>'.$garanty->Punto_Venta.'</td>
                    <td>'.$garanty->Fecha_Compra.'</td>
                    <td>'.$garanty->Nombre_Cliente.'</td>
                    <td>'.$garanty->Identificacion_Cliente.'</td>
                    <td>'.$garanty->Correo_Cliente.'</td>
                    <td>'.$garanty->Direccion_Cliente.'</td>
                    <td>'.$garanty->Flete.'</td>
                    <td>'.$garanty->Departamento.'</td>
                    <td>'.$garanty->Municipio.'</td>
                    <td>'.$garanty->Valor_Flete.'</td>
                    <td>'.$garanty->No_Guia.'</td>
                    <td>'.$garanty->Transportadora.'</td>
                    <td>'.$garanty->Observacion_Empleado.'</td>
                    <td>'.$garanty->Empleado.'</td>
                    <td>'.$garanty->Codigo_Producto.'</td>
                    <td>'.$garanty->Descripcion_Producto.'</td>
                    <td>'.$garanty->Marca_Producto.'</td>
                    <td>'.$garanty->Sello_Producto.'</td>
                    <td>'.$garanty->Referencia.'</td>
                    <td>'.$garanty->Cantidad_Producto.'</td>
                    <td>'.$garanty->Codigo_Proveedor.'</td>
                    <td>'.$garanty->Nombre_Proveedor.'</td>
                    <td>'.$garanty->Observacion_Cliente.'</td>
                    <td>'.$garanty->Estado.'</td>
                    <td>'.$garanty->Observacion_Final.'</td>
                    <td>'.$garanty->Aprobacion_Garantia.'</td>
                    <td>'.$garanty->Observacion_tecnico.'</td>
                    <td>'.$garanty->Fecha_anexo_Tecnico.'</td>
                    <td>'.$garanty->Hora_Anexo_Tecnico.'</td>
                  </tr>';
                }  
                $html .= '</tbody>
            </table>';
        echo $html;    
        $isPrintHeader = true;
      }
    exit();
  }

  public function storyGaranties()
  {
    if (isset($_SESSION['user'])) {
      require 'Views/Layout.php';
      $garanties = $this->model->getAllSolutionPre();
      require 'Views/Garanty/storyGaranty.php';
      require 'Views/Scripts.php';
    }else{
      header('Location: ?controller=login');
    }
  }

  public function details()
  {
    if (isset($_SESSION['user'])) {
      if ($_POST['id']) {
        $id = $_REQUEST['id'];
        $data = $this->model->getByIdEnd($id);
        $consecutives = $this->technical->consecutives($id); 
        require 'Views/Layout.php';
        require 'Views/Garanty/detailsGaranty.php';
        require 'Views/Scripts.php';
      }
    }else{
      header('Location: ?controller=login');
    }
  }
}
