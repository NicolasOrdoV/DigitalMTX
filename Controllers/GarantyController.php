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

    $Codigo_Producto = $_POST['Codigo_Producto'];
    $Descripcion_Producto = $_POST['Descripcion_Producto'];
    $Marca_Producto = $_POST['Marca_Producto'];
    $Sello_Producto = $_POST['Sello_Producto'];
    $Referencia = $_POST['Referencia'];
    $Observacion_Cliente = ($_POST['Observacion_Cliente']);
    $Aprobacion_Garantia = isset($_POST['Aprobacion_Garantia']) ? $_POST['Aprobacion_Garantia'] : '';
    $Aprobacion_GarantiaN = isset($_POST['Aprobacion_GarantiaN']) ? $_POST['Aprobacion_GarantiaN'] : '';
    $Estado = ($_POST['Estado']);

    while (true) {
      $item1 = current($Codigo_Producto);
      $item2 = current($Descripcion_Producto);
      $item3 = current($Marca_Producto);
      $item4 = current($Sello_Producto);
      $item5 = current($Referencia);
      $item6 = current($Observacion_Cliente);
      if (!empty($Aprobacion_Garantia)) {
        $item7 = current($Aprobacion_Garantia);
      }
      if (!empty($Aprobacion_GarantiaN)) {
        $item8 = current($Aprobacion_GarantiaN);
      }
      $item9 = current($Estado);

      $cp = (($item1 !== false) ? $item1 : '');
      $dp = (($item2 !== false) ? $item2 : '');
      $mp = (($item3 !== false) ? $item3 : '');
      $sp = (($item4 !== false) ? $item4 : '');
      $rp = (($item5 !== false) ? $item5 : '');
      $op = (($item6 !== false) ? $item6 : '');
      $ag = (($item7 !== false) ? $item7 : '');
      $agN = (($item8 !== false) ? $item8 : '');
      $es = (($item9 !== false) ? $item9 : '');

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
        $this->model->saveDetail($detaills);
      } else {
        $detaills['Estado'] = "Cerrado";
        $detaills['Aprobacion_Garantia'] = 'NO';
        $this->model->saveDetail($detaills);
      }

      // Up! Next Value
      $item1 = next($Codigo_Producto);
      $item2 = next($Descripcion_Producto);
      $item3 = next($Marca_Producto);
      $item4 = next($Sello_Producto);
      $item5 = next($Referencia);
      $item6 = next($Observacion_Cliente);
      if (!empty($Aprobacion_Garantia)) {
        $item7 = next($Aprobacion_Garantia);
      }
      if (!empty($Aprobacion_GarantiaN)) {
        $item8 = next($Aprobacion_GarantiaN);
      }
      $item9 = next($Estado);
      // Check terminator
      if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item9 === false) break;
    }
    $dates = $this->model->getAlDetails($lastId[0]->id);
    if ($dates[0]->Estado == 'Tramite') {
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
  }

  public function sucessfull()
  {
    require 'Views/Layout.php';
    require 'Views/Garanty/succesfull.php';
    require 'Views/Scripts.php';
  }

  public function consecutive()
  {
    if (isset($_REQUEST['id'])) {
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [130, 120]]);
      $id = $_REQUEST['id'];
      $data = $this->model->getById($id);

      /*foreach ($data as $product) {
        echo $product->Descripcion_Producto.'<br>';
      }*/
      //$productos = [];
      foreach ($data as $product) {
        $html = '';
        $html .= '
        <!DOCTYPE html>
        <html lang="en" >
        <head>
          <meta charset="UTF-8">
          <title>Garantía Digital MTX </title>
          <style  type="text/css">
          html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        
        body {
            width: 100%;
            font-size: 12px;
        }
        
        
        /* HTML5 display-role reset for older browsers */
        
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }
        
        body {
            line-height: 1;
        }
        
        div.header {
            padding-top: 140px;
        }
        
        ol,
        ul {
            list-style: none;
        }
        
        blockquote,
        q {
            quotes: none;
        }
        
        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: "";
            content: none;
        }
        
        table {
            border-spacing: 0;
        }
        
        
        /*Clearrrr*/
        
        img {
            opacity: 0.5;
            filter: alpha(opacity=50);
            width: 40%;
            height: auto;
        }
        
        html {
            font-family: "Gill Sans", "Gill Sans MT", Calibri, sans-serif
        }
        
        table#signature {
            width: 50%
        }
        
        body table,
        th,
        td {
            padding: 3px;
        }
        
        
        /*Tamaño de encabezado*/
        
        table#header {
            border-collapse: collapse;
            width: 50%;
        }
        
        
        /*Estilo tabla con borde*/
        
        table.wborder {
            border: 1.5px solid black;
            border-collapse: collapse;
            width: 85%;
        }
        
        table.wborder th,
        td.clear,
        th.clear,
        tr.clear,
        tr.clear td {
            border: 1px solid black;
        }
        
        table.wborder1sub1,
        table.wborder1sub2 {
            width: 90%;
        }
        
        table.wborder1sub1 tr:first-child {
            boder-left: 1px solid black;
        }
        
        table.wborder1sub1 tr:first-child th:first-child {
            border-top-left-radius: 10px;
            paddind: 0px;
            background-color: gray;
            border-top: 1px solid black;
            border-left: 1px solid black;
            border-right: 1px solid black;
        }
        
        table.wborder1sub1 tr:first-child th:last-child {
            border-top-right-radius: 10px;
            paddind: 0px;
            background-color: gray;
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-spacing: 0px;
        }
        
        table.wborder1sub2 tr th,
        table.wborder1sub1 tr th {
            paddind: 0px;
            background-color: gray;
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-spacing: 0px;
        }
        
        table.wborder1sub1 {
            margin: 0;
        }
        
        table.wborder1sub2 tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
            border-Bottom: 1px solid black;
            border-left: 1px solid black;
        }
        
        table.wborder1sub2 tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
            border-bottom: 1px solid black;
            border-right: 1px solid black;
        }
        
        table.wborder1sub1 tr td {
            border-right: 1px solid black;
        }
        
        table.wborder1sub1 tr td:first-child {
            border-left: 1px solid black;
        }
        
        table.wborder1 tr:first-child th:first-child {
            border-top-left-radius: 10px;
            border-left: 1px solid black;
            border-top: 1px solid black;
        }
        
        table.wborder1 tr th {
            background-color: gray;
            padding-left: 23px;
            padding-right: 23px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        
        table.wborder1 tr:first-child th:last-child {
            border-top-right-radius: 10px;
            border-right: 1px solid black;
            border-top: 1px solid black;
        }
        
        table.wborder1 tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
            border-left: 1px solid black;
            border-bottom: 1px solid black;
        }
        
        table.wborder1 tr td {
            padding-left: 23px;
            padding-right: 23px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-left: 1px solid black;
        }
        
        table.wborder1 tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }
        
        
        /*Estilo tabla sin borde*/
        
        table.clear,
        table.clear th,
        td.clear,
        th.clear,
        tr.clear,
        tr.clear td {
            border: 0px;
            padding: 0px;
        }
        
        table.clear {
            border-collapse: collapse;
            width: 75%;
        }
        
        table.clear2 {
            border-collapse: collapse;
            width: 20%;
        }
        
        table.wborder2 tr:last-child td:last-child {
            border-radius: 10px;
            border: 1px solid black;
            width: 30%;
            vertical-align: text-top;
            heigth: 150px;
        }
        
        table.wborder2 tr:first-child td:first-child {
            width: 30%;
            border-radius: 10px;
            vertical-align: text-top;
            border: 1px solid black;
            heigth: 150px;
        }
        
        table.wborder2 tr {
            width: 100%;
            heigth: 150px;
        }
        
        table.wborder2 {
            width: 95%;
            margin: 10px;
        }
        
        td.thsmall {
            width: 2%;
        }
        
        th.small {
            width: 10%;
        }
        
        th.medium {
            width: 16%;
        }
        
        th.small2 {
            width: 12%;
        }
        
        th.big {
            width: 30%;
        }
        
        th.big2 {
            width: 45%;
        }
        
        table.wborder1sub2 tr td {
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }
        
        .fclose td:first-child {
            border-bottom-left-radius: 10px;
            vertical-align: text-top;
            border-left: 1px solid black;
            border-bottom: 1px solid black;
        }
        
        .fclose td:last-child {
            width: 30%;
            border-bottom-right-radius: 10px;
            vertical-align: text-top;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }
        
        .fclose td {
            border-bottom: 1px solid black;
        }
        
        .fclose {}
        
        .wborder1sub3 {
            aling: left;
        }
        
        table.t4 {
            width: 20%;
            align: left;
            position: absolute;
            right: 5%;
        }
        
        table.t4 tr {
            heigth: 200px;
        }
        
        p.leftT {
            width: 60%;
            position: absolute;
            left: 5%;
        }
        
        table.wborder3 {
            width: 90%;
            border-radius: 10px;
            vertical-align: text-top;
            border: 1px solid black;
            height: 120px;
        }
        
        table.wborder4 {
            width: 90%;
            border-radius: 10px;
            vertical-align: text-top;
            border: 1px solid black;
            height: 200px;
        }
        
        img {
            width: 300px;
        }
        
        table.wborder1 {
            position: absolute;
            top: 75px;
            right: 15%;
            width: 200px;
        }
        
        table.wborder4 tr td {
            border-right: 1px solid black;
        }
        
        table.wborder4 tr td:last-child {
            border-right: 0;
        }
        </style>
        </head>
        <!-- partial:index.partial.html -->
        <!DOCTYPE html>
        <html>
        <body>
          <div class = header>
            <table id = "header" class="clear"><tr class="clear">
            <td ><img src="h" stylesheet = "padding-top:140px"></td>
            <td class="clear">
            <table class="wborder1">
            <tr><th>
            <p>NUMERO GARANTIA</p>
            </th></tr>
            <td><p>'.$data[0]->No_garantia.'</p></td>
            </tr></table></td>
            </tr></table></td>
           
        <div>
            </Header>
        <center>
          <!-- Titulo -->
        
          
          <table class="wborder1" >
            <table class="wborder1sub1" >
            <tr> 
              <th class="medium">FACTURA NO.</th> 
              <th class="medium">PUNTO DE VENTA </th>
              <th class="medium">NOMBRE CLIENTE</th>
              <th class="medium">DOCUMENTO</th>
              <th  class="medium">CORREO</th>
               <th  class="medium">DIRECCION</th>
           
            </tr> 
            
            <tr>
              <td>'.$data[0]->Numero_Factura.'</td>
              <td>'.$data[0]->Punto_Venta.'</td>
              <td>'.$data[0]->Nombre_Cliente.'</td>
              <td>'.$data[0]->Numero_Factura.'</td>
              <td>'.$data[0]->Identificacion_Cliente.'</td>
              <td>'.$data[0]->Direccion_Cliente.'</td>
              
            </tr>
              </table>
              </tr>
            <tr>
            <table class="wborder1sub2">
               <tr> 
              <th class = "small"> PROVEEDOR </th> 
              <th class = "small"> FLETE </th>
              <th class = "small"> DEPARTAMENTO </th>
              <th class = "medium"> MUNICIPIO </th>
              <th class = "medium"> VALOR FLETE </th>
              <th class = "small"> NUMERO GUIA </th>
              <th class = "small"> TRANSPORTADORA </th>
              <th class = "big2"> OBSERVACION CLIENTE </th>
              
              
            </tr> 
            <tr>
              <td>'.$data[0]->Proveedor.'</td>
              <td>'.$data[0]->Flete.'</td>
              <td>'.$data[0]->Departamento.'</td>
              <td>'.$data[0]->Municipio.'</td>
              <td>'.$data[0]->Valor_Flete.'</td>
              <td>'.$data[0]->No_Guia.'</td>
              <td>'.$data[0]->Transportadora.'</td>
              <td>'.$product->Observacion_Cliente.'</td>
              
            </tr>
            </table>
              </tr>
          </table>
        <br> <br>
            <!-- Tabla sin bordes -->
          <table >
            
          </table>
            <table class="wborder1sub1">
              <tr >
                  <th class = "small2">CODIGO PRODUCTO</th>
                  <th class = "big">DESCRIPCION PRODUCTO</th>
                  <th class = "small2">MARCA PRODUCTO</th>
                  <th class = "small2">SELLO PRODUCTO</th>
                  <th class = "small2">REFERENCIA</th>
                  <th class = "small2">ESTADO</th>
                </tr>
                <tr height="350px" >
                  <td>'.$product->Codigo_Producto.'</td>
                  <td>'.$product->Descripcion_Producto.'</td>
                  <td>'.$product->Marca_Producto.'</td>
                  <td>'.$product->Sello_Producto.'</td>
                  <td>'.$product->Referencia.'</td>
                  <td>'.$product->Estado.'</td>
              </tr >
                  <tr class="fclose">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
            </table><div calss="left">
          
          </div>
        </TABLE>
            <p class="leftT">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum </p>
         <br></br>
          <br></br>
        
          <table class="wborder3">
            <tr ><th>Observaciones Garantia</th></tr>
            <tr><td> '.$data[0]->Observacion_Empleado.' <td></tr>
         
          </table>
             
         <br><br>
        </center>
        </body>
        </html>
        <!-- partial -->';
        $mpdf->WriteHTML($html);
      }
      $mpdf->Output();
    }
  }

  public function ticket()
  {
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
  }
}
