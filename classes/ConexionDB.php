<?php

require '../vendor/autoload.php';

class DBConnection {
    
    //Conexion principal
    public function ConectarBD(){
        $host = '127.0.0.1';
        $port = '27017';
        $uss = rawurldecode('GeoDIM');
        $pass = rawurldecode('');
        $db = 'GeoDIMTests';
        
        $urlConexion = sprintf('mongodb://%s:%s/%s', $host, $port, $db);
        $cliente = new MongoDB\Client($urlConexion);
        return $cliente->selectDatabase($db);
    }
    
    //Preparacion de coleccion Archivos Sondas de Inspeccion
    public function PreparaCollArchivosSI($cadenaArchSI){
        $coleccion = $cadenaArchSI.'RegistrosSI';
        return $coleccion;
    }
    
    //Preparacion de coleccion Archivos Bombas de Calor Geotermico
    public function PreparaCollArchivosBCG($cadenaArchBCG){
        $coleccion = $cadenaArchBCG.'RegistrosBCG';
        return $coleccion;
    }
    
    //Sitios Geograficos Connection
    public function SGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIM->SitiosGeograficos;
    
        return $collection;
    }
    
    //Upload CSV SI Connection
    public function UpCSVSIConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosSITest;
    
        return $collection;
    }
    
    //Upload CSV BCG Connection
    public function UpCSVBCGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosBCG;
    
        return $collection;
    }
    
    //Graficas Sondas Inspeccion Connection
    public function GSIConn(){
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");        
        $collection = $client->GeoDIMTests->ArchivosCSV;
        
        return $collection;
    }
    
    //Graficas Bombas Calor Connection
    public function GBCGConn(){
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");        
        $collection = $client->GeoDIM->ChartCollBCG;
        
        return $collection;
    }
    
    //Tests cargas de archivos
    public function UpCSVSIConnTest() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosSITest;
    
        return $collection;
    }
}
