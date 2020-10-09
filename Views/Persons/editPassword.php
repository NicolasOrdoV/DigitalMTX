<section class="content">
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-red">
                        <h2>Cambiar Contraseña</h2>
                    </div>
                    <div class="body">
                        <form action="?controller=person&method=updatePass" method="POST">
                            <?php if (isset($error['errorMessage'])) {?>
                                <div class="alert alert-danger"><?php echo $error['errorMessage']; ?></div>
                            <?php } ?>
                            <input type="hidden" name="id" value="<?php echo $data[0]->id ?>">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="Contrasena"></input>
                                            <label class="form-label">Nueva Contraseña</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control " name="Confirmacion"></input>
                                            <label class="form-label">Confirmar Contraseña</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger"> Actualizar </button>
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