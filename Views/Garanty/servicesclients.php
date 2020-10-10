<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = htmlspecialchars(trim($_POST["Identificacion_Cliente"]));
 
    // Codigo para buscar en tu base de datos acá
 
 
    $mysqli=new mysqli("localhost","root","","digitalmtx");
 
    $sqlsi = "SELECT id,Correo,Nombres FROM cliente  WHERE  Identificacion  = '$identificacion'";
    $resultado = $mysqli->query($sqlsi);
	$fila = $resultado->fetch_assoc();
    
    $datos[]=$fila['id'].",".$fila['Correo'].",".$fila['Nombres'];
    echo json_encode($datos);

} else {
    echo "<p>No se encontro el nombre en la DB!!</p>";
}