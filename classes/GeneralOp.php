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

    public function consulta15min($f_ini, $f_fin, $operaciones) {
        $rango = array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000)));
        $result = $operaciones->findAll($rango);
        return $result;
    }

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
    
    public function consulta1dia($f_ini, $f_fin, $operaciones) {
        $rango = array("Fecha_HoraRegistro" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000)));
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
      
        //array_push($this->datos,$resultado);
        return $resultado;
    }

}
