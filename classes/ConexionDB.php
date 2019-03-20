<?php

require '../vendor/autoload.php';

class DBConnection {
    
    //Conexion principal
    //Esta es la conexion principal, esta selecciona la Bd
    public function ConectarBD(){
        $host = '127.0.0.1';
        $port = '27017';
        $uss = rawurldecode('GeoDIM');
        $pass = rawurldecode('');
        $db = 'GeoDIM';
        
        $urlConexion = sprintf('mongodb://%s:%s/%s', $host, $port, $db);
        $cliente = new MongoDB\Client($urlConexion);
        return $cliente->selectDatabase($db);
    }
       
    //Sitios Geograficos Connection
    public function SGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIM->SitiosGeograficos;
    
        return $collection;
    }
       
}
