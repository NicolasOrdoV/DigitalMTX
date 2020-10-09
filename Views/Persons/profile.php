<section class="content">
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>Mi perfil<a href="?controller=person&method=edit&id=<?php echo $data[0]->id?>" class="btn btn-warning">Editar</a></h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h5>No garantia</h5>
                                    <p><?php echo $data[0]->Nombres?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Fecha de garantia</h5>
                                    <p><?php echo $data[0]->Apellidos?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>hora de garantia</h5>
                                    <p><?php echo $data[0]->Correo?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Numero de factura</h5>
                                    <p><?php echo $data[0]->Telefono?></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <a href="?controller=person&method=editPass&id=<?php echo $data[0]->id?>" class="btn btn-warning">Cambiar contraseña</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
