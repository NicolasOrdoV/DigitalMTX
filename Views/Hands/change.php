<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                <a href="?controller=garanty&method=listGaranty" class="btn btn-danger"><<</a>
                CAMBIO DE SELLOS DE FACTURA
                <small>Aqui puedes cambiar el sello de un producto cuando este no aplica a garantia</small>
            </h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                <div class="card">
                    <div class="header">
                        <h2>
                            Buscar facturas
                        </h2>
                    </div>
                    <div class="body">
                        <form action="?controller=handtohand&method=findBill" method="POST">
                            <div class="row clearfix">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Numero_Factura o sello del producto actual</label>
                                            <input type="text" class="form-control" name="NumFactura" required autofocus value="<?php echo isset($_POST['NumFactura']) ? $_POST['NumFactura'] : '' ?>">
                                        </div>
                                        <?php if(isset($error)){ ?>
                                            <div class="text-danger"><?php echo $error['error']?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-float">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger my-3">Buscar</button>
                                        </div>
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
        <?php if(isset($bills)){
            if(!empty($bills)){?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                <div class="card">
                    <div class="body">
                        <form action="?controller=handtohand&method=saveStamp" method="POST">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h5>NIT</h5>
                                    <p><?php echo $bills[0]->nit?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Nombre del cliente</h5>
                                    <p><?php echo $bills[0]->Nombre_Cliente?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Descripcion producto</h5>
                                    <p><?php echo $bills[0]->nombre?></p>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Sello</h5>
                                    <p><?php echo $bills[0]->Descripcion_Comentarios?></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" name="id" value="<?php echo $bills[0]->idF?>">
                                            <input type="text" class="form-control" name="Descripcion_Comentarios" required placeholder="Nuevo sello">
                                        </div>
                                    </div>
                                    <button class="btn btn-danger">Guardar</button>
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
            <?php }else{ ?>
                <div class="alert alert-danger">No se encuentra la factura en la base de datos</div>
        <?php } }?>
</section>
