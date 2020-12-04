
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                OPCIONES FINALES DE GARANTIAS
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
                        <p><b>Consecutivo garantia:</b></p>
                        <h1><?php echo $data[0]->No_garantia?></h1>
                    </div>
                    <div class="body">
                        <form action="?controller=garanty&method=saveEndDelivery" method="POST" id="form_validation">
                            <input  type = "hidden" name="id" value="<?php echo $data[0]->id ?>">
                            <div class="row clearfix">
                                <div class="alert alert-warning">
                                    <b>NOTA:</b>
                                    <p>Se debe llenar este formulario solamente cuando se le haya entregado el producto al cliente, esto con el fin de darle la finalidad completa  a la garantia</p>
                                </div>
                                <div class="col-sm-12">
                                    <p>Estado actual: <?php echo $data[0]->Estado?></p>
                                    <div class="form-group form-float my-2">
                                        
                                            <div class="col-sm-3">
                                                <label>Nota Credito</label>
                                                <div class="demo-checkbox">
                                                    <input type="radio" name="Estado" id="md_checkbox_21" class="radio-col-red" value="Entregado para Nota Credito" onchange="javascript:ocultContent()"/>
                                                    <label for="md_checkbox_21">SI</label>
                                                </div>
                                                <label>Cambio Producto</label>
                                                <div class="demo-checkbox">
                                                    <input type="radio" name="Estado" id="md_checkbox_22" class="radio-col-red" value="Entregado para cambio de producto" onchange="javascript:showContent()" />
                                                    <label for="md_checkbox_22">SI</label>
                                                </div>
                                                <label>Devolucion Dinero</label>
                                                <div class="demo-checkbox">
                                                    <input type="radio" name="Estado" id="md_checkbox_23" class="radio-col-red" value="Entregado para Devolucion de Dinero" onchange="javascript:ocultContent2()" />
                                                    <label for="md_checkbox_23">SI</label>
                                                </div>
                                                <label>No tiene garantia</label>
                                                <div class="demo-checkbox">
                                                    <input type="radio" name="Estado" id="md_checkbox_24" class="radio-col-red" value="Entregado para No tiene garantia" onchange="javascript:ocultContent3()"  />
                                                    <label for="md_checkbox_24">SI</label>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div id="content" style="display:none">
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                <div class="form-line">
                                                    <label>Sello Producto</label>
                                                    <input type="text" class="form-control" name="Sello_Producto" value="<?php echo rand('1234567','10')?>">
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
