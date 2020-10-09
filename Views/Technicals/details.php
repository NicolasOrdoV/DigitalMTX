<section class="content">
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Detalle de la garantia</h2>
                            <small>Aqui puedes observar el detalle de la garantia y de alli sacar tu propia observacion</small>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h5>No garantia</h5>
                                    <p><?php echo $data[0]->No_Garantia?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Fecha de garantia</h5>
                                    <p><?php echo $data[0]->Fecha?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>hora de garantia</h5>
                                    <p><?php echo $data[0]->Hora?></p>
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
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <h5>Nombre del cliente</h5>
                                    <p><?php echo $data[0]->Nombre_Cliente?></p>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Identificacion del cliente</h5>
                                    <p><?php echo $data[0]->Identificacion_Cliente?></p>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Correo del cliente</h5>
                                    <p><?php echo $data[0]->Correo_Cliente?></p>
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
                                    <p><?php echo $data[0]->Serial?></p>
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
                                    <p><?php echo $data[0]->Ciudad?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Municipio</h5>
                                    <p><?php echo $data[0]->Municipio?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Valor del producto</h5>
                                    <p><?php echo $data[0]->Valor_Producto?></p>
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
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title" id="defaultModalLabel">Observaciones del cliente</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $data[0]->Observacion_Cliente?></p>
                                        </div>
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title" id="defaultModalLabel">Observaciones del empleado</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $data[0]->Observacion_Empleado?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <form action="?controller=technical&method=save" method="POST">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="4" class="form-control no-resize" name="Observacion_tecnico" ></textarea>
                                                <label class="form-label">Observacion tecnico</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <button type="submit" class="btn btn-danger">Registrar observación</button>
                                        </div>
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
