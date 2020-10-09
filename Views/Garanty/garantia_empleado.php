<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Garantias</h2>
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
                                            <input type="number" class="form-control" name="No_Garantia" value="<?php $total_data = count($data);
                                                                                                                echo $total_data + 1; ?>" readonly required>
                                            <label class="form-label">Numero Garantia</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha</label>
                                            <input type="date" class="form-control" name="Fecha" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Hora</label>
                                            <input type="time" class="form-control" name="Hora" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="Numero_Factura" required>
                                            <label class="form-label">Numero_Factura</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Punto Venta</label>
                                    <select name="Punto_Venta" required>
                                        <option value="">Seleccione..</option>
                                        <option value="ALTA">ALTA</option>
                                        <option value="BARRANQUILLA">BARRANQUILLA</option>
                                        <option value="CENTRO">CENTRO</option>
                                        <option value="MEDELLIN">MEDELLIN</option>
                                        <option value="OFICINA">OFICINA</option>
                                        <option value="UNILAGO">UNILAGO</option>
                                    </select>
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input list="Names" class="form-control" name="Nombre_Cliente" id="Nombre_Cliente" required>
                                            <!-- <datalist id="Names">
                                                <?php ## foreach ($clients as $client) { ?>
                                                    <option value="<?php ##echo $client->Nombres ?>"><?php echo $client->Nombres ?></option>
                                                <?php ##} ?>
                                            </datalist> -->

                                            <label class="form-label">Nombre de cliente </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input list="Id" autofocus class="form-control" name="Identificacion_Cliente" id="Identificacion_Cliente">
                                            <datalist id="Id">
                                                <?php foreach ($clients as $client) { ?>
                                                    <option value="<?php echo $client->Identificacion ?>"><?php echo $client->Identificacion ?></option>
                                                <?php } ?>
                                            </datalist>
                                            <label class="form-label">Cedula </label>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="col-sm-4" id="select2lista">   
                                </div>-->
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input list="Emails" class="form-control" name="Correo_Cliente" id="Correo_Cliente" value="" required>
                                            <datalist id="Emails">
                                                <?php foreach ($clients as $client) { ?>
                                                    <option value="<?php echo $client->Correo ?>"><?php echo $client->Correo ?></option>
                                                <?php } ?>
                                            </datalist>
                                            <label class="form-label">Correo </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input list="codes" class="form-control" name="Codigo_Producto" id="Codigo_Producto" required>
                                            <datalist id="codes">
                                                <?php foreach ($products as $product) { ?>
                                                    <option value="<?php echo $product->Codigo ?>"><?php echo $product->Codigo ?></option>
                                                <?php } ?>
                                            </datalist>
                                            <label class="form-label">Codigo Producto </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control no-resize" name="Descripcion_Producto" id="Descripcion_Producto" required>
                                            <label class="form-label">Descripcion Producto </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Serial" required>
                                            <label class="form-label">Serial </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Proveedor" required>
                                            <label class="form-label">Proveedor</label>
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
                                    <label>Ciudad</label>
                                    <select name="Ciudad" required>
                                        <option value="">Seleccione..</option>
                                        <option value="Bogota">Bogota D.C</option>
                                    </select>
                                </div>


                                <div class="col-sm-6">
                                    <label>Municipio</label>
                                    <select name="Municipio" required>
                                        <option value="">Seleccione..</option>
                                        <option value="Cundinamarca">Cundinamarca</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="Valor_Producto" required>
                                            <label class="form-label">Valor producto </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Cliente"></textarea>
                                            <label class="form-label">Observacion Cliente</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Empleado"></textarea>
                                            <label class="form-label">Observacion Empleado</label>
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
                // Ingresando la respuesta obtenida del PHP
                document.getElementById("Descripcion_Producto").value = this.responseText;
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

               document.getElementById("Correo_Cliente").value = data[0];
               document.getElementById("Nombre_Cliente").value = data[1];

            }
        };
        

        // Recogiendo la data del HTML
        var myForm = document.getElementById("form_validation");
        var formData = new FormData(myForm);

        // Enviando la data al PHP
        request.send(formData);
    }
</script>