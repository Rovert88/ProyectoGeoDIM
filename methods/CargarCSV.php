<?php

require_once '../classes/ConexionDB.php';
require '../classes/GeneralOp.php';

$connect = new DBConnection();
$collection = $connect->UpCSVSIConn();
$op = new GeneralOP();

if(isset($_POST['cargar'])){
    $ficherocarga = '/';
    $archivocargado = $ficherocarga . basename($_FILES["archivo"]["name"]);
    $mime_types = array('application/vnd.ms-excel','text/plain','text/csv',);
        
        if(in_array($_FILES["archivo"]["type"], $mime_types)){
            if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivocargado)){
                echo "Archivo cargado correctamente";
            }
            
            if(($gestor = fopen($archivocargado, "r")) !== FALSE){
                $cont = 0;
                $array = array();
                while(!feof($gestor)){
                    $datos = fgetcsv($gestor, 1000, ",");
                    if($cont > 0){
                        $array = [
                            "Fecha_HoraRegistro"=> new MongoDB\BSON\UTCDateTime(strtotime($op->insFormatoFecha($datos[0]))*1000),
                            "Record"=>$datos[1],
                            "Temp_Amb"=>$datos[2],
                            "T0_avg"=>$datos[3],
                            "T0_max"=>$datos[4],
                            "T0_min"=>$datos[5],
                            "T1_avg"=>$datos[6],
                            "T1_max"=>$datos[7],
                            "T1_min"=>$datos[8],
                            "T2_avg"=>$datos[9],
                            "T2_max"=>$datos[10],
                            "T2_min"=>$datos[11],
                            "T3_avg"=>$datos[12],
                            "T3_max"=>$datos[13],
                            "T3_min"=>$datos[14],
                            "T4_avg"=>$datos[15],
                            "T4_max"=>$datos[16],
                            "T4_min"=>$datos[17],
                            "T5_avg"=>$datos[18],
                            "T5_max"=>$datos[19],
                            "T5_min"=>$datos[20],
                            "T6_avg"=>$datos[21],
                            "T6_max"=>$datos[22],
                            "T6_min"=>$datos[23],
                            "T7_avg"=>$datos[24],
                            "T7_max"=>$datos[25],
                            "T7_min"=>$datos[26],
                            "T75_avg"=>$datos[27],
                            "T75_max"=>$datos[28],
                            "T75_min"=>$datos[29],
                                ];
                        print_r($array);
                        $collection->insertOne($array);
                    }
                    $cont++;
                }
                fclose($gestor);
                echo "Iserción de datos correcta";
            }
        }else{
            echo "Archivo no válido, cargue un archivo CSV";
        }
}
