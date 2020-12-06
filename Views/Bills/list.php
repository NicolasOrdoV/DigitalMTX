<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                LISTA DE FACTURAS
                <small>Consulta las facturas actuales y carga las nuevas que se generen</small>
            </h2>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-sm-6">
                            <h2>Facturas</h2>
                        </div>
                    </div>
                    <div class="header row">
                        <div class="alert alert-warning">
                            <p>RECUERDA: debes cargar tu archivo de facturas una vez, si los datos no cargan, por favor avisar a soporte tecnologico.</p>
                        </div>
                        <div class="col-sm-12">
                            <h2>Importar</h2>
                        </div>
                        <div class="col-sm-12">
                            <form action="Views/Bills/import.php" method="post" enctype="multipart/form-data" id="form_validation">				
                                <input type="file" name="file" class="form-control"/>
                                <input type="submit" class="btn btn-danger" name="import_data" value="IMPORTAR" required>		
                           </form>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable <?php echo $_SESSION['user']->cargo == "Administrador" ? 'js-exportable' : 'js-basic-example' ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>fecha_factura</th>
                                        <th>nit</th>
                                        <th>vendedor</th>
                                        <th>Numero_factura</th>
                                        <th>Centro_costo</th>
                                        <th>Referencia</th>
                                        <th>Cantidad</th>
                                        <th>neto</th>
                                        <th>Descripcion comentarios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bills as $bill) { ?>
                                        <tr>
                                            <td><?php echo $bill->id ?></td>
                                            <td><?php echo $bill->fecha_factura ?></td>
                                            <td><?php echo $bill->nit ?></td>
                                            <td><?php echo $bill->vendedor ?></td>
                                            <td><?php echo $bill->Numero_Factura ?></td>
                                            <td><?php echo $bill->Centro_costo ?></td>
                                            <td><?php echo $bill->Referencia ?></td>
                                            <td><?php echo $bill->Cantidad ?></td>
                                            <td><?php echo $bill->neto ?></td>
                                            <td><?php echo $bill->Descripcion_Comentarios ?></td>
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


