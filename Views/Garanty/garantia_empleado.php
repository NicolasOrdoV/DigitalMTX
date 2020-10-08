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
                            <?php //var_dump($clients); ?>
                        </h2>
                    </div>
                    <div class="body">
                        <form action="?controller=garanty&method=save" method="POST">
                            <?php if (isset($succesfull)) { ?>
                                <div class="alert alert-success"><?php echo $succesfull; ?></div>
                            <?php } ?>
                            <input type="hidden" name="id_Personal" value="<?php echo $_SESSION['user']->id ?>">
                            <input type="hidden" name="Estado" value="Pendiente">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="No_Garantia">
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
                                            <input type="date" class="form-control" name="Fecha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Hora</label>
                                            <input type="time" class="form-control" name="Hora">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="Numero_Factura">
                                            <label class="form-label">Numero_Factura</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Punto Venta</label>
                                    <select name="Punto_Venta">
                                        <option value="">Seleccione..</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha de Compra</label>
                                            <input type="date" class="form-control" name="Fecha_Compra">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input list="Names" class="form-control" name="Nombre_Cliente">
                                            <datalist id="Names">
                                                <?php foreach ($clients as $client) { ?>
                                                    <option value="<?php echo $client->Nombres?>"><?php echo $client->Nombres?></option>
                                                <?php } ?>
                                            </datalist>
                                            <label class="form-label">Nombre de cliente </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input list="Id" class="form-control" name="Nombre_Cliente">
                                            <datalist id="Id">
                                                <?php foreach ($clients as $client) { ?>
                                                    <option value="<?php echo $client->Identificacion?>"><?php echo $client->Identificacion?></option>
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
                                            <input type="email" class="form-control" name="Correo_Cliente">
                                            <label class="form-label">Correo </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Codigo_Producto">
                                            <label class="form-label">Codigo Producto </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Cliente"></textarea>
                                            <label class="form-label">Descripcion Producto </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Direccion_Cliente">
                                            <label class="form-label">Serial </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <label>Proveedor</label>
                                        <select>
                                            <option value="">Seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Flete(S/N)</label>
                                        <div class="demo-radio-button">
                                            <input name="Aprobacion_Garantia" type="radio" id="radio_7" class="radio-col-red" value="SI" checked />
                                            <label for="radio_7">SI</label>
                                            <input name="Aprobacion_Garantia" type="radio" id="radio_8" class="radio-col-red" value="NO" checked />
                                            <label for="radio_8">NO</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label>Ciudad</label>
                                    <select>
                                        <option value="">Seleccione..</option>
                                    </select>
                                </div>


                                <div class="col-sm-6">
                                    <label>Municipio</label>
                                    <select>
                                        <option value="">Seleccione..</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Direccion_Cliente">
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
                                            <input name="Aprobacion_Garantia" type="radio" id="radio_7" class="radio-col-red" value="SI" checked />
                                            <label for="radio_7">SI</label>
                                            <input name="Aprobacion_Garantia" type="radio" id="radio_8" class="radio-col-red" value="NO" checked />
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
            data:"Identificacion=" + $('#lista1').val(),
            success:function(r){
                $('#select2lista').html(r);
            }
        });
    }
</script>