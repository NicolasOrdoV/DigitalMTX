
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                <a href="?controller=garanty&method=solutionTechnical" class="btn btn-danger"><<</a>
                OPCIONES DE GARANTIAS
                <small>Aqui puedes registrar el registro final de la garantia</small>
            </h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Ingresar Garantía final
                        </h2>
                        <p>Observacion del tecnico</p>
                        <?php echo $data[0]->Observacion_tecnico?>
                        <p><b>Consecutivo Garantia</b></p>
                        <h1><?php echo $data[0]->No_garantia?></h1>
                    </div>
                    <div class="body"> 
                        <form action="?controller=garanty&method=saveEndGaranty" method="POST" id="form_validation">
                            <input  type = "hidden" name="id" value="<?php echo $data[0]->idD ?>">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nota Credito</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_21" class="radio-col-red" value="Pendiente para Nota Credito" onchange="javascript:ocultContent()"/>
                                            <label for="md_checkbox_21">SI</label>
                                        </div>
                                        <label>Cambio Producto</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_22" class="radio-col-red" value="Pendiente para cambio de producto" onchange="javascript:showContent()" />
                                            <label for="md_checkbox_22">SI</label>
                                        </div>
                                        <label>Devolucion Dinero</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_23" class="radio-col-red" value="Pendiente para Devolucion de Dinero" onchange="javascript:ocultContent2()" />
                                            <label for="md_checkbox_23">SI</label>
                                        </div>
                                        <label>No tiene garantia</label>
                                        <div class="demo-checkbox">
                                            <input type="radio" name="Estado" id="md_checkbox_24" class="radio-col-red" value="Pendiente para No tiene garantia" onchange="javascript:ocultContent3()"  />
                                            <label for="md_checkbox_24">SI</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix"> 
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Observacion Empleado</label>
                                            <textarea rows="4" class="form-control no-resize" name="Observacion_Final" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class ="row clearfix">
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
        </div>

    </div>
</section>
