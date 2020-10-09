<?php
if (isset($_GET['term'])){
	# conectare la base de datos
	include ('conected.php');
	$db_handle = new Conected();

	$return_arr = array();

	$sqlc = "SELECT * FROM cliente WHERE Nombres like '%".$_GET['term']."%' LIMIT 5";

	$faq = $db_handle->runQuery($sqlc);

	foreach($faq as $k=>$v) {
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/		
		$row_array['value'] = $faq[$k]['Identificacion'];
		$row_array['Identificacion_Cliente']=$faq[$k]['Identificacion'];
		
		$row_array['Correo_Cliente']=$faq[$k]['Correo'];
		$row_array['Nombre_Cliente']=$faq[$k]['Nombres'];
		$row_array['Identificacion_Cliente']=$faq[$k]['Identificacion'];
		
		array_push($return_arr,$row_array);
	}
	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
}
       