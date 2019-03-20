<?php

class GeneralOp {

    private $datos = array();       
    
    public function ordenaFechai($fecha) {

        $fecha = explode('/', $fecha);
        return $fecha[2] . "-" . $fecha[0] . "-" . $fecha[1] . "T00:00:00.000Z";
    }

    public function ordenaFechaf($fecha) {

        $fecha = explode('/', $fecha);
        return $fecha[2] . "-" . $fecha[0] . "-" . $fecha[1] . "T23:59:59.000Z";
    }

    public function insFormatoFecha($fecha) {
        $fecha = explode('/', $fecha);
        $time = explode(' ', $fecha[2]);
        return $time[0] . "-" . $fecha[1] . "-" . $fecha[0] . " " . $time[1] . ":00.000Z";
    }
    
    /*Metodo para consultar todos los datos de cualquier coleccion
    15 min para SI y BCG y 1 hr para BatCR800*/
    public function consulta15min($idsitio, $f_ini, $f_fin, $operaciones) {
        
        $rango = array("\$and"=>array(array( "TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))),array('NOMBRE_SITIO' => $idsitio)));
        $result = $operaciones->findAll($rango);
        return $result;
    }

    //Metodos de consulta para Sondas de Inspeccion
    
    //Consulta cada 30 min
    public function consulta30min($idsitio, $f_ini, $f_fin, $operaciones) {
        $fecha = array();        
        $rango = array("\$and"=>array(array( "TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))),array('NOMBRE_SITIO' => $idsitio)));
        $result = $operaciones->findAll($rango);
        $cont = 1;
        foreach ($result as $dato) {
            if (($cont % 2) == 0) {   
                 $datetime = $dato['TIMESTAMP']->toDateTime();
                 $a=$datetime->format('Y-m-d\TH:i:s.u');
                array_push($fecha,["TIMESTAMP" => $a,
                    "PTemp_C_Avg"=>$dato["PTemp_C_Avg"],
                    "T0_10cm_Avg"=>$dato["T0_10cm_Avg"],
                    "T0_10cm_Max"=>$dato["T0_10cm_Max"],
                    "T0_10cm_Min"=>$dato["T0_10cm_Min"],
                    "T1_1m_Avg"=>$dato["T1_1m_Avg"],
                    "T1_1m_Max"=>$dato["T1_1m_Max"],
                    "T1_1m_Min"=>$dato["T1_1m_Min"],
                    "T2_2m_Avg"=>$dato["T2_2m_Avg"],
                    "T2_2m_Max"=>$dato["T2_2m_Max"],
                    "T2_2m_Min"=>$dato["T2_2m_Min"],
                    "T3_3m_Avg"=>$dato["T3_3m_Avg"],
                    "T3_3m_Max"=>$dato["T3_3m_Max"],
                    "T3_3m_Min"=>$dato["T3_3m_Min"],
                    "T4_4m_Avg"=>$dato["T4_4m_Avg"],
                    "T4_4m_Max"=>$dato["T4_4m_Max"],
                    "T4_4m_Min"=>$dato["T4_4m_Min"],
                    "T5_5m_Avg"=>$dato["T5_5m_Avg"],
                    "T5_5m_Max"=>$dato["T5_5m_Max"],
                    "T5_5m_Min"=>$dato["T5_5m_Min"],
                    "T6_6m_Avg"=>$dato["T6_6m_Avg"],
                    "T6_6m_Max"=>$dato["T6_6m_Max"],
                    "T6_6m_Min"=>$dato["T6_6m_Min"],
                    "T7_7m_Avg"=>$dato["T7_7m_Avg"],
                    "T7_7m_Max"=>$dato["T7_7m_Max"],
                    "T7_7m_Min"=>$dato["T7_7m_Min"],
                    "T7_5_7_5m_Avg"=>$dato["T7_5_7_5m_Avg"],
                    "T7_5_7_5m_Max"=>$dato["T7_5_7_5m_Max"],
                    "T7_5_7_5m_Min"=>$dato["T7_5_7_5m_Min"],                    
                    ]);
            }
            $cont += 1;
        }

        return $fecha;
    }
    
    /*
        El metodo de consulta 1 dia tiene 4 parametros de los cuales el 
     * idsitio no era obligatorio cuando lo agrege pero despues se necestia para la consulta porque ya
     * estan relacioados los datos por lo cual quitamos que sea opcional
     *      */
    //Consulta cada dia
    public function consulta1dia($idsitio, $f_ini, $f_fin, $operaciones) {

        $rango = array("\$and"=>array(array( "TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))),array('NOMBRE_SITIO' => $idsitio)));
        $result = $operaciones->findAll($rango); 
        $resultado= array();
        $prom = 0;
        $cont = 0;
        $T0_10cm_Avg=0;
        $T0_10cm_Max=0;
        $T0_10cm_Min=0;
        $T1_1m_Avg=0;
        $T1_1m_Max=0;
        $T1_1m_Min=0;
        $T2_2m_Avg=0;
        $T2_2m_Max=0;
        $T2_2m_Min=0;
        $T3_3m_Avg=0;
        $T3_3m_Max=0;
        $T3_3m_Min=0;
        $T4_4m_Avg=0;
        $T4_4m_Max=0;
        $T4_4m_Min=0;
        $T5_5m_Avg=0;
        $T5_5m_Max=0;
        $T5_5m_Min=0;
        $T6_6m_Avg=0;
        $T6_6m_Max=0;
        $T6_6m_Min=0;
        $T7_7m_Avg=0;
        $T7_7m_Max=0;
        $T7_7m_Min=0;
        $T7_5_7_5m_Avg=0;
        $T7_5_7_5m_Max=0;
        $T7_5_7_5m_Min=0;
        foreach ($result as $dato) {            
            $prom += $dato["PTemp_C_Avg"];
            $T0_10cm_Avg+= $dato["T0_10cm_Avg"];
            $T0_10cm_Max+= $dato["T0_10cm_Max"];
            $T0_10cm_Min+=$dato{"T0_10cm_Min"};
            $T1_1m_Avg+=$dato["T1_1m_Avg"];
            $T1_1m_Max+=$dato["T1_1m_Max"];
            $T1_1m_Min+=$dato["T1_1m_Min"];
            $T2_2m_Avg+=$dato["T2_2m_Avg"];
            $T2_2m_Max+=$dato["T2_2m_Max"];
            $T2_2m_Min+=$dato["T2_2m_Min"];
            $T3_3m_Avg+=$dato["T3_3m_Avg"];
            $T3_3m_Max+=$dato["T3_3m_Max"];
            $T3_3m_Min+=$dato["T3_3m_Min"];
            $T4_4m_Avg+=$dato["T4_4m_Avg"];
            $T4_4m_Max+=$dato["T4_4m_Max"];
            $T4_4m_Min+=$dato["T4_4m_Min"];
            $T5_5m_Avg+=$dato["T5_5m_Avg"];
            $T5_5m_Max+=$dato["T5_5m_Max"];
            $T5_5m_Min+=$dato["T5_5m_Min"];
            $T6_6m_Avg+=$dato["T6_6m_Avg"];
            $T6_6m_Max+=$dato["T6_6m_Max"];
            $T6_6m_Min+=$dato["T6_6m_Min"];
            $T7_7m_Avg+=$dato["T7_7m_Avg"];
            $T7_7m_Max+=$dato["T7_7m_Max"];
            $T7_7m_Min+=$dato["T7_7m_Min"];
            $T7_5_7_5m_Avg+=$dato["T7_5_7_5m_Avg"];
            $T7_5_7_5m_Max+=$dato["T7_5_7_5m_Max"];
            $T7_5_7_5m_Min+=$dato["T7_5_7_5m_Min"];
            $cont += 1;                        
        }
        $prom = $prom/$cont;
        $T0_10cm_Avg = $T0_10cm_Avg/$cont;
        $T0_10cm_Max = $T0_10cm_Max/$cont;
        $T0_10cm_Min = $T0_10cm_Min /$cont;
        $T1_1m_Avg = $T1_1m_Avg /$cont;
        $T1_1m_Max = $T1_1m_Max /$cont;
        $T1_1m_Min = $T1_1m_Min /$cont;
        $T2_2m_Avg = $T2_2m_Avg /$cont;
        $T2_2m_Max = $T2_2m_Max /$cont;
        $T2_2m_Min = $T2_2m_Min /$cont;
        $T3_3m_Avg = $T3_3m_Avg /$cont;
        $T3_3m_Max = $T3_3m_Max /$cont;
        $T3_3m_Min = $T3_3m_Min /$cont;
        $T4_4m_Avg = $T4_4m_Avg /$cont;
        $T4_4m_Max = $T4_4m_Max /$cont;
        $T4_4m_Min = $T4_4m_Min /$cont;
        $T5_5m_Avg = $T5_5m_Avg /$cont;
        $T5_5m_Max = $T5_5m_Max /$cont;
        $T5_5m_Min = $T5_5m_Min /$cont;
        $T6_6m_Avg = $T6_6m_Avg /$cont;
        $T6_6m_Max = $T6_6m_Max /$cont;
        $T6_6m_Min = $T6_6m_Min /$cont;
        $T7_7m_Avg = $T7_7m_Avg /$cont;
        $T7_7m_Max = $T7_7m_Max /$cont;
        $T7_7m_Min = $T7_7m_Min /$cont;
        $T7_5_7_5m_Avg = $T7_5_7_5m_Avg /$cont;
        $T7_5_7_5m_Max = $T7_5_7_5m_Max /$cont;
        $T7_5_7_5m_Min = $T7_5_7_5m_Min /$cont;
      array_push($resultado,[
                    "PTemp_C_Avg"=>$prom,
                    "T0_10cm_Avg"=>$T0_10cm_Avg,
                    "T0_10cm_Max"=>$T0_10cm_Max,
                    "T0_10cm_Min"=>$T0_10cm_Min,
                    "T1_1m_Avg"=> $T1_1m_Avg,
                    "T1_1m_Max"=>$T1_1m_Max,
                    "T1_1m_Min"=>$T1_1m_Min,
                    "T2_2m_Avg"=>$T2_2m_Avg,
                    "T2_2m_Max"=>$T2_2m_Max,
                    "T2_2m_Min"=> $T2_2m_Min,
                    "T3_3m_Avg"=>$T3_3m_Avg,
                    "T3_3m_Max"=>$T3_3m_Max,
                    "T3_3m_Min"=>$T3_3m_Min,
                    "T4_4m_Avg"=>$T4_4m_Avg,
                    "T4_4m_Max"=>$T4_4m_Max,
                    "T4_4m_Min"=>$T4_4m_Min,
                    "T5_5m_Avg"=>$T5_5m_Avg,
                    "T5_5m_Max"=>$T5_5m_Max,
                    "T5_5m_Min"=>$T5_5m_Min,
                    "T6_6m_Avg"=>$T6_6m_Avg,
                    "T6_6m_Max"=>$T6_6m_Max,
                    "T6_6m_Min"=>$T6_6m_Min,
                    "T7_7m_Avg"=>$T7_7m_Avg,
                    "T7_7m_Max"=>$T7_7m_Max,
                    "T7_7m_Min"=>$T7_7m_Min,
                    "T7_5_7_5m_Avg"=>$T7_5_7_5m_Avg,
                    "T7_5_7_5m_Max"=>$T7_5_7_5m_Max,
                    "T7_5_7_5m_Min"=>$T7_5_7_5m_Min,                    
                    ]);
      
        return $resultado;
    }        
    
    
    //Metodos de consulta para Bombas de Calor Geotermico        
    
        //Metodo de prueba para intervalo libre
    public function consultaIntervalo($idsitio, $intervalo, $f_ini, $f_fin, $operaciones){
        //Valores para intervalo libre
        $intervalo_muestreo = 2;
        //$cont = 0;
        
        //Valores de la consulta
        $fecha = array();
        $rango = array("\$and"=>array(array( "TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))),array('NOMBRE_SITIO' => $idsitio)));
        $result = $operaciones->findAll($rango);
        $cont = 0;
        
        foreach($result as $dato){
            if($cont % floor($intervalo / $intervalo_muestreo) == 0){
                $datetime = $dato['TIMESTAMP']->toDateTime();
                $a = $datetime->format('Y-m-d\TH:i:s.u');
                array_push($fecha, [
                    "TIMESTAMP" => $a,
                    "Bat_CR800" => $dato["Bat_CR800"],
                    "Temp_CR800" => $dato["Temp_CR800"],
                    "EAT_DegF" => $dato["EAT_DegF"],
                    "LAT_DegF" => $dato["LAT_DegF"],
                    "EWT_DegF" => $dato["EWT_DegF"],
                    "LWT_DegF" => $dato["LWT_DegF"],
                    "CT_Amp" => $dato["CT_Amp"],
                    "EAT_DegC" => $dato["EAT_DegC"],
                    "LAT_DegC" => $dato["LAT_DegC"],
                    "EWT_DegC" => $dato["EWT_DegC"],
                    "LWT_DegC" => $dato["LWT_DegC"],
                ]);
            }
            $cont += 1;
        }
        return $fecha;
    }        
    
    //Consulta cada dia
    public function consulta1diaBCG($idsitio, $f_ini, $f_fin, $operaciones){
        $rango = array("\$and" => array(array("TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))), array('NOMBRE_SITIO' => $idsitio)));
        $result = $operaciones->findAll($rango);
        $resultado = array();
        $prom = 0;
        $cont = 0;
        $Bat_CR800 = 0;
        $Temp_CR800 = 0;
        $EAT_DegF = 0;
        $LAT_DegF = 0;
        $EWT_DegF = 0;
        $LWT_DegF = 0;        
        $CT_Amp = 0;
        $EAT_DegC = 0;
        $LAT_DegC = 0;
        $EWT_DegC = 0;
        $LWT_DegC = 0;
        
        foreach($result as $dato){
            $prom += $dato["Bat_CR800"];
            $Temp_CR800 += $dato["Temp_CR800"];
            $EAT_DegF += $dato["EAT_DegF"];
            $LAT_DegF += $dato["LAT_DegF"];
            $EWT_DegF += $dato["EWT_DegF"];
            $LWT_DegF += $dato["LWT_DegF"];            
            $CT_Amp += $dato["CT_Amp"];
            $EAT_DegC += $dato["EAT_DegC"];
            $LAT_DegC += $dato["LAT_DegC"];
            $EWT_DegC += $dato["EWT_DegC"];
            $LWT_DegC += $dato["LWT_DegC"];
            $cont += 1;
        }
              
        $prom = $prom/$cont;
        $Temp_CR800 = $Temp_CR800/$cont;
        $EAT_DegF = $EAT_DegF/$cont;
        $LAT_DegF = $LAT_DegF/$cont;
        $EWT_DegF = $EWT_DegF/$cont;
        $LWT_DegF = $LWT_DegF/$cont;
        $CT_Amp = $CT_Amp/$cont;
        $EAT_DegC = $EAT_DegC/$cont;
        $LAT_DegC = $LAT_DegC/$cont;
        $EWT_DegC = $EWT_DegC/$cont;
        $LWT_DegC = $LWT_DegC/$cont;
        
        //Insertar los promedios en un array para enviarlos al metodo de graficacion
        array_push($resultado,[
            "Bat_CR800" => $prom,
            "Temp_CR800" => $Temp_CR800,
            "EAT_DegF" => $EAT_DegF,
            "LAT_DegF" => $LAT_DegF,
            "EWT_DegF" => $EWT_DegF,
            "LWT_DegF" => $LWT_DegF,
            "CT_Amp" => $CT_Amp,
            "EAT_DegC" => $EAT_DegC,
            "LAT_DegC" => $LAT_DegC,
            "EWT_DegC" => $EWT_DegC,
            "LWT_DegC" => $LWT_DegC,
        ]);
        
        //Se regresa el array con los datos
        return $resultado;
    }
      
    //Metodos de consulta para Bateria de CR800*************
    
    //Consulta cada dia
    public function consulta1diaBatCR800($idsitio, $f_ini, $f_fin, $operaciones){
        $rango = array("\$and" => array(array("TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))), array('NOMBRE_SITIO' => $idsitio)));
        $result = $operaciones->findAll($rango);
        $resultado = array();
        $prom = 0;
        $cont = 0;        
        
        foreach($result as $dato){
            $prom += $dato["BattV_Min"];
            $cont += 1;
        }
        
        $prom = $prom/$cont;
        
        //Insertar los promedio en un array para enviarlos al metodo de graficacion
        array_push($resultado,[
            "BattV_Min" => $prom,
        ]);
        
        //Se regresa el array con los datos
        return $resultado;
    }
}
