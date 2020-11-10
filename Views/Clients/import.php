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
            while(($emp_record = fgetcsv($csv_file,10000,";")) !== FALSE ){

                //echo '<pre>';
                //var_dump($emp_record);
                //echo '</pre>';
                // Check if employee already exists with same email
                $sql_query = "SELECT * FROM mg_clientes WHERE IDENTIFICACION='".$emp_record[0]."'";
                $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));

                //var_dump($sql_query);
                //exit();
				// if employee already exist then update details otherwise insert new record
                $ppp = mysqli_num_rows($resultset);
                
                $numero_de_filas = $resultset->num_rows;
                //echo $numero_de_filas;
                if($numero_de_filas != 0) {           
					$sql_update = "UPDATE mg_clientes SET 
                    IDENTIFICACION = '".$emp_record[0]."',
                    SUCURSAL = '".$emp_record[1]."',
                    DIGITO_DE_VERIFICACION='".$emp_record[2]."',
                    RAZON_SOCIAL='".$emp_record[4]."',
                    PRIMER_NOMBRE='".$emp_record[5]."',
                    SEGUNDO_NOMBRE='".$emp_record[6]."',
                    PRIMER_APELLIDO='".$emp_record[7]."',
                    SEGUNDO_APELLIDO='".$emp_record[8]."',
                    NUMERO_DE_IDENTIFICACION_DEL_EXTRANJERO='".$emp_record[9]."',
                    CODIGO_IDENTIFICACION_FISCAL='".$emp_record[10]."',
                    NOMBRE_DEL_CONTACTO='".$emp_record[11]."',
                    DIRECCION='".$emp_record[12]."',
                    PAIS='".$emp_record[13]."',
                    CIUDAD='".$emp_record[14]."',
                    ACTIVO='".$emp_record[15]."',
                    TELEFONO_1='".$emp_record[16]."',
                    TELEFONO_2='".$emp_record[17]."',
                    TELEFONO_3='".$emp_record[18]."',
                    TELEFONO_4='".$emp_record[19]."',
                    TELEFONO_CELULAR='".$emp_record[20]."',
                    FAX='".$emp_record[21]."',
                    APARTADO_AEREO='".$emp_record[22]."',
                    SEXO='".$emp_record[23]."',
                    ANO_DE_CUMPLEANOS='".$emp_record[24]."',
                    MES_DE_CUMPLEANOS='".$emp_record[25]."',
                    DIA_DE_CUMPLEANOS='".$emp_record[26]."',
                    TIPO_DE_PERSONA='".$emp_record[27]."',
                    CORREO_ELECTRONICO='".$emp_record[28]."',
                    CONTACTO_DE_FACTURACION='".$emp_record[29]."',
                    CORREO_ELECT_CONTACTO_DE_FACTURACION='".$emp_record[30]."',
                    TIPO_DE_IDENTIFICACION='".$emp_record[31]."',
                    CLASIFICACION_CLASE_DE_TERCERO='".$emp_record[32]."',
                    BENEFICIO_DIAN_RETEIVA_COMPRAS='".$emp_record[33]."',
                    TARIFA_DIFERENCIAL_RETE_IVA_VENTAS='".$emp_record[34]."',
                    PORCENTAJE_DIFERENCIAL_RETE_IVA_VENTAS='".$emp_record[35]."',
                    TARIFA_DIFERENCIAL_RETE_IVA_COMPRAS='".$emp_record[36]."',
                    PORCENTAJE_DIFERENCIAL_RETE_IVA_COMPRAS='".$emp_record[37]."',
                    CUPO_DE_CREDITO='".$emp_record[38]."',
                    LISTA_DE_PRECIO='".$emp_record[39]."',
                    FORMA_DE_PAGO='".$emp_record[40]."',
                    CALIFICACION='".$emp_record[41]."',
                    TIPO_CONTRIBUYENTE='".$emp_record[42]."',
                    CODIGO_ACTIVIDAD_ECONOMICA='".$emp_record[43]."',
                    VENDEDOR='".$emp_record[44]."',
                    COBRADOR='".$emp_record[45]."',
                    PORCENTAJE_DESCUENTO_EN_VENTAS='".$emp_record[46]."',
                    PERIODO_DE_PAGO='".$emp_record[47]."',
                    OBSERVACION='".$emp_record[48]."',
                    DIAS_OPTIMISTA='".$emp_record[49]."',
                    DIAS_PESIMISTA='".$emp_record[50]."',
                    CODIGO='".$emp_record[51]."',
                    TIPO_DE_EMPRESA='".$emp_record[52]."',
                    CODIGO_DE_BANCO='".$emp_record[53]."',
                    CODIGO_INTERNO='".$emp_record[54]."',
                    CODIGO_OFICINA='".$emp_record[55]."',
                    TIPO_DE_CUENTA='".$emp_record[56]."',
                    NUMERO_DE_CUENTA='".$emp_record[57]."',
                    NIT_DEL_TITULAR_DE_LA_CUENTA='".$emp_record[58]."',
                    DIGITO_DE_VERIFICACION_TITULAR_DE_LA_CUENTA='".$emp_record[59]."',
                    NOMBRE_DEL_TITULAR_DE_LA_CUENTA_PAIS_DE_LA_CUENTA='".$emp_record[60]."',
                    CIUDAD_DE_LA_CUENTA='".$emp_record[61]."',
                    SIGLAS_DEPARTAMENTO_DE_LA_CUENTA='".$emp_record[62]."',
                    APLICA_RETENCION_ICA_FACTURA_DE_VENTA_DEVOLUCION='".$emp_record[63]."',
                    APLICA_RETENCION_ICA_FACTURA_DE_COMPRA_DEVOLUCION='".$emp_record[64]."',
                    ACEPTA_ENVIO_FACTURA_POR_MEDIO_ELECTRONICO='".$emp_record[65]."',
                    NOMBRE_COMERCIAL='".$emp_record[66]."',
                    CODIGO_POSTAL='".$emp_record[67]."',
                    RESPONSABILIDAD_FISCAL='".$emp_record[68]."',
                    ANO_APERTURA='".$emp_record[69]."',
                    MES_APERTURA='".$emp_record[70]."',
                    DIA_APERTURA='".$emp_record[71]."',
                    TRIBUTOS='".$emp_record[72]."'
                    WHERE NOMBRE='".$emp_record[3]."'";
                    mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
                }else{
                    //echo 'Entra insercion';
					$mysql_insert = "INSERT INTO `mg_clientes`(`IDENTIFICACION`, `SUCURSAL`, `DIGITO_DE_VERIFICACION`, `NOMBRE`, `RAZON_SOCIAL`, `PRIMER_NOMBRE`, `SEGUNDO_NOMBRE`, `PRIMER_APELLIDO`, `SEGUNDO_APELLIDO`, `NUMERO_DE_IDENTIFICACION_DEL_EXTRANJERO`, `CODIGO_IDENTIFICACION_FISCAL`, `NOMBRE_DEL_CONTACTO`, `DIRECCION`, `PAIS`, `CIUDAD`, `ACTIVO`, `TELEFONO_1`, `TELEFONO_2`, `TELEFONO_3`, `TELEFONO_4`, `TELEFONO_CELULAR`, `FAX`, `APARTADO_AEREO`, `SEXO`, `ANO_DE_CUMPLEANOS`, `MES_DE_CUMPLEANOS`, `DIA_DE_CUMPLEANOS`, `TIPO_DE_PERSONA`, `CORREO_ELECTRONICO`, `CONTACTO_DE_FACTURACION`, `CORREO_ELECT_CONTACTO_DE_FACTURACION`, `TIPO_DE_IDENTIFICACION`, `CLASIFICACION_CLASE_DE_TERCERO`, `BENEFICIO_DIAN_RETEIVA_COMPRAS`, `TARIFA_DIFERENCIAL_RETE_IVA_VENTAS`, `PORCENTAJE_DIFERENCIAL_RETE_IVA_VENTAS`, `TARIFA_DIFERENCIAL_RETE_IVA_COMPRAS`, `PORCENTAJE_DIFERENCIAL_RETE_IVA_COMPRAS`, `CUPO_DE_CREDITO`, `LISTA_DE_PRECIO`, `FORMA_DE_PAGO`, `CALIFICACION`, `TIPO_CONTRIBUYENTE`, `CODIGO_ACTIVIDAD_ECONOMICA`, `VENDEDOR`, `COBRADOR`, `PORCENTAJE_DESCUENTO_EN_VENTAS`, `PERIODO_DE_PAGO`, `OBSERVACION`, `DIAS_OPTIMISTA`, `DIAS_PESIMISTA`, `CODIGO`, `TIPO_DE_EMPRESA`, `CODIGO_DE_BANCO`, `CODIGO_INTERNO`, `CODIGO_OFICINA`, `TIPO_DE_CUENTA`, `NUMERO_DE_CUENTA`, `NIT_DEL_TITULAR_DE_LA_CUENTA`, `DIGITO_DE_VERIFICACION_TITULAR_DE_LA_CUENTA`, `NOMBRE_DEL_TITULAR_DE_LA_CUENTA_PAIS_DE_LA_CUENTA`, `CIUDAD_DE_LA_CUENTA`, `SIGLAS_DEPARTAMENTO_DE_LA_CUENTA`, `APLICA_RETENCION_ICA_FACTURA_DE_VENTA_DEVOLUCION`, `APLICA_RETENCION_ICA_FACTURA_DE_COMPRA_DEVOLUCION`, `ACEPTA_ENVIO_FACTURA_POR_MEDIO_ELECTRONICO`, `NOMBRE_COMERCIAL`, `CODIGO_POSTAL`, `RESPONSABILIDAD_FISCAL`, `ANO_APERTURA`, `MES_APERTURA`, `DIA_APERTURA`, `TRIBUTOS`) VALUES
                        ('".$emp_record[0]."', 
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