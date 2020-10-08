<?php 
$conexion=mysqli_connect('localhost','root','','digitalmtx');
$identificacion=$_POST['Identificacion'];

	$sql="SELECT Identificacion FROM cliente
                WHERE id = {$identificacion}";

	$result=mysqli_query($conexion,$sql);

	while ($ver=mysqli_fetch_row($result)) {
		$cadena = '<input type="text" id="lista2" class="form-control" name="Identificacion_Cliente" value='.$ver[0].'-'.utf8_encode($ver[0]).'/>';
	}
       