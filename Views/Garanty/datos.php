<?php 
$conexion=mysqli_connect('localhost','root','','digitalmtx_dtmmtx');
//mysql_set_charset('utf8',$conexion);
$municipio=$_POST['Municipio'];

	$sql="SELECT d.id,d.Departamento,m.Municipio FROM mg_departamentos d , mg_municipio m
                WHERE d.id = m.id_departamento AND d.Departamento = '$municipio'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<p>
                <b>Municipio</b>
            </p>
            <div class='form-group form-float'>
            <input list='strets' id='lista2' name='Municipio' class='form-control' placeholder='Busca el municipio*'>
                    <datalist id='strets'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.utf8_encode($ver[2]).'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</datalist></div>";