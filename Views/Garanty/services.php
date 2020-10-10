<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = htmlspecialchars(trim($_POST["Codigo_Producto"]));
 
    // Codigo para buscar en tu base de datos acá
 
 
    $mysqli=new mysqli("localhost","root","","digitalmtx");
 
    $sqlsi = "SELECT id,Nombre FROM productos WHERE  Codigo  = '$code'";
    $resultado = $mysqli->query($sqlsi);
	$fila = $resultado->fetch_assoc();
 

    $datos[]=$fila['id'].",".$fila['Nombre'];
    echo json_encode($datos);
 
} else {
    echo "<p>No se encontro el nombre en la DB!!</p>";
}