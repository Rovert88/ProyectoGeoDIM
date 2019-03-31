<?php

set_time_limit(300);

require '../classes/ConexionDB.php';
require '../classes/GeneralOp.php';

$connect = new DBConnection();  //Instancia de la clase DBConnection
$selectColl = $connect->ConectarBD(); //Llamada al metodo para seleccionar la BD
$op = new GeneralOP();

if(isset($_POST['sitio'])){
    
    $idSitio = $_POST['sitio']; //Obtiene el id del sitio desde el formulario
    $tipoArchivo = $_POST['tipoarchivo']; //Obtiene el valor del rad button para elegir la coleccion a donde almacenara los datos
    $collNombreSitio = 'NOMBRE_SITIO'; //Columna a agregar a los nombres de campos del csv
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
        'application/x-www-form-urlencoded');    
    
    //Seleccionar la coleccion segun el tipo de archivo seleccionado
    switch ($tipoArchivo){
        case "f_si":
            $coll = $selectColl->Registros_Sondas_Inspeccion;
            break;
        case "f_bcg":
            $coll = $selectColl->Registros_Bombas_Calor_Geotermico;
            break;
        case "f_bcr800":
            $coll = $selectColl->Registros_Bateria_CR800;
            break;
    }
    
    if(in_array($_FILES['csv']['type'], $mime_types)){
        if(move_uploaded_file($_FILES['csv']['tmp_name'], $archivocargado)){
            echo 'Archivo cargado correctamente<br>';
            echo mime_content_type($archivocargado).'<br>';
            echo "<br>".$tipoArchivo."<br><br>";
            echo "<br>".$coll."<br><br>";
        }
        
        //Abrir el archivo
        if(($gestor = fopen($archivocargado, "r")) !== FALSE){
            $indiceFila = 0;
            
            $nombresCampos = fgetcsv($gestor, 1000, ","); //Leer los nombres de las columnas para asignarlos como nombres de campos
            array_push($nombresCampos, $collNombreSitio); //Insertar la columna NOMBRE_SITIO al arreglo de nombres de campos del csv
            
            while(($datos = fgetcsv($gestor, 1000, ",")) !== FALSE){
                
                array_push($datos, $idSitio); //Insertar el id del sitio en el array de los datos del csv
                $registros = array_combine($nombresCampos, $datos); //Combina los nombres de los campos con los datos del csv
                $registros["TIMESTAMP"] = new MongoDB\BSON\UTCDateTime(strtotime($op->insFormatoFecha($registros["TIMESTAMP"]))*1000); //Actualizar el tipo de dato de "TIMESTAMP" a Date para MongoDB
                print_r($registros);
                $coll->insertOne($registros);
                
            }
            fclose($gestor);
            echo 'Inserción de datos correcta';
        }else{
            var_dump($_FILES);
            echo '<br>';
            echo mime_content_type($archivocargado).'<br>';
            echo 'Archivo no valido, cargue un archivo CSV';
        }
    }
}
