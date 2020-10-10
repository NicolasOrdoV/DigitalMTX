<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    REGISTRA EMPLEADOS
                    <small>Aqui puedes registrar al personal que atendera la empresa</small>
                </h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Registro de personal</h2>
                            <small>Aqui puedes registrar al personal que trabaja contigo en la compañia</small>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <form action="?controller=person&method=save" method="POST">
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="Nombres" class="form-control" placeholder="Nombres" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="Apellidos" class="form-control" placeholder="Apellidos" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" name="Correo" class="form-control" placeholder="Correo" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" name="Telefono" class="form-control" placeholder="Telefono" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" name="Contrasena" class="form-control" value="<?php echo rand('123456789','2');?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">    
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select name="id_rol" class="form-control">
                                                            <?php foreach ($roles as $rol) { ?>
                                                                <option value="<?php echo $rol->id ?>"><?php echo $rol->rol ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group justify-content-end">
                                            <button type="submit" class="btn btn-danger float-right">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
