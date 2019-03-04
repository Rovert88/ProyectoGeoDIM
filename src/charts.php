<!DOCTYPE html>

<?php
require '../classes/ConexionDB.php';
require '../classes/CRUD.php';
require '../vendor/autoload.php';
require '../classes/GeneralOp.php';
//Conexion
$connect = new DBConnection();
$objData = $connect->UpCSVSIConn();
$operaciones = new CRUD($objData);
$generalOp = new GeneralOp();

//Obtener Parametos del POST
$id = $_POST['sitio'];
$intervalo = $_POST['inter'];
$f_ini2 = $f_ini = $_POST['ini'];
$f_fin2 = $f_fin = $_POST['fin'];

$cont = 0;
$datos = array();
$arrData = array();
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
    $datos2 = $generalOp->consulta15min($f_ini, $f_fin, $operaciones);
    $data = iterator_to_array($datos2);
} else {
    if ($intervalo == '30min') {
        $datos = $generalOp->consulta30min($f_ini, $f_fin, $operaciones);
        $data = $datos;
    } else {
        // Graficas a un dia
        
        //Obtiene la lista de dias de diaini  a diafin y obtiene los datos
        //solo se cambiaria aqui el form y solo se tomaria el primer imput
        // osea f_ini
        // Dia siguiente
        $fecha = $f_fin2;
        if ($f_ini2 == $f_fin2){
        $fecha = date("m/d/Y",strtotime($f_ini2."+ 1 days"));
        }
        
        // haber pruebalo robert
        
        for ($i = $f_ini2; $i <= $fecha ; $i = date("m/d/Y", strtotime($i . "+ 1 days"))) {
            $f = $i;
            $f_ini = $generalOp->ordenaFechai($f);
            $f_fin = $generalOp->ordenaFechaf($f);
            array_push($categoryArray, ["label" => $f_ini]);
            // LOs Datos ya estan relacionados en la BD?
            //Si, ya tienen el id en cada registro
            $a = $generalOp->consulta1dia($id, $f_ini, $f_fin, $operaciones);
            array_push($datos, $a);
        }
        
        for ($long = 0; $long <= sizeof($datos) - 1; $long++) {
            for ($lo = 0; $lo <= sizeof($datos[$long]) - 1; $lo++) {

                //Validacion NAN
                //Temp_Amb
                if ($datos[$long][$lo]['Temp_Amb'] == "NAN") {
                    $dsta = 0;
                } else {
                    $dsta = $datos[$long][$lo]['Temp_Amb'];
                }

                //T0_avg
                if ($datos[$long][$lo]['T0_avg'] == "NAN") {
                    $dst0avg = 0;
                } else {
                    $dst0avg = $datos[$long][$lo]['T0_avg'];
                }

                //T0_max
                if ($datos[$long][$lo]['T0_max'] == "NAN") {
                    $dst0max = 0;
                } else {
                    $dst0max = $datos[$long][$lo]['T0_max'];
                }

                //T0_min
                if ($datos[$long][$lo]['T0_min'] == "NAN") {
                    $dst0min = 0;
                } else {
                    $dst0min = $datos[$long][$lo]['T0_min'];
                }

                //T1_avg
                if ($datos[$long][$lo]['T1_avg'] == "NAN") {
                    $dst1avg = 0;
                } else {
                    $dst1avg = $datos[$long][$lo]['T1_avg'];
                }

                //T1_max
                if ($datos[$long][$lo]['T1_max'] == "NAN") {
                    $dst1max = 0;
                } else {
                    $dst1max = $datos[$long][$lo]['T1_max'];
                }

                //T1_min
                if ($datos[$long][$lo]['T1_min'] == "NAN") {
                    $dst1min = 0;
                } else {
                    $dst1min = $datos[$long][$lo]['T1_min'];
                }

                //T2_avg
                if ($datos[$long][$lo]['T2_avg'] == "NAN") {
                    $dst2avg = 0;
                } else {
                    $dst2avg = $datos[$long][$lo]['T2_avg'];
                }

                //T2_max
                if ($datos[$long][$lo]['T2_max'] == "NAN") {
                    $dst2max = 0;
                } else {
                    $dst2max = $datos[$long][$lo]['T2_max'];
                }

                //T2_min
                if ($datos[$long][$lo]['T2_min'] == "NAN") {
                    $dst2min = 0;
                } else {
                    $dst2min = $datos[$long][$lo]['T2_min'];
                }

                //T3_avg
                if ($datos[$long][$lo]['T3_avg'] == "NAN") {
                    $dst3avg = 0;
                } else {
                    $dst3avg = $datos[$long][$lo]['T3_avg'];
                }

                //T3_max
                if ($datos[$long][$lo]['T3_max'] == "NAN") {
                    $dst3max = 0;
                } else {
                    $dst3max = $datos[$long][$lo]['T3_max'];
                }

                //T3_min
                if ($datos[$long][$lo]['T3_min'] == "NAN") {
                    $dst3min = 0;
                } else {
                    $dst3min = $datos[$long][$lo]['T3_min'];
                }

                //T4_avg
                if ($datos[$long][$lo]['T4_avg'] == "NAN") {
                    $dst4avg = 0;
                } else {
                    $dst4avg = $datos[$long][$lo]['T4_avg'];
                }

                //T4_max
                if ($datos[$long][$lo]['T4_max'] == "NAN") {
                    $dst4max = 0;
                } else {
                    $dst4max = $datos[$long][$lo]['T4_max'];
                }

                //T4_min
                if ($datos[$long][$lo]['T4_min'] == "NAN") {
                    $dst4min = 0;
                } else {
                    $dst4min = $datos[$long][$lo]['T4_min'];
                }

                //T5_avg
                if ($datos[$long][$lo]['T5_avg'] == "NAN") {
                    $dst5avg = 0;
                } else {
                    $dst5avg = $datos[$long][$lo]['T5_avg'];
                }

                //T5_max
                if ($datos[$long][$lo]['T5_max'] == "NAN") {
                    $dst5max = 0;
                } else {
                    $dst5max = $datos[$long][$lo]['T5_max'];
                }

                //T5_min
                if ($datos[$long][$lo]['T5_min'] == "NAN") {
                    $dst5min = 0;
                } else {
                    $dst5min = $datos[$long][$lo]['T5_min'];
                }

                //T6_avg
                if ($datos[$long][$lo]['T6_avg'] == "NAN") {
                    $dst6avg = 0;
                } else {
                    $dst6avg = $datos[$long][$lo]['T6_avg'];
                }

                //T6_max
                if ($datos[$long][$lo]['T6_max'] == "NAN") {
                    $dst6max = 0;
                } else {
                    $dst6max = $datos[$long][$lo]['T6_max'];
                }

                //T6_min
                if ($datos[$long][$lo]['T6_min'] == "NAN") {
                    $dst6min = 0;
                } else {
                    $dst6min = $datos[$long][$lo]['T6_min'];
                }

                //T7_avg
                if ($datos[$long][$lo]['T7_avg'] == "NAN") {
                    $dst7avg = 0;
                } else {
                    $dst7avg = $datos[$long][$lo]['T7_avg'];
                }

                //T7_max
                if ($datos[$long][$lo]['T7_max'] == "NAN") {
                    $dst7max = 0;
                } else {
                    $dst7max = $datos[$long][$lo]['T7_max'];
                }

                //T7_min
                if ($datos[$long][$lo]['T7_min'] == "NAN") {
                    $dst7min = 0;
                } else {
                    $dst7min = $datos[$long][$lo]['T7_min'];
                }

                //T75_avg
                if ($datos[$long][$lo]['T75_avg'] == "NAN") {
                    $dst75avg = 0;
                } else {
                    $dst75avg = $datos[$long][$lo]['T75_avg'];
                }

                //T75_max
                if ($datos[$long][$lo]['T75_max'] == "NAN") {
                    $dst75max = 0;
                } else {
                    $dst75max = $datos[$long][$lo]['T75_max'];
                }

                //T75_min
                if ($datos[$long][$lo]['T75_min'] == "NAN") {
                    $dst75min = 0;
                } else {
                    $dst75min = $datos[$long][$lo]['T75_min'];
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
            $datetime = $dataset['Fecha_HoraRegistro']->toDateTime();
            $a = $datetime->format('Y-m-d\TH:i:s.u');
        } else {
            if ($intervalo == "30min") {
                $a = $dataset['Fecha_HoraRegistro'];
            }
        }

        //Validacion NAN
        //Temp_Amb
        if ($dataset['Temp_Amb'] == "NAN") {
            $dsta = 0;
        } else {
            $dsta = $dataset['Temp_Amb'];
        }

        //T0_avg
        if ($dataset['T0_avg'] == "NAN") {
            $dst0avg = 0;
        } else {
            $dst0avg = $dataset['T0_avg'];
        }

        //T0_max
        if ($dataset['T0_max'] == "NAN") {
            $dst0max = 0;
        } else {
            $dst0max = $dataset['T0_max'];
        }

        //T0_min
        if ($dataset['T0_min'] == "NAN") {
            $dst0min = 0;
        } else {
            $dst0min = $dataset['T0_min'];
        }

        //T1_avg
        if ($dataset['T1_avg'] == "NAN") {
            $dst1avg = 0;
        } else {
            $dst1avg = $dataset['T1_avg'];
        }

        //T1_max
        if ($dataset['T1_max'] == "NAN") {
            $dst1max = 0;
        } else {
            $dst1max = $dataset['T1_max'];
        }

        //T1_min
        if ($dataset['T1_min'] == "NAN") {
            $dst1min = 0;
        } else {
            $dst1min = $dataset['T1_min'];
        }

        //T2_avg
        if ($dataset['T2_avg'] == "NAN") {
            $dst2avg = 0;
        } else {
            $dst2avg = $dataset['T2_avg'];
        }

        //T2_max
        if ($dataset['T2_max'] == "NAN") {
            $dst2max = 0;
        } else {
            $dst2max = $dataset['T2_max'];
        }

        //T2_min
        if ($dataset['T2_min'] == "NAN") {
            $dst2min = 0;
        } else {
            $dst2min = $dataset['T2_min'];
        }

        //T3_avg
        if ($dataset['T3_avg'] == "NAN") {
            $dst3avg = 0;
        } else {
            $dst3avg = $dataset['T3_avg'];
        }

        //T3_max
        if ($dataset['T3_max'] == "NAN") {
            $dst3max = 0;
        } else {
            $dst3max = $dataset['T3_max'];
        }

        //T3_min
        if ($dataset['T3_min'] == "NAN") {
            $dst3min = 0;
        } else {
            $dst3min = $dataset['T3_min'];
        }

        //T4_avg
        if ($dataset['T4_avg'] == "NAN") {
            $dst4avg = 0;
        } else {
            $dst4avg = $dataset['T4_avg'];
        }

        //T4_max
        if ($dataset['T4_max'] == "NAN") {
            $dst4max = 0;
        } else {
            $dst4max = $dataset['T4_max'];
        }

        //T4_min
        if ($dataset['T4_min'] == "NAN") {
            $dst4min = 0;
        } else {
            $dst4min = $dataset['T4_min'];
        }

        //T5_avg
        if ($dataset['T5_avg'] == "NAN") {
            $dst5avg = 0;
        } else {
            $dst5avg = $dataset['T5_avg'];
        }

        //T5_max
        if ($dataset['T5_max'] == "NAN") {
            $dst5max = 0;
        } else {
            $dst5max = $dataset['T5_max'];
        }

        //T5_min
        if ($dataset['T5_min'] == "NAN") {
            $dst5min = 0;
        } else {
            $dst5min = $dataset['T5_min'];
        }

        //T6_avg
        if ($dataset['T6_avg'] == "NAN") {
            $dst6avg = 0;
        } else {
            $dst6avg = $dataset['T6_avg'];
        }

        //T6_max
        if ($dataset['T6_max'] == "NAN") {
            $dst6max = 0;
        } else {
            $dst6max = $dataset['T6_max'];
        }

        //T6_min
        if ($dataset['T6_min'] == "NAN") {
            $dst6min = 0;
        } else {
            $dst6min = $dataset['T6_min'];
        }

        //T7_avg
        if ($dataset['T7_avg'] == "NAN") {
            $dst7avg = 0;
        } else {
            $dst7avg = $dataset['T7_avg'];
        }

        //T7_max
        if ($dataset['T7_max'] == "NAN") {
            $dst7max = 0;
        } else {
            $dst7max = $dataset['T7_max'];
        }

        //T7_min
        if ($dataset['T7_min'] == "NAN") {
            $dst7min = 0;
        } else {
            $dst7min = $dataset['T7_min'];
        }

        //T75_avg
        if ($dataset['T75_avg'] == "NAN") {
            $dst75avg = 0;
        } else {
            $dst75avg = $dataset['T75_avg'];
        }

        //T75_max
        if ($dataset['T75_max'] == "NAN") {
            $dst75max = 0;
        } else {
            $dst75max = $dataset['T75_max'];
        }

        //T75_min
        if ($dataset['T75_min'] == "NAN") {
            $dst75min = 0;
        } else {
            $dst75min = $dataset['T75_min'];
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
                    label: "Temp_Amb",
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
                    label: "T0_avg",
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
                    label: "T0_max",
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
                    label: "T0_min",
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
                    label: "T1_avg",
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
                    label: "T1_max",
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
                    label: "T1_min",
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
                    label: "T2_avg",
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
                    label: "T2_max",
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
                    label: "T2_min",
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
                    label: "T3_avg",
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
                    label: "T3_max",
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
                    label: "T3_min",
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
                    label: "T4_avg",
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
                    label: "T4_max",
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
                    label: "T4_min",
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
                    label: "T5_avg",
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
                    label: "T5_max",
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
                    label: "T5_min",
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
                    label: "T6_avg",
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
                    label: "T6_max",
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
                    label: "T6_min",
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
                    label: "T7_avg",
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
                    label: "T7_max",
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
                    label: "T7_min",
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
                    label: "T75_avg",
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
                    label: "T75_max",
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
                    label: "T75_min",
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