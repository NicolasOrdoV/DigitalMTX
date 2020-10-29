<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    LISTA DE GARANTIAS PENDIENTES
                    <small>Aqui puedes visualisar los detalles de las garantias y dar el reporte final</small>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Garantias pendientes
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Numero de factura</th>
                                            <th>Cliente</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Aprobacion Garantia</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($technicals as $key => $technical) { ?>
                                            <tr>
                                                <td><?php echo $technical->No_garantia ?></td>
                                                <td><?php echo $technical->Numero_Factura ?></td>
                                                <td><?php echo $technical->Nombre_Cliente ?></td>
                                                <td><?php echo $technical->Descripcion_Producto ?></td>
                                                <td><?php echo $technical->Correo_Cliente ?></td>
                                                <td><?php echo $technical->Aprobacion_Garantia ?></td>
                                                <td><?php echo $technical->Estado ?></td>
                                                <td>
                                                    <div class="row clearfix">
                                                        <?php if ($technical->Estado == "Tramite" || $technical->Estado == "Pendiente por servicio tecnico") { ?>
                                                            <div class="col-sm-6">
                                                                <a href="?controller=technical&method=details&name=<?php echo $technical->Descripcion_Producto?>&id=<?php echo $technical->id ?>" class="btn btn-info"><i class="material-icons">add</i></a>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>