<!DOCTYPE html>

<?php
require '../classes/ConexionDB.php';
require '../classes/CRUD.php';
require '../vendor/autoload.php';
require '../classes/GeneralOp.php';

//conexion
$connect = new DBConnection();
$traerColl = $connect->ConectarBD();
$objData = $traerColl->Registros_Bateria_CR800;
$operaciones = new CRUD($objData);
$generalOp = new GeneralOp();

//Captura de datos del formulario
$id = $_POST['sitio'];
$intervalo = $_POST['inter'];
$f_iniform = $f_ini = $_POST['ini'];
$f_finform = $f_fin = $_POST['fin'];
//Arrays de datos a graficar
$cont = 0;
$datos = array();
$categoryArray = array();
$dataSeries1 = array();

$f_ini = $generalOp->ordenaFechai($f_ini);
$f_fin = $generalOp->ordenaFechaf($f_fin);

//Consultar encabezados
$enc = $generalOp->obtenerColumnas($id, $operaciones);

//Elegir intervalos
if ($intervalo == '1hr') {
    $datos2 = $generalOp->consulta15min($id, $f_ini, $f_fin, $operaciones); //Crear metodo***
    $data = iterator_to_array($datos2);
} else {

    //Graficas a 1 dia
    //Se obtiene la lista de dias de $f_ini a $f_fin y se obtienen los datos

    /* Sumar 1 dia para hacer dia siguiente
     * Para sumar 1 dia se tomara el valor de $f_ini
     */

    $fecha = $f_finform;
    if ($f_iniform == $f_finform) {
        $fecha = date("m/d/Y", strtotime($f_iniform . "+ 1 days"));
    }

    for ($i = $f_iniform; $i <= $fecha; $i = date("m/d/Y", strtotime($i . "+ 1 days"))) {
        $f = $i;
        $f_ini = $generalOp->ordenaFechai($f);
        $f_fin = $generalOp->ordenaFechaf($f);
        array_push($categoryArray, ["label" => $f_ini]);
        $a = $generalOp->consulta1dia($id, $f_ini, $f_fin, $operaciones);
    }
        //array_push($datos, $a);
        //Validaciones de valores
//        for ($long = 0; $long <= sizeof($datos) - 1; $long++) {
//            for ($lo = 0; $lo <= sizeof($datos[$long]) - 1; $lo++) {
//
//                //BattV_Min
//                if ($datos[$long][$lo]['BattV_Min'] == "NAN") {
//                    $dtsbvm = 0;
//                } else {
//                    $dtsbvm = $datos[$long][$lo]['BattV_Min'];
//                }
//
//                //Insercion de los datos en un array
//                array_push($dataSeries1, ["value" => $dtsbvm]);
//            }
//        }
        $arrEncabezados = array();
        $arrDatos = array();
        $matrizDatos = array();
        $matrizFinal = array();

        //Crear matriz asociativa
        //Iteracion para obtener los valores de los encabezados de la BD
        foreach ($enc as $clavesEnc => $valoresEnc) {
            if (is_array($valoresEnc)) {
                foreach ($valoresEnc as $clavEncInt => $valorEncInt) {
                    array_push($arrEncabezados, $valorEncInt); //Insertar en arrEncabezados los valores encontrados en la consulta de los encabezados en la BD
                }
                echo "\n";
            } else {
                array_push($arrEncabezados, $valoresEnc); //Insertar en arrEncabezados los valores encontrados en la consulta de los encabezados en la BD
            }
        }
        
        print_r($arrEncabezados);
        echo "<br>"."<br>";
        echo count($arrEncabezados);
        
        //Iteracion para obtener los datos de la BD
        foreach ($a as $datosT) {
            array_push($arrDatos, $datosT); //Insertar en arrDatos los valores encontrados en la consulta de los datos en la BD
        }
        
        print_r($arrDatos);
        echo "<br>"."<br>";
        echo count($arrDatos);
        
        //Iteracion para asociar los arreglos arrEncabezados con arrDatos
        for ($i = 0; $i < sizeof($arrDatos); $i++) {
            $matrizDatos = array_combine($arrEncabezados, $arrDatos[$i]); //Insertar en matrizDatos 
            array_push($matrizFinal, $matrizDatos);
        }

        //Obtener los valores de cada columna de la matrizFinal
        $vGraf = array();
        foreach ($arrEncabezados as $columnas) {
            $valoresGraf = array(array_column($matrizFinal, $columnas));
            array_push($vGraf, $valoresGraf);
        }

        //Ciclo para obtener los valores del arreglo de vGraf
        $arrValores = array();
        foreach ($vGraf as $key => $value) {
            foreach ($value as $k => $v) {
                array_push($arrValores, $v);
            }
        }
    
}
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
        if ($intervalo != "1dia") {
            asort($data);

            foreach ($data as $dataset) {
                if ($intervalo == '1hr') {
                    $datetime = $dataset['TIMESTAMP']->toDateTime();
                    $a = $datetime->format('Y-m-d\TH:i:s.u');
                }

                //Validacion NAN
                //BattV_Min
                if ($dataset['BattV_Min'] == "NAN") {
                    $dtsbvm = 0;
                } else {
                    $dtsbvm = $dataset['BattV_Min'];
                }

                //Armar array de datos para graficar
                array_push($categoryArray, array("label" => $a));
                array_push($dataSeries1, array("value" => $dtsbvm));
            }
        }
        ?>
        <canvas id="line-chart" width="800" height="450"></canvas>
    </body>


    <script type="text/javascript">
        //Recibir los arreglos de PHP
        var jEnc = [];
        var jDatos = [];
        var jEnc = <?php echo json_encode($arrEncabezados); ?>; //Recibe el arreglo de los encabezados de PHP para JavaScript
        var jDatos = <?php echo json_encode($arrValores); ?>; //Recibe el arreglo de los datos de PHP para JavaScript

        //------Generacion de DataSets dinamicos------
        var arrDataSets = []; //Array que contendra todos los JSON de los DataSets generados
        var dataSetAux = {}; //Objeto JSON que contendra los valores de los DataSets que se generan
        var lAux = []; //Array que contendra los valores de los encabezados(jEnc) despues de procesarlos
        var dAux = []; //Array que contendra los valores de los datos(jDatos) despues de procesarlos
        
        //Ciclo para saltar los 4 primeros elementos del array de Encabezados y Datos
        for(var i = 4; i < jEnc.length; i++){
            lAux.push(jEnc[i]);
        }
        
        for(var j = 4; j < jDatos.length; j++){
            dAux.push(jDatos[j]);
        }
        
        //Ciclo para generar los DataSets
        lAux.forEach(function(item, index, array){
           dataSetAux = {
               label: lAux[index],
               borderColor: '#000000',
               pointRadius: 0,
               pointHitRadius: 20,
               fill: false,
               data: dAux[index],
           }
           arrDataSets.push(dataSetAux);
        });
        //------Generacion de DataSets dinamicos Fin------
        
        //Valores de la grafica
        var grafValores = {
            labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33],
            datasets: arrDataSets,
        }
        
        //Configuraciones de la grafica
        var grafOpciones = {
            responsive: true,
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
                        labelString: "Voltaje de la batería del dispositivo CR800"
                    }
            }]
            },
            title: {
                display: true,
                text: "Comportamiento de temperaturas de la Sonda de Inspección"
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 40,
                    fontColor: 'black'
                }
            },
            tooltips: {
                enabled: true
            }
        }
        
        var ctx = document.getElementById('line-chart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: grafValores,
            options: grafOpciones
        })

    </script>
</html>

