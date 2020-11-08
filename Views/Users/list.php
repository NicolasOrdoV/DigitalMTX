<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                LISTA DE CLIENTES
                <small>Consulta los clientes actuales de la empresa</small>
            </h2>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Clientes</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Identificacion</th>
                                        <th>Nombres</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clients as $client) { ?>
                                        <tr>
                                            <td><?php echo $client->id ?></td>
                                            <td><?php echo $client->identificacion ?></td>
                                            <td><?php echo $client->nombre ?></td>
                                            <td><?php echo $client->direccion ?></td>
                                            <td><?php echo $client->telefono ?></td>
                                            <td><?php echo $client->correo ?></td>
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


