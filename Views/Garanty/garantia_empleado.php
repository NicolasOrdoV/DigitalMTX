
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
                            <?php //var_dump($clients); 
                            ?>
                        </h2>
                    </div>
                    <div class="body">
                        <form action="?controller=garanty&method=save" method="POST" id="form_validation" novalidate>
                            <?php if (isset($succesfull)) { ?>
                                <div class="alert alert-success"><?php echo $succesfull; ?></div>
                            <?php } ?>
                            <input type="hidden" name="id_Personal" value="<?php echo $_SESSION['user']->id ?>">
                            <input type="hidden" name="Estado" value="Pendiente">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Numero Garantia</label>
                                            <input type="number" class="form-control" name="No_Garantia" value="<?php $total_data = count($data);
                                                                                                                echo $total_data + 1; ?>" 
                                                                                                                readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha</label>
                                            <input type="text" class="form-control" name="Fecha" value="<?php echo date('yy/m/d')?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Hora</label>
                                            <input type="text" class="form-control" name="Hora" value="<?php echo date('h:i A');?>" readonly required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Numero_Factura</label>
                                            <input type="number" class="form-control" name="Numero_Factura" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <p>
                                            <b>Punto Venta</b>
                                        </p>
                                        <select name="Punto_Venta" class="form-control show-tick" required>
                                            <option value="">Seleccione...</option>
                                            <option value="ALTA">ALTA</option>
                                            <option value="BARRANQUILLA">BARRANQUILLA</option>
                                            <option value="CENTRO">CENTRO</option>
                                            <option value="MEDELLIN">MEDELLIN</option>
                                            <option value="OFICINA">OFICINA</option>
                                            <option value="UNILAGO">UNILAGO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha de Compra</label>
                                            <input type="date" class="form-control" name="Fecha_Compra" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Cedula </label>
                                            <input list="Id" autofocus class="form-control" name="Identificacion_Cliente" id="Identificacion_Cliente">
                                            <datalist id="Id">
                                                <?php foreach ($clients as $client) { ?>
                                                    <option value="<?php echo $client->Identificacion ?>"><?php echo $client->Identificacion ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre de cliente </label>
                                            <input type="text" class="form-control" name="Nombre_Cliente" id="Nombre_Cliente" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-sm-4" id="select2lista">   
                                </div>-->
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Correo </label>
                                            <input type="email" class="form-control" name="Correo_Cliente" id="Correo_Cliente" value="" readonly>
                                            <input type="hidden" name="id_cliente" id="id" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group ">
                                        <a href="?controller=client&method=new" class="btn btn-danger"><i class="material-icons">add</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Codigo Producto </label>
                                            <input list="codes" class="form-control" name="Codigo_Producto" id="Codigo_Producto" required>
                                            <datalist id="codes">
                                                <?php foreach ($products as $product) { ?>
                                                    <option value="<?php echo $product->Codigo ?>"><?php echo $product->Codigo ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                             <label>Descripcion Producto </label>
                                             <input type="text" class="form-control no-resize" name="Descripcion_Producto" id="Descripcion_Producto" required>
                                             <input type="hidden" name="id_producto" id="id_producto" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Serial </label>
                                            <input type="text" class="form-control" name="Serial" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Proveedor</label>
                                            <input type="text" class="form-control" name="Proveedor" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Flete(S/N)</label>
                                        <div class="demo-checkbox">
                                            <input type="checkbox" name="Flete" id="md_checkbox_21" class="filled-in chk-col-red" value="SI" />
                                            <label for="md_checkbox_21">SI</label>
                                            <input type="checkbox" name="Flete" id="md_checkbox_22" class="filled-in chk-col-red" value="NO" />
                                            <label for="md_checkbox_22">NO</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <p>
                                        <b>Ciudad</b>
                                    </p>
                                    <select name="Ciudad" class="form-control show-tick" required>
                                        <option value="">Seleccione..</option>
                                        <option value="Bogota D.C">Bogota D.C</option>
                                        <option value="Medellin">Medellin</option>
                                        <option value="Barranquilla">Barranquilla</option>
                                        <option value="Cali">Cali</option>
                                    </select>
                                </div>


                                <div class="col-sm-6">
                                    <p>
                                        <b>Municipio</b>
                                    </p>
                                    <select name="Municipio" class="form-control show-tick" required>
                                        <option value="">Seleccione..</option>
                                        <option value="Cundinamarca">Cundinamarca</option>
                                        <option value="Bogota D.C">Bogota D.C</option>
                                        <option value="Comuna 12">Comuna 12</option>
                                        <option value="Miraflores">Miraflores</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Valor producto </label>
                                            <input type="number" class="form-control" name="Valor_Producto" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Observacion Cliente</label>
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Cliente"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
                                    <div class="form-group form-float">
                                        <label>¿Se aprueba la garantía?</label>
                                        <div class="demo-radio-button">
                                            <input name="Aprobacion_Garantia" type="radio" id="radio_7" class="radio-col-red" value="SI" />
                                            <label for="radio_7">SI</label>
                                            <input name="Aprobacion_Garantia" type="radio" id="radio_8" class="radio-col-red" value="NO" />
                                            <label for="radio_8">NO</label>
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
<script>
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
</script>