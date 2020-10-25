<?php 
$conexion=mysqli_connect('localhost','root','','digitalmtx_dtmmtx');
$municipio=$_POST['Municipio'];

	$sql="SELECT d.id,d.Departamento,m.Municipio FROM mg_departamentos d , mg_municipio m
                WHERE d.id = m.id_departamento AND d.Departamento = $municipio";

	$result=mysqli_query($conexion,$sql);

	$cadena="<p>
                <b>Municipio</b>
            </p>
            <input list='strets' id='lista2' name='Municipio' placeholder='Busca el municipio*' required>
                    <datalist id='strets'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option>' .$ver[2].'-'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</datalist><div class='valid-feedback'>Valido".var_dump($result)."</div>";