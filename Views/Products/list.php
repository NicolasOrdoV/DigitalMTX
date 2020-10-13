<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                LISTA DE PRODUCTOS
                <small>Consulta los productos actuales de la empresa</small>
            </h2>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-sm-6">
                            <h2>Productos</h2>
                        </div>
                        <?php if ($_SESSION['user']->id_rol == 1 || $_SESSION['user']->id_rol == 3) { ?>
                            <div class="col-sm-6 text-right">
                                <a href="?controller=product&method=new" class="btn btn-danger">+Agregar</a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Codigo producto</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?php echo $product->id ?></td>
                                            <td><?php echo $product->Codigo ?></td>
                                            <td><?php echo $product->Nombre ?></td>
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


