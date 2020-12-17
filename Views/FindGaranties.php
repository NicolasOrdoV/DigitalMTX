<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Digital MTX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="Assets/img/logo-rojo.png">
</head>

<body>
    <main class="container-fluid">
	    <section class="row mt-3">
	        <div class="card w-100 m-auto">
	            <div class="card-header bg-danger container-fluid">
	                <h2 class="m-auto">
	                	<a href="?controller=login" class="btn btn-danger"><<</a>Consultar garantia
	                </h2>
	            </div>
	            <div class="card-body w-100">
	            	<form action="?controller=client&method=show" method="POST">
	            		<div class="form-group">
		                    <label> Nombre</label>
		                    <input type="text" name="bill" class="form-control" placeholder="Ingrese el consecutivo asignado de garantia(G-...)" required>
		                    <div class="invalid-feedback">Por favor no dejar campos vacios.</div>
		                    <div class="valid-feedback">Campo validado correctamente.</div>
		                </div>
		                <div class="form-group">
		                    <button type="submit" id="submit" class="btn btn-danger">Buscar</button>
		                </div>
	            	</form>
	            </div>
	        </div>
	        <?php
	         	if(isset($data)){ 
	        		if(!empty($data)){?>
				        <div class="card w-100 m-auto">
				        	<div class="card-body w-100">
				            	<h2><b>Producto</b></h2>
				            	<br>
				            	<?php foreach($data as $show){?>
				                    <div class="row clearfix">
				                    	<div class="col-sm-12">
				                            <h3>Numero garantía</h3>
				                            <h3><?php echo $show->No_garantia?></h3>
				                        </div>
				                        <div class="col-sm-3">
				                            <h5>Codigo del producto</h5>
				                            <p><?php echo $show->Codigo_Producto?></p>
				                        </div>
				                        <div class="col-sm-3">
				                            <h5>Descripcion producto</h5>
				                            <p><?php echo $show->Descripcion_Producto?></p>
				                        </div>
				                        <div class="col-sm-3">
				                            <h5>Serial</h5>
				                            <p><?php echo $show->Sello_Producto?></p>
				                        </div>
				                        <div class="col-sm-3">
				                            <h5>Cantidad</h5>
				                            <p><?php echo $show->Cantidad_Producto?></p>
				                        </div>
				                    </div>
				                    <div class="row clearfix">
				                        <div class="col-sm-3">
				                            <h5>Flete</h5>
				                            <p><?php echo $show->Flete?></p>
				                        </div>
				                        <div class="col-sm-3">
				                            <h5>Ciudad</h5>
				                            <p><?php echo $show->Departamento?></p>
				                        </div>
				                        <div class="col-sm-3">
				                            <h5>Municipio</h5>
				                            <p><?php echo $show->Municipio?></p>
				                        </div>
				                        <div class="col-sm-3">
				                            <h5>Valor del producto</h5>
				                            <p><?php echo $show->Valor_Flete?></p>
				                        </div>
				                    </div>
				                    <div class="row clearfix">
				                    	<div class="col-sm-12">
				                            <h1>ESTADO: <?php echo $show->Estado?></h1>
				                        </div>
				                    </div>
				                    <hr>
			                    <?php } ?>
			                    <div class="row clearfix">
			                    	<div class="col-sm-12">
			                            <h3 class="text-center">Fecha expedición: <?php echo $data[0]->Fecha_ingreso?></h3>
			                        </div>
			                    </div>
				            </div>
				        </div>
	        <?php
	            }else{ ?>
	        	<div class="alert alert-danger">
	        		<p>No se encontro ningun registro con ese consecutivo</p>
	        	</div>
	        <?php } 
	    	}?>	
	    </section>
	</main>
    <script src="Assets/js/jquery-2.2.4.min.js"></script>
    <script src="Assets/js/popper.min.js"></script>
    <script src="Assets/js/bootstrap.min.js"></script>
</body>
</html>
