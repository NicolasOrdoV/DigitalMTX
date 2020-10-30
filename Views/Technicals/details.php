<?php
date_default_timezone_set('America/Bogota');
$hora_actual = date("h:i a"); ?> 
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    DETALLES DE GARANTIA
                    <small>Aqui puedes visualisar el detalle de las garantias para empezar a reparar y dar tus conclusiones</small>
                </h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Detalle de la garantia</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <?php var_dump($data) ?>
                                    <h5>No garantia</h5>
                                    <p><?php echo $data[0]->No_garantia?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Fecha de garantia</h5>
                                    <p><?php echo $data[0]->Fecha_ingreso?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>hora de garantia</h5>
                                    <p><?php echo $data[0]->Hora_ingreso?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Numero de factura</h5>
                                    <p><?php echo $data[0]->Numero_Factura?></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <h5>Punto de venta</h5>
                                    <p><?php echo $data[0]->Punto_Venta?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h5>Fecha compra</h5>
                                    <p><?php echo $data[0]->Fecha_Compra?></p>
                                </div>
                            </div>
                            <h2>Producto</h2>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h5>Codigo del producto</h5>
                                    <p><?php echo $data[0]->Codigo_Producto?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Descripcion producto</h5>
                                    <p><?php echo $data[0]->Descripcion_Producto?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Serial</h5>
                                    <p><?php echo $data[0]->Sello_Producto?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Proveedor</h5>
                                    <p><?php echo $data[0]->Proveedor?></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h5>Flete</h5>
                                    <p><?php echo $data[0]->Flete?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Ciudad</h5>
                                    <p><?php echo $data[0]->Departamento?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Municipio</h5>
                                    <p><?php echo $data[0]->Municipio?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Valor del producto</h5>
                                    <p><?php echo $data[0]->Valor_Flete?></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-danger waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Observaciones generales</button>
                                </div>
                            </div>
                            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-red">
                                            <h4 class="modal-title" id="defaultModalLabel">Observaciones del cliente</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $data[0]->Observacion_Cliente?></p>
                                        </div>
                                        <div class="modal-header bg-red">
                                            <h4 class="modal-title" id="defaultModalLabel">Observaciones del empleado</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $data[0]->Observacion_Empleado?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($consecutives)){ ?>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <table class="table">
                                                <thead class="bg-red">
                                                    <th>Fechas</th>
                                                    <th>Horas</th>
                                                    <th>Observaciones</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($consecutives as $consecutive){?>
                                                    <tr>
                                                        <td><?php echo $consecutive->Fecha_anexo_Tecnico?></td>
                                                        <td><?php echo $consecutive->Hora_Anexo_Tecnico?></td>
                                                        <td><?php echo $consecutive->Observacion_tecnico?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                               <?php } ?>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <form action="?controller=technical&method=save" method="POST">
                                        <input type="hidden" name="Id_Garantia" value="<?php echo $data[0]->id?>">
                                        <input type="hidden" name="Id_Empleado" value="<?php echo $_SESSION['user']->id?>">
                                        <input type="hidden" name="nombre" value="<?php echo $data[0]->Descripcion_Producto?>">
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label>Fecha:</label>
                                                        <input type="text" name="Fecha_anexo_Tecnico" class="form-control" value="<?php echo date('yy/m/d') ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label>Hora:</label>
                                                        <input type="text" name="Hora_Anexo_Tecnico" class="form-control" value="<?php echo $hora_actual ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="4" class="form-control no-resize" name="Observacion_tecnico" ></textarea>
                                                <label class="form-label">Observacion tecnico</label>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <label>Estado del tecnico*</label>
                                                <select name="Estado_tecnico" class="form-control show-tick" >
                                                    <option value="">Seleccione..</option>
                                                    <option value="Pendiente por servicio tecnico">Pendiente por servicio tecnico</option>
                                                    <option value="Solucionado por servicio tecnico">Solucionado por servicio tecnico</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <button type="submit" class="btn btn-danger">Registrar observación</button>
                                        </div>
                                        <?php if (isset($succesfull)) { ?>
                                            <div class="alert alert-success">
                                                <?php echo $succesfull; ?>
                                                <a href="?controller=technical&method=list" class="btn btn-danger">Regresar</a>
                                            </div>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
