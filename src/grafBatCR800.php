<!DOCTYPE html>

<?php
    //Generacion de graficas de datos de Bateria de CR800

    require '../classes/ConexionDB.php';
    require '../classes/CRUD.php';
    require '../vendor/autoload.php';
    require '../classes/GeneralOp.php';

    //Conexion
    $connect = new DBConnection();
    $traerColl = $connect->ConectarBD();
    $objData = $traerColl->Registros_Bateria_CR800;
    $operaciones = new CRUD($objData);
    $generalOp = new GeneralOp();

    //Captura de datos del formulario
    $idSitio = $_POST['sitio'];
    $intervalo = $_POST['inter'];
    $f_ini = $_POST['ini'];
    $f_fin = $_POST['fin'];

    //Formatear fechas
    $f_ini = $generalOp->ordenaFechai($f_ini);
    $f_fin = $generalOp->ordenaFechaf($f_fin);

    //Obtener encabezados
    $encabezados = $generalOp->obtenerColumnas($idSitio, $operaciones);

    //Elegir intervalos
    if ($intervalo == '1hr') {
        //Obtener datos de la BatCR800
        $datos = $generalOp->consultarDatos($idSitio, $f_ini, $f_fin, $operaciones);
        //Obtener las fechas de los registros
        $fechas = $generalOp->consultaFechas($idSitio, $f_ini, $f_fin, $operaciones);

        $arrEncabezados = array(); //Array para contener encabezados (Claves de la matriz)
        $arrDatos = array(); //Array para contener datos (Valores de la matriz)
        $matrizDatos = array(); //Array auxiliar para guardar la combinacion del arrEncabezados con ArrDatos
        $matrizFinal = array(); //Array con todos los arreglos generados y añadidos a matrizDatos

        //Crear matriz asociativa
        //Ciclo para obtener los valores de los encabezados de la BD
        foreach($encabezados as $claveEnc => $valoresEnc){
            //Comprobar si tiene un subnivel
            if(is_array($valoresEnc)){
                foreach($valoresEnc as $clavEncInt => $valorEncInt){
                    array_push($arrEncabezados, $valorEncInt); //Insertar en arrEncabezados los valores encontrados en la consulta de los encabezados en la BD
                }
                echo "\n";
            }else{
                array_push($arrEncabezados, $valoresEnc); //Insertar en arrEncabezados los valores encontrados en la consulta de los encabezados en la BD
            }
        }

        //Ciclo para obtener datos de la BD
        foreach($datos as $datosBD){
            array_push($arrDatos, $datosBD);
        }

        //Ciclo para asociar los arreglos arrEncabezados con arrDatos
        for($i = 0; $i < sizeof($arrDatos); $i++){
           $matrizDatos = array_combine($arrEncabezados, $arrDatos[$i]);
           array_push($matrizFinal, $matrizDatos);
        }

        //Ciclo para obtener los valores de cada columna de la matrizFinal
        $collMatriz = array();
        foreach($arrEncabezados as $columnas){
            $valoresGraf = array(array_column($matrizFinal, $columnas));
            array_push($collMatriz, $valoresGraf);
        }

        //Ciclo para extraer los valores de las columnas en arreglos separados
        $arrValores = array();
        foreach($collMatriz as $clave => $valor){
            foreach($valor as $cInt => $vInt){
                array_push($arrValores, $vInt);
            }
        }

        //Eliminar columnas no necesarias
        $arrProm = array();
        for($i = 4; $i < sizeof($arrValores); $i++){
            array_push($arrProm, $arrValores[$i]);
        }

        //Generar arreglo de fechas para etiquetas de grafica
        $arrLabel = array();
        foreach($fechas as $label){
            array_push($arrLabel, $label);
        }

    }

    if($intervalo == '1dia'){

        //Validacion fIni = fFin
        $f_ini2 = $_POST['ini'];
        $f_fin2 = $_POST['fin'];

        if($f_ini2 == $f_fin2){
            $f_fin_new = date("m/d/Y", strtotime($f_fin2 . "+ 1 days"));
            $f_fin_new = $generalOp->ordenaFechaf($f_fin_new);

            $f_ini = $f_ini2;
            $f_fin = $f_fin_new;
        }


        //Obtener datos de la SI
        $datos = $generalOp->consultarDatos($idSitio, $f_ini, $f_fin, $operaciones);
        //Obtener las fechas-horas de los registros
        $fechas = $generalOp->consultaFechas($idSitio, $f_ini, $f_fin, $operaciones);

        $arrEncabezados = array(); //Array para contener encabezados (Claves de la matriz)
        $arrDatos = array(); //Array para contener datos (Valores de la matriz)
        $matrizDatos = array(); //Array auxiliar para guardar la combinacion del arrEncabezados con ArrDatos
        $matrizFinal = array(); //Array con todos los arreglos generados y añadidos a matrizDatos

        //Crear matriz asociativa
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

        //Ciclo para obtener datos de la BD
        foreach($datos as $datosBD){
            array_push($arrDatos, $datosBD);
        }

        //Ciclo para asociar los arreglos SrrEncabezados con arrDatos
        for($i = 0; $i < sizeof($arrDatos); $i++){
            $matrizDatos = array_combine($arrEncabezados, $arrDatos[$i]);
            array_push($matrizFinal, $matrizDatos); //Insertar en matrizDatos
        }

        //Ciclo para obtener los valores de cada columna de la matrizFinal
        $collMatriz = array();
        foreach($arrEncabezados as $columnas){
            $valoresGraf = array(array_column($matrizFinal, $columnas));
            array_push($collMatriz, $valoresGraf);
        }

        //Ciclo para extraer los valores de las columnas en arreglos separados
        $arrValores = array();
        foreach($collMatriz as $clave => $valor){
            foreach($valor as $cInt => $vInt){
                array_push($arrValores, $vInt);
            }
        }

        //Eliminar columnas no necesarias
        $valoresColumnas = array();
        for($i = 4; $i < sizeof($arrValores); $i++){
            array_push($valoresColumnas, $arrValores[$i]);
        }

        //Calcular tamaño de sub arreglos
        $tamFragmento = 1440/60;

        //Calcular promedios de arreglos internos
        $arrProm = array();
        foreach($valoresColumnas as $datos){
            $arrFrag = array_chunk($datos, $tamFragmento);
            foreach ($arrFrag as $clave => $valor){
                $prom = round(array_sum($valor) / count($valor), 2);
                $arrResult[$clave] = $prom;
            }
            array_push($arrProm, $arrResult);
        }

        //Acomodar fechas por intervalo
        $cont = 0;
        $arrLabel = array();
        foreach($fechas as $label){
            if($cont % floor($tamFragmento) == 0){
                array_push($arrLabel, $label);
            }
            $cont += 1;
        }
    }
?>

<html lang="es">
    <head>
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
        var jEnc = <?php echo json_encode($arrEncabezados); ?>;
        var jDatos = <?php echo json_encode($arrProm); ?>;
        var jLabels = <?php echo json_encode($arrLabel); ?>;

        //------Generacion de DataSets dinamicos------
        var arrDataSets = []; //Array que contendra todos los JSON de los DataSets generados
        var dataSetAux = {}; //Objeto JSON que contendra los valores de los DataSets que se generan
        var lAux = []; //Array que contendra los valores de los encabezados(jEnc) despues de procesarlos
        var dAux = []; //Array que contendra los valores de los datos(jDatos) despues de procesarlos

        //Ciclo para saltar los 4 primeros elementos del array de Encabezados y Datos
        for(i = 4; i < jEnc.length; i++){
            lAux.push(jEnc[i]);
        }

        for(j = 0; j < jDatos.length; j++){
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
            labels: jLabels,
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
                text: "Comportamiento del voltaje de la batería del dispositivo CR800"
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
