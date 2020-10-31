<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    MI PERFIL
                    <small>Aqui puedes visualizar tu perfil y puedes editar tus datos de contacto</small>
                </h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-red row">
                            <div class="col-sm-6">
                                <h2>Mi perfil</h2>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="?controller=person&method=edit&id=<?php echo $data[0]->id?>" class="btn btn-warning">Editar</a>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h5>Nombres:</h5>
                                    <p><?php echo $data[0]->nombre?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Apellidos:</h5>
                                    <p><?php echo $data[0]->apellidos?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Correo electronico:</h5>
                                    <p><?php echo $data[0]->correo?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Telefono:</h5>
                                    <p><?php echo $data[0]->telefono?></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <a href="?controller=person&method=editPass" class="btn btn-warning">Cambiar contraseña</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
