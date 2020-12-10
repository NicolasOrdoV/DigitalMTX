
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                LISTA DE GARANTÍAS
                <small>Consulta las garantías</small>
            </h2>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-sm-6">
                            <h2>Garantías</h2>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable <?php echo $_SESSION['user']->cargo == "Administrador" ? 'js-exportable' : 'js-basic-example' ?>">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Fecha garantia</th>
                                        <th>Hora garantia</th>
                                        <th>Numero de factura</th>
                                        <th>Cliente</th>
                                        <th>Correo</th>
                                        <th>Aprobacion Garantia</th>
                                        <th>Estado</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($garanties as $key => $garanty) { ?>
                                        <tr>
                                            <td><?php echo $garanty->No_garantia ?></td>
                                            <td><?php echo $garanty->Fecha_ingreso ?></td>
                                            <td><?php echo $garanty->Hora_ingreso ?></td>
                                            <td><?php echo $garanty->Numero_Factura ?></td>
                                            <td><?php echo $garanty->Nombre_Cliente ?></td>
                                            <td><?php echo $garanty->Correo_Cliente ?></td>
                                            <td><?php echo $garanty->Aprobacion_Garantia ?></td>
                                            <td><?php echo $garanty->Estado ?></td>
                                        </tr>
                                   <?php } ?>
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