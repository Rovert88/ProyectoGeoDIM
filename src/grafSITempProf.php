<!DOCTYPE html>
<?php
    //Generacion de graficas de datos de SI Temperatura-Profundidad

    require '../classes/ConexionDB.php';
    require '../classes/CRUD.php';
    require '../vendor/autoload.php';
    require '../classes/GeneralOp.php';

    //Conexion
    $connect = new DBConnection();
    $traerColl = $connect->ConectarBD();
    $objData = $traerColl->Registros_Sondas_Inspeccion;
    $operaciones = new CRUD($objData);
    $generalOp = new GeneralOp();
    
    //Captura de datos del formulario
    $fechasObj = $_POST['fechas'];
    $intervalo = $_POST['inter'];
    $idSitio = $_POST['sitio'];        
            

    //Formatear fechas
    $arrFechasIni = array();    
    $arrFechasFin = array();
    foreach($fechasObj as $f){
        $f_formato_ini = $generalOp->ordenaFechai($f);
        $f_formato_fin = $generalOp->ordenaFechaf($f);        
        array_push($arrFechasIni, $f_formato_ini);     //Arreglo con fechas con formato 00:00:00Z         
        array_push($arrFechasFin, $f_formato_fin);     //Arreglo con fechas con formato 23:59:59Z                 
    }
    
        
    //Obtener encabezados
    $encabezados = $generalOp->obtenerColumnas($idSitio, $operaciones);
    
    $arrEncabezados = array(); //Array para contener encabezados
        
    //Ciclo para obtener los valores de los encabezados de la BD
    foreach($encabezados as $claveEnc => $valoresEnc){
        //Comprobar si tiene un subnivel
        if(is_array($valoresEnc)){
            foreach($valoresEnc as $claveEncInt => $valorEncInt){
                array_push($arrEncabezados, $valorEncInt); //Insertar en arrEncabezados los valores encontrados en la consulta de los encabezados en la BD
            }
            echo "\n";
        }else{
            array_push($arrEncabezados, $valoresEnc); //Insertar en arrEncabezados los valores encontrados en la consulta de los encabezados en la BD
        }
    }
    
    //Obtener datos de la SI    
    $DatosFinal = array();
    $FechasFinal = array();
    $EncabezadosFinal = array();
    for($i = 0; $i < count($arrFechasIni); $i++){        
        $datos = $generalOp->consultaFechasMulti($idSitio, $arrFechasIni[$i], $arrFechasFin[$i], $operaciones);
        //Obtener las fechas-horas de los registros
        $fechas = $generalOp->consultaFechas($idSitio, $arrFechasIni[$i], $arrFechasFin[$i], $operaciones);
        $DatosFinal[$i] = $datos;
        $FechasFinal[$i] = $fechas;
        $EncabezadosFinal[$i] = $arrEncabezados;                
    }            
    
    $arrDatos = array(); //Array para contener datos (Valores de la matriz)
    $matrizDatos = array(); //Array auxiliar para guardar la combinacion del arrEncabezados con ArrDatos
    $matrizFinal = array(); //Array con todos los arreglos generados y añadidos a matrizDatos       
    $EncMatriz = array(); //Array auxiliar de encabezados                                  
    
    //Crear matriz asociativa
        //Ciclo para asociar los arreglos arrEncabezados con arrDatos        
        foreach($EncabezadosFinal as $ef){            
            $EncMatriz = $ef;            
        }

        foreach($DatosFinal as $key => $value){
            foreach($value as $k => $v){
                $matrizDatos = array_combine($EncMatriz, $v);
                array_push($matrizFinal, $matrizDatos);                                
            }
        }
    
    echo "DatosFinal: ".count($DatosFinal);
    echo "<br><br>";
    foreach ($DatosFinal as $ind => $dat){
        $total = count($dat);
        foreach($dat as $index => $data ){
            $total2 = count($data);
        }
    }
    echo "DatosFinal nivel 1: ".$total."<br><br>";    
    echo "DatosFinal interno nivel 1: ".$total2."<br><br>";
    echo "Total matrizFinal: ". count($matrizFinal);    
    echo '<pre>';
    print_r($matrizFinal);
//    echo "<br><br>";
    

//    //Ciclo para obtener los valores de cada columna de la matrizFinal
//    $collMatriz = array();
//    foreach($arrEncabezados as $columnas){
//        $valoresGraf = array(array_column($matrizFinal, $columnas));
//        array_push($collMatriz, $valoresGraf);
//    }
//    
//    //Ciclo para extraer los valores de las columnas en arreglos separados
//    $arrValores = array();
//    foreach($collMatriz as $clave => $valor){
//        foreach($valor as $cInt => $vInt){
//            array_push($arrValores, $vInt);            
//        }
//    }
//    
//    //Ciclo para asociar los arreglos de las columnas con sus respectivos encabezados
//    $valoresFinal = array();
//    foreach($arrValores as $val){
//       $valoresFinal = array_combine($arrEncabezados, $arrValores);       
//    }
//    
//    //Obtener arreglos que solo contengan claves con sub string 'Avg'
//   $arrAvgs = array();
//   $arrClaves = array();
//   foreach($valoresFinal as $clave => $valor){
//       //Se obtiene la clave y se pasa a mayusculas con "strtoupper"
//       //Se busca el sub string "AVG" en el string de ka clave con "strpos"
//       if(strpos(strtoupper($clave), 'AVG')){
//           $arrAvgs[$clave] = $valor; //Se asignan los valores obtenidos al arreglo "arrAvgs"
//           array_push($arrClaves, $clave);
//       }
//   }
//       
//    //Obtener promedios de cada arreglo
//    $arrPromAvg = array();
//    foreach($arrAvgs as $clave => $valor){
//        $sum = array_sum($valor);
//        $prom = round(array_sum($valor) / count($valor), 2);                
//        $arrPromAvg[$clave] = $prom;
//    }
//        
//    echo '<pre>';
//    print_r($arrPromAvg);
//    echo '<br>'.'<br>';
//    echo count($arrPromAvg);
//    
//    echo '<br>'.'<br>';
//    echo print_r($arrClaves);
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body>
        <canvas id="line-chart" width="800" height="450"></canvas>
    </body>
    
    <script type="text/javascript">
        //Recibir los arreglos de PHP
        var jEnc = [];
        var jDatos = [];
        var jLabels = [];
        
        
    </script>
</html>
