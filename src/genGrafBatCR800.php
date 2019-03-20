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
        $a = $generalOp->consulta1diaBatCR800($id, $f_ini, $f_fin, $operaciones);
        array_push($datos, $a);

        //Validaciones de valores
        for ($long = 0; $long <= sizeof($datos) - 1; $long++) {
            for ($lo = 0; $lo <= sizeof($datos[$long]) - 1; $lo++) {

                //BattV_Min
                if ($datos[$long][$lo]['BattV_Min'] == "NAN") {
                    $dtsbvm = 0;
                } else {
                    $dtsbvm = $datos[$long][$lo]['BattV_Min'];
                }

                //Insercion de los datos en un array
                array_push($dataSeries1, ["value" => $dtsbvm]);
            }
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
</html>

<script>
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        pointRadius: 0,
        fill: false,
        lineTension: 0,
        data: {
            labels: [
<?php
$p = "";
foreach ($categoryArray as $d) {
    echo "'" . $d['label'] . "',";
}
?>
            ],
            datasets: [{
                    data: [
<?php
$t = "";
foreach ($dataSeries1 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "BattV_Min",
                    borderColor: "#000000",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0
                }]
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
                            labelString: "Voltaje de la batería del dispositivo CR800"
                        }
                    }]
            },
            title: {
                display: true,
                text: 'Comportamiento del voltaje de la batería del dispositivo CR800'
            }
        }
    });
</script>


