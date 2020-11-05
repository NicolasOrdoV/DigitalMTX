<?php
include_once("db_connect.php");
if(isset($_POST['import_data'])){    
    // validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){   
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');           
            //fgetcsv($csv_file);            
            // get data records from csv file
            while(($emp_record = fgetcsv($csv_file)) !== FALSE){

                //echo '<pre>';
                //var_dump($emp_record);
                //echo '</pre>';
                // Check if employee already exists with same email
                $sql_query = "SELECT id,Numero_Factura, fecha_factura, nit, hora_factura,
                Nombre_Cliente, Identificacion_Cliente, Correo_Cliente, Direccion_Cliente, Centro_costo,
                Codigo_Producto,Codigo_Proveedor, Descripcion_Producto, Referencia_Producto,Cantidad, Sello_Producto, Marca_Producto
                FROM mg_facturas WHERE Sello_Producto = '".$emp_record[14]."'";
                $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
				// if employee already exist then update details otherwise insert new record
                if(mysqli_num_rows($resultset)) {                     
					$sql_update = "UPDATE mg_facturas set id = '".$emp_record[0]."',
                    Numero_Factura = '".$emp_record[1]."',
                    fecha_factura='".$emp_record[2]."',
                    nit='".$emp_record[3]."',
                    hora_factura='".$emp_record[4]."',
                    Nombre_Cliente='".$emp_record[5]."',
                    Identificacion_Cliente='".$emp_record[6]."',
                    Correo_Cliente='".$emp_record[7]."',
                    Direccion_Cliente='".$emp_record[8]."',
                    Centro_costo='".$emp_record[9]."',
                    Codigo_Producto='".$emp_record[10]."',
                    Codigo_Proveedor='".$emp_record[11]."',
                    Descripcion_Producto='".$emp_record[12]."',
                    Referencia_Producto='".$emp_record[13]."',
                    Cantidad='".$emp_record[14]."',
                    Marca_Producto='".$emp_record[16]."' 
                    WHERE Sello_Producto = '".$emp_record[15]."'";
                    mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
                } else{
					$mysql_insert = "INSERT INTO mg_facturas (id,Numero_Factura, fecha_factura, nit, hora_factura,
                    Nombre_Cliente, Identificacion_Cliente, Correo_Cliente, Direccion_Cliente, Centro_costo,
                    Codigo_Producto,Codigo_Proveedor, Descripcion_Producto, Referencia_Producto, Cantidad, Sello_Producto, Marca_Producto )
                    VALUES('".$emp_record[0]."', '".$emp_record[1]."', '".$emp_record[2]."', '".$emp_record[3]."',
                    '".$emp_record[4]."', '".$emp_record[5]."', '".$emp_record[6]."', '".$emp_record[7]."',
                    '".$emp_record[8]."', '".$emp_record[9]."', '".$emp_record[10]."', '".$emp_record[11]."',
                    '".$emp_record[12]."', '".$emp_record[13]."', '".$emp_record[14]."', '".$emp_record[15]."','".$emp_record[16]."')";
					mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
                }
            }            
            fclose($csv_file);
            $import_status = '?import_status=success';
        } else {
            $import_status = '?import_status=error';
        }
    } else {
        $import_status = '?import_status=invalid_file';
    }
}
echo '<script>
window.location = "../../?controller=bill";
</script>';