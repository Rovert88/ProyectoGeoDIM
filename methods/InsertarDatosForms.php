<?php

require_once '../classes/ConexionDB.php';

$connect = new DBConnection();
$collection = $connect->SGConn();


if($_POST){
    if($_POST["ok"] == ""){
        $data = array(
            'NombreSitio'=>$_POST['p1'],
            'UbicacionSitio'=>$_POST['p2'],
            'CoordSitio'=>$_POST['p3'],
            'RegPor'=>$_POST['p4'],
            'ClimaSitio'=>$_POST['p5'],
            'DatosSonda'=>[
                'NombreSonda'=>$_POST['p6'],
                'TipoDispSonda'=>$_POST['p7'],
                'NoSerieDispSonda'=>$_POST['p8'],
                'VerSODispSonda'=>$_POST['p9'],
                'FechaIniTrabSonda'=>$_POST['p10'],
                'HoraIniTrabSonda'=>$_POST['p11'],
                'TipoAlimentacionDispSonda'=>$_POST['p12'],
                'ProfSonda'=>$_POST['p13'],
                'NoSenSonda'=>$_POST['p14'],
            ]           
        );
    }else{
        $data = array(            
            'NombreSitio'=>$_POST['p1'],
            'UbicacionSitio'=>$_POST['p2'],
            'CoordSitio'=>$_POST['p3'],
            'RegPor'=>$_POST['p4'],
            'ClimaSitio'=>$_POST['p5'],
            'DatosSonda'=>[
                'NombreSonda'=>$_POST['p6'],
                'TipoDispSonda'=>$_POST['p7'],
                'NoSerieDispSonda'=>$_POST['p8'],
                'VerSODispSonda'=>$_POST['p9'],
                'FechaIniTrabSonda'=>$_POST['p10'],
                'HoraIniTrabSonda'=>$_POST['p11'],
                'TipoAlimentacionDispSonda'=>$_POST['p12'],
                'ProfSonda'=>$_POST['p13'],
                'NoSenSonda'=>$_POST['p14'],
            ],
            'DatosBomba'=>[
                'NombreBomba'=>$_POST['p15'],
                'TipoDispBomba'=>$_POST['p16'],
                'NoSerieDispBomba'=>$_POST['p17'],
                'VerSODispBomba'=>$_POST['p18'],
                'FechaIniTrabBomba'=>$_POST['p19'],
                'HoraIniTrabBomba'=>$_POST['p20'],
                'TipoAlimentacionDispBomba'=>$_POST['p21'],
                'UbicacionEnSitio'=>$_POST['p22'],
                'NoVariables'=>$_POST['p23']
            ]
        );
    }

   $collection->insertOne($data);
   
}