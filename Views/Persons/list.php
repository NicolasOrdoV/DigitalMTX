<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    LISTA DE EMPLEADOS
                    <small>Aqui puedes visualisar los empleados que de manera vigente trabajan contigo</small>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Empleados
                                <a href="?controller=person&method=new" class="btn btn-danger text-right">+Agregar</a>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>Rol</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($persons as $person) { ?>
                                            <tr>
                                                <td><?php echo $person->Nombres ?></td>
                                                <td><?php echo $person->Apellidos ?></td>
                                                <td><?php echo $person->Correo ?></td>
                                                <td><?php echo $person->Telefono ?></td>
                                                <td><?php echo $person->rol ?></td>
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