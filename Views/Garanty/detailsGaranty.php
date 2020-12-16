<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    <a href="?controller=garanty&method=listGaranty" class="btn btn-danger"><<</a>
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
                            <h2>Producto</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <h5>Consecutivo garantia</h5>
                                    <p><?php echo $data[0]->No_garantia?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Codigo del producto</h5>
                                    <p><?php echo $data[0]->Codigo_Producto?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Descripcion producto</h5>
                                    <p><?php echo $data[0]->Descripcion_Producto?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Sello</h5>
                                    <p><?php echo $data[0]->Sello_Producto?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Cantidad</h5>
                                    <p><?php echo $data[0]->Cantidad_Producto?></p>
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
                                <div class="col-sm-12">
                                   <h1>Estado:<p><?php echo $data[0]->Estado?></p></h1>

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
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
