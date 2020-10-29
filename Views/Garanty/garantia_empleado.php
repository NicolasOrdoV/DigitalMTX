<?php
date_default_timezone_set('America/Bogota');
$hora_actual = date("h:i a");
$td = $total_data + 0001;
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                REGISTRO DE GARANTIAS
                <small>Aqui puedes registrar la garantia y decides si la apruebas o no</small>
            </h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Ingresar Garantías
                        </h2>
                    </div>
                    <div class="body">
                        <form action="?controller=garanty&method=findBill" method="POST">
                            <div class="row clearfix">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Numero_Factura</label>
                                            <input type="number" class="form-control" name="NumFactura" required autofocus value="<?php echo isset($_POST['NumFactura']) ? $_POST['NumFactura'] : ''?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-float">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger my-3">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="?controller=garanty&method=save" method="POST" id="form_validation" novalidate>
                            <?php if(isset($billError)){?>
                                <div class="alert alert-danger"><?php echo $billError['error'] ?></div>
                            <?php } ?>
                            <h1>Detalle de factura: <?php echo isset($bills[0]) ? $bills[0]->Numero_Factura : ''?></h1>
                            <input type="hidden" name="Numero_Factura" value="<?php echo isset($bills) ? $bills[0]->Numero_Factura : '' ?>">
                            <input type="hidden" name="Empleado" value="<?php echo $_SESSION['user']->nombre ?>">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Numero Garantia</label>
                                            <input type="text" class="form-control" name="No_Garantia" value="<?php echo "G-".$td; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha</label>
                                            <input type="text" class="form-control" name="Fecha_ingreso" value="<?php echo date('yy/m/d') ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Hora</label>
                                            <input type="text" class="form-control" name="Hora_ingreso" value="<?php echo $hora_actual ?>" readonly required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Punto de Venta</label>
                                            <input type="text" class="form-control" name="Punto_Venta" required readonly value="<?php echo isset($bills[0]) ? $bills[0]->Centro_costo : '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha de Compra</label>
                                            <input type="text" class="form-control" name="Fecha_Compra" required readonly value="<?php echo isset($bills[0]) ? $bills[0]->fecha_factura : '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Cedula </label>
                                            <input type="text" autofocus class="form-control" name="Identificacion_Cliente" id="Identificacion_Cliente" value="<?php echo isset($bills[0]) ? $bills[0]->Identificacion_Cliente : '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre de cliente </label>
                                            <input type="text" class="form-control" name="Nombre_Cliente" id="Nombre_Cliente" required readonly value="<?php echo isset($bills[0]) ? $bills[0]->Nombre_Cliente : '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-sm-4" id="select2lista">   
                                </div>-->
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Correo </label>
                                            <input type="email" class="form-control" name="Correo_Cliente" id="Correo_Cliente" value="<?php echo isset($bills[0]) ? $bills[0]->Correo_Cliente : '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Direccion </label>
                                            <input type="text" class="form-control" name="Direccion_Cliente" id="Direccion_Cliente" value="<?php echo isset($bills[0]) ? $bills[0]->Direccion_Cliente : '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($bills)) {
                                $i = 0;
                                $productos = [];
                                foreach ($bills as $key => $bif) {
                                    $productos = [
                                        'Codigo' => $bif->Codigo_Producto,
                                        'Descripcion' => $bif->Descripcion_Producto,
                                        'Referencia' => $bif->Referencia_Producto,
                                        'Sello' => $bif->Sello_Producto,
                                        'Marca' => $bif->Marca_Producto
                                    ];
                                   
                            ?>
                                    <h1>Producto: <?php echo $key+1;?></h1>
                                    <hr>
                                    <input type="hidden" name="Estado[]" value="Tramite">
                                    <div class="row clearfix">
                                        <div class="col-sm-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label>Codigo Producto </label>
                                                    <input type="text" class="form-control" name="Codigo_Producto[]" id="Codigo_Producto" readonly value="<?php echo isset($productos['Codigo']) ? $productos['Codigo'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label>Descripcion Producto </label>
                                                    <input type="text" class="form-control no-resize" name="Descripcion_Producto[]" id="Descripcion_Producto" readonly  value="<?php echo isset($productos['Descripcion']) ? $productos['Descripcion'] : '' ?>">
                                                    <!--<input type="hidden" name="id_producto" id="id_producto" value="">-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label>Marca Producto</label>
                                                    <input type="text" class="form-control" name="Marca_Producto[]" readonly value="<?php echo isset($productos['Marca']) ? $productos['Marca'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group ">
                                                <div class="form-line">
                                                    <label>Sello Producto</label>
                                                    <input type="text" class="form-control" name="Sello_Producto[]" readonly value="<?php echo isset($productos['Sello']) ? $productos['Sello'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group ">
                                                <div class="form-line">
                                                    <label>Referencia</label>
                                                    <input type="text" class="form-control" name="Referencia[]" readonly value="<?php echo isset($productos['Referencia']) ? $productos['Referencia'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group ">
                                                <label>¿Se aprueba garantia?</label>
                                                <div class="demo-checkbox form-line">
                                                    <input type="checkbox" id="md_checkbox_<?php echo $key+1; ?>" class="chk-col-red" name="Aprobacion_Garantia[]" value="SI" />
                                                    <label for="md_checkbox_<?php echo $key+1; ?>">SI</label>
                                                    <input type="checkbox" id="md_checkbox_<?php echo $key+3; ?>" class="chk-col-red" name="Aprobacion_GarantiaN[]" value="NO" />
                                                    <label for="md_checkbox_<?php echo $key+3; ?>">NO</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <div class="form-line">
                                                    <label>Observacion cliente</label>
                                                    <textarea rows="4" class="form-control no-resize" name="Observacion_Cliente[]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            }
                            ?>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Flete(S/N)</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Flete" id="md_checkbox_21" class="radio-col-red" value="SI" onchange="javascript:ocultContent()"  />
                                            <label for="md_checkbox_21">SI</label>
                                            <input type="radio" name="Flete" id="md_checkbox_22" class="radio-col-red" value="NO"  onchange="javascript:showContent()" checked/>
                                            <label for="md_checkbox_22">NO</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="content" style="display:none">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <p>
                                            <b>Proveedor</b>
                                        </p>
                                        <?php //var_dump($providers) ?>
                                        <select name="Proveedor" class="form-control show-tick" >
                                            <option value="">Seleccione..</option>
                                            <?php foreach ($providers as $provider) { ?>
                                                <option value="<?php echo $provider->Nombre_Proveedor?>"><?php echo $provider->Nombre_Proveedor?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            <b>Ciudad</b>
                                        </p>
                                        <select name="Departamento" class="form-control show-tick" id="lista1">
                                            <option value="0">Seleccione..</option>
                                            <?php foreach ($departaments as $departament) { ?>
                                                <option value="<?php echo $departament->Departamento?>"><?php echo $departament->Departamento?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div id="select2lista" class="col-sm-4">
                                        
                                    </div>
                                    <!--<div class="col-sm-4">
                                        <p>
                                            <b>Municipio</b>
                                        </p>
                                        <select name="Municipio" class="form-control show-tick" >
                                            <option value="">Seleccione..</option>
                                            <option value="Cundinamarca">Cundinamarca</option>
                                            <option value="Bogota D.C">Bogota D.C</option>
                                            <option value="Comuna 12">Comuna 12</option>
                                            <option value="Miraflores">Miraflores</option>
                                        </select>
                                    </div>-->

                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label>Valor Flete </label>
                                                <input type="number" class="form-control" name="Valor_Flete" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label>Numero Guia </label>
                                                <input type="number" class="form-control" name="No_Guia" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            <b>Transportadora</b>
                                        </p>
                                        <select name="Transportadora" class="form-control show-tick" >
                                            <option value="">Seleccione..</option>
                                            <option value="Envia">Envia</option>
                                            <option value="Servientrega">Servientrega</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Observacion Empleado</label>
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Empleado"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
            <!-- Textarea -->
            <!--#END# Switch Button -->
        </div>
</section>
<!-- <script type="text/javascript">
    $(function() {
        $("#Identificacion_Cliente").autocomplete({
            source: "personal.php",
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#Identificacion_Cliente').val(ui.item.Identificacion_Cliente);
                $('#Correo_Cliente').val(ui.item.Correo_Cliente);
                $('#Nombre_Cliente').val(ui.item.Nombre_Cliente);
                $("#Identificacion_Cliente").focus();
            }
        });
    });
</script> -->
<!--<script>
    document.getElementById("Codigo_Producto").onchange = function() {
        alerta2()
    };

    function alerta2() {
        // Creando el objeto para hacer el request
        var request = new XMLHttpRequest();

        // Objeto PHP que consultaremos
        request.open("POST", "Views/Garanty/services.php");

        // Definiendo el listener
        request.onreadystatechange = function() {
            // Revision si fue completada la peticion y si fue exitosa
            if (this.readyState === 4 && this.status === 200) {

                var data = JSON.parse(this.responseText);
                var data = data.toString().split(",");
                // Ingresando la respuesta obtenida del PHP
                document.getElementById("id_producto").value = data[0];
                document.getElementById("Descripcion_Producto").value = data[1];

            }
        };

        // Recogiendo la data del HTML
        var myForm = document.getElementById("form_validation");
        var formData = new FormData(myForm);

        // Enviando la data al PHP
        request.send(formData);
    }
</script>
<script>
    document.getElementById("Identificacion_Cliente").onchange = function() {
        alerta()
    };

    function alerta() {
        // Creando el objeto para hacer el request
        var request = new XMLHttpRequest();
        // Objeto PHP que consultaremos
        request.open("POST", "Views/Garanty/servicesclients.php");

        // Definiendo el listener
        request.onreadystatechange = function() {

            // Revision si fue completada la peticion y si fue exitosa
            if (this.readyState === 4 && this.status === 200) {
                // Ingresando la respuesta obtenida del PHP
                var data = JSON.parse(this.responseText);
                var data = data.toString().split(",");
                //alert(data[0]);
                //contenidosRecibidos = this.responseText.replace(contenidosRecibidos,'"]');

                document.getElementById("id").value = data[0];
                document.getElementById("Correo_Cliente").value = data[1];
                document.getElementById("Nombre_Cliente").value = data[2];

            }
        };


        // Recogiendo la data del HTML
        var myForm = document.getElementById("form_validation");
        var formData = new FormData(myForm);

        // Enviando la data al PHP
        request.send(formData);
    }
</script>-->

<script type="text/javascript">
    function showContent() {
        //Verificacion del la informacion que se mostrara en cuando el checkbox se igual a si
        element = document.getElementById("content");
        check = document.getElementById("md_checkbox_21");
        if (check.checked) {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }
</script>
<script type="text/javascript">
    function ocultContent() {
        //Verificacion del la informacion que se mostrara en cuando el checkbox se igual a si
        element = document.getElementById("content");
        check = document.getElementById("md_checkbox_22");
        if (check.checked) {
            element.style.display = 'none';
        } else {
            element.style.display = 'block';
        }
    }
</script>
<script src="Assets/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#lista1').val(0);
        recargarLista();

        $('#lista1').change(function(){
            recargarLista();
        });
    }) 
</script>
<script type="text/javascript">
    function recargarLista(){
        $.ajax({
            type:"POST",
            url:"Views/Garanty/datos.php",
            data:"Municipio=" + $('#lista1').val(),
            success:function(r){
                $('#select2lista').html(r);
            }
            //console.log(data);
        });
    }
</script>