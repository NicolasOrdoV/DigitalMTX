<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Digital MTX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="Assets/img/logo-rojo.png">
    <link rel="stylesheet" type="text/css" href="Assets/css/styleLogin.css">
</head>

<body>
    <main class="container">
	    <section class="row mt-5">
	        <div class="card w-100 m-auto">
	            <div class="card-header bg-danger container">
	                <h2 class="m-auto">
	                	<a href="?controller=login" class="btn btn-danger"><<</a>Consultar pelicula
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
	        <?php if(isset($bill)){ ?>
		        <div class="card w-100 m-auto">
		        	<div class="card-body w-100">
		            	<h2>Producto</h2>
	                    <div class="row clearfix">
	                        <div class="col-sm-3">
	                            <h5>Codigo del producto</h5>
	                            <p><?php echo $data[0]->Codigo_Producto?></p>
	                        </div>
	                        <div class="col-sm-3">
	                            <h5>Descripcion producto</h5>
	                            <p><?php echo $data[0]->Descripcion_Producto?></p>
	                        </div>
	                        <div class="col-sm-3">
	                            <h5>Serial</h5>
	                            <p><?php echo $data[0]->Sello_Producto?></p>
	                        </div>
	                        <div class="col-sm-3">
	                            <h5>Cantidad</h5>
	                            <p><?php echo $data[0]->Cantidad_Producto?></p>
	                        </div>
	                    </div>
	                    <div class="row clearfix">
	                        <div class="col-sm-3">
	                            <h5>Flete</h5>
	                            <p><?php echo $data[0]->Flete?></p>
	                        </div>
	                        <div class="col-sm-3">
	                            <h5>Ciudad</h5>
	                            <p><?php echo $data[0]->Departamento?></p>
	                        </div>
	                        <div class="col-sm-3">
	                            <h5>Municipio</h5>
	                            <p><?php echo $data[0]->Municipio?></p>
	                        </div>
	                        <div class="col-sm-3">
	                            <h5>Valor del producto</h5>
	                            <p><?php echo $data[0]->Valor_Flete?></p>
	                        </div>
	                    </div>
	                    <div class="row clearfix">
	                    	<div class="col-sm-12">
	                            <h5>ESTADO</h5>
	                            <p><?php echo $data[0]->Estado?></p>
	                        </div>
	                    </div>
		            </div>
		        </div>
	        <?php } ?>
	    </section>
	</main>
    <script src="Assets/js/jquery-2.2.4.min.js"></script>
    <script src="Assets/js/popper.min.js"></script>
    <script src="Assets/js/bootstrap.min.js"></script>
</body>
</html>
