<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                EDITAR PERFIL
                <small>Aqui puedes editar tus datos personales para mantenerte en contacto</small>
            </h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-red">
                        <h2>Editar perfil</h2>
                    </div>
                    <div class="body">
                        <form action="?controller=person&method=update" method="POST">
                            <input type="hidden" name="id" value="<?php echo $data[0]->id ?>">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Nombres" value="<?php echo $data[0]->nombre ?>"></input>
                                            <label class="form-label">Nombres</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control " name="Apellidos" value="<?php echo $data[0]->apellidos ?>"></input>
                                            <label class="form-label">Apellidos</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="Correo" value="<?php echo $data[0]->correo ?>"></input>
                                            <label class="form-label">Correo electronico</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control " name="Telefono" value="<?php echo $data[0]->telefono?>"></input>
                                            <label class="form-label">Telefono</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">Actualizar </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
</section>