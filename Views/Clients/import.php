<?php
include_once("../Bills/db_connect.php");
if(isset($_POST['import_data'])){    
    // validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){   
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');           
            //fgetcsv($csv_file);            
            // get data records from csv file
            while(($emp_record = fgetcsv($csv_file)) !== FALSE){

                echo '<pre>';
                var_dump($emp_record);
                echo '</pre>';
                // Check if employee already exists with same email
                $sql_query = "SELECT * FROM mg_clientes WHERE IDENTIFICACION = '".$emp_record[0]."'";
                $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
				// if employee already exist then update details otherwise insert new record
                if(mysqli_num_rows($resultset)) {                     
					$sql_update = "UPDATE `mg_clientes` SET 
                    SUCURSAL='".$emp_record[1]."',
                    DIGITO_DE_VERIFICACIÓN='".$emp_record[2]."',
                    NOMBRE='".$emp_record[3]."',
                    RAZÓN_SOCIAL='".$emp_record[4]."',
                    PRIMER_NOMBRE='".$emp_record[5]."',
                    SEGUNDO_NOMBRE='".$emp_record[6]."',
                    PRIMER_APELLIDO='".$emp_record[7]."',
                    SEGUNDO_APELLIDO='".$emp_record[8]."',
                    NÚMERO_DE_IDENTIFICACIÓN_DEL_EXTRANJERO='".$emp_record[9]."',
                    CÓDIGO_IDENTIFICACIÓN_FISCAL='".$emp_record[10]."',
                    NOMBRE_DEL_CONTACTO='".$emp_record[11]."',
                    DIRECCIÓN='".$emp_record[12]."',
                    PAÍS='".$emp_record[13]."',
                    CIUDAD='".$emp_record[14]."',
                    ACTIVO='".$emp_record[15]."',
                    TELÉFONO_1='".$emp_record[16]."',
                    TELÉFONO_2='".$emp_record[17]."',
                    TELÉFONO_3='".$emp_record[18]."',
                    TELÉFONO_4='".$emp_record[19]."',
                    TELÉFONO_CELULAR='".$emp_record[20]."',
                    FAX='".$emp_record[21]."',
                    APARTADO_AÉREO='".$emp_record[22]."',
                    SEXO='".$emp_record[23]."',
                    AÑO_DE_CUMPLEAÑOS='".$emp_record[24]."',
                    MES_DE_CUMPLEAÑOS='".$emp_record[25]."',
                    DÍA_DE_CUMPLEAÑOS='".$emp_record[26]."',
                    TIPO_DE_PERSONA='".$emp_record[27]."',
                    CORREO_ELECTRÓNICO='".$emp_record[28]."',
                    CONTACTO_DE_FACTURACIÓN='".$emp_record[29]."',
                    CORREO_ELECT_CONTACTO_DE_FACTURACIÓN='".$emp_record[30]."',
                    TIPO_DE_IDENTIFICACIÓN='".$emp_record[31]."',
                    CLASIFICACIÓN_CLASE_DE_TERCERO='".$emp_record[32]."',
                    BENEFICIO_DIAN_RETEIVA_COMPRAS='".$emp_record[33]."',
                    TARIFA_DIFERENCIAL_RETE_IVA_VENTAS='".$emp_record[34]."',
                    PORCENTAJE_DIFERENCIAL_RETE_IVA_VENTAS='".$emp_record[35]."',
                    TARIFA_DIFERENCIAL_RETE_IVA_COMPRAS='".$emp_record[36]."',
                    PORCENTAJE_DIFERENCIAL_RETE_IVA_COMPRAS='".$emp_record[37]."',
                    CUPO_DE_CRÉDITO='".$emp_record[38]."',
                    LISTA_DE_PRECIO='".$emp_record[39]."',
                    FORMA_DE_PAGO='".$emp_record[40]."',
                    CALIFICACIÓN='".$emp_record[41]."',
                    TIPO_CONTRIBUYENTE='".$emp_record[42]."',
                    CÓDIGO_ACTIVIDAD_ECONÓMICA='".$emp_record[43]."',
                    VENDEDOR='".$emp_record[44]."',
                    COBRADOR='".$emp_record[45]."',
                    PORCENTAJE_DESCUENTO_EN_VENTAS='".$emp_record[46]."',
                    PERÍODO_DE_PAGO='".$emp_record[47]."',
                    OBSERVACIÓN='".$emp_record[48]."',
                    DÍAS_OPTIMISTA='".$emp_record[49]."',
                    DÍAS_PESIMISTA='".$emp_record[50]."',
                    CÓDIGO='".$emp_record[51]."',
                    TIPO_DE_EMPRESA='".$emp_record[52]."',
                    CÓDIGO_DE_BANCO='".$emp_record[53]."',
                    CÓDIGO_INTERNO='".$emp_record[54]."',
                    CÓDIGO_OFICINA='".$emp_record[55]."',
                    TIPO_DE_CUENTA='".$emp_record[56]."',
                    NÚMERO_DE_CUENTA='".$emp_record[57]."',
                    NIT_DEL_TITULAR_DE_LA_CUENTA='".$emp_record[58]."',
                    DÍGITO_DE_VERIFICACIÓN_TITULAR_DE_LA_CUENTA='".$emp_record[59]."',
                    NOMBRE_DEL_TITULAR_DE_LA_CUENTA_PAÍS_DE_LA_CUENTA='".$emp_record[60]."',
                    CIUDAD_DE_LA_CUENTA='".$emp_record[61]."',
                    SIGLAS_DEPARTAMENTO_DE_LA_CUENTA='".$emp_record[62]."',
                    APLICA_RETENCIÓN_ICA_FACTURA_DE_VENTA_DEVOLUCIÓN='".$emp_record[63]."',
                    APLICA_RETENCIÓN_ICA_FACTURA_DE_COMPRA_DEVOLUCIÓN='".$emp_record[64]."',
                    ACEPTA_ENVÍO_FACTURA_POR_MEDIO_ELECTRÓNICO='".$emp_record[65]."',
                    NOMBRE_COMERCIAL='".$emp_record[66]."',
                    CODIGO_POSTAL='".$emp_record[67]."',
                    RESPONSABILIDAD_FISCAL='".$emp_record[68]."',
                    AÑO_APERTURA='".$emp_record[69]."',
                    MES_APERTURA='".$emp_record[70]."',
                    DIA_APERTURA='".$emp_record[71]."',
                    TRIBUTOS='".$emp_record[72]."',
                    WHERE IDENTIFICACION = '".$emp_record[0]."'";
                    mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
                }else{
					$mysql_insert = "INSERT INTO mg_clientes(IDENTIFICACION, SUCURSAL, DIGITO_DE_VERIFICACIÓN, NOMBRE, RAZÓN_SOCIAL, PRIMER_NOMBRE, SEGUNDO_NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, NÚMERO_DE_IDENTIFICACIÓN_DEL_EXTRANJERO, CÓDIGO_IDENTIFICACIÓN_FISCAL, NOMBRE_DEL_CONTACTO, DIRECCIÓN, PAÍS, CIUDAD, ACTIVO, TELÉFONO_1, TELÉFONO_2, TELÉFONO_3, TELÉFONO_4, TELÉFONO_CELULAR, FAX, APARTADO_AÉREO, SEXO, AÑO_DE_CUMPLEAÑOS, MES_DE_CUMPLEAÑOS, DÍA_DE_CUMPLEAÑOS, TIPO_DE_PERSONA, CORREO_ELECTRÓNICO, CONTACTO_DE_FACTURACIÓN, CORREO_ELECT_CONTACTO_DE_FACTURACIÓN, TIPO_DE_IDENTIFICACIÓN, CLASIFICACIÓN_CLASE_DE_TERCERO, BENEFICIO_DIAN_RETEIVA_COMPRAS, TARIFA_DIFERENCIAL_RETE_IVA_VENTAS, PORCENTAJE_DIFERENCIAL_RETE_IVA_VENTAS, TARIFA_DIFERENCIAL_RETE_IVA_COMPRAS, PORCENTAJE_DIFERENCIAL_RETE_IVA_COMPRAS, CUPO_DE_CRÉDITO, LISTA_DE_PRECIO, FORMA_DE_PAGO, CALIFICACIÓN, TIPO_CONTRIBUYENTE,CÓDIGO_ACTIVIDAD_ECONÓMICA, VENDEDOR, COBRADOR, PORCENTAJE_DESCUENTO_EN_VENTAS, PERÍODO_DE_PAGO, OBSERVACIÓN, DÍAS_OPTIMISTA, DÍAS_PESIMISTA, CÓDIGO, TIPO_DE_EMPRESA, CÓDIGO_DE_BANCO, CÓDIGO_INTERNO, CÓDIGO_OFICINA, TIPO_DE_CUENTA, NÚMERO_DE_CUENTA, NIT_DEL_TITULAR_DE_LA_CUENTA, DÍGITO_DE_VERIFICACIÓN_TITULAR_DE_LA_CUENTA, NOMBRE_DEL_TITULAR_DE_LA_CUENTA_PAÍS_DE_LA_CUENTA, CIUDAD_DE_LA_CUENTA, SIGLAS_DEPARTAMENTO_DE_LA_CUENTA, APLICA_RETENCIÓN_ICA_FACTURA_DE_VENTA_DEVOLUCIÓN, APLICA_RETENCIÓN_ICA_FACTURA_DE_COMPRA_DEVOLUCIÓN, ACEPTA_ENVÍO_FACTURA_POR_MEDIO_ELECTRÓNICO, NOMBRE_COMERCIAL, CODIGO_POSTAL, RESPONSABILIDAD_FISCAL, AÑO_APERTURA, MES_APERTURA, DIA_APERTURA, TRIBUTOS) VALUES('".$emp_record[0]."', 
                        '".$emp_record[1]."', 
                        '".$emp_record[2]."', 
                        '".$emp_record[3]."',
                        '".$emp_record[4]."', 
                        '".$emp_record[5]."', 
                        '".$emp_record[6]."', 
                        '".$emp_record[7]."',
                        '".$emp_record[8]."', 
                        '".$emp_record[9]."', 
                        '".$emp_record[10]."', 
                        '".$emp_record[11]."',
                        '".$emp_record[12]."', 
                        '".$emp_record[13]."', 
                        '".$emp_record[14]."', 
                        '".$emp_record[15]."',
                        '".$emp_record[16]."',
                        '".$emp_record[17]."',
                        '".$emp_record[18]."',
                        '".$emp_record[19]."',
                        '".$emp_record[20]."',
                        '".$emp_record[21]."',
                        '".$emp_record[22]."',
                        '".$emp_record[23]."',
                        '".$emp_record[24]."',
                        '".$emp_record[25]."',
                        '".$emp_record[26]."',
                        '".$emp_record[27]."',
                        '".$emp_record[28]."',
                        '".$emp_record[29]."',
                        '".$emp_record[30]."',
                        '".$emp_record[31]."',
                        '".$emp_record[32]."',
                        '".$emp_record[33]."',
                        '".$emp_record[34]."',
                        '".$emp_record[35]."',
                        '".$emp_record[36]."',
                        '".$emp_record[37]."',
                        '".$emp_record[38]."',
                        '".$emp_record[39]."',
                        '".$emp_record[40]."',
                        '".$emp_record[41]."',
                        '".$emp_record[42]."',
                        '".$emp_record[43]."',
                        '".$emp_record[44]."',
                        '".$emp_record[45]."',
                        '".$emp_record[46]."',
                        '".$emp_record[47]."',
                        '".$emp_record[48]."',
                        '".$emp_record[49]."',
                        '".$emp_record[50]."',
                        '".$emp_record[51]."',
                        '".$emp_record[52]."',
                        '".$emp_record[53]."',
                        '".$emp_record[54]."',
                        '".$emp_record[55]."',
                        '".$emp_record[56]."',
                        '".$emp_record[57]."',
                        '".$emp_record[58]."',
                        '".$emp_record[59]."',
                        '".$emp_record[60]."',
                        '".$emp_record[61]."',
                        '".$emp_record[62]."',
                        '".$emp_record[63]."',
                        '".$emp_record[64]."',
                        '".$emp_record[65]."',
                        '".$emp_record[66]."',
                        '".$emp_record[67]."',
                        '".$emp_record[68]."',
                        '".$emp_record[69]."',
                        '".$emp_record[70]."',
                        '".$emp_record[71]."',
                        '".$emp_record[72]."')";
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
window.location = "../../?controller=client";
</script>';