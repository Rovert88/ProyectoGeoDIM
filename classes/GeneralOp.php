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
    public function consulta15min($f_ini, $f_fin, $operaciones) {
        $rango = array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000)));
        $result = $operaciones->findAll($rango);
        return $result;
    }

    //Metodos de consulta para Sondas de Inspeccion
    
    //Consulta cada 30 min
    public function consulta30min($f_ini, $f_fin, $operaciones) {
        $fecha = array();
        $rango = array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000)));
        $result = $operaciones->findAll($rango);
        $cont = 1;
        foreach ($result as $dato) {
            if (($cont % 2) == 0) {   
                 $datetime = $dato['Fecha_HoraRegistro']->toDateTime();
                 $a=$datetime->format('Y-m-d\TH:i:s.u');
                array_push($fecha,["Fecha_HoraRegistro" => $a,
                    "Temp_Amb"=>$dato["Temp_Amb"],
                    "T0_avg"=>$dato["T0_avg"],
                    "T0_max"=>$dato["T0_max"],
                    "T0_min"=>$dato["T0_min"],
                    "T1_avg"=>$dato["T1_avg"],
                    "T1_max"=>$dato["T1_max"],
                    "T1_min"=>$dato["T1_min"],
                    "T2_avg"=>$dato["T2_avg"],
                    "T2_max"=>$dato["T2_max"],
                    "T2_min"=>$dato["T2_min"],
                    "T3_avg"=>$dato["T3_avg"],
                    "T3_max"=>$dato["T3_max"],
                    "T3_min"=>$dato["T3_min"],
                    "T4_avg"=>$dato["T4_avg"],
                    "T4_max"=>$dato["T4_max"],
                    "T4_min"=>$dato["T4_min"],
                    "T5_avg"=>$dato["T5_avg"],
                    "T5_max"=>$dato["T5_max"],
                    "T5_min"=>$dato["T5_min"],
                    "T6_avg"=>$dato["T6_avg"],
                    "T6_max"=>$dato["T6_max"],
                    "T6_min"=>$dato["T6_min"],
                    "T7_avg"=>$dato["T7_avg"],
                    "T7_max"=>$dato["T7_max"],
                    "T7_min"=>$dato["T7_min"],
                    "T75_avg"=>$dato["T75_avg"],
                    "T75_max"=>$dato["T75_max"],
                    "T75_min"=>$dato["T75_min"],                    
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
        // seleccina Fecha_HoraRegistro donde sea mayor a $f_ini y menor que $f_fin y donde id sea iguala $sitio
        //
        //AND { $and: [ { price: { $ne: 1.99 } }, { price: { $exists: true } } ] }
        $rango = array("\$and"=>array(array( "Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))),array('NombreSitio' => $idsitio)));
        $result = $operaciones->findAll($rango); 
        $resultado= array();
        $prom = 0;
        $cont = 0;
        $T0_avg=0;
        $T0_max=0;
        $T0_min=0;
        $T1_avg=0;
        $T1_max=0;
        $T1_min=0;
        $T2_avg=0;
        $T2_max=0;
        $T2_min=0;
        $T3_avg=0;
        $T3_max=0;
        $T3_min=0;
        $T4_avg=0;
        $T4_max=0;
        $T4_min=0;
        $T5_avg=0;
        $T5_max=0;
        $T5_min=0;
        $T6_avg=0;
        $T6_max=0;
        $T6_min=0;
        $T7_avg=0;
        $T7_max=0;
        $T7_min=0;
        $T75_avg=0;
        $T75_max=0;
        $T75_min=0;
        foreach ($result as $dato) {            
            $prom += $dato["Temp_Amb"];
            $T0_avg+= $dato["T0_avg"];
            $T0_max+= $dato["T0_max"];
            $T0_min+=$dato{"T0_min"};
            $T1_avg+=$dato["T1_avg"];
            $T1_max+=$dato["T1_max"];
            $T1_min+=$dato["T1_min"];
            $T2_avg+=$dato["T2_avg"];
            $T2_max+=$dato["T2_max"];
            $T2_min+=$dato["T2_min"];
            $T3_avg+=$dato["T3_avg"];
            $T3_max+=$dato["T3_max"];
            $T3_min+=$dato["T3_min"];
            $T4_avg+=$dato["T4_avg"];
            $T4_max+=$dato["T4_max"];
            $T4_min+=$dato["T4_min"];
            $T5_avg+=$dato["T5_avg"];
            $T5_max+=$dato["T5_max"];
            $T5_min+=$dato["T5_min"];
            $T6_avg+=$dato["T6_avg"];
            $T6_max+=$dato["T6_max"];
            $T6_min+=$dato["T6_min"];
            $T7_avg+=$dato["T7_avg"];
            $T7_max+=$dato["T7_max"];
            $T7_min+=$dato["T7_min"];
            $T75_avg+=$dato["T75_avg"];
            $T75_max+=$dato["T75_max"];
            $T75_min+=$dato["T75_min"];
            $cont += 1;                        
        }
        $prom = $prom/$cont;
        $T0_avg = $T0_avg/$cont;
        $T0_max = $T0_max/$cont;
        $T0_min = $T0_min /$cont;
        $T1_avg = $T1_avg /$cont;
        $T1_max = $T1_max /$cont;
        $T1_min = $T1_min /$cont;
        $T2_avg = $T2_avg /$cont;
        $T2_max = $T2_max /$cont;
        $T2_min = $T2_min /$cont;
        $T3_avg = $T3_avg /$cont;
        $T3_max = $T3_max /$cont;
        $T3_min = $T3_min /$cont;
        $T4_avg = $T4_avg /$cont;
        $T4_max = $T4_max /$cont;
        $T4_min = $T4_min /$cont;
        $T5_avg = $T5_avg /$cont;
        $T5_max = $T5_max /$cont;
        $T5_min = $T5_min /$cont;
        $T6_avg = $T6_avg /$cont;
        $T6_max = $T6_max /$cont;
        $T6_min = $T6_min /$cont;
        $T7_avg = $T7_avg /$cont;
        $T7_max = $T7_max /$cont;
        $T7_min = $T7_min /$cont;
        $T75_avg = $T75_avg /$cont;
        $T75_max = $T75_max /$cont;
        $T75_min = $T75_min /$cont;
      array_push($resultado,[
                    "Temp_Amb"=>$prom,
                    "T0_avg"=>$T0_avg,
                    "T0_max"=>$T0_max,
                    "T0_min"=>$T0_min,
                    "T1_avg"=> $T1_avg,
                    "T1_max"=>$T1_max,
                    "T1_min"=>$T1_min,
                    "T2_avg"=>$T2_avg,
                    "T2_max"=>$T2_max,
                    "T2_min"=> $T2_min,
                    "T3_avg"=>$T3_avg,
                    "T3_max"=>$T3_max,
                    "T3_min"=>$T3_min,
                    "T4_avg"=>$T4_avg,
                    "T4_max"=>$T4_max,
                    "T4_min"=>$T4_min,
                    "T5_avg"=>$T5_avg,
                    "T5_max"=>$T5_max,
                    "T5_min"=>$T5_min,
                    "T6_avg"=>$T6_avg,
                    "T6_max"=>$T6_max,
                    "T6_min"=>$T6_min,
                    "T7_avg"=>$T7_avg,
                    "T7_max"=>$T7_max,
                    "T7_min"=>$T7_min,
                    "T75_avg"=>$T75_avg,
                    "T75_max"=>$T75_max,
                    "T75_min"=>$T75_min,                    
                    ]);
      
        return $resultado;
    }        
    
    
    //Metodos de consulta para Bombas de Calor Geotermico
    
    //Consulta cada 30 min
    public function consulta30minBCG($f_ini, $f_fin, $operaciones){
        $fecha = array();
        $rango = array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000)));
        $result = $operaciones->findAll($rango);
        $cont = 1;
        foreach($result as $dato){
            if(($cont % 2) == 0){
                $datetime = $dato['Fecha_HoraRegistro']->toDateTime();
                $a = $datetime->format('Y-m-d\TH:i:s.u');
                array_push($fecha, [
                    "Fecha_HoraRegistro" => $a,
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
        $rango = array("\$and" => array(array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))), array('NombreSitio' => $idsitio)));
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
    
    //Consulta cada 30 min
    //Funsiones consultas de datos bateria CR800
    public function consulta1hrBatCR800($f_ini, $f_fin, $operaciones){        
        $rango = array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000)));
        $result = $operaciones->findAll($rango);
        
        return $result;
    }
    
    //Consulta cada dia
    public function consulta1diaBatCR800($idsitio, $f_ini, $f_fin, $operaciones){
        $rango = array("\$and" => array(array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))), array('NombreSitio' => $idsitio)));
        $result = $operaciones->findAll($rango);
        $resultado = array();
        $prom = 0;
        $cont = 0;
        $BattV_Min = 0;
        
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
