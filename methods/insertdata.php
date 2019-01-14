<?php

require '../vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->GeoDIMTests->SitiosGeograficos;

if($_POST){
    $data = array(
      'NombreSitio'=>$_POST['nombre_sitio'],  
      'UbicacionSitio'=>$_POST['ubicacion_sitio'],
      'CoordSitio'=>$_POST['coord_sitio'],
      'RegPor'=>$_POST['reg_por'],
      'ClimaSitio'=>$_POST['clima_sitio'],
    );
 
    if($collection->insertOne($data)){
        echo "Datos almacenados correctamente";
    }else{
        echo "No se pudieron almacenar los datos";
    }
} else {
    echo "No se pudieron almacenar los datos";
}
