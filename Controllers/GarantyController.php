<?php

require 'Models/Garanty.php'; 
require 'Models/Client.php';
require 'Models/Product.php';
require 'Models/Provider.php';
require 'Models/Departament.php';
require 'Models/Municipality.php';
require 'Models/Technical.php';


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
  private $technical;

  public function __construct()
  {
    $this->model = new Garanty;
    $this->client = new Client;
    $this->product = new Product;
    $this->provider = new Provider;
    $this->departament = new Departament;
    $this->municipality = new Municipality;
    $this->technical = new Technical;
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
      $Aprobacion_Garantia = isset($_POST['Aprobacion_Garantia']) ? $_POST['Aprobacion_Garantia'] : '';
      $Aprobacion_GarantiaN = isset($_POST['Aprobacion_GarantiaN']) ? $_POST['Aprobacion_GarantiaN'] : '';
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
        if (!empty($Aprobacion_Garantia)) {
          $item9 = current($Aprobacion_Garantia);
        }
        if (!empty($Aprobacion_GarantiaN)) {
          $item10 = current($Aprobacion_GarantiaN);
        }
        $item11 = current($Estado);

        $cp = (($item1 !== false) ? $item1 : '');
        $dp = (($item2 !== false) ? $item2 : '');
        $mp = (($item3 !== false) ? $item3 : '');
        $sp = (($item4 !== false) ? $item4 : '');
        $cpro = (($item5 !== false) ? $item5 : '');
        $canPro = (($item6 !== false) ? $item6 : '');
        $rp = (($item7 !== false) ? $item7: '');
        $op = (($item8 !== false) ? $item8 : '');
        $ag = (($item9 !== false) ? $item9 : '');
        $agN = (($item10 !== false) ? $item10 : '');
        $es = (($item11 !== false) ? $item11 : '');

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
          'Aprobacion_Garantia' => $ag,
          'Estado' => $es
        ];

        //----Aqui va la validacion de rango de fechas
        if ($fecha_actual >= $fecha_factura && $fecha_actual <= $fecha_proxima) {
          if (isset($lastId[0]->id) && $answerNewGaranty == true && $ag === 'SI') {
            $this->model->saveDetail($detaills);
            if(isset($lastId[0]->id) && $answerNewGaranty == true && $agN === 'NO') {
              $detaills['Estado'] = "Cerrado";
              $detaills['Aprobacion_Garantia'] = 'NO';
              $this->model->saveDetail($detaills);
            }
          }else{
            echo '<script>
            alert("La garantia se registro, pero no se selecciono un producto");
            window.location = "?controller=garanty&method=listGaranty";
            </script>';
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
        if (!empty($Aprobacion_Garantia)) {
          $item9 = next($Aprobacion_Garantia);
        }
        if (!empty($Aprobacion_GarantiaN)) {
          $item10 = next($Aprobacion_GarantiaN);
        }
        $item11 = next($Estado);
        // Check terminator
        if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false) break;
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
          $mail->Body    = '
          <!DOCTYPE html>
          <html lang="en" >
          <head>
            <meta charset="UTF-8">
            <title>CodePen - Responsive Email Template</title>
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
                        <a href="https://www.digitalmtx.com/"><img class="top-image" src="http://imgfz.com/i/I1qms2R.png" style="line-height:100;width: 100px;" alt="Tenable Network Security"></a>
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
                              Estimado Usuario:'.$data['Nombre_Cliente'].'
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
            
          
                              Su actual estado de la garantia se encuentra en '.$dates[0]->Estado .'<br><br>
                              y en la cual se evidencia por que no se aprobo la garantia '.$data['Observacion_Empleado'] .'<br><br>
                              
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
                                      <a style="color:  #F44336;" href="#">DigitalMTX@email.com</a>
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
                      <p>Fecha de impresion: '.$dates[0]->Fecha_ingreso.'</p>
                    </div>
                    <hr>
                    <p Estim
                    <p style="font-size:12px; text-align: center; margin-top: 20px;"><b>Comprobante de Garantia:'.$dates[0]->No_garantia.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36>
                    <P><b>Numero Factura:</b>'.$dates[0]->Numero_Factura.'</p>
                    <p><b>Punto Venta</b>'.$dates[0]->Punto_Venta.'</p>
                    <p><b>Nombre</b>'.$dates[0]->Nombre_Cliente.'</p>
                    <p><b>Identificacion</b> '.$dates[0]->Identificacion_Cliente.'</p>
                    <p><b>Numero Guia</b> '.$dates[0]->No_Guia.'</p>
                  </td>
                  <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                    <p><b>Correo:</b> '.$dates[0]->Correo_Cliente.'</p>
                    <p><b>Direccion:</b> '.$dates[0]->Direccion_Cliente.'</p>
                    <p><b>Departamento:</b> '.$dates[0]->Departamento.'</p>
                    <p><b>Municipio:</b> '.$dates[0]->Municipio.'</p>
                    <p><b>Valor_Flete:</b> '.$dates[0]->Valor_Flete.'</p>
                    <p><b>Transportadora:</b> '.$dates[0]->Transportadora.'</p>
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
                  <td>'.$producte->Codigo_Producto.'</td>
                  <td>'.$producte->Descripcion_Producto.'</td>
                  <td>'.$producte->Marca_Producto.'</td>
                  <td>'.$producte->Sello_Producto.'</td>
                  <td>'.$producte->Referencia.'</td>
                </tr>';
                }
              $html .= '</table><br>


            

              <div style="display: flex; justify-content: space-between; text-align: left; font-size: 10px;">
                <div>
                  <div style="display:table; margin:auto; text-align:left;">
                    <p><b>Observacion Garantia:</b> '.$dates[0]->Observacion_Empleado.'</p>
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
                  <p>Fecha de impresion: '.$dates[0]->Fecha_ingreso.'</p>
                </div>
                <hr>
                <p style="font-size:12px; text-align: center; margin-top: 20px;"><b>Comprobante de Garantia:'.$dates[0]->No_garantia.'</b></p>
              </td>
            </tr>
            <tr>
              <td WIDTH="45%" VALIGN="TOP" HEIGHT=36>
                <P><b>Numero Factura:</b>'.$dates[0]->Numero_Factura.'</p>
                <p><b>Punto Venta</b>'.$dates[0]->Punto_Venta.'</p>
                <p><b>Nombre</b>'.$dates[0]->Nombre_Cliente.'</p>
                <p><b>Identificacion</b> '.$dates[0]->Identificacion_Cliente.'</p>
                <p><b>Numero Guia</b> '.$dates[0]->No_Guia.'</p>
              </td>
              <td WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="padding-left: 60px;">
                <p><b>Correo:</b> '.$dates[0]->Correo_Cliente.'</p>
                <p><b>Direccion:</b> '.$dates[0]->Direccion_Cliente.'</p>
                <p><b>Departamento:</b> '.$dates[0]->Departamento.'</p>
                <p><b>Municipio:</b> '.$dates[0]->Municipio.'</p>
                <p><b>Valor_Flete:</b> '.$dates[0]->Valor_Flete.'</p>
                <p><b>Transportadora:</b> '.$dates[0]->Transportadora.'</p>
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
              <td>'.$producte->Codigo_Producto.'</td>
              <td>'.$producte->Descripcion_Producto.'</td>
              <td>'.$producte->Marca_Producto.'</td>
              <td>'.$producte->Sello_Producto.'</td>
              <td>'.$producte->Referencia.'</td>
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
  	      $mail->Body    = '
          <!DOCTYPE html>
          <html lang="en" >
          <head>
            <meta charset="UTF-8">
            <title>CodePen - Responsive Email Template</title>
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
                        <a href="https://www.digitalmtx.com/"><img class="top-image" src="http://imgfz.com/i/I1qms2R.png" style="line-height:100;width: 100px;" alt="Tenable Network Security"></a>
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
                              Estimado Usuario:'.$data[0]->Nombre_Cliente.'
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
            
          
                              El estado de su garantia se encuentra en '.$data[0]->Estado.'.<br><br>
                              
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
                                      <a style="color:  #F44336;" href="#">DigitalMTX@email.com</a>
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
  	      header('Location: ?controller=garanty&method=solutionTechnical');
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

  public function saveEndDelivery()
  {
    if (isset($_SESSION['user'])) {
      if ($_POST) {
        $this->technical->editStatus($_POST);
        header('Location: ?controller=garanty&method=solutionPre');
      }
    }else{
      header('Location: ?controller=login');
    }
  }

}
