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
                $date = explode("/", $emp_record[0]);
                //echo '<pre>';
                //var_dump($date);
                //echo '</pre>';
                $date2 = implode("-", $date);
                $dateEnd = date('d-m-Y', strtotime($date2));
                //echo $dateEnd.'<br>';
                $bill = $emp_record[3]."-".$emp_record[4]."-".$emp_record[5];
                //echo $bill.'<br>';
                $mysql_insert = "INSERT INTO `mg_facturas`(`fecha_factura`, `nit`, `vendedor`, `Numero_Factura`,`Centro_costo`, `Referencia`, `Cantidad`, `neto`, `Descripcion_Comentarios`) VALUES 
                ('".$dateEnd."',
                '".$emp_record[1]."',
                '".$emp_record[2]."',
                '".$bill."',
                '".$emp_record[4]."',
                '".$emp_record[6]."',
                '".$emp_record[7]."',
                '".$emp_record[8]."',
                '".$emp_record[9]."')";
                $sql_insert = utf8_encode($mysql_insert);
                $resultset = mysqli_query($conn, $sql_insert) or die("database error:". mysqli_error($conn));
                //echo '<pre>';
                //var_dump($resultset);
                //echo '</pre>';
				// if employee already exist then update details otherwise insert new record
                /*if(mysqli_num_rows($resultset) == 0) {
                    $date = explode("/", $emp_record[0]);
                    //echo '<pre>';
                    //var_dump($date);
                    //echo '</pre>';
                    $dateEnd = implode("-", $date);
                    //echo $dateEnd.'<br>';
                    $bill = $emp_record[3]."-".$emp_record[4]."-".$emp_record[5];
                    //echo $bill.'<br>';
                    $mysql_insert = "INSERT INTO `mg_facturas`(`fecha_factura`, `nit`, `vendedor`, `Numero_Factura`,`Centro_costo`, `Referencia`, `Cantidad`, `neto`, `Descripcion_Comentarios`) VALUES 
                    ('".$dateEnd."',
                    '".$emp_record[1]."',
                    '".$emp_record[2]."',
                    '".$bill."',
                    '".$emp_record[4]."',
                    '".$emp_record[6]."',
                    '".$emp_record[7]."',
                    '".$emp_record[8]."',
                    '".$emp_record[9]."')";
                    $sql_insert = utf8_encode($mysql_insert);
                    mysqli_query($conn, $sql_insert) or die("database error:". mysqli_error($conn));
                }*/
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