<?php
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
    $arrayDatos = array();
    
    //Seleccionar la coleccion segun el tipo de archivo seleccionado
    switch ($tipoArchivo){
        case "f_si":
            $coll = $selectColl->Registros_Sondas_Inspeccion2;
            break;
        case "f_bcg":
            $coll = $selectColl->Registros_Bombas_Calor_Geotermico2;
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
                
                
//                if($indiceFila > 0){
//                    $arrayDatos = [
//                        "NombreSitio"=>$idSitio,
//                        "Fecha_HoraRegistro"=> new MongoDB\BSON\UTCDateTime(strtotime($op->insFormatoFecha($datos[0]))*1000),
//                        "Record"=>$datos[1],
//                        "Temp_Amb"=>$datos[2],
//                        "T0_avg"=>$datos[3],
//                        "T0_max"=>$datos[4],
//                        "T0_min"=>$datos[5],
//                        "T1_avg"=>$datos[6],
//                        "T1_max"=>$datos[7],
//                        "T1_min"=>$datos[8],
//                        "T2_avg"=>$datos[9],
//                        "T2_max"=>$datos[10],
//                        "T2_min"=>$datos[11],
//                        "T3_avg"=>$datos[12],
//                        "T3_max"=>$datos[13],
//                        "T3_min"=>$datos[14],
//                        "T4_avg"=>$datos[15],
//                        "T4_max"=>$datos[16],
//                        "T4_min"=>$datos[17],
//                        "T5_avg"=>$datos[18],
//                        "T5_max"=>$datos[19],
//                        "T5_min"=>$datos[20],
//                        "T6_avg"=>$datos[21],
//                        "T6_max"=>$datos[22],
//                        "T6_min"=>$datos[23],
//                        "T7_avg"=>$datos[24],
//                        "T7_max"=>$datos[25],
//                        "T7_min"=>$datos[26],
//                        "T75_avg"=>$datos[27],
//                        "T75_max"=>$datos[28],
//                        "T75_min"=>$datos[29],  
//                    ];
//                    print_r($arrayDatos);
//                    $coll->insertOne($arrayDatos);
//                }
//                $indiceFila++;
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
