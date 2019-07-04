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
    
    //Crear matriz asociativa
    //Ciclo para asociar los arreglos arrEncabezados con arrDatos        
    
    foreach($DatosFinal as $clave => $valor){
        foreach($valor as $c => $v){
            $matrizFinal[$clave][$c] = array_combine($arrEncabezados, $v);
        }
    }
    
    //Ciclo para obtener los valores de cada columna de la matrizFinal
    $collMatriz = array();    
    for($i = 0; $i < count($arrEncabezados); $i++){
        foreach($matrizFinal as $clave => $valor){
            $valoresGraf[$clave][$i] = array(array_column($valor, $arrEncabezados[$i]));                
        }
    }  

    //Ciclo para asociar los arreglos de las columnas con sus respectivos encabezados
    $valoresFinal = array();
    foreach($valoresGraf as $clave => $valor){
        $valoresFinal[$clave] = array_combine($arrEncabezados, $valor);       
    }
    
   //Obtener arreglos que solo contengan claves con sub string 'Avg'
   $arrAvgs = array();
   $arrClaves = array();
   foreach($valoresFinal as $clave => $valor){
       foreach($valor as $c => $v){
           foreach($v as $cInt => $vInt){
            //Se obtiene la clave y se pasa a mayusculas con "strtoupper"
            //Se busca el sub string "AVG" en el string de ka clave con "strpos"
            if(strpos(strtoupper($c), 'AVG')){
                $arrAvgs[$clave][$c] = $vInt; //Se asignan los valores obtenidos al arreglo "arrAvgs"
                $arrClaves[$c] = $c;           
            }
        }
       }
   }   
          
   //Obtener promedios de cada arreglo
   $arrPromAvg = array();
   foreach($arrAvgs as $clave => $valor){
       foreach($valor as $c => $v){
        $sum = array_sum($v);
        $prom = round(array_sum($v) / count($v), 2);                
        $arrPromAvg[$clave][$c] = $prom;
       }
    }
    
    //Llamada a metodos de eliminacion de clave PTemp_C_Avg
    $arrPromAvg = eliminaClavesDatos($arrPromAvg, "PTemp_C_Avg"); //Se elimina del arreglo de promedios
    $arrClaves = eliminaClavesEtiquetas($arrClaves, "PTemp_C_Avg"); //Se elimina del arreglo de claves individuales

    //Metodo eliminar clave de arreglo de promedios
    function eliminaClavesDatos($arrOriginal, $key){
        $arrAux = array();
        foreach($arrOriginal as $clave => $valor){            
            $arrAux[] = array_values($valor);
            unset($arrAux[$clave][$key]);
        }
        return $arrAux;
    }
    
    //Metodo eliminar clave de arreglo de claves
    function eliminaClavesEtiquetas($arrEtiquetas, $key){
        unset($arrEtiquetas[$key]);
        return $arrEtiquetas;
    }
    
    //Convertir arreglo de claves 
    $arrClavesAVG = array();
    foreach($arrClaves as $c){
        array_push($arrClavesAVG, $c);
    }                 
?>

<html lang="es">
    <head>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
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
        var jEnc = <?php echo json_encode($arrFechasIni); ?>;
        var jDatos = <?php echo json_encode($arrPromAvg); ?>;        
        var jLabels = <?php echo json_encode($arrClavesAVG); ?>;
        
        //------Generacion de DataSets dinamicos------
        var arrDataSets = []; //Array que contendra todos los JSON de los DataSets generados
        var dataSetAux = {}; //Objeto JSON que contendra los valores de los DataSets que se generan
        var lAux = []; //Array que contendra los valores de las labels (jLabels) de la grafica
        var dAux = []; //Array que contendra los valores de los datos(jDatos) despues de procesarlos
        var cadena;        
                        
        //Ciclo para generar las Labels
        for(i=0; i < jLabels.length; i++){
            cadena = "a "+i+" mts"
            lAux.push(cadena);
        }
        
        //Generar coordenadas de grafica
        var cAux = []; //Array auxiliar de coordenadas
        var coordenadas = []; //Array conjuntos de coordenadas
        
        for(var a = 0; a < jDatos.length; a++){
            for(var b = 0; b < lAux.length; b++){
                cAux.push({x: jDatos[a][b], y: lAux[b]});
            }
            coordenadas.push(cAux);
            cAux = [];
        }
        
        jEnc.forEach(function(item, index, array){
           dataSetAux = {
               label: jEnc[index],
               borderColor: colorAleatorio(),
               pointRadius: 0,
               pointHitRadius: 5,
               fill: false,
               data: coordenadas[index],
           }
           arrDataSets.push(dataSetAux);           
        });
        //------Generacion de DataSets dinamicos Fin------
        
        //Valores de la grafica
        var grafValores = {
            yLabels: lAux,
            datasets: arrDataSets,
        }
        
        //Configuraciones de la grafica
        var grafOpciones = {
            responsive: true,
            scales: {
                xAxes: [{
                        type: 'linear',
                        position: 'top',
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Temperatura °C"
                        },                        
                }],
                yAxes: [{
                        type: 'category',
                        position: 'left',
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Profundidad"
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
