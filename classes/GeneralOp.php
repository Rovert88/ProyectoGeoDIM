<?php

class GeneralOp {

    private $datos = array();           
    
    //Metodo para dar formato a las fechas iniciales AAAA-MM-DDT00:00:00.000Z
    public function ordenaFechai($fecha) {
        $fecha = explode('/', $fecha);
        return $fecha[2] . "-" . $fecha[0] . "-" . $fecha[1] . "T00:00:00.000Z";
    }

    //Metodo para dar formato a las fechas finales AAAA-MM-DDT23:59:59.000Z
    public function ordenaFechaf($fecha) {
        $fecha = explode('/', $fecha);
        return $fecha[2] . "-" . $fecha[0] . "-" . $fecha[1] . "T23:59:59.000Z";
    }
    
    //Metodo para dar formato a las fechas de los registros (Carga de archivos CSV)
    public function insFormatoFecha($fecha) {
        $fecha = explode('/', $fecha);
        $time = explode(' ', $fecha[2]);
        return $time[0] . "-" . $fecha[1] . "-" . $fecha[0] . " " . $time[1] . ":00.000Z";
    }
    
    //Consulta de datos de temperaturas (general)
    public function consultarDatos($idsitio, $f_ini, $f_fin, $operaciones) {
               
        $rango = array("\$and"=>array(array( "TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))),array('NOMBRE_SITIO' => $idsitio)));
        $result = $operaciones->findAll($rango); 
        
        $resultado = array();
        foreach($result as $datos){
            $resultArr = iterator_to_array($datos);
            array_push($resultado,$resultArr);
        }
        return $resultado;             
    }               
    
    //Metodo obtener columnas de datos
    public function obtenerColumnas($id, $operaciones){
        $parametro = "NS".$id; //Definicion de parametro de busqueda
        $consulta = array('NOMBRE_SITIO' => $parametro); //Definicion de filtro de busqueda en la clave NOMBRE_SITIO
        $result = $operaciones->findAll($consulta); //Consulta a la BD
        //$encabezados = iterator_to_array($result); //Creacion de array de encabezado con el resultado de la consulta
        foreach($result as $encabezados){
            $enc = get_object_vars($encabezados);
        }        
        return $enc; //Retorno del array
    }
    
    //Metodo obtener fechas de registros de datos
    public function consultaFechas($idSitio, $f_ini, $f_fin, $operaciones){               
        $rango = array("\$and" => array( array( "TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))), array('NOMBRE_SITIO' => $idSitio)));
        $result = $operaciones->findAll($rango);
        
        $arrFechas = array();
        foreach($result as $fechas){
            $vFecha = $fechas['TIMESTAMP']->toDateTime();
            $formato = $vFecha->format('d/m/Y\ - H:i:s');
            array_push($arrFechas, $formato);
        }
        return $arrFechas;
    }
    
    //Metodo obtener datos fechas multiples (Graficas SI Temp-Prof)
    public function consultaFechasMulti($idSitio, $f_ini, $f_fin, $operaciones){
        $rango = array("\$and"=>array(array( "TIMESTAMP" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime($f_ini) * 1000), "\$lte" => new MongoDB\BSON\UTCDateTime(strtotime($f_fin) * 1000))),array('NOMBRE_SITIO' => $idSitio)));
        $result = $operaciones->findAll($rango);
        
        $resultado = array();
        foreach($result as $datos){
            $resultArr = iterator_to_array($datos);
            array_push($resultado,$resultArr);
        }
        return $resultado;
    }
}
