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
                                    <form action="?controller=person&method=save" method="POST" id="form-validation">
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" name="id" class="form-control" value="<?php echo $totalPersons+2?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="nombre" class="form-control" placeholder="Nombres" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select name="tipodoc" class="form-control" required>
                                                            <option value="">Tipo de documento...</option>
                                                            <option value="AS"> Adulto sin identidad</option>
                                                            <option value="CC"> Cédula de ciudadanía</option>
                                                            <option value="CE"> Cédula de extranjería</option>
                                                            <option value="MS"> Menor sin identificación</option>
                                                            <option value="PA"> Pasaporte</option>
                                                            <option value="RC"> Registro Civil</option>
                                                            <option value="TI"> Tarjeta de identidad</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" name="identificacion" class="form-control" placeholder="Identificación" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" name="correo" class="form-control" placeholder="Correo" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" name="telefono" class="form-control" placeholder="Telefono" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select name="genero" class="form-control" required>
                                                            <option value="">Genero...</option>
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Femenino">Femenino</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="sucursal" class="form-control" placeholder="Sucursal" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">    
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select name="cargo" class="form-control" required>
                                                            <option value="">Cargo...</option>
                                                            <?php foreach ($roles as $rol) { ?>
                                                                <option value="<?php echo $rol->cargo ?>"><?php echo $rol->cargo ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>Fecha de nacimiento</label>
                                                        <input type="date" name="fechanac" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>Contraseña</label>
                                                        <input type="password" name="password" class="form-control" value="<?php echo rand('123456789','2');?>" readonly/>
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
