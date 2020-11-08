<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                LISTA DE CLIENTES
                <small>Consulta los clientes actuales y carga los nuevos que llegen</small>
            </h2>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-sm-6">
                            <h2>Clientes</h2>
                        </div>
                    </div>
                    <div class="header row">
                        <div class="col-sm-12">
                            <h2>Importar</h2>
                        </div>
                        <div class="col-sm-12">
                            <form action="Views/Clients/import.php" method="post" enctype="multipart/form-data" id="form_validation">				
                                <input type="file" name="file" class="form-control"/>
                                <input type="submit" class="btn btn-danger" name="import_data" value="IMPORTAR" required>		
                           </form>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Identificacion</th>
                                        <th>Nombre </th>
                                        <th>Direccion</th>
                                        <th>Ciudad</th>
                                        <th>Telefono</th>
                                        <th>Correo electronico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clients as $client) { ?>
                                        <tr>
                                            <td><?php echo $client->IDENTIFICACION ?></td>
                                            <td><?php echo $client->NOMBRE ?></td>
                                            <td><?php echo $client->DIRECCIÓN ?></td>
                                            <td><?php echo $client->CIUDAD ?></td>
                                            <td><?php echo $client->TELÉFONO_CELULAR ?></td>
                                            <td><?php echo $client->CORREO_ELECTRÓNICO ?></td>
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


