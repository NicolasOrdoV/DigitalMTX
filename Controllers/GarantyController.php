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
        $bill = $_POST['NumFactura'];
        $search = $this->model->getBill($bill);
        $bills = $this->model->getByNumBill($search[0]->Numero_Factura);
        $dataF = $this->model->getAllF($bill);
        $fac1 = isset($dataF[0]->Numero_Factura) ? $dataF[0]->Numero_Factura : 'null';
        $fac2 = $bills[0]->Numero_Factura;
        if ($bills == null) {
          header('Location: ?controller=garanty&method=failed');
        }elseif ($fac1 === $fac2) {
          header('Location: ?controller=garanty&method=failed');
        }elseif($fac1 !== $fac2){
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
      $data = [
        'No_garantia' => $_POST['No_garantia'],
        'Fecha_ingreso' => $_POST['Fecha_ingreso'],
        'Hora_ingreso' => $_POST['Hora_ingreso'],
        'Numero_Factura' => $_POST['Numero_Factura'],
        'Punto_Venta' => $_POST['Punto_Venta'],
        'Fecha_Compra' => $_POST['Fecha_Compra'],
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

      //-------------------------//
      $fecha_factura = $_POST['fecha_factura'];
      $parts = explode("-", $fecha_factura);
      $fecha_actual = $_POST['Fecha_ingreso'];
      //echo $fecha_actual;
      //var_dump($parts);
      $year = date($parts[0]);
      $afterYear = $year+1;
      $fecha_proxima = date($afterYear.'-'.$parts[1].'-'.$parts[2]);
      //echo $fecha_proxima;
      //-------------------------//

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

        
        $detaills = [
          'Codigo_Producto' => $cp,
          'Descripcion_Producto' => $dp,
          'Marca_Producto' => $mp,
          'Sello_Producto' => $sp,
          'Referencia' => $rp,
          'Cantidad_Producto' => $canPro,
          'Codigo_Proveedor' => $cpro,
          'Id_Garantia' => $lastId[0]->id,
          'Observacion_Cliente' => $op,
          'Estado' => $es,
          'Aprobacion_Garantia' => $ag
        ];
        
        

        //var_dump($detaillsN);
        //$detaills['Aprobacion_Garantia'] = $agN;
        //echo '<hr>';
        //var_dump($detaills);

        //----Aqui va la validacion de rango de fechas
        if ($fecha_actual >= $fecha_factura && $fecha_actual <= $fecha_proxima) {
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
        // Check terminator
        if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false && $item8 === false && $item10 === false) break;
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
          $mail->Password   = '1000464327bat';                               // SMTP password
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
            <title>CodePen - PDF Factura Ecuador</title>
            

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
                    <P><b>Numero Factura:</b>'.$data['Numero_Factura'].'</p>
                    <p><b>Punto Venta</b>'.$data['Punto_Venta'].'</p>
                    <p><b>Nombre</b>'.$data['Nombre_Cliente'].'</p>
                    <p><b>Identificacion</b> '.$data['Identificacion_Cliente'].'</p>
                    <p><b>Numero Guia</b> '.$data['No_Guia'].'</p>
                  </td>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                    <p><b>Correo:</b> '.$data['Correo_Cliente'].'</p>
                    <p><b>Direccion:</b> '.$data['Direccion_Cliente'].'</p>
                    <p><b>Valor_Flete:</b> '.$data['Valor_Flete'].'</p>
                    <p><b>Transportadora:</b> '.$data['Transportadora'].'</p>
                  </td>
                </tr>
              </table>

              <p style="font-size: 12px; text-align: left;"><b><i><u>Productos</u></i></b></p>
              <table border style="border: 1px solid black; font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px;">
                <tr>
                  <th>Codigo Producto</th>
                  <th>Descripcion Producto</th>
                  <th>Marca Producto</th>
                  <th>Referencia Producto</th>
                </tr>';
                foreach ($datas as $product) {
                $html .= '<tr>
                  <td>'.$product->Codigo_Producto.'</td>
                  <td>'.$product->Descripcion_Producto.'</td>
                  <td>'.$product->Marca_Producto.'</td>
                  <td>'.$product->Referencia.'</td>
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
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5']);
        $id = $_REQUEST['id'];
        $dates = $this->model->getById($id);
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
                      <p>Fecha de impresion: '.$dates[0]->Fecha_ingreso.'</p>
                    </div>
                    <hr>
                    <p style="font-size:12px; text-align: center; margin-top: 20px;"><b>Comprobante de Garantia:'.$dates[0]->No_garantia.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36>
                    <P><b>Numero Factura:</b>'.$dates[0]->Numero_Factura.'</p><br>
                    <p><b>Punto Venta</b>'.$dates[0]->Punto_Venta.'</p><br>
                    <p><b>Nombre</b>'.$dates[0]->Nombre_Cliente.'</p><br>
                    <p><b>Identificacion</b> '.$dates[0]->Identificacion_Cliente.'</p><br>
                    <p><b>Numero Guia</b> '.$dates[0]->No_Guia.'</p><br>
                  </td>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                    <p><b>Correo:</b> '.$dates[0]->Correo_Cliente.'</p><br>
                    <p><b>Direccion:</b> '.$dates[0]->Direccion_Cliente.'</p><br>
                    <p><b>Proveedor:</b> '.$dates[0]->Proveedor.'</p><br>
                    <p><b>Departamento:</b> '.$dates[0]->Departamento.'</p><br>
                    <p><b>Municipio:</b> '.$dates[0]->Municipio.'</p><br>
                    <p><b>Valor_Flete:</b> '.$dates[0]->Valor_Flete.'</p><br>
                    <p><b>Transportadora:</b> '.$dates[0]->Transportadora.'</p><br>
                  </td>
                </tr>
              </table>

              <p style="font-size: 12px; text-align: left;"><b><i><u>Productos</u></i></b></p>
              <table border style="border: 1px solid black; font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px;">
                <tr>
                  <th>Codigo Producto</th>
                  <th>Descripcion Producto</th>
                  <th>Marca Producto</th>
                  <th>Sello Producto</th>
                  <th>Referencia Producto</th>
                </tr>';
                foreach ($dates as $producte){ 
               $html .= '<tr>
                  <td>'.$producte->Codigo_Producto.'</td><br>
                  <td>'.$producte->Descripcion_Producto.'</td><br>
                  <td>'.$producte->Marca_Producto.'</td><br>
                  <td>'.$producte->Sello_Producto.'</td><br>
                  <td>'.$producte->Referencia.'</td><br>
                </tr>';
                }
              $html .= '</table><br>


            

              <div style="display: flex; justify-content: space-between; text-align: left; font-size: 10px;">
                <div>
                  <div style="display:table; margin:auto; text-align:left;">
                    <p><b>Observacion Garantia:</b> '.$dates[0]->Observacion_Empleado.'</p><br>
                  </div>
            --------------------------------------------------------------------------------------------------------------------------------------------------
          <!-- partial -->
          <div style="width: 580px;">
          <table CELLSPACING=1 CELLPADDING=4 style="border-collapse: collapse; font-size: 8px; line-height: .75; font-family: sans-serif; position: relative;">
            <tr>
              <td VALIGN="TOP" COLSPAN=4 HEIGHT=20>
                <img src="http://imgfz.com/i/I1qms2R.png" alt="" width="70px">
                <div style="display: inline-block; margin-left: 320px;">
                  <p style="font-weight: bold;">Digital MTX</p>
                  <p>Fecha de impresion: '.$dates[0]->Fecha_ingreso.'</p><br>
                </div>
                <hr>
                <p style="font-size:12px; text-align: center; margin-top: 20px;"><b>Comprobante de Garantia:'.$dates[0]->No_garantia.'</b></p><br>
              </td>
            </tr>
            <tr>
              <td WIDTH="45%" VALIGN="TOP" HEIGHT=36>
                <P><b>Numero Factura:</b>'.$dates[0]->Numero_Factura.'</p><br>
                <p><b>Punto Venta</b>'.$dates[0]->Punto_Venta.'</p><br>
                <p><b>Nombre</b>'.$dates[0]->Nombre_Cliente.'</p><br>
                <p><b>Identificacion</b> '.$dates[0]->Identificacion_Cliente.'</p><br>
                <p><b>Numero Guia</b> '.$dates[0]->No_Guia.'</p><br>
              </td>
              <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                <p><b>Correo:</b> '.$dates[0]->Correo_Cliente.'</p><br>
                <p><b>Direccion:</b> '.$dates[0]->Direccion_Cliente.'</p><br>
                <p><b>Proveedor:</b> '.$dates[0]->Proveedor.'</p><br>
                <p><b>Departamento:</b> '.$dates[0]->Departamento.'</p><br>
                <p><b>Municipio:</b> '.$dates[0]->Municipio.'</p><br>
                <p><b>Valor_Flete:</b> '.$dates[0]->Valor_Flete.'</p><br>
                <p><b>Transportadora:</b> '.$dates[0]->Transportadora.'</p><br>
              </td>
            </tr>
          </table>

          <p style="font-size: 12px; text-align: left;"><b><i><u>Productos</u></i></b></p>
          <table border style="border: 1px solid black; font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px;">
            <tr>
              <th>Codigo Producto</th>
              <th>Descripcion Producto</th>
              <th>Marca Producto</th>
              <th>Sello Producto</th>
              <th>Referencia Producto</th>
            </tr>';
            foreach ($dates as $producte){ 
           $html .= '<tr>
              <td>'.$producte->Codigo_Producto.'</td><br>
              <td>'.$producte->Descripcion_Producto.'</td><br>
              <td>'.$producte->Marca_Producto.'</td><br>
              <td>'.$producte->Sello_Producto.'</td><br>
              <td>'.$producte->Referencia.'</td><br>
            </tr>';
            }
          $html .= '</table><br>


        

          <div style="display: flex; justify-content: space-between; text-align: left; font-size: 10px;">
            <div>
              <div style="display:table; margin:auto; text-align:left;">
                <p><b>Observacion Garantia:</b> '.$dates[0]->Observacion_Empleado.'</p>
              </div>
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

  public function saveEndGaranty()
  {
    if (isset($_SESSION['user'])) {
      if (isset($_POST)) {
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
  	      $mail->Password   = '1000464327bat';                               // SMTP password
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
  	      header('Location: ?controller=garanty&method=listGaranty');
  	    } catch (Exception $e) {
  	      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  	    }
      }else {
        echo "No se realizo la modificacion";
      }
    }else{
      header('Location: ?controller=login');
    }
  }

  public function ticket()
  {
    if (isset($_SESSION['user'])) {
      if (isset($_REQUEST['id'])) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [100, 180]]);
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
          $html .= '<!DOCTYPE html>
          <html lang="en" >
          <head>
            <meta charset="UTF-8">
            <title>Ticket</title>
            <style type="text/css">

            .cardWrap {
            width: 290px;
            margin: 3em auto;
            color: #fff;
            font-family: sans-serif;
          }

          .card {
            background: linear-gradient(to top, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
            height: 11em;
            float: left;
            position: top;
            padding: 1em;
            margin-top: 90px;
          }

          .cardLeft {
            border-radius: 8px;
            border-bottom-radius: 8px;
            width: 16em;
          }

          .cardRight {
            width: 6.5em;
            border-left: .18em dashed #fff;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
          }
          .cardRight:before, .cardRight:after {
            content: "";
            position: absolute;
            display: block;
            width: .9em;
            height: .9em;
            background: #fff;
            border-radius: 50%;
            left: -.5em;
          }
          .cardRight:before {
            top: -.4em;
          }
          .cardRight:after {
            bottom: -.4em;
          }

          h1 {
            font-size: 1.1em;
            margin-top: 0;
          }
          h1 span {
            font-weight: normal;
          }

          .title, .name, .seat, .time {
            text-transform: uppercase;
            font-weight: normal;
          }
          .title h2, .name h2, .seat h2, .time h2 {
            font-size: .9em;
            color: #525252;
            margin: 0;
          }
          .title span, .name span, .seat span, .time span {
            font-size: .7em;
            color: #a2aeae;
          }

          .title {
            margin: 2em 0 0 0;
          }

          .name, .seat {
            margin: .7em 0 0 0;
          }

          .time {
            margin: .7em 0 0 1em;
          }

          .seat, .time {
            float: left;
          }

          .eye {
            position: relative;
            width: 2em;
            height: 1.5em;
            background: #fff;
            margin: 0 auto;
            border-radius: 1em/0.6em;
            z-index: 1;
          }
          .eye:before, .eye:after {
            content: "";
            display: block;
            position: absolute;
            border-radius: 50%;
          }
          .eye:before {
            width: 1em;
            height: 1em;
            background: #e84c3d;
            z-index: 2;
            left: 8px;
            top: 4px;
          }
          .eye:after {
            width: .5em;
            height: .5em;
            background: #fff;
            z-index: 3;
            left: 12px;
            top: 8px;
          }

          .number {
            text-align: center;
            text-transform: uppercase;
          }
          .number h3 {
            color: #e84c3d;
            margin: .9em 0 0 0;
            font-size: 2.5em;
          }
          .number span {
            display: block;
            color: #a2aeae;
          }
            </style>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

          </head>
          <body>
          <!-- partial:index.partial.html -->
          <div class="cardWrap">
            <div class="card cardLeft">
              <h1>Sticker <span>garantia</span></h1>
              <div class="title">
                <h2>' . $product->Descripcion_Producto . '</h2>
                <span>Descripcion producto</span>
              </div>
              <div class="name">
                <h2>' . $product->Observacion_Cliente . '</h2>
                <span>observacion del cliente</span>
              </div>
              <div class="seat">
                <h2>' . $data[0]->No_garantia . '</h2>
                <span>Numero garantia</span>
              </div>
              <div class="seat">
                <h2>' . $data[0]->Referencia . '</h2>
                <span>Referencia</span>
              </div>
            </div>
          </div>
          <!-- partial -->
            
          </body>
          </html>
          ';
          $mpdf->AddPage('L');
          $mpdf->WriteHTML($html);
        }
        $mpdf->Output();
      }
    }else{
      header('Location: ?controller=login');
    }
  }
}
