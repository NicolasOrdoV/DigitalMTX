
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                OPCIONES DE GARANTIAS
                <small>Aqui puedes registrar el registro final de la garantia</small>
            </h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Ingresar Garantía final
                        </h2>
                        <p>Observacion del tecnico</p>
                        <?php echo $data[0]->Observacion_tecnico?>
                    </div>
                    <div class="body">
                        <form action="?controller=garanty&method=saveEndGaranty" method="POST">
                            <input  type = "hidden" name="id" value="<?php echo $data[0]->id ?>">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nota Credito</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_21" class="radio-col-red" value="Solucionado Nota Credito" onchange="javascript:ocultContent()"/>
                                            <label for="md_checkbox_21">SI</label>
                                        </div>
                                        <label>Cambio Producto</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_22" class="radio-col-red" value="Solucionado a cambio de producto" onchange="javascript:showContent()" />
                                            <label for="md_checkbox_22">SI</label>
                                        </div>
                                        <label>Devolucion Dinero</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_23" class="radio-col-red" value="Solucionado a Devolucion de Dinero" onchange="javascript:ocultContent2()" />
                                            <label for="md_checkbox_23">SI</label>
                                        </div>
                                        <label>No tiene garantia</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_24" class="radio-col-red" value="Solucionado a No tiene garantia" onchange="javascript:ocultContent3()"  />
                                            <label for="md_checkbox_24">SI</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Observacion Empleado</label>
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Final"></textarea>
                                        </div>
                                    </div>
                                    <div id="content" style="display:none">
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                <div class="form-line">
                                                    <label>Sello Producto</label>
                                                    <input type="text" class="form-control" name="Sello_Producto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class ="row clearfix">
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
        </div>

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
    function ocultContent() {
        //Verificacion del la informacion que se mostrara en cuando el checkbox se igual a si
        element = document.getElementById("content");
        check = document.getElementById("md_checkbox_21");
        if (check.checked) {
            element.style.display = 'none';
        } else {
            element.style.display = 'block';
        }
    }
</script>
<script type="text/javascript">
    function ocultContent2() {
        //Verificacion del la informacion que se mostrara en cuando el checkbox se igual a si
        element = document.getElementById("content");
        check = document.getElementById("md_checkbox_23");
        if (check.checked) {
            element.style.display = 'none';
        } else {
            element.style.display = 'block';
        }
    }
</script>
<script type="text/javascript">
    function ocultContent3() {
        //Verificacion del la informacion que se mostrara en cuando el checkbox se igual a si
        element = document.getElementById("content");
        check = document.getElementById("md_checkbox_24");
        if (check.checked) {
            element.style.display = 'none';
        } else {
            element.style.display = 'block';
        }
    }
</script>
<script type="text/javascript">
    function showContent() {
        //Verificacion del la informacion que se mostrara en cuando el checkbox se igual a si
        element = document.getElementById("content");
        check = document.getElementById("md_checkbox_22");
        if (check.checked) {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }
</script>