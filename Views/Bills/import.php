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
            while(($emp_record = fgetcsv($csv_file,10000,";")) !== FALSE){
                //echo '<pre>';
                //var_dump($emp_record);
                //echo '</pre>';
                // Check if employee already exists with same email
                $sql_query = "SELECT `Numero_Factura`, `fecha_factura`, `nit`, `hora_factura`, `Centro_costo`, `Codigo_Producto`, `Descripcion_Producto`, `Referencia_Producto`, `Cantidad`, `Sello_Producto`, `Marca_Producto` FROM `mg_facturas` WHERE Sello_Producto = '".$emp_record[9]."'";
                $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
				// if employee already exist then update details otherwise insert new record
                if(mysqli_num_rows($resultset)) {
                    $id = explode(".", $emp_record[2]);
                    $ide = implode("", $id);                     
					$sql_update = "UPDATE mg_facturas set Numero_Factura = '".$emp_record[0]."',
                    fecha_factura='".$emp_record[1]."',
                    nit='".$ide."',
                    hora_factura='".$emp_record[3]."',
                    Centro_costo='".$emp_record[4]."',
                    Codigo_Producto='".$emp_record[5]."',
                    Descripcion_Producto='".$emp_record[6]."',
                    Referencia_Producto='".$emp_record[7]."',
                    Cantidad='".$emp_record[8]."',
                    Marca_Producto='".$emp_record[10]."' 
                    WHERE Sello_Producto = '".$emp_record[9]."'";
                    mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
                } else{
                    $id = explode(".", $emp_record[2]);
                    $ide = implode("", $id);
					$mysql_insert = "INSERT INTO mg_facturas (Numero_Factura, fecha_factura, nit, hora_factura,Centro_costo,
                    Codigo_Producto, Descripcion_Producto, Referencia_Producto, Cantidad, Sello_Producto, Marca_Producto )
                    VALUES('".$emp_record[0]."',
                    '".$emp_record[1]."',
                    '".$ide."',
                    '".$emp_record[3]."',
                    '".$emp_record[4]."', 
                    '".$emp_record[5]."', 
                    '".$emp_record[6]."', 
                    '".$emp_record[7]."',
                    '".$emp_record[8]."', 
                    '".$emp_record[9]."', 
                    '".$emp_record[10]."')";
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