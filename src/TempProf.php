<!DOCTYPE html>

<?php
require '../classes/ConexionDB.php';
require '../classes/CRUD.php';
require ("../assets/fusioncharts/fusioncharts.php");
require '../vendor/autoload.php';
require '../classes/GeneralOp.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Temperatura-Profundidad
        <?php
        $conn = new DBConnection();
        $collection = $conn->UpCSVSIConn();
        $operaciones = new CRUD($collection);
        $generalOp = new GeneralOp();
        $f_ini2 = $f_ini = $_POST['ini'];
        $f_fin2 = $f_fin = $_POST['fin'];
        $f_ini = $generalOp->ordenaFechai($f_ini);
        $f_fin = $generalOp->ordenaFechaf($f_fin);
        $datos = array();
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
        $categoryArray = array();

        for ($i = $f_ini2; $i <= $f_fin2; $i = date("m/d/Y", strtotime($i . "+ 1 days"))) {
            $f = $i;
            $f_ini = $generalOp->ordenaFechai($f);
            $f_fin = $generalOp->ordenaFechaf($f);
             array_push($categoryArray, ["label" => $f_ini]);
            $a = $generalOp->consulta1dia($f_ini, $f_fin, $operaciones);
            array_push($datos, $a);
        }
        for ($long = 0; $long <= sizeof($datos) - 1; $long++) {
            for ($lo = 0; $lo <= sizeof($datos[$long]) - 1; $lo++) {

                array_push($dataseries1, ["value" => $datos[$long][$lo]['T0_avg']]);
                array_push($dataseries2, ["value" => $datos[$long][$lo]['T1_avg']]);
                array_push($dataseries3, ["value" => $datos[$long][$lo]['T2_avg']]);
                array_push($dataseries4, ["value" => $datos[$long][$lo]['T3_avg']]);
                array_push($dataseries5, ["value" => $datos[$long][$lo]['T4_avg']]);
                array_push($dataseries6, ["value" => $datos[$long][$lo]['T5_avg']]);
                array_push($dataseries7, ["value" => $datos[$long][$lo]['T6_avg']]);
                array_push($dataseries8, ["value" => $datos[$long][$lo]['T7_avg']]);
                array_push($dataseries9, ["value" => $datos[$long][$lo]['T75_avg']]);
            }
        }
        
        $color= array("#000000","#FF0000","#FF8585","#A200FF","#8800D6","#D48AFF","#2B00FF","#1E00B5","#6F52FF","#008504","#698A6A","#DEB500","#DEC143","#FFE46B","#735600","#75632A","#B5983F","#0065B8","#4181B5","#78A6CC","#DE7600","#C9700A","#EDAA5C","#427500","#4F7321","#789157");
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
            labels: [ "0","-1","-2","-3","-4","-5","-6","-7","-7.5"],
            datasets: [
                <?php
for($p=0;$p<=sizeof($dataseries1)-1;$p++){
    echo "{
        data:[".
            $dataseries1[$p]["value"].",".$dataseries2[$p]["value"].",".$dataseries3[$p]["value"].",".$dataseries4[$p]["value"].",".$dataseries5[$p]["value"].",".$dataseries6[$p]["value"].",".$dataseries7[$p]["value"].",".$dataseries8[$p]["value"].",".$dataseries9[$p]["value"].","
            ."],
        label: '".$categoryArray[$p]["label"]."',
        borderColor: '".$color[$p]."',
        pointRadius: 5,
        fill: false,
        lineTension: 0,
        },";
    
}
                ?>
    
          ]},
        options: {
	pan: {
						enabled: true,
						mode: 'y'
					},
					zoom: {
						enabled: true,
						mode: 'y',
						limits: {
							max: 10,
							min: 0.5
						}
					},
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