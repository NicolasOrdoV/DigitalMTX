<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Garantias</h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Ingresar Garantías
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
                        <h2 class="card-inside-title">Ingresar Garantías</h2>
                        <form action="?controller=garanty&method=save" method="POST">
                            <input type="hidden" name="id_Personal" value="<?php echo $_SESSION['user']->id ?>">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Nombre_Cliente">
                                            <label class="form-label">Nombre</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="Telefono_Cliente">
                                            <label class="form-label">Telefono</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="Correo_Cliente">
                                            <label class="form-label">Correo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Direccion_Cliente">
                                            <label class="form-label">Direccion</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Cliente"></textarea>
                                            <label class="form-label">Observacion Cliente</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Empleado"></textarea>
                                            <label class="form-label">Observacion Empleado</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label class="form-label">Aprobacion Garantía</label>
                                            <div class="demo-radio-button">
                                                <input name="Aprobacion_Garantia" type="radio" id="radio_7" class="radio-col-red" value="SI" checked />
                                                <label for="radio_7">SI</label>
                                                <input name="Aprobacion_Garantia" type="radio" id="radio_8" class="radio-col-red" value="NO" checked />
                                                <label for="radio_8">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">Guardar</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
            <!-- Textarea -->
            <!--#END# Switch Button -->
        </div>
</section>