
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                OPCIONES FINALES DE GARANTIAS
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
                    </div>
                    <div class="body">
                        <form action="?controller=garanty&method=saveEndDelivery" method="POST">
                            <input  type = "hidden" name="id" value="<?php echo $data[0]->id ?>">
                            <div class="row clearfix">
                                <div class="alert alert-warning">
                                    <b>NOTA:</b>
                                    <p>Se debe llenar este formulario solamente cuando se le haya entregado el producto al cliente, esto con el fin de darle la finalidad completa  a la garantia</p>
                                </div>
                                <div class="col-sm-12">
                                    <p>Estado actual: <?php echo $data[0]->Estado?></p>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Estado final</label>
                                            <select name="Estado" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="Entregado para Nota Credito">Entregado para Nota Credito</option>
                                                <option value="Entregado para cambio de producto">Entregado para cambio de producto</option>
                                                <option value="Entregado para Devolucion de Dinero">Entregado para Devolucion de Dinero</option>
                                            </select>
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
