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
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Numero_Factura </th>
                                        <th>fecha_factura</th>
                                        <th>nit</th>
                                        <th>hora_factura</th>
                                        <th>Nombre_Cliente</th>
                                        <th>Identificacion_Cliente</th>
                                        <th>Correo_Cliente</th>
                                        <th>Direccion_Cliente</th>
                                        <th>Centro_costo</th>
                                        <th>Codigo_Producto</th>
                                        <th>Codigo_proveedor</th>
                                        <th>Descripcion_Producto</th>
                                        <th>Referencia_Producto</th>
                                        <th>Cantidad</th>
                                        <th>Sello_Producto</th>
                                        <th>Marca_Producto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bills as $bill) { ?>
                                        <tr>
                                            <td><?php echo $bill->id ?></td>
                                            <td><?php echo $bill->Numero_Factura ?></td>
                                            <td><?php echo $bill->fecha_factura ?></td>
                                            <td><?php echo $bill->nit ?></td>
                                            <td><?php echo $bill->hora_factura ?></td>
                                            <td><?php echo $bill->Nombre_Cliente ?></td>
                                            <td><?php echo $bill->Identificacion_Cliente ?></td>
                                            <td><?php echo $bill->Correo_Cliente ?></td>
                                            <td><?php echo $bill->Direccion_Cliente ?></td>
                                            <td><?php echo $bill->Centro_costo ?></td>
                                            <td><?php echo $bill->Codigo_Producto ?></td>
                                            <td><?php echo $bill->Codigo_Proveedor ?></td>
                                            <td><?php echo $bill->Descripcion_Producto ?></td>
                                            <td><?php echo $bill->Referencia_Producto ?></td>
                                            <td><?php echo $bill->Cantidad ?></td>
                                            <td><?php echo $bill->Sello_Producto ?></td>
                                            <td><?php echo $bill->Marca_Producto ?></td>
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


