<!DOCTYPE html>

<?php
    //Generacion de graficas de datos de SI Temperatura-Tiempo

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
    $idSitio = $_POST['sitio'];
    $intervalo = $_POST['inter'];
    $f_ini = $_POST['ini'];
    $f_fin = $_POST['fin'];
    
    //Valores para intervalo libre
    $interMuestreo = 15;
    
    //Formatear fechas
    $f_ini = $generalOp->ordenaFechai($f_ini);
    $f_fin = $generalOp->ordenaFechaf($f_fin);
    
    //Obtener encabezados
    $encabezados = $generalOp->obtenerColumnas($idSitio, $operaciones);
        
    //Elegir intervalos
    if($intervalo == '15min'){
        //Obtener datos de la SI
        $datos = $generalOp->consulta1dia($idSitio, $f_ini, $f_fin, $operaciones);
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
    
    if($intervalo >= '30'){
        //Obtener datos de la SI
        $datos = $generalOp->consulta1dia($idSitio, $f_ini, $f_fin, $operaciones);
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
        $tamFragmento = $intervalo/$interMuestreo;
        
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
        $datos = $generalOp->consulta1dia($idSitio, $f_ini, $f_fin, $operaciones);
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
        $tamFragmento = 1440/$interMuestreo;
        
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
        //------Generar colores aleatorios------
        function numAleatorio(vMin, vMax){
            posibilidades = vMax - vMin;
            ran = Math.random() * posibilidades;
            ran = Math.floor(ran);
            return parseInt(vMin) + ran;
        }
        
        function colorAleatorio(){
            hexadecimal = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F");
            cadenaColor = "#";
            for(i = 0; i < 6; i++){
                colorArray = numAleatorio(0, hexadecimal.length);
                cadenaColor += hexadecimal[colorArray];
            }
            return cadenaColor;
        }
        //------Generar colores aleatorios Fin------
        
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
        
        //Ciclo para saltar los 4 primeros elementos de array de Encabezados y Datos
        for(i=4; i < jEnc.length; i++){
            lAux.push(jEnc[i]);
        }
        
        for(j=0; j < jDatos.length; j++){
            dAux.push(jDatos[j]);
        }
        
        lAux.forEach(function(item, index, array){
            dataSetAux = {
                label: lAux[index],
                borderColor: colorAleatorio(),
                pointRadius: 0,
                pointHitRadius: 5,
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
                        },                        
                }],
                yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Temperatura °C"
                        },
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
