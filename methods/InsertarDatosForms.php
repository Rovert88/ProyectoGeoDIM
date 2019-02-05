<?php

require_once '../classes/ConexionDB.php';

$connect = new DBConnection();
$collection = $connect->SGConn();

if($_POST){
    $data = array(
      //Datos de sitio
      'NombreSitio'=>$_POST['nombre_sitio'],
      'UbicacionSitio'=>$_POST['ubicacion_sitio'],
      'CoordSitio'=>$_POST['coord_sitio'],
      'RegPor'=>$_POST['reg_por'],
      'ClimaSitio'=>$_POST['clima_sitio'],
      //Datos de sonda
      'DatosSonda'=>[
      'NombreSonda'=>$_POST['nombre_sonda'],
      'TipoDispSonda'=>$_POST['disp_sonda'],
      'NoSerieDisp'=>$_POST['no_serie_disp_sonda'],
      'VerSODisp'=>$_POST['v_so_disp_sonda'],
      'FechaIniTrab'=>$_POST['f_ini_trab_sonda'],
      'HoraIniTrab'=>$_POST['h_ini_trab_sonda'],
      'TipoAlimentacion'=>$_POST['alimentacion_disp_sonda'],
      'ProfSonda'=>$_POST['profundida_sonda'],
      'NoSenSonda'=>$_POST['no_sensores_sonda'],
      ]
    );

    if($collection->insertOne($data)){
        echo "Datos almacenados correctamente";
    }else{
        echo "No se pudieron almacenar los datos";
    }
} else {
    echo "No se pudieron almacenar los datos";
}
