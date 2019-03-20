<?php

require '../classes/ConexionDB.php';
require '../classes/GeneralOp.php';

$connect = new DBConnection();
$selectColl = $connect->ConectarBD();
//$nombreColl = $connect->PreparaCollArchivosBCG($_POST['sitio']);
$coll = $selectColl->Registros_Bombas_Calor_Geotermico;
$op = new GeneralOp();


//Pruebas
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
                        
        if(($gestor = fopen($archivocargado, "r")) !==FALSE){
        $indiceFila = 0;

        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE){
            if($indiceFila > 0){
            $arrayDatos = [
                "NombreSitio"=>$idSitio,
                "Fecha_HoraRegistro"=>new MongoDB\BSON\UTCDateTime(strtotime($op->insFormatoFecha($datos[0]))*1000),
                "Record"=>$datos[1],
                "Bat_CR800"=>$datos[2],
                "Temp_CR800"=>$datos[3],
                "EAT_DegF"=>$datos[4],
                "LAT_DegF"=>$datos[5],
                "EWT_DegF"=>$datos[6],
                "LWT_DegF"=>$datos[7],
                "CT_Amp"=>$datos[8],
                "EAT_DegC"=>$datos[9],
                "LAT_DegC"=>$datos[10],
                "EWT_DegC"=>$datos[11],
                "LWT_DegC"=>$datos[12],
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

//if(isset($_POST['sitio'])){
//    
//    $idsitio = $_POST["sitio"];
//    $ficherocarga = '/';
//    $archivocargado = $ficherocarga . basename($_FILES["csv"]["name"]);
//    $mime_types = array(
//        'text/plain',
//        'application/vnd.ms-excel',
//        'application/vnd.msexcel',
//        'text/csv',
//        'application/csv', 
//        'text/comma-separated-values',          
//        'application/octet-stream', 
//        'text/tab-separated-values',
//        'text/tsv',
//        'application/x-csv',
//        ' application/x-www-form-urlencoded');
//    
//    if(in_array($_FILES["csv"]["type"], $mime_types)){
//        if(move_uploaded_file($_FILES["csv"]["tmp_name"], $archivocargado)){
//            echo "Archivo cargado correctamente<br>";
//            echo mime_content_type($archivocargado)."<br>";
//        }
//        
//        if(($gestor = fopen($archivocargado, "r")) !== FALSE){
//            //$cont = 0;
//            $array = array();
//            while(!feof($gestor)){
//                $datos = fgetcsv($gestor, 1000, ",");
//                
//                    $array = [
//                        "NombreSitio"=>$idsitio,
//                        "Fecha_HoraRegistro"=>new MongoDB\BSON\UTCDateTime(strtotime($op->insFormatoFecha($datos[0]))*1000),
//                        "Record"=>$datos[1],
//                        "Bat_CR800"=>$datos[2],
//                        "Temp_CR800"=>$datos[3],
//                        "EAT_DegF"=>$datos[4],
//                        "LAT_DegF"=>$datos[5],
//                        "EWT_DegF"=>$datos[6],
//                        "LWT_DegF"=>$datos[7],
//                        "CT_Amp"=>$datos[8],
//                        "EAT_DegC"=>$datos[9],
//                        "LAT_DegC"=>$datos[10],
//                        "EWT_DegC"=>$datos[11],
//                        "LWT_DegC"=>$datos[12],
//                    ];
//                    print_r($array);
//                    $collection->insertOne($array);
//                
//            }
//            fclose($gestor);
//            echo "Inserción de datos correcta";
//        }
//    }else{
//        var_dump($_FILES);
//        echo "<br>";
//        echo mime_content_type($archivocargado)."<br>";
//        echo "Archivo no válido, cargue un archivo CSV";
//    }
//}