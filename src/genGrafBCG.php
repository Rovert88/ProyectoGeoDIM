<!DOCTYPE html>

<?php

require '../classes/ConexionDB.php';
require '../classes/CRUD.php';
require '../vendor/autoload.php';
require '../classes/GeneralOp.php';

//Conexion
$connect = new DBConnection();
//$objData = $connect->UpCSVBCGConn();
$traerColl = $connect->ConectarBD();
$objData = $traerColl->Registros_Bombas_Calor_Geotermico;
$operaciones = new CRUD($objData);
$generalOp = new GeneralOp();

//Captura de datos del formulario
$id = $_POST['sitio'];
$intervalo = $_POST['inter'];
$f_iniform = $f_ini = $_POST['ini'];
$f_finform = $f_fin = $_POST['fin'];
$cont = 0;

//Valores para intervalo libre
$intervalo_muestreo = 2;

//Arrays de datos a graficar
$datos = array();
$arrData = array();
$categoryArray = array();
$dataSeries1 = array();
$dataSeries2 = array();
$dataSeries3 = array();
$dataSeries4 = array();
$dataSeries5 = array();
$dataSeries6 = array();
$dataSeries7 = array();
$dataSeries8 = array();
$dataSeries9 = array();
$dataSeries10 = array();
$dataSeries11 = array();

$f_ini = $generalOp->ordenaFechai($f_ini);
$f_fin = $generalOp->ordenaFechaf($f_fin);

//Elegir intervalos

//if($intervalo == '2'){
//    $datos2 = $generalOp->consulta15min($id, $f_ini, $f_fin, $operaciones);
//    $data = iterator_to_array($datos2);
//}else{
    if ($intervalo >= '2') {
    $datos = $generalOp->consultaIntervalo($id, $intervalo, $f_ini, $f_fin, $operaciones);
    $data = $datos;
}else{
    
    //Graficas a 1 dia
    //Se obtiene la lista de dias de $f_ini a $f_fin y se obtienen los datos
         
    /*Sumar 1 dia para hacer dia siguiente
     * Para sumar 1 dia se tomara el valor de $f_ini
     */
    if($intervalo == '1440'){
    
        $fecha = $f_finform;
        if($f_iniform == $f_finform){
            $fecha = date("m/d/Y", strtotime($f_iniform."+ 1 days"));
        }

        for($i = $f_iniform; $i <= $fecha; $i = date("m/d/Y", strtotime($i. "+ 1 days"))){
            $f = $i;
            $f_ini = $generalOp->ordenaFechai($f);
            $f_fin = $generalOp->ordenaFechaf($f);
            array_push($categoryArray, ["label" => $f_ini]);
            $a = $generalOp->consulta1diaBCG($id, $f_ini, $f_fin, $operaciones);
            array_push($datos, $a);
            $fechas = $generalOp->consultaFechas($id, $f_ini, $f_fin, $operaciones);
        }
        
        $arrFechas = array();
        foreach($fechas as $f){
            array_push($arrFechas, $f);
        }
        print_r($arrFechas);

            //Validaciones de valores
            for($long = 0; $long <= sizeof($datos) - 1; $long++){
                for($lo = 0; $lo <= sizeof($datos[$long]) - 1; $lo++){

                    //Bat_CR800
                    if($datos[$long][$lo]['Bat_CR800'] == "NAN"){
                        $dtsbcr = 0;
                    }else{
                        $dtsbcr = $datos[$long][$lo]['Bat_CR800'];
                    }

                    //Temp_CR800
                    if($datos[$long][$lo]['Temp_CR800'] == "NAN"){
                        $dtstcr = 0;
                    }else{
                        $dtstcr = $datos[$long][$lo]['Temp_CR800'];
                    }

                    //EAT_DegF
                    if($datos[$long][$lo]['EAT_DegF'] == "NAN"){
                        $dtseatf = 0;
                    }else{
                        $dtseatf = $datos[$long][$lo]['EAT_DegF'];
                    }

                    //LAT_DegF
                    if($datos[$long][$lo]['LAT_DegF'] == "NAN"){
                        $dtslatf = 0;
                    }else{
                        $dtslatf = $datos[$long][$lo]['LAT_DegF'];
                    }

                    //EWT_DegF
                    if($datos[$long][$lo]['EWT_DegF'] == "NAN"){
                        $dtsewtf = 0;
                    }else{
                        $dtsewtf = $datos[$long][$lo]['EWT_DegF'];
                    }

                    //LWT_DegF
                    if($datos[$long][$lo]['LWT_DegF'] == "NAN"){
                        $dtslwtf = 0;
                    }else{
                        $dtslwtf = $datos[$long][$lo]['LWT_DegF'];
                    }

                    //CT_Amp
                    if($datos[$long][$lo]['CT_Amp'] == "NAN"){
                        $dtscta = 0;
                    }else{
                        $dtscta = $datos[$long][$lo]['CT_Amp'];
                    }

                    //EAT_DegC
                    if($datos[$long][$lo]['EAT_DegC'] == "NAN"){
                        $dtseatc = 0;
                    }else{
                        $dtseatc = $datos[$long][$lo]['EAT_DegC'];
                    }

                    //LAT_DegC
                    if($datos[$long][$lo]['LAT_DegC'] == "NAN"){
                        $dtslatc = 0;
                    }else{
                        $dtslatc = $datos[$long][$lo]['LAT_DegC'];
                    }

                    //EWT_DegC
                    if($datos[$long][$lo]['EWT_DegC'] == "NAN"){
                        $dtsewtc = 0;
                    }else{
                        $dtsewtc = $datos[$long][$lo]['EWT_DegC'];
                    }

                    //LWT_DegC
                    if($datos[$long][$lo]['LWT_DegC'] == "NAN"){
                        $dtslwtc = 0;
                    }else{
                        $dtslwtc = $datos[$long][$lo]['LWT_DegC'];
                    }

                    //Insercion de datos en sus respectivos arrays
                    array_push($dataSeries1, ["value" => $dtsbcr]);
                    array_push($dataSeries2, ["value" => $dtstcr]);
                    array_push($dataSeries3, ["value" => $dtseatf]);
                    array_push($dataSeries4, ["value" => $dtslatf]);
                    array_push($dataSeries5, ["value" => $dtsewtf]);
                    array_push($dataSeries6, ["value" => $dtslwtf]);
                    array_push($dataSeries7, ["value" => $dtscta]);
                    array_push($dataSeries8, ["value" => $dtseatc]);
                    array_push($dataSeries9, ["value" => $dtslatc]);
                    array_push($dataSeries10, ["value" => $dtsewtc]);
                    array_push($dataSeries11, ["value" => $dtslwtc]);
                }
            }
        }
    }
//}
?>

<!--Se trae la libreria Chart.js-->
<html lang="es">
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body>
        
    <!--Se arreglan los valores para graficarlos-->
    <?php
    //Convertir cursor Mongo en array
   // if($intervalo != "1dia"){
        asort($data);
        
        foreach($data as $dataset){
            
//            if($intervalo == '2min'){
//                $datetime = $dataset['TIMESTAMP']->toDateTime();
//                $a = $datetime->format('Y-m-d\TH:i:s.u');
//            }else{
//                if($intervalo == "4min"){
//                    $a = $dataset['TIMESTAMP'];
//                }
//            }
            
            $a = $dataset['TIMESTAMP'];
            
            //Validaciones NAN
            //Bat_CR800
            if($dataset['Bat_CR800'] == "NAN"){
                $dtsbcr = 0;
            }else{
                $dtsbcr = $dataset['Bat_CR800'];
            }

            //Temp_CR800
            if($dataset['Temp_CR800'] == "NAN"){
                $dtstcr = 0;
            }else{
                $dtstcr = $dataset['Temp_CR800'];
            }

            //EAT_DegF
            if($dataset['EAT_DegF'] == "NAN"){
                $dtseatf = 0;
            }else{
                $dtseatf = $dataset['EAT_DegF'];
            }

            //LAT_DegF
            if($dataset['LAT_DegF'] == "NAN"){
                $dtslatf = 0;
            }else{
                $dtslatf = $dataset['LAT_DegF'];
            }

            //EWT_DegF
            if($dataset['EWT_DegF'] == "NAN"){
                $dtsewtf = 0;
            }else{
                $dtsewtf = $dataset['EWT_DegF'];
            }

            //LWT_DegF
            if($dataset['LWT_DegF'] == "NAN"){
                $dtslwtf = 0;
            }else{
                $dtslwtf = $dataset['LWT_DegF'];
            }

            //CT_Amp
            if($dataset['CT_Amp'] == "NAN"){
                $dtscta = 0;
            }else{
                $dtscta = $dataset['CT_Amp'];
            }

            //EAT_DegC
            if($dataset['EAT_DegC'] == "NAN"){
                $dtseatc = 0;
            }else{
                $dtseatc = $dataset['EAT_DegC'];
            }

            //LAT_DegC
            if($dataset['LAT_DegC'] == "NAN"){
                $dtslatc = 0;
            }else{
                $dtslatc = $dataset['LAT_DegC'];
            }

            //EWT_DegC
            if($dataset['EWT_DegC'] == "NAN"){
                $dtsewtc = 0;
            }else{
                $dtsewtc = $dataset['EWT_DegC'];
            }

            //LWT_DegC
            if($dataset['LWT_DegC'] == "NAN"){
                $dtslwtc = 0;
            }else{
                $dtslwtc = $dataset['LWT_DegC'];
            }
            
            
            //Armar arrays de datos para graficar
            array_push($categoryArray, array("label" => $a));
            array_push($dataSeries1, array("value" => $dtsbcr));
            array_push($dataSeries2, array("value" => $dtstcr));
            array_push($dataSeries3, array("value" => $dtseatf));
            array_push($dataSeries4, array("value" => $dtslatf));
            array_push($dataSeries5, array("value" => $dtsewtf));
            array_push($dataSeries6, array("value" => $dtslwtf));
            array_push($dataSeries7, array("value" => $dtscta));
            array_push($dataSeries8, array("value" => $dtseatc));
            array_push($dataSeries9, array("value" => $dtslatc));
            array_push($dataSeries10, array("value" => $dtsewtc));
            array_push($dataSeries11, array("value" => $dtslwtc));
        }
    //}
    ?>
    <canvas id="line-chart" width="800" height="450"></canvas>
        
    </body>
   
<script type="text/javascript"> 
   
    new Chart(document.getElementById("line-chart"),{
        type: 'line',
        pointRadius: 0,
        fill: false,
        lineTension: 0,
        data: {
            labels: [
                <?php
                    $p = "";
                    foreach($categoryArray as $d){
                        echo "'". $d['label']. "',";
                    }
                ?>
            ],
            datasets: [{
                    data:[
                        <?php
                        $t = "";
                        foreach($dataSeries1 as $d){
                            echo $d['value']. ",";
                        }
                        ?>
                    ],
                    label: "Bat_CR800",
                    borderColor: "#000000",
                    pointRadius: 1,
                    fill: false,
                    lineTension: 0
                },
                {
                    data: [
                        <?php
                          $t = "";
                          foreach($dataSeries2 as $d){
                              echo $d['value']. ",";
                          }
                        ?>
                    ],
                    label: "Temp_CR800",
                    borderColor: "#C40000",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
                        <?php
                            $t = "";
                            foreach($dataSeries3 as $d){
                                echo $d['value']. ",";
                            }
                        ?>
                    ],
                    label: "EAT_DegF",
                    borderColor: "#FF0000",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
                        <?php
                          $t = "";
                          foreach($dataSeries4 as $d){
                              echo $d['value']. ",";
                          }
                        ?>
                    ],
                    label: "LAT_DegF",
                    boderColor: "#FF8585",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
                        <?php
                          $t = "";
                          foreach($dataSeries5 as $d){
                              echo $d['value']. ",";
                          }
                        ?>
                    ],
                    label: "EWT_DegF",
                    borderColor: "#A200FF",
                    pointRadius: 0,
                    fill: false,
                    linetTension: 0,
                },
                {
                    data: [
                        <?php
                          $t = "";
                          foreach($dataSeries6 as $d){
                              echo $d['value']. ",";
                          }
                        ?>
                    ],
                    label: "LWT_DegF",
                    borderColor: "#8800D6",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data:[
                        <?php
                          $t = "";
                          foreach($dataSeries7 as $d){
                              echo $d['value']. ",";
                          }
                        ?>
                    ],
                    label: "CT_Amp",
                    borderColor: "#D48AFF",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
                        <?php
                            $t = "";
                            foreach($dataSeries8 as $d){
                                echo $d['value']. ",";
                            }
                        ?>
                    ],
                    label: "EAT_DegC",
                    borderColor: "#2B00FF",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
                        <?php
                          $t = "";
                          foreach($dataSeries9 as $d){
                              echo $d['value']. ",";
                          }
                        ?>
                    ],
                    label: "LAT_DegC",
                    borderColor: "#1E00B5",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
                        <?php
                          $t = "";
                          foreach($dataSeries10 as $d){
                              echo $d['value']. ",";                             
                          }
                        ?>
                    ],
                    label: "EWT_DegC",
                    borderColor: "#6F52FF",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
                        <?php
                          $t = "";
                          foreach($dataSeries11 as $d){
                              echo $d['value']. ",";
                          }
                        ?>
                    ],
                    label: "LWT_DegC",
                    borderColor: "#008504",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                }
            ]
            },
            options: {
             scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Periodo de muestra"
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Variables de operacion de la BCG"
                    }
                }]
             },
             title:{
                display: true,
                text: 'Comportamiento de las variables de la Bomba de Calor Gotermico'
             }             
        }                    
    });
        
</script>
</html>