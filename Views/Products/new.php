<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                REGISTRAR NUEVO PRODUCTO
                <small>Aqui puedes registrar un nuevo producto que este enel catalogo de la empresa</small>
            </h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Registrar nuevo producto</h2>
                    </div>
                    <div class="body">
                        <form action="?controller=product&method=save" method="POST">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Codigo del producto</label>
                                            <input type="number" class="form-control" name="Codigo" value="<?php echo rand('1236547','2');?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Descripción producto</label>
                                            <textarea rows="4" name="Nombre" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger"> Registrar producto </button>
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