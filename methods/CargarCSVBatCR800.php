<?php

require '../classes/ConexionDB.php';
require '../classes/GeneralOp.php';

$connect = new DBConnection();
$traerColl = $connect->ConectarBD();
$nombreColl = $connect->PreparaCollArchivosBatCR800($_POST['sitio']);
$coll = $traerColl->$nombreColl;
$op = new GeneralOp();

if(isset($_POST['sitio'])){
    
    $idSitio = $_POST['sitio'];
    $ficherocarga = '/';
    $archivocargado = $ficherocarga . basename($_FILES['csv']['name']);
    $mime_types = array(
        'text/plain',
        'application/vnd.ms-excel',
        'application/vnd.msexcel',
        'text/csv',
        'application/csv', 
        'text/comma-separated-values',          
        'application/octet-stream', 
        'text/tab-separated-values',
        'text/tsv',
        'application/x-csv',
        ' application/x-www-form-urlencoded');
    $arrayDatos = array();

    if(in_array($_FILES['csv']['type'], $mime_types)){
        if(move_uploaded_file($_FILES['csv']['tmp_name'], $archivocargado)){
            echo 'Archivo cargado correctamente<br>';
            echo mime_content_type($archivocargado).'<br>';
        }
        
        if(($gestor = fopen($archivocargado, "r")) !== FALSE){
            $indiceFila = 0;
            
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE){
                if($indiceFila > 0){
                    $arrayDatos = [
                        "NombreSitio"=>$idSitio,
                        "Fecha_HoraRegistro"=> new MongoDB\BSON\UTCDateTime(strtotime($op->insFormatoFecha($datos[0]))*1000),
                        "Record"=>$datos[1],
                        "BattV_Min"=>$datos[2],
                    ];
                    print_r($arrayDatos);
                    $coll->insertOne($arrayDatos);
                }
                $indiceFila++;
            }
            fclose($gestor);
            echo 'Inserción de datos correcta';
        }
    }else{
        var_dump($_FILES);
        echo '<br>';
        echo mime_content_type($archivocargado).'<br>';
        echo 'Archivo no valido, cargue un archivo CSV';
    }
}
