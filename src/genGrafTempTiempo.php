<!DOCTYPE html>

<?php
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

//Obtener Parametos del POST
$id = $_POST['sitio'];
$intervalo = $_POST['inter'];
$f_ini2 = $f_ini = $_POST['ini'];
$f_fin2 = $f_fin = $_POST['fin'];

//$cont = 0;
$datos = array();
//$arrData = array();
$categoryArray = array();
$dataseries1 = array();
$dataseries2 = array();
$dataseries3 = array();
$dataseries4 = array();
$dataseries5 = array();
$dataseries6 = array();
$dataseries7 = array();
$dataseries8 = array();
$dataseries9 = array();
$dataseries10 = array();
$dataseries11 = array();
$dataseries12 = array();
$dataseries13 = array();
$dataseries14 = array();
$dataseries15 = array();
$dataseries16 = array();
$dataseries17 = array();
$dataseries18 = array();
$dataseries19 = array();
$dataseries20 = array();
$dataseries21 = array();
$dataseries22 = array();
$dataseries23 = array();
$dataseries24 = array();
$dataseries25 = array();
$dataseries26 = array();
$dataseries27 = array();
$dataseries28 = array();

$f_ini = $generalOp->ordenaFechai($f_ini);
$f_fin = $generalOp->ordenaFechaf($f_fin);

if ($intervalo == '15min') {
    $datos2 = $generalOp->consulta15min($id, $f_ini, $f_fin, $operaciones);
    $data = iterator_to_array($datos2);
} else {
    if ($intervalo == '30min') {
        $datos = $generalOp->consulta30min($id, $f_ini, $f_fin, $operaciones);
        $data = $datos;
    } else {
        // Graficas a un dia
        //Obtiene la lista de dias de diaini  a diafin y obtiene los datos
        //solo se cambiaria aqui el form y solo se tomaria el primer imput        
        // Dia siguiente
        $fecha = $f_fin2;
        if ($f_ini2 == $f_fin2) {
            $fecha = date("m/d/Y", strtotime($f_ini2 . "+ 1 days"));
        }

        for ($i = $f_ini2; $i <= $fecha; $i = date("m/d/Y", strtotime($i . "+ 1 days"))) {
            $f = $i;
            $f_ini = $generalOp->ordenaFechai($f);
            $f_fin = $generalOp->ordenaFechaf($f);
            array_push($categoryArray, ["label" => $f_ini]);
            $a = $generalOp->consulta1dia($id, $f_ini, $f_fin, $operaciones);
            array_push($datos, $a);
        }

        for ($long = 0; $long <= sizeof($datos) - 1; $long++) {
            for ($lo = 0; $lo <= sizeof($datos[$long]) - 1; $lo++) {

                //Validacion NAN
                //PTemp_C_Avg
                if ($datos[$long][$lo]['PTemp_C_Avg'] == "NAN") {
                    $dsta = 0;
                } else {
                    $dsta = $datos[$long][$lo]['PTemp_C_Avg'];
                }

                //T0_10cm_Avg
                if ($datos[$long][$lo]['T0_10cm_Avg'] == "NAN") {
                    $dst0avg = 0;
                } else {
                    $dst0avg = $datos[$long][$lo]['T0_10cm_Avg'];
                }

                //T0_10cm_Max
                if ($datos[$long][$lo]['T0_10cm_Max'] == "NAN") {
                    $dst0max = 0;
                } else {
                    $dst0max = $datos[$long][$lo]['T0_10cm_Max'];
                }

                //T0_10cm_Min
                if ($datos[$long][$lo]['T0_10cm_Min'] == "NAN") {
                    $dst0min = 0;
                } else {
                    $dst0min = $datos[$long][$lo]['T0_10cm_Min'];
                }

                //T1_1m_Avg
                if ($datos[$long][$lo]['T1_1m_Avg'] == "NAN") {
                    $dst1avg = 0;
                } else {
                    $dst1avg = $datos[$long][$lo]['T1_1m_Avg'];
                }

                //T1_1m_Max
                if ($datos[$long][$lo]['T1_1m_Max'] == "NAN") {
                    $dst1max = 0;
                } else {
                    $dst1max = $datos[$long][$lo]['T1_1m_Max'];
                }

                //T1_1m_Min
                if ($datos[$long][$lo]['T1_1m_Min'] == "NAN") {
                    $dst1min = 0;
                } else {
                    $dst1min = $datos[$long][$lo]['T1_1m_Min'];
                }

                //T2_2m_Avg
                if ($datos[$long][$lo]['T2_2m_Avg'] == "NAN") {
                    $dst2avg = 0;
                } else {
                    $dst2avg = $datos[$long][$lo]['T2_2m_Avg'];
                }

                //T2_2m_Max
                if ($datos[$long][$lo]['T2_2m_Max'] == "NAN") {
                    $dst2max = 0;
                } else {
                    $dst2max = $datos[$long][$lo]['T2_2m_Max'];
                }

                //T2_2m_Min
                if ($datos[$long][$lo]['T2_2m_Min'] == "NAN") {
                    $dst2min = 0;
                } else {
                    $dst2min = $datos[$long][$lo]['T2_2m_Min'];
                }

                //T3_3m_Avg
                if ($datos[$long][$lo]['T3_3m_Avg'] == "NAN") {
                    $dst3avg = 0;
                } else {
                    $dst3avg = $datos[$long][$lo]['T3_3m_Avg'];
                }

                //T3_3m_Max
                if ($datos[$long][$lo]['T3_3m_Max'] == "NAN") {
                    $dst3max = 0;
                } else {
                    $dst3max = $datos[$long][$lo]['T3_3m_Max'];
                }

                //T3_3m_Min
                if ($datos[$long][$lo]['T3_3m_Min'] == "NAN") {
                    $dst3min = 0;
                } else {
                    $dst3min = $datos[$long][$lo]['T3_3m_Min'];
                }

                //T4_4m_Avg
                if ($datos[$long][$lo]['T4_4m_Avg'] == "NAN") {
                    $dst4avg = 0;
                } else {
                    $dst4avg = $datos[$long][$lo]['T4_4m_Avg'];
                }

                //T4_4m_Max
                if ($datos[$long][$lo]['T4_4m_Max'] == "NAN") {
                    $dst4max = 0;
                } else {
                    $dst4max = $datos[$long][$lo]['T4_4m_Max'];
                }

                //T4_4m_Min
                if ($datos[$long][$lo]['T4_4m_Min'] == "NAN") {
                    $dst4min = 0;
                } else {
                    $dst4min = $datos[$long][$lo]['T4_4m_Min'];
                }

                //T5_5m_Avg
                if ($datos[$long][$lo]['T5_5m_Avg'] == "NAN") {
                    $dst5avg = 0;
                } else {
                    $dst5avg = $datos[$long][$lo]['T5_5m_Avg'];
                }

                //T5_5m_Max
                if ($datos[$long][$lo]['T5_5m_Max'] == "NAN") {
                    $dst5max = 0;
                } else {
                    $dst5max = $datos[$long][$lo]['T5_5m_Max'];
                }

                //T5_5m_Min
                if ($datos[$long][$lo]['T5_5m_Min'] == "NAN") {
                    $dst5min = 0;
                } else {
                    $dst5min = $datos[$long][$lo]['T5_5m_Min'];
                }

                //T6_6m_Avg
                if ($datos[$long][$lo]['T6_6m_Avg'] == "NAN") {
                    $dst6avg = 0;
                } else {
                    $dst6avg = $datos[$long][$lo]['T6_6m_Avg'];
                }

                //T6_6m_Max
                if ($datos[$long][$lo]['T6_6m_Max'] == "NAN") {
                    $dst6max = 0;
                } else {
                    $dst6max = $datos[$long][$lo]['T6_6m_Max'];
                }

                //T6_6m_Min
                if ($datos[$long][$lo]['T6_6m_Min'] == "NAN") {
                    $dst6min = 0;
                } else {
                    $dst6min = $datos[$long][$lo]['T6_6m_Min'];
                }

                //T7_7m_Avg
                if ($datos[$long][$lo]['T7_7m_Avg'] == "NAN") {
                    $dst7avg = 0;
                } else {
                    $dst7avg = $datos[$long][$lo]['T7_7m_Avg'];
                }

                //T7_7m_Max
                if ($datos[$long][$lo]['T7_7m_Max'] == "NAN") {
                    $dst7max = 0;
                } else {
                    $dst7max = $datos[$long][$lo]['T7_7m_Max'];
                }

                //T7_7m_Min
                if ($datos[$long][$lo]['T7_7m_Min'] == "NAN") {
                    $dst7min = 0;
                } else {
                    $dst7min = $datos[$long][$lo]['T7_7m_Min'];
                }

                //T7_5_7_5m_Avg
                if ($datos[$long][$lo]['T7_5_7_5m_Avg'] == "NAN") {
                    $dst75avg = 0;
                } else {
                    $dst75avg = $datos[$long][$lo]['T7_5_7_5m_Avg'];
                }

                //T7_5_7_5m_Max
                if ($datos[$long][$lo]['T7_5_7_5m_Max'] == "NAN") {
                    $dst75max = 0;
                } else {
                    $dst75max = $datos[$long][$lo]['T7_5_7_5m_Max'];
                }

                //T7_5_7_5m_Min
                if ($datos[$long][$lo]['T7_5_7_5m_Min'] == "NAN") {
                    $dst75min = 0;
                } else {
                    $dst75min = $datos[$long][$lo]['T7_5_7_5m_Min'];
                }

                //Insercion de datos en sus respectivos arrays
                array_push($dataseries1, ["value" => $dsta]);
                array_push($dataseries2, ["value" => $dst0avg]);
                array_push($dataseries3, ["value" => $dst0max]);
                array_push($dataseries4, ["value" => $dst0min]);
                array_push($dataseries5, ["value" => $dst1avg]);
                array_push($dataseries6, ["value" => $dst1max]);
                array_push($dataseries7, ["value" => $dst1min]);
                array_push($dataseries8, ["value" => $dst2avg]);
                array_push($dataseries9, ["value" => $dst2max]);
                array_push($dataseries10, ["value" => $dst2min]);
                array_push($dataseries11, ["value" => $dst3avg]);
                array_push($dataseries12, ["value" => $dst3max]);
                array_push($dataseries13, ["value" => $dst3min]);
                array_push($dataseries14, ["value" => $dst4avg]);
                array_push($dataseries15, ["value" => $dst4max]);
                array_push($dataseries16, ["value" => $dst4min]);
                array_push($dataseries17, ["value" => $dst5avg]);
                array_push($dataseries18, ["value" => $dst5max]);
                array_push($dataseries19, ["value" => $dst5min]);
                array_push($dataseries20, ["value" => $dst6avg]);
                array_push($dataseries21, ["value" => $dst6max]);
                array_push($dataseries22, ["value" => $dst6min]);
                array_push($dataseries23, ["value" => $dst7avg]);
                array_push($dataseries24, ["value" => $dst7max]);
                array_push($dataseries25, ["value" => $dst7min]);
                array_push($dataseries26, ["value" => $dst75avg]);
                array_push($dataseries27, ["value" => $dst75max]);
                array_push($dataseries28, ["value" => $dst75min]);
            }
        }
    }
}
?>

<html lang="es">
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body>

        <?php
//Convertir cursor Mongo en array
        if ($intervalo != "1dia") {
            asort($data);

            foreach ($data as $dataset) {

                if ($intervalo == '15min') {
                    $datetime = $dataset['TIMESTAMP']->toDateTime();
                    $a = $datetime->format('Y-m-d\TH:i:s.u');
                } else {
                    if ($intervalo == "30min") {
                        $a = $dataset['TIMESTAMP'];
                    }
                }

                //Validacion NAN
                //PTemp_C_Avg
                if ($dataset['PTemp_C_Avg'] == "NAN") {
                    $dsta = 0;
                } else {
                    $dsta = $dataset['PTemp_C_Avg'];
                }

                //T0_10cm_Avg
                if ($dataset['T0_10cm_Avg'] == "NAN") {
                    $dst0avg = 0;
                } else {
                    $dst0avg = $dataset['T0_10cm_Avg'];
                }

                //T0_10cm_Max
                if ($dataset['T0_10cm_Max'] == "NAN") {
                    $dst0max = 0;
                } else {
                    $dst0max = $dataset['T0_10cm_Max'];
                }

                //T0_10cm_Min
                if ($dataset['T0_10cm_Min'] == "NAN") {
                    $dst0min = 0;
                } else {
                    $dst0min = $dataset['T0_10cm_Min'];
                }

                //T1_1m_Avg
                if ($dataset['T1_1m_Avg'] == "NAN") {
                    $dst1avg = 0;
                } else {
                    $dst1avg = $dataset['T1_1m_Avg'];
                }

                //T1_1m_Max
                if ($dataset['T1_1m_Max'] == "NAN") {
                    $dst1max = 0;
                } else {
                    $dst1max = $dataset['T1_1m_Max'];
                }

                //T1_1m_Min
                if ($dataset['T1_1m_Min'] == "NAN") {
                    $dst1min = 0;
                } else {
                    $dst1min = $dataset['T1_1m_Min'];
                }

                //T2_2m_Avg
                if ($dataset['T2_2m_Avg'] == "NAN") {
                    $dst2avg = 0;
                } else {
                    $dst2avg = $dataset['T2_2m_Avg'];
                }

                //T2_2m_Max
                if ($dataset['T2_2m_Max'] == "NAN") {
                    $dst2max = 0;
                } else {
                    $dst2max = $dataset['T2_2m_Max'];
                }

                //T2_2m_Min
                if ($dataset['T2_2m_Min'] == "NAN") {
                    $dst2min = 0;
                } else {
                    $dst2min = $dataset['T2_2m_Min'];
                }

                //T3_3m_Avg
                if ($dataset['T3_3m_Avg'] == "NAN") {
                    $dst3avg = 0;
                } else {
                    $dst3avg = $dataset['T3_3m_Avg'];
                }

                //T3_3m_Max
                if ($dataset['T3_3m_Max'] == "NAN") {
                    $dst3max = 0;
                } else {
                    $dst3max = $dataset['T3_3m_Max'];
                }

                //T3_3m_Min
                if ($dataset['T3_3m_Min'] == "NAN") {
                    $dst3min = 0;
                } else {
                    $dst3min = $dataset['T3_3m_Min'];
                }

                //T4_4m_Avg
                if ($dataset['T4_4m_Avg'] == "NAN") {
                    $dst4avg = 0;
                } else {
                    $dst4avg = $dataset['T4_4m_Avg'];
                }

                //T4_4m_Max
                if ($dataset['T4_4m_Max'] == "NAN") {
                    $dst4max = 0;
                } else {
                    $dst4max = $dataset['T4_4m_Max'];
                }

                //T4_4m_Min
                if ($dataset['T4_4m_Min'] == "NAN") {
                    $dst4min = 0;
                } else {
                    $dst4min = $dataset['T4_4m_Min'];
                }

                //T5_5m_Avg
                if ($dataset['T5_5m_Avg'] == "NAN") {
                    $dst5avg = 0;
                } else {
                    $dst5avg = $dataset['T5_5m_Avg'];
                }

                //T5_5m_Max
                if ($dataset['T5_5m_Max'] == "NAN") {
                    $dst5max = 0;
                } else {
                    $dst5max = $dataset['T5_5m_Max'];
                }

                //T5_5m_Min
                if ($dataset['T5_5m_Min'] == "NAN") {
                    $dst5min = 0;
                } else {
                    $dst5min = $dataset['T5_5m_Min'];
                }

                //T6_6m_Avg
                if ($dataset['T6_6m_Avg'] == "NAN") {
                    $dst6avg = 0;
                } else {
                    $dst6avg = $dataset['T6_6m_Avg'];
                }

                //T6_6m_Max
                if ($dataset['T6_6m_Max'] == "NAN") {
                    $dst6max = 0;
                } else {
                    $dst6max = $dataset['T6_6m_Max'];
                }

                //T6_6m_Min
                if ($dataset['T6_6m_Min'] == "NAN") {
                    $dst6min = 0;
                } else {
                    $dst6min = $dataset['T6_6m_Min'];
                }

                //T7_7m_Avg
                if ($dataset['T7_7m_Avg'] == "NAN") {
                    $dst7avg = 0;
                } else {
                    $dst7avg = $dataset['T7_7m_Avg'];
                }

                //T7_7m_Max
                if ($dataset['T7_7m_Max'] == "NAN") {
                    $dst7max = 0;
                } else {
                    $dst7max = $dataset['T7_7m_Max'];
                }

                //T7_7m_Min
                if ($dataset['T7_7m_Min'] == "NAN") {
                    $dst7min = 0;
                } else {
                    $dst7min = $dataset['T7_7m_Min'];
                }

                //T7_5_7_5m_Avg
                if ($dataset['T7_5_7_5m_Avg'] == "NAN") {
                    $dst75avg = 0;
                } else {
                    $dst75avg = $dataset['T7_5_7_5m_Avg'];
                }

                //T7_5_7_5m_Max
                if ($dataset['T7_5_7_5m_Max'] == "NAN") {
                    $dst75max = 0;
                } else {
                    $dst75max = $dataset['T7_5_7_5m_Max'];
                }

                //T7_5_7_5m_Min
                if ($dataset['T7_5_7_5m_Min'] == "NAN") {
                    $dst75min = 0;
                } else {
                    $dst75min = $dataset['T7_5_7_5m_Min'];
                }

                //Armar arrays de datos para graficar
                array_push($categoryArray, array("label" => $a));
                array_push($dataseries1, array("value" => $dsta));
                array_push($dataseries2, array("value" => $dst0avg));
                array_push($dataseries3, array("value" => $dst0max));
                array_push($dataseries4, array("value" => $dst0min));
                array_push($dataseries5, array("value" => $dst1avg));
                array_push($dataseries6, array("value" => $dst1max));
                array_push($dataseries7, array("value" => $dst1min));
                array_push($dataseries8, array("value" => $dst2avg));
                array_push($dataseries9, array("value" => $dst2max));
                array_push($dataseries10, array("value" => $dst2min));
                array_push($dataseries11, array("value" => $dst3avg));
                array_push($dataseries12, array("value" => $dst3max));
                array_push($dataseries13, array("value" => $dst3min));
                array_push($dataseries14, array("value" => $dst4avg));
                array_push($dataseries15, array("value" => $dst4max));
                array_push($dataseries16, array("value" => $dst4min));
                array_push($dataseries17, array("value" => $dst5avg));
                array_push($dataseries18, array("value" => $dst5max));
                array_push($dataseries19, array("value" => $dst5min));
                array_push($dataseries20, array("value" => $dst6avg));
                array_push($dataseries21, array("value" => $dst6max));
                array_push($dataseries22, array("value" => $dst6min));
                array_push($dataseries23, array("value" => $dst7avg));
                array_push($dataseries24, array("value" => $dst7max));
                array_push($dataseries25, array("value" => $dst7min));
                array_push($dataseries26, array("value" => $dst75avg));
                array_push($dataseries27, array("value" => $dst75max));
                array_push($dataseries28, array("value" => $dst75min));
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
foreach ($dataseries1 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "PTemp_C_Avg",
                    borderColor: "#000000",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries2 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T0_10cm_Avg",
                    borderColor: "#C40000",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries3 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T0_10cm_Max",
                    borderColor: "#FF0000",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries4 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T0_10cm_Min",
                    borderColor: "#FF8585",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries5 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T1_1m_Avg",
                    borderColor: "#A200FF",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries6 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T1_1m_Max",
                    borderColor: "#8800D6",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                }, {
                    data: [
<?php
$t = "";
foreach ($dataseries7 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T1_1m_Min",
                    borderColor: "#D48AFF",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries8 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T2_2m_Avg",
                    borderColor: "#2B00FF",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries9 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T2_2m_Max",
                    borderColor: "#1E00B5",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries10 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T2_2m_Min",
                    borderColor: "#6F52FF",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries11 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T3_3m_Avg",
                    borderColor: "#008504",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries12 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T3_3m_Max",
                    borderColor: "#698A6A",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries13 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T3_3m_Min",
                    borderColor: "#DEB500",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries14 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T4_4m_Avg",
                    borderColor: "#DEC143",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries15 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T4_4m_Max",
                    borderColor: "#FFE46B",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries16 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T4_4m_Min",
                    borderColor: "#735600",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries17 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T5_5m_Avg",
                    borderColor: "#75632A",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries18 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T5_5m_Max",
                    borderColor: "#B5983F",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries19 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T5_5m_Min",
                    borderColor: "#0065B8",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries20 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T6_6m_Avg",
                    borderColor: "#4181B5",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries21 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T6_6m_Max",
                    borderColor: "#78A6CC",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries22 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T6_6m_Min",
                    borderColor: "#DE7600",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries23 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T7_7m_Avg",
                    borderColor: "#C9700A",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries24 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T7_7m_Max",
                    borderColor: "#EDAA5C",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries25 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T7_7m_Min",
                    borderColor: "#427500",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries26 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T7_5_7_5m_Avg",
                    borderColor: "#4F7321",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries27 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T7_5_7_5m_Max",
                    borderColor: "#789157",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                },
                {
                    data: [
<?php
$t = "";
foreach ($dataseries28 as $d) {
    echo $d['value'] . ",";
}
?>
                    ],
                    label: "T7_5_7_5m_Min",
                    borderColor: "#8e5ea2",
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                }
            ]
        },
        options: {
            scales: {
                xAxes: [{display: true,
                        scaleLabel: {display: true,
                            labelString: "Periodo de muestra"
                        }
                    }],
                yAxes: [{display: true,
                        scaleLabel: {display: true,
                            labelString: "Temperatura °C"
                        }
                    }]
            },
            title: {
                display: true,
                text: 'Comportamiento de temperaturas de la Sonda de Inspeccion'

            }
        }
    });
</script>